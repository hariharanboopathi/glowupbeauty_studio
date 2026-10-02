<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogTables extends Migration
{
    public function up()
    {
        // 1. Table: blog_categories
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '120',
            ],
            'description' => [
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
        $this->forge->createTable('blog_categories', true);

        // 2. Table: blog_posts
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
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'category_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Artistry Insights',
            ],
            'author_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Priya Varma (Creative Director)',
            ],
            'summary' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'content' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'featured_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'null'       => true,
            ],
            'is_featured' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'is_published' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'views_count' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'published_at' => [
                'type' => 'DATETIME',
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
        $this->forge->createTable('blog_posts', true);

        // ==========================================
        // SEED INITIAL DATA
        // ==========================================
        $db = \Config\Database::connect();

        $categories = [
            [
                'name'        => 'Haute Bridal Insights',
                'slug'        => 'haute-bridal-insights',
                'description' => 'Trends, teardrop draping, long-wear matte formulas, and heirloom jewellery coordination.',
                'is_active'   => 1,
                'sort_order'  => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Clinical Skin & Trichology',
                'slug'        => 'clinical-skin-trichology',
                'description' => 'Dermal cellular science, peptide vortex hydra infusions, and scalp micro-circulation.',
                'is_active'   => 1,
                'sort_order'  => 2,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Academy & Masterclasses',
                'slug'        => 'academy-masterclasses',
                'description' => 'Student spotlight, curriculum announcements, and editorial beauty workshops.',
                'is_active'   => 1,
                'sort_order'  => 3,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('blog_categories')->insertBatch($categories);

        $posts = [
            [
                'title'          => 'The Science of Molecular Keratin: Rebuilding Porous Disulfide Bonds',
                'slug'           => 'science-molecular-keratin-porous-disulfide-bonds',
                'category_id'    => 2,
                'category_name'  => 'Clinical Skin & Trichology',
                'author_name'    => 'Chef de Beaute Elena',
                'summary'        => 'Discover how cold-pressed botanical peptides seal hyper-damaged cuticles without flattening natural volume.',
                'content'        => '<p>Hair vitality is fundamentally an architectural inquiry into disulfide and hydrogen bonds. At Glowup, our signature molecular smoothing system delivers nanometer-scale keratin precursors directly into the hair cortex...</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=800&q=80',
                'is_featured'    => 1,
                'is_published'   => 1,
                'views_count'    => 342,
                'published_at'   => date('Y-m-d H:i:s', strtotime('-5 days')),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'title'          => 'Temptu Airbrush vs Traditional HD: Choosing Your Bridal Foundation',
                'slug'           => 'temptu-airbrush-vs-traditional-hd-bridal-foundation',
                'category_id'    => 1,
                'category_name'  => 'Haute Bridal Insights',
                'author_name'    => 'Priya Varma',
                'summary'        => 'A comprehensive technical comparison between micro-silicon air dispersion and brush-blended high-pigment creams for South Indian humid climates.',
                'content'        => '<p>During high-humidity South Indian weddings, bridal makeup must endure up to 16 hours of temple lights, rituals, and high-resolution camera flashes without separating...</p>',
                'featured_image' => 'images/slide-bridal.jpg',
                'is_featured'    => 1,
                'is_published'   => 1,
                'views_count'    => 589,
                'published_at'   => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('blog_posts')->insertBatch($posts);
    }

    public function down()
    {
        $this->forge->dropTable('blog_posts', true);
        $this->forge->dropTable('blog_categories', true);
    }
}
