<?php

namespace App\Models;

use CodeIgniter\Model;

class SeoModel extends Model
{
    protected $table            = 'seo_metadata';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'page_key',
        'page_name',
        'seo_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'robots',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * In-memory cache for current request cycle
     */
    protected static array $pageCache = [];

    /**
     * Retrieve SEO record by page key
     */
    public function getByPageKey(string $pageKey): ?array
    {
        $pageKey = trim(strtolower($pageKey));

        if (isset(self::$pageCache[$pageKey])) {
            return self::$pageCache[$pageKey];
        }

        try {
            $record = $this->where('page_key', $pageKey)->first();
            if ($record) {
                self::$pageCache[$pageKey] = $record;
                return $record;
            }
        } catch (\Throwable $e) {
            log_message('error', 'SeoModel getByPageKey Error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Retrieve all SEO records indexed by page key
     */
    public function getAllIndexed(): array
    {
        try {
            $rows = $this->orderBy('id', 'ASC')->findAll();
            $indexed = [];
            foreach ($rows as $row) {
                $indexed[$row['page_key']] = $row;
            }
            return $indexed;
        } catch (\Throwable $e) {
            log_message('error', 'SeoModel getAllIndexed Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Save or update SEO settings for a specific page key
     */
    public function savePageSeo(string $pageKey, array $data): bool
    {
        $pageKey = trim(strtolower($pageKey));
        $existing = $this->where('page_key', $pageKey)->first();

        $updateData = [
            'seo_title'        => !empty($data['seo_title']) ? trim((string) $data['seo_title']) : null,
            'meta_description' => !empty($data['meta_description']) ? trim((string) $data['meta_description']) : null,
            'meta_keywords'    => !empty($data['meta_keywords']) ? trim((string) $data['meta_keywords']) : null,
            'canonical_url'    => !empty($data['canonical_url']) ? trim((string) $data['canonical_url']) : null,
            'og_title'         => !empty($data['og_title']) ? trim((string) $data['og_title']) : null,
            'og_description'   => !empty($data['og_description']) ? trim((string) $data['og_description']) : null,
            'og_image'         => !empty($data['og_image']) ? trim((string) $data['og_image']) : null,
            'robots'           => !empty($data['robots']) ? trim((string) $data['robots']) : 'index, follow',
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        if (!empty($data['page_name'])) {
            $updateData['page_name'] = trim((string) $data['page_name']);
        }

        if ($existing) {
            $result = (bool) $this->update($existing['id'], $updateData);
            if ($result) {
                unset(self::$pageCache[$pageKey]);
            }
            return $result;
        }

        $updateData['page_key']   = $pageKey;
        $updateData['page_name']  = $data['page_name'] ?? ucfirst($pageKey);
        $updateData['created_at'] = date('Y-m-d H:i:s');

        $insertId = $this->insert($updateData);
        if ($insertId) {
            unset(self::$pageCache[$pageKey]);
            return true;
        }

        return false;
    }

    /**
     * Canonical list of all manageable public pages with human-readable labels and URL paths
     */
    public static function getPageCatalog(): array
    {
        return [
            'home' => [
                'name'  => 'Homepage',
                'route' => '/',
                'desc'  => 'Main landing page, hero section, philosophy, and featured services.',
            ],
            'about' => [
                'name'  => 'About Us',
                'route' => '/about',
                'desc'  => 'Studio philosophy, genesis story, and team master specialists.',
            ],
            'services' => [
                'name'  => 'Services & Treatments',
                'route' => '/services',
                'desc'  => 'Full treatment menu, facials, haircare rituals, and pricing.',
            ],
            'academy' => [
                'name'  => 'Academy & Courses',
                'route' => '/academy',
                'desc'  => 'Professional certification courses, curriculum, and admissions.',
            ],
            'bridal' => [
                'name'  => 'Bridal Packages',
                'route' => '/bridal',
                'desc'  => 'Bespoke bridal makeover packages, couture tiers, and wedding rituals.',
            ],
            'rentals' => [
                'name'  => 'Rentals & Jewellery',
                'route' => '/rentals',
                'desc'  => 'Luxury bridal jewellery hire and photoshoot costume accessories.',
            ],
            'photoshoot' => [
                'name'  => 'Photoshoot Sessions',
                'route' => '/photoshoot',
                'desc'  => 'Editorial styling, model portfolio shoots, and studio sessions.',
            ],
            'events' => [
                'name'  => 'Studio Events & Workshops',
                'route' => '/events',
                'desc'  => 'Masterclasses, beauty workshops, and private studio events.',
            ],
            'gallery' => [
                'name'  => 'Visual Gallery & Lookbook',
                'route' => '/gallery',
                'desc'  => 'Lookbook transformations, hair and skin before/after portfolio.',
            ],
            'reviews' => [
                'name'  => 'Patron Reviews & Testimonials',
                'route' => '/review',
                'desc'  => 'Verified client experiences, rating statistics, and reviews.',
            ],
            'blog' => [
                'name'  => 'Editorial Journal & Blog',
                'route' => '/blog',
                'desc'  => 'Beauty reflections, skincare insights, and master styling articles.',
            ],
            'contact' => [
                'name'  => 'Contact & Concierge',
                'route' => '/contact',
                'desc'  => 'Studio concierge address, telephone, WhatsApp, and contact form.',
            ],
            'booking' => [
                'name'  => 'Online Appointment Booking',
                'route' => '/booking',
                'desc'  => 'Online appointment reservation calendar and specialist selection.',
            ],
            'profile' => [
                'name'  => 'Patron Sanctuary Portal',
                'route' => '/profile',
                'desc'  => 'Patron appointment dossier, billing history, and privileges.',
            ],
            'register' => [
                'name'  => 'Customer Registration',
                'route' => '/register',
                'desc'  => 'Patron signup and sanctuary account creation.',
            ],
            'login' => [
                'name'  => 'Customer Sign In',
                'route' => '/login',
                'desc'  => 'Patron sign-in and Google authentication gateway.',
            ],
        ];
    }
}
