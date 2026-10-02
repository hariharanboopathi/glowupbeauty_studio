<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;

class AuthController extends BaseController
{
    protected AdminAuth $auth;

    public function __construct()
    {
        $this->auth = new AdminAuth();
    }

    /**
     * Show the Admin Login page.
     */
    public function login()
    {
        if ($this->auth->isLoggedIn()) {
            return redirect()->to('/admin/dashboard');
        }

        $rememberedEmail = '';
        $cookie = $this->request->getCookie('admin_remember');
        if ($cookie) {
            $rememberedEmail = base64_decode($cookie) ?: '';
        }

        $data = [
            'pageTitle'       => 'Admin Portal Authentication | GlowUp',
            'metaDescription' => 'Secure administrator login for GlowUp platform management.',
            'rememberedEmail' => $rememberedEmail,
        ];

        return view('admin/login', $data);
    }

    /**
     * Process Admin Login submission.
     */
    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        $messages = [
            'email' => [
                'required'    => 'Please enter your administrator email address.',
                'valid_email' => 'Please provide a valid email format.',
            ],
            'password' => [
                'required'   => 'Please provide your account password.',
                'min_length' => 'Password must contain at least 6 characters.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email    = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        if (! $this->auth->attempt($email, $password, $remember)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid administrator credentials. Please check your email and password.');
        }

        return redirect()->to('/admin/dashboard')
            ->with('success', 'Authentication verified. Welcome back, ' . session()->get('admin_name') . '!');
    }

    /**
     * Process Admin Logout.
     */
    public function logout()
    {
        $this->auth->logout();

        return redirect()->to('/admin/login')
            ->with('success', 'You have been securely logged out of the admin console.');
    }

}
