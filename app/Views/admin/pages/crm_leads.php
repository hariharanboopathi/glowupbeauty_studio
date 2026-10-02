<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Quick KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Inbound Leads</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Prospects across all acquisition channels</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">filter_alt</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">New Uncontacted</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #d32f2f; font-family: 'Playfair Display', serif;"><?= esc($stats['new'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Awaiting staff outreach</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(211, 47, 47, 0.08); display: flex; align-items: center; justify-content: center; color: #d32f2f;">
                <span class="material-symbols-outlined">mark_email_unread</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Converted Patrons</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['converted'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Successfully onboarded to salon</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">how_to_reg</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Pipeline Win Rate</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #c98860; font-family: 'Playfair Display', serif;"><?= esc($conversionRate) ?>%</h3>
                <small class="text-muted" style="font-size: 11px;">Lead-to-patron conversion ratio</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(201, 136, 96, 0.12); display: flex; align-items: center; justify-content: center; color: #c98860;">
                <span class="material-symbols-outlined">trending_up</span>
            </div>
        </div>
    </div>
</div>

<!-- Controls & Pipeline Stage Strip -->
<div class="glass-panel p-3 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Stage Filter Pills -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="<?= base_url('admin/crm/leads?status=all') ?>" class="badge-pill <?= ($currentStatus === 'all') ? 'active-pill' : 'inactive-pill' ?>">
                All Prospects
            </a>
            <a href="<?= base_url('admin/crm/leads?status=new') ?>" class="badge-pill <?= ($currentStatus === 'new') ? 'active-pill' : 'inactive-pill' ?>">
                New (<?= esc($stats['new'] ?? 0) ?>)
            </a>
            <a href="<?= base_url('admin/crm/leads?status=contacted') ?>" class="badge-pill <?= ($currentStatus === 'contacted') ? 'active-pill' : 'inactive-pill' ?>">
                Contacted
            </a>
            <a href="<?= base_url('admin/crm/leads?status=follow_up') ?>" class="badge-pill <?= ($currentStatus === 'follow_up') ? 'active-pill' : 'inactive-pill' ?>">
                Follow-up
            </a>
            <a href="<?= base_url('admin/crm/leads?status=interested') ?>" class="badge-pill <?= ($currentStatus === 'interested') ? 'active-pill' : 'inactive-pill' ?>">
                Hot / Interested
            </a>
            <a href="<?= base_url('admin/crm/leads?status=converted') ?>" class="badge-pill <?= ($currentStatus === 'converted') ? 'active-pill' : 'inactive-pill' ?>">
                Converted Patrons
            </a>
            <a href="<?= base_url('admin/crm/followups') ?>" class="badge-pill inactive-pill d-flex align-items-center gap-1" style="border-style: dashed; color: #a36952 !important;">
                <span class="material-symbols-outlined" style="font-size: 14px;">alarm</span>
                <span>Scheduled Follow-ups</span>
            </a>
        </div>

        <!-- Search Bar and Add Button -->
        <div class="d-flex align-items-center gap-2">
            <form action="<?= base_url('admin/crm/leads') ?>" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="status" value="<?= esc($currentStatus) ?>">
                <div class="input-group input-group-sm" style="width: 220px;">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <span class="material-symbols-outlined" style="font-size: 16px;">search</span>
                    </span>
                    <input type="text" name="q" value="<?= esc($searchQuery ?? '') ?>" class="form-control border-start-0 ps-0" placeholder="Search prospects...">
                </div>
            </form>
            <button type="button" class="btn btn-luxury-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#leadModal" onclick="resetLeadModal()">
                <span class="material-symbols-outlined" style="font-size: 18px;">person_add</span>
                <span>Add Lead</span>
            </button>
        </div>
    </div>
</div>

<!-- Leads Data Table -->
<div class="glass-panel p-0 mb-4" style="overflow: hidden;">
    <div class="table-responsive">
        <table class="table align-middle mb-0" style="font-size: 13px;">
            <thead style="background: #faf7f5; border-bottom: 1px solid var(--border-subtle); color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                <tr>
                    <th style="padding: 14px 18px; width: 60px;">#</th>
                    <th style="padding: 14px 18px;">Prospect & Contact</th>
                    <th style="padding: 14px 18px;">Service Interested</th>
                    <th style="padding: 14px 18px;">Source & Campaign</th>
                    <th style="padding: 14px 18px;">Staff Assigned</th>
                    <th style="padding: 14px 18px;">Pipeline Stage</th>
                    <th style="padding: 14px 18px; text-align: right; width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($leads) && count($leads) > 0): ?>
                    <?php foreach ($leads as $idx => $lead): ?>
                        <?php 
                            $cleanPhone = preg_replace('/[^0-9]/', '', $lead['whatsapp'] ?: $lead['phone']);
                        ?>
                        <tr style="border-bottom: 1px solid rgba(89, 46, 131, 0.05); <?= ($lead['status'] === 'new') ? 'background: rgba(211, 47, 47, 0.02);' : '' ?>">
                            <td style="padding: 14px 18px; color: var(--text-muted);"><?= $idx + 1 ?></td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-bold" style="color: var(--text-main); font-size: 13.5px;"><?= esc($lead['name']) ?></div>
                                <div class="d-flex align-items-center gap-2 mt-1" style="font-size: 11.5px;">
                                    <a href="tel:<?= esc($lead['phone']) ?>" class="text-decoration-none text-muted d-flex align-items-center gap-1">
                                        <span class="material-symbols-outlined" style="font-size: 14px; color: var(--accent);">call</span>
                                        <span><?= esc($lead['phone']) ?></span>
                                    </a>
                                    <?php if (!empty($lead['whatsapp'])): ?>
                                        <a href="https://wa.me/<?= $cleanPhone ?>" target="_blank" class="text-decoration-none" style="color: #25D366; font-weight: 600;" title="WhatsApp Direct Chat">
                                            <span>WhatsApp</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($lead['email'])): ?>
                                    <div class="text-muted" style="font-size: 11px; margin-top: 2px;">✉ <?= esc($lead['email']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-semibold" style="color: var(--text-main); font-size: 13px;">
                                    <?= esc($lead['service_interested'] ?: 'General Inquiry') ?>
                                </div>
                                <?php if (!empty($lead['notes'])): ?>
                                    <div class="text-muted text-truncate" style="max-width: 240px; font-size: 11.5px;">
                                        <?= esc($lead['notes']) ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 14px 18px;">
                                <span class="badge" style="background: rgba(89, 46, 131, 0.08); color: var(--accent); font-size: 11px; padding: 4px 8px; border-radius: 6px;">
                                    <?= esc($lead['source']) ?>
                                </span>
                                <?php if (!empty($lead['campaign'])): ?>
                                    <div class="text-muted mt-1" style="font-size: 11px;">📢 <?= esc($lead['campaign']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-semibold" style="color: var(--text-main); font-size: 12px;">👤 <?= esc($lead['assigned_staff']) ?></div>
                                <div class="text-muted" style="font-size: 10.5px;"><?= date('M d, Y', strtotime($lead['created_at'])) ?></div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <form action="<?= base_url('admin/crm/leads/update-status/' . $lead['id']) ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <select name="status" class="form-select form-select-sm" style="font-size: 11.5px; width: 140px; font-weight: 600;" onchange="this.form.submit()">
                                        <option value="new" <?= $lead['status'] === 'new' ? 'selected' : '' ?>>🔴 New</option>
                                        <option value="contacted" <?= $lead['status'] === 'contacted' ? 'selected' : '' ?>>🟡 Contacted</option>
                                        <option value="follow_up" <?= $lead['status'] === 'follow_up' ? 'selected' : '' ?>>🟠 Follow-Up</option>
                                        <option value="interested" <?= $lead['status'] === 'interested' ? 'selected' : '' ?>>🟢 Interested</option>
                                        <option value="booking_confirmed" <?= $lead['status'] === 'booking_confirmed' ? 'selected' : '' ?>>🔵 Booked</option>
                                        <option value="converted" <?= $lead['status'] === 'converted' ? 'selected' : '' ?>>⭐ Converted</option>
                                        <option value="lost" <?= $lead['status'] === 'lost' ? 'selected' : '' ?>>⚪ Lost</option>
                                    </select>
                                </form>
                            </td>
                            <td style="padding: 14px 18px; text-align: right;">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <?php if ($lead['status'] !== 'converted'): ?>
                                        <a href="<?= base_url('admin/crm/leads/convert/' . $lead['id']) ?>" class="btn btn-sm btn-outline-success" title="Convert to Customer Patron" onclick="return confirm('Promote this lead to an active Customer record?');" style="font-size: 11px;">
                                            Convert
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('admin/customers/' . ($lead['customer_id'] ?: '1')) ?>" class="btn btn-sm btn-outline-primary" style="font-size: 11px;" title="View Converted Patron Profile">
                                            Patron CRM &rarr;
                                        </a>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-sm btn-icon-round" title="Edit Lead" onclick="editLead(<?= htmlspecialchars(json_encode($lead), ENT_QUOTES, 'UTF-8') ?>)">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">edit</span>
                                    </button>
                                    <a href="<?= base_url('admin/crm/leads/delete/' . $lead['id']) ?>" class="btn btn-sm btn-icon-round" title="Delete Lead" onclick="return confirm('Remove this prospect from pipeline?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d32f2f;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.4;">filter_alt_off</span>
                            <div class="mt-2 fw-semibold text-muted">No prospects found in this stage</div>
                            <small class="text-muted">Click "Add Lead" to register an inbound phone inquiry or walk-in prospect.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Add / Edit Lead -->
<div class="modal fade" id="leadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0" style="box-shadow: 0 20px 48px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom pb-3" style="border-color: var(--border-subtle) !important;">
                <h5 class="modal-title fw-bold" id="leadModalTitle" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                    Add Inbound Prospect
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/crm/leads/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="lead_id" value="">

                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Prospect Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="lead_name" class="form-control" required placeholder="e.g. Pooja Sundaram">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Telephone / Mobile <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="phone" id="lead_phone" class="form-control" required placeholder="+91 98401 23456">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                WhatsApp Number
                            </label>
                            <input type="text" name="whatsapp" id="lead_whatsapp" class="form-control" placeholder="+91 98401 23456">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Email Address
                        </label>
                        <input type="email" name="email" id="lead_email" class="form-control" placeholder="pooja@gmail.com">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Service / Treatment Interested
                            </label>
                            <input type="text" name="service_interested" id="lead_service" class="form-control" placeholder="e.g. Royal Heritage Temple Bride">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Acquisition Source
                            </label>
                            <select name="source" id="lead_source" class="form-select">
                                <option value="Instagram Campaign">Instagram Campaign</option>
                                <option value="Facebook Ads">Facebook Ads</option>
                                <option value="WhatsApp Direct">WhatsApp Direct</option>
                                <option value="Website Contact">Website Contact Form</option>
                                <option value="Academy Enquiry">Academy Form</option>
                                <option value="Bridal Walk-in">Bridal Walk-in</option>
                                <option value="Client Referral">Client Referral</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Campaign Reference
                            </label>
                            <input type="text" name="campaign" id="lead_campaign" class="form-control" placeholder="e.g. Diwali Bridal 2026">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Assigned Staff
                            </label>
                            <input type="text" name="assigned_staff" id="lead_staff" class="form-control" value="Priya Varma">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Consultation Notes & Inquiries
                        </label>
                        <textarea name="notes" id="lead_notes" rows="2" class="form-control" placeholder="Wedding date, family budget, skin concerns..."></textarea>
                    </div>

                    <div class="p-3 rounded mb-2" style="background: #faf7f5; border: 1px dashed var(--border-subtle);">
                        <label class="form-label fw-semibold mb-2" style="font-size: 11.5px; text-transform: uppercase; color: var(--accent);">Schedule Immediate Follow-up</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="date" name="schedule_followup_date" class="form-control form-control-sm" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            </div>
                            <div class="col-6">
                                <input type="text" name="schedule_followup_time" class="form-control form-control-sm" value="11:00 AM">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top pt-3" style="border-color: var(--border-subtle) !important;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Save Prospect</button>
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
function resetLeadModal() {
    document.getElementById('leadModalTitle').innerText = 'Add Inbound Prospect';
    document.getElementById('lead_id').value = '';
    document.getElementById('lead_name').value = '';
    document.getElementById('lead_phone').value = '';
    document.getElementById('lead_whatsapp').value = '';
    document.getElementById('lead_email').value = '';
    document.getElementById('lead_service').value = '';
    document.getElementById('lead_campaign').value = '';
    document.getElementById('lead_notes').value = '';
    document.getElementById('lead_staff').value = 'Priya Varma';
}

function editLead(lead) {
    document.getElementById('leadModalTitle').innerText = 'Edit Prospect Pipeline Record';
    document.getElementById('lead_id').value = lead.id;
    document.getElementById('lead_name').value = lead.name;
    document.getElementById('lead_phone').value = lead.phone;
    document.getElementById('lead_whatsapp').value = lead.whatsapp || lead.phone;
    document.getElementById('lead_email').value = lead.email || '';
    document.getElementById('lead_service').value = lead.service_interested || '';
    document.getElementById('lead_source').value = lead.source;
    document.getElementById('lead_campaign').value = lead.campaign || '';
    document.getElementById('lead_staff').value = lead.assigned_staff || 'Priya Varma';
    document.getElementById('lead_notes').value = lead.notes || '';

    const modal = new bootstrap.Modal(document.getElementById('leadModal'));
    modal.show();
}
</script>

<?= $this->endSection() ?>
