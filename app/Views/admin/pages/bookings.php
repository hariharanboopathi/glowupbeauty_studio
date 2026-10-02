<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Bookings</span>
                <h4 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h4>
            </div>
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">calendar_month</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Today's Schedule</span>
                <h4 class="mb-0 mt-1 fw-bold" style="color: #e65100; font-family: 'Playfair Display', serif;"><?= esc($stats['today'] ?? 0) ?></h4>
            </div>
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(230, 81, 0, 0.08); display: flex; align-items: center; justify-content: center; color: #e65100;">
                <span class="material-symbols-outlined">today</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Upcoming</span>
                <h4 class="mb-0 mt-1 fw-bold" style="color: #0288d1; font-family: 'Playfair Display', serif;"><?= esc($stats['upcoming'] ?? 0) ?></h4>
            </div>
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(2, 136, 209, 0.08); display: flex; align-items: center; justify-content: center; color: #0288d1;">
                <span class="material-symbols-outlined">update</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Completed</span>
                <h4 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['completed'] ?? 0) ?></h4>
            </div>
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">task_alt</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Pending / Queue</span>
                <h4 class="mb-0 mt-1 fw-bold" style="color: #f57c00; font-family: 'Playfair Display', serif;"><?= esc($stats['pending'] ?? 0) ?></h4>
            </div>
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(245, 124, 0, 0.08); display: flex; align-items: center; justify-content: center; color: #f57c00;">
                <span class="material-symbols-outlined">pending_actions</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-2">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Booked</span>
                <h4 class="mb-0 mt-1 fw-bold" style="color: #592E83; font-family: 'Playfair Display', serif;">₹<?= number_format($stats['revenue'] ?? 0) ?></h4>
            </div>
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: #592E83;">
                <span class="material-symbols-outlined">payments</span>
            </div>
        </div>
    </div>
</div>

<!-- Controls Strip -->
<div class="glass-panel p-3 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Status Filter Tabs -->
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= base_url('admin/bookings') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'all' && $dateFilter === 'all') ? 'btn-primary' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">All (<?= esc($stats['total'] ?? 0) ?>)</a>
            <a href="<?= base_url('admin/bookings?date=today') ?>" 
               class="btn btn-sm <?= ($dateFilter === 'today') ? 'btn-warning text-dark' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">
                <span class="material-symbols-outlined align-middle" style="font-size: 14px;">today</span>
                Today (<?= esc($stats['today'] ?? 0) ?>)
            </a>
            <a href="<?= base_url('admin/bookings?status=pending') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'pending') ? 'btn-secondary text-white' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">Pending (<?= esc($stats['pending'] ?? 0) ?>)</a>
            <a href="<?= base_url('admin/bookings?status=confirmed') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'confirmed') ? 'btn-info text-white' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">Confirmed (<?= esc($stats['confirmed'] ?? 0) ?>)</a>
            <a href="<?= base_url('admin/bookings?status=in_progress') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'in_progress') ? 'btn-primary' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">In Progress</a>
            <a href="<?= base_url('admin/bookings?status=completed') ?>" 
               class="btn btn-sm <?= ($statusFilter === 'completed') ? 'btn-success' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">Completed (<?= esc($stats['completed'] ?? 0) ?>)</a>
        </div>

        <!-- Search & New Booking -->
        <div class="d-flex align-items-center gap-2">
            <form action="<?= base_url('admin/bookings') ?>" method="get" class="d-flex align-items-center">
                <div class="position-relative">
                    <input type="text" name="search" class="form-control form-control-sm ps-4" 
                           placeholder="Search customer, code, service..." value="<?= esc($search ?? '') ?>" style="width: 220px; border-radius: 8px;">
                    <span class="material-symbols-outlined position-absolute" 
                          style="left: 8px; top: 50%; transform: translateY(-50%); font-size: 16px; color: #888;">search</span>
                </div>
            </form>
            <button type="button" class="btn btn-sm btn-primary d-flex align-items-center gap-1" 
                    data-bs-toggle="modal" data-bs-target="#bookingModal" onclick="prepareAddBooking()"
                    style="background: var(--accent); border-color: var(--accent); border-radius: 8px;">
                <span class="material-symbols-outlined" style="font-size: 16px;">add_circle</span>
                New Appointment
            </button>
        </div>
    </div>
</div>

