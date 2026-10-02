<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;
use App\Models\PaymentModel;
use App\Models\CustomerModel;
use App\Models\ServiceModel;
use App\Models\BookingModel;
use App\Models\CommunicationLogModel;

class InvoiceController extends BaseController
{
    protected AdminAuth $auth;
    protected InvoiceModel $invoiceModel;
    protected InvoiceItemModel $invoiceItemModel;
    protected PaymentModel $paymentModel;
    protected CustomerModel $customerModel;
    protected ServiceModel $serviceModel;
    protected BookingModel $bookingModel;
    protected CommunicationLogModel $commLogModel;

    public function __construct()
    {
        $this->auth             = new AdminAuth();
        $this->invoiceModel     = new InvoiceModel();
        $this->invoiceItemModel = new InvoiceItemModel();
        $this->paymentModel     = new PaymentModel();
        $this->customerModel    = new CustomerModel();
        $this->serviceModel     = new ServiceModel();
        $this->bookingModel     = new BookingModel();
        $this->commLogModel     = new CommunicationLogModel();
    }

    protected function getAdminData(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Elena Vance',
            'role'   => 'Finance & Salon Director',
            'avatar' => 'EV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /**
     * Master Invoices Index
     */
    public function index()
    {
        $statusFilter = $this->request->getGet('status') ?: 'all';
        $search       = trim((string) $this->request->getGet('search'));

        $builder = $this->invoiceModel->orderBy('id', 'DESC');

        if ($statusFilter !== 'all') {
            $builder->where('status', $statusFilter);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('invoice_number', $search)
                    ->orLike('customer_name', $search)
                    ->orLike('customer_phone', $search)
                    ->orLike('customer_email', $search)
                    ->groupEnd();
        }

        $invoices = $builder->findAll();
        $stats    = $this->invoiceModel->getInvoiceStatistics();

        $customers = $this->customerModel->orderBy('name', 'ASC')->findAll();
        $services  = $this->serviceModel->where('is_active', 1)->orderBy('name', 'ASC')->findAll();

        return view('admin/pages/invoices', [
            'pageTitle'         => 'Invoices & Billing | Glowup Admin',
            'pageHeading'       => 'Invoices & Accounts Receivable',
            'pageIcon'          => 'receipt_long',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Invoices',
            'activeMenu'        => 'invoices',
            'admin'             => $this->getAdminData(),
            'invoices'          => $invoices,
            'stats'             => $stats,
            'statusFilter'      => $statusFilter,
            'search'            => $search,
            'customers'         => $customers,
            'services'          => $services,
        ]);
    }

    /**
     * View & Print Tax Invoice (Luxury Printable View)
     */
    public function viewInvoice($id)
    {
        $invoice = $this->invoiceModel->getInvoiceWithItems((int) $id);
        if (!$invoice) {
            return redirect()->to(base_url('admin/invoices'))->with('error', 'Invoice record not found.');
        }

        $customer = null;
        if (!empty($invoice['customer_id'])) {
            $customer = $this->customerModel->find($invoice['customer_id']);
        }

        $booking = null;
        if (!empty($invoice['booking_id'])) {
            $booking = $this->bookingModel->find($invoice['booking_id']);
        }

        return view('admin/pages/invoice_view', [
            'pageTitle'         => "Invoice #{$invoice['invoice_number']} | Glowup Studio",
            'pageHeading'       => "Tax Invoice #{$invoice['invoice_number']}",
            'pageIcon'          => 'receipt',
            'breadcrumbSection' => 'Invoices',
            'breadcrumbTitle'   => $invoice['invoice_number'],
            'activeMenu'        => 'invoices',
            'admin'             => $this->getAdminData(),
            'invoice'           => $invoice,
            'customer'          => $customer,
            'booking'           => $booking,
        ]);
    }

    /**
     * Create Manual Invoice
     */
    public function save()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'customer_name' => 'required|min_length[2]|max_length[150]',
            'invoice_date'  => 'required|valid_date',
            'due_date'      => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide valid customer details and dates.');
        }

        $customerId = (int) $this->request->getPost('customer_id');
        $customerName = trim((string) $this->request->getPost('customer_name'));
        $customerEmail = trim((string) $this->request->getPost('customer_email'));
        $customerPhone = trim((string) $this->request->getPost('customer_phone'));
        $customerAddress = trim((string) $this->request->getPost('customer_address')) ?: 'Jubilee Hills, Hyderabad';

        if ($customerId > 0) {
            $cust = $this->customerModel->find($customerId);
            if ($cust) {
                $customerName = $cust['name'];
                $customerEmail = $cust['email'];
                $customerPhone = $cust['phone'];
                if (!empty($cust['address'])) $customerAddress = $cust['address'];
            }
        }

