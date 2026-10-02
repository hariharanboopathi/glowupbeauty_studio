<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\AdminModel;
use App\Models\FooterSettingsModel;

class SettingController extends BaseController
{
    protected AdminAuth $auth;
    protected AdminModel $adminModel;
    protected FooterSettingsModel $settingsModel;

    public function __construct()
    {
        $this->auth          = new AdminAuth();
        $this->adminModel    = new AdminModel();
        $this->settingsModel = new FooterSettingsModel();

        // Ensure avatars upload folder exists
        $dir = FCPATH . 'uploads/avatars';
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
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
     * General Settings Console (/admin/settings)
     */
    public function index()
    {
        $settings = $this->settingsModel->getSettings();

        return view('admin/pages/settings', [
            'pageTitle'         => 'General Settings | Glowup Admin',
            'pageHeading'       => 'General Studio & System Settings',
            'pageIcon'          => 'settings',
            'breadcrumbSection' => 'Settings',
            'breadcrumbTitle'   => 'General Settings',
            'activeMenu'        => 'settings',
            'admin'             => $this->getAdminData(),
            'settings'          => $settings,
        ]);
    }

    /**
     * Save General Settings
     */
    public function saveSettings()
    {
        $data = [
            'brand_name'        => trim((string) $this->request->getPost('brand_name')) ?: 'Glowup',
            'brand_subtitle'    => trim((string) $this->request->getPost('brand_subtitle')),
            'brand_description' => trim((string) $this->request->getPost('brand_description')),
            'concierge_phone'    => trim((string) $this->request->getPost('concierge_phone')),
            'concierge_whatsapp' => trim((string) $this->request->getPost('concierge_whatsapp')),
            'concierge_email'    => trim((string) $this->request->getPost('concierge_email')),
            'concierge_address' => trim((string) $this->request->getPost('concierge_address')),
            'concierge_hours'   => trim((string) $this->request->getPost('concierge_hours')),
            'social_instagram'  => trim((string) $this->request->getPost('social_instagram')),
            'social_facebook'   => trim((string) $this->request->getPost('social_facebook')),
            'social_youtube'    => trim((string) $this->request->getPost('social_youtube')),
            'social_pinterest'  => trim((string) $this->request->getPost('social_pinterest')),
            'copyright_text'    => trim((string) $this->request->getPost('copyright_text')),
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        $this->settingsModel->update(1, $data);

        return redirect()->to(base_url('admin/settings'))->with('success', 'Studio configuration updated successfully.');
    }

    /**
     * Admin Profile Console (/admin/settings/profile)
     */
    public function profile()
    {
        $admin = $this->getAdminData();
        $dbAdmin = null;

        if (!empty($admin['email'])) {
            $dbAdmin = $this->adminModel->where('email', $admin['email'])->first();
        }

        return view('admin/pages/profile', [
            'pageTitle'         => 'Admin Profile & Security | Glowup Admin',
            'pageHeading'       => 'Admin Profile & Credentials',
            'pageIcon'          => 'manage_accounts',
            'breadcrumbSection' => 'Settings',
            'breadcrumbTitle'   => 'Admin Profile',
            'activeMenu'        => 'profile',
            'admin'             => $admin,
            'dbAdmin'           => $dbAdmin,
        ]);
    }

    /**
     * Update Profile Info
     */
    public function updateProfile()
    {
        $admin = $this->getAdminData();
        $email = $admin['email'] ?? 'admin@glowup.com';

        $name = trim((string) $this->request->getPost('name'));
        if (empty($name)) {
            return redirect()->back()->with('error', 'Name is required.');
        }

        $dbAdmin = $this->adminModel->where('email', $email)->first();

        $updateData = ['name' => $name];

        $avatarFile = $this->request->getFile('avatar');
        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            $newName = $avatarFile->getRandomName();
            $avatarFile->move(FCPATH . 'uploads/avatars', $newName);
            $updateData['profile_image'] = 'uploads/avatars/' . $newName;
        }

        if ($dbAdmin) {
            $this->adminModel->update($dbAdmin['id'], $updateData);
        } else {
            $updateData['email']    = $email;
            $updateData['password'] = password_hash('Admin@12345', PASSWORD_DEFAULT);
            $this->adminModel->insert($updateData);
        }

        // Refresh session
        $sessionAdmin = session('admin_user') ?? [];
        $sessionAdmin['name'] = $name;
        if (isset($updateData['profile_image'])) {
            $sessionAdmin['profile_image'] = $updateData['profile_image'];
        }
        $sessionAdmin['avatar'] = strtoupper(substr($name, 0, 2));
        session()->set('admin_user', $sessionAdmin);

        return redirect()->to(base_url('admin/settings/profile'))->with('success', 'Profile updated successfully.');
    }

    /**
     * Change Password
     */
    public function changePassword()
    {
        $admin = $this->getAdminData();
        $email = $admin['email'] ?? 'admin@glowup.com';

        $currentPassword = (string) $this->request->getPost('current_password');
        $newPassword     = (string) $this->request->getPost('new_password');
        $confirmPassword = (string) $this->request->getPost('confirm_password');

        if (empty($currentPassword) || empty($newPassword)) {
            return redirect()->back()->with('error', 'Please fill in all password fields.');
        }

        if (strlen($newPassword) < 6) {
            return redirect()->back()->with('error', 'New password must be at least 6 characters.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'New password and confirmation do not match.');
        }

        $dbAdmin = $this->adminModel->where('email', $email)->first();

        if ($dbAdmin) {
            if (!password_verify($currentPassword, $dbAdmin['password'])) {
                return redirect()->back()->with('error', 'Current password entered is incorrect.');
            }

            $this->adminModel->update($dbAdmin['id'], [
                'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            ]);
        } else {
            // First time creating database record for default admin
            if ($currentPassword !== 'Admin@12345') {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }

            $this->adminModel->insert([
                'name'     => $admin['name'] ?? 'Alex Vance',
                'email'    => $email,
                'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            ]);
        }

        return redirect()->to(base_url('admin/settings/profile'))->with('success', 'Password successfully updated.');
    }
}
