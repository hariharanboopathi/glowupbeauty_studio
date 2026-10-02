<?php

namespace App\Models;

use CodeIgniter\Model;

class FooterSettingsModel extends Model
{
    protected $table            = 'footer_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'brand_name',
        'brand_subtitle',
        'brand_description',
        'brand_logo',
        'newsletter_title',
        'newsletter_desc',
        'newsletter_btn_text',
        'concierge_title',
        'concierge_address',
        'concierge_phone',
        'concierge_whatsapp',
        'concierge_email',
        'concierge_hours',
        'social_instagram',
        'social_pinterest',
        'social_facebook',
        'social_youtube',
        'social_location',
        'copyright_text',
        'additional_text',
        'updated_at',
    ];

    protected $useTimestamps = false;

    /**
     * Retrieve the footer settings singleton row (id = 1).
     */
    public function getSettings(): array
    {
        $settings = $this->find(1);
        if (!$settings) {
            $default = [
                'id'                  => 1,
                'brand_name'          => 'Glowup',
                'brand_subtitle'      => 'Beauty Studio & Academy',
                'brand_description'   => 'An academy of mindful beauty, bespoke haircare, and transformative aesthetic therapies crafted for your natural radiance.',
                'brand_logo'          => null,
                'newsletter_title'    => 'Private Journal',
                'newsletter_desc'     => 'Receive curated beauty journals and bespoke privileges.',
                'newsletter_btn_text' => 'Join',
                'concierge_title'     => 'Academy Concierge',
                'concierge_address'   => "Flagship Academy:\n12 Madurai, Tamil Nadu",
                'concierge_phone'     => '+91 98200 12345',
                'concierge_whatsapp'  => '+91 98200 12345',
                'concierge_email'     => 'glowup@gmail.com',
                'concierge_hours'     => 'Tue – Sun: 10:00 AM – 8:00 PM',
                'social_instagram'    => '#',
                'social_pinterest'    => '#',
                'social_facebook'     => '#',
                'social_youtube'      => '#',
                'social_location'     => '#',
                'copyright_text'      => '© 2025 Glowup Beauty Studio & Academy. All rights reserved.',
                'additional_text'     => 'Price varies based on hair length & texture.',
                'updated_at'          => date('Y-m-d H:i:s'),
            ];
            $this->insert($default);
            return $default;
        }
        return $settings;
    }

    /**
     * Update settings.
     */
    public function updateSettings(array $data): bool
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $existing = $this->find(1);
        if ($existing) {
            return (bool) $this->update(1, $data);
        }
        $data['id'] = 1;
        return (bool) $this->insert($data);
    }
}
