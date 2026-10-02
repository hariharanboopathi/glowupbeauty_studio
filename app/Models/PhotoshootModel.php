<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotoshootModel extends Model
{
    protected $table            = 'photoshoot_packages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'package_type',
        'price',
        'duration',
        'description',
        'image_url',
        'inclusions',
        'is_active',
        'sort_order',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActivePackages()
    {
        return $this->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }
}
