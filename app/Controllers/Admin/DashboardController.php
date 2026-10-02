<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\BookingModel;
use App\Models\CustomerModel;
use App\Models\EnquiryModel;
use App\Models\LeadModel;
use App\Models\FollowUpModel;
use App\Models\InvoiceModel;
use App\Models\PaymentModel;
use App\Models\OfferModel;
use App\Models\CommunicationLogModel;
use App\Models\ReviewModel;

class DashboardController extends BaseController
{
    protected AdminAuth $auth;

    public function __construct()
    {
        $this->auth = new AdminAuth();
    }

    public function index()
    {
        $admin = $this->auth->user() ?? [
            'name'   => 'Elena Vance',
            'role'   => 'Super Administrator',
            'avatar' => 'EV',
            'email'  => 'admin@glowup.com',
        ];

        $today = date('Y-m-d');
        $thirtyDaysAgo = date('Y-m-d H:i:s', strtotime('-30 days'));

        $bookingModel = new BookingModel();
        $customerModel = new CustomerModel();
        $enquiryModel = new EnquiryModel();
        $leadModel = new LeadModel();
        $followUpModel = new FollowUpModel();
        $invoiceModel = new InvoiceModel();
        $paymentModel = new PaymentModel();
        $offerModel = new OfferModel();
        $commLogModel = new CommunicationLogModel();
        $reviewModel = new ReviewModel();

        // 1. REAL APPOINTMENT & SERVICE METRICS
        $allBookings = $bookingModel->findAll();
        $todayBookings = 0;
        $upcomingAppointments = 0;
        $completedServices = 0;
        $pendingServices = 0;
        $cancelledBookings = 0;

        foreach ($allBookings as $b) {
            if ($b['booking_date'] === $today) {
                $todayBookings++;
            }
            if ($b['booking_date'] >= $today && in_array($b['status'], ['pending', 'confirmed'])) {
                $upcomingAppointments++;
            }
            if ($b['status'] === 'completed') {
                $completedServices++;
            } elseif ($b['status'] === 'pending') {
                $pendingServices++;
            } elseif ($b['status'] === 'cancelled') {
                $cancelledBookings++;
            }
        }

        // 2. ENQUIRIES & LEADS METRICS
        $newEnquiries = $enquiryModel->where('status', 'new')->countAllResults();
        $newLeads = $leadModel->where('status', 'new')->countAllResults();
        $newCustomers = $customerModel->where('created_at >=', $thirtyDaysAgo)->countAllResults();

        $academyEnquiries = $enquiryModel->like('subject', 'Academy')->orLike('message', 'Academy')->countAllResults();
        $bridalEnquiries = $enquiryModel->like('subject', 'Bridal')->orLike('message', 'Bridal')->countAllResults();

        // 3. INVOICE & REVENUE METRICS
        $invoiceStats = $invoiceModel->getInvoiceStatistics();
        $totalRevenue = $invoiceStats['total_revenue'];
        $pendingPayments = $invoiceStats['pending_payments'];
        $paidInvoices = $invoiceStats['paid_count'];
        $unpaidInvoices = $invoiceStats['unpaid_count'];
        $overdueInvoices = $invoiceStats['overdue_count'];

        // 4. ACTIVE OFFERS & COMMUNICATIONS
        $activeOffers = count($offerModel->getActiveFrontendOffers());
        $commStats = $commLogModel->getChannelStatistics();
        $whatsappSent = $commStats['whatsapp'];
        $smsSent = $commStats['sms'];
        $emailSent = $commStats['email'];

        // 5. CHART DATASETS (Real database aggregations)

        // A. Daily Bookings Trend (Last 7 Days)
        $dailyBookingsLabels = [];
        $dailyBookingsData = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = date('Y-m-d', strtotime("-{$i} days"));
            $dailyBookingsLabels[] = date('d M', strtotime($d));
            $count = 0;
            foreach ($allBookings as $b) {
                if ($b['booking_date'] === $d) $count++;
            }
            $dailyBookingsData[] = $count;
        }

        // B. Monthly Revenue Trend (Last 6 Months)
        $monthlyRevenueLabels = [];
        $monthlyRevenueData = [];
        $allInvoices = $invoiceModel->findAll();
        for ($m = 5; $m >= 0; $m--) {
            $mKey = date('Y-m', strtotime("-{$m} months"));
            $monthlyRevenueLabels[] = date('M Y', strtotime("-{$m} months"));
            $mSum = 0.0;
            foreach ($allInvoices as $inv) {
                if (substr($inv['invoice_date'], 0, 7) === $mKey && $inv['status'] !== 'cancelled') {
                    $mSum += (float) ($inv['amount_paid'] ?? 0);
                }
            }
            $monthlyRevenueData[] = $mSum;
        }

        // C. Service-wise Revenue Breakdown
        $serviceRevenueMap = [];
        foreach ($allBookings as $b) {
            if (in_array($b['status'], ['completed', 'confirmed'])) {
                $srv = $b['service_name'] ?: 'Other Services';
                if (!isset($serviceRevenueMap[$srv])) $serviceRevenueMap[$srv] = 0.0;
                $serviceRevenueMap[$srv] += (float) ($b['service_price'] ?? 0);
            }
        }
        arsort($serviceRevenueMap);
        $topServices = array_slice($serviceRevenueMap, 0, 5, true);
        $serviceLabels = array_keys($topServices);
        $serviceData = array_values($topServices);

