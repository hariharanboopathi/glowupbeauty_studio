<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnquiriesAndBookingsTables extends Migration
{
    public function up()
    {
        // 1. Create Enquiries Table
        if (!$this->db->tableExists('enquiries')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 120,
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                ],
                'phone' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'null'       => true,
                    'default'    => null,
                ],
                'subject' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 200,
                    'default'    => 'General Inquiry',
                ],
                'message' => [
                    'type' => 'TEXT',
                ],
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'default'    => 'new', // new, read, replied
                ],
                'admin_notes' => [
                    'type'    => 'TEXT',
                    'null'    => true,
                    'default' => null,
                ],
                'created_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                    'default' => null,
                ],
                'updated_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                    'default' => null,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('enquiries', true);

            // Seed initial sample inquiries
            $this->db->table('enquiries')->insertBatch([
                [
                    'name'       => 'Ananya Sundaram',
                    'email'      => 'ananya.sundaram@gmail.com',
                    'phone'      => '+91 98401 23456',
                    'subject'    => 'Bridal Couture Booking',
                    'message'    => 'Inquiring about bespoke bridal makeover packages for a wedding on December 14th in Madurai.',
                    'status'     => 'new',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                ],
                [
                    'name'       => 'Deepa Krishnan',
                    'email'      => 'deepa.k@yahoo.com',
                    'phone'      => '+91 97890 54321',
                    'subject'    => 'Academy Admission',
                    'message'    => 'Would like to know the upcoming batch schedule and fee structure for the Advanced Cosmetology Masterclass.',
                    'status'     => 'read',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                ],
                [
                    'name'       => 'Meera Nambiar',
                    'email'      => 'meera.nambiar@outlook.com',
                    'phone'      => '+91 98200 87654',
                    'subject'    => 'Treatment Reservation',
                    'message'    => 'Looking to book a 24K Gold Facial and K-Gloss Keratin treatment for this Saturday afternoon.',
                    'status'     => 'replied',
                    'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                    'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                ],
            ]);
        }

        // 2. Create Bookings Table
        if (!$this->db->tableExists('bookings')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'booking_code' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'unique'     => true,
                ],
                'customer_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 120,
                ],
                'customer_email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                ],
                'customer_phone' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                ],
                'service_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                ],
                'service_price' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '10,2',
                    'default'    => 0.00,
                ],
                'service_duration' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'default'    => '60 Min',
                ],
                'specialist' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => true,
                    'default'    => null,
                ],
                'booking_date' => [
                    'type' => 'DATE',
                ],
                'time_slot' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                ],
                'notes' => [
                    'type'    => 'TEXT',
                    'null'    => true,
                    'default' => null,
                ],
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'default'    => 'pending', // pending, confirmed, completed, cancelled
                ],
                'created_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                    'default' => null,
                ],
                'updated_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                    'default' => null,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('bookings', true);

            // Seed initial sample bookings
            $this->db->table('bookings')->insertBatch([
                [
                    'booking_code'     => 'GLOW-' . strtoupper(substr(uniqid(), -6)),
                    'customer_name'    => 'Priyanka Ramaswamy',
                    'customer_email'   => 'priyanka.r@gmail.com',
                    'customer_phone'   => '+91 99401 98765',
                    'service_name'     => 'Hydra Facial Ritual',
                    'service_price'    => 3500.00,
                    'service_duration' => '75 Min',
                    'specialist'       => 'Elena Vance (Master Aesthetician)',
                    'booking_date'     => date('Y-m-d', strtotime('+1 day')),
                    'time_slot'        => '11:00 AM',
                    'notes'            => 'Sensitive skin consultation requested.',
                    'status'           => 'confirmed',
                    'created_at'       => date('Y-m-d H:i:s', strtotime('-5 hours')),
                    'updated_at'       => date('Y-m-d H:i:s', strtotime('-5 hours')),
                ],
                [
                    'booking_code'     => 'GLOW-' . strtoupper(substr(uniqid(), -6)),
                    'customer_name'    => 'Swetha Jayaraman',
                    'customer_email'   => 'swetha.j@gmail.com',
                    'customer_phone'   => '+91 98402 11223',
                    'service_name'     => 'K-Gloss Hair Smoothing Alchemy',
                    'service_price'    => 6200.00,
                    'service_duration' => '120 Min',
                    'specialist'       => 'Aarav Patel (Senior Trichologist)',
                    'booking_date'     => date('Y-m-d', strtotime('+2 days')),
                    'time_slot'        => '02:30 PM',
                    'notes'            => 'First-time smoothing treatment.',
                    'status'           => 'pending',
                    'created_at'       => date('Y-m-d H:i:s', strtotime('-1 day')),
                    'updated_at'       => date('Y-m-d H:i:s', strtotime('-1 day')),
                ],
                [
                    'booking_code'     => 'GLOW-' . strtoupper(substr(uniqid(), -6)),
                    'customer_name'    => 'Kavitha Natarajan',
                    'customer_email'   => 'kavitha.n@yahoo.com',
                    'customer_phone'   => '+91 97891 33445',
                    'service_name'     => '24K Imperial Gold Facial',
                    'service_price'    => 4800.00,
                    'service_duration' => '90 Min',
                    'specialist'       => 'Kavitha Selvan (Director)',
                    'booking_date'     => date('Y-m-d', strtotime('-2 days')),
                    'time_slot'        => '04:00 PM',
                    'notes'            => 'Completed with collagen micro-infusion.',
                    'status'           => 'completed',
                    'created_at'       => date('Y-m-d H:i:s', strtotime('-3 days')),
                    'updated_at'       => date('Y-m-d H:i:s', strtotime('-2 days')),
                ],
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropTable('bookings', true);
        $this->forge->dropTable('enquiries', true);
    }
}
