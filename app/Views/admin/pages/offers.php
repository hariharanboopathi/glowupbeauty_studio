<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Offers</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Created promotional campaigns</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">local_offer</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Active Now</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['active_now'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Currently valid & redeemable</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">verified</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Live on Website</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #0288d1; font-family: 'Playfair Display', serif;"><?= esc($stats['frontend'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Featured across frontend pages</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(2, 136, 209, 0.08); display: flex; align-items: center; justify-content: center; color: #0288d1;">
                <span class="material-symbols-outlined">web</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Expired Offers</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #6c757d; font-family: 'Playfair Display', serif;"><?= esc($stats['expired'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Past validity period</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(108, 117, 125, 0.08); display: flex; align-items: center; justify-content: center; color: #6c757d;">
                <span class="material-symbols-outlined">history</span>
            </div>
        </div>
    </div>
</div>

<!-- Controls Strip -->
<div class="glass-panel p-3 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h6 class="fw-bold mb-0" style="color: var(--text-main);">Promotional Privilege Catalog</h6>
            <small class="text-muted">Special seasonal offers, package privileges, and customer coupon codes.</small>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-sm btn-primary d-flex align-items-center gap-1" 
                    data-bs-toggle="modal" data-bs-target="#offerModal" onclick="prepareAddOffer()"
                    style="background: var(--accent); border-color: var(--accent); border-radius: 8px;">
                <span class="material-symbols-outlined" style="font-size: 16px;">add_circle</span>
                Create New Offer
            </button>
        </div>
    </div>
</div>