        // D. Lead Conversion Funnel
        $allLeads = $leadModel->findAll();
        $pipelineCounts = [
            'New'          => 0,
            'Contacted'    => 0,
            'Follow-up'    => 0,
            'Interested'   => 0,
            'Confirmed'    => 0,
            'Converted'    => 0,
            'Lost'         => 0,
        ];
        foreach ($allLeads as $l) {
            $st = $l['status'];
            if ($st === 'new') $pipelineCounts['New']++;
            elseif ($st === 'contacted') $pipelineCounts['Contacted']++;
            elseif ($st === 'follow_up') $pipelineCounts['Follow-up']++;
            elseif ($st === 'interested') $pipelineCounts['Interested']++;
            elseif ($st === 'booking_confirmed') $pipelineCounts['Confirmed']++;
            elseif ($st === 'converted') $pipelineCounts['Converted']++;
            elseif ($st === 'lost') $pipelineCounts['Lost']++;
        }

        // E. Booking Status Breakdown
        $bookingStatusCounts = [
            'Confirmed'   => 0,
            'Completed'   => 0,
            'Pending'     => 0,
            'In Progress' => 0,
            'Cancelled'   => 0,
        ];
        foreach ($allBookings as $b) {
            if ($b['status'] === 'confirmed') $bookingStatusCounts['Confirmed']++;
            elseif ($b['status'] === 'completed') $bookingStatusCounts['Completed']++;
            elseif ($b['status'] === 'pending') $bookingStatusCounts['Pending']++;
            elseif ($b['status'] === 'in_progress') $bookingStatusCounts['In Progress']++;
            elseif ($b['status'] === 'cancelled') $bookingStatusCounts['Cancelled']++;
        }

        // F. Payment Status Breakdown
        $paymentStatusCounts = [
            'Paid'           => $paidInvoices,
            'Partially Paid' => 0,
            'Unpaid / Sent'  => 0,
            'Overdue'        => $overdueInvoices,
        ];
        foreach ($allInvoices as $inv) {
            if ($inv['status'] === 'partially_paid') $paymentStatusCounts['Partially Paid']++;
            elseif ($inv['status'] === 'sent' || $inv['status'] === 'draft') $paymentStatusCounts['Unpaid / Sent']++;
        }

        // Recent Activity Lists
        $recentBookings = $bookingModel->orderBy('id', 'DESC')->limit(5)->findAll();
        $recentLeads = $leadModel->orderBy('id', 'DESC')->limit(5)->findAll();
        $recentInvoices = $invoiceModel->orderBy('id', 'DESC')->limit(5)->findAll();
        $todayFollowUps = $followUpModel->where('follow_up_date', $today)->where('status', 'pending')->findAll();

        return view('admin/pages/dashboard', [
            'pageTitle'             => 'Executive Studio Dashboard | Glowup Admin',
            'pageHeading'           => 'Salon & Business Intelligence Dashboard',
            'pageIcon'              => 'dashboard',
            'breadcrumbSection'     => 'Main',
            'breadcrumbTitle'       => 'Dashboard',
            'activeMenu'            => 'dashboard',
            'admin'                 => $admin,
            // KPIs
            'todayBookings'         => $todayBookings,
            'upcomingAppointments'  => $upcomingAppointments,
            'completedServices'     => $completedServices,
            'pendingServices'       => $pendingServices,
            'cancelledBookings'     => $cancelledBookings,
            'newEnquiries'          => $newEnquiries,
            'newLeads'              => $newLeads,
            'newCustomers'          => $newCustomers,
            'academyEnquiries'      => $academyEnquiries,
            'bridalEnquiries'       => $bridalEnquiries,
            'revenue'               => $totalRevenue,
            'pendingPayments'       => $pendingPayments,
            'paidInvoices'          => $paidInvoices,
            'unpaidInvoices'        => $unpaidInvoices,
            'overdueInvoices'       => $overdueInvoices,
            'offersActive'          => $activeOffers,
            'whatsappSent'          => $whatsappSent,
            'smsSent'               => $smsSent,
            'emailSent'             => $emailSent,
            // Charts
            'dailyBookingsLabels'   => $dailyBookingsLabels,
            'dailyBookingsData'     => $dailyBookingsData,
            'monthlyRevenueLabels'  => $monthlyRevenueLabels,
            'monthlyRevenueData'    => $monthlyRevenueData,
            'serviceLabels'         => $serviceLabels,
            'serviceData'           => $serviceData,
            'pipelineCounts'        => $pipelineCounts,
            'bookingStatusCounts'   => $bookingStatusCounts,
            'paymentStatusCounts'   => $paymentStatusCounts,
            // Recent Lists
            'recentBookings'        => $recentBookings,
            'recentLeads'           => $recentLeads,
            'recentInvoices'        => $recentInvoices,
            'todayFollowUps'        => $todayFollowUps,
        ]);
    }
}
