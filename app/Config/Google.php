<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public string $clientId     = '';
    public string $clientSecret = '';
    public string $redirectUri  = '';

    public function __construct()
    {
        parent::__construct();

        $this->clientId     = env('google.clientID', 'YOUR_GOOGLE_CLIENT_ID');
        $this->clientSecret = env('google.clientSecret', 'YOUR_GOOGLE_CLIENT_SECRET');
        $this->redirectUri  = env('google.redirectUri', base_url('auth/google/callback'));
    }
}
