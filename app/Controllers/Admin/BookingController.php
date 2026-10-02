<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\BookingModel;
use App\Models\CustomerModel;
use App\Models\ServiceModel;
use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;
use App\Models\CommunicationLogModel;

class BookingController extends BaseController
{
    protected AdminAuth $auth;
    protected BookingModel $bookingModel;
    protected CustomerModel $customerModel;
    protected ServiceModel $serviceModel;
    protected InvoiceModel $invoiceModel;
    protected InvoiceItemModel $invoiceItemModel;
    protected CommunicationLogModel $commLogModel;

    public function __construct()
    {
        $this->auth             = new AdminAuth();
        $this->bookingModel     = new BookingModel();
        $this->customerModel    = new CustomerModel();
        $this->serviceModel     = new ServiceModel();
        $this->invoiceModel     = new InvoiceModel();
        $this->invoiceItemModel = new InvoiceItemModel();
        $this->commLogModel     = new CommunicationLogModel();
    }

    protected function getAdminData(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Elena Vance',
            'role'   => 'Salon Director',
            'avatar' => 'EV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /**
     * Master Bookings / Appointments View
     */
    public function index()
    {
        $statusFilter = $this->request->getGet('status') ?: 'all';
        $dateFilter   = $this->request->getGet('date') ?: 'all';
        $search       = trim((string) $this->request->getGet('search'));
        $today        = date('Y-m-d');

        $builder = $this->bookingModel->orderBy('booking_date', 'DESC')->orderBy('time_slot', 'ASC');

        if ($statusFilter !== 'all') {
            $builder->where('status', $statusFilter);
        }

        if ($dateFilter === 'today') {
            $builder->where('booking_date', $today);
        } elseif ($dateFilter === 'upcoming') {
            $builder->where('booking_date >=', $today);
        } elseif ($dateFilter === 'past') {
            $builder->where('booking_date <', $today);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('customer_name', $search)
                    ->orLike('customer_phone', $search)
                    ->orLike('customer_email', $search)
                    ->orLike('booking_code', $search)
                    ->orLike('service_name', $search)
                    ->orLike('specialist', $search)
                    ->groupEnd();
        }

        $bookings = $builder->findAll();

        // Calculate real KPI statistics
        $allBookings = $this->bookingModel->findAll();
        $stats = [
            'total'       => count($allBookings),
            'today'       => 0,
            'upcoming'    => 0,
            'pending'     => 0,
            'confirmed'   => 0,
            'in_progress' => 0,
            'completed'   => 0,
            'cancelled'   => 0,
            'revenue'     => 0.0,
        ];

        foreach ($allBookings as $b) {
            if ($b['booking_date'] === $today) {
                $stats['today']++;
            }
            if ($b['booking_date'] >= $today && in_array($b['status'], ['pending', 'confirmed'])) {
                $stats['upcoming']++;
            }
            if (isset($stats[$b['status']])) {
                $stats[$b['status']]++;
            }
            if ($b['status'] === 'completed' || $b['status'] === 'confirmed') {
                $stats['revenue'] += (float) ($b['service_price'] ?? 0);
            }
        }

        $customers = $this->customerModel->orderBy('name', 'ASC')->findAll();
        $services  = $this->serviceModel->where('is_active', 1)->orderBy('name', 'ASC')->findAll();

        return view('admin/pages/bookings', [
            'pageTitle'         => 'Appointments & Bookings | Glowup Admin',
            'pageHeading'       => 'Appointments & Service Schedule',
            'pageIcon'          => 'calendar_month',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Bookings',
            'activeMenu'        => 'bookings',
            'admin'             => $this->getAdminData(),
            'bookings'          => $bookings,
            'stats'             => $stats,
            'statusFilter'      => $statusFilter,
            'dateFilter'        => $dateFilter,
            'search'            => $search,
            'customers'         => $customers,
            'services'          => $services,
        ]);
    }

    /**
     * Save / Update Booking
     */
    public function save()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'booking_date' => 'required|valid_date',
            'time_slot'    => 'required',
            'status'       => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Booking date and time slot are required.');
        }

        $customerId = (int) $this->request->getPost('customer_id');
        $customerName = trim((string) $this->request->getPost('customer_name'));
        $customerEmail = trim((string) $this->request->getPost('customer_email'));
        $customerPhone = trim((string) $this->request->getPost('customer_phone'));

