<?php

namespace App\Models;

use CodeIgniter\Model;

class HomepageSectionModel extends Model
{
    protected $table            = 'homepage_sections';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'section_key',
        'title',
        'subtitle',
        'content',
        'meta_data',
        'updated_at',
    ];

    protected $useTimestamps = false;

    /**
     * Helper to get section with decoded meta_data
     */
    public function getSection(string $key): ?array
    {
        $section = $this->where('section_key', $key)->first();
        if ($section) {
            $section['meta'] = !empty($section['meta_data']) ? json_decode($section['meta_data'], true) : [];
        }
        return $section;
    }

    /**
     * Helper to update section with encoded meta_data
     */
    public function updateSection(string $key, array $data, array $meta = []): bool
    {
        $existing = $this->where('section_key', $key)->first();
        $payload = [
            'section_key' => $key,
            'title'       => $data['title'] ?? null,
            'subtitle'    => $data['subtitle'] ?? null,
            'content'     => $data['content'] ?? null,
            'meta_data'   => !empty($meta) ? json_encode($meta, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : null,
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            return (bool) $this->update($existing['id'], $payload);
        }

        return (bool) $this->insert($payload);
    }
}
