<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<?php
    $c = $profile['customer'];
    $m = $profile['metrics'];
    $initials = strtoupper(substr($c['name'] ?? 'CU', 0, 2));
    $cleanPhone = preg_replace('/[^0-9]/', '', $c['whatsapp_number'] ?: ($c['phone'] ?: ''));
?>

<!-- ==================== CUSTOMER 360° HERO HEADER ==================== -->
<div class="glass-panel p-4 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
        <!-- Customer Identity -->
        <div class="d-flex align-items-center gap-3">
            <div style="width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, var(--accent) 0%, #3a1a59 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; box-shadow: 0 6px 18px rgba(89, 46, 131, 0.25); flex-shrink: 0; overflow: hidden;">
                <?php if (!empty($c['profile_image'])): ?>
                    <img src="<?= esc($c['profile_image']) ?>" alt="<?= esc($c['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    <?= $initials ?>
                <?php endif; ?>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <h3 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main); font-size: 22px;">
                        <?= esc($c['name']) ?>
                    </h3>
                    <span class="badge" style="background: rgba(89, 46, 131, 0.12); color: var(--accent); font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                        #GLW-<?= str_pad((string)$c['id'], 4, '0', STR_PAD_LEFT) ?>
                    </span>
                    <span class="badge <?= ($c['status'] == 1) ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' ?>" style="font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                        <?= ($c['status'] == 1) ? 'Active Patron' : 'Inactive' ?>
                    </span>
                    <?php if (!empty($c['tags'])): ?>
                        <?php foreach (explode(',', $c['tags']) as $tag): ?>
                            <span class="badge" style="background: #faf7f5; border: 1px solid var(--border-subtle); color: #a36952; font-size: 11px; padding: 3px 8px; border-radius: 6px;">
                                <?= esc(trim($tag)) ?>
                            </span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-3 text-muted" style="font-size: 12.5px;">
                    <span class="d-flex align-items-center gap-1">
                        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">mail</span>
                        <a href="mailto:<?= esc($c['email']) ?>" class="text-decoration-none text-muted"><?= esc($c['email']) ?></a>
                    </span>
                    <?php if (!empty($c['phone'])): ?>
                        <span class="d-flex align-items-center gap-1">
                            <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">call</span>
                            <a href="tel:<?= esc($c['phone']) ?>" class="text-decoration-none text-muted"><?= esc($c['phone']) ?></a>
                        </span>
                    <?php endif; ?>
                    <?php if (!empty($c['whatsapp_number'])): ?>
                        <span class="d-flex align-items-center gap-1">
                            <span class="material-symbols-outlined" style="font-size: 16px; color: #25D366;">chat</span>
                            <a href="https://wa.me/<?= $cleanPhone ?>" target="_blank" class="text-decoration-none" style="color: #2e7d32; font-weight: 600;">WhatsApp</a>
                        </span>
                    <?php endif; ?>
                    <span class="text-muted" style="font-size: 11.5px;">
                        Patron Since: <strong><?= !empty($c['created_at']) ? date('M Y', strtotime($c['created_at'])) : '2025' ?></strong>
                    </span>
                </div>
            </div>
        </div>

        <!-- Action Quick Buttons Strip -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" class="btn btn-luxury-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#newBookingModal">
                <span class="material-symbols-outlined" style="font-size: 16px;">calendar_add_on</span>
                <span>Create Booking</span>
            </button>
            <button type="button" class="btn btn-luxury-secondary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">
                <span class="material-symbols-outlined" style="font-size: 16px;">receipt_long</span>
                <span>Create Invoice</span>
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#composeMessageModal">
                <span class="material-symbols-outlined" style="font-size: 16px;">send</span>
                <span>Communicate</span>
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                <span class="material-symbols-outlined" style="font-size: 16px;">note_add</span>
                <span>Add Note</span>
            </button>
        </div>
    </div>
</div>

