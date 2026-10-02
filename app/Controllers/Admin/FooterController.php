<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\FooterSettingsModel;
use App\Models\FooterLinkModel;

class FooterController extends BaseController
{
    protected AdminAuth $auth;
    protected FooterSettingsModel $settingsModel;
    protected FooterLinkModel $linkModel;

    public function __construct()
    {
        $this->auth          = new AdminAuth();
        $this->settingsModel = new FooterSettingsModel();
        $this->linkModel     = new FooterLinkModel();
    }

    /**
     * Helper to get current admin user session
     */
    private function getAdminUser(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Alex Vance',
            'role'   => 'Super Administrator',
            'avatar' => 'AV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /**
     * Default redirect to Brand page
     */
    public function index()
    {
        return redirect()->to('/admin/website/footer/brand');
    }

    /**
     * 1. Brand Page: /admin/website/footer/brand
     */
    public function brand()
    {
        $settings = $this->settingsModel->getSettings();

        return view('admin/pages/footer_brand', [
            'pageTitle'         => 'Footer Brand | Glowup Admin',
            'pageHeading'       => 'Footer Brand Information',
            'pageIcon'          => 'badge',
            'breadcrumbSection' => 'Footer',
            'breadcrumbTitle'   => 'Brand',
            'activeMenu'        => 'footer_brand',
            'admin'             => $this->getAdminUser(),
            'settings'          => $settings,
        ]);
    }

    /**
     * 2. Quick Links Page: /admin/website/footer/quick-links
     */
    public function quickLinks()
    {
        $quickLinks = $this->linkModel->getAllByGroup('quick_links');

        return view('admin/pages/footer_quick_links', [
            'pageTitle'         => 'Footer Quick Links | Glowup Admin',
            'pageHeading'       => 'Footer Quick Links',
            'pageIcon'          => 'link',
            'breadcrumbSection' => 'Footer',
            'breadcrumbTitle'   => 'Quick Links',
            'activeMenu'        => 'footer_quick_links',
            'admin'             => $this->getAdminUser(),
            'quickLinks'        => $quickLinks,
        ]);
    }

    /**
     * 3. Treatments Page: /admin/website/footer/treatments
     */
    public function treatments()
    {
        $popularTreatments = $this->linkModel->getAllByGroup('popular_treatments');

        return view('admin/pages/footer_treatments', [
            'pageTitle'         => 'Footer Treatments | Glowup Admin',
            'pageHeading'       => 'Footer Popular Treatments',
            'pageIcon'          => 'spa',
            'breadcrumbSection' => 'Footer',
            'breadcrumbTitle'   => 'Treatments',
            'activeMenu'        => 'footer_treatments',
            'admin'             => $this->getAdminUser(),
            'popularTreatments' => $popularTreatments,
        ]);
    }

    /**
     * 4. Concierge Page: /admin/website/footer/concierge
     */
    public function concierge()
    {
        $settings = $this->settingsModel->getSettings();

        return view('admin/pages/footer_concierge', [
            'pageTitle'         => 'Footer Concierge | Glowup Admin',
            'pageHeading'       => 'Academy Concierge',
            'pageIcon'          => 'support_agent',
            'breadcrumbSection' => 'Footer',
            'breadcrumbTitle'   => 'Concierge',
            'activeMenu'        => 'footer_concierge',
            'admin'             => $this->getAdminUser(),
            'settings'          => $settings,
        ]);
    }

    /**
     * 5. Social Page: /admin/website/footer/social
     */
    public function social()
    {
        $settings = $this->settingsModel->getSettings();

        return view('admin/pages/footer_social', [
            'pageTitle'         => 'Footer Social Media | Glowup Admin',
            'pageHeading'       => 'Social Media Channels',
            'pageIcon'          => 'share',
            'breadcrumbSection' => 'Footer',
            'breadcrumbTitle'   => 'Social',
            'activeMenu'        => 'footer_social',
            'admin'             => $this->getAdminUser(),
            'settings'          => $settings,
        ]);
    }

    /**
     * 6. Bottom Page: /admin/website/footer/bottom
     */
    public function bottom()
    {
        $settings = $this->settingsModel->getSettings();

        return view('admin/pages/footer_bottom', [
            'pageTitle'         => 'Footer Bottom & Legal | Glowup Admin',
            'pageHeading'       => 'Footer Bottom Notes',
            'pageIcon'          => 'copyright',
            'breadcrumbSection' => 'Footer',
            'breadcrumbTitle'   => 'Bottom',
            'activeMenu'        => 'footer_bottom',
            'admin'             => $this->getAdminUser(),
            'settings'          => $settings,
        ]);
    }

    /**
     * Update Brand Section
     */
    public function updateBrand()
    {
        $currentSettings = $this->settingsModel->getSettings();
        $logoFile        = $this->request->getFile('brand_logo');

        // 1. Basic field validation
        $basicRules = [
            'brand_name'        => [
                'label' => 'Brand Name',
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required'   => 'Brand Name is mandatory.',
                    'min_length' => 'Brand Name must be at least 2 characters long.',
                ],
            ],
            'brand_subtitle'    => [
                'label' => 'Subtitle / Tagline',
                'rules' => 'permit_empty|max_length[255]',
            ],
            'brand_description' => [
                'label' => 'Brand Description',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];

        if (!$this->validate($basicRules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        // 2. Logo file validation (if uploaded)
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            $logoRules = [
                'brand_logo' => [
                    'label' => 'Brand Logo',
                    'rules' => 'max_size[brand_logo,2048]|ext_in[brand_logo,png,jpg,jpeg,webp,svg]|mime_in[brand_logo,image/png,image/jpeg,image/pjpeg,image/webp,image/svg+xml]',
                    'errors' => [
                        'max_size' => 'Brand Logo file size cannot exceed 2MB.',
                        'ext_in'   => 'Invalid image type. Permitted formats: PNG, JPG, JPEG, WEBP, SVG.',
                        'mime_in'  => 'Invalid mime type. Only image files (PNG, JPG, WEBP, SVG) are allowed.',
                    ],
                ],
            ];

            if (!$this->validate($logoRules)) {
                return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
            }
        } elseif ($logoFile && $logoFile->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'File upload error: ' . $logoFile->getErrorString());
        }

        $data = [
            'brand_name'        => trim((string) $this->request->getPost('brand_name')),
            'brand_subtitle'    => trim((string) $this->request->getPost('brand_subtitle')),
            'brand_description' => trim((string) $this->request->getPost('brand_description')),
        ];

        // 3. Handle Remove Logo option
        if ($this->request->getPost('remove_logo') === '1') {
            if (!empty($currentSettings['brand_logo']) && file_exists(FCPATH . $currentSettings['brand_logo'])) {
                @unlink(FCPATH . $currentSettings['brand_logo']);
            }
            $data['brand_logo'] = null;
        }

        // 4. Handle New Logo upload
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            $newName = $logoFile->getRandomName();
            $targetDir = FCPATH . 'uploads/footer';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            if ($logoFile->move($targetDir, $newName)) {
                // Delete previous custom uploaded logo if present
                if (!empty($currentSettings['brand_logo']) && file_exists(FCPATH . $currentSettings['brand_logo'])) {
                    @unlink(FCPATH . $currentSettings['brand_logo']);
                }
                $data['brand_logo'] = 'uploads/footer/' . $newName;
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to save the uploaded logo file.');
            }
        }

        // 5. Update Database Record
        $updated = $this->settingsModel->updateSettings($data);

        if (!$updated) {
            return redirect()->back()->withInput()->with('error', 'Database update failed. Please try again.');
        }

        return redirect()->to('/admin/website/footer/brand')->with('success', 'Footer Brand information saved successfully.');
    }

