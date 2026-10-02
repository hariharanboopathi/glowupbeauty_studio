<?php

namespace App\Models;

use CodeIgniter\Model;

class RentalModel extends Model
{
    protected $table            = 'rentals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'name',
        'category',
        'rental_price',
        'deposit_amount',
        'description',
        'image_url',
        'is_available',
        'sort_order',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getOrderedRentals(?string $category = null): array
    {
        $builder = $this->orderBy('sort_order', 'ASC')->orderBy('id', 'ASC');
        if (!empty($category) && $category !== 'all') {
            $builder->where('category', $category);
        }
        return $builder->findAll();
    }
}
