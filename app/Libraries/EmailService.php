<?php

namespace App\Libraries;

use App\Models\IntegrationModel;
use App\Models\CommunicationLogModel;
use Config\Services;

class EmailService
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
        return $this->integrationModel->getConfig('email_smtp');
    }

    /**
     * Test Real SMTP Socket & Handshake Connectivity
     */
    public function testConnection(): array
    {
        $cfg = $this->getConfig();
        $host   = $cfg['smtp_host'] ?? '';
        $port   = (int) ($cfg['smtp_port'] ?? 587);
        $user   = $cfg['smtp_user'] ?? '';
        $pass   = $cfg['smtp_pass'] ?? '';

        if (empty($host) || empty($user)) {
            $this->integrationModel->saveConfig('email_smtp', $cfg, 'not_configured', 'SMTP Host and Username are required.');
            return [
                'status'  => 'not_configured',
                'message' => 'SMTP Host and Username are not configured.',
            ];
        }

        // Test real TCP socket to SMTP Host:Port
        $timeout = 5;
        $errno = 0;
        $errstr = '';
        $fp = @fsockopen($host, $port, $errno, $errstr, $timeout);

        if (!$fp) {
            $msg = "Unable to connect to {$host}:{$port}. Error: {$errstr} ({$errno})";
            $this->integrationModel->saveConfig('email_smtp', $cfg, 'connection_failed', $msg);
            return ['status' => 'connection_failed', 'message' => $msg];
        }

        $greeting = fgets($fp, 512);
        fclose($fp);

        if (strpos($greeting, '220') !== false) {
            $msg = "Connected successfully to SMTP server {$host}:{$port} ({$greeting})";
            $this->integrationModel->saveConfig('email_smtp', $cfg, 'connected', $msg);
            return ['status' => 'connected', 'message' => $msg];
        }

        $msg = "Connected to socket but greeting was unexpected: {$greeting}";
        $this->integrationModel->saveConfig('email_smtp', $cfg, 'connection_failed', $msg);
        return ['status' => 'connection_failed', 'message' => $msg];
    }

    /**
     * Send Outbound Email
     */
    public function sendMail(string $to, string $subject, string $htmlBody, ?string $recipientName = null, ?int $recipientId = null): array
    {
        $cfg = $this->getConfig();
        $fromEmail = $cfg['from_email'] ?? 'concierge@glowup.com';
        $fromName  = $cfg['from_name'] ?? 'Glowup Studio & Academy';

        $email = Services::email();
        $email->setFrom($fromEmail, $fromName);
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($htmlBody);
        $email->setMailType('html');

        $sent = false;
        $error = null;

        try {
            $sent = $email->send();
            if (!$sent) {
                $error = strip_tags($email->printDebugger(['headers']));
            }
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }

        // Record in communication logs
        $this->logModel->insert([
            'recipient_type'  => 'customer',
            'recipient_id'    => $recipientId ?: 0,
            'recipient_name'  => $recipientName ?: 'Client',
            'recipient_email' => $to,
            'channel'         => 'email',
            'subject'         => $subject,
            'message'         => substr(strip_tags($htmlBody), 0, 500),
            'status'          => $sent ? 'sent' : 'failed',
            'error_message'   => $error,
            'sent_at'         => date('Y-m-d H:i:s'),
        ]);

        return ['success' => $sent, 'error' => $error];
    }
}
