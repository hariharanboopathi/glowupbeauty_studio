<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table            = 'gallery_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'category',
        'image_url',
        'description',
        'is_featured',
        'is_before_after',
        'before_image',
        'after_image',
        'sort_order',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActiveGallery($category = null)
    {
        $builder = $this->where('is_active', 1);
        if ($category && $category !== 'all') {
            $builder->where('category', $category);
        }
        return $builder->orderBy('sort_order', 'ASC')
                       ->orderBy('id', 'DESC')
                       ->findAll();
    }
}
