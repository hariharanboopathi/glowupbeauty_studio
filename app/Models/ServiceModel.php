<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'name',
        'category',
        'price',
        'duration',
        'description',
        'image_url',
        'button_text',
        'button_url',
        'is_featured',
        'is_active',
        'sort_order',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getFilteredServices(?string $search = null, ?string $category = null, ?string $status = null, int $limit = 20, int $offset = 0): array
    {
        $builder = $this->builder();

        if (!empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('category', $search)
                ->orLike('description', $search)
                ->groupEnd();
        }

        if (!empty($category) && $category !== 'all') {
            $builder->where('category', $category);
        }

        if ($status !== null && $status !== '') {
            $builder->where('is_active', (int) $status);
        }

        return $builder->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->limit($limit, $offset)
            ->get()
            ->getResultArray();
    }

    public function getFilteredCount(?string $search = null, ?string $category = null, ?string $status = null): int
    {
        $builder = $this->builder();

        if (!empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('category', $search)
                ->orLike('description', $search)
                ->groupEnd();
        }

        if (!empty($category) && $category !== 'all') {
            $builder->where('category', $category);
        }

        if ($status !== null && $status !== '') {
            $builder->where('is_active', (int) $status);
        }

        return $builder->countAllResults();
    }

    public function getDistinctCategories(): array
    {
        $builder = $this->builder();
        $results = $builder->select('category')
            ->distinct()
            ->where('category !=', '')
            ->where('category IS NOT NULL')
            ->orderBy('category', 'ASC')
            ->get()
            ->getResultArray();

        return array_column($results, 'category');
    }

    public function getCategoryCounts(): array
    {
        $counts = [
            'all' => $this->countAllResults(),
        ];

        $builder = $this->builder();
        $results = $builder->select('category, COUNT(*) as count')
            ->where('category !=', '')
            ->where('category IS NOT NULL')
            ->groupBy('category')
            ->get()
            ->getResultArray();

        foreach ($results as $row) {
            $counts[$row['category']] = (int) $row['count'];
        }

        return $counts;
    }
}
