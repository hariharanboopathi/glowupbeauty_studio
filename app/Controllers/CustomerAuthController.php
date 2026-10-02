<?php

namespace App\Controllers;

use App\Libraries\CustomerAuth;
use App\Models\CustomerModel;
use Config\Google as GoogleConfig;

class CustomerAuthController extends BaseController
{
    protected CustomerAuth $auth;
    protected CustomerModel $customerModel;
    protected GoogleConfig $googleConfig;

    public function __construct()
    {
        $this->auth = new CustomerAuth();
        $this->customerModel = new CustomerModel();
        $this->googleConfig = new GoogleConfig();
    }

    /**
     * Display Customer Registration Form
     */
    public function showRegister()
    {
        if ($this->auth->isLoggedIn()) {
            return redirect()->to(base_url('profile'));
        }

        return view('glowup/user_register', [
            'pageTitle' => 'Register | Glowup Beauty Studio & Academy',
        ]);
    }

    /**
     * Process Customer Registration
     */
    public function register()
    {
        if ($this->auth->isLoggedIn()) {
            return redirect()->to(base_url('profile'));
        }

        $rules = [
            'name'     => 'required|min_length[2]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[customers.email]',
            'phone'    => 'permit_empty|min_length[6]|max_length[30]',
            'password' => 'required|min_length[6]',
        ];

        $messages = [
            'name' => [
                'required'   => 'Please provide your full name.',
                'min_length' => 'Your name must be at least 2 characters long.',
            ],
            'email' => [
                'required'    => 'Please provide your email address.',
                'valid_email' => 'Please enter a valid email address.',
                'is_unique'   => 'An account with this email address already exists. Please sign in instead.',
            ],
            'password' => [
                'required'   => 'Please create a secure password.',
                'min_length' => 'Password must be at least 6 characters long.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('error', $this->validator->getError('email') ?: ($this->validator->getError('password') ?: $this->validator->getError('name')));
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'password' => $this->request->getPost('password'),
        ];

        $result = $this->customerModel->registerCustomer($data);

        if (!$result['status']) {
            return redirect()->back()
                ->withInput()
                ->with('error', $result['message']);
        }

        return redirect()->to(base_url('login'))
            ->with('success', 'Account created successfully. Please log in to continue.');
    }

    /**
     * Display Customer Login Form
     */
    public function showLogin()
    {
        $redirectParam = $this->request->getGet('redirect') ?: $this->request->getGet('return_url');
        if (!empty($redirectParam)) {
            $cleanUrl = $this->sanitizeReturnUrl($redirectParam);
            if ($cleanUrl) {
                session()->set('customer_return_url', $cleanUrl);
            }
        }

        if ($this->auth->isLoggedIn()) {
            $returnUrl = $this->sanitizeReturnUrl(session()->get('customer_return_url'));
            session()->remove('customer_return_url');
            return redirect()->to($returnUrl ?: base_url('profile'));
        }

        return view('glowup/user_login', [
            'pageTitle' => 'Sign In | Glowup Beauty Studio & Academy',
            'returnUrl' => session()->get('customer_return_url'),
        ]);
    }

    /**
     * Process Customer Login
     */
    public function login()
    {
        if ($this->auth->isLoggedIn()) {
            $returnUrl = $this->sanitizeReturnUrl(session()->get('customer_return_url'));
            session()->remove('customer_return_url');
            return redirect()->to($returnUrl ?: base_url('profile'));
        }

        $loginId = trim((string) ($this->request->getPost('login_id') ?: $this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');

        if (empty($loginId)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter your email address or mobile number.');
        }

        if (empty($password)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter your password.');
        }

        // Email validation if user provided an email format
        if (strpos($loginId, '@') !== false && !filter_var($loginId, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter a valid email address.');
        }

        $result = $this->auth->attempt($loginId, $password);

        if (!$result['status']) {
            return redirect()->back()
                ->withInput()
                ->with('error', $result['message']);
        }

        $customer = $result['customer'];
        $welcomeName = esc($customer['name'] ?? 'Patron');

        // Resolve return redirect destination
        $postReturnUrl = $this->request->getPost('return_url');
        $sessionReturnUrl = session()->get('customer_return_url');
        $targetUrl = $this->sanitizeReturnUrl($postReturnUrl ?: $sessionReturnUrl) ?: base_url('profile');
        session()->remove('customer_return_url');

        return redirect()->to($targetUrl)
            ->with('success', 'Welcome back, ' . $welcomeName . '! Your personal sanctuary pass is active.');
    }

    /**
     * Customer Logout
     */
    public function logout()
    {
        $this->auth->logout();

        return redirect()->to(base_url('login'))
            ->with('success', 'You have signed out of your account successfully. We look forward to seeing you soon.');
    }

    /**
     * Initiate Google OAuth Login
     */
    public function googleLogin()
    {
        $clientId = $this->googleConfig->clientId;
        $redirectUri = $this->googleConfig->redirectUri;

        // If credentials are still placeholder and we are in development, show prompt or offer test mode
        if (empty($clientId) || $clientId === 'YOUR_GOOGLE_CLIENT_ID') {
            return redirect()->to(base_url('login'))
                ->with('error', 'Google OAuth credentials are not yet configured in .env. Please set google.clientID and google.clientSecret.');
        }

        // Generate CSRF state
        $state = bin2hex(random_bytes(16));
        session()->set('google_oauth_state', $state);

        $params = [
            'client_id'             => $clientId,
            'redirect_uri'          => $redirectUri,
            'response_type'         => 'code',
            'scope'                 => 'openid email profile',
            'access_type'           => 'online',
            'state'                 => $state,
            'prompt'                => 'select_account',
            'include_granted_scopes'=> 'true',
        ];

        $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);

        return redirect()->to($authUrl);
    }

    /**
     * Handle Google OAuth Callback
     */
    public function googleCallback()
    {
        $error = $this->request->getGet('error');
        if (!empty($error)) {
            return redirect()->to(base_url('login'))
                ->with('error', 'Google Sign-In was cancelled or failed: ' . esc($error));
        }

        $code  = $this->request->getGet('code');
        $state = $this->request->getGet('state');
        $savedState = session()->get('google_oauth_state');

        if (empty($code)) {
            return redirect()->to(base_url('login'))
                ->with('error', 'Google authorization code was missing.');
        }

        // Exchange code for access token via Google token endpoint
        $tokenUrl = 'https://oauth2.googleapis.com/token';
        $postData = [
            'code'          => $code,
            'client_id'     => $this->googleConfig->clientId,
            'client_secret' => $this->googleConfig->clientSecret,
            'redirect_uri'  => $this->googleConfig->redirectUri,
            'grant_type'    => 'authorization_code',
        ];

        try {
            $client = \Config\Services::curlrequest();
            $response = $client->post($tokenUrl, [
                'form_params' => $postData,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            if ($statusCode !== 200 || empty($body['access_token'])) {
                $errorMsg = $body['error_description'] ?? ($body['error'] ?? 'Failed to exchange authorization code with Google.');
                return redirect()->to(base_url('login'))
                    ->with('error', 'Google authentication error: ' . esc($errorMsg));
            }

            $accessToken = $body['access_token'];

            // Fetch user profile from Google UserInfo endpoint
            $userInfoResponse = $client->get('https://www.googleapis.com/oauth2/v3/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            $userData = json_decode($userInfoResponse->getBody(), true);

            if (empty($userData['email'])) {
                return redirect()->to(base_url('login'))
                    ->with('error', 'Unable to retrieve verified email from Google.');
            }

            $googlePayload = [
                'google_id'     => $userData['sub'] ?? '',
                'email'         => $userData['email'],
                'name'          => $userData['name'] ?? ($userData['given_name'] ?? 'Google Customer'),
                'profile_image' => $userData['picture'] ?? null,
            ];

            $result = $this->customerModel->registerOrUpdateGoogleCustomer($googlePayload);

            if (!$result['status'] || empty($result['customer'])) {
                return redirect()->to(base_url('login'))
                    ->with('error', $result['message'] ?? 'Failed to log in with Google.');
            }

            $this->auth->login($result['customer']);

            $savedReturnUrl = session()->get('customer_return_url');
            $targetUrl = $this->sanitizeReturnUrl($savedReturnUrl) ?: base_url('profile');
            session()->remove('customer_return_url');

            return redirect()->to($targetUrl)
                ->with('success', 'Welcome back, ' . esc($result['customer']['name']) . '! Your personal sanctuary pass is active.');

        } catch (\Throwable $e) {
            log_message('error', 'Google OAuth Error: ' . $e->getMessage());
            return redirect()->to(base_url('login'))
                ->with('error', 'An unexpected error occurred during Google sign-in. Please try again.');
        }
    }

    /**
     * Demo / Simulated Google Login for local testing & development
     * Enabled only in development environment to verify full Google OAuth customer flow
     */
    public function googleDemo()
    {
        if (ENVIRONMENT !== 'development') {
            return redirect()->to(base_url('login'));
        }

        $email = $this->request->getGet('email') ?: 'priya.patel@gmail.com';
        $name = $this->request->getGet('name') ?: 'Priya Patel';
        $googleId = 'google_demo_' . md5($email);
        $picture = 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&q=80';

        $googlePayload = [
            'google_id'     => $googleId,
            'email'         => $email,
            'name'          => $name,
            'profile_image' => $picture,
        ];

        $result = $this->customerModel->registerOrUpdateGoogleCustomer($googlePayload);

        if (!$result['status'] || empty($result['customer'])) {
            return redirect()->to(base_url('login'))
                ->with('error', $result['message'] ?? 'Failed to sign in with Google demo.');
        }

        $this->auth->login($result['customer']);

        $savedReturnUrl = session()->get('customer_return_url');
        $targetUrl = $this->sanitizeReturnUrl($savedReturnUrl) ?: base_url('profile');
        session()->remove('customer_return_url');

        return redirect()->to($targetUrl)
            ->with('success', 'Welcome back, ' . esc($result['customer']['name']) . '! Your personal sanctuary pass is active.');
    }

    /**
     * Sanitize return URL ensuring only internal application routes are allowed
     */
    protected function sanitizeReturnUrl(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        $url = trim($url);

        // Disallow dangerous protocols or protocol-relative URLs
        if (preg_match('/^(?:javascript|data|vbscript):/i', $url) || str_starts_with($url, '//') || str_starts_with($url, '\\\\')) {
            return null;
        }

        // If it starts with http:// or https://, verify it strictly matches base_url()
        if (preg_match('/^https?:\/\//i', $url)) {
            $parsedBase = parse_url(base_url());
            $parsedUrl  = parse_url($url);
            if (!empty($parsedBase['host']) && !empty($parsedUrl['host']) && strcasecmp($parsedBase['host'], $parsedUrl['host']) === 0) {
                return $url;
            }
            return null;
        }

        // Relative path starting with /
        if (str_starts_with($url, '/')) {
            return base_url(ltrim($url, '/'));
        }

        return null;
    }

    /**
     * Update Patron Profile Details
     */
    public function updateProfile()
    {
        if (!$this->auth->isLoggedIn()) {
            return redirect()->to(base_url('login'));
        }

        $userId = (int) $this->auth->id();
        $name = trim((string) $this->request->getPost('name'));
        $phone = trim((string) $this->request->getPost('phone'));
        $whatsapp = trim((string) $this->request->getPost('whatsapp'));
        $address = trim((string) $this->request->getPost('address'));
        $dob = trim((string) $this->request->getPost('dob'));
        $preferredServices = trim((string) $this->request->getPost('preferred_services'));

        if (empty($name)) {
            return redirect()->to(base_url('profile'))->with('error', 'Full name is required.');
        }

        $updateData = [
            'name'               => $name,
            'phone'              => $phone,
            'whatsapp_number'    => $whatsapp ?: $phone,
            'address'            => $address,
            'dob'                => !empty($dob) ? $dob : null,
            'preferred_services' => $preferredServices,
            'updated_at'         => date('Y-m-d H:i:s'),
        ];

        $this->customerModel->update($userId, $updateData);

        // Update session name & phone
        session()->set('customer_name', $name);
        session()->set('customer_phone', $phone);

        return redirect()->to(base_url('profile'))->with('success', 'Your sanctuary profile has been updated successfully.');
    }

    /**
     * Change Patron Password
     */
    public function changePassword()
    {
        if (!$this->auth->isLoggedIn()) {
            return redirect()->to(base_url('login'));
        }

        $userId = (int) $this->auth->id();
        $currentPassword = (string) $this->request->getPost('current_password');
        $newPassword = (string) $this->request->getPost('new_password');
        $confirmPassword = (string) $this->request->getPost('confirm_password');

        if (empty($newPassword) || strlen($newPassword) < 6) {
            return redirect()->to(base_url('profile'))->with('error', 'New password must be at least 6 characters long.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->to(base_url('profile'))->with('error', 'New passwords do not match. Please verify and try again.');
        }

        $customer = $this->customerModel->find($userId);
        if (!$customer) {
            return redirect()->to(base_url('profile'))->with('error', 'Patron account not found.');
        }

        // Verify current password if customer has an existing password set
        if (!empty($customer['password']) && !password_verify($currentPassword, $customer['password'])) {
            return redirect()->to(base_url('profile'))->with('error', 'Your current password was entered incorrectly.');
        }

        $this->customerModel->update($userId, [
            'password'   => password_hash($newPassword, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('profile'))->with('success', 'Your security password has been updated successfully.');
    }

    /**
     * View Printable Tax Invoice for Authenticated Patron
     */
    public function viewInvoice(int $id)
    {
        if (!$this->auth->isLoggedIn()) {
            return redirect()->to(base_url('login'))->with('error', 'Please sign in to view your invoice.');
        }

        $userId = (int) $this->auth->id();
        $invoiceModel = new \App\Models\InvoiceModel();
        $invoice = $invoiceModel->find($id);

        if (!$invoice) {
            return redirect()->to(base_url('profile'))->with('error', 'Invoice record not found.');
        }

        if ((int) $invoice['customer_id'] !== $userId) {
            log_message('warning', "Security violation: Customer ID {$userId} attempted to access invoice ID {$id} belonging to customer ID {$invoice['customer_id']}.");
            return redirect()->to(base_url('profile'))->with('error', 'Access denied. You are not authorized to view this invoice.');
        }

        $itemModel = new \App\Models\InvoiceItemModel();
        $paymentModel = new \App\Models\PaymentModel();

        $items = $itemModel->where('invoice_id', $id)->findAll();
        $payments = $paymentModel->where('invoice_id', $id)->orderBy('payment_date', 'DESC')->findAll();

        return view('glowup/invoice_view', [
            'pageTitle'      => "Invoice #{$invoice['invoice_number']} | Glowup Sanctuary",
            'pageHeading'    => "Tax Invoice & Settlement Receipt",
            'invoice'        => $invoice,
            'items'          => $items,
            'payments'       => $payments,
        ]);
    }
}
