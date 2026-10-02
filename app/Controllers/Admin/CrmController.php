<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\LeadModel;
use App\Models\FollowUpModel;
use App\Models\CustomerModel;

class CrmController extends BaseController
{
    protected AdminAuth $auth;
    protected LeadModel $leadModel;
    protected FollowUpModel $followUpModel;
    protected CustomerModel $customerModel;

    public function __construct()
    {
        $this->auth          = new AdminAuth();
        $this->leadModel     = new LeadModel();
        $this->followUpModel = new FollowUpModel();
        $this->customerModel = new CustomerModel();
    }

    protected function getAdminData(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Alex Vance',
            'role'   => 'Super Administrator',
            'avatar' => 'AV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /* =========================================================================
     * 1. LEADS PIPELINE MODULE (/admin/crm/leads)
     * ========================================================================= */
    public function leads()
    {
        $status = $this->request->getGet('status') ?: 'all';
        $search = trim((string) $this->request->getGet('q'));

        $builder = $this->leadModel->orderBy('id', 'DESC');

        if ($status !== 'all' && !empty($status)) {
            $builder->where('status', $status);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('phone', $search)
                    ->orLike('email', $search)
                    ->orLike('service_interested', $search)
                    ->orLike('source', $search)
                    ->groupEnd();
        }

        $leads = $builder->findAll();
        $stats = $this->leadModel->getLeadStatistics();

        // Calculate conversion percentage
        $conversionRate = $stats['total'] > 0 ? round(($stats['converted'] / $stats['total']) * 100, 1) : 0;

        return view('admin/pages/crm_leads', [
            'pageTitle'         => 'Leads & Sales Pipeline | Glowup Admin',
            'pageHeading'       => 'Client Acquisition Pipeline',
            'pageIcon'          => 'funnel',
            'breadcrumbSection' => 'CRM',
            'breadcrumbTitle'   => 'Leads Pipeline',
            'activeMenu'        => 'crm_leads',
            'admin'             => $this->getAdminData(),
            'leads'             => $leads,
            'currentStatus'     => $status,
            'searchQuery'       => $search,
            'stats'             => $stats,
            'conversionRate'    => $conversionRate,
        ]);
    }

    public function saveLead()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'name'  => 'required|min_length[2]|max_length[150]',
            'phone' => 'required|min_length[5]|max_length[50]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid lead name and telephone number.');
        }

        $data = [
            'name'               => trim((string) $this->request->getPost('name')),
            'phone'              => trim((string) $this->request->getPost('phone')),
            'whatsapp'           => trim((string) $this->request->getPost('whatsapp')) ?: trim((string) $this->request->getPost('phone')),
            'email'              => trim((string) $this->request->getPost('email')) ?: null,
            'service_interested' => trim((string) $this->request->getPost('service_interested')),
            'source'             => trim((string) $this->request->getPost('source')) ?: 'Manual Admin Entry',
            'campaign'           => trim((string) $this->request->getPost('campaign')),
            'notes'              => trim((string) $this->request->getPost('notes')),
            'status'             => trim((string) $this->request->getPost('status')) ?: 'new',
            'assigned_staff'     => trim((string) $this->request->getPost('assigned_staff')) ?: 'Priya Varma',
        ];

        if ($id > 0) {
            $this->leadModel->update($id, $data);
            $msg = 'Lead record updated in pipeline.';
        } else {
            $this->leadModel->insert($data);
            $msg = 'New prospect successfully captured into pipeline.';
        }

        // Schedule initial follow-up if requested
        $followDate = $this->request->getPost('schedule_followup_date');
        if (!empty($followDate)) {
            $leadId = $id > 0 ? $id : $this->leadModel->getInsertID();
            $this->followUpModel->insert([
                'lead_id'            => $leadId,
                'contact_name'       => $data['name'],
                'contact_phone'      => $data['phone'],
                'service_interested' => $data['service_interested'],
                'follow_up_date'     => $followDate,
                'follow_up_time'     => $this->request->getPost('schedule_followup_time') ?: '11:00 AM',
                'notes'              => 'Initial consultation inquiry follow-up.',
                'status'             => 'pending',
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to(base_url('admin/crm/leads'))->with('success', $msg);
    }

    public function updateLeadStatus($id)
    {
        $lead = $this->leadModel->find($id);
        if (!$lead) {
            return redirect()->back()->with('error', 'Lead not found.');
        }

        $newStatus = trim((string) $this->request->getPost('status'));
        $validStatuses = ['new', 'contacted', 'follow_up', 'interested', 'booking_confirmed', 'converted', 'lost'];

        if (in_array($newStatus, $validStatuses)) {
            $this->leadModel->update($id, ['status' => $newStatus]);
            return redirect()->back()->with('success', "Lead moved to " . ucfirst(str_replace('_', ' ', $newStatus)));
        }

        return redirect()->back()->with('error', 'Invalid status specified.');
    }

    public function convertLead($id)
    {
        $lead = $this->leadModel->find($id);
        if (!$lead) {
            return redirect()->back()->with('error', 'Lead record not found.');
        }

        // Check if customer already exists by email or phone
        $existing = null;
        if (!empty($lead['email'])) {
            $existing = $this->customerModel->where('email', $lead['email'])->first();
        }
        if (!$existing && !empty($lead['phone'])) {
            $existing = $this->customerModel->where('phone', $lead['phone'])->first();
        }

        if ($existing) {
            $customerId = $existing['id'];
        } else {
            $customerId = $this->customerModel->insert([
                'name'               => $lead['name'],
                'email'              => $lead['email'] ?: ('lead_' . $id . '@glowup.customer'),
                'phone'              => $lead['phone'],
                'whatsapp_number'    => $lead['whatsapp'] ?: $lead['phone'],
                'lead_source'        => $lead['source'],
                'preferred_services' => $lead['service_interested'],
                'notes'              => "Converted from Lead #{$id} ({$lead['source']}). Campaign: {$lead['campaign']}. Notes: {$lead['notes']}",
                'tags'               => 'Converted Lead, New Patron',
                'customer_status'    => 'active',
                'status'             => 1,
                'password'           => password_hash('Patron@123', PASSWORD_DEFAULT),
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);
        }

        // Update lead status to converted and preserve linkage
        $this->leadModel->update($id, [
            'status'      => 'converted',
            'customer_id' => $customerId,
        ]);

        return redirect()->to(base_url('admin/customers/' . $customerId))
            ->with('success', "Lead successfully converted to Customer #GLW-{$customerId}!");
    }

    public function deleteLead($id)
    {
        $this->leadModel->delete($id);
        return redirect()->to(base_url('admin/crm/leads'))->with('success', 'Lead record deleted.');
    }

    /* =========================================================================
     * 2. FOLLOW-UPS MODULE (/admin/crm/followups)
     * ========================================================================= */
    public function followUps()
    {
        $filter = $this->request->getGet('filter') ?: 'all';
        $today  = date('Y-m-d');

        $builder = $this->followUpModel->orderBy('follow_up_date', 'ASC')->orderBy('follow_up_time', 'ASC');

        if ($filter === 'today') {
            $builder->where('follow_up_date', $today);
        } elseif ($filter === 'upcoming') {
            $builder->where('follow_up_date >=', $today)->where('status', 'pending');
        } elseif ($filter === 'completed') {
            $builder->where('status', 'completed');
        }

        $followUps = $builder->findAll();

        $stats = [
            'total'     => $this->followUpModel->countAllResults(),
            'today'     => $this->followUpModel->where('follow_up_date', $today)->countAllResults(),
            'pending'   => $this->followUpModel->where('status', 'pending')->countAllResults(),
            'completed' => $this->followUpModel->where('status', 'completed')->countAllResults(),
        ];

        return view('admin/pages/crm_followups', [
            'pageTitle'         => 'Follow-ups & Consultations | Glowup Admin',
            'pageHeading'       => 'Client Follow-ups & Reminders',
            'pageIcon'          => 'alarm',
            'breadcrumbSection' => 'CRM',
            'breadcrumbTitle'   => 'Follow-ups',
            'activeMenu'        => 'crm_followups',
            'admin'             => $this->getAdminData(),
            'followUps'         => $followUps,
            'currentFilter'     => $filter,
            'stats'             => $stats,
        ]);
    }

    public function saveFollowUp()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'contact_name'   => 'required|min_length[2]|max_length[150]',
            'follow_up_date' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Contact name and follow-up date are required.');
        }

        $data = [
            'contact_name'       => trim((string) $this->request->getPost('contact_name')),
            'contact_phone'      => trim((string) $this->request->getPost('contact_phone')),
            'service_interested' => trim((string) $this->request->getPost('service_interested')),
            'follow_up_date'     => $this->request->getPost('follow_up_date'),
            'follow_up_time'     => trim((string) $this->request->getPost('follow_up_time')) ?: '10:00 AM',
            'notes'              => trim((string) $this->request->getPost('notes')),
            'status'             => trim((string) $this->request->getPost('status')) ?: 'pending',
        ];

        if ($id > 0) {
            $this->followUpModel->update($id, $data);
            $msg = 'Follow-up appointment updated.';
        } else {
            $this->followUpModel->insert($data);
            $msg = 'New client follow-up scheduled.';
        }

        return redirect()->to(base_url('admin/crm/followups'))->with('success', $msg);
    }

    public function completeFollowUp($id)
    {
        $fu = $this->followUpModel->find($id);
        if ($fu) {
            $this->followUpModel->update($id, ['status' => 'completed']);
            return redirect()->back()->with('success', 'Follow-up marked as completed.');
        }
        return redirect()->back()->with('error', 'Follow-up not found.');
    }

    public function deleteFollowUp($id)
    {
        $this->followUpModel->delete($id);
        return redirect()->to(base_url('admin/crm/followups'))->with('success', 'Follow-up removed.');
    }
}
