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

    .btn-clean-secondary {
        background: #ffffff;
        border: 1px solid #A36952;
        color: #A36952 !important;
        font-weight: 600;
        font-size: 13px;
        padding: 9px 16px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        height: 42px;
        text-decoration: none;
    }

    .btn-clean-secondary:hover {
        background: #fbf6f4;
        color: #8a5540 !important;
        border-color: #8a5540;
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

    .rental-thumb {
        width: 58px;
        height: 44px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #ede6e4;
    }
</style>

<!-- Toolbar & Category Filter -->
<div class="clean-card mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">Rentals &amp; Jewellery Inventory</h4>
            <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Manage bridal jewelry sets, couture lehengas, hair ornaments, and photoshoot props available for rent.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn-clean-primary" data-bs-toggle="modal" data-bs-target="#addRentalModal">
                <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                <span>Add Inventory Item</span>
            </button>
        </div>
    </div>

    <!-- Category Filter Ribbon -->
    <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
        <a href="<?= base_url('admin/business/rentals?category=all') ?>" class="btn btn-sm <?= ($currentCategory ?? '') === 'all' ? 'btn-dark' : 'btn-outline-secondary' ?>" style="border-radius: 8px;">All Items</a>
        <a href="<?= base_url('admin/business/rentals?category=Jewellery') ?>" class="btn btn-sm <?= ($currentCategory ?? '') === 'Jewellery' ? 'btn-dark' : 'btn-outline-secondary' ?>" style="border-radius: 8px;">Temple Jewellery</a>
        <a href="<?= base_url('admin/business/rentals?category=Couture+Lehenga') ?>" class="btn btn-sm <?= ($currentCategory ?? '') === 'Couture Lehenga' ? 'btn-dark' : 'btn-outline-secondary' ?>" style="border-radius: 8px;">Couture Lehengas</a>
        <a href="<?= base_url('admin/business/rentals?category=Hair+Ornaments') ?>" class="btn btn-sm <?= ($currentCategory ?? '') === 'Hair Ornaments' ? 'btn-dark' : 'btn-outline-secondary' ?>" style="border-radius: 8px;">Hair Ornaments</a>
        <a href="<?= base_url('admin/business/rentals?category=Props') ?>" class="btn btn-sm <?= ($currentCategory ?? '') === 'Props' ? 'btn-dark' : 'btn-outline-secondary' ?>" style="border-radius: 8px;">Photoshoot Props</a>
    </div>
</div>

<!-- Rentals Table -->
<div class="clean-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="clean-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Order</th>
                    <th style="width: 80px;">Media</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Daily Rate (₹)</th>
                    <th>Security Deposit</th>
                    <th style="width: 120px; text-align: center;">Availability</th>
                    <th style="width: 130px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rentals)): ?>
                    <?php foreach ($rentals as $r): ?>
                        <tr>
                            <td class="fw-bold" style="color: #7a6e78;">#<?= esc($r['sort_order']) ?></td>
                            <td>
                                <?php
                                    $img = (strpos($r['image_url'], 'http') === 0) ? $r['image_url'] : base_url($r['image_url']);
                                ?>
                                <img src="<?= esc($img) ?>" alt="Rental Item" class="rental-thumb" onerror="this.src='https://placehold.co/100x70?text=Rental'">
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #483C46; font-size: 14px;"><?= esc($r['name']) ?></div>
                                <div style="font-size: 11.5px; color: #7a6e78; max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?= esc($r['description']) ?></div>
                            </td>
                            <td>
                                <span style="font-size: 11px; padding: 3px 10px; border-radius: 999px; background: rgba(89, 46, 131, 0.08); color: #592E83; font-weight: 700;">
                                    <?= esc($r['category']) ?>
                                </span>
                            </td>
                            <td class="fw-bold" style="color: #A36952;">₹<?= number_format((float) $r['rental_price'], 2) ?>/day</td>
                            <td style="font-size: 12.5px; color: #7a6e78;">₹<?= number_format((float) $r['deposit_amount'], 2) ?></td>
                            <td style="text-align: center;">
                                <form action="<?= base_url('admin/business/rentals/toggle/' . $r['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                        <span class="badge-pill-status <?= $r['is_available'] ? 'status-active' : 'status-inactive' ?>">
                                            <span class="material-symbols-outlined" style="font-size: 13px;"><?= $r['is_available'] ? 'check_circle' : 'block' ?></span>
                                            <?= $r['is_available'] ? 'In Stock' : 'Rented Out' ?>
                                        </span>
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <button type="button" class="btn btn-sm btn-outline-secondary edit-rental-btn me-1"
                                    data-id="<?= esc($r['id']) ?>"
                                    data-name="<?= esc($r['name']) ?>"
                                    data-category="<?= esc($r['category']) ?>"
                                    data-rental="<?= esc($r['rental_price']) ?>"
                                    data-deposit="<?= esc($r['deposit_amount']) ?>"
                                    data-desc="<?= esc($r['description']) ?>"
                                    data-image="<?= esc($r['image_url']) ?>"
                                    data-order="<?= esc($r['sort_order']) ?>"
                                    data-available="<?= esc($r['is_available']) ?>"
                                    data-bs-toggle="modal" data-bs-target="#editRentalModal"
                                    style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                </button>
                                <a href="<?= base_url('admin/business/rentals/delete/' . $r['id']) ?>" onclick="return confirm('Delete this inventory item?');" class="btn btn-sm btn-outline-danger" style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5" style="color: #7a6e78;">No rental items found in this category.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Rental Modal -->
<div class="modal fade" id="addRentalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/business/rentals/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Add Rental Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Item Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control clean-input" required placeholder="e.g. Temple Nakshi Kemp Choker Set">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Category</label>
                            <select name="category" class="form-select clean-select">
                                <option value="Jewellery">Temple Jewellery</option>
                                <option value="Couture Lehenga">Couture Lehenga</option>
                                <option value="Hair Ornaments">Hair Ornaments</option>
                                <option value="Props">Photoshoot Props</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Rental Rate (₹/day) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="rental_price" class="form-control clean-input" required placeholder="3500.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Refundable Deposit (₹)</label>
                            <input type="number" step="0.01" name="deposit_amount" class="form-control clean-input" value="5000.00" placeholder="5000.00">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Description / Craftsmanship Details</label>
                        <textarea name="description" rows="2" class="form-control clean-textarea" placeholder="Antique 22k matte gold finish handcrafted temple jewellery..."></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Image URL</label>
                            <input type="text" name="image_url" class="form-control clean-input" placeholder="https://...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload Image</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control clean-input" value="1">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_available" value="1" id="addRentalAvailable" checked>
                                <label class="form-check-label fw-bold" for="addRentalAvailable" style="font-size: 12.5px;">In Stock / Available</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Save Rental Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Rental Modal -->
<div class="modal fade" id="editRentalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/business/rentals/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editRentalId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Rental Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Item Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="editRentalName" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Category</label>
                            <select name="category" id="editRentalCategory" class="form-select clean-select">
                                <option value="Jewellery">Temple Jewellery</option>
                                <option value="Couture Lehenga">Couture Lehenga</option>
                                <option value="Hair Ornaments">Hair Ornaments</option>
                                <option value="Props">Photoshoot Props</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Rental Rate (₹/day) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="rental_price" id="editRentalPrice" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Refundable Deposit (₹)</label>
                            <input type="number" step="0.01" name="deposit_amount" id="editRentalDeposit" class="form-control clean-input">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Description / Craftsmanship Details</label>
                        <textarea name="description" id="editRentalDesc" rows="2" class="form-control clean-textarea"></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Image URL</label>
                            <input type="text" name="image_url" id="editRentalImage" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload New Image</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" id="editRentalOrder" class="form-control clean-input">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_available" value="1" id="editRentalAvailable">
                                <label class="form-check-label fw-bold" for="editRentalAvailable" style="font-size: 12.5px;">In Stock / Available</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Update Rental Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-rental-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editRentalId').value = this.dataset.id;
            document.getElementById('editRentalName').value = this.dataset.name;
            document.getElementById('editRentalCategory').value = this.dataset.category;
            document.getElementById('editRentalPrice').value = this.dataset.rental;
            document.getElementById('editRentalDeposit').value = this.dataset.deposit;
            document.getElementById('editRentalDesc').value = this.dataset.desc;
            document.getElementById('editRentalImage').value = this.dataset.image;
            document.getElementById('editRentalOrder').value = this.dataset.order;
            document.getElementById('editRentalAvailable').checked = this.dataset.available == '1';
        });
    });
});
</script>

<?= $this->endSection() ?>
