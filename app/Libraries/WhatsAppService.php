<?php

namespace App\Libraries;

use App\Models\IntegrationModel;
use App\Models\CommunicationLogModel;

class WhatsAppService
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
        return $this->integrationModel->getConfig('whatsapp');
    }

    /**
     * Test Real WhatsApp Business Cloud API Connection
     */
    public function testConnection(): array
    {
        $cfg = $this->getConfig();

        $token       = $cfg['access_token'] ?? '';
        $phoneNumId  = $cfg['phone_number_id'] ?? '';
        $apiVersion  = $cfg['api_version'] ?? 'v19.0';

        if (empty($token) || empty($phoneNumId)) {
            $this->integrationModel->saveConfig('whatsapp', $cfg, 'not_configured', 'API credentials missing. Please configure Access Token and Phone Number ID.');
            return [
                'status'  => 'not_configured',
                'message' => 'Credentials missing. Please enter Meta Phone Number ID and Access Token.',
            ];
        }

        // Test API reachability with Meta Graph API
        $url = "https://graph.facebook.com/{$apiVersion}/{$phoneNumId}";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Content-Type: application/json",
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr  = curl_error($ch);
        curl_close($ch);

        if ($curlErr) {
            $msg = "cURL Network Error: {$curlErr}";
            $this->integrationModel->saveConfig('whatsapp', $cfg, 'connection_failed', $msg);
            return ['status' => 'connection_failed', 'message' => $msg];
        }

        $resData = json_decode($response, true);

        if ($httpCode >= 200 && $httpCode < 300 && !empty($resData['id'])) {
            $verifiedName = $resData['verified_name'] ?? ($resData['display_phone_number'] ?? 'Meta WhatsApp Business');
            $msg = "Connected successfully. Verified Business Account: {$verifiedName}";
            $this->integrationModel->saveConfig('whatsapp', $cfg, 'connected', $msg);
            return ['status' => 'connected', 'message' => $msg, 'data' => $resData];
        }

        $metaError = $resData['error']['message'] ?? "HTTP {$httpCode}: Connection failed to Meta API.";
        $this->integrationModel->saveConfig('whatsapp', $cfg, 'connection_failed', $metaError);
        return ['status' => 'connection_failed', 'message' => $metaError];
    }

    /**
     * Send WhatsApp Message (Template or Text)
     */
    public function sendMessage(string $toPhone, string $message, ?string $recipientName = null, ?int $recipientId = null): array
    {
        $cfg = $this->getConfig();
        $token       = $cfg['access_token'] ?? '';
        $phoneNumId  = $cfg['phone_number_id'] ?? '';
        $apiVersion  = $cfg['api_version'] ?? 'v19.0';

        $cleanPhone = preg_replace('/[^0-9]/', '', $toPhone);
        if (strlen($cleanPhone) === 10) {
            $cleanPhone = '91' . $cleanPhone;
        }

        if (empty($token) || empty($phoneNumId)) {
            // Log as pending or not configured
            $this->logModel->insert([
                'recipient_type'  => 'customer',
                'recipient_id'    => $recipientId ?: 0,
                'recipient_name'  => $recipientName ?: 'Client',
                'recipient_phone' => $toPhone,
                'channel'         => 'whatsapp',
                'subject'         => 'WhatsApp Notification',
                'message'         => $message,
                'status'          => 'failed',
                'error_message'   => 'WhatsApp Cloud API not configured on server.',
                'sent_at'         => date('Y-m-d H:i:s'),
            ]);
            return ['success' => false, 'error' => 'WhatsApp Cloud API not configured.'];
        }

        $payload = [
            'messaging_product' => 'whatsapp',
            'recipient_type'    => 'individual',
            'to'                => $cleanPhone,
            'type'              => 'text',
            'text'              => ['preview_url' => false, 'body' => $message],
        ];

        $url = "https://graph.facebook.com/{$apiVersion}/{$phoneNumId}/messages";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Content-Type: application/json",
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $resData = json_decode($response, true);
        $success = ($httpCode >= 200 && $httpCode < 300 && !empty($resData['messages']));

        $this->logModel->insert([
            'recipient_type'  => 'customer',
            'recipient_id'    => $recipientId ?: 0,
            'recipient_name'  => $recipientName ?: 'Client',
            'recipient_phone' => $toPhone,
            'channel'         => 'whatsapp',
            'subject'         => 'WhatsApp Direct Message',
            'message'         => $message,
            'status'          => $success ? 'sent' : 'failed',
            'error_message'   => $success ? null : ($resData['error']['message'] ?? "HTTP {$httpCode}"),
            'sent_at'         => date('Y-m-d H:i:s'),
        ]);

        return [
            'success'  => $success,
            'response' => $resData,
            'error'    => $success ? null : ($resData['error']['message'] ?? 'Dispatch failed'),
        ];
    }
}
