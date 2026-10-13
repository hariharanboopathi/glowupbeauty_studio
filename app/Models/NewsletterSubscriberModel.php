<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsletterSubscriberModel extends Model
{
    protected $table            = 'newsletter_subscribers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email',
        'status',
        'ip_address',
        'source',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Subscribe an email address.
     * Returns: ['status' => bool, 'code' => string, 'message' => string, 'is_new' => bool]
     */
    public function subscribe(string $email, ?string $ipAddress = null, string $source = 'footer'): array
    {
        $email = strtolower(trim($email));

        $existing = $this->where('email', $email)->first();

        if ($existing) {
            if ($existing['status'] === 'active') {
                return [
                    'status'  => false,
                    'code'    => 'already_subscribed',
                    'message' => 'You are already subscribed to our Private Journal!',
                    'is_new'  => false,
                ];
            }

            // If previously unsubscribed, reactivate
            $this->update($existing['id'], [
                'status'     => 'active',
                'ip_address' => $ipAddress ?: $existing['ip_address'],
                'source'     => $source ?: $existing['source'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return [
                'status'  => true,
                'code'    => 'reactivated',
                'message' => 'Welcome back! Your subscription to our Private Journal has been reactivated.',
                'is_new'  => false,
            ];
        }

        // Insert new subscriber
        $id = $this->insert([
            'email'      => $email,
            'status'     => 'active',
            'ip_address' => $ipAddress,
            'source'     => $source,
        ]);

        return [
            'status'  => true,
            'code'    => 'subscribed',
            'message' => 'Thank you for subscribing! Welcome to our Private Journal.',
            'is_new'  => true,
            'id'      => $id,
        ];
    }

    /**
     * Get filtered subscribers query builder for admin panel
     */
    public function getFilteredSubscribers(string $status = 'all', string $search = '')
    {
        $builder = $this->orderBy('id', 'DESC');

        if ($status !== 'all' && !empty($status)) {
            $builder->where('status', $status);
        }

        if (!empty($search)) {
            $builder->like('email', $search);
        }

        return $builder;
    }

    /**
     * Get subscriber metrics
     */
    public function getStatistics(): array
    {
        $total        = $this->countAllResults(false);
        $active       = (clone $this)->where('status', 'active')->countAllResults();
        $unsubscribed = (clone $this)->where('status', 'unsubscribed')->countAllResults();
        $recent       = (clone $this)->where('created_at >=', date('Y-m-d 00:00:00', strtotime('-30 days')))->countAllResults();

        return [
            'total'        => $total,
            'active'       => $active,
            'unsubscribed' => $unsubscribed,
            'recent_30d'   => $recent,
        ];
    }
}