<!-- Offers Table -->
<div class="glass-panel p-0 overflow-hidden mb-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background: rgba(89, 46, 131, 0.04); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                <tr>
                    <th class="ps-4 py-3">Offer Title & Details</th>
                    <th class="py-3">Coupon Code</th>
                    <th class="py-3">Benefit</th>
                    <th class="py-3">Target Service / Audience</th>
                    <th class="py-3">Validity Dates</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Frontend</th>
                    <th class="text-end pe-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody style="font-size: 13px;">
                <?php if (!empty($offers)): ?>
                    <?php 
                    $todayDate = date('Y-m-d');
                    foreach ($offers as $off): 
                        $isActive = ($off['is_active'] == 1 && $off['start_date'] <= $todayDate && $off['end_date'] >= $todayDate);
                        $isExpired = ($off['end_date'] < $todayDate);
                    ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold" style="color: var(--text-main);"><?= esc($off['title']) ?></div>
                                <small class="text-muted"><?= esc($off['name']) ?></small>
                                <?php if (!empty($off['description'])): ?>
                                    <div class="text-muted text-truncate" style="max-width: 250px; font-size: 11px;"><?= esc($off['description']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge font-monospace" style="background: rgba(89, 46, 131, 0.1); color: var(--accent); font-size: 12px; letter-spacing: 0.05em; padding: 4px 8px; border-radius: 6px;">
                                    <?= esc($off['coupon_code']) ?>
                                </span>
                            </td>
                            <td>
                                <strong class="text-success" style="font-size: 13px;">
                                    <?php if ($off['discount_type'] === 'percentage'): ?>
                                        <?= esc($off['discount_value']) ?>% OFF
                                    <?php else: ?>
                                        ₹<?= number_format((float) $off['discount_value'], 2) ?> OFF
                                    <?php endif; ?>
                                </strong>
                            </td>
                            <td>
                                <div><span class="badge bg-light text-dark border"><?= esc($off['target_service'] ?: 'All Treatments') ?></span></div>
                                <small class="text-muted" style="font-size: 10.5px;">Segment: <?= ucfirst(esc($off['target_segment'] ?: 'all')) ?></small>
                            </td>
                            <td>
                                <div style="font-size: 12px;">
                                    <span><?= date('d M Y', strtotime($off['start_date'])) ?></span>
                                    <span class="text-muted mx-1">to</span>
                                    <span><?= date('d M Y', strtotime($off['end_date'])) ?></span>
                                </div>
                            </td>
                            <td>
                                <?php if ($isActive): ?>
                                    <span class="badge bg-success" style="border-radius: 10px;">Active Now</span>
                                <?php elseif ($isExpired): ?>
                                    <span class="badge bg-secondary" style="border-radius: 10px;">Expired</span>
                                <?php elseif (!$off['is_active']): ?>
                                    <span class="badge bg-dark" style="border-radius: 10px;">Disabled</span>
                                <?php else: ?>
                                    <span class="badge bg-info" style="border-radius: 10px;">Upcoming</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($off['featured_on_frontend']) && $isActive): ?>
                                    <span class="badge bg-primary bg-opacity-10 text-primary" style="font-size: 10px;">Displayed</span>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted" style="font-size: 10px;">Hidden</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <!-- Edit -->
                                    <button type="button" class="btn btn-sm btn-outline-primary p-1 d-inline-flex align-items-center justify-content-center" 
                                            title="Edit Offer" style="width: 28px; height: 28px; border-radius: 6px;"
                                            onclick='editOffer(<?= json_encode($off, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                        <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                    </button>

                                    <!-- Toggle Status -->
                                    <a href="<?= base_url('admin/marketing/offers/toggle/' . $off['id']) ?>" 
                                       class="btn btn-sm btn-outline-secondary p-1 d-inline-flex align-items-center justify-content-center" 
                                       title="Toggle Status" style="width: 28px; height: 28px; border-radius: 6px;">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">toggle_on</span>
                                    </a>

                                    <!-- Delete -->
                                    <a href="<?= base_url('admin/marketing/offers/delete/' . $off['id']) ?>" 
                                       class="btn btn-sm btn-outline-danger p-1 d-inline-flex align-items-center justify-content-center" 
                                       title="Delete" style="width: 28px; height: 28px; border-radius: 6px;"
                                       onclick="return confirm('Permanently delete this offer?')">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="py-4">
                                <span class="material-symbols-outlined text-muted mb-2" style="font-size: 48px; opacity: 0.4;">local_offer</span>
                                <h6 class="text-muted fw-bold">No Promotional Offers Configured</h6>
                                <p class="text-muted mb-3" style="font-size: 12px;">Create seasonal deals and wedding privilege codes to delight your patrons.</p>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#offerModal" onclick="prepareAddOffer()">
                                    Create First Offer
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Offer Modal -->
<div class="modal fade" id="offerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--accent); padding: 18px 24px;">
                <h6 class="modal-title fw-bold" id="offerModalTitle">Create Promotional Offer</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/marketing/offers/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="off_id" value="0">
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Offer Internal Campaign Name *</label>
                            <input type="text" name="name" id="off_name" class="form-control" required placeholder="e.g. Diwali Bridal Privilege 2026">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Public Display Title *</label>
                            <input type="text" name="title" id="off_title" class="form-control" required placeholder="e.g. Bridal Glow Package – 20% OFF">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Privilege Description</label>
                        <textarea name="description" id="off_description" class="form-control" rows="2" placeholder="e.g. Complete pre-bridal aesthetic package with 24K gold facial and complimentary trial."></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Discount Type *</label>
                            <select name="discount_type" id="off_discount_type" class="form-select">
                                <option value="percentage">Percentage Discount (%)</option>
                                <option value="fixed">Flat Amount Discount (₹)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Discount Value *</label>
                            <input type="number" step="0.01" name="discount_value" id="off_discount_value" class="form-control" required placeholder="20">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12px;">Coupon Redemption Code *</label>
                            <input type="text" name="coupon_code" id="off_coupon_code" class="form-control font-monospace" required placeholder="GLOWBRIDE20">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Target Treatment / Service</label>
                            <input type="text" name="target_service" id="off_target_service" class="form-control" placeholder="All Treatments" value="All Treatments">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Target Customer Segment</label>
                            <select name="target_segment" id="off_target_segment" class="form-select">
                                <option value="all">All Patrons</option>
                                <option value="new">New Customers</option>
                                <option value="returning">Returning Patrons</option>
                                <option value="bridal">Bridal Inquiries</option>
                                <option value="academy">Academy Students</option>
                                <option value="vip">VIP High Value</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">Start Date *</label>
                            <input type="date" name="start_date" id="off_start_date" class="form-control" required value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12px;">End Date *</label>
                            <input type="date" name="end_date" id="off_end_date" class="form-control" required value="<?= date('Y-m-d', strtotime('+30 days')) ?>">
                        </div>
                    </div>

                    <div class="row g-3 mb-2">
                        <div class="col-md-6">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="off_is_active" value="1" checked>
                                <label class="form-check-label fw-bold" for="off_is_active" style="font-size: 12.5px;">Offer Active & Redeemable</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="featured_on_frontend" id="off_featured_on_frontend" value="1" checked>
                                <label class="form-check-label fw-bold" for="off_featured_on_frontend" style="font-size: 12.5px;">Display Live on Website Frontend</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save Privilege Offer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function prepareAddOffer() {
    document.getElementById('offerModalTitle').textContent = 'Create Promotional Offer';
    document.getElementById('off_id').value = '0';
    document.getElementById('off_name').value = '';
    document.getElementById('off_title').value = '';
    document.getElementById('off_description').value = '';
    document.getElementById('off_discount_type').value = 'percentage';
    document.getElementById('off_discount_value').value = '20';
    document.getElementById('off_coupon_code').value = 'GLOW' + Math.floor(1000 + Math.random() * 9000);
    document.getElementById('off_target_service').value = 'All Treatments';
    document.getElementById('off_target_segment').value = 'all';
    document.getElementById('off_start_date').value = '<?= date('Y-m-d') ?>';
    document.getElementById('off_end_date').value = '<?= date('Y-m-d', strtotime('+30 days')) ?>';
    document.getElementById('off_is_active').checked = true;
    document.getElementById('off_featured_on_frontend').checked = true;
}

function editOffer(o) {
    document.getElementById('offerModalTitle').textContent = 'Edit Offer: ' + o.title;
    document.getElementById('off_id').value = o.id;
    document.getElementById('off_name').value = o.name || '';
    document.getElementById('off_title').value = o.title || '';
    document.getElementById('off_description').value = o.description || '';
    document.getElementById('off_discount_type').value = o.discount_type || 'percentage';
    document.getElementById('off_discount_value').value = o.discount_value || '0';
    document.getElementById('off_coupon_code').value = o.coupon_code || '';
    document.getElementById('off_target_service').value = o.target_service || 'All Treatments';
    document.getElementById('off_target_segment').value = o.target_segment || 'all';
    document.getElementById('off_start_date').value = o.start_date || '<?= date('Y-m-d') ?>';
    document.getElementById('off_end_date').value = o.end_date || '<?= date('Y-m-d') ?>';
    document.getElementById('off_is_active').checked = (o.is_active == 1);
    document.getElementById('off_featured_on_frontend').checked = (o.featured_on_frontend == 1);

    var modal = new bootstrap.Modal(document.getElementById('offerModal'));
    modal.show();
}
</script>

<?= $this->endSection() ?>