<!-- Bookings Schedule Table -->
<div class="glass-panel p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="bookingsMasterTable">
            <thead style="background: rgba(89, 46, 131, 0.04); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                <tr>
                    <th class="ps-4 py-3">Booking Code</th>
                    <th class="py-3">Date & Time</th>
                    <th class="py-3">Customer / Contact</th>
                    <th class="py-3">Treatment / Service</th>
                    <th class="py-3">Staff Specialist</th>
                    <th class="py-3">Price</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Invoice</th>
                    <th class="text-end pe-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody style="font-size: 13px;">
                <?php if (!empty($bookings)): ?>
                    <?php 
                    $todayDate = date('Y-m-d');
                    foreach ($bookings as $b): 
                        $isToday = ($b['booking_date'] === $todayDate);
                    ?>
                        <tr class="<?= $isToday ? 'table-warning bg-opacity-10' : '' ?>">
                            <td class="ps-4 fw-bold" style="color: var(--accent);">
                                <?= esc($b['booking_code'] ?: ('#BK-' . $b['id'])) ?>
                            </td>
                            <td>
                                <div><strong><?= date('d M Y', strtotime($b['booking_date'])) ?></strong></div>
                                <small class="text-muted"><?= esc($b['time_slot'] ?: '10:00 AM') ?></small>
                                <?php if ($isToday): ?>
                                    <span class="badge bg-danger ms-1" style="font-size: 9px;">TODAY</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($b['customer_id'])): ?>
                                    <a href="<?= base_url('admin/customers/' . $b['customer_id']) ?>" class="fw-bold text-decoration-none" style="color: var(--text-main);">
                                        <?= esc($b['customer_name']) ?>
                                        <span class="material-symbols-outlined align-middle" style="font-size: 13px; color: var(--accent);">open_in_new</span>
                                    </a>
                                <?php else: ?>
                                    <span class="fw-bold" style="color: var(--text-main);"><?= esc($b['customer_name']) ?></span>
                                <?php endif; ?>
                                <div class="text-muted" style="font-size: 11px;">
                                    <?= esc($b['customer_phone'] ?: $b['customer_email']) ?>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium"><?= esc($b['service_name']) ?></div>
                                <small class="text-muted"><?= esc($b['service_duration'] ?: '60 mins') ?></small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="material-symbols-outlined text-muted" style="font-size: 15px;">person</span>
                                    <span><?= esc($b['specialist'] ?: 'Elena Vance') ?></span>
                                </div>
                            </td>
                            <td class="fw-bold" style="color: #2e7d32;">
                                ₹<?= number_format((float) ($b['service_price'] ?? 0), 2) ?>
                            </td>
                            <td>
                                <?php 
                                    $st = $b['status'];
                                    $stClass = 'secondary';
                                    if ($st === 'confirmed') $stClass = 'info text-white';
                                    elseif ($st === 'in_progress') $stClass = 'primary';
                                    elseif ($st === 'completed') $stClass = 'success';
                                    elseif ($st === 'cancelled') $stClass = 'danger';
                                    elseif ($st === 'no_show') $stClass = 'dark';
                                    elseif ($st === 'pending') $stClass = 'warning text-dark';
                                ?>
                                <span class="badge bg-<?= $stClass ?>" style="font-weight: 600; text-transform: capitalize; border-radius: 12px; padding: 4px 10px;">
                                    <?= str_replace('_', ' ', $st) ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($b['invoice_id'])): ?>
                                    <a href="<?= base_url('admin/invoices/view/' . $b['invoice_id']) ?>" class="badge text-decoration-none" 
                                       style="background: rgba(89, 46, 131, 0.12); color: var(--accent); font-weight: 600; border-radius: 6px; padding: 4px 8px;">
                                        <span class="material-symbols-outlined align-middle" style="font-size: 12px;">receipt_long</span>
                                        Inv #<?= $b['invoice_id'] ?>
                                    </a>
                                <?php elseif ($b['status'] === 'completed'): ?>
                                    <a href="<?= base_url('admin/bookings/complete/' . $b['id']) ?>" class="badge bg-success text-decoration-none" style="border-radius: 6px;">
                                        Generate Invoice
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted" style="font-size: 11px;">Pending Service</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <!-- Service Completed & Auto Invoice Trigger -->
                                    <?php if ($b['status'] !== 'completed' && $b['status'] !== 'cancelled'): ?>
                                        <a href="<?= base_url('admin/bookings/complete/' . $b['id']) ?>" 
                                           class="btn btn-sm btn-success p-1 d-inline-flex align-items-center justify-content-center" 
                                           title="Mark Completed & Generate Invoice" style="width: 28px; height: 28px; border-radius: 6px;"
                                           onclick="return confirm('Mark service as Completed? An official tax invoice will be generated automatically.')">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">task_alt</span>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Direct WhatsApp Reminder -->
                                    <?php if (!empty($b['customer_phone'])): 
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $b['customer_phone']);
                                        if (strlen($cleanPhone) === 10) $cleanPhone = '91' . $cleanPhone;
                                        $waText = urlencode("Hello " . $b['customer_name'] . ", this is a confirmation from Glowup Beauty Studio for your " . $b['service_name'] . " appointment scheduled on " . date('d M Y', strtotime($b['booking_date'])) . " at " . $b['time_slot'] . " with " . ($b['specialist'] ?: 'our stylist') . ". See you soon!");
                                    ?>
                                        <a href="https://wa.me/<?= $cleanPhone ?>?text=<?= $waText ?>" target="_blank" 
                                           class="btn btn-sm btn-outline-success p-1 d-inline-flex align-items-center justify-content-center" 
                                           title="Send WhatsApp Reminder" style="width: 28px; height: 28px; border-radius: 6px;">
                                            <i class="fab fa-whatsapp" style="font-size: 14px;"></i>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Edit Appointment Modal -->
                                    <button type="button" class="btn btn-sm btn-outline-primary p-1 d-inline-flex align-items-center justify-content-center" 
                                            title="Edit Booking" style="width: 28px; height: 28px; border-radius: 6px;"
                                            onclick='editBooking(<?= json_encode($b, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                        <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                    </button>

                                    <!-- Delete Appointment -->
                                    <a href="<?= base_url('admin/bookings/delete/' . $b['id']) ?>" 
                                       class="btn btn-sm btn-outline-danger p-1 d-inline-flex align-items-center justify-content-center" 
                                       title="Delete" style="width: 28px; height: 28px; border-radius: 6px;"
                                       onclick="return confirm('Delete this booking record?')">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="py-4">
                                <span class="material-symbols-outlined text-muted mb-2" style="font-size: 48px; opacity: 0.4;">event_busy</span>
                                <h6 class="text-muted fw-bold">No Bookings Found</h6>
                                <p class="text-muted mb-3" style="font-size: 12px;">There are no appointments matching the selected filters.</p>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal" onclick="prepareAddBooking()">
                                    Schedule New Appointment
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--accent); padding: 18px 24px;">
                <h6 class="modal-title fw-bold" id="bookingModalTitle">Schedule Salon Appointment</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/bookings/save') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="bk_id" value="0">
                <div class="modal-body p-4">
                    <!-- Client Selector -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Select Existing Customer</label>
                            <select name="customer_id" id="bk_customer_id" class="form-select" onchange="syncCustomerDetails(this)">
                                <option value="0">-- Or Enter New Client Below --</option>
                                <?php if (!empty($customers)): ?>
                                    <?php foreach ($customers as $c): ?>
                                        <option value="<?= $c['id'] ?>" data-name="<?= esc($c['name']) ?>" data-phone="<?= esc($c['phone']) ?>" data-email="<?= esc($c['email']) ?>">
                                            <?= esc($c['name']) ?> (<?= esc($c['phone']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Client Full Name *</label>
                            <input type="text" name="customer_name" id="bk_customer_name" class="form-control" required placeholder="e.g. Ananya Sen">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Phone Number *</label>
                            <input type="text" name="customer_phone" id="bk_customer_phone" class="form-control" required placeholder="+91 98765 43210">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Email Address</label>
                            <input type="email" name="customer_email" id="bk_customer_email" class="form-control" placeholder="client@example.com">
                        </div>
                    </div>

                    <!-- Treatment & Pricing -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Select Service / Treatment *</label>
                            <select name="service_id" id="bk_service_id" class="form-select" onchange="syncServiceDetails(this)">
                                <option value="0">-- Select Catalog Service --</option>
                                <?php if (!empty($services)): ?>
                                    <?php foreach ($services as $s): ?>
                                        <option value="<?= $s['id'] ?>" data-name="<?= esc($s['name']) ?>" data-price="<?= $s['price'] ?>" data-duration="<?= esc($s['duration'] ?? '60 mins') ?>">
                                            <?= esc($s['name']) ?> (₹<?= number_format($s['price']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Service Name (Displayed on Invoice) *</label>
                            <input type="text" name="service_name" id="bk_service_name" class="form-control" required placeholder="e.g. Luxury HydraFacial & Gold Mask">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Service Fee (₹) *</label>
                            <input type="number" step="0.01" name="service_price" id="bk_service_price" class="form-control" required placeholder="2500">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Duration</label>
                            <input type="text" name="service_duration" id="bk_service_duration" class="form-control" placeholder="60 mins" value="60 mins">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Assigned Specialist</label>
                            <input type="text" name="specialist" id="bk_specialist" class="form-control" placeholder="Elena Vance" value="Elena Vance">
                        </div>
                    </div>

                    <!-- Date & Slot -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Appointment Date *</label>
                            <input type="date" name="booking_date" id="bk_booking_date" class="form-control" required value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Time Slot *</label>
                            <select name="time_slot" id="bk_time_slot" class="form-select">
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="11:30 AM">11:30 AM</option>
                                <option value="01:00 PM">01:00 PM</option>
                                <option value="02:30 PM">02:30 PM</option>
                                <option value="04:00 PM">04:00 PM</option>
                                <option value="05:30 PM">05:30 PM</option>
                                <option value="07:00 PM">07:00 PM</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Appointment Status</label>
                            <select name="status" id="bk_status" class="form-select">
                                <option value="pending">Pending</option>
                                <option value="confirmed" selected>Confirmed</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed (Auto Invoice)</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="no_show">No Show</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold" style="font-size: 12px;">Client Notes & Requests</label>
                        <textarea name="notes" id="bk_notes" class="form-control" rows="2" placeholder="e.g. Skin sensitivity, preferred botanical oils, bridal trial session"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function prepareAddBooking() {
    document.getElementById('bookingModalTitle').textContent = 'Schedule Salon Appointment';
    document.getElementById('bk_id').value = '0';
    document.getElementById('bk_customer_id').value = '0';
    document.getElementById('bk_customer_name').value = '';
    document.getElementById('bk_customer_phone').value = '';
    document.getElementById('bk_customer_email').value = '';
    document.getElementById('bk_service_id').value = '0';
    document.getElementById('bk_service_name').value = '';
    document.getElementById('bk_service_price').value = '';
    document.getElementById('bk_service_duration').value = '60 mins';
    document.getElementById('bk_specialist').value = 'Elena Vance';
    document.getElementById('bk_booking_date').value = '<?= date('Y-m-d') ?>';
    document.getElementById('bk_time_slot').value = '10:00 AM';
    document.getElementById('bk_status').value = 'confirmed';
    document.getElementById('bk_notes').value = '';
}

function syncCustomerDetails(selectElem) {
    var opt = selectElem.options[selectElem.selectedIndex];
    if (opt && opt.value !== '0') {
        document.getElementById('bk_customer_name').value = opt.getAttribute('data-name') || '';
        document.getElementById('bk_customer_phone').value = opt.getAttribute('data-phone') || '';
        document.getElementById('bk_customer_email').value = opt.getAttribute('data-email') || '';
    }
}

function syncServiceDetails(selectElem) {
    var opt = selectElem.options[selectElem.selectedIndex];
    if (opt && opt.value !== '0') {
        document.getElementById('bk_service_name').value = opt.getAttribute('data-name') || '';
        document.getElementById('bk_service_price').value = opt.getAttribute('data-price') || '';
        document.getElementById('bk_service_duration').value = opt.getAttribute('data-duration') || '60 mins';
    }
}

function editBooking(b) {
    document.getElementById('bookingModalTitle').textContent = 'Edit Appointment #' + (b.booking_code || b.id);
    document.getElementById('bk_id').value = b.id || 0;
    document.getElementById('bk_customer_id').value = b.customer_id || '0';
    document.getElementById('bk_customer_name').value = b.customer_name || '';
    document.getElementById('bk_customer_phone').value = b.customer_phone || '';
    document.getElementById('bk_customer_email').value = b.customer_email || '';
    document.getElementById('bk_service_id').value = b.service_id || '0';
    document.getElementById('bk_service_name').value = b.service_name || '';
    document.getElementById('bk_service_price').value = b.service_price || '0';
    document.getElementById('bk_service_duration').value = b.service_duration || '60 mins';
    document.getElementById('bk_specialist').value = b.specialist || 'Elena Vance';
    document.getElementById('bk_booking_date').value = b.booking_date || '<?= date('Y-m-d') ?>';
    document.getElementById('bk_time_slot').value = b.time_slot || '10:00 AM';
    document.getElementById('bk_status').value = b.status || 'pending';
    document.getElementById('bk_notes').value = b.notes || '';

    var modal = new bootstrap.Modal(document.getElementById('bookingModal'));
    modal.show();
}
</script>

<?= $this->endSection() ?>
