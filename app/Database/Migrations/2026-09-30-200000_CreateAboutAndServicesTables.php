<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAboutAndServicesTables extends Migration
{
    public function up()
    {
        // 1. Table: about_settings
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'hero_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default'    => 'The Art of Mindful Beauty',
            ],
            'hero_subtitle' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'genesis_eyebrow' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'The Genesis',
            ],
            'genesis_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default'    => 'Born From a Reverence For Stillness',
            ],
            'genesis_copy1' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'genesis_copy2' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'stat1_value' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => '7+',
            ],
            'stat1_label' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Years of Mastery',
            ],
            'stat2_value' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => '15K+',
            ],
            'stat2_label' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Radiant Patrons',
            ],
            'stat3_value' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => '850+',
            ],
            'stat3_label' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Certified Alumni',
            ],
            'genesis_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'default'    => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1000&q=80',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('about_settings', true);

        // 2. Table: team_members
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'bio' => [
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
        $this->forge->createTable('team_members', true);

        // 3. Table: services
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
                'default'    => 'facials', // facials, hair, bridal, nails, wellness
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 3500.00,
            ],
            'duration' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => '60 Minutes',
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
            'button_text' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Book Now',
            ],
            'button_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default'    => 'booking',
            ],
            'is_featured' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
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
        $this->forge->createTable('services', true);

        // ==========================================
        // SEED INITIAL DATA
        // ==========================================
        $db = \Config\Database::connect();

        // 1. Seed about_settings
        $db->table('about_settings')->insert([
            'hero_title'      => 'The Art of Mindful Beauty',
            'hero_subtitle'   => 'An architectural sanctuary founded to restore biological harmony, empower individual grace, and mentor future masters of the craft.',
            'genesis_eyebrow' => 'The Genesis',
            'genesis_title'   => 'Born From a Reverence For Stillness',
            'genesis_copy1'   => 'Founded in the cultural heart of Madurai, Glowup was conceived not simply as a salon, but as a temple of rejuvenation where the frenzy of modern pace dissolve into calm luxury.',
            'genesis_copy2'   => 'We recognized that true beauty therapy transcends standard cosmetic procedures. It begins with microscopic scalp diagnosis, cellular hydration, non-toxic bio-actives, and deeply restorative touch. Every treatment in our studio is calibrated to enhance your unique structural elegance.',
            'stat1_value'     => '7+',
            'stat1_label'     => 'Years of Mastery',
            'stat2_value'     => '15K+',
            'stat2_label'     => 'Radiant Patrons',
            'stat3_value'     => '850+',
            'stat3_label'     => 'Certified Alumni',
            'genesis_image'   => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1000&q=80',
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        // 2. Seed team_members
        $team = [
            [
                'name'       => 'Maya Sundaram',
                'role'       => 'Founder & Master Trichologist',
                'bio'        => '15+ years formulating bespoke hair chemistry and regenerative capillary therapies.',
                'badge'      => 'Paris Certified',
                'image_url'  => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&q=80',
                'sort_order' => 1,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Dr. Elena Ross',
                'role'       => 'Clinical Aesthetic Director',
                'bio'        => 'Dermatological surgeon specializing in non-invasive hydra resurfacing and peptide infusions.',
                'badge'      => 'Geneva Diploma',
                'image_url'  => 'https://images.unsplash.com/photo-1594744803329-e58b31de8bf5?w=500&q=80',
                'sort_order' => 2,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Aarav Mehta',
                'role'       => 'Haute Bridal Couturier',
                'bio'        => 'Celebrity bridal artist blending traditional Indian royal jewellery adornment with modern dewy minimalism.',
                'badge'      => 'Vogue Featured',
                'image_url'  => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=500&q=80',
                'sort_order' => 3,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Priya Varma',
                'role'       => 'Dean of Academy & Education',
                'bio'        => 'CIDESCO accredited educator mentoring the next generation of salon owners, hair chemists, and aesthetic artists.',
                'badge'      => 'CIDESCO Master',
                'image_url'  => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500&q=80',
                'sort_order' => 4,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('team_members')->insertBatch($team);

        // 3. Seed services
        $services = [
            [
                'name'        => 'Hydra Facial Ritual',
                'category'    => 'facials',
                'price'       => 3500.00,
                'duration'    => '75 Minutes',
                'description' => 'Multi-step resurfacing treatment infusing patented peptides and botanical hydration for an instant, dewy glass-skin luminosity.',
                'image_url'   => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800&q=80',
                'button_text' => 'Book Now',
                'button_url'  => 'booking',
                'is_featured' => 1,
                'is_active'   => 1,
                'sort_order'  => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Keratin Infusion Therapy',
                'category'    => 'hair',
                'price'       => 3500.00,
                'duration'    => '120 Minutes',
                'description' => 'Intensive botanical protein smoothing infusion that eliminates frizz, restores molecular bonds, and locks in mirror shine.',
                'image_url'   => 'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?w=800&q=80',
                'button_text' => 'Book Now',
                'button_url'  => 'booking',
                'is_featured' => 1,
                'is_active'   => 1,
                'sort_order'  => 2,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Botox Capillary Reconstruction',
                'category'    => 'hair',
                'price'       => 3500.00,
                'duration'    => '90 Minutes',
                'description' => 'Deep-conditioning capillary hair botox formula packed with hyaluronic acid and caviar extract to resurrect damaged strands.',
                'image_url'   => 'https://images.unsplash.com/photo-1519699047748-de8e457a634e?w=800&q=80',
                'button_text' => 'Book Now',
                'button_url'  => 'booking',
                'is_featured' => 1,
                'is_active'   => 1,
                'sort_order'  => 3,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Precision Thermal Straightening',
                'category'    => 'hair',
                'price'       => 3500.00,
                'duration'    => '150 Minutes',
                'description' => 'Japanese-inspired precision thermal reconditioning for impeccably sleek, pin-straight hair with silky featherlight movement.',
                'image_url'   => 'https://images.unsplash.com/photo-1560869713-7d0a29430803?w=800&q=80',
                'button_text' => 'Book Now',
                'button_url'  => 'booking',
                'is_featured' => 1,
                'is_active'   => 1,
                'sort_order'  => 4,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Organic Cysteine Smoothing',
                'category'    => 'hair',
                'price'       => 3500.00,
                'duration'    => '120 Minutes',
                'description' => 'Gentle organic cysteine treatment relaxing unruly curls into effortless, manageable, touchably soft satin waves.',
                'image_url'   => 'https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=800&q=80',
                'button_text' => 'Book Now',
                'button_url'  => 'booking',
                'is_featured' => 1,
                'is_active'   => 1,
                'sort_order'  => 5,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Haute Royal Bridal Artistry',
                'category'    => 'bridal',
                'price'       => 15000.00,
                'duration'    => '180 Minutes',
                'description' => 'Bespoke bridal makeover complete with HD airbrush foundation, saree draping, floral hair architecture, and jewel placement.',
                'image_url'   => 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?w=800&q=80',
                'button_text' => 'Reserve Date',
                'button_url'  => 'booking',
                'is_featured' => 1,
                'is_active'   => 1,
                'sort_order'  => 6,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Russian Dry Manicure & BIAB',
                'category'    => 'nails',
                'price'       => 2800.00,
                'duration'    => '75 Minutes',
                'description' => 'Clinical diamond e-file cuticle detailing followed by builder gel reinforcement and minimalist editorial nail art.',
                'image_url'   => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&q=80',
                'button_text' => 'Book Now',
                'button_url'  => 'booking',
                'is_featured' => 0,
                'is_active'   => 1,
                'sort_order'  => 7,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Japanese Head Spa & Scalp Detox',
                'category'    => 'wellness',
                'price'       => 4200.00,
                'duration'    => '90 Minutes',
                'description' => 'Micro-mist aromatic herbal scalp detox with warm rainfall waterfall cascade, lymphatic drainage, and shiatsu neck massage.',
                'image_url'   => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800&q=80',
                'button_text' => 'Book Now',
                'button_url'  => 'booking',
                'is_featured' => 1,
                'is_active'   => 1,
                'sort_order'  => 8,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('services')->insertBatch($services);
    }

    public function down()
    {
        $this->forge->dropTable('services', true);
        $this->forge->dropTable('team_members', true);
        $this->forge->dropTable('about_settings', true);
    }
}
