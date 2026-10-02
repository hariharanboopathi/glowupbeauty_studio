<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table            = 'invoices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'invoice_number',
        'booking_id',
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'invoice_date',
        'due_date',
        'subtotal',
        'discount_type',
        'discount_amount',
        'tax_rate',
        'tax_amount',
        'total_amount',
        'amount_paid',
        'balance_due',
        'payment_method',
        'status',
        'notes',
        'terms',
        'sent_at',
        'paid_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Generate unique sequential invoice number INV-YYYY-XXXX
     */
    public function generateInvoiceNumber(): string
    {
        $year = date('Y');
        $prefix = "INV-{$year}-";

        $last = $this->like('invoice_number', $prefix, 'after')
                     ->orderBy('id', 'DESC')
                     ->first();

        if ($last && !empty($last['invoice_number'])) {
            $numPart = (int) substr($last['invoice_number'], strlen($prefix));
            $next = str_pad($numPart + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $next = '0001';
        }

        return $prefix . $next;
    }

    /**
     * Get invoice with line items
     */
    public function getInvoiceWithItems(int $id): ?array
    {
        $invoice = $this->find($id);
        if (!$invoice) {
            return null;
        }

        $db = \Config\Database::connect();
        $items = $db->table('invoice_items')->where('invoice_id', $id)->get()->getResultArray();
        $payments = $db->table('payments')->where('invoice_id', $id)->orderBy('id', 'DESC')->get()->getResultArray();

        $invoice['items'] = $items;
        $invoice['payments'] = $payments;

        return $invoice;
    }

    /**
     * Compute financial and invoice metrics for dashboard
     */
    public function getInvoiceStatistics(): array
    {
        $all = $this->findAll();
        $totalInvoices = count($all);
        $totalRevenue = 0.0;
        $pendingPayments = 0.0;
        $paidCount = 0;
        $unpaidCount = 0;
        $overdueCount = 0;

        $today = date('Y-m-d');

        foreach ($all as $inv) {
            if ($inv['status'] === 'cancelled') continue;

            $totalRevenue += (float) ($inv['amount_paid'] ?? 0);
            $pendingPayments += (float) ($inv['balance_due'] ?? 0);

            if ($inv['status'] === 'paid') {
                $paidCount++;
            } elseif ($inv['status'] === 'partially_paid' || $inv['status'] === 'sent' || $inv['status'] === 'draft') {
                $unpaidCount++;
                if (!empty($inv['due_date']) && $inv['due_date'] < $today) {
                    $overdueCount++;
                }
            } elseif ($inv['status'] === 'overdue') {
                $overdueCount++;
                $unpaidCount++;
            }
        }

        return [
            'total_invoices'   => $totalInvoices,
            'total_revenue'    => $totalRevenue,
            'pending_payments' => $pendingPayments,
            'paid_count'       => $paidCount,
            'unpaid_count'     => $unpaidCount,
            'overdue_count'    => $overdueCount,
        ];
    }
}
