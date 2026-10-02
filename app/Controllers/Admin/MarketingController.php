<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\OfferModel;
use App\Models\CustomerModel;
use App\Models\LeadModel;
use App\Models\EmailTemplateModel;
use App\Models\CommunicationLogModel;
use App\Models\ServiceModel;
use App\Libraries\WhatsAppService;
use App\Libraries\SmsService;
use App\Libraries\EmailService;

class MarketingController extends BaseController
{
    protected AdminAuth $auth;
    protected OfferModel $offerModel;
    protected CustomerModel $customerModel;
    protected LeadModel $leadModel;
    protected EmailTemplateModel $templateModel;
    protected CommunicationLogModel $commLogModel;
    protected ServiceModel $serviceModel;
    protected WhatsAppService $whatsappService;
    protected SmsService $smsService;
    protected EmailService $emailService;

    public function __construct()
    {
        $this->auth             = new AdminAuth();
        $this->offerModel       = new OfferModel();
        $this->customerModel    = new CustomerModel();
        $this->leadModel        = new LeadModel();
        $this->templateModel    = new EmailTemplateModel();
        $this->commLogModel     = new CommunicationLogModel();
        $this->serviceModel     = new ServiceModel();
        $this->whatsappService  = new WhatsAppService();
        $this->smsService       = new SmsService();
        $this->emailService     = new EmailService();
    }