<!-- ==================== 4 METRICS CARDS ==================== -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Bookings</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($m['total_bookings']) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Lifetime scheduled appointments</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">event_available</span>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Spending</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;">₹<?= number_format($m['total_spent'], 2) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Gross lifetime settled revenue</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">payments</span>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Pending Balance</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: <?= $m['pending_amount'] > 0 ? '#d32f2f' : '#888' ?>; font-family: 'Playfair Display', serif;">₹<?= number_format($m['pending_amount'], 2) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Outstanding invoice receivables</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(211, 47, 47, 0.08); display: flex; align-items: center; justify-content: center; color: #d32f2f;">
                <span class="material-symbols-outlined">account_balance_wallet</span>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Next Appointment</span>
                <h4 class="mb-0 mt-1 fw-bold" style="color: #a36952; font-family: 'Playfair Display', serif; font-size: 16px;">
                    <?= !empty($m['next_appointment']) ? date('M d, Y', strtotime($m['next_appointment'])) : 'None Scheduled' ?>
                </h4>
                <small class="text-muted" style="font-size: 11px;">Last Visit: <?= !empty($m['last_visit']) ? date('M d, Y', strtotime($m['last_visit'])) : 'First Encounter' ?></small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(201, 136, 96, 0.12); display: flex; align-items: center; justify-content: center; color: #a36952;">
                <span class="material-symbols-outlined">alarm</span>
            </div>
        </div>
    </div>
</div>