        // If customer selected from CRM, sync details
        if ($customerId > 0) {
            $customer = $this->customerModel->find($customerId);
            if ($customer) {
                $customerName  = $customer['name'];
                $customerEmail = $customer['email'];
                $customerPhone = $customer['phone'];
            }
        } elseif (!empty($customerPhone) && !empty($customerName)) {
            // Find existing customer by phone or email, or auto-create CRM record
            $existing = $this->customerModel->where('phone', $customerPhone)
                                           ->orWhere('email', $customerEmail)
                                           ->first();
            if ($existing) {
                $customerId = $existing['id'];
            } else {
                $customerId = $this->customerModel->insert([
                    'name'            => $customerName,
                    'email'           => $customerEmail ?: ('client_' . time() . '@glowup.in'),
                    'phone'           => $customerPhone,
                    'lead_source'     => 'Booking Form',
                    'customer_status' => 'active',
                    'status'          => 1,
                    'password'        => password_hash('Patron@123', PASSWORD_DEFAULT),
                    'created_at'      => date('Y-m-d H:i:s'),
                ]);
            }
        }

        $serviceId = (int) $this->request->getPost('service_id');
        $serviceName = trim((string) $this->request->getPost('service_name'));
        $servicePrice = (float) $this->request->getPost('service_price');
        $serviceDuration = trim((string) $this->request->getPost('service_duration')) ?: '60 mins';

        if ($serviceId > 0) {
            $service = $this->serviceModel->find($serviceId);
            if ($service) {
                $serviceName     = $service['name'];
                $servicePrice    = (float) $service['price'];
                $serviceDuration = $service['duration'] ?? '60 mins';
            }
        }

        $status = trim((string) $this->request->getPost('status')) ?: 'pending';

        $data = [
            'customer_id'      => $customerId ?: null,
            'customer_name'    => $customerName,
            'customer_email'   => $customerEmail,
            'customer_phone'   => $customerPhone,
            'service_id'       => $serviceId ?: null,
            'service_name'     => $serviceName,
            'service_price'    => $servicePrice,
            'service_duration' => $serviceDuration,
            'specialist'       => trim((string) $this->request->getPost('specialist')) ?: 'Elena Vance',
            'booking_date'     => $this->request->getPost('booking_date'),
            'time_slot'        => trim((string) $this->request->getPost('time_slot')),
            'notes'            => trim((string) $this->request->getPost('notes')),
            'status'           => $status,
        ];

        if ($id > 0) {
            $this->bookingModel->update($id, $data);
            $msg = "Booking updated successfully.";

            // If status changed to completed, trigger auto invoice
            if ($status === 'completed') {
                return $this->completeService($id);
            }
        } else {
            $data['booking_code'] = 'BK-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
            $newId = $this->bookingModel->insert($data);
            $msg = "New appointment #{$data['booking_code']} scheduled.";

            if ($status === 'completed') {
                return $this->completeService($newId);
            }
        }

