<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    protected AdminAuth $auth;
    protected CustomerModel $customerModel;

    public function __construct()
    {
        $this->auth = new AdminAuth();
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

    /**
     * Admin: Customer List & Management
     */
    public function index()
    {
        $search = trim((string) $this->request->getGet('search'));
        $status = $this->request->getGet('status');
        if ($status !== null && $status !== '' && $status !== 'all') {
            $status = (string) (int) $status;
        } else {
            $status = null;
        }

        $page = max(1, (int) $this->request->getGet('page'));
        $perPage = 15;
        $offset = ($page - 1) * $perPage;

        $customers = $this->customerModel->getFilteredCustomers($search, $status, $perPage, $offset);
        $totalMatching = $this->customerModel->getFilteredCount($search, $status);
        $totalPages = max(1, (int) ceil($totalMatching / $perPage));

        // Quick aggregate statistics
        $db = \Config\Database::connect();
        $totalAll = $db->table('customers')->countAllResults();
        $totalActive = $db->table('customers')->where('status', 1)->countAllResults();
        $totalInactive = $db->table('customers')->where('status', 0)->countAllResults();
        $totalGoogle = $db->table('customers')->where('login_provider', 'google')->countAllResults();

        return view('admin/pages/website_customer', [
            'pageTitle'         => 'Customer Management | Glowup Admin',
            'pageHeading'       => 'Customer Management',
            'pageIcon'          => 'people',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'Customer',
            'activeMenu'        => 'website_customer',
            'admin'             => $this->getAdminData(),
            'customers'         => $customers,
            'search'            => $search,
            'statusFilter'      => $status,
            'currentPage'       => $page,
            'totalPages'        => $totalPages,
            'totalMatching'     => $totalMatching,
            'perPage'           => $perPage,
            'stats'             => [
                'total'    => $totalAll,
                'active'   => $totalActive,
                'inactive' => $totalInactive,
                'google'   => $totalGoogle,
            ],
        ]);
    }

    /**
     * Admin: Get Customer Details via JSON for view modal
     */
    public function details(int $id)
    {
        $customer = $this->customerModel->find($id);

        if (!$customer) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Customer not found.',
            ]);
        }

        // Never expose password hash
        unset($customer['password']);

        return $this->response->setJSON([
            'status'   => true,
            'customer' => $customer,
        ]);
    }

    /**
     * Admin: Add or Edit Customer
     */
    public function save()
    {
        $id = (int) $this->request->getPost('id');

        if ($id > 0) {
            // Edit existing customer
            $existing = $this->customerModel->find($id);
            if (!$existing) {
                return redirect()->back()->with('error', 'Customer record not found.');
            }

            $rules = [
                'name'     => 'required|min_length[2]|max_length[100]',
                'email'    => "required|valid_email|is_unique[customers.email,id,{$id}]",
                'phone'    => 'permit_empty|min_length[6]|max_length[30]',
                'password' => 'permit_empty|min_length[6]',
                'status'   => 'in_list[0,1]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $this->validator->getError('email') ?: ($this->validator->getError('name') ?: $this->validator->getError('password')));
            }

            $updateData = [
                'name'   => trim($this->request->getPost('name')),
                'email'  => strtolower(trim($this->request->getPost('email'))),
                'phone'  => !empty($this->request->getPost('phone')) ? trim($this->request->getPost('phone')) : null,
                'status' => (int) $this->request->getPost('status'),
            ];

            $newPassword = $this->request->getPost('password');
            if (!empty($newPassword)) {
                $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            }

            $this->customerModel->update($id, $updateData);

            return redirect()->to(base_url('admin/website/customer'))
                ->with('success', 'Customer profile updated successfully.');
        } else {
            // Add new customer
            $rules = [
                'name'     => 'required|min_length[2]|max_length[100]',
                'email'    => 'required|valid_email|is_unique[customers.email]',
                'phone'    => 'permit_empty|min_length[6]|max_length[30]',
                'password' => 'required|min_length[6]',
                'status'   => 'in_list[0,1]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $this->validator->getError('email') ?: ($this->validator->getError('name') ?: $this->validator->getError('password')));
            }

            $insertData = [
                'name'           => trim($this->request->getPost('name')),
                'email'          => strtolower(trim($this->request->getPost('email'))),
                'phone'          => !empty($this->request->getPost('phone')) ? trim($this->request->getPost('phone')) : null,
                'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'login_provider' => 'local',
                'status'         => (int) $this->request->getPost('status'),
            ];

            $this->customerModel->insert($insertData);

            return redirect()->to(base_url('admin/website/customer'))
                ->with('success', 'New customer account created successfully.');
        }
    }

    /**
     * Admin: Toggle Customer Active / Inactive Status
     */
    public function toggleStatus(int $id)
    {
        $customer = $this->customerModel->find($id);

        if (!$customer) {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(404)->setJSON([
                    'status'  => false,
                    'message' => 'Customer not found.',
                ]);
            }
            return redirect()->back()->with('error', 'Customer not found.');
        }

        $newStatus = (int)$customer['status'] === 1 ? 0 : 1;
        $this->customerModel->update($id, ['status' => $newStatus]);

        $statusLabel = $newStatus === 1 ? 'activated' : 'deactivated';
        $message = "Customer {$customer['name']} was {$statusLabel} successfully.";

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => true,
                'new_status' => $newStatus,
                'message'    => $message,
            ]);
        }

        return redirect()->to(base_url('admin/website/customer'))->with('success', $message);
    }

    /**
     * Admin: Delete Customer
     */
    public function delete(int $id)
    {
        $customer = $this->customerModel->find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        $customerName = $customer['name'];
        $this->customerModel->delete($id);

        return redirect()->to(base_url('admin/website/customer'))
            ->with('success', "Customer '{$customerName}' has been removed successfully.");
    }

    /**
     * Admin: Full 360° Customer CRM Profile (/admin/customers/{id})
     */
    public function viewProfile(int $id)
    {
        $profile = $this->customerModel->getCompleteCustomerProfile($id);

        if (!$profile) {
            return redirect()->to(base_url('admin/website/customer'))->with('error', 'Customer profile record not found.');
        }

        return view('admin/pages/customer_profile', [
            'pageTitle'         => "CRM Profile: {$profile['customer']['name']} | Glowup Admin",
            'pageHeading'       => "Patron CRM Dossier",
            'pageIcon'          => 'account_circle',
            'breadcrumbSection' => 'CRM',
            'breadcrumbTitle'   => $profile['customer']['name'],
            'activeMenu'        => 'website_customer',
            'admin'             => $this->getAdminData(),
            'profile'           => $profile,
        ]);
    }

    /**
     * Admin: Add Confidential Staff Note
     */
    public function addNote(int $id)
    {
        $text = trim((string) $this->request->getPost('note_text'));
        if (!empty($text)) {
            $noteModel = new \App\Models\CustomerNoteModel();
            $admin = $this->getAdminData();
            $noteModel->insert([
                'customer_id' => $id,
                'admin_name'  => $admin['name'] ?? 'Alex Vance',
                'note_text'   => $text,
                'is_pinned'   => $this->request->getPost('is_pinned') ? 1 : 0,
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
            return redirect()->to(base_url('admin/customers/' . $id))->with('success', 'Staff note added to customer dossier.');
        }
        return redirect()->to(base_url('admin/customers/' . $id))->with('error', 'Note content cannot be empty.');
    }

    /**
     * Admin: Update CRM Tags & Preferences
     */
    public function updateCrm(int $id)
    {
        $data = [
            'tags'               => trim((string) $this->request->getPost('tags')),
            'preferred_services' => trim((string) $this->request->getPost('preferred_services')),
            'whatsapp_number'    => trim((string) $this->request->getPost('whatsapp_number')),
        ];

        $this->customerModel->update($id, $data);
        return redirect()->to(base_url('admin/customers/' . $id))->with('success', 'Customer preferences updated.');
    }
}
