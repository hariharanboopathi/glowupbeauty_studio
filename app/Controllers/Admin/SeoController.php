<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\SeoModel;

class SeoController extends BaseController
{
    protected AdminAuth $auth;
    protected SeoModel $seoModel;

    public function __construct()
    {
        $this->auth     = new AdminAuth();
        $this->seoModel = new SeoModel();

        // Ensure seo uploads directory exists
        $uploadPath = FCPATH . 'uploads/seo';
        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0755, true);
        }
    }

    protected function getAdminData(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Alex Vance',
            'role'   => 'Super Administrator',
            'avatar' => 'AV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /**
     * SEO Management Console (/admin/seo)
     */
    public function index($selectedKey = null)
    {
        $catalog = SeoModel::getPageCatalog();
        
        // Priority: URI param > Query param > default 'home'
        $activeKey = $selectedKey ?: ($this->request->getGet('page') ?: 'home');
        $activeKey = strtolower(trim((string) $activeKey));

        if (!array_key_exists($activeKey, $catalog)) {
            $activeKey = 'home';
        }

        $allIndexed = $this->seoModel->getAllIndexed();
        $activeSeo  = $this->seoModel->getByPageKey($activeKey);

        // If no DB record exists yet for this page, initialize default structure from catalog
        if (!$activeSeo) {
            $activeSeo = [
                'page_key'         => $activeKey,
                'page_name'        => $catalog[$activeKey]['name'],
                'seo_title'        => $catalog[$activeKey]['name'] . ' | Glowup Beauty Studio & Academy',
                'meta_description' => $catalog[$activeKey]['desc'],
                'meta_keywords'    => '',
                'canonical_url'    => '',
                'og_title'         => '',
                'og_description'   => '',
                'og_image'         => '',
                'robots'           => 'index, follow',
            ];
        }

        return view('admin/pages/seo', [
            'pageTitle'         => 'SEO & Meta Management | Glowup Admin',
            'pageHeading'       => 'SEO & Meta Optimization',
            'pageIcon'          => 'search',
            'breadcrumbSection' => 'Website Content',
            'breadcrumbTitle'   => 'SEO Management',
            'activeMenu'        => 'seo',
            'admin'             => $this->getAdminData(),
            'catalog'           => $catalog,
            'allIndexed'        => $allIndexed,
            'activeKey'         => $activeKey,
            'activeInfo'        => $catalog[$activeKey],
            'seo'               => $activeSeo,
        ]);
    }

    /**
     * Save / Update SEO Settings for Selected Page
     */
    public function save()
    {
        $catalog = SeoModel::getPageCatalog();
        $pageKey = strtolower(trim((string) $this->request->getPost('page_key')));

        if (!array_key_exists($pageKey, $catalog)) {
            return redirect()->to(base_url('admin/seo'))->with('error', 'Invalid page selection.');
        }

        $rules = [
            'seo_title'        => 'permit_empty|max_length[255]',
            'meta_description' => 'permit_empty|max_length[1000]',
            'meta_keywords'    => 'permit_empty|max_length[1000]',
            'canonical_url'    => 'permit_empty|valid_url_strict|max_length[500]',
            'og_title'         => 'permit_empty|max_length[255]',
            'og_description'   => 'permit_empty|max_length[1000]',
            'robots'           => 'permit_empty|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('admin/seo?page=' . $pageKey))
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $ogImage = trim((string) $this->request->getPost('og_image'));

        // Handle File Upload for Open Graph Image
        $imgFile = $this->request->getFile('og_image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            $mimeType = $imgFile->getMimeType();

            if (!in_array($mimeType, $allowedTypes, true)) {
                return redirect()->to(base_url('admin/seo?page=' . $pageKey))
                    ->withInput()
                    ->with('error', 'Invalid image format for Social Share. Allowed: JPG, PNG, WEBP, GIF.');
            }

            if ($imgFile->getSize() > 4 * 1024 * 1024) {
                return redirect()->to(base_url('admin/seo?page=' . $pageKey))
                    ->withInput()
                    ->with('error', 'Image file is too large. Maximum size allowed is 4MB.');
            }

            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/seo', $newName);
            $ogImage = 'uploads/seo/' . $newName;
        }

        $data = [
            'page_name'        => $catalog[$pageKey]['name'],
            'seo_title'        => $this->request->getPost('seo_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords'    => $this->request->getPost('meta_keywords'),
            'canonical_url'    => $this->request->getPost('canonical_url'),
            'og_title'         => $this->request->getPost('og_title'),
            'og_description'   => $this->request->getPost('og_description'),
            'og_image'         => $ogImage,
            'robots'           => $this->request->getPost('robots') ?: 'index, follow',
        ];

        $saved = $this->seoModel->savePageSeo($pageKey, $data);

        if ($saved) {
            return redirect()->to(base_url('admin/seo?page=' . $pageKey))
                ->with('success', "SEO metadata for '{$catalog[$pageKey]['name']}' updated successfully.");
        }

        return redirect()->to(base_url('admin/seo?page=' . $pageKey))
            ->withInput()
            ->with('error', 'Unable to save SEO settings. Please try again.');
    }
}
