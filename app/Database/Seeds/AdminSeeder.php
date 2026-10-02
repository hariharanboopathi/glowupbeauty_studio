<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $existing = $this->db->table('admins')->where('email', 'admin@glowup.com')->get()->getRow();

        if (! $existing) {
            $this->db->table('admins')->insert([
                'name'          => 'Alex Vance',
                'email'         => 'admin@glowup.com',
                'password'      => password_hash('Admin@12345', PASSWORD_BCRYPT),
                'profile_image' => null,
                'created_at'    => date('Y-m-d H:i:s'),
                'modified_at'   => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
