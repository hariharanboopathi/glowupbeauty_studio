<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Events</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Masterclasses & workshop sessions</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">event</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Upcoming Masterclasses</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['upcoming'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Scheduled for future execution</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">upcoming</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Confirmed Attendees</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #c98860; font-family: 'Playfair Display', serif;"><?= esc($stats['enrolled'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Enrolled masterclass practitioners</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(201, 136, 96, 0.12); display: flex; align-items: center; justify-content: center; color: #c98860;">
                <span class="material-symbols-outlined">groups</span>
            </div>
        </div>
    </div>
</div>

<!-- Action Bar -->
<div class="glass-panel p-3 mb-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
        <span class="material-symbols-outlined" style="color: var(--accent);">calendar_month</span>
        <span class="fw-bold" style="color: var(--text-main); font-size: 14px;">Studio Masterclasses & Workshops Schedule</span>
    </div>
    <button type="button" class="btn btn-luxury-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#eventModal" onclick="resetEventModal()">
        <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
        <span>Schedule Event</span>
    </button>
</div>

<!-- Table Card -->
<div class="glass-panel p-0 mb-4" style="overflow: hidden;">
    <div class="table-responsive">
        <table class="table align-middle mb-0" style="font-size: 13px;">
            <thead style="background: #faf7f5; border-bottom: 1px solid var(--border-subtle); color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                <tr>
                    <th style="padding: 14px 18px; width: 60px;">#</th>
                    <th style="padding: 14px 18px;">Date & Timing</th>
                    <th style="padding: 14px 18px;">Masterclass & Location</th>
                    <th style="padding: 14px 18px;">Type & Fee</th>
                    <th style="padding: 14px 18px;">Capacity / Roster</th>
                    <th style="padding: 14px 18px; text-align: center;">Status</th>
                    <th style="padding: 14px 18px; text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($events) && count($events) > 0): ?>
                    <?php foreach ($events as $idx => $evt): ?>
                        <tr style="border-bottom: 1px solid rgba(89, 46, 131, 0.05);">
                            <td style="padding: 14px 18px; color: var(--text-muted);"><?= $idx + 1 ?></td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-bold" style="color: var(--text-main); font-size: 13px;">
                                    <?= date('M d, Y', strtotime($evt['event_date'])) ?>
                                </div>
                                <div class="text-muted" style="font-size: 11px;">⏱ <?= esc($evt['event_time']) ?></div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-bold" style="color: var(--text-main); font-size: 13.5px;"><?= esc($evt['title']) ?></div>
                                <div class="text-muted text-truncate" style="max-width: 280px; font-size: 11.5px;">📍 <?= esc($evt['location']) ?></div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <span class="badge" style="background: rgba(89, 46, 131, 0.08); color: var(--accent); font-size: 10.5px; padding: 3px 8px; border-radius: 6px;">
                                    <?= esc($evt['event_type']) ?>
                                </span>
                                <div class="fw-semibold mt-1" style="color: #a36952; font-size: 12.5px;">₹<?= number_format($evt['fee'], 2) ?></div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <?php 
                                    $pct = $evt['capacity'] > 0 ? min(100, round(($evt['enrolled_count'] / $evt['capacity']) * 100)) : 0;
                                ?>
                                <div class="d-flex align-items-center justify-content-between mb-1" style="font-size: 11px;">
                                    <span><strong><?= $evt['enrolled_count'] ?></strong> / <?= $evt['capacity'] ?> booked</span>
                                    <span class="text-muted"><?= $pct ?>%</span>
                                </div>
                                <div class="progress" style="height: 6px; border-radius: 999px; background: #eee;">
                                    <div class="progress-bar" style="width: <?= $pct ?>%; background: var(--accent); border-radius: 999px;"></div>
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <?php 
                                    $badgeClass = match($evt['status']) {
                                        'upcoming'  => 'bg-success-subtle text-success',
                                        'ongoing'   => 'bg-warning-subtle text-warning',
                                        'completed' => 'bg-secondary-subtle text-secondary',
                                        default     => 'bg-info-subtle text-info',
                                    };
                                ?>
                                <span class="badge <?= $badgeClass ?>" style="font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                                    <?= ucfirst($evt['status']) ?>
                                </span>
                            </td>
                            <td style="padding: 14px 18px; text-align: right;">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <button type="button" class="btn btn-sm btn-icon-round" title="Edit Event" onclick="editEvent(<?= htmlspecialchars(json_encode($evt), ENT_QUOTES, 'UTF-8') ?>)">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">edit</span>
                                    </button>
                                    <a href="<?= base_url('admin/business/events/delete/' . $evt['id']) ?>" class="btn btn-sm btn-icon-round" title="Delete Event" onclick="return confirm('Remove this masterclass event?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d32f2f;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.4;">event</span>
                            <div class="mt-2 fw-semibold text-muted">No scheduled studio events or masterclasses</div>
                            <small class="text-muted">Click "Schedule Event" to organize your first beauty masterclass.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0" style="box-shadow: 0 20px 48px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom pb-3" style="border-color: var(--border-subtle) !important;">
                <h5 class="modal-title fw-bold" id="eventModalTitle" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                    Schedule Studio Masterclass
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/business/events/save') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="event_id" value="">

                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Masterclass Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="event_title" class="form-control" required placeholder="e.g. Haute Royal Airbrush Masterclass with Maya Sundaram">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Event Type
                            </label>
                            <select name="event_type" id="event_type" class="form-select">
                                <option value="Masterclass">Masterclass</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Pop-up">Pop-up Exhibition</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Status
                            </label>
                            <select name="status" id="event_status" class="form-select">
                                <option value="upcoming">Upcoming</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Event Date <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="event_date" id="event_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Timing
                            </label>
                            <input type="text" name="event_time" id="event_time" class="form-control" placeholder="10:00 AM - 05:00 PM">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Location / Venue
                        </label>
                        <input type="text" name="location" id="event_location" class="form-control" placeholder="Glowup Academy Sanctum, Madurai">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Fee (₹) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" name="fee" id="event_fee" class="form-control" required placeholder="5000">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Max Capacity
                            </label>
                            <input type="number" name="capacity" id="event_capacity" class="form-control" value="25">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Enrolled
                            </label>
                            <input type="number" name="enrolled_count" id="event_enrolled" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Syllabus / Event Description
                        </label>
                        <textarea name="description" id="event_description" rows="3" class="form-control" placeholder="Key takeaways, certifications, hands-on practice details..."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top pt-3" style="border-color: var(--border-subtle) !important;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Save Masterclass</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.btn-icon-round {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    border: 1px solid var(--border-subtle);
    transition: all 0.15s ease;
}
.btn-icon-round:hover {
    background: #faf7f5;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
}
</style>

