<?php

namespace App\Libraries;

use App\Models\IntegrationModel;
use App\Models\CommunicationLogModel;

class SmsService
{
    protected IntegrationModel $integrationModel;
    protected CommunicationLogModel $logModel;

    public function __construct()
    {
        $this->integrationModel = new IntegrationModel();
        $this->logModel         = new CommunicationLogModel();
    }

    public function getConfig(): array
    {
        return $this->integrationModel->getConfig('sms');
    }

    /**
     * Test Real SMS Gateway Connectivity
     */
    public function testConnection(): array
    {
        $cfg = $this->getConfig();
        $apiKey   = $cfg['api_key'] ?? '';
        $provider = $cfg['provider'] ?? 'Fast2SMS';
        $apiUrl   = $cfg['api_url'] ?? 'https://www.fast2sms.com/dev/bulkV2';

        if (empty($apiKey)) {
            $this->integrationModel->saveConfig('sms', $cfg, 'not_configured', 'API Key missing.');
            return [
                'status'  => 'not_configured',
                'message' => 'SMS Gateway API Key is not configured.',
            ];
        }

        // Test reachability for provider
        if (stripos($provider, 'Fast2SMS') !== false) {
            $ch = curl_init("https://www.fast2sms.com/dev/wallet");
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["authorization: {$apiKey}"]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6);
            $res = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $data = json_decode($res, true);
            if ($code === 200 && isset($data['wallet'])) {
                $msg = "Connected to Fast2SMS. Available Wallet Balance: ₹{$data['wallet']}";
                $this->integrationModel->saveConfig('sms', $cfg, 'connected', $msg);
                return ['status' => 'connected', 'message' => $msg];
            } else {
                $err = $data['message'] ?? "HTTP {$code}: Authentication failed on Fast2SMS.";
                $this->integrationModel->saveConfig('sms', $cfg, 'connection_failed', $err);
                return ['status' => 'connection_failed', 'message' => $err];
            }
        }

        // Generic HTTP Ping check
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $res = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code > 0 && $code < 500) {
            $msg = "Connected to {$provider} endpoint (HTTP {$code}).";
            $this->integrationModel->saveConfig('sms', $cfg, 'connected', $msg);
            return ['status' => 'connected', 'message' => $msg];
        }

        $msg = "Connection failed to {$apiUrl} (HTTP {$code}).";
        $this->integrationModel->saveConfig('sms', $cfg, 'connection_failed', $msg);
        return ['status' => 'connection_failed', 'message' => $msg];
    }

    /**
     * Send SMS Notification
     */
    public function sendSms(string $toPhone, string $message, ?string $recipientName = null, ?int $recipientId = null): array
    {
        $cfg = $this->getConfig();
        $apiKey   = $cfg['api_key'] ?? '';
        $provider = $cfg['provider'] ?? 'Fast2SMS';
        $senderId = $cfg['sender_id'] ?? 'GLOWUP';

        $cleanPhone = preg_replace('/[^0-9]/', '', $toPhone);
        if (strlen($cleanPhone) > 10 && substr($cleanPhone, 0, 2) === '91') {
            $cleanPhone = substr($cleanPhone, 2);
        }

        if (empty($apiKey)) {
            $this->logModel->insert([
                'recipient_type'  => 'customer',
                'recipient_id'    => $recipientId ?: 0,
                'recipient_name'  => $recipientName ?: 'Client',
                'recipient_phone' => $toPhone,
                'channel'         => 'sms',
                'subject'         => 'SMS Alert',
                'message'         => $message,
                'status'          => 'failed',
                'error_message'   => 'SMS provider credentials not configured.',
                'sent_at'         => date('Y-m-d H:i:s'),
            ]);
            return ['success' => false, 'error' => 'SMS Gateway not configured.'];
        }

        $success = false;
        $errorMsg = null;

        if (stripos($provider, 'Fast2SMS') !== false) {
            $payload = [
                'route'     => 'q',
                'message'   => $message,
                'language'  => 'english',
                'flash'     => 0,
                'numbers'   => $cleanPhone,
            ];

            $ch = curl_init("https://www.fast2sms.com/dev/bulkV2");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "authorization: {$apiKey}",
                "Content-Type: application/json",
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6);

            $res = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $data = json_decode($res, true);
            $success = ($code === 200 && !empty($data['return']) && $data['return'] === true);
            if (!$success) {
                $errorMsg = $data['message'][0] ?? ($data['message'] ?? "HTTP {$code}");
            }
        }

        $this->logModel->insert([
            'recipient_type'  => 'customer',
            'recipient_id'    => $recipientId ?: 0,
            'recipient_name'  => $recipientName ?: 'Client',
            'recipient_phone' => $toPhone,
            'channel'         => 'sms',
            'subject'         => 'SMS Alert',
            'message'         => $message,
            'status'          => $success ? 'sent' : 'failed',
            'error_message'   => $errorMsg,
            'sent_at'         => date('Y-m-d H:i:s'),
        ]);

        return ['success' => $success, 'error' => $errorMsg];
    }
}
