<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Inquiries</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">All recorded contact messages</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">mark_email_unread</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">New Unread</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #d32f2f; font-family: 'Playfair Display', serif;"><?= esc($stats['new'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Requires concierge attention</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(211, 47, 47, 0.08); display: flex; align-items: center; justify-content: center; color: #d32f2f;">
                <span class="material-symbols-outlined">priority_high</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Under Review</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #f57c00; font-family: 'Playfair Display', serif;"><?= esc($stats['read'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Read by desk specialist</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 124, 0, 0.08); display: flex; align-items: center; justify-content: center; color: #f57c00;">
                <span class="material-symbols-outlined">drafts</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Resolved / Replied</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['replied'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Completed communications</small>
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
        <!-- Status Filter Pills -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="<?= base_url('admin/enquiry?status=all') ?>" class="badge-pill <?= ($currentStatus === 'all') ? 'active-pill' : 'inactive-pill' ?>">
                All Inquiries
            </a>
            <a href="<?= base_url('admin/enquiry?status=new') ?>" class="badge-pill <?= ($currentStatus === 'new') ? 'active-pill' : 'inactive-pill' ?>">
                New Unread (<?= esc($stats['new'] ?? 0) ?>)
            </a>
            <a href="<?= base_url('admin/enquiry?status=read') ?>" class="badge-pill <?= ($currentStatus === 'read') ? 'active-pill' : 'inactive-pill' ?>">
                Under Review
            </a>
            <a href="<?= base_url('admin/enquiry?status=replied') ?>" class="badge-pill <?= ($currentStatus === 'replied') ? 'active-pill' : 'inactive-pill' ?>">
                Replied
            </a>
        </div>

        <!-- Search Bar -->
        <form action="<?= base_url('admin/enquiry') ?>" method="GET" class="d-flex align-items-center">
            <input type="hidden" name="status" value="<?= esc($currentStatus) ?>">
            <div class="input-group input-group-sm" style="width: 260px;">
                <span class="input-group-text bg-white border-end-0 text-muted">
                    <span class="material-symbols-outlined" style="font-size: 16px;">search</span>
                </span>
                <input type="text" name="q" value="<?= esc($searchQuery ?? '') ?>" class="form-control border-start-0 ps-0" placeholder="Search patron, subject, text...">
            </div>
        </form>
    </div>
</div>

<!-- Enquiries Data Table -->
<div class="glass-panel p-0 mb-4" style="overflow: hidden;">
    <div class="table-responsive">
        <table class="table align-middle mb-0" style="font-size: 13px;">
            <thead style="background: #faf7f5; border-bottom: 1px solid var(--border-subtle); color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                <tr>
                    <th style="padding: 14px 18px; width: 60px;">#</th>
                    <th style="padding: 14px 18px;">Patron & Contact</th>
                    <th style="padding: 14px 18px;">Subject & Snippet</th>
                    <th style="padding: 14px 18px;">Received Date</th>
                    <th style="padding: 14px 18px; text-align: center;">Status</th>
                    <th style="padding: 14px 18px; text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($enquiries) && count($enquiries) > 0): ?>
                    <?php foreach ($enquiries as $idx => $item): ?>
                        <tr style="border-bottom: 1px solid rgba(89, 46, 131, 0.05); <?= ($item['status'] === 'new') ? 'background: rgba(89, 46, 131, 0.02);' : '' ?>">
                            <td style="padding: 14px 18px; color: var(--text-muted);"><?= $idx + 1 ?></td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-bold" style="color: var(--text-main); font-size: 13.5px;"><?= esc($item['name']) ?></div>
                                <div class="text-muted" style="font-size: 11.5px;">✉ <?= esc($item['email']) ?></div>
                                <?php if (!empty($item['phone'])): ?>
                                    <div class="text-muted" style="font-size: 11px;">📞 <?= esc($item['phone']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-bold" style="color: var(--text-main); font-size: 13px;">
                                    <?= esc($item['subject'] ?: 'General Concierge Inquiry') ?>
                                </div>
                                <div class="text-muted text-truncate" style="max-width: 320px; font-size: 12px;">
                                    <?= esc($item['message']) ?>
                                </div>
                                <?php if (!empty($item['admin_notes'])): ?>
                                    <div class="mt-1" style="font-size: 11px; color: #a36952;">
                                        <strong>Note:</strong> <?= esc($item['admin_notes']) ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div style="color: var(--text-main); font-size: 12.5px;">
                                    <?= date('M d, Y', strtotime($item['created_at'])) ?>
                                </div>
                                <div class="text-muted" style="font-size: 11px;">
                                    <?= date('h:i A', strtotime($item['created_at'])) ?>
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <?php 
                                    $statusBadges = [
                                        'new'     => 'bg-danger-subtle text-danger',
                                        'read'    => 'bg-warning-subtle text-warning',
                                        'replied' => 'bg-success-subtle text-success',
                                    ];
                                    $bClass = $statusBadges[$item['status']] ?? 'bg-secondary-subtle text-secondary';
                                ?>
                                <span class="badge <?= $bClass ?>" style="font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                                    <?= ucfirst($item['status']) ?>
                                </span>
                            </td>
                            <td style="padding: 14px 18px; text-align: right;">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <button type="button" class="btn btn-sm btn-icon-round" title="Read & Respond" onclick="viewEnquiry(<?= $item['id'] ?>)">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">visibility</span>
                                    </button>
                                    <a href="<?= base_url('admin/enquiry/convert/' . $item['id']) ?>" class="btn btn-sm btn-icon-round" title="Convert to CRM Lead" onclick="return confirm('Convert this inquiry into a CRM Lead pipeline record?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #592e83;">person_add</span>
                                    </a>
                                    <?php if (!empty($item['phone'])): ?>
                                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $item['phone']) ?>?text=Hello%20<?= urlencode($item['name']) ?>,%20thank%20you%20for%20contacting%20Glowup!" target="_blank" class="btn btn-sm btn-icon-round" title="Chat on WhatsApp">
                                            <span class="material-symbols-outlined" style="font-size: 16px; color: #25D366;">chat</span>
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('admin/enquiry/delete/' . $item['id']) ?>" class="btn btn-sm btn-icon-round" title="Delete Inquiry" onclick="return confirm('Remove this patron message?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d32f2f;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.4;">mark_email_read</span>
                            <div class="mt-2 fw-semibold text-muted">No customer inquiries found</div>
                            <small class="text-muted">Inquiries sent via the public contact form will appear here in real-time.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: View & Update Inquiry -->
<div class="modal fade" id="enquiryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0" style="box-shadow: 0 20px 48px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom pb-3" style="border-color: var(--border-subtle) !important;">
                <h5 class="modal-title fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                    Patron Concierge Inquiry
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="enquiryForm" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-body py-3">
                    <div class="p-3 mb-3 rounded" style="background: #faf7f5; border: 1px solid var(--border-subtle);">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0 fw-bold" id="modal_patron_name" style="color: var(--text-main);"></h6>
                            <span class="badge" id="modal_status_badge"></span>
                        </div>
                        <div class="text-muted small mb-1" id="modal_patron_email"></div>
                        <div class="text-muted small" id="modal_patron_phone"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Subject
                        </label>
                        <div class="fw-bold" id="modal_subject" style="color: var(--text-main); font-size: 14px;"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Patron Message
                        </label>
                        <div class="p-3 rounded" style="background: #ffffff; border: 1px solid var(--border-subtle); font-size: 13px; line-height: 1.6; max-height: 200px; overflow-y: auto;" id="modal_message"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Update Status
                        </label>
                        <select name="status" id="modal_status_select" class="form-select">
                            <option value="new">New / Unread</option>
                            <option value="read">Under Review</option>
                            <option value="replied">Replied / Closed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Internal Admin Notes
                        </label>
                        <textarea name="admin_notes" id="modal_admin_notes" rows="2" class="form-control" placeholder="Add resolution details or response timestamp..."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top pt-3" style="border-color: var(--border-subtle) !important;">
                    <a id="modal_mailto_btn" href="#" class="btn btn-outline-secondary btn-sm me-auto d-flex align-items-center gap-1">
                        <span class="material-symbols-outlined" style="font-size: 16px;">mail</span>
                        <span>Reply via Email</span>
                    </a>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Update Inquiry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.badge-pill {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    display: inline-block;
}
.active-pill {
    background: var(--accent);
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(89, 46, 131, 0.25);
}
.inactive-pill {
    background: #ffffff;
    color: var(--text-muted) !important;
    border: 1px solid var(--border-subtle);
}
.inactive-pill:hover {
    background: #fbf9f8;
    color: var(--text-main) !important;
    border-color: var(--accent);
}
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
function viewEnquiry(id) {
    fetch('<?= base_url('admin/enquiry/details') ?>/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(res => {
        if (!res.status) {
            alert(res.message || 'Error fetching inquiry');
            return;
        }
        const eq = res.enquiry;
        document.getElementById('enquiryForm').action = '<?= base_url('admin/enquiry/update-status') ?>/' + eq.id;
        document.getElementById('modal_patron_name').innerText = eq.name;
        document.getElementById('modal_patron_email').innerText = 'Email: ' + eq.email;
        document.getElementById('modal_patron_phone').innerText = 'Phone: ' + (eq.phone || 'N/A');
        document.getElementById('modal_subject').innerText = eq.subject || 'General Inquiry';
        document.getElementById('modal_message').innerText = eq.message;
        document.getElementById('modal_status_select').value = eq.status;
        document.getElementById('modal_admin_notes').value = eq.admin_notes || '';
        document.getElementById('modal_mailto_btn').href = 'mailto:' + encodeURIComponent(eq.email) + '?subject=' + encodeURIComponent('Re: ' + (eq.subject || 'Your Glowup Inquiry'));

        const badge = document.getElementById('modal_status_badge');
        badge.innerText = eq.status.toUpperCase();
        badge.className = 'badge ' + (eq.status === 'new' ? 'bg-danger-subtle text-danger' : (eq.status === 'read' ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success'));

        const modal = new bootstrap.Modal(document.getElementById('enquiryModal'));
        modal.show();
    })
    .catch(() => alert('Network error loading inquiry.'));
}
</script>

<?= $this->endSection() ?>
