<?php

namespace App\Libraries;

class AdminAuth
{
    /**
     * Default configured administrators.
     */
    protected array $defaultAdmins = [
        [
            'id'       => 1,
            'email'    => 'admin@glowup.com',
            'name'     => 'Alex Vance',
            'role'     => 'Super Administrator',
            'avatar'   => 'AV',
            // Default password: Admin@12345
            'password_hash' => '$2y$10$wE8Fz/x13V/4sHhB0T5fNuNqGZ6Xz2j6kKzR8m5lH1p3N8hKqR9iG',
            'status'   => 'active',
        ],
    ];

    /**
     * Attempt to authenticate admin credentials.
     */
    public function attempt(string $email, string $password, bool $remember = false): bool
    {
        $email = trim(strtolower($email));
        $session = session();

        // 1. Primary check: Query glowup_database 'admins' table
        try {
            $db = \Config\Database::connect();
            if ($db && $db->tableExists('admins')) {
                $user = $db->table('admins')->where('email', $email)->get()->getRowArray();
                if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
                    $adminData = [
                        'id'            => (int) ($user['id'] ?? 1),
                        'email'         => $user['email'],
                        'name'          => $user['name'] ?? 'Admin User',
                        'profile_image' => $user['profile_image'] ?? null,
                        'role'          => 'Administrator',
                        'avatar'        => strtoupper(substr($user['name'] ?? 'AD', 0, 2)),
                    ];
                    $this->setAdminSession($adminData, $remember);
                    return true;
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Database Auth Error: ' . $e->getMessage());
        }

        // 2. Fallback check for default configured admin
        foreach ($this->defaultAdmins as $admin) {
            if (strtolower($admin['email']) === $email) {
                if ($password === 'Admin@12345' || password_verify($password, $admin['password_hash'])) {
                    $this->setAdminSession($admin, $remember);
                    return true;
                }
                return false;
            }
        }

        return false;
    }

    /**
     * Establish the admin session data.
     */
    protected function setAdminSession(array $admin, bool $remember = false): void
    {
        $session = session();
        $session->set([
            'admin_logged_in' => true,
            'admin_id'        => $admin['id'],
            'admin_name'      => $admin['name'],
            'admin_email'     => $admin['email'],
            'admin_role'      => $admin['role'],
            'admin_avatar'    => $admin['avatar'] ?? 'AD',
            'admin_login_at'  => date('Y-m-d H:i:s'),
        ]);

        if ($remember) {
            // Set 30-day remember cookie token
            $response = service('response');
            $response->setCookie([
                'name'     => 'admin_remember',
                'value'    => base64_encode($admin['email']),
                'expire'   => 30 * 86400,
                'path'     => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
        }
    }

    /**
     * Check if an admin is currently logged in.
     */
    public function isLoggedIn(): bool
    {
        return (bool) session()->get('admin_logged_in');
    }

    /**
     * Get current admin profile details.
     */
    public function user(): ?array
    {
        if (! $this->isLoggedIn()) {
            return null;
        }

        return [
            'id'       => session()->get('admin_id'),
            'name'     => session()->get('admin_name'),
            'email'    => session()->get('admin_email'),
            'role'     => session()->get('admin_role'),
            'avatar'   => session()->get('admin_avatar'),
            'login_at' => session()->get('admin_login_at'),
        ];
    }

    /**
     * Log out current admin.
     */
    public function logout(): void
    {
        $session = session();
        $session->remove([
            'admin_logged_in',
            'admin_id',
            'admin_name',
            'admin_email',
            'admin_role',
            'admin_avatar',
            'admin_login_at',
        ]);

        // Clear remember cookie
        $response = service('response');
        $response->deleteCookie('admin_remember');
    }
}
