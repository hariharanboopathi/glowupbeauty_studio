<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\EnquiryModel;

class EnquiryController extends BaseController
{
    protected AdminAuth $auth;
    protected EnquiryModel $enquiryModel;

    public function __construct()
    {
        $this->auth         = new AdminAuth();
        $this->enquiryModel = new EnquiryModel();
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

    /**
     * Enquiries Management Console (/admin/enquiry)
     */
    public function index()
    {
        $status = $this->request->getGet('status') ?: 'all';
        $search = trim((string) $this->request->getGet('q'));

        $builder = $this->enquiryModel->orderBy('id', 'DESC');

        if ($status !== 'all' && !empty($status)) {
            $builder->where('status', $status);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search)
                    ->orLike('subject', $search)
                    ->orLike('message', $search)
                    ->groupEnd();
        }

        $enquiries = $builder->findAll();

        $stats = $this->enquiryModel->getStatistics();

        return view('admin/pages/enquiries', [
            'pageTitle'         => 'Concierge Enquiries | Glowup Admin',
            'pageHeading'       => 'Client & Concierge Inquiries',
            'pageIcon'          => 'mail',
            'breadcrumbSection' => 'Customer Relations',
            'breadcrumbTitle'   => 'Enquiries',
            'activeMenu'        => 'enquiry',
            'admin'             => $this->getAdminData(),
            'enquiries'         => $enquiries,
            'currentStatus'     => $status,
            'searchQuery'       => $search,
            'stats'             => $stats,
        ]);
    }

    /**
     * Get Enquiry Details via AJAX
     */
    public function details($id)
    {
        $enquiry = $this->enquiryModel->find($id);
        if (!$enquiry) {
            return $this->response->setJSON(['status' => false, 'message' => 'Enquiry not found']);
        }

        // Automatically mark as read if it was new
        if ($enquiry['status'] === 'new') {
            $this->enquiryModel->update($id, ['status' => 'read']);
            $enquiry['status'] = 'read';
        }

        return $this->response->setJSON([
            'status'  => true,
            'enquiry' => $enquiry,
        ]);
    }

    /**
     * Update Enquiry Status & Notes
     */
    public function updateStatus($id)
    {
        $enquiry = $this->enquiryModel->find($id);
        if (!$enquiry) {
            return redirect()->back()->with('error', 'Enquiry record not found.');
        }

        $status = trim((string) $this->request->getPost('status'));
        $notes  = trim((string) $this->request->getPost('admin_notes'));

        $this->enquiryModel->update($id, [
            'status'      => in_array($status, ['new', 'read', 'replied']) ? $status : 'read',
            'admin_notes' => $notes,
        ]);

        return redirect()->back()->with('success', 'Inquiry status updated successfully.');
    }

    /**
     * Convert Enquiry to CRM Lead
     */
    public function convertToLead($id)
    {
        $enquiry = $this->enquiryModel->find($id);
        if (!$enquiry) {
            return redirect()->back()->with('error', 'Enquiry record not found.');
        }

        $leadModel = new \App\Models\LeadModel();
        
        // Determine source based on subject
        $subject = strtolower($enquiry['subject'] ?? '');
        $source = 'Website Enquiry';
        if (strpos($subject, 'bridal') !== false) {
            $source = 'Bridal Enquiry';
        } elseif (strpos($subject, 'academy') !== false) {
            $source = 'Academy Enquiry';
        }

        $leadId = $leadModel->insert([
            'name'               => $enquiry['name'],
            'phone'              => $enquiry['phone'] ?: '',
            'whatsapp'           => $enquiry['phone'] ?: '',
            'email'              => $enquiry['email'],
            'service_interested' => $enquiry['subject'] ?: 'General Consultation',
            'source'             => $source,
            'campaign'           => 'Organic Concierge',
            'notes'              => "Converted from Inquiry #{$id}: " . $enquiry['message'],
            'status'             => 'new',
            'created_at'         => date('Y-m-d H:i:s'),
            'updated_at'         => date('Y-m-d H:i:s'),
        ]);

        $this->enquiryModel->update($id, [
            'status'      => 'read',
            'admin_notes' => 'Converted to CRM Lead #' . $leadId . ' on ' . date('Y-m-d H:i'),
        ]);

        return redirect()->to(base_url('admin/crm/leads'))->with('success', "Inquiry from \"{$enquiry['name']}\" converted to CRM Lead #{$leadId} successfully!");
    }

    /**
     * Delete Enquiry
     */
    public function delete($id)
    {
        $enquiry = $this->enquiryModel->find($id);
        if ($enquiry) {
            $this->enquiryModel->delete($id);
            return redirect()->back()->with('success', 'Inquiry record removed.');
        }
        return redirect()->back()->with('error', 'Inquiry record not found.');
    }
}
