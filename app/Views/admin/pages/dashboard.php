<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<!-- Today's Follow-up Alert Banner (if any due today) -->
<?php if (!empty($todayFollowUps)): ?>
    <div class="alert border-0 shadow-sm d-flex align-items-center justify-content-between p-3 mb-4" 
         style="background: linear-gradient(90deg, #fff3e0 0%, #ffe0b2 100%); border-left: 5px solid #e65100 !important; border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(230, 81, 0, 0.15); display: flex; align-items: center; justify-content: center; color: #e65100;">
                <span class="material-symbols-outlined">notification_important</span>
            </div>
            <div>
                <strong class="text-dark d-block">Client Follow-ups Due Today: <?= count($todayFollowUps) ?> Pending Reminders</strong>
                <small class="text-muted">Reach out to these prospective brides and patrons scheduled for consultation today.</small>
            </div>
        </div>
        <a href="<?= base_url('admin/crm/followups?filter=today') ?>" class="btn btn-sm btn-dark" style="border-radius: 8px;">
            View Today's Reminders
        </a>
    </div>
<?php endif; ?>

<!-- Primary 6-Metric Business Strip -->
<div class="row g-3 mb-4">
    <!-- Today's Appointments -->
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Today's Bookings</span>
                <span class="material-symbols-outlined text-warning" style="font-size: 20px;">today</span>
            </div>
            <div>
                <h3 class="fw-bold mb-0" style="color: #e65100; font-family: 'Playfair Display', serif;"><?= esc($todayBookings) ?></h3>
                <small class="text-muted" style="font-size: 11px;"><?= esc($upcomingAppointments) ?> Upcoming Total</small>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Collected</span>
                <span class="material-symbols-outlined text-success" style="font-size: 20px;">payments</span>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-success" style="font-family: 'Playfair Display', serif;">₹<?= number_format($revenue) ?></h3>
                <small class="text-muted" style="font-size: 11px;"><?= esc($paidInvoices) ?> Paid Invoices</small>
            </div>
        </div>
    </div>

    <!-- Pending Receivables -->
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Pending Balance</span>
                <span class="material-symbols-outlined text-danger" style="font-size: 20px;">pending_actions</span>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-danger" style="font-family: 'Playfair Display', serif;">₹<?= number_format($pendingPayments) ?></h3>
                <small class="text-muted" style="font-size: 11px;"><?= esc($overdueInvoices) ?> Overdue Bills</small>
            </div>
        </div>
    </div>

    <!-- Inbound Leads -->
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">New Leads</span>
                <span class="material-symbols-outlined text-info" style="font-size: 20px;">filter_alt</span>
            </div>
            <div>
                <h3 class="fw-bold mb-0" style="color: #0288d1; font-family: 'Playfair Display', serif;"><?= esc($newLeads) ?></h3>
                <small class="text-muted" style="font-size: 11px;"><?= esc($newEnquiries) ?> Website Inquiries</small>
            </div>
        </div>
    </div>

    <!-- Active Offers -->
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Active Offers</span>
                <span class="material-symbols-outlined text-primary" style="font-size: 20px;">local_offer</span>
            </div>
            <div>
                <h3 class="fw-bold mb-0" style="color: var(--accent); font-family: 'Playfair Display', serif;"><?= esc($offersActive) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Live on Frontend</small>
            </div>
        </div>
    </div>

    <!-- Client Communications -->
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Client Comms</span>
                <span class="material-symbols-outlined text-secondary" style="font-size: 20px;">forward_to_inbox</span>
            </div>
            <div>
                <h3 class="fw-bold mb-0" style="color: #483C46; font-family: 'Playfair Display', serif;"><?= $whatsappSent + $smsSent + $emailSent ?></h3>
                <small class="text-muted" style="font-size: 10.5px;">WA: <?= $whatsappSent ?> | SMS: <?= $smsSent ?> | Mail: <?= $emailSent ?></small>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats Strip (Specialized Enquiries & Completed Services) -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="glass-panel p-3 d-flex align-items-center gap-3">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">spa</span>
            </div>
            <div>
                <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Completed Services</span>
                <h5 class="fw-bold mb-0" style="color: var(--text-main);"><?= esc($completedServices) ?> Treatments Done</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-panel p-3 d-flex align-items-center gap-3">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(163, 105, 82, 0.12); display: flex; align-items: center; justify-content: center; color: #A36952;">
                <span class="material-symbols-outlined">favorite</span>
            </div>
            <div>
                <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Bridal Enquiries</span>
                <h5 class="fw-bold mb-0" style="color: #A36952;"><?= esc($bridalEnquiries) ?> Bridal Inquiries</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-panel p-3 d-flex align-items-center gap-3">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(2, 136, 209, 0.1); display: flex; align-items: center; justify-content: center; color: #0288d1;">
                <span class="material-symbols-outlined">school</span>
            </div>
            <div>
                <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Academy Enquiries</span>
                <h5 class="fw-bold mb-0" style="color: #0288d1;"><?= esc($academyEnquiries) ?> Course Enquiries</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="glass-panel p-3 d-flex align-items-center gap-3">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.1); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">person_add</span>
            </div>
            <div>
                <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">New Customers</span>
                <h5 class="fw-bold mb-0 text-success"><?= esc($newCustomers) ?> Past 30 Days</h5>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 1: Daily Bookings Trend & Monthly Revenue -->
