<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'invoice_id',
        'customer_id',
        'payment_number',
        'amount',
        'payment_method',
        'transaction_ref',
        'payment_date',
        'notes',
        'status',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function generatePaymentNumber(): string
    {
        $year = date('Y');
        $prefix = "PAY-{$year}-";

        $last = $this->like('payment_number', $prefix, 'after')
                     ->orderBy('id', 'DESC')
                     ->first();

        if ($last && !empty($last['payment_number'])) {
            $numPart = (int) substr($last['payment_number'], strlen($prefix));
            $next = str_pad($numPart + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $next = '0001';
        }

        return $prefix . $next;
    }
}
