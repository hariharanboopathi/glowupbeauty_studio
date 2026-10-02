<?php

namespace App\Models;

use CodeIgniter\Model;

class LeadModel extends Model
{
    protected $table            = 'leads';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone',
        'whatsapp',
        'email',
        'service_interested',
        'source',
        'campaign',
        'notes',
        'status',
        'assigned_staff',
        'customer_id',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getLeadStatistics(): array
    {
        return [
            'total'       => $this->countAllResults(),
            'new'         => $this->where('status', 'new')->countAllResults(),
            'contacted'   => $this->where('status', 'contacted')->countAllResults(),
            'follow_up'   => $this->where('status', 'follow_up')->countAllResults(),
            'interested'  => $this->where('status', 'interested')->countAllResults(),
            'converted'   => $this->where('status', 'converted')->countAllResults(),
            'lost'        => $this->where('status', 'lost')->countAllResults(),
        ];
    }
}