<div class="row g-4 mb-4">
    <div class="col-xl-6">
        <div class="glass-panel p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="color: var(--text-main);">Daily Appointments Trend (Last 7 Days)</h6>
                <span class="badge bg-light text-muted border" style="font-size: 11px;">Real-time</span>
            </div>
            <div style="height: 260px;">
                <canvas id="dailyBookingsChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="glass-panel p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="color: var(--text-main);">Monthly Revenue Growth (₹)</h6>
                <span class="badge bg-light text-muted border" style="font-size: 11px;">Billed Collections</span>
            </div>
            <div style="height: 260px;">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 2: Service Revenue & Lead Pipeline -->
<div class="row g-4 mb-4">
    <div class="col-xl-4">
        <div class="glass-panel p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="color: var(--text-main);">Service-wise Revenue</h6>
                <small class="text-muted">Top Treatments</small>
            </div>
            <div style="height: 260px;">
                <canvas id="serviceRevenueChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="glass-panel p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="color: var(--text-main);">Lead Conversion Pipeline</h6>
                <small class="text-muted">Acquisition Funnel</small>
            </div>
            <div style="height: 260px;">
                <canvas id="pipelineFunnelChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="glass-panel p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0" style="color: var(--text-main);">Payment Collection Status</h6>
                <small class="text-muted">Settlement Ratio</small>
            </div>
            <div style="height: 260px;">
                <canvas id="paymentStatusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Activity Tables: Recent Appointments & Prospects -->
