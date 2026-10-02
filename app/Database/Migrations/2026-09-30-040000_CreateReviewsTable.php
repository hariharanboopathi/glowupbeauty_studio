<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
            ],
            'customer_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'rating' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 5,
            ],
            'headline' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'review_text' => [
                'type' => 'TEXT',
            ],
            'service_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'default'    => null,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'all',
            ],
            'specialist_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null'       => true,
                'default'    => null,
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'Madurai',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'default'    => null,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'published',
                'comment'    => 'published or hidden',
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_verified' => [
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
        $this->forge->addKey('status');
        $this->forge->addKey('category');
        $this->forge->addKey('sort_order');
        $this->forge->createTable('reviews', true);

        // Seed initial 6 authentic reviews matching existing frontend design
        $now = date('Y-m-d H:i:s');
        $initialReviews = [
            [
                'customer_name'   => 'Sneha Parthiban',
                'customer_photo'  => null,
                'rating'          => 5,
                'headline'        => 'A royal experience that stayed flawless for 14 hours!',
                'review_text'     => 'Lead Couturier Priya sculpted my traditional temple bridal look with airbrush perfection. From the fresh jasmine garland placement to the lightweight foundation that didn\'t crease during the muhurtham, everything felt like royalty.',
                'service_name'    => 'Couture Royal Bridal Package',
                'category'        => 'bridal',
                'specialist_name' => 'Priya Chandran',
                'location'        => 'Madurai',
                'phone'           => '+91 98765 43210',
                'status'          => 'published',
                'sort_order'      => 1,
                'is_verified'     => 1,
                'created_at'      => date('Y-m-d H:i:s', strtotime('-14 days')),
                'updated_at'      => $now,
            ],
            [
                'customer_name'   => 'Rohini Mukherjee',
                'customer_photo'  => null,
                'rating'          => 5,
                'headline'        => 'Mirror shine restored without losing natural volume!',
                'review_text'     => 'I was terrified of chemical damage, but Founder Maya performed a microscopic porosity analysis first. The Keratin Infusion completely tamed my postpartum frizz while keeping my hair touchably soft and bouncy. 10/10!',
                'service_name'    => 'Keratin Infusion Therapy',
                'category'        => 'hair',
                'specialist_name' => 'Maya Sundaram',
                'location'        => 'Chennai / Madurai',
                'phone'           => '+91 98401 23456',
                'status'          => 'published',
                'sort_order'      => 2,
                'is_verified'     => 1,
                'created_at'      => date('Y-m-d H:i:s', strtotime('-30 days')),
                'updated_at'      => $now,
            ],
            [
                'customer_name'   => 'Ananya Karthik',
                'customer_photo'  => null,
                'rating'          => 5,
                'headline'        => 'Transformed my passion into a 6-figure bridal studio business.',
                'review_text'     => 'The 6-month Master Bridal Diploma gave me hands-on training with 25+ real brides and a photoshoot portfolio that immediately booked me 18 weddings this season. Glowup Academy is the best investment I ever made.',
                'service_name'    => 'Bridal & Fashion Artistry Diploma',
                'category'        => 'academy',
                'specialist_name' => 'Priya & Maya',
                'location'        => 'Academy Graduate \'24',
                'phone'           => '+91 97910 87654',
                'status'          => 'published',
                'sort_order'      => 3,
                'is_verified'     => 1,
                'created_at'      => date('Y-m-d H:i:s', strtotime('-45 days')),
                'updated_at'      => $now,
            ],
            [
                'customer_name'   => 'Dr. Meera Ramaswamy',
                'customer_photo'  => null,
                'rating'          => 5,
                'headline'        => 'Medical-grade hygiene and instant glass skin glow.',
                'review_text'     => 'As a physician, I am extremely particular about sterilization and dermal protocols. Dr. Elena Ross\'s clinical Hydra Facial operates on hospital-grade standards. My congested pores were cleared with zero redness.',
                'service_name'    => 'Hydra Facial Ritual',
                'category'        => 'facials',
                'specialist_name' => 'Dr. Elena Ross',
                'location'        => 'Madurai',
                'phone'           => '+91 94432 11223',
                'status'          => 'published',
                'sort_order'      => 4,
                'is_verified'     => 1,
                'created_at'      => date('Y-m-d H:i:s', strtotime('-21 days')),
                'updated_at'      => $now,
            ],
            [
                'customer_name'   => 'Divya Natarajan',
                'customer_photo'  => null,
                'rating'          => 5,
                'headline'        => 'Japanese thermal straightening that actually lasts.',
                'review_text'     => 'Senior Stylist Aarav Mehta spent 3 hours perfecting each section with precision heat calibration. Even after monsoon humidity, my hair remains silky straight without a flat iron. Worth every single rupee!',
                'service_name'    => 'Japanese Hair Straightening',
                'category'        => 'hair',
                'specialist_name' => 'Aarav Mehta',
                'location'        => 'Tirunelveli',
                'phone'           => '+91 98840 99887',
                'status'          => 'published',
                'sort_order'      => 5,
                'is_verified'     => 1,
                'created_at'      => date('Y-m-d H:i:s', strtotime('-35 days')),
                'updated_at'      => $now,
            ],
            [
                'customer_name'   => 'Shalini Sundar',
                'customer_photo'  => null,
                'rating'          => 5,
                'headline'        => 'The 24K gold ions made my skin look luminous in photos!',
                'review_text'     => 'I booked this 48 hours before my sister\'s wedding. The soothing private acoustic suite with lavender aromatherapy alone was worth it, but the lift in my cheekbones and golden glow was unbelievable.',
                'service_name'    => '24K Gold Cellular Facial',
                'category'        => 'facials',
                'specialist_name' => 'Dr. Elena Ross',
                'location'        => 'Madurai',
                'phone'           => '+91 97890 33445',
                'status'          => 'published',
                'sort_order'      => 6,
                'is_verified'     => 1,
                'created_at'      => date('Y-m-d H:i:s', strtotime('-60 days')),
                'updated_at'      => $now,
            ],
        ];

        $this->db->table('reviews')->insertBatch($initialReviews);
    }

    public function down()
    {
        $this->forge->dropTable('reviews', true);
    }
}
