<?php

namespace App\Models;

use CodeIgniter\Model;

class CommunicationLogModel extends Model
{
    protected $table            = 'communication_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'customer_id',
        'lead_id',
        'recipient_name',
        'recipient_contact',
        'channel',
        'template_key',
        'subject',
        'message_content',
        'status',
        'error_message',
        'sent_by_admin',
        'sent_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function getChannelStatistics(): array
    {
        return [
            'total'    => $this->countAllResults(),
            'whatsapp' => $this->where('channel', 'whatsapp')->where('status', 'sent')->countAllResults(),
            'sms'      => $this->where('channel', 'sms')->where('status', 'sent')->countAllResults(),
            'email'    => $this->where('channel', 'email')->where('status', 'sent')->countAllResults(),
            'failed'   => $this->where('status', 'failed')->countAllResults(),
        ];
    }
}
