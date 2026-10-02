<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowUpModel extends Model
{
    protected $table            = 'follow_ups';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'lead_id',
        'customer_id',
        'contact_name',
        'contact_phone',
        'service_interested',
        'follow_up_date',
        'follow_up_time',
        'notes',
        'status',
        'reminder_sent',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getTodaysFollowUps(): array
    {
        return $this->where('follow_up_date', date('Y-m-d'))
                    ->orderBy('follow_up_time', 'ASC')
                    ->findAll();
    }

    public function getUpcomingFollowUps($limit = 10): array
    {
        return $this->where('follow_up_date >=', date('Y-m-d'))
                    ->where('status', 'pending')
                    ->orderBy('follow_up_date', 'ASC')
                    ->orderBy('follow_up_time', 'ASC')
                    ->findAll($limit);
    }
}
