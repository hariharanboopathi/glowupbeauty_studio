<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'student_name',
        'email',
        'phone',
        'course_id',
        'course_name',
        'batch',
        'status',
        'notes',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getFilteredStudents(?string $search = null, ?string $status = null, int $limit = 20, int $offset = 0): array
    {
        $builder = $this->builder();
        if (!empty($search)) {
            $builder->groupStart()
                ->like('student_name', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search)
                ->orLike('course_name', $search)
                ->groupEnd();
        }
        if (!empty($status) && $status !== 'all') {
            $builder->where('status', $status);
        }
        return $builder->orderBy('id', 'DESC')->limit($limit, $offset)->get()->getResultArray();
    }

    public function getFilteredCount(?string $search = null, ?string $status = null): int
    {
        $builder = $this->builder();
        if (!empty($search)) {
            $builder->groupStart()
                ->like('student_name', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search)
                ->orLike('course_name', $search)
                ->groupEnd();
        }
        if (!empty($status) && $status !== 'all') {
            $builder->where('status', $status);
        }
        return $builder->countAllResults();
    }
}
