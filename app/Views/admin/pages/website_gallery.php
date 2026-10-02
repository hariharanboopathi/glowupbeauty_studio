<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Quick KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Assets</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? count($items)) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Lookbook entries across all disciplines</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">photo_library</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Featured Showcases</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #c98860; font-family: 'Playfair Display', serif;"><?= esc($stats['featured'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Spotlighted on homepage & lookbook</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(201, 136, 96, 0.12); display: flex; align-items: center; justify-content: center; color: #c98860;">
                <span class="material-symbols-outlined">auto_awesome</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Public Visible</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['active'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Live on customer-facing /gallery</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">visibility</span>
            </div>
        </div>
    </div>
</div>

<!-- Controls & Filter Strip -->
<div class="glass-panel p-3 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Category Filter Pills -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="<?= base_url('admin/website/gallery?category=all') ?>" class="badge-pill <?= ($currentCategory === 'all') ? 'active-pill' : 'inactive-pill' ?>">
                All Categories
            </a>
            <a href="<?= base_url('admin/website/gallery?category=bridal') ?>" class="badge-pill <?= ($currentCategory === 'bridal') ? 'active-pill' : 'inactive-pill' ?>">
                Haute Bridal
            </a>
            <a href="<?= base_url('admin/website/gallery?category=hair') ?>" class="badge-pill <?= ($currentCategory === 'hair') ? 'active-pill' : 'inactive-pill' ?>">
                Hair Alchemy
            </a>
            <a href="<?= base_url('admin/website/gallery?category=facials') ?>" class="badge-pill <?= ($currentCategory === 'facials') ? 'active-pill' : 'inactive-pill' ?>">
                Skin Radiance
            </a>
            <a href="<?= base_url('admin/website/gallery?category=academy') ?>" class="badge-pill <?= ($currentCategory === 'academy') ? 'active-pill' : 'inactive-pill' ?>">
                Academy
            </a>
            <a href="<?= base_url('admin/website/gallery?category=nails') ?>" class="badge-pill <?= ($currentCategory === 'nails') ? 'active-pill' : 'inactive-pill' ?>">
                Nails & Lashes
            </a>
        </div>

        <!-- Search and Add Button -->
        <div class="d-flex align-items-center gap-2">
            <form action="<?= base_url('admin/website/gallery') ?>" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="category" value="<?= esc($currentCategory) ?>">
                <div class="input-group input-group-sm" style="width: 220px;">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <span class="material-symbols-outlined" style="font-size: 16px;">search</span>
                    </span>
                    <input type="text" name="q" value="<?= esc($searchQuery ?? '') ?>" class="form-control border-start-0 ps-0" placeholder="Search gallery...">
                </div>
            </form>
            <button type="button" class="btn btn-luxury-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#galleryItemModal" onclick="resetGalleryModal()">
                <span class="material-symbols-outlined" style="font-size: 18px;">add_photo_alternate</span>
                <span>Add Lookbook Asset</span>
            </button>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="glass-panel p-0 mb-4" style="overflow: hidden;">
    <div class="table-responsive">
        <table class="table align-middle mb-0" style="font-size: 13px;">
            <thead style="background: #faf7f5; border-bottom: 1px solid var(--border-subtle); color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                <tr>
                    <th style="padding: 14px 18px; width: 60px;">#</th>
                    <th style="padding: 14px 18px;">Asset Preview</th>
                    <th style="padding: 14px 18px;">Title & Narrative</th>
                    <th style="padding: 14px 18px;">Category</th>
                    <th style="padding: 14px 18px; text-align: center;">Featured</th>
                    <th style="padding: 14px 18px; text-align: center;">Public Status</th>
                    <th style="padding: 14px 18px; text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items) && count($items) > 0): ?>
                    <?php foreach ($items as $idx => $item): ?>
                        <tr style="border-bottom: 1px solid rgba(89, 46, 131, 0.05);">
                            <td style="padding: 14px 18px; color: var(--text-muted);"><?= $idx + 1 ?></td>
                            <td style="padding: 14px 18px;">
                                <div style="width: 72px; height: 52px; border-radius: 8px; overflow: hidden; background: #f0ebe8; border: 1px solid var(--border-subtle); position: relative;">
                                    <?php 
                                        $imgSrc = $item['image_url'];
                                        if (!str_starts_with($imgSrc, 'http')) {
                                            $imgSrc = base_url($imgSrc);
                                        }
                                    ?>
                                    <img src="<?= esc($imgSrc) ?>" alt="<?= esc($item['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1560066984-138dadb4c035?w=200&q=80'">
                                    <?php if (!empty($item['is_before_after'])): ?>
                                        <span style="position: absolute; bottom: 2px; right: 2px; background: rgba(0,0,0,0.7); color: #fff; font-size: 8px; padding: 1px 4px; border-radius: 4px; font-weight: 700;">B/A</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-bold" style="color: var(--text-main); font-size: 13.5px;"><?= esc($item['title']) ?></div>
                                <div class="text-muted text-truncate" style="max-width: 320px; font-size: 12px;"><?= esc($item['description'] ?? 'No narrative provided') ?></div>
                                <div class="mt-1" style="font-size: 11px; color: var(--text-muted);">Sort Index: <code style="color: var(--accent);"><?= esc($item['sort_order']) ?></code></div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <?php
                                    $catStyles = [
                                        'bridal'  => ['bg' => 'rgba(201, 136, 96, 0.12)', 'color' => '#a36952', 'label' => 'Haute Bridal'],
                                        'hair'    => ['bg' => 'rgba(89, 46, 131, 0.10)',  'color' => '#592e83', 'label' => 'Hair Alchemy'],
                                        'facials' => ['bg' => 'rgba(0, 150, 136, 0.10)',  'color' => '#00796b', 'label' => 'Skin Radiance'],
                                        'academy' => ['bg' => 'rgba(33, 150, 243, 0.10)',  'color' => '#1976d2', 'label' => 'Academy'],
                                        'nails'   => ['bg' => 'rgba(233, 30, 99, 0.10)',   'color' => '#c2185b', 'label' => 'Nails & Lashes'],
                                    ];
                                    $st = $catStyles[$item['category']] ?? ['bg' => '#f0ebe8', 'color' => '#555', 'label' => ucfirst($item['category'])];
                                ?>
                                <span class="badge" style="background: <?= $st['bg'] ?>; color: <?= $st['color'] ?>; font-weight: 600; font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                                    <?= esc($st['label']) ?>
                                </span>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" role="switch" <?= $item['is_featured'] ? 'checked' : '' ?> onchange="toggleGalleryFeatured(<?= $item['id'] ?>)">
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" role="switch" <?= $item['is_active'] ? 'checked' : '' ?> onchange="toggleGalleryStatus(<?= $item['id'] ?>)">
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: right;">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <button type="button" class="btn btn-sm btn-icon-round" title="Edit Lookbook Item" onclick="editGalleryItem(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">edit</span>
                                    </button>
                                    <a href="<?= base_url('admin/website/gallery/delete/' . $item['id']) ?>" class="btn btn-sm btn-icon-round" title="Delete Item" onclick="return confirm('Permanently remove this image asset from gallery lookbook?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d32f2f;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.4;">photo_library</span>
                            <div class="mt-2 fw-semibold text-muted">No lookbook assets discovered in this category</div>
                            <small class="text-muted">Click "Add Lookbook Asset" above to publish your first high-fashion portrait.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Gallery Modal -->
<div class="modal fade" id="galleryItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0" style="box-shadow: 0 20px 48px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom pb-3" style="border-color: var(--border-subtle) !important;">
                <h5 class="modal-title fw-bold" id="galleryModalTitle" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                    Add Lookbook Asset
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/website/gallery/save') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="item_id" value="">

                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Asset Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="item_title" class="form-control" required placeholder="e.g. Royal Heritage Temple Bride">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Category <span class="text-danger">*</span>
                            </label>
                            <select name="category" id="item_category" class="form-select" required>
                                <option value="bridal">Haute Bridal</option>
                                <option value="hair">Hair Alchemy</option>
                                <option value="facials">Skin Radiance</option>
                                <option value="academy">Academy Masterclasses</option>
                                <option value="nails">Nails & Lashes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Sort Priority
                            </label>
                            <input type="number" name="sort_order" id="item_sort_order" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Image Source (URL or File Upload)
                        </label>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-white"><span class="material-symbols-outlined" style="font-size: 18px; color: var(--text-muted);">link</span></span>
                            <input type="text" name="image_url" id="item_image_url" class="form-control" placeholder="https://... or images/slide-bridal.jpg">
                        </div>
                        <input type="file" name="image_file" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted" style="font-size: 11px;">Upload high-res jpg/png or paste an asset link</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Artistic Narrative / Description
                        </label>
                        <textarea name="description" id="item_description" rows="3" class="form-control" placeholder="Describe technique, botanical products, or bridal jewelry highlights..."></textarea>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-2 rounded" style="background: #faf7f5; border: 1px solid var(--border-subtle);">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="item_is_featured" value="1">
                            <label class="form-check-label fw-semibold" for="item_is_featured" style="font-size: 12px;">Featured Lookbook Highlight</label>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="is_active" id="item_is_active" value="1" checked>
                            <label class="form-check-label fw-semibold" for="item_is_active" style="font-size: 12px;">Public Visible</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top pt-3" style="border-color: var(--border-subtle) !important;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Save Lookbook Item</button>
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
function resetGalleryModal() {
    document.getElementById('galleryModalTitle').innerText = 'Add Lookbook Asset';
    document.getElementById('item_id').value = '';
    document.getElementById('item_title').value = '';
    document.getElementById('item_category').value = 'bridal';
    document.getElementById('item_sort_order').value = '0';
    document.getElementById('item_image_url').value = '';
    document.getElementById('item_description').value = '';
    document.getElementById('item_is_featured').checked = false;
    document.getElementById('item_is_active').checked = true;
}

function editGalleryItem(item) {
    document.getElementById('galleryModalTitle').innerText = 'Edit Lookbook Asset';
    document.getElementById('item_id').value = item.id;
    document.getElementById('item_title').value = item.title;
    document.getElementById('item_category').value = item.category;
    document.getElementById('item_sort_order').value = item.sort_order;
    document.getElementById('item_image_url').value = item.image_url;
    document.getElementById('item_description').value = item.description || '';
    document.getElementById('item_is_featured').checked = (item.is_featured == 1);
    document.getElementById('item_is_active').checked = (item.is_active == 1);

    const modal = new bootstrap.Modal(document.getElementById('galleryItemModal'));
    modal.show();
}

function toggleGalleryStatus(id) {
    fetch('<?= base_url('admin/website/gallery/toggle') ?>/' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (!data.status) {
            alert('Failed to update status.');
        }
    })
    .catch(() => alert('Network error toggling status.'));
}

function toggleGalleryFeatured(id) {
    fetch('<?= base_url('admin/website/gallery/toggle-featured') ?>/' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (!data.status) {
            alert('Failed to update featured flag.');
        }
    })
    .catch(() => alert('Network error toggling featured.'));
}
</script>

<?= $this->endSection() ?>
