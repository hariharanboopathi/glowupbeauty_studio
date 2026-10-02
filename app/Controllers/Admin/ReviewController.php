<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\ReviewModel;

class ReviewController extends BaseController
{
    protected AdminAuth $auth;
    protected ReviewModel $reviewModel;

    public function __construct()
    {
        $this->auth = new AdminAuth();
        $this->reviewModel = new ReviewModel();
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
     * Admin: Review List & Management Console
     */
    public function index()
    {
        $search = trim((string) $this->request->getGet('search'));
        $status = $this->request->getGet('status');
        if ($status !== null && $status !== '' && $status !== 'all') {
            $status = strtolower(trim((string) $status));
        } else {
            $status = null;
        }

        $category = $this->request->getGet('category');
        if ($category !== null && $category !== '' && $category !== 'all') {
            $category = strtolower(trim((string) $category));
        } else {
            $category = null;
        }

        $rating = $this->request->getGet('rating');
        if ($rating !== null && $rating !== '' && $rating !== 'all') {
            $rating = (int) $rating;
        } else {
            $rating = null;
        }

        $page = max(1, (int) $this->request->getGet('page'));
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $reviews = $this->reviewModel->getFilteredReviews($search, $status, $category, $rating, $perPage, $offset);
        $totalMatching = $this->reviewModel->getFilteredCount($search, $status, $category, $rating);
        $totalPages = max(1, (int) ceil($totalMatching / $perPage));

        $stats = $this->reviewModel->getReviewStatistics();

        return view('admin/pages/website_reviews', [
            'pageTitle'         => 'Review Management | Glowup Admin',
            'pageHeading'       => 'Patron Reviews & Testimonials',
            'pageIcon'          => 'rate_review',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'Reviews',
            'activeMenu'        => 'website_reviews',
            'admin'             => $this->getAdminData(),
            'reviews'           => $reviews,
            'stats'             => $stats,
            'search'            => $search,
            'statusFilter'      => $status,
            'categoryFilter'    => $category,
            'ratingFilter'      => $rating,
            'currentPage'       => $page,
            'totalPages'        => $totalPages,
            'totalMatching'     => $totalMatching,
            'perPage'           => $perPage,
        ]);
    }

    /**
     * AJAX endpoint to fetch individual review details
     */
    public function details(int $id)
    {
        $review = $this->reviewModel->find($id);
        if (!$review) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Review record not found.',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'review' => $review,
        ]);
    }

    /**
     * Save / Update Review
     */
    public function save()
    {
        $id = (int) $this->request->getPost('id');
        $customerName = trim((string) $this->request->getPost('customer_name'));
        $rating = max(1, min(5, (int) $this->request->getPost('rating')));
        $headline = trim((string) $this->request->getPost('headline'));
        $reviewText = trim((string) $this->request->getPost('review_text'));
        $serviceName = trim((string) $this->request->getPost('service_name'));
        $category = trim((string) $this->request->getPost('category'));
        $specialistName = trim((string) $this->request->getPost('specialist_name'));
        $location = trim((string) $this->request->getPost('location'));
        $phone = trim((string) $this->request->getPost('phone'));
        $status = trim((string) $this->request->getPost('status'));
        $sortOrder = (int) $this->request->getPost('sort_order');
        $isVerified = (int) ($this->request->getPost('is_verified') ?? 1);

        if (empty($status) || !in_array($status, ['published', 'hidden'], true)) {
            $status = 'published';
        }

        if (empty($category)) {
            $category = 'all';
        }

        if (empty($location)) {
            $location = 'Madurai';
        }

        // Basic validation
        if (empty($customerName)) {
            return $this->redirectWithToast('error', 'Customer name is required.');
        }

        if (empty($reviewText)) {
            return $this->redirectWithToast('error', 'Review content cannot be empty.');
        }

        $reviewData = [
            'customer_name'   => $customerName,
            'rating'          => $rating,
            'headline'        => $headline ?: null,
            'review_text'     => $reviewText,
            'service_name'    => $serviceName ?: 'Bespoke Experience',
            'category'        => $category,
            'specialist_name' => $specialistName ?: null,
            'location'        => $location,
            'phone'           => $phone ?: null,
            'status'          => $status,
            'sort_order'      => $sortOrder,
            'is_verified'     => $isVerified ? 1 : 0,
        ];

        // Handle Customer Photo Upload
        $file = $this->request->getFile('customer_photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            if (!in_array($file->getMimeType(), $allowedTypes, true)) {
                return $this->redirectWithToast('error', 'Invalid photo format. Please upload JPG, PNG, or WEBP.');
            }

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/reviews', $newName);
            $reviewData['customer_photo'] = 'uploads/reviews/' . $newName;

            // Remove previous file if exists
            if ($id > 0) {
                $existing = $this->reviewModel->find($id);
                if (!empty($existing['customer_photo']) && file_exists(FCPATH . $existing['customer_photo'])) {
                    @unlink(FCPATH . $existing['customer_photo']);
                }
            }
        } elseif ($this->request->getPost('remove_photo') === '1') {
            $reviewData['customer_photo'] = null;
            if ($id > 0) {
                $existing = $this->reviewModel->find($id);
                if (!empty($existing['customer_photo']) && file_exists(FCPATH . $existing['customer_photo'])) {
                    @unlink(FCPATH . $existing['customer_photo']);
                }
            }
        }

        if ($id > 0) {
            $this->reviewModel->update($id, $reviewData);
            $message = "Review for \"{$customerName}\" updated successfully.";
        } else {
            $this->reviewModel->insert($reviewData);
            $message = "New patron review for \"{$customerName}\" created successfully.";
        }

        return $this->redirectWithToast('success', $message);
    }

    /**
     * AJAX / Post: Toggle review status between Published and Hidden
     */
    public function toggleStatus(int $id)
    {
        $review = $this->reviewModel->find($id);
        if (!$review) {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(404)->setJSON([
                    'status'  => false,
                    'message' => 'Review not found.',
                ]);
            }
            return $this->redirectWithToast('error', 'Review not found.');
        }

        $newStatus = ($review['status'] === 'published') ? 'hidden' : 'published';
        $this->reviewModel->update($id, ['status' => $newStatus]);

        $statusLabel = ($newStatus === 'published') ? 'Published' : 'Hidden';
        $message = "Review #{$id} is now {$statusLabel}.";

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'     => true,
                'new_status' => $newStatus,
                'message'    => $message,
            ]);
        }

        return $this->redirectWithToast('success', $message);
    }

    /**
     * Approve pending review and publish to frontend
     */
    public function approve(int $id)
    {
        $review = $this->reviewModel->find($id);
        if (!$review) {
            return $this->redirectWithToast('error', 'Review not found.');
        }

        $this->reviewModel->update($id, ['status' => 'published']);
        return $this->redirectWithToast('success', "Review from \"{$review['customer_name']}\" approved and published successfully.");
    }

    /**
     * Delete review record
     */
    public function delete(int $id)
    {
        $review = $this->reviewModel->find($id);
        if (!$review) {
            return $this->redirectWithToast('error', 'Review not found.');
        }

        if (!empty($review['customer_photo']) && file_exists(FCPATH . $review['customer_photo'])) {
            @unlink(FCPATH . $review['customer_photo']);
        }

        $this->reviewModel->delete($id);

        return $this->redirectWithToast('success', "Review from \"{$review['customer_name']}\" deleted successfully.");
    }

    /**
     * Reorder review items
     */
    public function reorder()
    {
        $orderData = $this->request->getPost('order');
        if (is_array($orderData)) {
            foreach ($orderData as $sort => $id) {
                $this->reviewModel->update((int) $id, ['sort_order' => (int) $sort + 1]);
            }
            return $this->response->setJSON(['status' => true, 'message' => 'Review order updated successfully.']);
        }

        return $this->response->setJSON(['status' => false, 'message' => 'Invalid order data.']);
    }

    /**
     * Helper for standardized toast redirection
     */
    protected function redirectWithToast(string $type, string $message)
    {
        $session = session();
        if ($type === 'success') {
            $session->setFlashdata('success', $message);
            $session->setFlashdata('toast_success', $message);
        } else {
            $session->setFlashdata('error', $message);
            $session->setFlashdata('toast_error', $message);
        }

        return redirect()->to(base_url('admin/website/reviews'));
    }
}