    protected function getAdminData(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Elena Vance',
            'role'   => 'Marketing & Salon Director',
            'avatar' => 'EV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /* =========================================================================
     * 1. OFFERS MANAGEMENT (Marketing -> Offers)
     * ========================================================================= */
    public function offers()
    {
        $today   = date('Y-m-d');
        $offers  = $this->offerModel->orderBy('id', 'DESC')->findAll();
        $services= $this->serviceModel->where('is_active', 1)->orderBy('name', 'ASC')->findAll();

        $stats = [
            'total'      => count($offers),
            'active_now' => 0,
            'frontend'   => 0,
            'expired'    => 0,
        ];

        foreach ($offers as $o) {
            $isActive = ($o['is_active'] == 1 && $o['start_date'] <= $today && $o['end_date'] >= $today);
            if ($isActive) {
                $stats['active_now']++;
                if (!empty($o['featured_on_frontend'])) {
                    $stats['frontend']++;
                }
            }
            if ($o['end_date'] < $today) {
                $stats['expired']++;
            }
        }

        return view('admin/pages/offers', [
            'pageTitle'         => 'Promotional Offers | Glowup Admin',
            'pageHeading'       => 'Promotions, Privileges & Deals',
            'pageIcon'          => 'local_offer',
            'breadcrumbSection' => 'Marketing',
            'breadcrumbTitle'   => 'Offers',
            'activeMenu'        => 'offers',
            'admin'             => $this->getAdminData(),
            'offers'            => $offers,
            'services'          => $services,
            'stats'             => $stats,
        ]);
    }

    public function saveOffer()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'name'        => 'required|min_length[2]|max_length[150]',
            'title'       => 'required|min_length[2]|max_length[200]',
            'start_date'  => 'required|valid_date',
            'end_date'    => 'required|valid_date',
            'coupon_code' => 'required|min_length[3]|max_length[50]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid offer title, coupon code, and dates.');
        }

        $data = [
            'name'                 => trim((string) $this->request->getPost('name')),
            'title'                => trim((string) $this->request->getPost('title')),
            'description'          => trim((string) $this->request->getPost('description')),
            'discount_type'        => $this->request->getPost('discount_type') ?: 'percentage',
            'discount_value'       => (float) $this->request->getPost('discount_value'),
            'coupon_code'          => strtoupper(trim((string) $this->request->getPost('coupon_code'))),
            'target_service'       => trim((string) $this->request->getPost('target_service')) ?: 'All Treatments',
            'target_segment'       => $this->request->getPost('target_segment') ?: 'all',
            'start_date'           => $this->request->getPost('start_date'),
            'end_date'             => $this->request->getPost('end_date'),
            'is_active'            => $this->request->getPost('is_active') ? 1 : 0,
            'featured_on_frontend' => $this->request->getPost('featured_on_frontend') ? 1 : 0,
        ];

        // Banner Image Upload
        $img = $this->request->getFile('banner_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/offers/', $newName);
            $data['banner_image'] = 'uploads/offers/' . $newName;
        }

        if ($id > 0) {
            $this->offerModel->update($id, $data);
            $msg = 'Offer updated successfully.';
        } else {
            $this->offerModel->insert($data);
            $msg = 'New promotional offer activated.';
        }

        return redirect()->to(base_url('admin/marketing/offers'))->with('success', $msg);
    }

    public function toggleOffer($id)
    {
        $offer = $this->offerModel->find($id);
        if ($offer) {
            $newStatus = ($offer['is_active'] == 1) ? 0 : 1;
            $this->offerModel->update($id, ['is_active' => $newStatus]);
            return redirect()->back()->with('success', 'Offer status toggled.');
        }
        return redirect()->back()->with('error', 'Offer not found.');
    }

    public function deleteOffer($id)
    {
        $this->offerModel->delete($id);
        return redirect()->to(base_url('admin/marketing/offers'))->with('success', 'Offer deleted.');
    }

    /* =========================================================================
     * 2. COMMUNICATION CENTER (Marketing -> Communication Center)
     * ========================================================================= */
    public function communicationCenter()
    {
        $logs = $this->commLogModel->orderBy('id', 'DESC')->limit(100)->findAll();
        $logStats = $this->commLogModel->getChannelStatistics();

        $customers = $this->customerModel->orderBy('name', 'ASC')->findAll();
        $leads     = $this->leadModel->where('status !=', 'converted')->orderBy('id', 'DESC')->findAll();
        $templates = $this->templateModel->where('is_active', 1)->findAll();
        $offers    = $this->offerModel->getActiveFrontendOffers();

        // Dynamically compute segment counts
        $today = date('Y-m-d');
        $thirtyDaysAgo = date('Y-m-d H:i:s', strtotime('-30 days'));
        $sixtyDaysAgo  = date('Y-m-d H:i:s', strtotime('-60 days'));

        $db = \Config\Database::connect();

        // Returning patrons: customers who have > 1 booking
        $returningRows = $db->table('bookings')
            ->select('customer_id')
            ->where('customer_id IS NOT NULL')
            ->groupBy('customer_id')
            ->having('COUNT(id) > 1')
            ->get()->getResultArray();
        $returningCount = count($returningRows);

        // VIP patrons: VIP status or total invoice spending >= 5000
        $vipRows = $db->table('invoices')
            ->select('customer_id')
            ->where('customer_id IS NOT NULL')
            ->groupBy('customer_id')
            ->having('SUM(amount_paid) >= 5000')
            ->get()->getResultArray();
        $vipCustIds = !empty($vipRows) ? array_column($vipRows, 'customer_id') : [];
        $vipBuilder = $this->customerModel->groupStart()->where('customer_status', 'vip');
        if (!empty($vipCustIds)) {
            $vipBuilder->orWhereIn('id', $vipCustIds);
        }
        $vipCount = $vipBuilder->groupEnd()->countAllResults();

        // Inactive: no bookings in the last 60 days
        $activeCustRows = $db->table('bookings')
            ->select('customer_id')
            ->where('customer_id IS NOT NULL')
            ->where('booking_date >=', date('Y-m-d', strtotime('-60 days')))
            ->groupBy('customer_id')
            ->get()->getResultArray();
        $activeCustIds = !empty($activeCustRows) ? array_column($activeCustRows, 'customer_id') : [0];
        $inactiveCount = $this->customerModel->whereNotIn('id', $activeCustIds)->countAllResults();

        $segments = [
            'all' => [
                'name'  => 'All Valued Patrons',
                'count' => count($customers),
                'desc'  => 'Complete client directory',
            ],
            'new' => [
                'name'  => 'New Customers',
                'count' => $this->customerModel->where('created_at >=', $thirtyDaysAgo)->countAllResults(),
                'desc'  => 'Onboarded within the last 30 days',
            ],
            'returning' => [
                'name'  => 'Returning Patrons',
                'count' => $returningCount,
                'desc'  => 'Clients with 2 or more salon appointments',
            ],
            'bridal' => [
                'name'  => 'Bridal Clients',
                'count' => $this->customerModel->groupStart()->like('preferred_services', 'Bridal')->orLike('tags', 'Bridal')->groupEnd()->countAllResults(),
                'desc'  => 'Haute bridal and wedding inquiries',
            ],
            'academy' => [
                'name'  => 'Academy Students',
                'count' => $this->customerModel->groupStart()->like('tags', 'Academy')->orLike('tags', 'Student')->groupEnd()->countAllResults(),
                'desc'  => 'Course enrollees and certification aspirants',
            ],
            'vip' => [
                'name'  => 'High-Value VIP Clients',
                'count' => $vipCount,
                'desc'  => 'Patrons with ₹5,000+ spend or VIP distinction',
            ],
            'inactive' => [
                'name'  => 'Inactive Patrons',
                'count' => $inactiveCount,
                'desc'  => 'No visits in the past 60 days',
            ],
            'leads' => [
                'name'  => 'Inbound Pipeline Leads',
                'count' => count($leads),
                'desc'  => 'Unconverted prospective clients awaiting booking',
            ],
        ];

        return view('admin/pages/communication_center', [
            'pageTitle'         => 'Communication Center | Glowup Admin',
            'pageHeading'       => 'Broadcast & Client Communication Center',
            'pageIcon'          => 'campaign',
            'breadcrumbSection' => 'Marketing',
            'breadcrumbTitle'   => 'Communication Center',
            'activeMenu'        => 'communication_center',
            'admin'             => $this->getAdminData(),
            'logs'              => $logs,
            'logStats'          => $logStats,
            'customers'         => $customers,
            'leads'             => $leads,
            'templates'         => $templates,
            'offers'            => $offers,
            'segments'          => $segments,
        ]);
    }

    /**
     * Dispatch Communication to Recipients
     */
    public function sendMessage()
    {
        $targetType = $this->request->getPost('target_type') ?: 'customer'; // customer, lead, segment, all
        $channel    = $this->request->getPost('channel') ?: 'whatsapp';     // whatsapp, email, sms
        $subject    = trim((string) $this->request->getPost('subject')) ?: 'Notification from Glowup Beauty Studio';
        $message    = trim((string) $this->request->getPost('message'));

        if (empty($message)) {
            return redirect()->back()->withInput()->with('error', 'Please provide message content to dispatch.');
        }

        $recipients = [];

        if ($targetType === 'customer') {
            $custId = (int) $this->request->getPost('customer_id');
            $cust = $this->customerModel->find($custId);
            if ($cust) {
                $recipients[] = [
                    'id'      => $cust['id'],
                    'name'    => $cust['name'],
                    'phone'   => $cust['whatsapp_number'] ?: $cust['phone'],
                    'email'   => $cust['email'],
                    'is_lead' => false,
                ];
            }
        } elseif ($targetType === 'lead') {
            $leadId = (int) $this->request->getPost('lead_id');
            $lead = $this->leadModel->find($leadId);
            if ($lead) {
                $recipients[] = [
                    'id'      => $lead['id'],
                    'name'    => $lead['name'],
                    'phone'   => $lead['whatsapp'] ?: $lead['phone'],
                    'email'   => $lead['email'],
                    'is_lead' => true,
                ];
            }
        } elseif ($targetType === 'segment') {
            $segment = $this->request->getPost('segment');
            if ($segment === 'leads') {
                $leads = $this->leadModel->where('status !=', 'converted')->findAll();
                foreach ($leads as $l) {
                    $recipients[] = [
                        'id'      => $l['id'],
                        'name'    => $l['name'],
                        'phone'   => $l['whatsapp'] ?: $l['phone'],
                        'email'   => $l['email'],
                        'is_lead' => true,
                    ];
                }
            } else {
                $builder = $this->customerModel->where('status', 1);
                if ($segment === 'bridal') {
                    $builder->groupStart()->like('preferred_services', 'Bridal')->orLike('tags', 'Bridal')->groupEnd();
                } elseif ($segment === 'vip') {
                    $builder->where('customer_status', 'vip');
                } elseif ($segment === 'new') {
                    $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-30 days')));
                } elseif ($segment === 'returning') {
                    $retIds = $db->table('bookings')->select('customer_id')->where('customer_id IS NOT NULL')->groupBy('customer_id')->having('COUNT(id) > 1')->get()->getResultArray();
                    $retList = !empty($retIds) ? array_column($retIds, 'customer_id') : [0];
                    $builder->whereIn('id', $retList);
                }
                $custs = $builder->findAll();
                foreach ($custs as $c) {
                    $recipients[] = [
                        'id'      => $c['id'],
                        'name'    => $c['name'],
                        'phone'   => $c['whatsapp_number'] ?: $c['phone'],
                        'email'   => $c['email'],
                        'is_lead' => false,
                    ];
                }
            }
        } elseif ($targetType === 'all') {
            $custs = $this->customerModel->where('status', 1)->findAll();
            foreach ($custs as $c) {
                $recipients[] = [
                    'id'      => $c['id'],
                    'name'    => $c['name'],
                    'phone'   => $c['whatsapp_number'] ?: $c['phone'],
                    'email'   => $c['email'],
                    'is_lead' => false,
                ];
            }
        }

        if (empty($recipients)) {
            return redirect()->back()->with('error', 'No eligible recipients found for this selection.');
        }

        $sentCount = 0;
        $failCount = 0;

        foreach ($recipients as $rec) {
            // Replace personalized tokens
            $personalMsg = str_replace('{{customer_name}}', $rec['name'], $message);
            $personalMsg = str_replace('{{business_name}}', 'Glowup Beauty Studio & Academy', $personalMsg);

            $contact = ($channel === 'email') ? ($rec['email'] ?? '') : ($rec['phone'] ?? '');

            if (empty($contact)) {
                $failCount++;
                continue;
            }

            if ($channel === 'whatsapp') {
                $res = $this->whatsappService->sendMessage($rec['phone'], $personalMsg, $rec['name'], $rec['id']);
                if ($res['success']) $sentCount++; else $failCount++;
            } elseif ($channel === 'sms') {
                $res = $this->smsService->sendSms($rec['phone'], $personalMsg, $rec['name'], $rec['id']);
                if ($res['success']) $sentCount++; else $failCount++;
            } elseif ($channel === 'email') {
                $res = $this->emailService->sendMail($rec['email'], $subject, "<p>" . nl2br(esc($personalMsg)) . "</p>", $rec['name'], $rec['id']);
                if ($res['success']) $sentCount++; else $failCount++;
            }
        }

        $statusMsg = "Dispatch initiated: {$sentCount} sent successfully via " . ucfirst($channel) . ".";
        if ($failCount > 0) {
            $statusMsg .= " ({$failCount} pending/failed due to missing contact or gateway configuration).";
        }

        return redirect()->to(base_url('admin/marketing/communication-center'))->with('success', $statusMsg);
    }
}
