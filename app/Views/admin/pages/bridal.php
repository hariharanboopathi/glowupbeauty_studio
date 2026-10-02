<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<style>
    .clean-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        padding: 24px;
        margin-bottom: 24px;
    }

    .clean-input, .clean-select, .clean-textarea {
        background-color: #ffffff !important;
        border: 1px solid #d5ccd3 !important;
        border-radius: 10px !important;
        color: #483C46 !important;
        font-size: 13.5px !important;
        padding: 9px 14px !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
    }

    .clean-input:focus, .clean-select:focus, .clean-textarea:focus {
        border-color: #592E83 !important;
        box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.18) !important;
        outline: none !important;
    }

    .btn-clean-primary {
        background: linear-gradient(135deg, #592E83, #48236d);
        color: #ffffff !important;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 10px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 3px 10px rgba(89, 46, 131, 0.25);
        cursor: pointer;
        transition: all 0.2s ease;
        height: 42px;
    }

    .btn-clean-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(89, 46, 131, 0.35);
        color: #ffffff !important;
    }

    .clean-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .clean-table th {
        background: #f8f6f8;
        color: #483C46;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 14px 16px;
        border-top: 1px solid #ede6e4;
        border-bottom: 1px solid #ede6e4;
    }

    .clean-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #ede6e4;
        font-size: 13.5px;
        color: #483C46;
        vertical-align: middle;
        background: #ffffff;
    }

    .clean-table tr:hover td {
        background: #faf8fb;
    }

    .badge-pill-status {
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .status-active {
        background: rgba(34, 197, 94, 0.12);
        color: #15803d;
        border: 1px solid rgba(34, 197, 94, 0.25);
    }

    .status-inactive {
        background: rgba(148, 163, 184, 0.15);
        color: #64748b;
        border: 1px solid rgba(148, 163, 184, 0.25);
    }

    .bridal-thumb {
        width: 60px;
        height: 44px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #ede6e4;
    }
</style>

<!-- Action Header Card -->
<div class="clean-card mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">Bridal Packages &amp; Matrimonial Tiers</h4>
            <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Manage bespoke bridal makeover packages, tiers (Silver, Gold, Haute Royal), inclusions, and pricing.</p>
        </div>
        <button type="button" class="btn-clean-primary" data-bs-toggle="modal" data-bs-target="#addBridalModal">
            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
            <span>Add Bridal Package</span>
        </button>
    </div>
</div>

<!-- Bridal Table -->
<div class="clean-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="clean-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Order</th>
                    <th style="width: 80px;">Media</th>
                    <th>Package Title</th>
                    <th>Tier</th>
                    <th>Pricing (₹)</th>
                    <th>Duration</th>
                    <th>Key Inclusions</th>
                    <th style="width: 100px; text-align: center;">Status</th>
                    <th style="width: 130px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($packages)): ?>
                    <?php foreach ($packages as $pkg): ?>
                        <tr>
                            <td class="fw-bold" style="color: #7a6e78;">#<?= esc($pkg['sort_order']) ?></td>
                            <td>
                                <?php
                                    $img = (strpos($pkg['image_url'], 'http') === 0) ? $pkg['image_url'] : base_url($pkg['image_url']);
                                ?>
                                <img src="<?= esc($img) ?>" alt="Bridal Package" class="bridal-thumb" onerror="this.src='https://placehold.co/100x70?text=Bridal'">
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #483C46; font-size: 14px;"><?= esc($pkg['title']) ?></div>
                                <div style="font-size: 11.5px; color: #7a6e78; max-width: 250px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?= esc($pkg['description']) ?></div>
                            </td>
                            <td>
                                <span style="font-size: 11px; padding: 3px 10px; border-radius: 999px; background: rgba(163, 105, 82, 0.1); color: #A36952; font-weight: 700;">
                                    <?= esc($pkg['tier']) ?>
                                </span>
                            </td>
                            <td class="fw-bold" style="color: #A36952;">₹<?= number_format((float) $pkg['price'], 2) ?></td>
                            <td style="font-size: 12.5px; color: #7a6e78;"><?= esc($pkg['duration']) ?></td>
                            <td style="font-size: 11.5px; color: #7a6e78; max-width: 220px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                <?= esc($pkg['inclusions'] ?? '—') ?>
                            </td>
                            <td style="text-align: center;">
                                <form action="<?= base_url('admin/business/bridal/toggle/' . $pkg['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                        <span class="badge-pill-status <?= $pkg['is_active'] ? 'status-active' : 'status-inactive' ?>">
                                            <span class="material-symbols-outlined" style="font-size: 13px;"><?= $pkg['is_active'] ? 'check_circle' : 'block' ?></span>
                                            <?= $pkg['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <button type="button" class="btn btn-sm btn-outline-secondary edit-bridal-btn me-1"
                                    data-id="<?= esc($pkg['id']) ?>"
                                    data-title="<?= esc($pkg['title']) ?>"
                                    data-tier="<?= esc($pkg['tier']) ?>"
                                    data-price="<?= esc($pkg['price']) ?>"
                                    data-duration="<?= esc($pkg['duration']) ?>"
                                    data-desc="<?= esc($pkg['description']) ?>"
                                    data-inclusions="<?= esc($pkg['inclusions']) ?>"
                                    data-badge="<?= esc($pkg['badge']) ?>"
                                    data-image="<?= esc($pkg['image_url']) ?>"
                                    data-order="<?= esc($pkg['sort_order']) ?>"
                                    data-active="<?= esc($pkg['is_active']) ?>"
                                    data-bs-toggle="modal" data-bs-target="#editBridalModal"
                                    style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                </button>
                                <a href="<?= base_url('admin/business/bridal/delete/' . $pkg['id']) ?>" onclick="return confirm('Remove bridal package?');" class="btn btn-sm btn-outline-danger" style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-5" style="color: #7a6e78;">No bridal packages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Bridal Modal -->
<div class="modal fade" id="addBridalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/business/bridal/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Add Bridal Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Package Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control clean-input" required placeholder="e.g. Haute Royal Airbrush Matrimonial">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Tier</label>
                            <select name="tier" class="form-select clean-select">
                                <option value="Silver">Silver</option>
                                <option value="Gold">Gold</option>
                                <option value="Haute Royal">Haute Royal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" class="form-control clean-input" required placeholder="32000.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Duration / Coverage</label>
                            <input type="text" name="duration" class="form-control clean-input" value="Full Day" placeholder="Full Day / 2 Looks">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Package Description</label>
                        <textarea name="description" rows="2" class="form-control clean-textarea" placeholder="Temptu Silicon Airbrush makeup, pre-wedding facial..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Inclusions (comma separated)</label>
                        <input type="text" name="inclusions" class="form-control clean-input" placeholder="2 Bridal Looks, Temptu Airbrush, Pre-bridal facial, Assistant">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Cover Image URL</label>
                            <input type="text" name="image_url" class="form-control clean-input" placeholder="https://...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload Image</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Badge / Tag</label>
                            <input type="text" name="badge" class="form-control clean-input" placeholder="e.g. Signature">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control clean-input" value="1">
                        </div>
                        <div class="col-md-4 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="addBridalActive" checked>
                                <label class="form-check-label fw-bold" for="addBridalActive" style="font-size: 12.5px;">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Save Package</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Bridal Modal -->
<div class="modal fade" id="editBridalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/business/bridal/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editBridalId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Bridal Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Package Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="editBridalTitle" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Tier</label>
                            <select name="tier" id="editBridalTier" class="form-select clean-select">
                                <option value="Silver">Silver</option>
                                <option value="Gold">Gold</option>
                                <option value="Haute Royal">Haute Royal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" id="editBridalPrice" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Duration / Coverage</label>
                            <input type="text" name="duration" id="editBridalDuration" class="form-control clean-input">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Package Description</label>
                        <textarea name="description" id="editBridalDesc" rows="2" class="form-control clean-textarea"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Inclusions (comma separated)</label>
                        <input type="text" name="inclusions" id="editBridalInclusions" class="form-control clean-input">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Cover Image URL</label>
                            <input type="text" name="image_url" id="editBridalImage" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload New Image</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Badge / Tag</label>
                            <input type="text" name="badge" id="editBridalBadge" class="form-control clean-input">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" id="editBridalOrder" class="form-control clean-input">
                        </div>
                        <div class="col-md-4 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editBridalActive">
                                <label class="form-check-label fw-bold" for="editBridalActive" style="font-size: 12.5px;">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Update Package</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-bridal-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editBridalId').value = this.dataset.id;
            document.getElementById('editBridalTitle').value = this.dataset.title;
            document.getElementById('editBridalTier').value = this.dataset.tier;
            document.getElementById('editBridalPrice').value = this.dataset.price;
            document.getElementById('editBridalDuration').value = this.dataset.duration;
            document.getElementById('editBridalDesc').value = this.dataset.desc;
            document.getElementById('editBridalInclusions').value = this.dataset.inclusions;
            document.getElementById('editBridalBadge').value = this.dataset.badge;
            document.getElementById('editBridalImage').value = this.dataset.image;
            document.getElementById('editBridalOrder').value = this.dataset.order;
            document.getElementById('editBridalActive').checked = this.dataset.active == '1';
        });
    });
});
</script>

<?= $this->endSection() ?>