    /**
     * Update Academy Concierge Section
     */
    public function updateConcierge()
    {
        $rules = [
            'concierge_title'    => 'required|max_length[255]',
            'concierge_address'  => 'permit_empty',
            'concierge_phone'    => 'permit_empty|max_length[100]',
            'concierge_whatsapp' => 'permit_empty|max_length[100]',
            'concierge_email'    => 'permit_empty|valid_email|max_length[150]',
            'concierge_hours'    => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please check the Academy Concierge details.');
        }

        $data = [
            'concierge_title'    => trim($this->request->getPost('concierge_title')),
            'concierge_address'  => trim($this->request->getPost('concierge_address')),
            'concierge_phone'    => trim($this->request->getPost('concierge_phone')),
            'concierge_whatsapp' => trim($this->request->getPost('concierge_whatsapp')),
            'concierge_email'    => trim($this->request->getPost('concierge_email')),
            'concierge_hours'    => trim($this->request->getPost('concierge_hours')),
        ];

        $this->settingsModel->updateSettings($data);

        return redirect()->to('/admin/website/footer/concierge')->with('success', 'Academy Concierge information updated successfully.');
    }

    /**
     * Update Social Media Links
     */
    public function updateSocial()
    {
        $data = [
            'social_instagram' => trim($this->request->getPost('social_instagram') ?: '#'),
            'social_pinterest' => trim($this->request->getPost('social_pinterest') ?: '#'),
            'social_facebook'  => trim($this->request->getPost('social_facebook') ?: '#'),
            'social_youtube'   => trim($this->request->getPost('social_youtube') ?: '#'),
            'social_location'  => trim($this->request->getPost('social_location') ?: '#'),
        ];

        $this->settingsModel->updateSettings($data);

        return redirect()->to('/admin/website/footer/social')->with('success', 'Social media channel links updated successfully.');
    }

