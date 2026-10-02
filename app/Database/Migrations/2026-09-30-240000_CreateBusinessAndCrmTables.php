<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBusinessAndCrmTables extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        // 1. Alter customers table if needed
        $customerFields = $db->getFieldNames('customers');
        $alterCustomer = [];
        if (!in_array('whatsapp_number', $customerFields)) {
            $alterCustomer['whatsapp_number'] = ['type' => 'VARCHAR', 'constraint' => '30', 'null' => true, 'after' => 'phone'];
        }
        if (!in_array('dob', $customerFields)) {
            $alterCustomer['dob'] = ['type' => 'DATE', 'null' => true, 'after' => 'whatsapp_number'];
        }
        if (!in_array('address', $customerFields)) {
            $alterCustomer['address'] = ['type' => 'TEXT', 'null' => true, 'after' => 'dob'];
        }
        if (!in_array('notes', $customerFields)) {
            $alterCustomer['notes'] = ['type' => 'TEXT', 'null' => true, 'after' => 'address'];
        }
        if (!in_array('tags', $customerFields)) {
            $alterCustomer['tags'] = ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true, 'default' => 'Patron', 'after' => 'notes'];
        }
        if (!in_array('lead_source', $customerFields)) {
            $alterCustomer['lead_source'] = ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true, 'default' => 'Website', 'after' => 'tags'];
        }
        if (!in_array('customer_status', $customerFields)) {
            $alterCustomer['customer_status'] = ['type' => 'VARCHAR', 'constraint' => '50', 'default' => 'active', 'after' => 'status'];
        }
        if (!in_array('preferred_services', $customerFields)) {
            $alterCustomer['preferred_services'] = ['type' => 'TEXT', 'null' => true, 'after' => 'customer_status'];
        }
        if (!empty($alterCustomer)) {
            $this->forge->addColumn('customers', $alterCustomer);
        }

        // 2. Alter bookings table if needed
        $bookingFields = $db->getFieldNames('bookings');
        $alterBooking = [];
        if (!in_array('customer_id', $bookingFields)) {
            $alterBooking['customer_id'] = ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'booking_code'];
        }
        if (!in_array('service_id', $bookingFields)) {
            $alterBooking['service_id'] = ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'customer_phone'];
        }
        if (!in_array('invoice_id', $bookingFields)) {
            $alterBooking['invoice_id'] = ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'status'];
        }
        if (!in_array('invoice_created', $bookingFields)) {
            $alterBooking['invoice_created'] = ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'after' => 'invoice_id'];
        }
        if (!empty($alterBooking)) {
            $this->forge->addColumn('bookings', $alterBooking);
        }

        // 3. Table: leads
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
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'null'       => true,
            ],
            'service_interested' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => true,
            ],
            'source' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Website Enquiry',
            ],
            'campaign' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'new', // new, contacted, follow_up, interested, booking_confirmed, converted, lost
            ],
            'assigned_staff' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Elena Vance',
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
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
        $this->forge->createTable('leads', true);

        // 4. Table: follow_ups
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'lead_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'contact_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'contact_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'service_interested' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => true,
            ],
            'follow_up_date' => [
                'type' => 'DATE',
            ],
            'follow_up_time' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'default'    => '10:00 AM',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'default'    => 'pending', // pending, completed, missed
            ],
            'reminder_sent' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
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
        $this->forge->createTable('follow_ups', true);

        // 5. Table: invoices
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'invoice_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'booking_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'customer_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'null'       => true,
            ],
            'customer_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'customer_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'invoice_date' => [
                'type' => 'DATE',
            ],
            'due_date' => [
                'type' => 'DATE',
            ],
            'subtotal' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'discount_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'fixed', // fixed, percentage
            ],
            'discount_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'tax_rate' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 18.00, // 18% GST
            ],
            'tax_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'total_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'amount_paid' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'balance_due' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'UPI',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'default'    => 'draft', // draft, sent, partially_paid, paid, overdue, cancelled
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'terms' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sent_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'paid_at' => [
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
        $this->forge->createTable('invoices', true);

        // 6. Table: invoice_items
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'invoice_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'item_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'service', // service, product, course, rental
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'unit_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'total_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('invoice_items', true);

        // 7. Table: payments
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'invoice_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'payment_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'UPI',
            ],
            'transaction_ref' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'payment_date' => [
                'type' => 'DATETIME',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'default'    => 'successful', // successful, pending, failed
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
        $this->forge->createTable('payments', true);

        // 8. Table: email_templates
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'template_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'body_html' => [
                'type' => 'LONGTEXT',
            ],
            'variables_hint' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('email_templates', true);

        // 9. Table: offers
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'banner_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
                'null'       => true,
            ],
            'discount_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'percentage', // percentage, fixed
            ],
            'discount_value' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 15.00,
            ],
            'coupon_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'target_service' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'default'    => 'All Treatments',
            ],
            'target_segment' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'all', // all, new, returning, bridal, academy, vip
            ],
            'start_date' => [
                'type' => 'DATE',
            ],
            'end_date' => [
                'type' => 'DATE',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'featured_on_frontend' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'usage_count' => [
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
        $this->forge->createTable('offers', true);

        // 10. Table: communication_logs
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'lead_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'recipient_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'recipient_contact' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'channel' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'default'    => 'email', // email, whatsapp, sms
            ],
            'template_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'message_content' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'default'    => 'sent', // pending, sent, failed
            ],
            'error_message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sent_by_admin' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Alex Vance',
            ],
            'sent_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('communication_logs', true);

        // 11. Table: integrations_config
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'provider_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'provider_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'config_data' => [
                'type' => 'LONGTEXT', // JSON stored server-side
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'not_configured', // not_configured, connected, failed
            ],
            'last_tested_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'last_test_result' => [
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
        $this->forge->createTable('integrations_config', true);

        // 12. Table: customer_notes
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'admin_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => 'Alex Vance',
            ],
            'note_text' => [
                'type' => 'TEXT',
            ],
            'is_pinned' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('customer_notes', true);

        // 13. Table: automation_rules
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'event_trigger' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'channels' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'default'    => '["email"]',
            ],
            'email_template_key' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'is_enabled' => [
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
        $this->forge->createTable('automation_rules', true);

        // ==========================================
        // SEED INITIAL CRM, INVOICE, INTEGRATION DATA
        // ==========================================
        $now = date('Y-m-d H:i:s');

        // Seed Default Email Templates
        $emailTemplates = [
            [
                'template_key'   => 'welcome_email',
                'title'          => 'Patron Welcome Privileges',
                'subject'        => 'Welcome to the Sanctuary of Bespoke Beauty, {{customer_name}}',
                'body_html'      => '<p>Dear {{customer_name}},</p><p>Welcome to <strong>{{business_name}}</strong>. Your personal sanctuary for haute bridal aesthetics, molecular hair treatments, and clinical dermatology is now at your service.</p><p>Discover your personal appointments and loyalty privileges on your patron portal anytime.</p><p>Warmest regards,<br>The Concierge Team</p>',
                'variables_hint' => '{{customer_name}}, {{business_name}}',
                'is_active'      => 1,
                'updated_at'     => $now,
            ],
            [
                'template_key'   => 'booking_confirmation',
                'title'          => 'Booking Confirmation',
                'subject'        => 'Appointment Confirmed: {{service_name}} on {{booking_date}}',
                'body_html'      => '<p>Dear {{customer_name}},</p><p>Your appointment for <strong>{{service_name}}</strong> has been confirmed.</p><p><strong>Date:</strong> {{booking_date}}<br><strong>Time:</strong> {{booking_time}}<br><strong>Reference Code:</strong> {{booking_code}}</p><p>We look forward to curating your radiant transformation.</p>',
                'variables_hint' => '{{customer_name}}, {{service_name}}, {{booking_date}}, {{booking_time}}, {{booking_code}}, {{business_name}}',
                'is_active'      => 1,
                'updated_at'     => $now,
            ],
            [
                'template_key'   => 'service_completed',
                'title'          => 'Service Completed & Thank You',
                'subject'        => 'Thank You for Visiting Glowup, {{customer_name}}',
                'body_html'      => '<p>Dear {{customer_name}},</p><p>It was an honor hosting you for your <strong>{{service_name}}</strong> ritual today.</p><p>Your invoice <strong>{{invoice_number}}</strong> for ₹{{invoice_total}} is available for your records.</p><p>We would cherish your impressions. Please share your experience on our private review folio.</p>',
                'variables_hint' => '{{customer_name}}, {{service_name}}, {{invoice_number}}, {{invoice_total}}, {{business_name}}',
                'is_active'      => 1,
                'updated_at'     => $now,
            ],
            [
                'template_key'   => 'invoice_created',
                'title'          => 'Invoice Issued',
                'subject'        => 'Invoice {{invoice_number}} from {{business_name}}',
                'body_html'      => '<p>Dear {{customer_name}},</p><p>Your invoice <strong>{{invoice_number}}</strong> amounting to <strong>₹{{invoice_total}}</strong> has been generated.</p><p><strong>Balance Due:</strong> ₹{{balance_due}}</p><p>You can view and download your formal GST receipt directly from your patron portal.</p>',
                'variables_hint' => '{{customer_name}}, {{invoice_number}}, {{invoice_total}}, {{balance_due}}, {{business_name}}',
                'is_active'      => 1,
                'updated_at'     => $now,
            ],
            [
                'template_key'   => 'offer_promotion',
                'title'          => 'Exclusive Patron Privilege / Offer',
                'subject'        => 'An Exclusive Privilege for You: {{offer_title}}',
                'body_html'      => '<p>Dear {{customer_name}},</p><p>We are delighted to extend a bespoke privilege: <strong>{{offer_title}}</strong>.</p><p>{{offer_description}}</p><p>Use coupon code <strong>{{coupon_code}}</strong> upon booking to claim your privilege.</p>',
                'variables_hint' => '{{customer_name}}, {{offer_title}}, {{offer_description}}, {{coupon_code}}, {{business_name}}',
                'is_active'      => 1,
                'updated_at'     => $now,
            ],
        ];
        $db->table('email_templates')->insertBatch($emailTemplates);

        // Seed Default Integration Configs
        $integrations = [
            [
                'provider_key'   => 'whatsapp',
                'provider_name'  => 'WhatsApp Business Cloud API (Meta)',
                'config_data'    => json_encode([
                    'phone_number_id'      => '',
                    'business_account_id'  => '',
                    'meta_app_id'          => '',
                    'meta_app_secret'      => '',
                    'access_token'         => '',
                    'webhook_verify_token' => 'glowup_meta_webhook_2026',
                    'api_version'          => 'v19.0',
                    'enabled'              => false,
                ]),
                'status'         => 'not_configured',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'provider_key'   => 'sms',
                'provider_name'  => 'SMS Gateway (Twilio / Msg91 / Fast2SMS)',
                'config_data'    => json_encode([
                    'provider'    => 'Fast2SMS',
                    'api_url'     => 'https://www.fast2sms.com/dev/bulkV2',
                    'api_key'     => '',
                    'sender_id'   => 'GLOWUP',
                    'username'    => '',
                    'password'    => '',
                    'enabled'     => false,
                ]),
                'status'         => 'not_configured',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'provider_key'   => 'email_smtp',
                'provider_name'  => 'Transactional Email (SMTP / Mailgun / SES)',
                'config_data'    => json_encode([
                    'smtp_host'       => 'smtp.gmail.com',
                    'smtp_port'       => 587,
                    'smtp_user'       => '',
                    'smtp_pass'       => '',
                    'smtp_crypto'     => 'tls',
                    'from_email'      => 'concierge@glowup.com',
                    'from_name'       => 'Glowup Studio & Academy',
                    'enabled'         => false,
                ]),
                'status'         => 'not_configured',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'provider_key'   => 'facebook_meta',
                'provider_name'  => 'Meta Lead Ads & Page Sync',
                'config_data'    => json_encode([
                    'app_id'               => '',
                    'app_secret'           => '',
                    'page_id'              => '',
                    'page_access_token'    => '',
                    'webhook_verify_token' => 'glowup_meta_leads_2026',
                    'enabled'              => false,
                ]),
                'status'         => 'not_configured',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'provider_key'   => 'instagram',
                'provider_name'  => 'Instagram Professional API',
                'config_data'    => json_encode([
                    'instagram_account_id' => '',
                    'meta_app_id'          => '',
                    'meta_app_secret'      => '',
                    'access_token'         => '',
                    'enabled'              => false,
                ]),
                'status'         => 'not_configured',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'provider_key'   => 'google_maps',
                'provider_name'  => 'Google Maps Platform',
                'config_data'    => json_encode([
                    'api_key' => '',
                    'enabled' => false,
                ]),
                'status'         => 'not_configured',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ];
        $db->table('integrations_config')->insertBatch($integrations);

        // Seed Default Automation Rules
        $automations = [
            [
                'event_trigger'      => 'new_booking',
                'title'              => 'Instant Booking Confirmation',
                'channels'           => '["email", "whatsapp"]',
                'email_template_key' => 'booking_confirmation',
                'is_enabled'         => 1,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'event_trigger'      => 'service_completed',
                'title'              => 'Service Completion, Invoice & Review Prompt',
                'channels'           => '["email"]',
                'email_template_key' => 'service_completed',
                'is_enabled'         => 1,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'event_trigger'      => 'booking_reminder_24h',
                'title'              => '24-Hour Prior Appointment Reminder',
                'channels'           => '["whatsapp", "sms"]',
                'email_template_key' => 'booking_confirmation',
                'is_enabled'         => 1,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
        ];
        $db->table('automation_rules')->insertBatch($automations);

        // Seed Initial Live Offers
        $offers = [
            [
                'name'                 => 'Diwali Haute Bridal Special',
                'title'                => 'Diwali Bridal Radiance Ritual — 20% Privilege',
                'description'          => 'Complimentary 24K pure gold pre-draping facial with every Haute Bridal Couture package reserved this festive season.',
                'banner_image'         => 'images/slide-bridal.jpg',
                'discount_type'        => 'percentage',
                'discount_value'       => 20.00,
                'coupon_code'          => 'BRIDALGLOW20',
                'target_service'       => 'Haute Bridal Packages',
                'target_segment'       => 'bridal',
                'start_date'           => date('Y-m-d'),
                'end_date'             => date('Y-m-d', strtotime('+45 days')),
                'is_active'            => 1,
                'featured_on_frontend' => 1,
                'usage_count'          => 14,
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'name'                 => 'Keratin Reconditioning Treat',
                'title'                => 'Glass Hair Molecular Keratin — ₹1,500 Off',
                'description'          => 'Bespoke cold-pressed botanical smoothing sealed with mirror thermal iron and ultrasonic peptide misting.',
                'banner_image'         => 'images/slide-hair.jpg',
                'discount_type'        => 'fixed',
                'discount_value'       => 1500.00,
                'coupon_code'          => 'KERATIN1500',
                'target_service'       => 'Molecular Hair Alchemy',
                'target_segment'       => 'all',
                'start_date'           => date('Y-m-d'),
                'end_date'             => date('Y-m-d', strtotime('+30 days')),
                'is_active'            => 1,
                'featured_on_frontend' => 1,
                'usage_count'          => 28,
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
        ];
        $db->table('offers')->insertBatch($offers);

        // Seed Initial CRM Leads
        $leads = [
            [
                'name'               => 'Pooja Sundaram',
                'phone'              => '+91 98401 23456',
                'whatsapp'           => '+91 98401 23456',
                'email'              => 'pooja.sundaram@gmail.com',
                'service_interested' => 'Royal Heritage Temple Bride',
                'source'             => 'Instagram Campaign',
                'campaign'           => 'Festive Bride 2026',
                'notes'              => 'Wedding planned for late November at Meenakshi Temple. Inquired about airbrush trial.',
                'status'             => 'follow_up',
                'assigned_staff'     => 'Priya Varma',
                'created_at'         => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at'         => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'name'               => 'Deepika Ranganathan',
                'phone'              => '+91 97910 88231',
                'whatsapp'           => '+91 97910 88231',
                'email'              => 'deepika.r@outlook.com',
                'service_interested' => 'Diploma in Haute Bridal Artistry',
                'source'             => 'Academy Enquiry Form',
                'campaign'           => 'Autumn Batch Admission',
                'notes'              => 'Wants to inspect studio training labs on Saturday.',
                'status'             => 'contacted',
                'assigned_staff'     => 'Elena Vance',
                'created_at'         => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at'         => date('Y-m-d H:i:s', strtotime('-4 hours')),
            ],
            [
                'name'               => 'Kavitha Murugesan',
                'phone'              => '+91 94432 11980',
                'whatsapp'           => '+91 94432 11980',
                'email'              => 'kavitha.m@yahoo.com',
                'service_interested' => 'Glass Skin Hydra Resurfacing',
                'source'             => 'Website Contact',
                'campaign'           => 'Organic Search',
                'notes'              => 'Dealing with hyperpigmentation. Wants specialist consultation.',
                'status'             => 'new',
                'assigned_staff'     => 'Alex Vance',
                'created_at'         => date('Y-m-d H:i:s', strtotime('-5 hours')),
                'updated_at'         => date('Y-m-d H:i:s', strtotime('-5 hours')),
            ],
        ];
        $db->table('leads')->insertBatch($leads);

        // Seed Follow-ups
        $followUps = [
            [
                'lead_id'            => 1,
                'contact_name'       => 'Pooja Sundaram',
                'contact_phone'      => '+91 98401 23456',
                'service_interested' => 'Royal Heritage Temple Bride',
                'follow_up_date'     => date('Y-m-d', strtotime('+1 day')),
                'follow_up_time'     => '11:00 AM',
                'notes'              => 'Send bridal lookbook catalog & invite for airbrush patch test.',
                'status'             => 'pending',
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'lead_id'            => 2,
                'contact_name'       => 'Deepika Ranganathan',
                'contact_phone'      => '+91 97910 88231',
                'service_interested' => 'Diploma in Haute Bridal Artistry',
                'follow_up_date'     => date('Y-m-d', strtotime('+3 days')),
                'follow_up_time'     => '02:30 PM',
                'notes'              => 'Confirm lab tour appointment & explain installment fee structure.',
                'status'             => 'pending',
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
        ];
        $db->table('follow_ups')->insertBatch($followUps);

        // Seed Initial Invoices & Items
        $inv1 = [
            'invoice_number'   => 'INV-2026-0001',
            'booking_id'       => 1,
            'customer_id'      => 1,
            'customer_name'    => 'Ananya Krishnan',
            'customer_email'   => 'ananya@gmail.com',
            'customer_phone'   => '+91 98765 43210',
            'customer_address' => '42 South Veli Street, Madurai',
            'invoice_date'     => date('Y-m-d', strtotime('-3 days')),
            'due_date'         => date('Y-m-d', strtotime('+7 days')),
            'subtotal'         => 35000.00,
            'discount_type'    => 'percentage',
            'discount_amount'  => 3500.00, // 10%
            'tax_rate'         => 18.00,
            'tax_amount'       => 5670.00,
            'total_amount'     => 37170.00,
            'amount_paid'      => 37170.00,
            'balance_due'      => 0.00,
            'payment_method'   => 'UPI',
            'status'           => 'paid',
            'notes'            => 'Full settlement received via GooglePay UPI ref: 4892019401.',
            'terms'            => 'All bridal treatments subject to our standard studio hygiene standards.',
            'paid_at'          => date('Y-m-d H:i:s', strtotime('-3 days')),
            'created_at'       => date('Y-m-d H:i:s', strtotime('-3 days')),
            'updated_at'       => date('Y-m-d H:i:s', strtotime('-3 days')),
        ];
        $db->table('invoices')->insert($inv1);
        $inv1Id = $db->insertID();

        $db->table('invoice_items')->insert([
            'invoice_id'  => $inv1Id,
            'item_type'   => 'service',
            'item_name'   => 'Royal Heritage Haute Bridal Makeover',
            'description' => 'Complete Temptu HD airbrush, hair sculpt & teardrop saree draping',
            'quantity'    => 1,
            'unit_price'  => 35000.00,
            'total_price' => 35000.00,
            'created_at'  => $now,
        ]);

        $db->table('payments')->insert([
            'invoice_id'      => $inv1Id,
            'customer_id'     => 1,
            'payment_number'  => 'PAY-2026-0001',
            'amount'          => 37170.00,
            'payment_method'  => 'UPI',
            'transaction_ref' => 'UPI-4892019401',
            'payment_date'    => date('Y-m-d H:i:s', strtotime('-3 days')),
            'notes'           => 'Full payment received.',
            'status'          => 'successful',
            'created_at'      => $now,
            'updated_at'      => $now,
        ]);

        $inv2 = [
            'invoice_number'   => 'INV-2026-0002',
            'booking_id'       => null,
            'customer_id'      => 2,
            'customer_name'    => 'Meera Ramachandran',
            'customer_email'   => 'meera.r@gmail.com',
            'customer_phone'   => '+91 94421 77654',
            'customer_address' => '15 KK Nagar, Madurai',
            'invoice_date'     => date('Y-m-d', strtotime('-1 day')),
            'due_date'         => date('Y-m-d', strtotime('+3 days')),
            'subtotal'         => 8500.00,
            'discount_type'    => 'fixed',
            'discount_amount'  => 500.00,
            'tax_rate'         => 18.00,
            'tax_amount'       => 1440.00,
            'total_amount'     => 9440.00,
            'amount_paid'      => 5000.00,
            'balance_due'      => 4440.00,
            'payment_method'   => 'Card',
            'status'           => 'partially_paid',
            'notes'            => 'Advance payment received via POS terminal.',
            'terms'            => 'Balance due on service day.',
            'paid_at'          => null,
            'created_at'       => date('Y-m-d H:i:s', strtotime('-1 day')),
            'updated_at'       => date('Y-m-d H:i:s', strtotime('-1 day')),
        ];
        $db->table('invoices')->insert($inv2);
        $inv2Id = $db->insertID();

        $db->table('invoice_items')->insert([
            'invoice_id'  => $inv2Id,
            'item_type'   => 'service',
            'item_name'   => 'Japanese Straightening & Scalp Detox',
            'description' => 'Keratin realignment and acoustic scalp lymphatic drainage',
            'quantity'    => 1,
            'unit_price'  => 8500.00,
            'total_price' => 8500.00,
            'created_at'  => $now,
        ]);

        $db->table('payments')->insert([
            'invoice_id'      => $inv2Id,
            'customer_id'     => 2,
            'payment_number'  => 'PAY-2026-0002',
            'amount'          => 5000.00,
            'payment_method'  => 'Card',
            'transaction_ref' => 'CARD-TXN-9021',
            'payment_date'    => date('Y-m-d H:i:s', strtotime('-1 day')),
            'notes'           => 'Part payment of ₹5,000 received.',
            'status'          => 'successful',
            'created_at'      => $now,
            'updated_at'      => $now,
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('automation_rules', true);
        $this->forge->dropTable('customer_notes', true);
        $this->forge->dropTable('integrations_config', true);
        $this->forge->dropTable('communication_logs', true);
        $this->forge->dropTable('offers', true);
        $this->forge->dropTable('email_templates', true);
        $this->forge->dropTable('payments', true);
        $this->forge->dropTable('invoice_items', true);
        $this->forge->dropTable('invoices', true);
        $this->forge->dropTable('follow_ups', true);
        $this->forge->dropTable('leads', true);
    }
}