        $subtotal = 0.0;
        $items = $this->request->getPost('items') ?? [];

        // Calculate subtotal from items if submitted, or single item fields
        $processedItems = [];
        if (!empty($items) && is_array($items)) {
            foreach ($items as $item) {
                $name  = trim($item['name'] ?? '');
                $qty   = max(1, (int) ($item['quantity'] ?? 1));
                $price = (float) ($item['price'] ?? 0);
                $total = $qty * $price;
                if (!empty($name) && $price > 0) {
                    $subtotal += $total;
                    $processedItems[] = [
                        'item_type'   => $item['type'] ?? 'service',
                        'item_name'   => $name,
                        'description' => $item['description'] ?? '',
                        'quantity'    => $qty,
                        'unit_price'  => $price,
                        'total_price' => $total,
                    ];
                }
            }
        }

        // Fallback to single manual service fields if no array
        if (empty($processedItems)) {
            $singleName  = trim((string) $this->request->getPost('service_name')) ?: 'Bespoke Salon Service';
            $singlePrice = (float) $this->request->getPost('subtotal');
            $subtotal    = $singlePrice;
            $processedItems[] = [
                'item_type'   => 'service',
                'item_name'   => $singleName,
                'description' => 'Custom client styling / treatment',
                'quantity'    => 1,
                'unit_price'  => $singlePrice,
                'total_price' => $singlePrice,
            ];
        }

        $discountType   = $this->request->getPost('discount_type') ?: 'none';
        $discountAmount = (float) $this->request->getPost('discount_amount');
        $taxRate        = (float) ($this->request->getPost('tax_rate') ?? 18.00);

        $taxable = max(0, $subtotal - $discountAmount);
        $taxAmount = round($taxable * ($taxRate / 100), 2);
        $totalAmount = round($taxable + $taxAmount, 2);

        $data = [
            'customer_id'      => $customerId ?: null,
            'customer_name'    => $customerName,
            'customer_email'   => $customerEmail,
            'customer_phone'   => $customerPhone,
            'customer_address' => $customerAddress,
            'invoice_date'     => $this->request->getPost('invoice_date'),
            'due_date'         => $this->request->getPost('due_date'),
            'subtotal'         => $subtotal,
            'discount_type'    => $discountType,
            'discount_amount'  => $discountAmount,
            'tax_rate'         => $taxRate,
            'tax_amount'       => $taxAmount,
            'total_amount'     => $totalAmount,
            'payment_method'   => $this->request->getPost('payment_method') ?: 'UPI',
            'status'           => $this->request->getPost('status') ?: 'sent',
            'notes'            => trim((string) $this->request->getPost('notes')),
            'terms'            => 'Invoices are payable upon receipt. Glowup Beauty Studio appreciates your valued patronage.',
        ];

        if ($id > 0) {
            $existing = $this->invoiceModel->find($id);
            $data['balance_due'] = max(0, $totalAmount - (float) ($existing['amount_paid'] ?? 0));
            $this->invoiceModel->update($id, $data);
            $invoiceId = $id;

            // Refresh items
            $this->invoiceItemModel->where('invoice_id', $invoiceId)->delete();
            foreach ($processedItems as $pi) {
                $pi['invoice_id'] = $invoiceId;
                $this->invoiceItemModel->insert($pi);
            }
            $msg = 'Invoice updated successfully.';
        } else {
            $data['invoice_number'] = $this->invoiceModel->generateInvoiceNumber();
            $data['amount_paid']    = 0.00;
            $data['balance_due']    = $totalAmount;
            $invoiceId = $this->invoiceModel->insert($data);

            foreach ($processedItems as $pi) {
                $pi['invoice_id'] = $invoiceId;
                $this->invoiceItemModel->insert($pi);
            }
            $msg = "Invoice #{$data['invoice_number']} created successfully.";
        }

