<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\HomepageSectionModel;
use App\Models\HomepageSlideModel;
use App\Models\HomepageServiceModel;

class HomepageController extends BaseController
{
    protected AdminAuth $auth;
    protected HomepageSectionModel $sectionModel;
    protected HomepageSlideModel $slideModel;
    protected HomepageServiceModel $serviceModel;

    public function __construct()
    {
        $this->auth         = new AdminAuth();
        $this->sectionModel = new HomepageSectionModel();
        $this->slideModel   = new HomepageSlideModel();
        $this->serviceModel = new HomepageServiceModel();

        // Ensure upload directory exists
        $uploadPath = FCPATH . 'uploads/homepage';
        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
        }
    }

    /**
     * Display Homepage Management Page
     */
    public function index()
    {
        $admin = $this->auth->user() ?? [
            'name'   => 'Alex Vance',
            'role'   => 'Super Administrator',
            'avatar' => 'AV',
            'email'  => 'admin@glowup.com',
        ];

        $hero = $this->sectionModel->getSection('hero');
        $philosophy = $this->sectionModel->getSection('philosophy');
        $slides = $this->slideModel->getOrderedSlides();
        $services = $this->serviceModel->getOrderedServices();

        return view('admin/pages/homepage', [
            'pageTitle'         => 'Homepage Content Management | Glowup Admin',
            'pageHeading'       => 'Homepage CMS',
            'pageIcon'          => 'home',
            'breadcrumbSection' => 'Website Content',
            'breadcrumbTitle'   => 'Homepage',
            'activeMenu'        => 'homepage',
            'admin'             => $admin,
            'hero'              => $hero,
            'philosophy'        => $philosophy,
            'slides'            => $slides,
            'services'          => $services,
        ]);
    }

    /**
     * Update Hero Section Content
     */
    public function updateHero()
    {
        $rules = [
            'title'              => 'required|min_length[3]|max_length[255]',
            'subtitle'           => 'permit_empty|max_length[1000]',
            'pill_text'          => 'permit_empty|max_length[100]',
            'primary_btn_text'   => 'permit_empty|max_length[100]',
            'primary_btn_url'    => 'permit_empty|max_length[255]',
            'secondary_btn_text' => 'permit_empty|max_length[100]',
            'secondary_btn_url'  => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => implode('<br>', $this->validator->getErrors()),
                ]);
            }
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $title    = $this->request->getPost('title');
        $subtitle = $this->request->getPost('subtitle');
        $meta = [
            'pill_text'          => $this->request->getPost('pill_text'),
            'primary_btn_text'   => $this->request->getPost('primary_btn_text'),
            'primary_btn_url'    => $this->request->getPost('primary_btn_url'),
            'secondary_btn_text' => $this->request->getPost('secondary_btn_text'),
            'secondary_btn_url'  => $this->request->getPost('secondary_btn_url'),
        ];

        $this->sectionModel->updateSection('hero', [
            'title'    => $title,
            'subtitle' => $subtitle,
        ], $meta);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => 'success',
                'message'    => 'Hero section updated successfully!',
                'csrf_token' => csrf_token(),
                'csrf_hash'  => csrf_hash(),
            ]);
        }

        return redirect()->to(base_url('admin/homepage'))->with('success', 'Hero section updated successfully!');
    }

    /**
     * Update Philosophy Section Content
     */
    public function updatePhilosophy()
    {
        $rules = [
            'title'       => 'required|min_length[3]|max_length[255]',
            'subtitle'    => 'permit_empty|max_length[255]',
            'content'     => 'permit_empty',
            'stat1_value' => 'permit_empty|max_length[50]',
            'stat1_label' => 'permit_empty|max_length[100]',
            'stat2_value' => 'permit_empty|max_length[50]',
            'stat2_label' => 'permit_empty|max_length[100]',
            'stat3_value' => 'permit_empty|max_length[50]',
            'stat3_label' => 'permit_empty|max_length[100]',
            'btn_text'    => 'permit_empty|max_length[100]',
            'btn_url'     => 'permit_empty|max_length[255]',
            'award_title' => 'permit_empty|max_length[100]',
            'award_desc'  => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => implode('<br>', $this->validator->getErrors()),
                ]);
            }
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $imagePath = $this->request->getPost('image_url');
        $imgFile   = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/homepage', $newName);
            $imagePath = 'uploads/homepage/' . $newName;
        }

        $title    = $this->request->getPost('title');
        $subtitle = $this->request->getPost('subtitle');
        $content  = $this->request->getPost('content');

        $meta = [
            'secondary_content' => $this->request->getPost('secondary_content'),
            'stat1_value'       => $this->request->getPost('stat1_value'),
            'stat1_label'       => $this->request->getPost('stat1_label'),
            'stat2_value'       => $this->request->getPost('stat2_value'),
            'stat2_label'       => $this->request->getPost('stat2_label'),
            'stat3_value'       => $this->request->getPost('stat3_value'),
            'stat3_label'       => $this->request->getPost('stat3_label'),
            'btn_text'          => $this->request->getPost('btn_text'),
            'btn_url'           => $this->request->getPost('btn_url'),
            'image_url'         => $imagePath,
            'award_title'       => $this->request->getPost('award_title'),
            'award_desc'        => $this->request->getPost('award_desc'),
        ];

        $this->sectionModel->updateSection('philosophy', [
            'title'    => $title,
            'subtitle' => $subtitle,
            'content'  => $content,
        ], $meta);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => 'success',
                'message'    => 'Philosophy & Brand Story section updated successfully!',
                'csrf_token' => csrf_token(),
                'csrf_hash'  => csrf_hash(),
            ]);
        }

        return redirect()->to(base_url('admin/homepage#philosophy-tab'))->with('success', 'Philosophy section updated successfully!');
    }

    /**
     * Create or Update a Slide (Hero Film Slideshow)
     */
    public function saveSlide()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'chapter_title' => 'required|min_length[2]|max_length[255]',
            'badge_text'    => 'permit_empty|max_length[100]',
            'time_text'     => 'permit_empty|max_length[50]',
            'display_order' => 'permit_empty|numeric',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'     => 'error',
                    'message'    => implode('<br>', $this->validator->getErrors()),
                    'csrf_token' => csrf_token(),
                    'csrf_hash'  => csrf_hash(),
                ]);
            }
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $imageUrl = $this->request->getPost('image_url');
        $imgFile  = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/homepage', $newName);
            $imageUrl = 'uploads/homepage/' . $newName;
        }

        if (empty($imageUrl) && empty($id)) {
            $errorMsg = 'Please provide an image URL or upload an image file.';
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'     => 'error',
                    'message'    => $errorMsg,
                    'csrf_token' => csrf_token(),
                    'csrf_hash'  => csrf_hash(),
                ]);
            }
            return redirect()->back()->withInput()->with('error', $errorMsg);
        }

        $data = [
            'chapter_title' => $this->request->getPost('chapter_title'),
            'badge_text'    => $this->request->getPost('badge_text'),
            'time_text'     => $this->request->getPost('time_text'),
            'display_order' => (int) ($this->request->getPost('display_order') ?? 1),
            'is_active'     => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (!empty($imageUrl)) {
            $data['image_url'] = $imageUrl;
        }

        if (!empty($id)) {
            $this->slideModel->update($id, $data);
            $message = 'Slide updated successfully!';
        } else {
            $this->slideModel->insert($data);
            $message = 'New slide added successfully!';
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => 'success',
                'message'    => $message,
                'csrf_token' => csrf_token(),
                'csrf_hash'  => csrf_hash(),
            ]);
        }

        return redirect()->to(base_url('admin/homepage#slides-tab'))->with('success', $message);
    }

    /**
     * Delete Slide
     */
    public function deleteSlide($id = null)
    {
        $id = $id ?? $this->request->getPost('id');

        if (!$id) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'     => 'error',
                    'message'    => 'Slide ID is missing.',
                    'csrf_token' => csrf_token(),
                    'csrf_hash'  => csrf_hash(),
                ]);
            }
            return redirect()->to(base_url('admin/homepage#slides-tab'))->with('error', 'Slide ID is missing.');
        }

        $this->slideModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => 'success',
                'message'    => 'Slide removed successfully.',
                'csrf_token' => csrf_token(),
                'csrf_hash'  => csrf_hash(),
            ]);
        }

        return redirect()->to(base_url('admin/homepage#slides-tab'))->with('success', 'Slide removed successfully.');
    }

    /**
     * Quick Toggle Slide Active Status
     */
    public function toggleSlide($id)
    {
        $slide = $this->slideModel->find($id);
        if (!$slide) {
            return $this->response->setJSON([
                'status'     => 'error',
                'message'    => 'Slide not found',
                'csrf_token' => csrf_token(),
                'csrf_hash'  => csrf_hash(),
            ]);
        }

        $newStatus = $slide['is_active'] ? 0 : 1;
        $this->slideModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'status'     => 'success',
            'is_active'  => $newStatus,
            'message'    => 'Slide status updated',
            'csrf_token' => csrf_token(),
            'csrf_hash'  => csrf_hash(),
        ]);
    }

    /**
     * Create or Update Featured Treatment / Service
     */
    public function saveService()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'title'         => 'required|min_length[2]|max_length[255]',
            'category'      => 'permit_empty|max_length[100]',
            'price'         => 'permit_empty|max_length[50]',
            'duration'      => 'permit_empty|max_length[50]',
            'description'   => 'permit_empty',
            'button_text'   => 'permit_empty|max_length[100]',
            'button_url'    => 'permit_empty|max_length[255]',
            'display_order' => 'permit_empty|numeric',
        ];

        if (!$this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'     => 'error',
                    'message'    => implode('<br>', $this->validator->getErrors()),
                    'csrf_token' => csrf_token(),
                    'csrf_hash'  => csrf_hash(),
                ]);
            }
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $imageUrl = $this->request->getPost('image_url');
        $imgFile  = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/homepage', $newName);
            $imageUrl = 'uploads/homepage/' . $newName;
        }

        $data = [
            'title'         => $this->request->getPost('title'),
            'category'      => $this->request->getPost('category'),
            'price'         => $this->request->getPost('price'),
            'duration'      => $this->request->getPost('duration'),
            'description'   => $this->request->getPost('description'),
            'button_text'   => $this->request->getPost('button_text') ?: 'Book Now',
            'button_url'    => $this->request->getPost('button_url') ?: 'booking',
            'display_order' => (int) ($this->request->getPost('display_order') ?? 1),
            'is_active'     => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (!empty($imageUrl)) {
            $data['image_url'] = $imageUrl;
        }

        if (!empty($id)) {
            $this->serviceModel->update($id, $data);
            $message = 'Treatment updated successfully!';
        } else {
            $this->serviceModel->insert($data);
            $message = 'New treatment created successfully!';
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => 'success',
                'message'    => $message,
                'csrf_token' => csrf_token(),
                'csrf_hash'  => csrf_hash(),
            ]);
        }

        return redirect()->to(base_url('admin/homepage#services-tab'))->with('success', $message);
    }

    /**
     * Delete Service / Treatment
     */
    public function deleteService($id = null)
    {
        $id = $id ?? $this->request->getPost('id');

        if (!$id) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'     => 'error',
                    'message'    => 'Treatment ID is missing.',
                    'csrf_token' => csrf_token(),
                    'csrf_hash'  => csrf_hash(),
                ]);
            }
            return redirect()->to(base_url('admin/homepage#services-tab'))->with('error', 'Treatment ID is missing.');
        }

        $this->serviceModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => 'success',
                'message'    => 'Treatment removed successfully.',
                'csrf_token' => csrf_token(),
                'csrf_hash'  => csrf_hash(),
            ]);
        }

        return redirect()->to(base_url('admin/homepage#services-tab'))->with('success', 'Treatment removed successfully.');
    }

    /**
     * Quick Toggle Service Active Status
     */
    public function toggleService($id)
    {
        $service = $this->serviceModel->find($id);
        if (!$service) {
            return $this->response->setJSON([
                'status'     => 'error',
                'message'    => 'Treatment not found',
                'csrf_token' => csrf_token(),
                'csrf_hash'  => csrf_hash(),
            ]);
        }

        $newStatus = $service['is_active'] ? 0 : 1;
        $this->serviceModel->update($id, ['is_active' => $newStatus]);

        return $this->response->setJSON([
            'status'     => 'success',
            'is_active'  => $newStatus,
            'message'    => 'Treatment status updated',
            'csrf_token' => csrf_token(),
            'csrf_hash'  => csrf_hash(),
        ]);
    }
}
