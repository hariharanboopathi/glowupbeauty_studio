<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\IntegrationModel;
use App\Libraries\WhatsAppService;
use App\Libraries\SmsService;
use App\Libraries\EmailService;

class IntegrationController extends BaseController
{
    protected AdminAuth $auth;
    protected IntegrationModel $integrationModel;
    protected WhatsAppService $whatsappService;
    protected SmsService $smsService;
    protected EmailService $emailService;

    public function __construct()
    {
        $this->auth             = new AdminAuth();
        $this->integrationModel = new IntegrationModel();
        $this->whatsappService  = new WhatsAppService();
        $this->smsService       = new SmsService();
        $this->emailService     = new EmailService();
    }

    protected function getAdminData(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Elena Vance',
            'role'   => 'Salon Director',
            'avatar' => 'EV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /**
     * Unified API Key & Integrations Console
     */
    public function index()
    {
        $keys = ['whatsapp', 'sms', 'email_smtp', 'facebook_meta', 'instagram', 'google_maps'];
        $configs = [];

        foreach ($keys as $k) {
            $raw = $this->integrationModel->getConfig($k);
            // Mask secrets for display
            $masked = $raw;
            foreach (['access_token', 'meta_app_secret', 'page_access_token', 'api_key', 'smtp_pass', 'password'] as $secretField) {
                if (!empty($masked[$secretField])) {
                    $masked[$secretField . '_masked'] = '••••••••' . substr($masked[$secretField], -4);
                } else {
                    $masked[$secretField . '_masked'] = '';
                }
            }
            $configs[$k] = $masked;
        }

        return view('admin/pages/integrations', [
            'pageTitle'         => 'API & Integrations Console | Glowup Admin',
            'pageHeading'       => 'API Keys & Channel Integrations',
            'pageIcon'          => 'hub',
            'breadcrumbSection' => 'Settings',
            'breadcrumbTitle'   => 'API & Integrations',
            'activeMenu'        => 'integrations',
            'admin'             => $this->getAdminData(),
            'configs'           => $configs,
        ]);
    }

    /**
     * Save Integration Credentials Server-Side
     */
    public function save(string $providerKey)
    {
        $existing = $this->integrationModel->getConfig($providerKey);
        $postData = $this->request->getPost();

        // Merge and preserve unedited masked secrets
        foreach ($postData as $k => $v) {
            $v = trim((string) $v);
            if (strpos($v, '••••••••') !== false) {
                // Keep existing secret
                continue;
            }
            $existing[$k] = $v;
        }

        $existing['enabled'] = !empty($postData['enabled']);

        // Check if essential fields are provided to reset status if changed
        $this->integrationModel->saveConfig($providerKey, $existing);

        return redirect()->to(base_url('admin/settings/integrations?tab=' . $providerKey))
            ->with('success', "Configuration for " . ucfirst(str_replace('_', ' ', $providerKey)) . " saved successfully.");
    }

    /**
     * Real Connection Test - Never Faked!
     */
    public function testConnection(string $providerKey)
    {
        if ($providerKey === 'whatsapp') {
            $res = $this->whatsappService->testConnection();
            return $this->response->setJSON($res);
        }

        if ($providerKey === 'sms') {
            $res = $this->smsService->testConnection();
            return $this->response->setJSON($res);
        }

        if ($providerKey === 'email_smtp' || $providerKey === 'email') {
            $res = $this->emailService->testConnection();
            return $this->response->setJSON($res);
        }

        if ($providerKey === 'facebook_meta') {
            $cfg = $this->integrationModel->getConfig('facebook_meta');
            $appId  = $cfg['app_id'] ?? '';
            $secret = $cfg['app_secret'] ?? '';

            if (empty($appId) || empty($secret)) {
                $this->integrationModel->saveConfig('facebook_meta', $cfg, 'not_configured', 'Meta App ID & Secret missing.');
                return $this->response->setJSON(['status' => 'not_configured', 'message' => 'Meta App credentials are not configured.']);
            }

            // Real cURL test to Meta App Endpoint
            $ch = curl_init("https://graph.facebook.com/v19.0/{$appId}?access_token={$appId}|{$secret}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6);
            $res = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $data = json_decode($res, true);
            if ($code === 200 && !empty($data['id'])) {
                $appName = $data['name'] ?? 'Registered Meta App';
                $msg = "Connected successfully to Meta App: {$appName}";
                $this->integrationModel->saveConfig('facebook_meta', $cfg, 'connected', $msg);
                return $this->response->setJSON(['status' => 'connected', 'message' => $msg]);
            }

            $errMsg = $data['error']['message'] ?? "HTTP {$code}: Meta App authentication failed.";
            $this->integrationModel->saveConfig('facebook_meta', $cfg, 'connection_failed', $errMsg);
            return $this->response->setJSON(['status' => 'connection_failed', 'message' => $errMsg]);
        }

        if ($providerKey === 'instagram') {
            $cfg = $this->integrationModel->getConfig('instagram');
            $token = $cfg['access_token'] ?? '';

            if (empty($token)) {
                $this->integrationModel->saveConfig('instagram', $cfg, 'not_configured', 'Instagram Access Token missing.');
                return $this->response->setJSON(['status' => 'not_configured', 'message' => 'Instagram Professional Token is not configured.']);
            }

            $ch = curl_init("https://graph.facebook.com/v19.0/me?fields=id,username&access_token={$token}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6);
            $res = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $data = json_decode($res, true);
            if ($code === 200 && !empty($data['id'])) {
                $user = $data['username'] ?? 'Instagram Professional Account';
                $msg = "Connected to Instagram Professional: @{$user}";
                $this->integrationModel->saveConfig('instagram', $cfg, 'connected', $msg);
                return $this->response->setJSON(['status' => 'connected', 'message' => $msg]);
            }

            $errMsg = $data['error']['message'] ?? "HTTP {$code}: Instagram connection failed.";
            $this->integrationModel->saveConfig('instagram', $cfg, 'connection_failed', $errMsg);
            return $this->response->setJSON(['status' => 'connection_failed', 'message' => $errMsg]);
        }

        if ($providerKey === 'google_maps') {
            $cfg = $this->integrationModel->getConfig('google_maps');
            $key = $cfg['api_key'] ?? '';

            if (empty($key)) {
                $this->integrationModel->saveConfig('google_maps', $cfg, 'not_configured', 'Google Maps API Key missing.');
                return $this->response->setJSON(['status' => 'not_configured', 'message' => 'Google Maps API Key is not configured.']);
            }

            $ch = curl_init("https://maps.googleapis.com/maps/api/geocode/json?address=Hyderabad&key={$key}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6);
            $res = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($res, true);
            if (!empty($data['status']) && $data['status'] === 'OK') {
                $msg = 'Connected successfully to Google Maps Platform.';
                $this->integrationModel->saveConfig('google_maps', $cfg, 'connected', $msg);
                return $this->response->setJSON(['status' => 'connected', 'message' => $msg]);
            }

            $errMsg = $data['error_message'] ?? ($data['status'] ?? 'Google Maps validation failed.');
            $this->integrationModel->saveConfig('google_maps', $cfg, 'connection_failed', $errMsg);
            return $this->response->setJSON(['status' => 'connection_failed', 'message' => $errMsg]);
        }

        return $this->response->setJSON(['status' => 'not_configured', 'message' => 'Unknown integration provider.']);
    }

    /**
     * Send Test Outbound Message
     */
    public function sendTestMessage(string $providerKey)
    {
        $target = trim((string) $this->request->getPost('target'));

        if ($providerKey === 'whatsapp') {
            $res = $this->whatsappService->sendMessage($target, "Test message from Glowup Studio WhatsApp Cloud API. Integration verified at " . date('Y-m-d H:i:s'));
            return $this->response->setJSON($res);
        }

        if ($providerKey === 'sms') {
            $res = $this->smsService->sendSms($target, "Test SMS from Glowup Studio. Integration verified at " . date('H:i:s'));
            return $this->response->setJSON($res);
        }

        if ($providerKey === 'email_smtp') {
            $res = $this->emailService->sendMail($target, "Test Email: Glowup Studio SMTP Integration", "<p>Hello,</p><p>This is a verification email from your <strong>Glowup Studio & Academy</strong> system. SMTP is functioning properly.</p>");
            return $this->response->setJSON($res);
        }

        return $this->response->setJSON(['success' => false, 'error' => 'Unsupported provider for test message.']);
    }
}
