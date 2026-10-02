<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\ServiceModel;
use App\Models\CategoryModel;

class ServiceController extends BaseController
{
    protected AdminAuth $auth;
    protected ServiceModel $serviceModel;
    protected CategoryModel $categoryModel;

    public function __construct()
    {
        $this->auth = new AdminAuth();
        $this->serviceModel = new ServiceModel();
        $this->categoryModel = new CategoryModel();

        // Ensure upload folder exists
        $uploadPath = FCPATH . 'uploads/services';
        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
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
     * List and manage services
     */
    public function index()
    {
        $search   = trim((string) $this->request->getGet('search'));
        $category = trim((string) $this->request->getGet('category'));
        $status   = $this->request->getGet('status');

        if ($status !== null && $status !== '' && $status !== 'all') {
            $status = (string) (int) $status;
        } else {
            $status = null;
        }

        $page    = max(1, (int) $this->request->getGet('page'));
        $perPage = 15;
        $offset  = ($page - 1) * $perPage;

        $services      = $this->serviceModel->getFilteredServices($search, $category, $status, $perPage, $offset);
        $totalMatching = $this->serviceModel->getFilteredCount($search, $category, $status);
        $totalPages    = max(1, (int) ceil($totalMatching / $perPage));
        $categoryStats = $this->serviceModel->getCategoryCounts();
        $categories    = $this->categoryModel->getAllCategories();
        $categoryMap   = $this->categoryModel->getCategoryMap();

        return view('admin/pages/website_services', [
            'pageTitle'         => 'Services Management | Glowup Admin',
            'pageHeading'       => 'Services & Treatment Menu',
            'pageIcon'          => 'spa',
            'breadcrumbSection' => 'Website Content',
            'breadcrumbTitle'   => 'Services',
            'activeMenu'        => 'services',
            'admin'             => $this->getAdminData(),
            'services'          => $services,
            'search'            => $search,
            'currentCategory'   => $category ?: 'all',
            'statusFilter'      => $status,
            'currentPage'       => $page,
            'totalPages'        => $totalPages,
            'totalMatching'     => $totalMatching,
            'perPage'           => $perPage,
            'categoryStats'     => $categoryStats,
            'categories'        => $categories,
            'categoryMap'       => $categoryMap,
        ]);
    }

    /**
     * Create or update service
     */
    public function save()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'name'     => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
            'price'    => 'required|numeric',
            'duration' => 'permit_empty|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $imageUrl = $this->request->getPost('image_url');
        $imgFile  = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/services', $newName);
            $imageUrl = 'uploads/services/' . $newName;
        }

        $data = [
            'name'        => trim((string) $this->request->getPost('name')),
            'category'    => trim((string) $this->request->getPost('category')),
            'price'       => (float) $this->request->getPost('price'),
            'duration'    => trim((string) $this->request->getPost('duration')) ?: '60 Minutes',
            'description' => trim((string) $this->request->getPost('description')),
            'button_text' => trim((string) $this->request->getPost('button_text')) ?: 'Book Now',
            'button_url'  => trim((string) $this->request->getPost('button_url')) ?: 'booking',
            'is_featured' => $this->request->getPost('is_featured') ? 1 : 0,
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
            'sort_order'  => (int) ($this->request->getPost('sort_order') ?? 0),
        ];

        if (!empty($imageUrl)) {
            $data['image_url'] = $imageUrl;
        }

        if (!empty($id)) {
            $this->serviceModel->update($id, $data);
            $msg = 'Treatment updated successfully!';
        } else {
            $this->serviceModel->insert($data);
            $msg = 'New treatment created successfully!';
        }

        return redirect()->to(base_url('admin/website/services'))->with('success', $msg);
    }

    /**
     * Delete service
     */
    public function delete($id)
    {
        $service = $this->serviceModel->find($id);
        if ($service) {
            $this->serviceModel->delete($id);
            return redirect()->to(base_url('admin/website/services'))->with('success', 'Treatment removed successfully.');
        }
        return redirect()->to(base_url('admin/website/services'))->with('error', 'Treatment not found.');
    }

    /**
     * Toggle Active Status
     */
    public function toggleStatus($id)
    {
        $service = $this->serviceModel->find($id);
        if ($service) {
            $newStatus = $service['is_active'] ? 0 : 1;
            $this->serviceModel->update($id, ['is_active' => $newStatus]);
            return redirect()->back()->with('success', 'Treatment status updated.');
        }
        return redirect()->back()->with('error', 'Treatment record not found.');
    }

    /**
     * Toggle Featured Status
     */
    public function toggleFeatured($id)
    {
        $service = $this->serviceModel->find($id);
        if ($service) {
            $newFeatured = $service['is_featured'] ? 0 : 1;
            $this->serviceModel->update($id, ['is_featured' => $newFeatured]);
            return redirect()->back()->with('success', 'Featured spotlight status updated.');
        }
        return redirect()->back()->with('error', 'Treatment record not found.');
    }

    /**
     * Save category (Add or Edit)
     */
    public function saveCategory()
    {
        $id   = (int) $this->request->getPost('id');
        $name = trim((string) $this->request->getPost('category_name'));

        if (empty($name)) {
            return redirect()->back()->with('error', 'Category name cannot be empty.');
        }

        $slug = url_title(strtolower($name), '-', true);
        if (empty($slug)) {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name));
        }

        // Check if slug is used by another category
        $existing = $this->categoryModel->where('slug', $slug)->first();
        if ($existing && (int) $existing['id'] !== $id) {
            return redirect()->back()->with('error', 'A category with this name already exists.');
        }

        $data = [
            'category_name' => $name,
            'slug'          => $slug,
        ];

        if ($id > 0) {
            $oldCat = $this->categoryModel->find($id);
            $this->categoryModel->update($id, $data);

            // If slug changed, update associated services
            if ($oldCat && !empty($oldCat['slug']) && $oldCat['slug'] !== $slug) {
                $this->serviceModel->where('category', $oldCat['slug'])->set(['category' => $slug])->update();
            }

            $msg = 'Category updated successfully!';
        } else {
            $this->categoryModel->insert($data);
            $msg = 'New category added successfully!';
        }

        return redirect()->to(base_url('admin/website/services'))->with('success', $msg);
    }

    /**
     * Delete category
     */
    public function deleteCategory($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to(base_url('admin/website/services'))->with('error', 'Category not found.');
        }

        // Prevent deletion if services are currently assigned
        $linkedCount = $this->serviceModel->where('category', $category['slug'])->countAllResults();
        if ($linkedCount > 0) {
            return redirect()->to(base_url('admin/website/services'))->with('error', "Cannot delete '{$category['category_name']}' because {$linkedCount} rituals are assigned to it. Reassign those rituals first.");
        }

        $this->categoryModel->delete($id);
        return redirect()->to(base_url('admin/website/services'))->with('success', 'Category deleted successfully.');
    }
}
