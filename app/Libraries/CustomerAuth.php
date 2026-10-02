<?php

namespace App\Libraries;

use App\Models\CustomerModel;

class CustomerAuth
{
    protected CustomerModel $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    /**
     * Check if a customer is currently authenticated
     */
    public function isLoggedIn(): bool
    {
        return (bool) session()->get('customer_logged_in');
    }

    /**
     * Get authenticated customer ID
     */
    public function id(): ?int
    {
        return session()->get('customer_id') ? (int) session()->get('customer_id') : null;
    }

    /**
     * Get authenticated customer full profile
     */
    public function user(): ?array
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        // Check if cached in session or load fresh from DB
        $customerId = $this->id();
        if ($customerId) {
            $fresh = $this->customerModel->find($customerId);
            if ($fresh) {
                // If account has been deactivated in admin, force logout
                if ((int)$fresh['status'] !== 1) {
                    $this->logout();
                    return null;
                }
                return $fresh;
            }
        }

        return session()->get('customer_user');
    }

    /**
     * Attempt local email or phone / password login
     */
    public function attempt(string $identifier, string $password): array
    {
        $result = $this->customerModel->verifyLogin($identifier, $password);

        if ($result['status'] && !empty($result['customer'])) {
            $this->login($result['customer']);
        }

        return $result;
    }

    /**
     * Establish customer session
     */
    public function login(array $customer): void
    {
        $session = session();

        // Sanitize data before session storage (never store password in session)
        unset($customer['password']);

        $session->set([
            'customer_logged_in' => true,
            'customer_id'        => (int) $customer['id'],
            'customer_name'      => $customer['name'],
            'customer_email'     => $customer['email'],
            'customer_phone'     => $customer['phone'] ?? null,
            'customer_avatar'    => $customer['profile_image'] ?? null,
            'customer_provider'  => $customer['login_provider'] ?? 'local',
            'customer_user'      => $customer,
            'customer_login_at'  => date('Y-m-d H:i:s'),
        ]);

        // Regenerate session ID for security if active web session
        if (session_status() === PHP_SESSION_ACTIVE && !is_cli()) {
            try {
                $session->regenerate();
            } catch (\Throwable $e) {
                // Ignore in testing environments
            }
        }
    }

    /**
     * Log out customer and destroy customer session keys
     */
    public function logout(): void
    {
        $session = session();
        $session->remove([
            'customer_logged_in',
            'customer_id',
            'customer_name',
            'customer_email',
            'customer_phone',
            'customer_avatar',
            'customer_provider',
            'customer_user',
            'customer_login_at',
        ]);
    }
}
