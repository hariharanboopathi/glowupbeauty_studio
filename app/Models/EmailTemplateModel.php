<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailTemplateModel extends Model
{
    protected $table            = 'email_templates';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'template_key',
        'title',
        'subject',
        'body_html',
        'variables_hint',
        'is_active',
        'updated_at',
    ];

    protected $useTimestamps = false;

    /**
     * Render subject and body replacing placeholder tags
     */
    public function renderTemplate(string $templateKey, array $data): array
    {
        $tpl = $this->where('template_key', $templateKey)->where('is_active', 1)->first();
        if (!$tpl) {
            return [
                'subject' => 'Notification from Glowup Beauty Studio',
                'body'    => '<p>' . ($data['message'] ?? 'Notification from Glowup.') . '</p>',
            ];
        }

        $subject = $tpl['subject'];
        $body    = $tpl['body_html'];

        // Default business name
        if (!isset($data['business_name'])) {
            $data['business_name'] = 'Glowup Beauty Studio & Academy';
        }

        foreach ($data as $k => $v) {
            if (is_scalar($v)) {
                $tag = '{{' . $k . '}}';
                $subject = str_replace($tag, (string) $v, $subject);
                $body    = str_replace($tag, (string) $v, $body);
            }
        }

        return [
            'subject' => $subject,
            'body'    => $body,
        ];
    }
}
