<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGalleryAndEventsTables extends Migration
{
    public function up()
    {
        // 1. Table: gallery_items
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'bridal', // hair, bridal, facials, academy, nails
            ],
            'image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_featured' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'is_before_after' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'before_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'null'       => true,
            ],
            'after_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'null'       => true,
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
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
        $this->forge->createTable('gallery_items', true);

        // 2. Table: photoshoot_packages
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'package_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Bridal Portfolio',
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 20000.00,
            ],
            'duration' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => '4 Hours',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'null'       => true,
            ],
            'inclusions' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
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
        $this->forge->createTable('photoshoot_packages', true);

        // 3. Table: studio_events
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'event_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Masterclass', // Masterclass, Workshop, Pop-up, Launch
            ],
            'event_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'event_time' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => '10:00 AM - 04:00 PM',
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default'    => 'Glowup Academy Sanctum, Madurai',
            ],
            'fee' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 4999.00,
            ],
            'capacity' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 25,
            ],
            'enrolled_count' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 12,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'upcoming', // upcoming, ongoing, completed
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
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
        $this->forge->createTable('studio_events', true);

        // ==========================================
        // SEED INITIAL DATA
        // ==========================================
        $db = \Config\Database::connect();

        // Seed gallery items
        $gallery = [
            [
                'title'       => 'Royal Heritage Temple Bride',
                'category'    => 'bridal',
                'image_url'   => 'images/slide-bridal.jpg',
                'description' => 'Traditional matte airbrush finish with gold temple jewelry and micro-jasmine braiding.',
                'is_featured' => 1,
                'sort_order'  => 1,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Glass Hair Molecular Keratin Alignment',
                'category'    => 'hair',
                'image_url'   => 'images/slide-hair.jpg',
                'description' => 'High-porosity frizz sealed with cold-pressed botanical keratin and mirror thermal iron.',
                'is_featured' => 1,
                'sort_order'  => 2,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Clinical Dermal Hydra Glow',
                'category'    => 'facials',
                'image_url'   => 'images/slide-facial.jpg',
                'description' => 'Deep cellular vacuum vortex infusion delivering peptide luminescence.',
                'is_featured' => 1,
                'sort_order'  => 3,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Live Masterclass Draping Demo',
                'category'    => 'academy',
                'image_url'   => 'images/academy-tour.jpg',
                'description' => 'Dean Priya Varma instructing diploma students on pleated Kanchipuram silk architecture.',
                'is_featured' => 0,
                'sort_order'  => 4,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Minimalist Russian BIAB Cuticle Detailing',
                'category'    => 'nails',
                'image_url'   => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&q=80',
                'description' => 'Precision diamond e-file cuticle detailing followed by builder gel reinforcement.',
                'is_featured' => 0,
                'sort_order'  => 5,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('gallery_items')->insertBatch($gallery);

        // Seed photoshoot packages
        $photoshoots = [
            [
                'title'        => 'Editorial Bridal Lookbook Shoot',
                'package_type' => 'Bridal Lookbook',
                'price'        => 28000.00,
                'duration'     => '5 Hours',
                'description'  => 'High-fashion editorial photoshoot featuring 3 bespoke couture looks with master hair sculpt and HD airbrush makeup.',
                'image_url'    => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&q=80',
                'inclusions'   => '3 Bridal Makeover Looks, 15 Retouched Editorial High-Res Photos, Studio Lighting & Backdrop, Attendant',
                'sort_order'   => 1,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Creative Portrait & Model Folio',
                'package_type' => 'Model Portfolio',
                'price'        => 16000.00,
                'duration'     => '3 Hours',
                'description'  => 'Professional modeling portfolio development with high-fashion hair textures and dewy glass-skin aesthetics.',
                'image_url'    => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=800&q=80',
                'inclusions'   => '2 Glamour Hair & Makeup Changes, 10 Color-Graded Retouched Images, Moodboard Consultation',
                'sort_order'   => 2,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('photoshoot_packages')->insertBatch($photoshoots);

        // Seed studio events
        $events = [
            [
                'title'          => 'Haute Royal Airbrush Masterclass with Maya Sundaram',
                'event_type'     => 'Masterclass',
                'event_date'     => date('Y-m-d', strtotime('+14 days')),
                'event_time'     => '10:00 AM - 05:00 PM',
                'location'       => 'Glowup Academy Sanctum, Madurai',
                'fee'            => 6500.00,
                'capacity'       => 30,
                'enrolled_count' => 18,
                'description'    => 'Hands-on intensive masterclass mastering Temptu silicon airbrush pressure calibration, speed contouring, and teardrop saree pinning.',
                'image_url'      => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&q=80',
                'status'         => 'upcoming',
                'sort_order'     => 1,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'Japanese Head Spa & Trichology Workshop',
                'event_type'     => 'Workshop',
                'event_date'     => date('Y-m-d', strtotime('+28 days')),
                'event_time'     => '11:00 AM - 04:00 PM',
                'location'       => 'Acoustic Suite 2, Glowup Studio',
                'fee'            => 4200.00,
                'capacity'       => 20,
                'enrolled_count' => 11,
                'description'    => 'Clinical workshop covering 200x microscope scalp scanning, Ayurvedic herbal steam infusion, and acupressure lymphatic drainage.',
                'image_url'      => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800&q=80',
                'status'         => 'upcoming',
                'sort_order'     => 2,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('studio_events')->insertBatch($events);
    }

    public function down()
    {
        $this->forge->dropTable('studio_events', true);
        $this->forge->dropTable('photoshoot_packages', true);
        $this->forge->dropTable('gallery_items', true);
    }
}
