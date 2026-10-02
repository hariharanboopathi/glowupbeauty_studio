<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBusinessAndAcademyTables extends Migration
{
    public function up()
    {
        // 1. Table: courses
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
            'duration' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => '3 Months',
            ],
            'level' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'All Levels',
            ],
            'badge' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 45000.00,
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
        $this->forge->createTable('courses', true);

        // 2. Table: bridal_packages
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
            'tier' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Standard', // Silver, Gold, Haute Royal
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 25000.00,
            ],
            'duration' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Full Day',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'inclusions' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'badge' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'image_url' => [
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
        $this->forge->createTable('bridal_packages', true);

        // 3. Table: rentals
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Jewellery', // Jewellery, Couture Lehenga, Hair Ornaments, Props
            ],
            'rental_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 3500.00,
            ],
            'deposit_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 5000.00,
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
            'is_available' => [
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
        $this->forge->createTable('rentals', true);

        // 4. Table: students
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'course_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'course_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'batch' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Autumn 2025',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'enrolled', // enrolled, inquiry, completed
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('students', true);

        // ==========================================
        // SEED INITIAL REALISTIC DATA
        // ==========================================
        $db = \Config\Database::connect();

        // Seed courses
        $courses = [
            [
                'title'       => 'Master Diploma in Bridal & Fashion Artistry',
                'duration'    => '6 Months',
                'level'       => 'All Levels',
                'badge'       => 'Flagship Course',
                'price'       => 75000.00,
                'description' => 'Complete training in HD Airbrush makeup, South Indian traditional bridal styling, draping, contouring, and international fashion shoot backstage prep.',
                'image_url'   => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=800&q=80',
                'sort_order'  => 1,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Advanced Hair Chemistry & Color Alchemy',
                'duration'    => '3 Months',
                'level'       => 'Intermediate',
                'badge'       => 'Masterclass',
                'price'       => 45000.00,
                'description' => 'Trichological porosity diagnostics, molecular keratin formulation, dimensional balayage, and Japanese precision rebonding protocols.',
                'image_url'   => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?w=800&q=80',
                'sort_order'  => 2,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Clinical Cosmetology & Aesthetic Skin Science',
                'duration'    => '4 Months',
                'level'       => 'All Levels',
                'badge'       => 'CIDESCO Aligned',
                'price'       => 55000.00,
                'description' => 'Advanced dermal anatomy, vacuum hydra resurfacing, ultrasonic peeling, chemical exfoliation, and non-invasive bio-lifting technologies.',
                'image_url'   => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800&q=80',
                'sort_order'  => 3,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Professional Nail Architecture & Extensions',
                'duration'    => '2 Months',
                'level'       => 'Beginner to Pro',
                'badge'       => 'Trending',
                'price'       => 30000.00,
                'description' => 'Russian e-file dry manicuring, dual-form polygel sculpting, BIAB apex reinforcement, and luxury minimalist editorial nail art.',
                'image_url'   => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&q=80',
                'sort_order'  => 4,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('courses')->insertBatch($courses);

        // Seed bridal packages
        $bridal = [
            [
                'title'       => 'Classic Traditional Muhurtham',
                'tier'        => 'Silver',
                'price'       => 18000.00,
                'duration'    => '4 Hours',
                'description' => 'HD Kryolan/MAC base, traditional Madurai jasmine flower styling, silk saree pleat sculpting, and jewel pinning.',
                'inclusions'  => 'HD Waterproof Makeup, Traditional Hair Braiding, Saree Draping, Jewelry Placement',
                'badge'       => 'Popular',
                'image_url'   => 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=800&q=80',
                'sort_order'  => 1,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Haute Royal Airbrush Matrimonial',
                'tier'        => 'Gold',
                'price'       => 32000.00,
                'duration'    => 'Full Day (2 Looks)',
                'description' => 'Temptu Silicon Airbrush makeup, pre-wedding hydra facial glow session, reception glamour hair sculpt, and dedicated touch-up attendant.',
                'inclusions'  => '2 Complete Bridal Looks (Muhurtham + Reception), Temptu Airbrush Base, Pre-Bridal Hydra Facial, Dedicated Assistant',
                'badge'       => 'Signature',
                'image_url'   => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&q=80',
                'sort_order'  => 2,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'The Imperial Empress Concierge',
                'tier'        => 'Haute Royal',
                'price'       => 55000.00,
                'duration'    => '3-Day Wedding Celebration',
                'description' => 'Complete couture beauty stewardship for Mehendi, Sangeet, Muhurtham, and Grand Reception with senior master artist Maya Sundaram.',
                'inclusions'  => '4 Event Makeovers, Senior Master Artist, Full Family Touchups (2 pax), Luxury Body Polish, 24/7 Concierge',
                'badge'       => 'Luxury VIP',
                'image_url'   => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=800&q=80',
                'sort_order'  => 3,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('bridal_packages')->insertBatch($bridal);

        // Seed rentals
        $rentals = [
            [
                'name'           => 'Temple Nakshi Kemp Choker Set',
                'category'       => 'Jewellery',
                'rental_price'   => 3500.00,
                'deposit_amount' => 5000.00,
                'description'    => 'Antique 22k matte gold finish handcrafted temple jewellery with real ruby kemp stones and green emerald drops.',
                'image_url'      => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=800&q=80',
                'is_available'   => 1,
                'sort_order'     => 1,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Kundan Jadau Mathapatti & Maang Tikka',
                'category'       => 'Jewellery',
                'rental_price'   => 2200.00,
                'deposit_amount' => 3000.00,
                'description'    => 'Artisan hand-set kundan pearls bridal head ornament for royal reception hair framing.',
                'image_url'      => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=800&q=80',
                'is_available'   => 1,
                'sort_order'     => 2,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Rose Gold Zardozi Velvet Bridal Lehenga',
                'category'       => 'Couture Lehenga',
                'rental_price'   => 8500.00,
                'deposit_amount' => 15000.00,
                'description'    => 'Heavy heritage zardozi metallic wire embroidery with double cancan flare and organza dupatta.',
                'image_url'      => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=800&q=80',
                'is_available'   => 1,
                'sort_order'     => 3,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('rentals')->insertBatch($rentals);

        // Seed students
        $students = [
            [
                'student_name' => 'Kavitha Natarajan',
                'email'        => 'kavitha.n@gmail.com',
                'phone'        => '+91 98412 44321',
                'course_id'    => 1,
                'course_name'  => 'Master Diploma in Bridal & Fashion Artistry',
                'batch'        => 'Autumn 2025',
                'status'       => 'enrolled',
                'notes'        => 'Completed module 1 (Airbrush & Draping). Excellent score.',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'student_name' => 'Deepa Shanmugam',
                'email'        => 'deepa.s@yahoo.com',
                'phone'        => '+91 94431 88762',
                'course_id'    => 2,
                'course_name'  => 'Advanced Hair Chemistry & Color Alchemy',
                'batch'        => 'Autumn 2025',
                'status'       => 'enrolled',
                'notes'        => 'Preparing for certification exam.',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'student_name' => 'Ananya Balakrishnan',
                'email'        => 'ananya.b@outlook.com',
                'phone'        => '+91 98940 12890',
                'course_id'    => 3,
                'course_name'  => 'Clinical Cosmetology & Aesthetic Skin Science',
                'batch'        => 'Summer 2025',
                'status'       => 'completed',
                'notes'        => 'Graduated with Distinction. Awarded CIDESCO internship.',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('students')->insertBatch($students);
    }

    public function down()
    {
        $this->forge->dropTable('students', true);
        $this->forge->dropTable('rentals', true);
        $this->forge->dropTable('bridal_packages', true);
        $this->forge->dropTable('courses', true);
    }
}
