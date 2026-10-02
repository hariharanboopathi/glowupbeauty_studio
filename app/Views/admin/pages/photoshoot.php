<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Packages</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Studio & bridal photography tiers</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">photo_camera</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Active Packages</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['active'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Open for patron reservations</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Average Tier Value</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #c98860; font-family: 'Playfair Display', serif;">₹<?= number_format($stats['avgPrice'] ?? 0, 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Mean booking ticket size</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(201, 136, 96, 0.12); display: flex; align-items: center; justify-content: center; color: #c98860;">
                <span class="material-symbols-outlined">payments</span>
            </div>
        </div>
    </div>
</div>

<!-- Action Bar -->
<div class="glass-panel p-3 mb-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
        <span class="material-symbols-outlined" style="color: var(--accent);">camera_roll</span>
        <span class="fw-bold" style="color: var(--text-main); font-size: 14px;">Studio Folio & Photoshoot Offerings</span>
    </div>
    <button type="button" class="btn btn-luxury-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#photoshootModal" onclick="resetPhotoshootModal()">
        <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
        <span>Add Package</span>
    </button>
</div>

<!-- Table Card -->
<div class="glass-panel p-0 mb-4" style="overflow: hidden;">
    <div class="table-responsive">
        <table class="table align-middle mb-0" style="font-size: 13px;">
            <thead style="background: #faf7f5; border-bottom: 1px solid var(--border-subtle); color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                <tr>
                    <th style="padding: 14px 18px; width: 60px;">#</th>
                    <th style="padding: 14px 18px;">Package Details</th>
                    <th style="padding: 14px 18px;">Type & Duration</th>
                    <th style="padding: 14px 18px;">Price (INR)</th>
                    <th style="padding: 14px 18px;">Inclusions</th>
                    <th style="padding: 14px 18px; text-align: center;">Active</th>
                    <th style="padding: 14px 18px; text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($packages) && count($packages) > 0): ?>
                    <?php foreach ($packages as $idx => $pkg): ?>
                        <tr style="border-bottom: 1px solid rgba(89, 46, 131, 0.05);">
                            <td style="padding: 14px 18px; color: var(--text-muted);"><?= $idx + 1 ?></td>
                            <td style="padding: 14px 18px;">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 52px; height: 52px; border-radius: 8px; overflow: hidden; background: #faf7f5; border: 1px solid var(--border-subtle); flex-shrink: 0;">
                                        <img src="<?= esc($pkg['image_url'] ? (str_starts_with($pkg['image_url'], 'http') ? $pkg['image_url'] : base_url($pkg['image_url'])) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&q=80') ?>" alt="<?= esc($pkg['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&q=80'">
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: var(--text-main); font-size: 13.5px;"><?= esc($pkg['title']) ?></div>
                                        <div class="text-muted text-truncate" style="max-width: 260px; font-size: 11.5px;"><?= esc($pkg['description'] ?? 'No description.') ?></div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <span class="badge" style="background: rgba(89, 46, 131, 0.08); color: var(--accent); font-size: 11px; padding: 4px 8px; border-radius: 6px;">
                                    <?= esc($pkg['package_type']) ?>
                                </span>
                                <div class="text-muted mt-1" style="font-size: 11px;">⏱ <?= esc($pkg['duration']) ?></div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-bold" style="color: #a36952; font-size: 14px;">₹<?= number_format($pkg['price'], 2) ?></div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="text-muted text-truncate" style="max-width: 240px; font-size: 11.5px;">
                                    <?= esc($pkg['inclusions'] ?? 'N/A') ?>
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" role="switch" <?= $pkg['is_active'] ? 'checked' : '' ?> onchange="togglePhotoshoot(<?= $pkg['id'] ?>)">
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: right;">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <button type="button" class="btn btn-sm btn-icon-round" title="Edit Package" onclick="editPhotoshoot(<?= htmlspecialchars(json_encode($pkg), ENT_QUOTES, 'UTF-8') ?>)">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">edit</span>
                                    </button>
                                    <a href="<?= base_url('admin/business/photoshoot/delete/' . $pkg['id']) ?>" class="btn btn-sm btn-icon-round" title="Delete Package" onclick="return confirm('Remove this photoshoot package?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d32f2f;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.4;">photo_camera</span>
                            <div class="mt-2 fw-semibold text-muted">No photoshoot packages configured</div>
                            <small class="text-muted">Click "Add Package" to create your first studio photoshoot offering.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="photoshootModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0" style="box-shadow: 0 20px 48px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom pb-3" style="border-color: var(--border-subtle) !important;">
                <h5 class="modal-title fw-bold" id="pkgModalTitle" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                    Add Photoshoot Package
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/business/photoshoot/save') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="pkg_id" value="">

                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Package Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="pkg_title" class="form-control" required placeholder="e.g. Editorial Bridal Lookbook Shoot">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Package Type
                            </label>
                            <input type="text" name="package_type" id="pkg_type" class="form-control" placeholder="e.g. Bridal Lookbook">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Price (INR ₹) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" name="price" id="pkg_price" class="form-control" required placeholder="25000">
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Duration
                            </label>
                            <input type="text" name="duration" id="pkg_duration" class="form-control" placeholder="e.g. 4 Hours">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Sort Order
                            </label>
                            <input type="number" name="sort_order" id="pkg_sort_order" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Banner Image (URL or Upload)
                        </label>
                        <input type="text" name="image_url" id="pkg_image_url" class="form-control mb-2" placeholder="https://... or uploads/...">
                        <input type="file" name="image_file" class="form-control form-control-sm" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Inclusions / Highlights
                        </label>
                        <textarea name="inclusions" id="pkg_inclusions" rows="2" class="form-control" placeholder="e.g. 3 Makeover Looks, 15 Retouched High-Res Photos, Studio Backdrops"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Package Description
                        </label>
                        <textarea name="description" id="pkg_description" rows="2" class="form-control" placeholder="Describe the shoot experience, creative direction..."></textarea>
                    </div>

                    <div class="form-check form-switch p-2 rounded" style="background: #faf7f5; border: 1px solid var(--border-subtle); padding-left: 2.5rem;">
                        <input class="form-check-input" type="checkbox" name="is_active" id="pkg_is_active" value="1" checked>
                        <label class="form-check-label fw-semibold" for="pkg_is_active" style="font-size: 12px;">Active for Patron Bookings</label>
                    </div>
                </div>

                <div class="modal-footer border-top pt-3" style="border-color: var(--border-subtle) !important;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Save Package</button>
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
function resetPhotoshootModal() {
    document.getElementById('pkgModalTitle').innerText = 'Add Photoshoot Package';
    document.getElementById('pkg_id').value = '';
    document.getElementById('pkg_title').value = '';
    document.getElementById('pkg_type').value = 'Bridal Lookbook';
    document.getElementById('pkg_price').value = '20000';
    document.getElementById('pkg_duration').value = '4 Hours';
    document.getElementById('pkg_sort_order').value = '0';
    document.getElementById('pkg_image_url').value = '';
    document.getElementById('pkg_inclusions').value = '';
    document.getElementById('pkg_description').value = '';
    document.getElementById('pkg_is_active').checked = true;
}

function editPhotoshoot(pkg) {
    document.getElementById('pkgModalTitle').innerText = 'Edit Photoshoot Package';
    document.getElementById('pkg_id').value = pkg.id;
    document.getElementById('pkg_title').value = pkg.title;
    document.getElementById('pkg_type').value = pkg.package_type;
    document.getElementById('pkg_price').value = pkg.price;
    document.getElementById('pkg_duration').value = pkg.duration;
    document.getElementById('pkg_sort_order').value = pkg.sort_order;
    document.getElementById('pkg_image_url').value = pkg.image_url || '';
    document.getElementById('pkg_inclusions').value = pkg.inclusions || '';
    document.getElementById('pkg_description').value = pkg.description || '';
    document.getElementById('pkg_is_active').checked = (pkg.is_active == 1);

    const modal = new bootstrap.Modal(document.getElementById('photoshootModal'));
    modal.show();
}

function togglePhotoshoot(id) {
    fetch('<?= base_url('admin/business/photoshoot/toggle') ?>/' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (!data.status) {
            alert('Failed to toggle status');
        }
    })
    .catch(() => alert('Network error toggling status'));
}
</script>

<?= $this->endSection() ?>
