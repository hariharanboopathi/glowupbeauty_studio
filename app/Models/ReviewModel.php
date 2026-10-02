<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'customer_name',
        'customer_photo',
        'rating',
        'headline',
        'review_text',
        'service_name',
        'category',
        'specialist_name',
        'location',
        'phone',
        'status',
        'sort_order',
        'is_verified',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'customer_name' => 'required|min_length[2]|max_length[120]',
        'rating'        => 'required|is_natural_no_zero|less_than_equal_to[5]',
        'review_text'   => 'required|min_length[5]',
        'status'        => 'permit_empty|in_list[published,hidden,pending]',
        'category'      => 'permit_empty|max_length[50]',
    ];

    protected $validationMessages = [
        'customer_name' => [
            'required'   => 'Customer Name is required.',
            'min_length' => 'Customer Name must be at least 2 characters long.',
        ],
        'rating' => [
            'required'              => 'Please select a rating between 1 and 5.',
            'less_than_equal_to'   => 'Rating cannot exceed 5 stars.',
        ],
        'review_text' => [
            'required'   => 'Review content is required.',
            'min_length' => 'Review content must be at least 5 characters long.',
        ],
    ];

    /**
     * Get published reviews for the frontend display
     * Ordered by sort_order ascending, then newest first
     */
    public function getPublishedReviews(string $category = 'all', int $limit = 100): array
    {
        $builder = $this->where('status', 'published');

        if ($category !== 'all' && !empty($category)) {
            $builder->where('category', $category);
        }

        return $builder->orderBy('sort_order', 'ASC')
                       ->orderBy('created_at', 'DESC')
                       ->findAll($limit);
    }

    /**
     * Get filtered reviews for the Admin panel with pagination
     */
    public function getFilteredReviews(?string $search = null, ?string $status = null, ?string $category = null, ?int $rating = null, int $limit = 15, int $offset = 0): array
    {
        $builder = $this->builder();

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('customer_name', $search)
                    ->orLike('headline', $search)
                    ->orLike('review_text', $search)
                    ->orLike('service_name', $search)
                    ->orLike('specialist_name', $search)
                    ->orLike('phone', $search)
                    ->groupEnd();
        }

        if ($status !== null && $status !== '' && $status !== 'all') {
            $builder->where('status', $status);
        }

        if ($category !== null && $category !== '' && $category !== 'all') {
            $builder->where('category', $category);
        }

        if ($rating !== null && $rating > 0 && $rating <= 5) {
            $builder->where('rating', $rating);
        }

        return $builder->orderBy('sort_order', 'ASC')
                       ->orderBy('id', 'DESC')
                       ->limit($limit, $offset)
                       ->get()
                       ->getResultArray();
    }

    /**
     * Count filtered reviews for pagination
     */
    public function getFilteredCount(?string $search = null, ?string $status = null, ?string $category = null, ?int $rating = null): int
    {
        $builder = $this->builder();

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('customer_name', $search)
                    ->orLike('headline', $search)
                    ->orLike('review_text', $search)
                    ->orLike('service_name', $search)
                    ->orLike('specialist_name', $search)
                    ->orLike('phone', $search)
                    ->groupEnd();
        }

        if ($status !== null && $status !== '' && $status !== 'all') {
            $builder->where('status', $status);
        }

        if ($category !== null && $category !== '' && $category !== 'all') {
            $builder->where('category', $category);
        }

        if ($rating !== null && $rating > 0 && $rating <= 5) {
            $builder->where('rating', $rating);
        }

        return $builder->countAllResults();
    }

    /**
     * Compute comprehensive statistics for admin dashboard and frontend breakdown
     */
    public function getReviewStatistics(): array
    {
        $all = $this->findAll();
        $total = count($all);

        $published = 0;
        $hidden = 0;
        $sumRating = 0;
        $publishedCount = 0;

        $starCounts = [
            5 => 0,
            4 => 0,
            3 => 0,
            2 => 0,
            1 => 0,
        ];

        $categoryStats = [
            'hair' => ['sum' => 0, 'count' => 0, 'name' => 'Hair Alchemy & Textures'],
            'facials' => ['sum' => 0, 'count' => 0, 'name' => 'Clinical Hydra Facials'],
            'bridal' => ['sum' => 0, 'count' => 0, 'name' => 'Haute Bridal Artistry'],
            'academy' => ['sum' => 0, 'count' => 0, 'name' => 'Academy Professional Courses'],
        ];

        foreach ($all as $r) {
            $rRating = (int) ($r['rating'] ?? 5);
            $rStatus = $r['status'] ?? 'published';
            $rCat = strtolower(trim((string) ($r['category'] ?? 'all')));

            if ($rStatus === 'published') {
                $published++;
                $sumRating += $rRating;
                $publishedCount++;

                if (isset($starCounts[$rRating])) {
                    $starCounts[$rRating]++;
                }

                if (isset($categoryStats[$rCat])) {
                    $categoryStats[$rCat]['sum'] += $rRating;
                    $categoryStats[$rCat]['count']++;
                }
            } else {
                $hidden++;
            }
        }

        $averageRating = $publishedCount > 0 ? round($sumRating / $publishedCount, 2) : 5.0;

        // Calculate percentage breakdowns
        $starPercentages = [];
        foreach ($starCounts as $star => $count) {
            $starPercentages[$star] = $publishedCount > 0 ? round(($count / $publishedCount) * 100, 1) : 0;
        }

        // Calculate category averages
        $categoryAverages = [];
        foreach ($categoryStats as $catKey => $catData) {
            $avg = $catData['count'] > 0 ? round($catData['sum'] / $catData['count'], 2) : 5.00;
            $categoryAverages[$catKey] = [
                'name'    => $catData['name'],
                'average' => number_format($avg, 2),
                'count'   => $catData['count'],
            ];
        }

        return [
            'total'             => $total,
            'published'         => $published,
            'hidden'            => $hidden,
            'average'           => number_format($averageRating, 2),
            'star_counts'       => $starCounts,
            'star_percentages'  => $starPercentages,
            'category_averages' => $categoryAverages,
        ];
    }
}
