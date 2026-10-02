<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFooterCmsTables extends Migration
{
    public function up()
    {
        // 1. footer_settings table (Brand, Newsletter, Concierge, Socials, Bottom)
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            // Brand
            'brand_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'Glowup',
            ],
            'brand_subtitle' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'Beauty Studio & Academy',
            ],
            'brand_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // Newsletter
            'newsletter_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'Private Journal',
            ],
            'newsletter_desc' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'newsletter_btn_text' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'Join',
            ],
            // Academy Concierge
            'concierge_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'Academy Concierge',
            ],
            'concierge_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'concierge_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '+91 98200 12345',
            ],
            'concierge_whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '+91 98200 12345',
            ],
            'concierge_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'default'    => 'glowup@gmail.com',
            ],
            'concierge_hours' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'Tue – Sun: 10:00 AM – 8:00 PM',
            ],
            // Social Media
            'social_instagram' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => '#',
            ],
            'social_pinterest' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => '#',
            ],
            'social_facebook' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => '#',
            ],
            'social_youtube' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => '#',
            ],
            'social_location' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => '#',
            ],
            // Footer Bottom
            'copyright_text' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => '© 2025 Glowup Beauty Studio & Academy. All rights reserved.',
            ],
            'additional_text' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'Price varies based on hair length & texture.',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('footer_settings', true);

        // 2. footer_links table (Quick Links & Popular Treatments)
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'group_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50, // 'quick_links' or 'popular_treatments'
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('group_name');
        $this->forge->addKey('sort_order');
        $this->forge->createTable('footer_links', true);

        // Seed initial data
        $db = \Config\Database::connect();

        // Seed default footer_settings
        $db->table('footer_settings')->insert([
            'id'                  => 1,
            'brand_name'          => 'Glowup',
            'brand_subtitle'      => 'Beauty Studio & Academy',
            'brand_description'   => 'An academy of mindful beauty, bespoke haircare, and transformative aesthetic therapies crafted for your natural radiance.',
            'newsletter_title'    => 'Private Journal',
            'newsletter_desc'     => 'Receive curated beauty journals and bespoke privileges.',
            'newsletter_btn_text' => 'Join',
            'concierge_title'     => 'Academy Concierge',
            'concierge_address'   => "Flagship Academy:\n12 Madurai, Tamil Nadu",
            'concierge_phone'     => '+91 98200 12345',
            'concierge_whatsapp'  => '+91 98200 12345',
            'concierge_email'     => 'glowup@gmail.com',
            'concierge_hours'     => 'Tue – Sun: 10:00 AM – 8:00 PM',
            'social_instagram'    => '#',
            'social_pinterest'    => '#',
            'social_facebook'     => '#',
            'social_youtube'      => '#',
            'social_location'     => '#',
            'copyright_text'      => '© 2025 Glowup Beauty Studio & Academy. All rights reserved.',
            'additional_text'     => 'Price varies based on hair length & texture.',
            'updated_at'          => date('Y-m-d H:i:s'),
        ]);

        // Seed default Quick Links
        $quickLinks = [
            ['title' => 'Home', 'url' => '/', 'sort_order' => 1],
            ['title' => 'Services', 'url' => 'services', 'sort_order' => 2],
            ['title' => 'About Us', 'url' => 'about', 'sort_order' => 3],
            ['title' => 'Academy', 'url' => 'academy', 'sort_order' => 4],
            ['title' => 'Gallery', 'url' => 'gallery', 'sort_order' => 5],
            ['title' => 'Contact', 'url' => 'contact', 'sort_order' => 6],
            ['title' => 'Reviews', 'url' => 'review', 'sort_order' => 7],
            ['title' => 'Book Online', 'url' => 'booking', 'sort_order' => 8],
        ];
        foreach ($quickLinks as $item) {
            $db->table('footer_links')->insert([
                'group_name' => 'quick_links',
                'title'      => $item['title'],
                'url'        => $item['url'],
                'sort_order' => $item['sort_order'],
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Seed default Popular Treatments
        $treatments = [
            ['title' => 'Hydra Facial Ritual', 'url' => 'services', 'sort_order' => 1],
            ['title' => 'Keratin Infusion Therapy', 'url' => 'services', 'sort_order' => 2],
            ['title' => 'Aesthetic Botox Treatment', 'url' => 'services', 'sort_order' => 3],
            ['title' => 'Couture Hair Straightening', 'url' => 'services', 'sort_order' => 4],
            ['title' => 'Silk Hair Smoothing', 'url' => 'services', 'sort_order' => 5],
            ['title' => 'Bridal Diploma Course', 'url' => 'academy', 'sort_order' => 6],
        ];
        foreach ($treatments as $item) {
            $db->table('footer_links')->insert([
                'group_name' => 'popular_treatments',
                'title'      => $item['title'],
                'url'        => $item['url'],
                'sort_order' => $item['sort_order'],
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropTable('footer_links', true);
        $this->forge->dropTable('footer_settings', true);
    }
}
