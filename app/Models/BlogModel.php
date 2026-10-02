<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table            = 'blog_posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'slug',
        'category_id',
        'category_name',
        'author_name',
        'summary',
        'content',
        'featured_image',
        'is_featured',
        'is_published',
        'views_count',
        'published_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPublishedPosts($limit = 10, $categoryId = null)
    {
        $builder = $this->where('is_published', 1);
        if ($categoryId) {
            $builder->where('category_id', $categoryId);
        }
        return $builder->orderBy('published_at', 'DESC')
                       ->orderBy('id', 'DESC')
                       ->findAll($limit);
    }
}
