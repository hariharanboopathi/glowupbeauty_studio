<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category_name',
        'slug',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all categories ordered by ID ascending
     */
    public function getAllCategories(): array
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }

    /**
     * Get a map of slug => category_name and name => category_name
     */
    public function getCategoryMap(): array
    {
        $categories = $this->getAllCategories();
        $map = [];
        foreach ($categories as $cat) {
            if (!empty($cat['slug'])) {
                $map[$cat['slug']] = $cat['category_name'];
            }
            $map[$cat['category_name']] = $cat['category_name'];
        }
        return $map;
    }
}