<!-- ==================== 9 TABS CONTAINER ==================== -->
<div class="glass-panel p-0 mb-4" style="overflow: hidden;">
    <!-- Navigation Tabs Header -->
    <ul class="nav nav-tabs border-bottom px-3 pt-2" id="customerTab" role="tablist" style="background: #faf7f5; border-color: var(--border-subtle) !important;">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-semibold" id="tab-overview-btn" data-bs-toggle="tab" data-bs-target="#tab-overview" type="button" role="tab" style="font-size: 13px; color: var(--text-main);">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 17px;">person</span>
                Overview
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tab-bookings-btn" data-bs-toggle="tab" data-bs-target="#tab-bookings" type="button" role="tab" style="font-size: 13px; color: var(--text-main);">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 17px;">event</span>
                Bookings (<?= count($profile['bookings']) ?>)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tab-services-btn" data-bs-toggle="tab" data-bs-target="#tab-services" type="button" role="tab" style="font-size: 13px; color: var(--text-main);">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 17px;">spa</span>
                Services Completed
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tab-invoices-btn" data-bs-toggle="tab" data-bs-target="#tab-invoices" type="button" role="tab" style="font-size: 13px; color: var(--text-main);">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 17px;">receipt_long</span>
                Invoices (<?= count($profile['invoices']) ?>)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tab-payments-btn" data-bs-toggle="tab" data-bs-target="#tab-payments" type="button" role="tab" style="font-size: 13px; color: var(--text-main);">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 17px;">payments</span>
                Payments (<?= count($profile['payments']) ?>)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tab-enquiries-btn" data-bs-toggle="tab" data-bs-target="#tab-enquiries" type="button" role="tab" style="font-size: 13px; color: var(--text-main);">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 17px;">mail</span>
                Inquiries (<?= count($profile['enquiries']) ?>)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tab-messages-btn" data-bs-toggle="tab" data-bs-target="#tab-messages" type="button" role="tab" style="font-size: 13px; color: var(--text-main);">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 17px;">chat</span>
                Communications (<?= count($profile['communications']) ?>)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="tab-notes-btn" data-bs-toggle="tab" data-bs-target="#tab-notes" type="button" role="tab" style="font-size: 13px; color: var(--text-main);">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 17px;">sticky_note_2</span>
                Internal Notes (<?= count($profile['notes']) ?>)
            </button>
        </li>
    </ul>

    <!-- Tab Content Panes -->
    <div class="tab-content p-4" id="customerTabContent">
        <!-- 1. OVERVIEW TAB -->
        <div class="tab-pane fade show active" id="tab-overview" role="tabpanel">
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Patron Bio & Preferences</h6>
                    <table class="table table-sm border-0 mb-0" style="font-size: 13px;">
                        <tr>
                            <td class="text-muted" style="width: 140px;">Full Name:</td>
                            <td class="fw-bold text-dark"><?= esc($c['name']) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email:</td>
                            <td><?= esc($c['email']) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Primary Phone:</td>
                            <td><?= esc($c['phone'] ?: 'N/A') ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">WhatsApp:</td>
                            <td><?= esc($c['whatsapp_number'] ?: ($c['phone'] ?: 'N/A')) ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Date of Birth:</td>
                            <td><?= !empty($c['dob']) ? date('M d, Y', strtotime($c['dob'])) : 'Not Provided' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Lead Source:</td>
                            <td><span class="badge bg-light text-dark"><?= esc($c['lead_source'] ?: 'Direct Visit') ?></span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Preferred Services:</td>
                            <td><?= esc($c['preferred_services'] ?: 'Haute Bridal & Molecular Keratin') ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Address:</td>
                            <td><?= nl2br(esc($c['address'] ?: 'Madurai, Tamil Nadu')) ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h6 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--text-main);">CRM Notes & Fast Summary</h6>
                    <div class="p-3 rounded mb-3" style="background: #faf7f5; border: 1px solid var(--border-subtle); font-size: 13px; line-height: 1.6;">
                        <?= !empty($c['notes']) ? nl2br(esc($c['notes'])) : '<em class="text-muted">No private dossier notes added yet. Use the "Add Note" button above to document consultation findings or formulation preferences.</em>' ?>
                    </div>

                    <form action="<?= base_url('admin/customers/update-crm/' . $c['id']) ?>" method="POST" class="p-3 rounded border" style="background: #ffffff; border-color: var(--border-subtle) !important;">
                        <?= csrf_field() ?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-bold" style="font-size: 12px; text-transform: uppercase; color: var(--text-muted);">Quick Edit CRM Tags & Preferences</span>
                            <button type="submit" class="btn btn-luxury-primary btn-sm py-1 px-3" style="font-size: 11px;">Update</button>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="tags" class="form-control form-control-sm" placeholder="Tags (comma separated e.g. VIP, Bridal)" value="<?= esc($c['tags'] ?? '') ?>">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="preferred_services" class="form-control form-control-sm" placeholder="Preferred Treatments" value="<?= esc($c['preferred_services'] ?? '') ?>">
                        </div>
                        <div>
                            <input type="text" name="whatsapp_number" class="form-control form-control-sm" placeholder="WhatsApp Number (+91...)" value="<?= esc($c['whatsapp_number'] ?? '') ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 2. BOOKINGS TAB -->
        <div class="tab-pane fade" id="tab-bookings" role="tabpanel">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Appointment Log</h6>
                <button type="button" class="btn btn-luxury-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newBookingModal">
                    + New Booking
                </button>
            </div>
            <?php if (!empty($profile['bookings'])): ?>
                <div class="table-responsive">
                    <table class="table align-middle" style="font-size: 13px;">
                        <thead style="background: #faf7f5;">
                            <tr>
                                <th>Ref Code</th>
                                <th>Treatment</th>
                                <th>Date & Time</th>
                                <th>Specialist</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profile['bookings'] as $b): ?>
                                <tr>
                                    <td><code style="color: var(--accent);"><?= esc($b['booking_code']) ?></code></td>
                                    <td class="fw-bold"><?= esc($b['service_name']) ?></td>
                                    <td><?= date('M d, Y', strtotime($b['booking_date'])) ?> <small class="text-muted">(<?= esc($b['time_slot']) ?>)</small></td>
                                    <td><?= esc($b['specialist'] ?: 'Assigned Practitioner') ?></td>
                                    <td>₹<?= number_format($b['service_price'], 2) ?></td>
                                    <td>
                                        <?php
                                            $stClass = match($b['status']) {
                                                'completed'   => 'bg-success-subtle text-success',
                                                'confirmed'   => 'bg-primary-subtle text-primary',
                                                'in_progress' => 'bg-warning-subtle text-warning',
                                                'cancelled'   => 'bg-danger-subtle text-danger',
                                                default       => 'bg-secondary-subtle text-secondary',
                                            };
                                        ?>
                                        <span class="badge <?= $stClass ?>"><?= ucfirst($b['status']) ?></span>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php if ($b['status'] !== 'completed'): ?>
                                            <a href="<?= base_url('admin/bookings/complete/' . $b['id']) ?>" class="btn btn-sm btn-outline-success" onclick="return confirm('Mark this service as Completed and generate customer invoice?');">
                                                Complete & Invoice
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted small">✓ Completed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">No appointments recorded for this patron.</div>
            <?php endif; ?>
        </div>

        <!-- 3. SERVICES COMPLETED TAB -->
        <div class="tab-pane fade" id="tab-services" role="tabpanel">
            <h6 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Clinical & Salon Service History</h6>
            <?php 
                $completed = array_filter($profile['bookings'], fn($b) => $b['status'] === 'completed');
            ?>
            <?php if (!empty($completed)): ?>
                <div class="table-responsive">
                    <table class="table align-middle" style="font-size: 13px;">
                        <thead style="background: #faf7f5;">
                            <tr>
                                <th>Date Completed</th>
                                <th>Treatment Conducted</th>
                                <th>Duration</th>
                                <th>Master Aesthetician</th>
                                <th>Settled Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($completed as $s): ?>
                                <tr>
                                    <td><?= date('M d, Y', strtotime($s['booking_date'])) ?></td>
                                    <td class="fw-bold" style="color: var(--text-main);"><?= esc($s['service_name']) ?></td>
                                    <td><?= esc($s['service_duration'] ?: '60 Mins') ?></td>
                                    <td><?= esc($s['specialist']) ?></td>
                                    <td class="fw-bold text-success">₹<?= number_format($s['service_price'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">No completed services logged yet. When appointments are marked "Completed", they will be catalogued here automatically.</div>
            <?php endif; ?>
        </div>

        <!-- 4. INVOICES TAB -->
        <div class="tab-pane fade" id="tab-invoices" role="tabpanel">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: var(--text-main);">GST Tax Invoices</h6>
                <button type="button" class="btn btn-luxury-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">
                    + Create Invoice
                </button>
            </div>
            <?php if (!empty($profile['invoices'])): ?>
                <div class="table-responsive">
                    <table class="table align-middle" style="font-size: 13px;">
                        <thead style="background: #faf7f5;">
                            <tr>
                                <th>Invoice #</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Balance Due</th>
                                <th>Status</th>
                                <th style="text-align: right;">View / Print</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profile['invoices'] as $inv): ?>
                                <tr>
                                    <td><strong style="color: var(--accent);"><?= esc($inv['invoice_number']) ?></strong></td>
                                    <td><?= date('M d, Y', strtotime($inv['invoice_date'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($inv['due_date'])) ?></td>
                                    <td class="fw-bold">₹<?= number_format($inv['total_amount'], 2) ?></td>
                                    <td class="text-success">₹<?= number_format($inv['amount_paid'], 2) ?></td>
                                    <td class="text-danger fw-bold">₹<?= number_format($inv['balance_due'], 2) ?></td>
                                    <td>
                                        <span class="badge <?= $inv['status'] === 'paid' ? 'bg-success-subtle text-success' : ($inv['status'] === 'partially_paid' ? 'bg-warning-subtle text-warning' : 'bg-danger-subtle text-danger') ?>">
                                            <?= ucfirst($inv['status']) ?>
                                        </span>
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="<?= base_url('admin/invoices/view/' . $inv['id']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                            Print / PDF
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">No invoices generated for this patron.</div>
            <?php endif; ?>
        </div>

        <!-- 5. PAYMENTS TAB -->
        <div class="tab-pane fade" id="tab-payments" role="tabpanel">
            <h6 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Payment Ledger & Settlements</h6>
            <?php if (!empty($profile['payments'])): ?>
                <div class="table-responsive">
                    <table class="table align-middle" style="font-size: 13px;">
                        <thead style="background: #faf7f5;">
                            <tr>
                                <th>Receipt #</th>
                                <th>Date & Time</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Transaction Ref</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profile['payments'] as $p): ?>
                                <tr>
                                    <td><code><?= esc($p['payment_number']) ?></code></td>
                                    <td><?= date('M d, Y h:i A', strtotime($p['payment_date'])) ?></td>
                                    <td class="fw-bold text-success">₹<?= number_format($p['amount'], 2) ?></td>
                                    <td><span class="badge bg-light text-dark"><?= esc($p['payment_method']) ?></span></td>
                                    <td><small class="text-muted"><?= esc($p['transaction_ref'] ?: 'Direct Cash / Terminal') ?></small></td>
                                    <td><span class="badge bg-success-subtle text-success"><?= ucfirst($p['status']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">No payment settlements logged for this customer.</div>
            <?php endif; ?>
        </div>

        <!-- 6. ENQUIRIES TAB -->
        <div class="tab-pane fade" id="tab-enquiries" role="tabpanel">
            <h6 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Customer Inquiries</h6>
            <?php if (!empty($profile['enquiries'])): ?>
                <div class="table-responsive">
                    <table class="table align-middle" style="font-size: 13px;">
                        <thead style="background: #faf7f5;">
                            <tr>
                                <th>Date</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profile['enquiries'] as $eq): ?>
                                <tr>
                                    <td><?= date('M d, Y', strtotime($eq['created_at'])) ?></td>
                                    <td class="fw-bold"><?= esc($eq['subject']) ?></td>
                                    <td><div class="text-truncate" style="max-width: 380px;"><?= esc($eq['message']) ?></div></td>
                                    <td><span class="badge bg-secondary-subtle text-secondary"><?= ucfirst($eq['status']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">No website inquiries submitted by this patron.</div>
            <?php endif; ?>
        </div>

        <!-- 7. COMMUNICATIONS TAB -->
        <div class="tab-pane fade" id="tab-messages" role="tabpanel">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Omnichannel Communications Log</h6>
                <button type="button" class="btn btn-luxury-primary btn-sm" data-bs-toggle="modal" data-bs-target="#composeMessageModal">
                    + Dispatch Message
                </button>
            </div>
            <?php if (!empty($profile['communications'])): ?>
                <div class="table-responsive">
                    <table class="table align-middle" style="font-size: 13px;">
                        <thead style="background: #faf7f5;">
                            <tr>
                                <th>Timestamp</th>
                                <th>Channel</th>
                                <th>Subject / Template</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Sender</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profile['communications'] as $cm): ?>
                                <tr>
                                    <td><?= date('M d, Y h:i A', strtotime($cm['created_at'])) ?></td>
                                    <td>
                                        <span class="badge" style="background: <?= $cm['channel'] === 'whatsapp' ? '#25D366' : ($cm['channel'] === 'sms' ? '#A36952' : 'var(--accent)') ?>; color: #fff;">
                                            <?= strtoupper($cm['channel']) ?>
                                        </span>
                                    </td>
                                    <td class="fw-semibold"><?= esc($cm['subject'] ?: $cm['template_key'] ?: 'Custom') ?></td>
                                    <td><div class="text-truncate" style="max-width: 320px; font-size: 12px;"><?= esc($cm['message_content']) ?></div></td>
                                    <td><span class="badge bg-success-subtle text-success"><?= ucfirst($cm['status']) ?></span></td>
                                    <td><small class="text-muted"><?= esc($cm['sent_by_admin']) ?></small></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">No outgoing communication records logged for this customer.</div>
            <?php endif; ?>
        </div>

        <!-- 8. INTERNAL NOTES TAB -->
        <div class="tab-pane fade" id="tab-notes" role="tabpanel">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Private Staff Dossier Notes</h6>
                <button type="button" class="btn btn-luxury-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                    + Add Note
                </button>
            </div>
            <?php if (!empty($profile['notes'])): ?>
                <div class="row g-3">
                    <?php foreach ($profile['notes'] as $note): ?>
                        <div class="col-12">
                            <div class="p-3 rounded" style="background: <?= $note['is_pinned'] ? '#fbf8f5' : '#ffffff' ?>; border: 1px solid <?= $note['is_pinned'] ? '#c98860' : 'var(--border-subtle)' ?>;">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold" style="font-size: 13px; color: var(--text-main);">
                                        <?= esc($note['admin_name']) ?>
                                    </span>
                                    <span class="text-muted" style="font-size: 11px;">
                                        <?= date('M d, Y h:i A', strtotime($note['created_at'])) ?>
                                    </span>
                                </div>
                                <div style="font-size: 13px; line-height: 1.5; color: var(--text-main);">
                                    <?= nl2br(esc($note['note_text'])) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">No internal notes created yet. Keep confidential consultation remarks and hair/skin allergies noted here.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- ==================== MODALS ==================== -->

<!-- Modal: Add Note -->
<div class="modal fade" id="addNoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Add Dossier Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/customers/add-note/' . $c['id']) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Confidential Staff Note</label>
                        <textarea name="note_text" class="form-control" rows="4" required placeholder="Allergies, bridal family preferences, preferred hair dye brands..."></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_pinned" id="is_pinned" value="1">
                        <label class="form-check-label fw-semibold" for="is_pinned" style="font-size: 12px;">Pin Note to Top of Profile</label>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Save Note</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Compose Message -->
<div class="modal fade" id="composeMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Communicate with Patron</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/communication/send-quick') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="customer_id" value="<?= $c['id'] ?>">
                <input type="hidden" name="recipient_name" value="<?= esc($c['name']) ?>">
                <input type="hidden" name="recipient_email" value="<?= esc($c['email']) ?>">
                <input type="hidden" name="recipient_phone" value="<?= esc($c['phone']) ?>">
                <input type="hidden" name="recipient_whatsapp" value="<?= esc($c['whatsapp_number'] ?: $c['phone']) ?>">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Channel</label>
                        <select name="channel" class="form-select">
                            <option value="whatsapp">WhatsApp (Official Meta Cloud API)</option>
                            <option value="email" selected>Transactional Email</option>
                            <option value="sms">Direct SMS</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Subject / Headline</label>
                        <input type="text" name="subject" class="form-control" placeholder="Appointment Reminder or Exclusive Privilege">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Message Text</label>
                        <textarea name="message_content" class="form-control" rows="4" required placeholder="Dear <?= esc($c['name']) ?>, ..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Dispatch Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: New Booking for this Customer -->
<div class="modal fade" id="newBookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Schedule Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/bookings/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="customer_id" value="<?= $c['id'] ?>">
                <input type="hidden" name="customer_name" value="<?= esc($c['name']) ?>">
                <input type="hidden" name="customer_email" value="<?= esc($c['email']) ?>">
                <input type="hidden" name="customer_phone" value="<?= esc($c['phone']) ?>">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Select Service / Package <span class="text-danger">*</span></label>
                        <input type="text" name="service_name" class="form-control" required placeholder="e.g. Royal Heritage Temple Bride or Molecular Keratin">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Price (INR ₹)</label>
                            <input type="number" step="0.01" name="service_price" class="form-control" required value="3500">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Specialist</label>
                            <input type="text" name="specialist" class="form-control" value="Elena Vance">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Date <span class="text-danger">*</span></label>
                            <input type="date" name="booking_date" class="form-control" required value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Time Slot <span class="text-danger">*</span></label>
                            <input type="text" name="time_slot" class="form-control" required value="11:00 AM">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Appointment Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Custom styling preferences..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Create Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: New Invoice for this Customer -->
<div class="modal fade" id="newInvoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Create Tax Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/invoices/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="customer_id" value="<?= $c['id'] ?>">
                <input type="hidden" name="customer_name" value="<?= esc($c['name']) ?>">
                <input type="hidden" name="customer_email" value="<?= esc($c['email']) ?>">
                <input type="hidden" name="customer_phone" value="<?= esc($c['phone']) ?>">
                <input type="hidden" name="customer_address" value="<?= esc($c['address']) ?>">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Primary Service / Item <span class="text-danger">*</span></label>
                        <input type="text" name="item_name" class="form-control" required placeholder="e.g. Royal Heritage Haute Bridal Makeover">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Subtotal (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="subtotal" id="inv_subtotal" class="form-control" required value="10000">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Discount (₹)</label>
                            <input type="number" step="0.01" name="discount_amount" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">GST Tax Rate (%)</label>
                            <input type="number" step="0.01" name="tax_rate" class="form-control" value="18.00">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Amount Paid Now (₹)</label>
                            <input type="number" step="0.01" name="amount_paid" class="form-control" value="10000">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Payment Method</label>
                            <select name="payment_method" class="form-select">
                                <option value="UPI">GooglePay / UPI</option>
                                <option value="Card">Credit / Debit Card</option>
                                <option value="Cash">Cash at Sanctum</option>
                                <option value="NetBanking">Net Banking</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold" style="font-size: 11.5px; text-transform: uppercase; color: var(--text-muted);">Due Date</label>
                            <input type="date" name="due_date" class="form-control" value="<?= date('Y-m-d', strtotime('+7 days')) ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Generate Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
