<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Follow-ups</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Scheduled client touchpoints</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">alarm</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Due Today</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--color-secondary); font-family: 'Playfair Display', serif;"><?= esc($stats['today'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Priority contacts for today</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--color-secondary-subtle); display: flex; align-items: center; justify-content: center; color: var(--color-secondary);">
                <span class="material-symbols-outlined">notification_important</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Pending Reminders</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--color-primary); font-family: 'Playfair Display', serif;"><?= esc($stats['pending'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Awaiting staff outreach</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--color-primary-subtle); display: flex; align-items: center; justify-content: center; color: var(--color-primary);">
                <span class="material-symbols-outlined">pending_actions</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Completed</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['completed'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Successfully executed touchpoints</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">task_alt</span>
            </div>
        </div>
    </div>
</div>

<!-- Controls & Filter Strip -->
<div class="glass-panel p-3 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Filter Tabs -->
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= base_url('admin/crm/followups') ?>" 
               class="btn btn-sm <?= ($currentFilter === 'all') ? 'btn-primary' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">
                All Follow-ups (<?= esc($stats['total'] ?? 0) ?>)
            </a>
            <a href="<?= base_url('admin/crm/followups?filter=today') ?>" 
               class="btn btn-sm <?= ($currentFilter === 'today') ? 'btn-warning text-dark' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">
                <span class="material-symbols-outlined align-middle" style="font-size: 14px;">today</span>
                Due Today (<?= esc($stats['today'] ?? 0) ?>)
            </a>
            <a href="<?= base_url('admin/crm/followups?filter=upcoming') ?>" 
               class="btn btn-sm <?= ($currentFilter === 'upcoming') ? 'btn-info text-white' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">
                Upcoming (<?= esc($stats['pending'] ?? 0) ?>)
            </a>
            <a href="<?= base_url('admin/crm/followups?filter=completed') ?>" 
               class="btn btn-sm <?= ($currentFilter === 'completed') ? 'btn-success' : 'btn-outline-secondary' ?>" 
               style="border-radius: 20px; font-size: 12px;">
                Completed (<?= esc($stats['completed'] ?? 0) ?>)
            </a>
        </div>

        <!-- Action & Search -->
        <div class="d-flex align-items-center gap-2">
            <div class="position-relative">
                <input type="text" id="followUpSearchInput" class="form-control form-control-sm ps-4" 
                       placeholder="Search name, phone, notes..." style="width: 220px; border-radius: 8px;">
                <span class="material-symbols-outlined position-absolute" 
                      style="left: 8px; top: 50%; transform: translateY(-50%); font-size: 16px; color: #888;">search</span>
            </div>
            <button type="button" class="btn btn-sm btn-primary d-flex align-items-center gap-1" 
                    data-bs-toggle="modal" data-bs-target="#followUpModal" onclick="prepareAddFollowUp()"
                    style="background: var(--accent); border-color: var(--accent); border-radius: 8px;">
                <span class="material-symbols-outlined" style="font-size: 16px;">alarm_add</span>
                Schedule Follow-up
            </button>
        </div>
    </div>
</div>

<!-- Follow-ups Table -->
<div class="glass-panel p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="followUpsTable">
            <thead style="background: rgba(89, 46, 131, 0.04); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                <tr>
                    <th class="ps-4 py-3" style="width: 60px;">#</th>
                    <th class="py-3">Contact Details</th>
                    <th class="py-3">Interest / Service</th>
                    <th class="py-3">Scheduled Date & Time</th>
                    <th class="py-3">Notes & Reminders</th>
                    <th class="py-3">Status</th>
                    <th class="text-end pe-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody style="font-size: 13px;">
                <?php if (!empty($followUps)): ?>
                    <?php 
                    $todayDate = date('Y-m-d');
                    foreach ($followUps as $idx => $fu): 
                        $isToday = ($fu['follow_up_date'] === $todayDate);
                        $isOverdue = ($fu['follow_up_date'] < $todayDate && $fu['status'] === 'pending');
                    ?>
                        <tr class="follow-up-row <?= $isToday ? 'table-warning bg-opacity-10' : '' ?>">
                            <td class="ps-4 fw-medium text-muted"><?= $idx + 1 ?></td>
                            <td>
                                <div class="fw-bold" style="color: var(--text-main);"><?= esc($fu['contact_name']) ?></div>
                                <?php if (!empty($fu['contact_phone'])): ?>
                                    <div class="d-flex align-items-center gap-1 text-muted" style="font-size: 12px;">
                                        <span class="material-symbols-outlined" style="font-size: 14px;">call</span>
                                        <?= esc($fu['contact_phone']) ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($fu['service_interested'])): ?>
                                    <span class="badge" style="background: rgba(89, 46, 131, 0.1); color: var(--accent); font-weight: 600; border-radius: 6px;">
                                        <?= esc($fu['service_interested']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted" style="font-size: 12px;">General Consultation</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined text-muted" style="font-size: 16px;">calendar_today</span>
                                    <div>
                                        <strong><?= date('d M Y', strtotime($fu['follow_up_date'])) ?></strong>
                                        <span class="text-muted ms-1" style="font-size: 11px;">at <?= esc($fu['follow_up_time'] ?: '10:00 AM') ?></span>
                                    </div>
                                </div>
                                <?php if ($isToday && $fu['status'] === 'pending'): ?>
                                    <span class="badge bg-danger mt-1" style="font-size: 10px; font-weight: 600;">DUE TODAY</span>
                                <?php elseif ($isOverdue): ?>
                                    <span class="badge bg-dark mt-1" style="font-size: 10px; font-weight: 600;">OVERDUE</span>
                                <?php endif; ?>
                            </td>
                            <td style="max-width: 280px;">
                                <?php if (!empty($fu['notes'])): ?>
                                    <div class="text-truncate text-muted" title="<?= esc($fu['notes']) ?>" style="font-size: 12px;">
                                        <span class="material-symbols-outlined align-middle me-1" style="font-size: 14px; color: #888;">notes</span>
                                        <?= esc($fu['notes']) ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted fst-italic" style="font-size: 11px;">No reminders recorded</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($fu['status'] === 'completed'): ?>
                                    <span class="badge" style="background: rgba(46, 125, 50, 0.12); color: #2e7d32; font-weight: 600; border-radius: 12px; padding: 4px 10px;">
                                        <span class="material-symbols-outlined align-middle me-1" style="font-size: 12px;">check</span>
                                        Completed
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background: var(--color-secondary-subtle); color: var(--color-secondary); font-weight: 600; border-radius: 12px; padding: 4px 10px;">
                                        <span class="material-symbols-outlined align-middle me-1" style="font-size: 12px;">schedule</span>
                                        Pending
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <!-- WhatsApp Action -->
                                    <?php if (!empty($fu['contact_phone'])): 
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $fu['contact_phone']);
                                        if (strlen($cleanPhone) === 10) $cleanPhone = '91' . $cleanPhone;
                                        $waText = urlencode("Hello " . $fu['contact_name'] . ", this is Glowup Beauty Studio following up regarding your interest in " . ($fu['service_interested'] ?: 'our salon services') . ". How can we assist you today?");
                                    ?>
                                        <a href="https://wa.me/<?= $cleanPhone ?>?text=<?= $waText ?>" target="_blank" 
                                           class="btn btn-sm btn-outline-success p-1 d-inline-flex align-items-center justify-content-center" 
                                           title="Direct WhatsApp" style="width: 30px; height: 30px; border-radius: 6px;">
                                            <?= glowup_whatsapp_icon('', 15) ?>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Complete Action -->
                                    <?php if ($fu['status'] === 'pending'): ?>
                                        <a href="<?= base_url('admin/crm/followups/complete/' . $fu['id']) ?>" 
                                           class="btn btn-sm btn-outline-success p-1 d-inline-flex align-items-center justify-content-center" 
                                           title="Mark as Completed" style="width: 30px; height: 30px; border-radius: 6px;">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">done_all</span>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Edit Action -->
                                    <button type="button" class="btn btn-sm btn-outline-primary p-1 d-inline-flex align-items-center justify-content-center" 
                                            title="Edit Reminder" style="width: 30px; height: 30px; border-radius: 6px;"
                                            onclick='editFollowUp(<?= json_encode($fu, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                        <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                    </button>

                                    <!-- Delete Action -->
                                    <a href="<?= base_url('admin/crm/followups/delete/' . $fu['id']) ?>" 
                                       class="btn btn-sm btn-outline-danger p-1 d-inline-flex align-items-center justify-content-center" 
                                       title="Remove" style="width: 30px; height: 30px; border-radius: 6px;"
                                       onclick="return confirm('Delete this follow-up appointment?')">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="py-4">
                                <span class="material-symbols-outlined text-muted mb-2" style="font-size: 48px; opacity: 0.4;">alarm_off</span>
                                <h6 class="text-muted fw-bold">No Follow-ups Found</h6>
                                <p class="text-muted mb-3" style="font-size: 12px;">There are no follow-ups matching this view filter.</p>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#followUpModal" onclick="prepareAddFollowUp()">
                                    Schedule First Follow-up
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Follow-up Modal -->
<div class="modal fade" id="followUpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--accent); padding: 18px 24px;">
                <h6 class="modal-title fw-bold" id="followUpModalTitle">Schedule Client Follow-up</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/crm/followups/save') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="fu_id" value="0">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Contact Name *</label>
                        <input type="text" name="contact_name" id="fu_contact_name" class="form-control" required placeholder="e.g. Priya Sharma">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Phone / WhatsApp</label>
                            <input type="text" name="contact_phone" id="fu_contact_phone" class="form-control" placeholder="+91 98765 43210">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Service Interested In</label>
                            <input type="text" name="service_interested" id="fu_service_interested" class="form-control" placeholder="e.g. Bridal Package, Hair Spa">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Follow-up Date *</label>
                            <input type="date" name="follow_up_date" id="fu_follow_up_date" class="form-control" required value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Time Slot</label>
                            <input type="text" name="follow_up_time" id="fu_follow_up_time" class="form-control" placeholder="10:30 AM" value="11:00 AM">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Notes / Action Required</label>
                        <textarea name="notes" id="fu_notes" class="form-control" rows="3" placeholder="e.g. Call regarding Diwali Bridal Offer, share portfolio on WhatsApp"></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-bold" style="font-size: 12px;">Status</label>
                        <select name="status" id="fu_status" class="form-select">
                            <option value="pending">Pending Reminder</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save Follow-up</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function prepareAddFollowUp() {
    document.getElementById('followUpModalTitle').textContent = 'Schedule Client Follow-up';
    document.getElementById('fu_id').value = '0';
    document.getElementById('fu_contact_name').value = '';
    document.getElementById('fu_contact_phone').value = '';
    document.getElementById('fu_service_interested').value = '';
    document.getElementById('fu_follow_up_date').value = '<?= date('Y-m-d') ?>';
    document.getElementById('fu_follow_up_time').value = '11:00 AM';
    document.getElementById('fu_notes').value = '';
    document.getElementById('fu_status').value = 'pending';
}

function editFollowUp(item) {
    document.getElementById('followUpModalTitle').textContent = 'Edit Follow-up Reminder';
    document.getElementById('fu_id').value = item.id || 0;
    document.getElementById('fu_contact_name').value = item.contact_name || '';
    document.getElementById('fu_contact_phone').value = item.contact_phone || '';
    document.getElementById('fu_service_interested').value = item.service_interested || '';
    document.getElementById('fu_follow_up_date').value = item.follow_up_date || '<?= date('Y-m-d') ?>';
    document.getElementById('fu_follow_up_time').value = item.follow_up_time || '11:00 AM';
    document.getElementById('fu_notes').value = item.notes || '';
    document.getElementById('fu_status').value = item.status || 'pending';
    
    var modal = new bootstrap.Modal(document.getElementById('followUpModal'));
    modal.show();
}

// Client search filter
document.getElementById('followUpSearchInput')?.addEventListener('keyup', function() {
    var filter = this.value.toLowerCase();
    var rows = document.querySelectorAll('#followUpsTable tbody tr.follow-up-row');
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.indexOf(filter) > -1 ? '' : 'none';
    });
});
</script>

<?= $this->endSection() ?>
