<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\BlogModel;
use App\Models\BlogCategoryModel;

class BlogController extends BaseController
{
    protected AdminAuth $auth;
    protected BlogModel $blogModel;
    protected BlogCategoryModel $categoryModel;

    public function __construct()
    {
        $this->auth          = new AdminAuth();
        $this->blogModel     = new BlogModel();
        $this->categoryModel = new BlogCategoryModel();

        // Ensure upload directory exists
        $dir = FCPATH . 'uploads/blog';
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
     * Blog Posts List & Management Console (/admin/blog)
     */
    public function index()
    {
        $search     = trim((string) $this->request->getGet('q'));
        $categoryId = $this->request->getGet('category');

        $builder = $this->blogModel->orderBy('id', 'DESC');

        if (!empty($categoryId) && $categoryId !== 'all') {
            $builder->where('category_id', (int) $categoryId);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('title', $search)
                    ->orLike('summary', $search)
                    ->orLike('author_name', $search)
                    ->groupEnd();
        }

        $posts = $builder->findAll();
        $categories = $this->categoryModel->orderBy('sort_order', 'ASC')->findAll();

        $stats = [
            'total'     => $this->blogModel->countAllResults(),
            'published' => $this->blogModel->where('is_published', 1)->countAllResults(),
            'featured'  => $this->blogModel->where('is_featured', 1)->countAllResults(),
            'views'     => array_sum(array_column($posts, 'views_count')),
        ];

        return view('admin/pages/blog', [
            'pageTitle'         => 'Editorial Blog & Articles | Glowup Admin',
            'pageHeading'       => 'Editorial Beauty Journal',
            'pageIcon'          => 'article',
            'breadcrumbSection' => 'Blog',
            'breadcrumbTitle'   => 'Blog Posts',
            'activeMenu'        => 'blog',
            'admin'             => $this->getAdminData(),
            'posts'             => $posts,
            'categories'        => $categories,
            'currentCategory'   => $categoryId ?: 'all',
            'searchQuery'       => $search,
            'stats'             => $stats,
        ]);
    }

    /**
     * Save Blog Post (Add or Edit)
     */
    public function savePost()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'title'   => 'required|min_length[3]|max_length[255]',
            'summary' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid article title and summary narrative.');
        }

        $title = trim((string) $this->request->getPost('title'));
        $slug  = trim((string) $this->request->getPost('slug'));
        if (empty($slug)) {
            $slug = url_title($title, '-', true);
        }

        $catId   = (int) $this->request->getPost('category_id');
        $catName = 'Artistry Insights';
        if ($catId > 0) {
            $c = $this->categoryModel->find($catId);
            if ($c) {
                $catName = $c['name'];
            }
        }

        $data = [
            'title'         => $title,
            'slug'          => $slug,
            'category_id'   => $catId ?: null,
            'category_name' => $catName,
            'author_name'   => trim((string) $this->request->getPost('author_name')) ?: 'Priya Varma',
            'summary'       => trim((string) $this->request->getPost('summary')),
            'content'       => trim((string) $this->request->getPost('content')),
            'is_featured'   => $this->request->getPost('is_featured') ? 1 : 0,
            'is_published'  => $this->request->getPost('is_published') ? 1 : 0,
        ];

        // Image upload or link
        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/blog', $newName);
            $data['featured_image'] = 'uploads/blog/' . $newName;
        } elseif ($url = trim((string) $this->request->getPost('featured_image'))) {
            $data['featured_image'] = $url;
        }

        if ($id > 0) {
            $this->blogModel->update($id, $data);
            $msg = 'Article updated successfully.';
        } else {
            $data['published_at'] = date('Y-m-d H:i:s');
            $data['views_count']  = 0;
            if (empty($data['featured_image'])) {
                $data['featured_image'] = 'images/slide-bridal.jpg';
            }
            $this->blogModel->insert($data);
            $msg = 'New article published successfully.';
        }

        return redirect()->to(base_url('admin/blog'))->with('success', $msg);
    }

    /**
     * Delete Blog Post
     */
    public function deletePost($id)
    {
        $this->blogModel->delete($id);
        return redirect()->to(base_url('admin/blog'))->with('success', 'Article removed.');
    }

    /**
     * Toggle Published Status
     */
    public function togglePublish($id)
    {
        $post = $this->blogModel->find($id);
        if (!$post) {
            return $this->response->setJSON(['status' => false, 'message' => 'Post not found']);
        }

        $newVal = $post['is_published'] ? 0 : 1;
        $this->blogModel->update($id, ['is_published' => $newVal]);

        return $this->response->setJSON([
            'status'     => true,
            'new_status' => $newVal,
            'message'    => 'Article visibility updated.',
        ]);
    }

    /**
     * Toggle Featured Status
     */
    public function toggleFeatured($id)
    {
        $post = $this->blogModel->find($id);
        if (!$post) {
            return $this->response->setJSON(['status' => false, 'message' => 'Post not found']);
        }

        $newVal = $post['is_featured'] ? 0 : 1;
        $this->blogModel->update($id, ['is_featured' => $newVal]);

        return $this->response->setJSON([
            'status'       => true,
            'new_featured' => $newVal,
            'message'      => 'Featured status updated.',
        ]);
    }

    /**
     * Blog Categories Console (/admin/blog/categories)
     */
    public function categories()
    {
        $categories = $this->categoryModel->orderBy('sort_order', 'ASC')->findAll();

        return view('admin/pages/blog_categories', [
            'pageTitle'         => 'Blog Categories | Glowup Admin',
            'pageHeading'       => 'Editorial Categories',
            'pageIcon'          => 'category',
            'breadcrumbSection' => 'Blog',
            'breadcrumbTitle'   => 'Categories',
            'activeMenu'        => 'blog_categories',
            'admin'             => $this->getAdminData(),
            'categories'        => $categories,
            'stats'             => [
                'total'  => count($categories),
                'active' => count(array_filter($categories, fn($c) => $c['is_active'] == 1)),
            ],
        ]);
    }

    /**
     * Save Blog Category
     */
    public function saveCategory()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid category name.');
        }

        $name = trim((string) $this->request->getPost('name'));
        $slug = trim((string) $this->request->getPost('slug'));
        if (empty($slug)) {
            $slug = url_title($name, '-', true);
        }

        $data = [
            'name'        => $name,
            'slug'        => $slug,
            'description' => trim((string) $this->request->getPost('description')),
            'sort_order'  => (int) $this->request->getPost('sort_order'),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($id > 0) {
            $this->categoryModel->update($id, $data);
            $msg = 'Category updated successfully.';
        } else {
            $this->categoryModel->insert($data);
            $msg = 'New editorial category created.';
        }

        return redirect()->to(base_url('admin/blog/categories'))->with('success', $msg);
    }

    /**
     * Delete Blog Category
     */
    public function deleteCategory($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to(base_url('admin/blog/categories'))->with('success', 'Category removed.');
    }
}
