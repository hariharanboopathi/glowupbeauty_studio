<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table            = 'studio_events';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'event_type',
        'event_date',
        'event_time',
        'location',
        'fee',
        'capacity',
        'enrolled_count',
        'description',
        'image_url',
        'status',
        'sort_order',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUpcomingEvents()
    {
        return $this->where('status !=', 'completed')
                    ->orderBy('event_date', 'ASC')
                    ->findAll();
    }
}
