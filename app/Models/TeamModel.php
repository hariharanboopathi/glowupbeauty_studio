<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table            = 'team_members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'name',
        'role',
        'bio',
        'badge',
        'image_url',
        'sort_order',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getOrderedMembers(bool $onlyActive = false): array
    {
        $builder = $this->orderBy('sort_order', 'ASC')->orderBy('id', 'ASC');
        if ($onlyActive) {
            $builder->where('is_active', 1);
        }
        return $builder->findAll();
    }
}
