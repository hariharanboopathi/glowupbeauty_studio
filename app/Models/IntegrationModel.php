<?php

namespace App\Models;

use CodeIgniter\Model;

class IntegrationModel extends Model
{
    protected $table            = 'integrations_config';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'provider_key',
        'provider_name',
        'config_data',
        'status',
        'last_tested_at',
        'last_test_result',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getConfig(string $providerKey): array
    {
        $row = $this->where('provider_key', $providerKey)->first();
        if ($row && !empty($row['config_data'])) {
            $data = json_decode($row['config_data'], true);
            if (is_array($data)) {
                $data['status'] = $row['status'];
                $data['last_tested_at'] = $row['last_tested_at'];
                $data['last_test_result'] = $row['last_test_result'];
                return $data;
            }
        }
        return ['status' => 'not_configured'];
    }

    public function saveConfig(string $providerKey, array $config, ?string $status = null, ?string $testResult = null): bool
    {
        $row = $this->where('provider_key', $providerKey)->first();
        $data = [
            'config_data' => json_encode($config),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];
        if ($status !== null) {
            $data['status'] = $status;
        }
        if ($testResult !== null) {
            $data['last_tested_at']   = date('Y-m-d H:i:s');
            $data['last_test_result'] = $testResult;
        }

        if ($row) {
            return (bool) $this->update($row['id'], $data);
        } else {
            $data['provider_key']  = $providerKey;
            $data['provider_name'] = ucfirst(str_replace('_', ' ', $providerKey));
            $data['status']        = $status ?: 'not_configured';
            $data['created_at']    = date('Y-m-d H:i:s');
            return (bool) $this->insert($data);
        }
    }
}
