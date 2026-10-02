<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'phone',
        'whatsapp_number',
        'dob',
        'address',
        'notes',
        'tags',
        'lead_source',
        'password',
        'google_id',
        'profile_image',
        'login_provider',
        'status',
        'customer_status',
        'preferred_services',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Find active customer by email
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', strtolower(trim($email)))->first();
    }

    /**
     * Find customer by Google ID
     */
    public function findByGoogleId(string $googleId): ?array
    {
        return $this->where('google_id', trim($googleId))->first();
    }

    /**
     * Register a new normal (local) customer
     */
    public function registerCustomer(array $data): array
    {
        $email = strtolower(trim($data['email'] ?? ''));

        // Check if email already registered
        if ($this->findByEmail($email)) {
            return [
                'status'  => false,
                'message' => 'An account with this email address already exists. Please sign in instead.',
            ];
        }

        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        $customerData = [
            'name'           => trim($data['name']),
            'email'          => $email,
            'phone'          => !empty($data['phone']) ? trim($data['phone']) : null,
            'password'       => $passwordHash,
            'login_provider' => 'local',
            'status'         => 1, // Active
        ];

        $insertedId = $this->insert($customerData);

        if (!$insertedId) {
            return [
                'status'  => false,
                'message' => 'Failed to create customer account. Please try again.',
            ];
        }

        return [
            'status'      => true,
            'id'          => $insertedId,
            'message'     => 'Registration successful! Welcome to Glowup Sanctuary.',
            'customer'    => $this->find($insertedId),
        ];
    }

    /**
     * Find active customer by email, phone, or whatsapp number
     */
    public function findByIdentifier(string $identifier): ?array
    {
        $identifier = trim($identifier);
        if (empty($identifier)) {
            return null;
        }

        // Check if email format
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return $this->where('email', strtolower($identifier))->first();
        }

        // Phone search: raw and normalized numeric search
        $customer = $this->where('phone', $identifier)
            ->orWhere('whatsapp_number', $identifier)
            ->first();

        if (!$customer) {
            $cleanDigits = preg_replace('/\D+/', '', $identifier);
            if (strlen($cleanDigits) >= 7) {
                $customer = $this->like('phone', $cleanDigits)
                    ->orLike('whatsapp_number', $cleanDigits)
                    ->first();
            }
        }

        return $customer;
    }

    /**
     * Authenticate customer with email or phone and password
     */
    public function verifyLogin(string $identifier, string $password): array
    {
        $identifier = trim($identifier);
        if (empty($identifier)) {
            return [
                'status'  => false,
                'message' => 'Please enter your email address or mobile number.',
            ];
        }

        $customer = $this->findByIdentifier($identifier);

        if (!$customer) {
            $isEmail = strpos($identifier, '@') !== false;
            return [
                'status'  => false,
                'message' => $isEmail ? 'No account found with this email address.' : 'No account found with this mobile number.',
            ];
        }

        // Check active status
        if ((int)$customer['status'] !== 1) {
            return [
                'status'  => false,
                'message' => 'Your customer account is currently inactive or suspended. Please contact concierge support.',
            ];
        }

        // If local user has no password (e.g. registered via Google only)
        if (empty($customer['password'])) {
            return [
                'status'  => false,
                'message' => 'This account was created with Google Sign-In. Please click "Continue with Google" to access your account.',
            ];
        }

        if (!password_verify($password, $customer['password'])) {
            return [
                'status'  => false,
                'message' => 'The password you entered is incorrect. Please try again.',
            ];
        }

        return [
            'status'   => true,
            'customer' => $customer,
            'message'  => 'Welcome back, ' . esc($customer['name']) . '!',
        ];
    }

    /**
     * Register or login a customer via Google OAuth
     */
    public function registerOrUpdateGoogleCustomer(array $googleUser): array
    {
        $email    = strtolower(trim($googleUser['email'] ?? ''));
        $googleId = trim($googleUser['id'] ?? ($googleUser['google_id'] ?? ''));
        $name     = trim($googleUser['name'] ?? ($googleUser['given_name'] ?? 'Google Customer'));
        $avatar   = $googleUser['picture'] ?? ($googleUser['profile_image'] ?? null);

        if (empty($email)) {
            return [
                'status'  => false,
                'message' => 'Google did not provide an email address.',
            ];
        }

        // 1. Check if customer already exists by email
        $existing = $this->findByEmail($email);

        if ($existing) {
            // Check status
            if ((int)$existing['status'] !== 1) {
                return [
                    'status'  => false,
                    'message' => 'Your customer account is currently inactive or suspended.',
                ];
            }

            // Update Google ID and Avatar if not set
            $updateData = [];
            if (empty($existing['google_id']) && !empty($googleId)) {
                $updateData['google_id'] = $googleId;
            }
            if (empty($existing['profile_image']) && !empty($avatar)) {
                $updateData['profile_image'] = $avatar;
            }
            if (!empty($updateData)) {
                $this->update($existing['id'], $updateData);
                $existing = $this->find($existing['id']);
            }

            return [
                'status'   => true,
                'customer' => $existing,
                'message'  => 'Welcome back, ' . esc($existing['name']) . '!',
            ];
        }

        // 2. Create new customer with Google details
        $newCustomer = [
            'name'           => $name,
            'email'          => $email,
            'google_id'      => $googleId,
            'profile_image'  => $avatar,
            'login_provider' => 'google',
            'status'         => 1,
        ];

        $insertedId = $this->insert($newCustomer);

        if (!$insertedId) {
            return [
                'status'  => false,
                'message' => 'Unable to create account from Google sign-in. Please try again.',
            ];
        }

        return [
            'status'   => true,
            'customer' => $this->find($insertedId),
            'message'  => 'Account created with Google! Welcome to Glowup Sanctuary.',
        ];
    }

    /**
     * Admin: Filter and paginate customers
     */
    public function getFilteredCustomers(?string $search = null, ?string $status = null, int $limit = 20, int $offset = 0): array
    {
        $builder = $this->builder();

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search)
                    ->groupEnd();
        }

        if ($status !== null && $status !== '') {
            $builder->where('status', (int)$status);
        }

        return $builder->orderBy('id', 'DESC')
                       ->limit($limit, $offset)
                       ->get()
                       ->getResultArray();
    }

    /**
     * Admin: Count total matching customers
     */
    public function getFilteredCount(?string $search = null, ?string $status = null): int
    {
        $builder = $this->builder();

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('name', $search)
                    ->orLike('email', $search)
                    ->orLike('phone', $search)
                    ->groupEnd();
        }

        if ($status !== null && $status !== '') {
            $builder->where('status', (int)$status);
        }

        return $builder->countAllResults();
    }

    /**
     * Get complete connected CRM profile with all histories
     */
    public function getCompleteCustomerProfile(int $id): ?array
    {
        $customer = $this->find($id);
        if (!$customer) {
            return null;
        }

        $db = \Config\Database::connect();

        // 1. Booking History
        $bookings = $db->table('bookings')
            ->groupStart()
                ->where('customer_id', $id)
                ->orWhere('customer_email', $customer['email'])
            ->groupEnd()
            ->orderBy('booking_date', 'DESC')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        // 2. Invoice History
        $invoices = $db->table('invoices')
            ->groupStart()
                ->where('customer_id', $id)
                ->orWhere('customer_email', $customer['email'])
            ->groupEnd()
            ->orderBy('invoice_date', 'DESC')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        // 3. Payment History
        $payments = $db->table('payments')
            ->where('customer_id', $id)
            ->orderBy('payment_date', 'DESC')
            ->get()
            ->getResultArray();

        // 4. Inquiries History
        $enquiries = $db->table('enquiries')
            ->groupStart()
                ->where('email', $customer['email'])
                ->orWhere('phone', $customer['phone'])
            ->groupEnd()
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        // 5. Customer Notes
        $notes = $db->table('customer_notes')
            ->where('customer_id', $id)
            ->orderBy('is_pinned', 'DESC')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        // 6. Communication Logs
        $comms = $db->table('communication_logs')
            ->groupStart()
                ->where('customer_id', $id)
                ->orWhere('recipient_contact', $customer['email'])
                ->orWhere('recipient_contact', $customer['phone'])
            ->groupEnd()
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        // Compute Financial & Booking Metrics
        $totalBookings = count($bookings);
        $totalSpent    = 0.0;
        $pendingAmount = 0.0;

        foreach ($invoices as $inv) {
            if ($inv['status'] !== 'cancelled') {
                $totalSpent += (float) ($inv['amount_paid'] ?? 0);
                $pendingAmount += (float) ($inv['balance_due'] ?? 0);
            }
        }

        $now = date('Y-m-d');
        $lastVisit = null;
        $nextAppointment = null;

        foreach ($bookings as $b) {
            if ($b['booking_date'] < $now && in_array($b['status'], ['completed', 'confirmed'])) {
                if (!$lastVisit || $b['booking_date'] > $lastVisit) {
                    $lastVisit = $b['booking_date'];
                }
            } elseif ($b['booking_date'] >= $now && in_array($b['status'], ['pending', 'confirmed'])) {
                if (!$nextAppointment || $b['booking_date'] < $nextAppointment) {
                    $nextAppointment = $b['booking_date'];
                }
            }
        }

        return [
            'customer'        => $customer,
            'bookings'        => $bookings,
            'invoices'        => $invoices,
            'payments'        => $payments,
            'enquiries'       => $enquiries,
            'notes'           => $notes,
            'communications'  => $comms,
            'metrics'         => [
                'total_bookings'   => $totalBookings,
                'total_spent'      => $totalSpent,
                'pending_amount'   => $pendingAmount,
                'last_visit'       => $lastVisit,
                'next_appointment' => $nextAppointment,
            ],
        ];
    }
}
