<?php

namespace App\Models;

use CodeIgniter\Model;

class OfferModel extends Model
{
    protected $table            = 'offers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'title',
        'description',
        'banner_image',
        'discount_type',
        'discount_value',
        'coupon_code',
        'target_service',
        'target_segment',
        'start_date',
        'end_date',
        'is_active',
        'featured_on_frontend',
        'usage_count',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActiveFrontendOffers(): array
    {
        $today = date('Y-m-d');
        return $this->where('is_active', 1)
                    ->where('start_date <=', $today)
                    ->where('end_date >=', $today)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }
}
