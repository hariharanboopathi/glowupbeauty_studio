<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\GalleryModel;

class MediaController extends BaseController
{
    protected AdminAuth $auth;
    protected GalleryModel $galleryModel;

    public function __construct()
    {
        $this->auth         = new AdminAuth();
        $this->galleryModel = new GalleryModel();

        // Ensure gallery upload folder exists
        $dir = FCPATH . 'uploads/gallery';
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
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
     * Gallery Manager View (/admin/website/gallery)
     */
    public function gallery()
    {
        $category = $this->request->getGet('category') ?: 'all';
        $search   = trim((string) $this->request->getGet('q'));

        $builder = $this->galleryModel->orderBy('sort_order', 'ASC')->orderBy('id', 'DESC');

        if ($category !== 'all' && !empty($category)) {
            $builder->where('category', $category);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('title', $search)
                    ->orLike('description', $search)
                    ->groupEnd();
        }

        $items = $builder->findAll();

        // Metrics
        $totalItems    = $this->galleryModel->countAllResults();
        $featuredCount = $this->galleryModel->where('is_featured', 1)->countAllResults();
        $activeCount   = $this->galleryModel->where('is_active', 1)->countAllResults();

        return view('admin/pages/website_gallery', [
            'pageTitle'         => 'Visual Gallery & Lookbook | Glowup Admin',
            'pageHeading'       => 'Visual Lookbook & Gallery',
            'pageIcon'          => 'photo_library',
            'breadcrumbSection' => 'Website Content',
            'breadcrumbTitle'   => 'Gallery',
            'activeMenu'        => 'website_gallery',
            'admin'             => $this->getAdminData(),
            'items'             => $items,
            'currentCategory'   => $category,
            'searchQuery'       => $search,
            'stats'             => [
                'total'    => $totalItems,
                'featured' => $featuredCount,
                'active'   => $activeCount,
            ],
        ]);
    }

    /**
     * Visual Portfolio Showcase (/admin/media/portfolio)
     */
    public function portfolio()
    {
        $items = $this->galleryModel->orderBy('sort_order', 'ASC')->findAll();

        return view('admin/pages/portfolio', [
            'pageTitle'         => 'Portfolio Showcase | Glowup Admin',
            'pageHeading'       => 'Haute Artistry Portfolio',
            'pageIcon'          => 'auto_awesome_mosaic',
            'breadcrumbSection' => 'Media',
            'breadcrumbTitle'   => 'Portfolio',
            'activeMenu'        => 'portfolio',
            'admin'             => $this->getAdminData(),
            'items'             => $items,
        ]);
    }

    /**
     * Save / Update Gallery Item
     */
    public function saveGallery()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'title'    => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid title and category.');
        }

        $data = [
            'title'           => trim((string) $this->request->getPost('title')),
            'category'        => trim((string) $this->request->getPost('category')),
            'description'     => trim((string) $this->request->getPost('description')),
            'sort_order'      => (int) $this->request->getPost('sort_order'),
            'is_featured'     => $this->request->getPost('is_featured') ? 1 : 0,
            'is_active'       => $this->request->getPost('is_active') ? 1 : 0,
            'is_before_after' => $this->request->getPost('is_before_after') ? 1 : 0,
        ];

        // Handle Image Upload or External URL
        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/gallery', $newName);
            $data['image_url'] = 'uploads/gallery/' . $newName;
        } else {
            $urlInput = trim((string) $this->request->getPost('image_url'));
            if (!empty($urlInput)) {
                $data['image_url'] = $urlInput;
            }
        }

        // Before & After images
        $beforeFile = $this->request->getFile('before_file');
        if ($beforeFile && $beforeFile->isValid() && !$beforeFile->hasMoved()) {
            $bName = $beforeFile->getRandomName();
            $beforeFile->move(FCPATH . 'uploads/gallery', $bName);
            $data['before_image'] = 'uploads/gallery/' . $bName;
        } elseif ($bUrl = trim((string) $this->request->getPost('before_image'))) {
            $data['before_image'] = $bUrl;
        }

        $afterFile = $this->request->getFile('after_file');
        if ($afterFile && $afterFile->isValid() && !$afterFile->hasMoved()) {
            $aName = $afterFile->getRandomName();
            $afterFile->move(FCPATH . 'uploads/gallery', $aName);
            $data['after_image'] = 'uploads/gallery/' . $aName;
        } elseif ($aUrl = trim((string) $this->request->getPost('after_image'))) {
            $data['after_image'] = $aUrl;
        }

        if ($id > 0) {
            $this->galleryModel->update($id, $data);
            $msg = 'Gallery lookbook item updated successfully.';
        } else {
            if (empty($data['image_url'])) {
                $data['image_url'] = 'images/slide-bridal.jpg';
            }
            $this->galleryModel->insert($data);
            $msg = 'New gallery lookbook item created successfully.';
        }

        return redirect()->to(base_url('admin/website/gallery'))->with('success', $msg);
    }

    /**
     * Delete Gallery Item
     */
    public function deleteGallery($id)
    {
        $item = $this->galleryModel->find($id);
        if ($item) {
            $this->galleryModel->delete($id);
            return redirect()->back()->with('success', 'Gallery item removed successfully.');
        }
        return redirect()->back()->with('error', 'Gallery item not found.');
    }

    /**
     * Toggle Active Status
     */
    public function toggleGalleryStatus($id)
    {
        $item = $this->galleryModel->find($id);
        if (!$item) {
            return $this->response->setJSON(['status' => false, 'message' => 'Item not found']);
        }

        $newStatus = $item['is_active'] ? 0 : 1;
        $this->galleryModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'status'     => true,
            'new_status' => $newStatus,
            'message'    => 'Status updated successfully.',
        ]);
    }

    /**
     * Toggle Featured Status
     */
    public function toggleGalleryFeatured($id)
    {
        $item = $this->galleryModel->find($id);
        if (!$item) {
            return $this->response->setJSON(['status' => false, 'message' => 'Item not found']);
        }

        $newVal = $item['is_featured'] ? 0 : 1;
        $this->galleryModel->update($id, ['is_featured' => $newVal]);

        return $this->response->setJSON([
            'status'       => true,
            'new_featured' => $newVal,
            'message'      => 'Featured status updated.',
        ]);
    }
}
