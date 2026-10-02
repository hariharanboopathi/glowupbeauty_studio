<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\EmailTemplateModel;

class EmailTemplateController extends BaseController
{
    protected AdminAuth $auth;
    protected EmailTemplateModel $templateModel;

    public function __construct()
    {
        $this->auth = new AdminAuth();
        $this->templateModel = new EmailTemplateModel();
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

    public function index()
    {
        $templates = $this->templateModel->orderBy('id', 'ASC')->findAll();

        return view('admin/pages/email_templates', [
            'pageTitle'         => 'Email Templates | Glowup Admin',
            'pageHeading'       => 'Automated Email Templates',
            'pageIcon'          => 'mail',
            'breadcrumbSection' => 'Settings',
            'breadcrumbTitle'   => 'Email Templates',
            'activeMenu'        => 'email_templates',
            'admin'             => $this->getAdminData(),
            'templates'         => $templates,
        ]);
    }

    public function save()
    {
        $id = (int) $this->request->getPost('id');
        $tpl = $this->templateModel->find($id);
        if (!$tpl) {
            return redirect()->back()->with('error', 'Template not found.');
        }

        $subject   = trim((string) $this->request->getPost('subject'));
        $bodyHtml  = trim((string) $this->request->getPost('body_html'));
        $isActive  = $this->request->getPost('is_active') ? 1 : 0;

        if (empty($subject) || empty($bodyHtml)) {
            return redirect()->back()->with('error', 'Subject and email body are required.');
        }

        $this->templateModel->update($id, [
            'subject'    => $subject,
            'body_html'  => $bodyHtml,
            'is_active'  => $isActive,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('admin/settings/email-templates'))
            ->with('success', "Template '{$tpl['title']}' updated successfully.");
    }

    public function preview($id)
    {
        $tpl = $this->templateModel->find($id);
        if (!$tpl) {
            return $this->response->setJSON(['error' => 'Template not found']);
        }

        $sampleData = [
            'customer_name'     => 'Meera Rajput',
            'business_name'     => 'Glowup Beauty Studio & Academy',
            'booking_date'      => date('d F Y', strtotime('+2 days')),
            'booking_time'      => '11:30 AM',
            'booking_code'      => 'BK-2026-8899',
            'service_name'      => 'Royal HydraFacial & Gold Radiance',
            'invoice_number'    => 'INV-2026-0042',
            'invoice_total'     => '4,500.00',
            'balance_due'       => '0.00',
            'offer_title'       => 'Diwali Bridal Radiance – 20% OFF',
            'offer_description' => 'Indulge in our signature bridal grooming ritual with 20% privilege savings.',
            'coupon_code'       => 'GLOWBRIDE20',
            'reset_url'         => base_url('customer/reset-password?token=sample_token_xyz'),
        ];

        $rendered = $this->templateModel->renderTemplate($tpl['template_key'], $sampleData);

        return $this->response->setJSON([
            'title'   => $tpl['title'],
            'subject' => $rendered['subject'],
            'body'    => $rendered['body'],
        ]);
    }
}