<script>
function resetEventModal() {
    document.getElementById('eventModalTitle').innerText = 'Schedule Studio Masterclass';
    document.getElementById('event_id').value = '';
    document.getElementById('event_title').value = '';
    document.getElementById('event_type').value = 'Masterclass';
    document.getElementById('event_status').value = 'upcoming';
    document.getElementById('event_date').value = '<?= date('Y-m-d', strtotime('+14 days')) ?>';
    document.getElementById('event_time').value = '10:00 AM - 05:00 PM';
    document.getElementById('event_location').value = 'Glowup Academy Sanctum, Madurai';
    document.getElementById('event_fee').value = '5000';
    document.getElementById('event_capacity').value = '25';
    document.getElementById('event_enrolled').value = '0';
    document.getElementById('event_description').value = '';
}

function editEvent(evt) {
    document.getElementById('eventModalTitle').innerText = 'Edit Masterclass Schedule';
    document.getElementById('event_id').value = evt.id;
    document.getElementById('event_title').value = evt.title;
    document.getElementById('event_type').value = evt.event_type;
    document.getElementById('event_status').value = evt.status;
    document.getElementById('event_date').value = evt.event_date;
    document.getElementById('event_time').value = evt.event_time;
    document.getElementById('event_location').value = evt.location;
    document.getElementById('event_fee').value = evt.fee;
    document.getElementById('event_capacity').value = evt.capacity;
    document.getElementById('event_enrolled').value = evt.enrolled_count;
    document.getElementById('event_description').value = evt.description || '';

    const modal = new bootstrap.Modal(document.getElementById('eventModal'));
    modal.show();
}
</script>

<?= $this->endSection() ?>