        return redirect()->to(base_url('admin/invoices/view/' . $invoiceId))->with('success', $msg);
    }

    /**
     * Record a Payment against an Invoice
     */
    public function recordPayment($id)
    {
        $invoice = $this->invoiceModel->find($id);
        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice not found.');
        }

        $paymentAmount = (float) $this->request->getPost('amount');
        if ($paymentAmount <= 0) {
            return redirect()->back()->with('error', 'Please enter a valid payment amount greater than zero.');
        }

        $method  = trim((string) $this->request->getPost('payment_method')) ?: 'UPI';
        $txnRef  = trim((string) $this->request->getPost('transaction_ref')) ?: ('TXN-' . strtoupper(substr(uniqid(), -6)));
        $notes   = trim((string) $this->request->getPost('notes'));
        $payDate = $this->request->getPost('payment_date') ?: date('Y-m-d');

        // Insert payment record
        $payNumber = $this->paymentModel->generatePaymentNumber();
        $this->paymentModel->insert([
            'invoice_id'      => $id,
            'customer_id'     => $invoice['customer_id'] ?: null,
            'payment_number'  => $payNumber,
            'amount'          => $paymentAmount,
            'payment_method'  => $method,
            'transaction_ref' => $txnRef,
            'payment_date'    => $payDate,
            'notes'           => $notes,
            'status'          => 'completed',
            'created_at'      => date('Y-m-d H:i:s'),
        ]);

        // Update invoice balance
        $currentPaid = (float) ($invoice['amount_paid'] ?? 0);
        $total       = (float) ($invoice['total_amount'] ?? 0);
        $newPaid     = $currentPaid + $paymentAmount;
        $balanceDue  = max(0.00, $total - $newPaid);

        $newStatus = ($balanceDue <= 0.00) ? 'paid' : 'partially_paid';

        $this->invoiceModel->update($id, [
            'amount_paid' => $newPaid,
            'balance_due' => $balanceDue,
            'status'      => $newStatus,
            'paid_at'     => ($newStatus === 'paid') ? date('Y-m-d H:i:s') : null,
        ]);

        // Touch customer record updated_at if customer linked
        if (!empty($invoice['customer_id'])) {
            $cust = $this->customerModel->find($invoice['customer_id']);
            if ($cust) {
                $this->customerModel->update($cust['id'], [
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        // Log communication
        $this->commLogModel->insert([
            'recipient_type'  => 'customer',
            'recipient_id'    => $invoice['customer_id'] ?: 0,
            'recipient_name'  => $invoice['customer_name'],
            'recipient_phone' => $invoice['customer_phone'],
            'recipient_email' => $invoice['customer_email'],
            'channel'         => 'system',
            'subject'         => "Payment Received: ₹" . number_format($paymentAmount, 2) . " for Invoice #{$invoice['invoice_number']}",
            'message'         => "Payment of ₹" . number_format($paymentAmount, 2) . " via {$method} successfully credited. Receipt #{$payNumber}.",
            'status'          => 'sent',
            'sent_at'         => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('admin/invoices/view/' . $id))
            ->with('success', "Payment of ₹" . number_format($paymentAmount, 2) . " recorded successfully. Receipt #{$payNumber}.");
    }

    /**
     * Mark Invoice as 100% Paid instantly
     */
    public function markPaid($id)
    {
        $invoice = $this->invoiceModel->find($id);
        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice not found.');
        }

        $total = (float) ($invoice['total_amount'] ?? 0);
        $due   = (float) ($invoice['balance_due'] ?? $total);

        if ($due > 0) {
            $payNumber = $this->paymentModel->generatePaymentNumber();
            $this->paymentModel->insert([
                'invoice_id'      => $id,
                'customer_id'     => $invoice['customer_id'] ?: null,
                'payment_number'  => $payNumber,
                'amount'          => $due,
                'payment_method'  => 'UPI / Cash Settlement',
                'transaction_ref' => 'SETTLE-' . strtoupper(substr(uniqid(), -6)),
                'payment_date'    => date('Y-m-d'),
                'notes'           => 'Full balance settlement confirmed by admin.',
                'status'          => 'completed',
                'created_at'      => date('Y-m-d H:i:s'),
            ]);

            if (!empty($invoice['customer_id'])) {
                $cust = $this->customerModel->find($invoice['customer_id']);
                if ($cust) {
                    $this->customerModel->update($cust['id'], [
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }

        $this->invoiceModel->update($id, [
            'amount_paid' => $total,
            'balance_due' => 0.00,
            'status'      => 'paid',
            'paid_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('admin/invoices/view/' . $id))
            ->with('success', "Invoice #{$invoice['invoice_number']} marked as fully Paid.");
    }

    /**
     * Cancel Invoice
     */
    public function cancelInvoice($id)
    {
        $invoice = $this->invoiceModel->find($id);
        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice not found.');
        }

        $this->invoiceModel->update($id, ['status' => 'cancelled']);
        return redirect()->to(base_url('admin/invoices/view/' . $id))
            ->with('success', "Invoice #{$invoice['invoice_number']} has been cancelled.");
    }

    /**
     * Delete Invoice
     */
    public function delete($id)
    {
        $this->invoiceItemModel->where('invoice_id', $id)->delete();
        $this->paymentModel->where('invoice_id', $id)->delete();
        $this->invoiceModel->delete($id);

        return redirect()->to(base_url('admin/invoices'))->with('success', 'Invoice record deleted.');
    }
}
