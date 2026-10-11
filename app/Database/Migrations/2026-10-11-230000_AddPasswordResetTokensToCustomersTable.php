<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordResetTokensToCustomersTable extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('customers');

        $newFields = [];
        if (!in_array('reset_token_hash', $fields)) {
            $newFields['reset_token_hash'] = [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'default'    => null,
                'after'      => 'password',
            ];
        }
        if (!in_array('reset_token_expires_at', $fields)) {
            $newFields['reset_token_expires_at'] = [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
                'after'   => 'reset_token_hash',
            ];
        }

        if (!empty($newFields)) {
            $this->forge->addColumn('customers', $newFields);
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('customers');

        $dropFields = [];
        if (in_array('reset_token_hash', $fields)) {
            $dropFields[] = 'reset_token_hash';
        }
        if (in_array('reset_token_expires_at', $fields)) {
            $dropFields[] = 'reset_token_expires_at';
        }

        if (!empty($dropFields)) {
            $this->forge->dropColumn('customers', $dropFields);
        }
    }
}
