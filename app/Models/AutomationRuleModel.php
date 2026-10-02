<?php

namespace App\Models;

use CodeIgniter\Model;

class AutomationRuleModel extends Model
{
    protected $table            = 'automation_rules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'event_trigger',
        'title',
        'channels',
        'email_template_key',
        'is_enabled',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
