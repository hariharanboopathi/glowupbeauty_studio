<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'booking_code',
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'service_id',
        'service_name',
        'service_price',
        'service_duration',
        'specialist',
        'booking_date',
        'time_slot',
        'notes',
        'status',
        'invoice_id',
        'invoice_created',
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
        'customer_name'  => 'required|min_length[2]|max_length[120]',
        'customer_email' => 'required|valid_email|max_length[150]',
        'customer_phone' => 'required|min_length[5]|max_length[30]',
        'service_name'   => 'required|max_length[150]',
        'booking_date'   => 'required|valid_date',
        'time_slot'      => 'required|max_length[30]',
        'status'         => 'permit_empty|in_list[pending,confirmed,in_progress,completed,cancelled,no_show]',
    ];

    /**
     * Get statistics for admin dashboard
     */
    public function getStatistics(): array
    {
        $total = $this->countAllResults();
        $pending = $this->where('status', 'pending')->countAllResults();
        $confirmed = $this->where('status', 'confirmed')->countAllResults();
        $completed = $this->where('status', 'completed')->countAllResults();
        $cancelled = $this->where('status', 'cancelled')->countAllResults();

        // Calculate total confirmed/completed revenue
        $revenue = $this->selectSum('service_price')
                        ->whereIn('status', ['confirmed', 'completed'])
                        ->first()['service_price'] ?? 0;

        return [
            'total'     => $total,
            'pending'   => $pending,
            'confirmed' => $confirmed,
            'completed' => $completed,
            'cancelled' => $cancelled,
            'revenue'   => (float) $revenue,
        ];
    }
}