    /**
     * Update Footer Bottom / Legal
     */
    public function updateBottom()
    {
        $rules = [
            'copyright_text'  => 'required|max_length[255]',
            'additional_text' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide copyright statement text.');
        }

        $data = [
            'copyright_text'  => trim($this->request->getPost('copyright_text')),
            'additional_text' => trim($this->request->getPost('additional_text')),
        ];

        $this->settingsModel->updateSettings($data);

        return redirect()->to('/admin/website/footer/bottom')->with('success', 'Footer bottom notes and copyright updated successfully.');
    }

    /**
     * Save Link (Quick Link or Treatment)
     */
    public function saveLink()
    {
        $rules = [
            'group_name' => 'required|in_list[quick_links,popular_treatments]',
            'title'      => 'required|max_length[255]',
            'url'        => 'required|max_length[255]',
            'sort_order' => 'permit_empty|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid Link Name and Destination URL.');
        }

        $id        = (int) $this->request->getPost('id');
        $groupName = $this->request->getPost('group_name');
        $title     = trim($this->request->getPost('title'));
        $url       = trim($this->request->getPost('url'));
        $sortOrder = (int) $this->request->getPost('sort_order');
        $status    = $this->request->getPost('status') !== null ? 1 : 0;

        $data = [
            'group_name' => $groupName,
            'title'      => $title,
            'url'        => $url,
            'sort_order' => $sortOrder,
            'status'     => $status,
        ];

        if ($id > 0) {
            $this->linkModel->update($id, $data);
            $actionWord = 'updated';
        } else {
            if ($sortOrder === 0) {
                $maxOrder = $this->linkModel->where('group_name', $groupName)->selectMax('sort_order')->first();
                $data['sort_order'] = ((int) ($maxOrder['sort_order'] ?? 0)) + 1;
            }
            $this->linkModel->insert($data);
            $actionWord = 'added';
        }

        $groupLabel = $groupName === 'quick_links' ? 'Quick Link' : 'Treatment Link';
        $redirectUrl = $groupName === 'quick_links' ? '/admin/website/footer/quick-links' : '/admin/website/footer/treatments';
        return redirect()->to($redirectUrl)->with('success', "{$groupLabel} {$actionWord} successfully.");
    }

    /**
     * Delete Link
     */
    public function deleteLink(int $id)
    {
        $link = $this->linkModel->find($id);
        if (!$link) {
            return redirect()->to('/admin/website/footer/quick-links')->with('error', 'The requested link could not be found.');
        }

        $this->linkModel->delete($id);
        $groupLabel = $link['group_name'] === 'quick_links' ? 'Quick Link' : 'Treatment Link';
        $redirectUrl = $link['group_name'] === 'quick_links' ? '/admin/website/footer/quick-links' : '/admin/website/footer/treatments';

        return redirect()->to($redirectUrl)->with('success', "{$groupLabel} removed successfully.");
    }

    /**
     * Reorder Links
     */
    public function reorderLinks()
    {
        $groupName = $this->request->getPost('group_name');
        $orderIds  = $this->request->getPost('order');

        if (!in_array($groupName, ['quick_links', 'popular_treatments']) || !is_array($orderIds)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid reorder parameters.']);
            }
            return redirect()->back()->with('error', 'Invalid reorder request.');
        }

        $this->linkModel->updateOrder($groupName, $orderIds);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Order updated successfully.']);
        }

        $redirectUrl = $groupName === 'quick_links' ? '/admin/website/footer/quick-links' : '/admin/website/footer/treatments';
        return redirect()->to($redirectUrl)->with('success', 'Navigation links reordered successfully.');
    }

    /**
     * Move link up/down in sequence
     */
    public function moveLink($id, $direction)
    {
        $id = (int) $id;
        $direction = strtolower($direction) === 'up' ? 'up' : 'down';

        $link = $this->linkModel->find($id);
        if (!$link) {
            return redirect()->to('/admin/website/footer/quick-links')->with('error', 'Link not found.');
        }

        $this->linkModel->moveItem($id, $direction);

        $redirectUrl = $link['group_name'] === 'quick_links' ? '/admin/website/footer/quick-links' : '/admin/website/footer/treatments';
        return redirect()->to($redirectUrl)->with('success', 'Link sequence updated successfully.');
    }
}
