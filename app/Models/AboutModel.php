<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table            = 'about_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'hero_title',
        'hero_subtitle',
        'genesis_eyebrow',
        'genesis_title',
        'genesis_copy1',
        'genesis_copy2',
        'stat1_value',
        'stat1_label',
        'stat2_value',
        'stat2_label',
        'stat3_value',
        'stat3_label',
        'genesis_image',
        'updated_at',
    ];

    public function getSettings(): array
    {
        $settings = $this->first();
        if (!$settings) {
            return [
                'hero_title'      => 'The Art of Mindful Beauty',
                'hero_subtitle'   => 'An architectural sanctuary founded to restore biological harmony, empower individual grace, and mentor future masters of the craft.',
                'genesis_eyebrow' => 'The Genesis',
                'genesis_title'   => 'Born From a Reverence For Stillness',
                'genesis_copy1'   => 'Founded in the cultural heart of Madurai, Glowup was conceived not simply as a salon, but as a temple of rejuvenation.',
                'genesis_copy2'   => 'We recognized that true beauty therapy transcends standard cosmetic procedures.',
                'stat1_value'     => '7+',
                'stat1_label'     => 'Years of Mastery',
                'stat2_value'     => '15K+',
                'stat2_label'     => 'Radiant Patrons',
                'stat3_value'     => '850+',
                'stat3_label'     => 'Certified Alumni',
                'genesis_image'   => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1000&q=80',
            ];
        }
        return $settings;
    }

    public function updateSettings(array $data): bool
    {
        $existing = $this->first();
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($existing) {
            return (bool) $this->update($existing['id'], $data);
        }
        return (bool) $this->insert($data);
    }
}
