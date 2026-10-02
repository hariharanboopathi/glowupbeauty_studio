<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerNoteModel extends Model
{
    protected $table            = 'customer_notes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'customer_id',
        'admin_name',
        'note_text',
        'is_pinned',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}
