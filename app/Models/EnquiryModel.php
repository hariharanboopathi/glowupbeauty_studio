<?php

namespace App\Models;

use CodeIgniter\Model;

class EnquiryModel extends Model
{
    protected $table            = 'enquiries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'name'    => 'required|min_length[2]|max_length[120]',
        'email'   => 'required|valid_email|max_length[150]',
        'message' => 'required|min_length[5]',
        'status'  => 'permit_empty|in_list[new,read,replied]',
    ];

    /**
     * Get statistics for admin dashboard
     */
    public function getStatistics(): array
    {
        $total = $this->countAllResults();
        $new = $this->where('status', 'new')->countAllResults();
        $read = $this->where('status', 'read')->countAllResults();
        $replied = $this->where('status', 'replied')->countAllResults();

        return [
            'total'   => $total,
            'new'     => $new,
            'read'    => $read,
            'replied' => $replied,
        ];
    }
}
