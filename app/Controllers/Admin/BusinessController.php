<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\CourseModel;
use App\Models\BridalModel;
use App\Models\RentalModel;
use App\Models\StudentModel;
use App\Models\PhotoshootModel;
use App\Models\EventModel;

class BusinessController extends BaseController
{
    protected AdminAuth $auth;
    protected CourseModel $courseModel;
    protected BridalModel $bridalModel;
    protected RentalModel $rentalModel;
    protected StudentModel $studentModel;
    protected PhotoshootModel $photoshootModel;
    protected EventModel $eventModel;

    public function __construct()
    {
        $this->auth            = new AdminAuth();
        $this->courseModel     = new CourseModel();
        $this->bridalModel     = new BridalModel();
        $this->rentalModel     = new RentalModel();
        $this->studentModel    = new StudentModel();
        $this->photoshootModel = new PhotoshootModel();
        $this->eventModel      = new EventModel();

        // Ensure upload folders exist
        foreach (['courses', 'bridal', 'rentals', 'photoshoot', 'events'] as $sub) {
            $dir = FCPATH . 'uploads/' . $sub;
            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }
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

    /* =========================================================================
     * 1. COURSES MODULE (/admin/courses)
     * ========================================================================= */
    public function courses()
    {
        $courses = $this->courseModel->getOrderedCourses();

        return view('admin/pages/courses', [
            'pageTitle'         => 'Academy Courses | Glowup Admin',
            'pageHeading'       => 'Academy Diploma Courses',
            'pageIcon'          => 'school',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Courses',
            'activeMenu'        => 'courses',
            'admin'             => $this->getAdminData(),
            'courses'           => $courses,
        ]);
    }

    public function saveCourse()
    {
        $id = $this->request->getPost('id');
        $rules = [
            'title'    => 'required|min_length[3]|max_length[255]',
            'duration' => 'required',
            'price'    => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $image = $this->request->getPost('image_url');
        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/courses', $newName);
            $image = 'uploads/courses/' . $newName;
        }

        $data = [
            'title'       => trim((string) $this->request->getPost('title')),
            'duration'    => trim((string) $this->request->getPost('duration')),
            'level'       => trim((string) $this->request->getPost('level')),
            'badge'       => trim((string) $this->request->getPost('badge')),
            'price'       => (float) $this->request->getPost('price'),
            'description' => trim((string) $this->request->getPost('description')),
            'sort_order'  => (int) ($this->request->getPost('sort_order') ?? 0),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (!empty($image)) {
            $data['image_url'] = $image;
        }

        if (!empty($id)) {
            $this->courseModel->update($id, $data);
            $msg = 'Course updated successfully!';
        } else {
            $this->courseModel->insert($data);
            $msg = 'New course created successfully!';
        }

        return redirect()->to(base_url('admin/courses'))->with('success', $msg);
    }

    public function deleteCourse($id)
    {
        $this->courseModel->delete($id);
        return redirect()->to(base_url('admin/courses'))->with('success', 'Course removed.');
    }

    public function toggleCourse($id)
    {
        $course = $this->courseModel->find($id);
        if ($course) {
            $this->courseModel->update($id, ['is_active' => $course['is_active'] ? 0 : 1]);
            return redirect()->back()->with('success', 'Course status updated.');
        }
        return redirect()->back()->with('error', 'Course not found.');
    }

    /* =========================================================================
     * 2. BRIDAL PACKAGES MODULE (/admin/business/bridal)
     * ========================================================================= */
    public function bridal()
    {
        $packages = $this->bridalModel->getOrderedPackages();

        return view('admin/pages/bridal', [
            'pageTitle'         => 'Bridal Packages | Glowup Admin',
            'pageHeading'       => 'Bridal Packages & Makeover Tiers',
            'pageIcon'          => 'diamond',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Bridal Packages',
            'activeMenu'        => 'bridal',
            'admin'             => $this->getAdminData(),
            'packages'          => $packages,
        ]);
    }

    public function saveBridal()
    {
        $id = $this->request->getPost('id');
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'price' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $image = $this->request->getPost('image_url');
        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/bridal', $newName);
            $image = 'uploads/bridal/' . $newName;
        }

        $data = [
            'title'       => trim((string) $this->request->getPost('title')),
            'tier'        => trim((string) $this->request->getPost('tier')),
            'price'       => (float) $this->request->getPost('price'),
            'duration'    => trim((string) $this->request->getPost('duration')),
            'description' => trim((string) $this->request->getPost('description')),
            'inclusions'  => trim((string) $this->request->getPost('inclusions')),
            'badge'       => trim((string) $this->request->getPost('badge')),
            'sort_order'  => (int) ($this->request->getPost('sort_order') ?? 0),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (!empty($image)) {
            $data['image_url'] = $image;
        }

        if (!empty($id)) {
            $this->bridalModel->update($id, $data);
            $msg = 'Bridal package updated successfully!';
        } else {
            $this->bridalModel->insert($data);
            $msg = 'New bridal package created!';
        }

        return redirect()->to(base_url('admin/business/bridal'))->with('success', $msg);
    }

    public function deleteBridal($id)
    {
        $this->bridalModel->delete($id);
        return redirect()->to(base_url('admin/business/bridal'))->with('success', 'Bridal package removed.');
    }

    public function toggleBridal($id)
    {
        $pkg = $this->bridalModel->find($id);
        if ($pkg) {
            $this->bridalModel->update($id, ['is_active' => $pkg['is_active'] ? 0 : 1]);
            return redirect()->back()->with('success', 'Bridal package status updated.');
        }
        return redirect()->back()->with('error', 'Package not found.');
    }

    /* =========================================================================
     * 3. RENTALS & JEWELLERY MODULE (/admin/business/rentals)
     * ========================================================================= */
    public function rentals()
    {
        $category = trim((string) $this->request->getGet('category'));
        $rentals = $this->rentalModel->getOrderedRentals($category);

        return view('admin/pages/rentals', [
            'pageTitle'         => 'Rentals & Jewellery | Glowup Admin',
            'pageHeading'       => 'Rentals & Jewellery Inventory',
            'pageIcon'          => 'inventory_2',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Rentals',
            'activeMenu'        => 'rentals',
            'admin'             => $this->getAdminData(),
            'rentals'           => $rentals,
            'currentCategory'   => $category ?: 'all',
        ]);
    }

    public function saveRental()
    {
        $id = $this->request->getPost('id');
        $rules = [
            'name'         => 'required|min_length[3]|max_length[255]',
            'category'     => 'required',
            'rental_price' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $image = $this->request->getPost('image_url');
        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/rentals', $newName);
            $image = 'uploads/rentals/' . $newName;
        }

        $data = [
            'name'           => trim((string) $this->request->getPost('name')),
            'category'       => trim((string) $this->request->getPost('category')),
            'rental_price'   => (float) $this->request->getPost('rental_price'),
            'deposit_amount' => (float) ($this->request->getPost('deposit_amount') ?? 0),
            'description'    => trim((string) $this->request->getPost('description')),
            'is_available'   => $this->request->getPost('is_available') ? 1 : 0,
            'sort_order'     => (int) ($this->request->getPost('sort_order') ?? 0),
        ];

        if (!empty($image)) {
            $data['image_url'] = $image;
        }

        if (!empty($id)) {
            $this->rentalModel->update($id, $data);
            $msg = 'Rental item updated!';
        } else {
            $this->rentalModel->insert($data);
            $msg = 'New rental inventory item added!';
        }

        return redirect()->to(base_url('admin/business/rentals'))->with('success', $msg);
    }

    public function deleteRental($id)
    {
        $this->rentalModel->delete($id);
        return redirect()->to(base_url('admin/business/rentals'))->with('success', 'Rental item deleted.');
    }

    public function toggleRental($id)
    {
        $item = $this->rentalModel->find($id);
        if ($item) {
            $this->rentalModel->update($id, ['is_available' => $item['is_available'] ? 0 : 1]);
            return redirect()->back()->with('success', 'Rental item availability updated.');
        }
        return redirect()->back()->with('error', 'Item not found.');
    }

    /* =========================================================================
     * 4. STUDENTS MODULE (/admin/students)
     * ========================================================================= */
    public function students()
    {
        $search = trim((string) $this->request->getGet('search'));
        $status = trim((string) $this->request->getGet('status'));

        $page = max(1, (int) $this->request->getGet('page'));
        $perPage = 15;
        $offset = ($page - 1) * $perPage;

        $students = $this->studentModel->getFilteredStudents($search, $status, $perPage, $offset);
        $totalMatching = $this->studentModel->getFilteredCount($search, $status);
        $totalPages = max(1, (int) ceil($totalMatching / $perPage));
        $allCourses = $this->courseModel->getOrderedCourses(true);

        return view('admin/pages/students', [
            'pageTitle'         => 'Enrolled Students | Glowup Admin',
            'pageHeading'       => 'Academy Students & Enrolments',
            'pageIcon'          => 'group',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Students',
            'activeMenu'        => 'students',
            'admin'             => $this->getAdminData(),
            'students'          => $students,
            'courses'           => $allCourses,
            'search'            => $search,
            'statusFilter'      => $status ?: 'all',
            'currentPage'       => $page,
            'totalPages'        => $totalPages,
            'totalMatching'     => $totalMatching,
            'perPage'           => $perPage,
        ]);
    }

    public function saveStudent()
    {
        $id = $this->request->getPost('id');
        $rules = [
            'student_name' => 'required|min_length[3]|max_length[150]',
            'email'        => 'required|valid_email',
            'phone'        => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $courseId = $this->request->getPost('course_id');
        $courseName = null;
        if (!empty($courseId)) {
            $c = $this->courseModel->find($courseId);
            if ($c) {
                $courseName = $c['title'];
            }
        }

        $data = [
            'student_name' => trim((string) $this->request->getPost('student_name')),
            'email'        => trim((string) $this->request->getPost('email')),
            'phone'        => trim((string) $this->request->getPost('phone')),
            'course_id'    => $courseId ?: null,
            'course_name'  => $courseName,
            'batch'        => trim((string) $this->request->getPost('batch')) ?: 'Autumn 2025',
            'status'       => trim((string) $this->request->getPost('status')) ?: 'enrolled',
            'notes'        => trim((string) $this->request->getPost('notes')),
        ];

        if (!empty($id)) {
            $this->studentModel->update($id, $data);
            $msg = 'Student record updated!';
        } else {
            $this->studentModel->insert($data);
            $msg = 'New student enrolment added!';
        }

        return redirect()->to(base_url('admin/students'))->with('success', $msg);
    }

    public function deleteStudent($id)
    {
        $this->studentModel->delete($id);
        return redirect()->to(base_url('admin/students'))->with('success', 'Student record removed.');
    }

    /* =========================================================================
     * 5. PHOTOSHOOT PACKAGES MODULE (/admin/business/photoshoot)
     * ========================================================================= */
    public function photoshoot()
    {
        $packages = $this->photoshootModel->orderBy('sort_order', 'ASC')->orderBy('id', 'DESC')->findAll();

        return view('admin/pages/photoshoot', [
            'pageTitle'         => 'Photoshoot Packages | Glowup Admin',
            'pageHeading'       => 'Photoshoot & Folio Packages',
            'pageIcon'          => 'photo_camera',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Photoshoot',
            'activeMenu'        => 'photoshoot',
            'admin'             => $this->getAdminData(),
            'packages'          => $packages,
            'stats'             => [
                'total'    => count($packages),
                'active'   => count(array_filter($packages, fn($p) => $p['is_active'] == 1)),
                'avgPrice' => count($packages) ? array_sum(array_column($packages, 'price')) / count($packages) : 0,
            ],
        ]);
    }

    public function savePhotoshoot()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'price' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid package title and price.');
        }

        $data = [
            'title'        => trim((string) $this->request->getPost('title')),
            'package_type' => trim((string) $this->request->getPost('package_type')) ?: 'Bridal Lookbook',
            'price'        => (float) $this->request->getPost('price'),
            'duration'     => trim((string) $this->request->getPost('duration')) ?: '3 Hours',
            'description'  => trim((string) $this->request->getPost('description')),
            'inclusions'   => trim((string) $this->request->getPost('inclusions')),
            'sort_order'   => (int) $this->request->getPost('sort_order'),
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/photoshoot', $newName);
            $data['image_url'] = 'uploads/photoshoot/' . $newName;
        } elseif ($url = trim((string) $this->request->getPost('image_url'))) {
            $data['image_url'] = $url;
        }

        if ($id > 0) {
            $this->photoshootModel->update($id, $data);
            $msg = 'Photoshoot package updated successfully.';
        } else {
            $this->photoshootModel->insert($data);
            $msg = 'New photoshoot package created successfully.';
        }

        return redirect()->to(base_url('admin/business/photoshoot'))->with('success', $msg);
    }

    public function deletePhotoshoot($id)
    {
        $this->photoshootModel->delete($id);
        return redirect()->to(base_url('admin/business/photoshoot'))->with('success', 'Photoshoot package removed.');
    }

    public function togglePhotoshoot($id)
    {
        $pkg = $this->photoshootModel->find($id);
        if (!$pkg) {
            return $this->response->setJSON(['status' => false, 'message' => 'Package not found']);
        }

        $newVal = $pkg['is_active'] ? 0 : 1;
        $this->photoshootModel->update($id, ['is_active' => $newVal]);

        return $this->response->setJSON([
            'status'     => true,
            'new_status' => $newVal,
            'message'    => 'Package status toggled.',
        ]);
    }

    /* =========================================================================
     * 6. STUDIO EVENTS & MASTERCLASSES MODULE (/admin/business/events)
     * ========================================================================= */
    public function events()
    {
        $events = $this->eventModel->orderBy('event_date', 'ASC')->orderBy('id', 'DESC')->findAll();

        return view('admin/pages/events', [
            'pageTitle'         => 'Studio Events & Masterclasses | Glowup Admin',
            'pageHeading'       => 'Masterclasses & Studio Events',
            'pageIcon'          => 'event',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Events',
            'activeMenu'        => 'events',
            'admin'             => $this->getAdminData(),
            'events'            => $events,
            'stats'             => [
                'total'    => count($events),
                'upcoming' => count(array_filter($events, fn($e) => $e['status'] === 'upcoming')),
                'enrolled' => array_sum(array_column($events, 'enrolled_count')),
            ],
        ]);
    }

    public function saveEvent()
    {
        $id = (int) $this->request->getPost('id');

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'fee'   => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please provide a valid event title and fee.');
        }

        $data = [
            'title'          => trim((string) $this->request->getPost('title')),
            'event_type'     => trim((string) $this->request->getPost('event_type')) ?: 'Masterclass',
            'event_date'     => $this->request->getPost('event_date') ?: date('Y-m-d', strtotime('+7 days')),
            'event_time'     => trim((string) $this->request->getPost('event_time')) ?: '10:00 AM - 04:00 PM',
            'location'       => trim((string) $this->request->getPost('location')) ?: 'Glowup Academy Sanctum, Madurai',
            'fee'            => (float) $this->request->getPost('fee'),
            'capacity'       => (int) $this->request->getPost('capacity') ?: 25,
            'enrolled_count' => (int) $this->request->getPost('enrolled_count') ?: 0,
            'description'    => trim((string) $this->request->getPost('description')),
            'status'         => trim((string) $this->request->getPost('status')) ?: 'upcoming',
            'sort_order'     => (int) $this->request->getPost('sort_order'),
        ];

        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/events', $newName);
            $data['image_url'] = 'uploads/events/' . $newName;
        } elseif ($url = trim((string) $this->request->getPost('image_url'))) {
            $data['image_url'] = $url;
        }

        if ($id > 0) {
            $this->eventModel->update($id, $data);
            $msg = 'Event updated successfully.';
        } else {
            $this->eventModel->insert($data);
            $msg = 'New event created successfully.';
        }

        return redirect()->to(base_url('admin/business/events'))->with('success', $msg);
    }

    public function deleteEvent($id)
    {
        $this->eventModel->delete($id);
        return redirect()->to(base_url('admin/business/events'))->with('success', 'Event removed.');
    }

    public function toggleEvent($id)
    {
        $evt = $this->eventModel->find($id);
        if (!$evt) {
            return $this->response->setJSON(['status' => false, 'message' => 'Event not found']);
        }

        $newStatus = ($evt['status'] === 'upcoming') ? 'completed' : 'upcoming';
        $this->eventModel->update($id, ['status' => $newStatus]);

        return $this->response->setJSON([
            'status'     => true,
            'new_status' => $newStatus,
            'message'    => 'Event status updated to ' . $newStatus,
        ]);
    }
}