<div class="row g-4 mb-4">
    <!-- Recent Bookings -->
    <div class="col-xl-7">
        <div class="glass-panel p-0 overflow-hidden h-100">
            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0" style="color: var(--text-main); font-size: 14px;">Recent Appointment Schedule</h6>
                <a href="<?= base_url('admin/bookings') ?>" class="btn btn-sm btn-outline-primary" style="font-size: 11px;">View All Bookings</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
                    <thead style="background: rgba(89, 46, 131, 0.04); font-size: 11px; text-transform: uppercase; color: var(--text-muted);">
                        <tr>
                            <th class="ps-4">Code</th>
                            <th>Date / Slot</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recentBookings)): ?>
                            <?php foreach ($recentBookings as $rb): ?>
                                <tr>
                                    <td class="ps-4 fw-bold" style="color: var(--accent);"><?= esc($rb['booking_code'] ?: ('#BK-' . $rb['id'])) ?></td>
                                    <td>
                                        <div><?= date('d M Y', strtotime($rb['booking_date'])) ?></div>
                                        <small class="text-muted"><?= esc($rb['time_slot']) ?></small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= esc($rb['customer_name']) ?></div>
                                        <small class="text-muted"><?= esc($rb['customer_phone']) ?></small>
                                    </td>
                                    <td>
                                        <div><?= esc($rb['service_name']) ?></div>
                                        <small class="text-success fw-bold">₹<?= number_format((float) ($rb['service_price'] ?? 0)) ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= ($rb['status'] === 'completed') ? 'success' : (($rb['status'] === 'confirmed') ? 'info' : 'warning') ?>" style="text-transform: capitalize;">
                                            <?= str_replace('_', ' ', $rb['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">No appointments recorded yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Inbound Leads -->
    <div class="col-xl-5">
        <div class="glass-panel p-0 overflow-hidden h-100">
            <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0" style="color: var(--text-main); font-size: 14px;">Recent Inbound Prospects</h6>
                <a href="<?= base_url('admin/crm/leads') ?>" class="btn btn-sm btn-outline-primary" style="font-size: 11px;">View Pipeline</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
                    <thead style="background: rgba(89, 46, 131, 0.04); font-size: 11px; text-transform: uppercase; color: var(--text-muted);">
                        <tr>
                            <th class="ps-4">Prospect</th>
                            <th>Interest</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recentLeads)): ?>
                            <?php foreach ($recentLeads as $rl): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark"><?= esc($rl['name']) ?></div>
                                        <small class="text-muted"><?= esc($rl['phone']) ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border"><?= esc($rl['service_interested'] ?: 'General') ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= ($rl['status'] === 'converted') ? 'success' : (($rl['status'] === 'new') ? 'danger' : 'primary') ?>" style="text-transform: capitalize;">
                                            <?= str_replace('_', ' ', $rl['status']) ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <?php if (!empty($rl['phone'])): 
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $rl['phone']);
                                            if (strlen($cleanPhone) === 10) $cleanPhone = '91' . $cleanPhone;
                                        ?>
                                            <a href="https://wa.me/<?= $cleanPhone ?>" target="_blank" class="btn btn-sm btn-outline-success p-1" title="Chat on WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">No leads captured yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Render Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Daily Bookings Trend
    var ctxBookings = document.getElementById('dailyBookingsChart').getContext('2d');
    new Chart(ctxBookings, {
        type: 'bar',
        data: {
            labels: <?= json_encode($dailyBookingsLabels) ?>,
            datasets: [{
                label: 'Appointments',
                data: <?= json_encode($dailyBookingsData) ?>,
                backgroundColor: 'rgba(89, 46, 131, 0.75)',
                borderColor: '#592E83',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } },
                x: { grid: { display: false } }
            }
        }
    });

    // 2. Monthly Revenue Growth
    var ctxRev = document.getElementById('monthlyRevenueChart').getContext('2d');
    new Chart(ctxRev, {
        type: 'line',
        data: {
            labels: <?= json_encode($monthlyRevenueLabels) ?>,
            datasets: [{
                label: 'Revenue (₹)',
                data: <?= json_encode($monthlyRevenueData) ?>,
                borderColor: '#A36952',
                backgroundColor: 'rgba(163, 105, 82, 0.1)',
                tension: 0.35,
                fill: true,
                pointBackgroundColor: '#A36952'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });

    // 3. Service-wise Revenue Doughnut
    var ctxSrv = document.getElementById('serviceRevenueChart').getContext('2d');
    new Chart(ctxSrv, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(!empty($serviceLabels) ? $serviceLabels : ['Hydra Facial', 'Bridal Package', 'Hair Keratin']) ?>,
            datasets: [{
                data: <?= json_encode(!empty($serviceData) ? $serviceData : [12000, 25000, 8500]) ?>,
                backgroundColor: ['#592E83', '#A36952', '#0288d1', '#2e7d32', '#e65100']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } }
            }
        }
    });

    // 4. Lead Pipeline Funnel (Horizontal Bar)
    var ctxPipe = document.getElementById('pipelineFunnelChart').getContext('2d');
    new Chart(ctxPipe, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($pipelineCounts)) ?>,
            datasets: [{
                axis: 'y',
                label: 'Prospects',
                data: <?= json_encode(array_values($pipelineCounts)) ?>,
                backgroundColor: ['#d32f2f', '#0288d1', '#f57c00', '#7b1fa2', '#388e3c', '#2e7d32', '#616161'],
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, ticks: { precision: 0 } },
                y: { grid: { display: false } }
            }
        }
    });

    // 5. Payment Status Doughnut
    var ctxPay = document.getElementById('paymentStatusChart').getContext('2d');
    new Chart(ctxPay, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_keys($paymentStatusCounts)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($paymentStatusCounts)) ?>,
                backgroundColor: ['#2e7d32', '#0288d1', '#f57c00', '#d32f2f']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } }
            }
        }
    });
});
</script>

<?= $this->endSection() ?>