        return redirect()->to(base_url('admin/bookings'))->with('success', $msg);
    }

    /**
     * Update Booking Status (Pending, Confirmed, In Progress, Cancelled, No Show)
     */
    public function updateStatus($id)
    {
        $booking = $this->bookingModel->find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $newStatus = trim((string) $this->request->getPost('status'));
        $validStatuses = ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled', 'no_show'];

        if (!in_array($newStatus, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid booking status.');
        }

        if ($newStatus === 'completed') {
            return $this->completeService($id);
        }

        $this->bookingModel->update($id, ['status' => $newStatus]);
        return redirect()->back()->with('success', "Appointment status updated to " . ucfirst(str_replace('_', ' ', $newStatus)));
    }

    /**
     * SERVICE COMPLETED & AUTOMATIC INVOICE GENERATION WORKFLOW
     * Booking -> Service Completed -> Invoice Auto-Generated -> Customer Profile Updated -> Revenue Updated
     */
    public function completeService($id)
    {
        $booking = $this->bookingModel->find($id);
        if (!$booking) {
            return redirect()->to(base_url('admin/bookings'))->with('error', 'Booking not found.');
        }

        // 1. Mark booking completed
        $this->bookingModel->update($id, [
            'status'     => 'completed',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // 2. Check if invoice already created for this booking
        $existingInvoice = null;
        if (!empty($booking['invoice_id'])) {
            $existingInvoice = $this->invoiceModel->find($booking['invoice_id']);
        } else {
            $existingInvoice = $this->invoiceModel->where('booking_id', $id)->first();
        }

        $invoiceNum = '';
        $invoiceId  = 0;

        if (!$existingInvoice) {
            // Compute financial totals (18% GST standard)
            $subtotal   = (float) ($booking['service_price'] ?? 0);
            $taxRate    = 18.00;
            $taxAmount  = round($subtotal * ($taxRate / 100), 2);
            $totalAmount= round($subtotal + $taxAmount, 2);
            $invoiceNum = $this->invoiceModel->generateInvoiceNumber();

            // Create Auto Invoice
            $invoiceData = [
                'invoice_number'   => $invoiceNum,
                'booking_id'       => $id,
                'customer_id'      => $booking['customer_id'] ?: null,
                'customer_name'    => $booking['customer_name'] ?: 'Valued Client',
                'customer_email'   => $booking['customer_email'] ?: 'client@glowup.in',
                'customer_phone'   => $booking['customer_phone'] ?: '',
                'customer_address' => 'Glowup Studio, Suite 402, Jubilee Hills, Hyderabad',
                'invoice_date'     => date('Y-m-d'),
                'due_date'         => date('Y-m-d', strtotime('+3 days')),
                'subtotal'         => $subtotal,
                'discount_type'    => 'none',
                'discount_amount'  => 0.00,
                'tax_rate'         => $taxRate,
                'tax_amount'       => $taxAmount,
                'total_amount'     => $totalAmount,
                'amount_paid'      => 0.00,
                'balance_due'      => $totalAmount,
                'payment_method'   => 'UPI / Cash / Card',
                'status'           => 'sent',
                'notes'            => 'Generated automatically on service completion for ' . $booking['service_name'],
                'terms'            => 'Invoices are payable upon receipt. Services once rendered are non-refundable. Thank you for choosing Glowup!',
                'sent_at'          => date('Y-m-d H:i:s'),
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ];

            $invoiceId = $this->invoiceModel->insert($invoiceData);

            // Create line item in invoice_items
            $this->invoiceItemModel->insert([
                'invoice_id'  => $invoiceId,
                'item_type'   => 'service',
                'item_name'   => $booking['service_name'] ?: 'Salon Beauty Service',
                'description' => 'Appointment on ' . date('d M Y', strtotime($booking['booking_date'])) . ' at ' . $booking['time_slot'] . ' with ' . ($booking['specialist'] ?: 'Lead Stylist'),
                'quantity'    => 1,
                'unit_price'  => $subtotal,
                'total_price' => $subtotal,
                'created_at'  => date('Y-m-d H:i:s'),
            ]);

            // Link invoice back to booking
            $this->bookingModel->update($id, [
                'invoice_id'      => $invoiceId,
                'invoice_created' => 1,
            ]);

            // 3. Touch customer CRM record
            if (!empty($booking['customer_id'])) {
                $cust = $this->customerModel->find($booking['customer_id']);
                if ($cust) {
                    $this->customerModel->update($cust['id'], [
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }

            // 4. Log Communication Record
            $this->commLogModel->insert([
                'recipient_type'  => 'customer',
                'recipient_id'    => $booking['customer_id'] ?: 0,
                'recipient_name'  => $booking['customer_name'],
                'recipient_phone' => $booking['customer_phone'],
                'recipient_email' => $booking['customer_email'],
                'channel'         => 'system',
                'subject'         => "Invoice Generated: {$invoiceNum}",
                'message'         => "Service '{$booking['service_name']}' completed. Automatic tax invoice {$invoiceNum} generated for ₹" . number_format($totalAmount, 2),
                'status'          => 'sent',
                'sent_at'         => date('Y-m-d H:i:s'),
            ]);

            $successMsg = "Service marked as Completed! Invoice #{$invoiceNum} automatically generated.";
        } else {
            $invoiceNum = $existingInvoice['invoice_number'];
            $invoiceId  = $existingInvoice['id'];
            $successMsg = "Service marked as Completed! (Associated with existing Invoice #{$invoiceNum}).";
        }

        return redirect()->to(base_url('admin/invoices/view/' . $invoiceId))->with('success', $successMsg);
    }

    /**
     * Delete Booking
     */
    public function delete($id)
    {
        $this->bookingModel->delete($id);
        return redirect()->to(base_url('admin/bookings'))->with('success', 'Booking record deleted.');
    }
}
