<?php

namespace App\Models;

use CodeIgniter\Model;

class HomepageSlideModel extends Model
{
    protected $table            = 'homepage_slides';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'chapter_title',
        'badge_text',
        'time_text',
        'image_url',
        'display_order',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getOrderedSlides(bool $onlyActive = false): array
    {
        $builder = $this->orderBy('display_order', 'ASC')->orderBy('id', 'ASC');
        if ($onlyActive) {
            $builder->where('is_active', 1);
        }
        return $builder->findAll();
    }
}
