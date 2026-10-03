<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?= view('glowup/partials/seo_meta', [
      'pageKey'       => 'profile',
      'fallbackTitle' => 'Patron Portal & Sanctuary Pass | Glowup Beauty Studio & Academy',
      'fallbackDesc'  => 'Manage your personal patron profile, active appointment passes, treatment history, and radiance rewards at Glowup.',
  ]) ?>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts & Material Symbols (Unified Single Network Request + Non-blocking display:swap) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />

  <!-- Main Unified CSS -->
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />

  <style>
    /* ========== PORTAL TAB STYLING ========== */
    .portal-nav-link {
        color: #d1c4e9;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(229, 221, 240, 0.12);
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .portal-nav-link:hover, .portal-nav-link.active {
        color: #ffffff;
        background: linear-gradient(135deg, rgba(89, 46, 131, 0.6) 0%, rgba(163, 105, 82, 0.6) 100%);
        border-color: var(--accent);
        box-shadow: 0 4px 16px rgba(89, 46, 131, 0.3);
    }
    .patron-card {
        background: rgba(26, 14, 38, 0.7);
        border: 1px solid rgba(229, 221, 240, 0.14);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        margin-bottom: 24px;
    }
    .patron-subcard {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 18px;
        transition: transform 0.2s, border-color 0.2s;
    }
    .patron-subcard:hover {
        border-color: rgba(167, 108, 255, 0.3);
    }

    /* ========== LUXURY TOAST NOTIFICATIONS ========== */
    .toast-container {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 12px;
        max-width: 420px;
        width: calc(100% - 48px);
        pointer-events: none;
    }

    .toast-item {
        pointer-events: auto;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px 18px 18px;
        background: rgba(26, 14, 38, 0.94);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 16px;
        box-shadow: 0 24px 50px rgba(0, 0, 0, 0.65), 0 0 25px rgba(0, 0, 0, 0.35);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        transform: translateX(125%);
        opacity: 0;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
    }

    .toast-item.show {
        transform: translateX(0);
        opacity: 1;
    }

    .toast-item.hide {
        transform: translateX(125%);
        opacity: 0;
    }

    .toast-error {
        border-color: rgba(244, 63, 94, 0.55);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6), 0 0 30px rgba(244, 63, 94, 0.3);
    }

    .toast-error .toast-icon-box {
        color: #fb7185;
        background: rgba(244, 63, 94, 0.18);
        border: 1px solid rgba(244, 63, 94, 0.3);
    }

    .toast-success {
        border-color: rgba(16, 185, 129, 0.55);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6), 0 0 30px rgba(16, 185, 129, 0.3);
    }

    .toast-success .toast-icon-box {
        color: #34d399;
        background: rgba(16, 185, 129, 0.18);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .toast-icon-box {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .toast-icon-box .material-symbols-outlined {
        font-size: 22px;
        color: inherit !important;
    }

    .toast-body {
        flex-grow: 1;
        padding-top: 1px;
    }

    .toast-title {
        font-size: 13.5px;
        font-weight: 700;
        letter-spacing: 0.02em;
        color: #ffffff;
        margin-bottom: 3px;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    .toast-message {
        font-size: 12.5px;
        color: #e5d7f5;
        line-height: 1.45;
        margin: 0;
    }

    .toast-close-btn {
        background: none;
        border: none;
        color: #c8b3e0 !important;
        cursor: pointer;
        padding: 2px;
        margin-left: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: color 0.2s, background 0.2s;
    }

    .toast-close-btn:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.12);
    }

    .toast-close-btn .material-symbols-outlined {
        font-size: 18px;
        color: inherit !important;
    }

    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
    }

    .toast-progress-bar {
        height: 100%;
        width: 100%;
        animation: toastCountdown 5s linear forwards;
    }

    .toast-error .toast-progress-bar {
        background: linear-gradient(90deg, #f43f5e, #fb7185);
    }

    .toast-success .toast-progress-bar {
        background: linear-gradient(90deg, #10b981, #34d399);
    }

    @keyframes toastCountdown {
        from { width: 100%; }
        to { width: 0%; }
    }
  </style>
</head>
<body>

<!-- LUXURY TOAST CONTAINER -->
<div class="toast-container" id="toastContainer" aria-live="polite"></div>

<!-- NAVBAR -->
<?= view('glowup/partials/navbar', ['activePage' => 'profile']) ?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container" style="max-width: 1420px;">
    <h1>Personal Account &amp; Sanctuary Pass</h1>
    <p>Manage your reservations, diagnostic folios, radiance privilege points, and personal beauty profile.</p>
    <div class="breadcrumb-custom">
      <a href="<?= base_url('/') ?>">Home</a>
      <span class="separator">/</span>
      <span style="color:#fff;">Patron Profile</span>
    </div>
  </div>
</section>

<!-- MAIN PROFILE DASHBOARD -->
<section class="section-pad">
  <div class="container" style="max-width: 1280px;">
    <div class="row g-4">

      <!-- Left Column: Identity & Patron Privileges -->
      <div class="col-lg-4">
        <div class="patron-card text-center">
          <div class="patron-avatar-wrap mx-auto mb-3" style="width:96px;height:96px;border-radius:50%;overflow:hidden;border:2px solid var(--accent);background:rgba(167,108,255,0.15);display:flex;align-items:center;justify-content:center;">
            <?php if (!empty($customer['profile_image'])): ?>
              <img src="<?= esc($customer['profile_image']) ?>" alt="<?= esc($customer['name'] ?? 'Patron') ?>" style="width:100%;height:100%;object-fit:cover;" />
            <?php else: ?>
              <span class="material-symbols-outlined" style="font-size:48px;color:var(--accent-light);">account_circle</span>
            <?php endif; ?>
          </div>
          <h4 class="text-white mb-1" style="font-family:'Playfair Display',serif;"><?= esc($customer['name'] ?? 'Patron') ?></h4>
          <span class="badge mb-3" style="background: rgba(163, 105, 82, 0.2); border: 1px solid #A36952; color: #ffcaa6; padding: 6px 14px; border-radius: 20px; font-size: 11px;">
            <span class="material-symbols-outlined align-middle" style="font-size:13px;">stars</span>
            <?= !empty($customer['customer_status']) ? ucfirst($customer['customer_status']) . ' Patron' : 'Royal Silver Tier' ?>
          </span>
          <p class="text-muted mb-4" style="font-size:12px;">
            Patron Pass: <strong>#GLW-<?= str_pad((string)($customer['id'] ?? 1), 4, '0', STR_PAD_LEFT) ?></strong> • Member since <?= !empty($customer['created_at']) ? date('M Y', strtotime($customer['created_at'])) : 'Recent' ?>
          </p>

          <div class="p-3 mb-4 text-start rounded-3" style="background:rgba(255,255,255,0.03);border:1px solid rgba(229,221,240,0.1);">
            <div class="mb-2 text-white" style="font-size:12.5px;">
              <span class="material-symbols-outlined align-middle text-accent me-2" style="font-size:16px;">call</span>
              <?= !empty($customer['phone']) ? esc($customer['phone']) : '<span class="text-muted">No phone added</span>' ?>
            </div>
            <div class="mb-2 text-white" style="font-size:12.5px;">
              <span class="material-symbols-outlined align-middle text-accent me-2" style="font-size:16px;">mail</span>
              <?= esc($customer['email'] ?? 'Not specified') ?>
            </div>
            <?php if (!empty($customer['address'])): ?>
              <div class="text-white" style="font-size:12.5px;">
                <span class="material-symbols-outlined align-middle text-accent me-2" style="font-size:16px;">home</span>
                <?= esc($customer['address']) ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="row g-2 mb-3">
            <div class="col-6">
              <div class="p-3 rounded text-center" style="background: rgba(89, 46, 131, 0.15); border: 1px solid rgba(89, 46, 131, 0.3);">
                <div class="fs-5 fw-bold" style="color: #c98860;"><?= esc($profile['metrics']['total_bookings'] ?? 0) ?></div>
                <small class="text-muted" style="font-size: 10.5px; text-transform: uppercase;">Bookings</small>
              </div>
            </div>
            <div class="col-6">
              <div class="p-3 rounded text-center" style="background: rgba(46, 125, 50, 0.15); border: 1px solid rgba(46, 125, 50, 0.3);">
                <div class="fs-5 fw-bold text-success">₹<?= number_format($profile['metrics']['total_spent'] ?? 0) ?></div>
                <small class="text-muted" style="font-size: 10.5px; text-transform: uppercase;">Total Spent</small>
              </div>
            </div>
          </div>

          <div class="d-flex flex-column gap-2">
            <a href="<?= base_url('booking') ?>" class="btn btn-outline-light w-100" style="font-size: 13px; border-radius: 8px;">
              <span class="material-symbols-outlined align-middle me-1" style="font-size: 16px;">calendar_month</span>
              Book New Appointment
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger w-100" style="font-size: 13px; border-radius: 8px;">
              <span class="material-symbols-outlined align-middle me-1" style="font-size: 16px;">logout</span>
              Sign Out
            </a>
          </div>

          <!-- Studio Concierge Quick Actions -->
          <div class="mt-4 pt-3 border-top border-subtle text-start">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="eyebrow" style="font-size: 10px;">Contact Studio</span>
              <span class="badge" style="background: rgba(37, 211, 102, 0.15); color: #4ade80; font-size: 10px;">Live Concierge</span>
            </div>
            <p class="text-muted mb-3" style="font-size: 11.5px; line-height: 1.45;">
              Need to modify a ritual, arrange private valet, or consult your master stylist?
            </p>
            <div class="d-flex flex-column gap-2">
              <a href="<?= business_phone_url() ?>" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2" style="font-size: 12px; border-radius: 8px;" aria-label="Call Studio Concierge: <?= esc(business_phone()) ?>" title="Call Concierge">
                <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">call</span>
                <span>Call Studio (<?= esc(business_phone()) ?>)</span>
              </a>
              <a href="<?= business_whatsapp_url('Hello Glowup Studio, I am ' . ($customer['name'] ?? 'a patron') . ' and I would like to enquire about my reservations.') ?>" target="_blank" rel="noopener noreferrer" class="btn w-100 d-flex align-items-center justify-content-center gap-2" style="background: #25D366; color: #ffffff; font-weight: 600; font-size: 12px; border-radius: 8px;" aria-label="Chat with Studio Concierge on WhatsApp" title="WhatsApp Concierge">
                <?= glowup_whatsapp_icon('', 16) ?>
                <span>Chat on WhatsApp</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Connected Tabs (Bookings, Services, Invoices, Payments, Offers, Notifications) -->
      <div class="col-lg-8">
        <!-- Portal Nav Tabs -->
        <div class="d-flex flex-wrap gap-2 mb-4" id="portalTabs" role="tablist">
          <a class="portal-nav-link active" data-bs-toggle="pill" href="#tab-bookings">
            <span class="material-symbols-outlined" style="font-size: 16px;">calendar_today</span>
            My Bookings (<?= count($profile['bookings'] ?? []) ?>)
          </a>
          <a class="portal-nav-link" data-bs-toggle="pill" href="#tab-services">
            <span class="material-symbols-outlined" style="font-size: 16px;">spa</span>
            Service History
          </a>
          <a class="portal-nav-link" data-bs-toggle="pill" href="#tab-invoices">
            <span class="material-symbols-outlined" style="font-size: 16px;">receipt_long</span>
            My Invoices (<?= count($profile['invoices'] ?? []) ?>)
          </a>
          <a class="portal-nav-link" data-bs-toggle="pill" href="#tab-payments">
            <span class="material-symbols-outlined" style="font-size: 16px;">payments</span>
            Payments
          </a>
          <a class="portal-nav-link" data-bs-toggle="pill" href="#tab-offers">
            <span class="material-symbols-outlined" style="font-size: 16px;">local_offer</span>
            Privileges &amp; Offers
          </a>
          <a class="portal-nav-link" data-bs-toggle="pill" href="#tab-settings">
            <span class="material-symbols-outlined" style="font-size: 16px;">manage_accounts</span>
            Account Settings
          </a>
          <a class="portal-nav-link" data-bs-toggle="pill" href="#tab-notifications">
            <span class="material-symbols-outlined" style="font-size: 16px;">notifications</span>
            Notifications
          </a>
        </div>

        <div class="tab-content">
          <!-- 1. MY BOOKINGS TAB -->
          <div class="tab-pane fade show active" id="tab-bookings">
            <div class="patron-card">
              <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">My Scheduled Appointments</h5>
              <?php if (!empty($profile['bookings'])): ?>
                <div class="d-flex flex-column gap-3">
                  <?php foreach ($profile['bookings'] as $b): ?>
                    <div class="patron-subcard">
                      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-2">
                        <div>
                          <span class="badge" style="background: rgba(89, 46, 131, 0.3); color: #e5d7f5; font-size: 10px;"><?= esc($b['booking_code'] ?: ('#BK-' . $b['id'])) ?></span>
                          <h6 class="text-white mt-1 mb-0 fw-bold"><?= esc($b['service_name']) ?></h6>
                        </div>
                        <div class="text-sm-end">
                          <span class="text-white fw-bold">₹<?= number_format((float) ($b['service_price'] ?? 0), 2) ?></span>
                        </div>
                      </div>
                      <div class="row g-2 text-muted" style="font-size: 12px;">
                        <div class="col-sm-6">
                          <span class="material-symbols-outlined align-middle me-1" style="font-size: 14px;">calendar_today</span>
                          <?= date('d M Y', strtotime($b['booking_date'])) ?> at <?= esc($b['time_slot']) ?>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                          <span class="badge bg-<?= ($b['status'] === 'completed') ? 'success' : (($b['status'] === 'confirmed') ? 'info' : 'warning') ?>" style="text-transform: capitalize;">
                            <?= esc($b['status']) ?>
                          </span>
                        </div>
                      </div>
                      <div class="mt-2 pt-2 border-top border-subtle d-flex justify-content-between align-items-center">
                        <small class="text-muted" style="font-size: 11px;">Ref: <?= esc($b['booking_code'] ?: ('#GLW-' . $b['id'])) ?></small>
                        <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about my booking ' . ($b['booking_code'] ?: ('#GLW-' . $b['id'])) . '.') ?>" target="_blank" rel="noopener noreferrer" class="btn-wa-enquire py-1 px-2" style="font-size: 11px;" aria-label="Enquire about booking on WhatsApp" title="Enquire on WhatsApp">
                          <?= glowup_whatsapp_icon('', 13) ?>
                          <span>WhatsApp Concierge</span>
                        </a>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <div class="text-center py-4 text-muted">
                  <span class="material-symbols-outlined mb-2" style="font-size: 36px; opacity: 0.5;">event_busy</span>
                  <p class="mb-2" style="font-size: 13px;">No reservations found.</p>
                  <a href="<?= base_url('booking') ?>" class="btn btn-sm btn-primary">Book Your First Treatment</a>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- 2. SERVICE HISTORY TAB -->
          <div class="tab-pane fade" id="tab-services">
            <div class="patron-card">
              <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">Completed Treatment Rituals</h5>
              <?php 
                $completedBookings = array_filter($profile['bookings'] ?? [], function($b) { return $b['status'] === 'completed'; });
              ?>
              <?php if (!empty($completedBookings)): ?>
                <div class="d-flex flex-column gap-3">
                  <?php foreach ($completedBookings as $cb): ?>
                    <div class="patron-subcard">
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <strong class="text-white"><?= esc($cb['service_name']) ?></strong>
                        <span class="badge bg-success bg-opacity-25 text-success">Completed</span>
                      </div>
                      <p class="text-muted mb-2" style="font-size: 12px;">
                        Rendered on <?= date('d F Y', strtotime($cb['booking_date'])) ?> with Specialist <?= esc($cb['specialist'] ?: 'Elena Vance') ?>
                      </p>
                      <a href="<?= base_url('review') ?>" class="btn btn-xs btn-outline-light" style="font-size: 11px;">
                        <span class="material-symbols-outlined align-middle" style="font-size: 13px;">star</span> Write a Review
                      </a>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <p class="text-muted text-center py-4">No completed treatments recorded yet.</p>
              <?php endif; ?>
            </div>
          </div>

          <!-- 3. MY INVOICES TAB -->
          <div class="tab-pane fade" id="tab-invoices">
            <div class="patron-card">
              <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">My Invoices &amp; Receipts</h5>
              <?php if (!empty($profile['invoices'])): ?>
                <div class="table-responsive">
                  <table class="table table-dark table-hover align-middle mb-0" style="font-size: 12.5px;">
                    <thead>
                      <tr class="text-muted" style="font-size: 11px; text-transform: uppercase;">
                        <th>Invoice #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th class="text-end">Receipt</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($profile['invoices'] as $inv): ?>
                        <tr>
                          <td class="fw-bold" style="color: #c98860;"><?= esc($inv['invoice_number']) ?></td>
                          <td><?= date('d M Y', strtotime($inv['invoice_date'])) ?></td>
                          <td class="fw-bold text-white">₹<?= number_format((float) $inv['total_amount'], 2) ?></td>
                          <td class="<?= ((float) $inv['balance_due'] > 0) ? 'text-danger' : 'text-muted' ?>">
                            ₹<?= number_format((float) $inv['balance_due'], 2) ?>
                          </td>
                          <td>
                            <span class="badge bg-<?= ($inv['status'] === 'paid') ? 'success' : 'warning' ?>">
                              <?= ucfirst(str_replace('_', ' ', $inv['status'])) ?>
                            </span>
                          </td>
                          <td class="text-end">
                            <a href="<?= base_url('profile/invoice/' . $inv['id']) ?>" target="_blank" class="btn btn-sm btn-outline-light" style="font-size: 11px; padding: 2px 8px; border-radius: 6px;">
                              <span class="material-symbols-outlined align-middle" style="font-size: 13px;">print</span> Print
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php else: ?>
                <p class="text-muted text-center py-4">No invoices issued to date.</p>
              <?php endif; ?>
            </div>
          </div>

          <!-- 4. PAYMENTS TAB -->
          <div class="tab-pane fade" id="tab-payments">
            <div class="patron-card">
              <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">Payment Settlements</h5>
              <?php if (!empty($profile['payments'])): ?>
                <div class="table-responsive">
                  <table class="table table-dark table-hover align-middle mb-0" style="font-size: 12.5px;">
                    <thead>
                      <tr class="text-muted" style="font-size: 11px; text-transform: uppercase;">
                        <th>Receipt #</th>
                        <th>Date</th>
                        <th>Method</th>
                        <th>Reference</th>
                        <th>Amount</th>
                        <th class="text-end">Receipt</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($profile['payments'] as $p): ?>
                        <tr>
                          <td class="fw-bold"><?= esc($p['payment_number']) ?></td>
                          <td><?= date('d M Y', strtotime($p['payment_date'])) ?></td>
                          <td><?= esc($p['payment_method']) ?></td>
                          <td><code><?= esc($p['transaction_ref']) ?></code></td>
                          <td class="fw-bold text-success">₹<?= number_format((float) $p['amount'], 2) ?></td>
                          <td class="text-end">
                            <?php if (!empty($p['invoice_id'])): ?>
                              <a href="<?= base_url('profile/invoice/' . $p['invoice_id']) ?>" target="_blank" class="btn btn-sm btn-outline-light" style="font-size: 11px; padding: 2px 8px; border-radius: 6px;">
                                <span class="material-symbols-outlined align-middle" style="font-size: 13px;">print</span> Print
                              </a>
                            <?php else: ?>
                              <span class="text-muted" style="font-size: 11px;">Settled</span>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php else: ?>
                <p class="text-muted text-center py-4">No payment transactions recorded.</p>
              <?php endif; ?>
            </div>
          </div>

          <!-- 5. MY OFFERS TAB -->
          <div class="tab-pane fade" id="tab-offers">
            <div class="patron-card">
              <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">Exclusive Privileges &amp; Promotions</h5>
              <?php if (!empty($offers)): ?>
                <div class="row g-3">
                  <?php foreach ($offers as $off): ?>
                    <div class="col-md-6">
                      <div class="patron-subcard h-100 d-flex flex-column justify-content-between">
                        <div>
                          <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge" style="background: rgba(163, 105, 82, 0.3); color: #ffcaa6; font-size: 11px;">
                              <?= ($off['discount_type'] === 'percentage') ? ($off['discount_value'] . '% OFF') : ('₹' . number_format($off['discount_value']) . ' OFF') ?>
                            </span>
                            <small class="text-muted" style="font-size: 11px;">Valid till <?= date('d M', strtotime($off['end_date'])) ?></small>
                          </div>
                          <h6 class="text-white fw-bold mb-1"><?= esc($off['title']) ?></h6>
                          <p class="text-muted mb-3" style="font-size: 12px;"><?= esc($off['description']) ?></p>
                        </div>
                        <div class="p-2 rounded d-flex align-items-center justify-content-between" style="background: rgba(255,255,255,0.05);">
                          <code class="text-accent fw-bold" style="font-size: 13px;"><?= esc($off['coupon_code']) ?></code>
                          <a href="<?= base_url('booking') ?>" class="btn btn-xs btn-outline-light" style="font-size: 11px;">Claim</a>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <p class="text-muted text-center py-4">No active promotional privileges at this time.</p>
              <?php endif; ?>
            </div>
          </div>

          <!-- 7. ACCOUNT SETTINGS TAB -->
          <div class="tab-pane fade" id="tab-settings">
            <div class="patron-card mb-4">
              <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">Edit Patron Profile</h5>
              <form action="<?= base_url('profile/update') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size: 12px;">Full Name *</label>
                    <input type="text" name="name" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;" value="<?= esc($customer['name'] ?? '') ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size: 12px;">Email Address (Read-Only)</label>
                    <input type="email" class="form-control" style="background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.08); color: #aaa;" value="<?= esc($customer['email'] ?? '') ?>" readonly>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size: 12px;">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;" value="<?= esc($customer['phone'] ?? '') ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size: 12px;">WhatsApp Number</label>
                    <input type="tel" name="whatsapp" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;" value="<?= esc($customer['whatsapp_number'] ?? ($customer['phone'] ?? '')) ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size: 12px;">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;" value="<?= esc($customer['dob'] ?? '') ?>">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-muted" style="font-size: 12px;">Preferred Rituals / Services</label>
                    <input type="text" name="preferred_services" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;" value="<?= esc($customer['preferred_services'] ?? '') ?>" placeholder="e.g. Hydra Facials, Bridal Couture">
                  </div>
                  <div class="col-12">
                    <label class="form-label text-muted" style="font-size: 12px;">Sanctuary Postal Address</label>
                    <textarea name="address" rows="2" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;"><?= esc($customer['address'] ?? '') ?></textarea>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #592e83 0%, #a36952 100%); border: none;">Save Profile Changes</button>
                  </div>
                </div>
              </form>
            </div>

            <div class="patron-card">
              <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">Update Security Password</h5>
              <form action="<?= base_url('profile/change-password') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label text-muted" style="font-size: 12px;">Current Password</label>
                    <input type="password" name="current_password" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label text-muted" style="font-size: 12px;">New Password (Min 6 chars)</label>
                    <input type="password" name="new_password" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label text-muted" style="font-size: 12px;">Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.15); color: #fff;" required>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-outline-light">Update Password</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- 6. NOTIFICATIONS TAB -->
          <div class="tab-pane fade" id="tab-notifications">
            <div class="patron-card">
              <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">Studio Notifications &amp; Alerts</h5>
              <?php if (!empty($profile['communications'])): ?>
                <div class="d-flex flex-column gap-3">
                  <?php foreach ($profile['communications'] as $c): ?>
                    <div class="patron-subcard">
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <strong class="text-white" style="font-size: 13px;"><?= esc($c['subject'] ?: 'Studio Notification') ?></strong>
                        <small class="text-muted" style="font-size: 11px;"><?= date('d M Y', strtotime($c['sent_at'] ?: $c['created_at'])) ?></small>
                      </div>
                      <p class="text-muted mb-0" style="font-size: 12px; line-height: 1.5;"><?= esc($c['message_content'] ?? ($c['message'] ?? '')) ?></p>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <p class="text-muted text-center py-4">No notifications at this time.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<?= view('glowup/partials/footer') ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Universal Luxury Toaster Notification Function
    function showToast(type, title, message) {
        const container = document.getElementById('toastContainer');
        if (!container) return;

        container.innerHTML = '';

        const toast = document.createElement('div');
        toast.className = `toast-item toast-${type}`;

        let iconName = 'info';
        if (type === 'success') iconName = 'check_circle';
        else if (type === 'error') iconName = 'error';
        else if (type === 'warning') iconName = 'warning';

        toast.innerHTML = `
            <div class="toast-icon-box">
                <span class="material-symbols-outlined">${iconName}</span>
            </div>
            <div class="toast-body">
                <div class="toast-title">${title}</div>
                <p class="toast-message">${message}</p>
            </div>
            <button type="button" class="toast-close-btn" aria-label="Dismiss notification">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="toast-progress">
                <div class="toast-progress-bar"></div>
            </div>
        `;

        container.appendChild(toast);

        requestAnimationFrame(() => {
            toast.classList.add('show');
        });

        const removeToast = () => {
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => {
                if (toast.parentElement) toast.parentElement.removeChild(toast);
            }, 400);
        };

        const closeBtn = toast.querySelector('.toast-close-btn');
        if (closeBtn) closeBtn.addEventListener('click', removeToast);

        setTimeout(removeToast, 5000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($flashSuccess = session()->getFlashdata('success')): ?>
            const successMsg = <?= json_encode($flashSuccess) ?>;
            let title = 'Sanctuary Notice';
            if (/welcome\s+back/i.test(successMsg)) {
                title = 'Welcome Back';
            } else if (/profile/i.test(successMsg)) {
                title = 'Profile Updated';
            } else if (/password/i.test(successMsg)) {
                title = 'Security Updated';
            }
            showToast('success', title, successMsg);
        <?php endif; ?>

        <?php if ($flashError = session()->getFlashdata('error')): ?>
            showToast('error', 'Notice', <?= json_encode($flashError) ?>);
        <?php endif; ?>
    });
</script>

</body>
</html>
