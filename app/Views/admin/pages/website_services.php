<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<style>
    /* Clean Modern Admin Card */
    .clean-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        padding: 24px;
        margin-bottom: 24px;
    }

    .clean-stat-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        text-decoration: none;
        color: inherit;
    }

    .clean-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(89, 46, 131, 0.1);
        border-color: #A36952;
        color: inherit;
    }

    .clean-stat-card.active {
        border-color: #592E83;
        background: #faf7fc;
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

    .service-thumb {
        width: 58px;
        height: 44px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #ede6e4;
    }
</style>

<!-- Category KPI Ribbon -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <a href="<?= base_url('admin/website/services?category=all') ?>" class="clean-stat-card <?= empty($currentCategory) || $currentCategory === 'all' ? 'active' : '' ?>">
            <div>
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7a6e78; font-weight: 700;">All Rituals</div>
                <div style="font-size: 1.4rem; font-family: 'Playfair Display', serif; font-weight: 700; color: #483C46;"><?= $categoryStats['all'] ?? 0 ?></div>
            </div>
            <span class="material-symbols-outlined" style="font-size: 22px; color: #592E83;">spa</span>
        </a>
    </div>
    <?php if (!empty($categories)): ?>
        <?php
            $catIcons = [
                'facials'  => 'face',
                'hair'     => 'content_cut',
                'bridal'   => 'diamond',
                'nails'    => 'brush',
                'wellness' => 'self_improvement',
            ];
            $catColors = ['#592E83', '#A36952', '#c026d3', '#0284c7', '#16a34a'];
            $i = 0;
        ?>
        <?php foreach ($categories as $cat): ?>
            <?php
                $catSlug = is_array($cat) ? ($cat['slug'] ?? '') : $cat;
                $catName = is_array($cat) ? ($cat['category_name'] ?? $catSlug) : ucwords(str_replace(['_', '-'], ' ', $cat));
                $icon = $catIcons[strtolower($catSlug)] ?? 'category';
                $color = $catColors[$i % count($catColors)];
                $i++;
            ?>
            <div class="col-6 col-md-4 col-xl-2">
                <a href="<?= base_url('admin/website/services?category=' . urlencode($catSlug)) ?>" class="clean-stat-card <?= ($currentCategory ?? '') === $catSlug ? 'active' : '' ?>">
                    <div>
                        <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7a6e78; font-weight: 700;"><?= esc($catName) ?></div>
                        <div style="font-size: 1.4rem; font-family: 'Playfair Display', serif; font-weight: 700; color: #483C46;"><?= $categoryStats[$catSlug] ?? 0 ?></div>
                    </div>
                    <span class="material-symbols-outlined" style="font-size: 22px; color: <?= $color ?>;"><?= $icon ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Toolbar -->
<div class="clean-card mb-4">
    <form method="get" action="<?= base_url('admin/website/services') ?>" class="row g-3 align-items-center">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0" style="border-color: #d5ccd3; border-radius: 10px 0 0 10px;">
                    <span class="material-symbols-outlined" style="font-size: 18px; color: #7a6e78;">search</span>
                </span>
                <input type="text" name="search" class="form-control clean-input border-start-0" style="border-radius: 0 10px 10px 0 !important;" value="<?= esc($search ?? '') ?>" placeholder="Search rituals, therapy name, description...">
            </div>
        </div>

        <div class="col-md-3">
            <select name="category" class="form-select clean-select" onchange="this.form.submit()">
                <option value="all" <?= empty($currentCategory) || $currentCategory === 'all' ? 'selected' : '' ?>>All Categories</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <?php
                            $catSlug = is_array($cat) ? ($cat['slug'] ?? '') : $cat;
                            $catName = is_array($cat) ? ($cat['category_name'] ?? $catSlug) : ucwords(str_replace(['_', '-'], ' ', $cat));
                        ?>
                        <option value="<?= esc($catSlug) ?>" <?= ($currentCategory ?? '') === $catSlug ? 'selected' : '' ?>>
                            <?= esc($catName) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="col-md-2">
            <select name="status" class="form-select clean-select" onchange="this.form.submit()">
                <option value="all" <?= ($statusFilter === null || $statusFilter === '' || $statusFilter === 'all') ? 'selected' : '' ?>>All Status</option>
                <option value="1" <?= $statusFilter === '1' ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= $statusFilter === '0' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <div class="col-md-3 text-md-end d-flex justify-content-md-end gap-2 flex-wrap">
            <button type="submit" class="btn-clean-secondary">
                <span>Filter</span>
            </button>
            <button type="button" class="btn-clean-secondary" data-bs-toggle="modal" data-bs-target="#manageCategoriesModal" title="Manage Categories">
                <span class="material-symbols-outlined" style="font-size: 18px;">category</span>
                <span>Categories</span>
            </button>
            <button type="button" class="btn-clean-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                <span>Add Ritual</span>
            </button>
        </div>
    </form>
</div>

<!-- Services Data Table -->
<div class="clean-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="clean-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Order</th>
                    <th style="width: 80px;">Media</th>
                    <th>Treatment Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th style="width: 90px; text-align: center;">Featured</th>
                    <th style="width: 100px; text-align: center;">Status</th>
                    <th style="width: 130px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $srv): ?>
                        <tr>
                            <td class="fw-bold" style="color: #7a6e78;">#<?= esc($srv['sort_order']) ?></td>
                            <td>
                                <?php
                                    $img = (strpos($srv['image_url'], 'http') === 0) ? $srv['image_url'] : base_url($srv['image_url']);
                                ?>
                                <img src="<?= esc($img) ?>" alt="Treatment" class="service-thumb" onerror="this.src='https://placehold.co/100x70?text=Ritual'">
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #483C46; font-size: 14px;"><?= esc($srv['name']) ?></div>
                                <div style="font-size: 11.5px; color: #7a6e78; max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?= esc($srv['description']) ?></div>
                            </td>
                            <td>
                                <?php
                                    $catPalette = [
                                        'facials'  => ['color' => '#A36952', 'bg' => 'rgba(163, 105, 82, 0.1)'],
                                        'hair'     => ['color' => '#592E83', 'bg' => 'rgba(89, 46, 131, 0.1)'],
                                        'bridal'   => ['color' => '#c026d3', 'bg' => 'rgba(192, 38, 211, 0.1)'],
                                        'nails'    => ['color' => '#0284c7', 'bg' => 'rgba(2, 132, 199, 0.1)'],
                                        'wellness' => ['color' => '#16a34a', 'bg' => 'rgba(22, 163, 74, 0.1)'],
                                    ];
                                    $slugKey = strtolower($srv['category']);
                                    $cLabel = $categoryMap[$srv['category']] ?? ($categoryMap[$slugKey] ?? ucwords(str_replace(['_', '-'], ' ', $srv['category'])));
                                    $cStyle = $catPalette[$slugKey] ?? [
                                        'color' => '#592E83',
                                        'bg'    => 'rgba(89, 46, 131, 0.1)'
                                    ];
                                ?>
                                <span style="font-size: 11px; padding: 4px 10px; border-radius: 999px; background: <?= $cStyle['bg'] ?>; color: <?= $cStyle['color'] ?>; font-weight: 700;">
                                    <?= esc($cLabel) ?>
                                </span>
                            </td>
                            <td class="fw-bold" style="color: #A36952;">₹<?= number_format((float) $srv['price'], 2) ?></td>
                            <td style="font-size: 12.5px; color: #7a6e78;"><?= esc($srv['duration']) ?></td>
                            <td style="text-align: center;">
                                <form action="<?= base_url('admin/services/toggle-featured/' . $srv['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;" title="Toggle spotlight">
                                        <span class="material-symbols-outlined" style="font-size: 20px; color: <?= $srv['is_featured'] ? '#eab308' : '#cbd5e1' ?>; font-variation-settings: 'FILL' <?= $srv['is_featured'] ? 1 : 0 ?>;">star</span>
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form action="<?= base_url('admin/services/toggle-status/' . $srv['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                        <span class="badge-pill-status <?= $srv['is_active'] ? 'status-active' : 'status-inactive' ?>">
                                            <span class="material-symbols-outlined" style="font-size: 13px;"><?= $srv['is_active'] ? 'check_circle' : 'block' ?></span>
                                            <?= $srv['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <button type="button" class="btn btn-sm btn-outline-secondary edit-service-btn me-1"
                                    data-id="<?= esc($srv['id']) ?>"
                                    data-name="<?= esc($srv['name']) ?>"
                                    data-category="<?= esc($srv['category']) ?>"
                                    data-price="<?= esc($srv['price']) ?>"
                                    data-duration="<?= esc($srv['duration']) ?>"
                                    data-desc="<?= esc($srv['description']) ?>"
                                    data-image="<?= esc($srv['image_url']) ?>"
                                    data-btn-text="<?= esc($srv['button_text']) ?>"
                                    data-btn-url="<?= esc($srv['button_url']) ?>"
                                    data-order="<?= esc($srv['sort_order']) ?>"
                                    data-active="<?= esc($srv['is_active']) ?>"
                                    data-featured="<?= esc($srv['is_featured']) ?>"
                                    data-bs-toggle="modal" data-bs-target="#editServiceModal"
                                    style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                </button>
                                <a href="<?= base_url('admin/services/delete/' . $srv['id']) ?>" onclick="return confirm('Delete this ritual from the catalog?');" class="btn btn-sm btn-outline-danger" style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-5" style="color: #7a6e78;">
                            <span class="material-symbols-outlined d-block mb-2" style="font-size: 32px; color: #d5ccd3;">search_off</span>
                            No treatments match your search or category filter.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <div class="d-flex align-items-center justify-content-between p-3 border-top" style="background: #ffffff;">
            <div style="font-size: 12px; color: #7a6e78;">
                Showing <b><?= min($totalMatching, ($currentPage - 1) * $perPage + 1) ?></b> to <b><?= min($totalMatching, $currentPage * $perPage) ?></b> of <b><?= $totalMatching ?></b> rituals
            </div>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= base_url('admin/website/services?page=' . ($currentPage - 1) . '&category=' . urlencode($currentCategory) . '&search=' . urlencode($search ?? '')) ?>">Previous</a>
                </li>
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <li class="page-item <?= $p == $currentPage ? 'active' : '' ?>">
                        <a class="page-link" href="<?= base_url('admin/website/services?page=' . $p . '&category=' . urlencode($currentCategory) . '&search=' . urlencode($search ?? '')) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= base_url('admin/website/services?page=' . ($currentPage + 1) . '&category=' . urlencode($currentCategory) . '&search=' . urlencode($search ?? '')) ?>">Next</a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</div>

<!-- ========================================== -->
<!-- MODALS FOR SERVICES                         -->
<!-- ========================================== -->

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/services/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Add New Ritual / Treatment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Treatment Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control clean-input" required placeholder="e.g. Clinical Hydra Glass-Skin Facial">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-select clean-select" required>
                                <option value="" disabled selected>Select Category</option>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <?php
                                            $catSlug = is_array($cat) ? ($cat['slug'] ?? '') : $cat;
                                            $catName = is_array($cat) ? ($cat['category_name'] ?? $catSlug) : ucwords(str_replace(['_', '-'], ' ', $cat));
                                        ?>
                                        <option value="<?= esc($catSlug) ?>">
                                            <?= esc($catName) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="facials">Aesthetic Facials</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" class="form-control clean-input" required placeholder="3500.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Duration</label>
                            <input type="text" name="duration" class="form-control clean-input" value="75 Minutes" placeholder="75 Minutes">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Description &amp; Biological Protocol</label>
                        <textarea name="description" rows="3" class="form-control clean-textarea" placeholder="Multi-step resurfacing treatment infusing patented peptides..."></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Image URL / Path</label>
                            <input type="text" name="image_url" class="form-control clean-input" placeholder="https://...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload Image File</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Button Text</label>
                            <input type="text" name="button_text" class="form-control clean-input" value="Book Now">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Button Link URL</label>
                            <input type="text" name="button_url" class="form-control clean-input" value="booking">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control clean-input" value="0">
                        </div>
                        <div class="col-md-4 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="addFeatured">
                                <label class="form-check-label fw-bold" for="addFeatured" style="font-size: 12.5px;">Spotlight / Featured</label>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="addActive" checked>
                                <label class="form-check-label fw-bold" for="addActive" style="font-size: 12.5px;">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Save Ritual</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/services/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editServiceId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Ritual / Treatment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Treatment Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="editServiceName" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Category <span class="text-danger">*</span></label>
                            <select name="category" id="editServiceCategory" class="form-select clean-select" required>
                                <option value="" disabled>Select Category</option>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <?php
                                            $catSlug = is_array($cat) ? ($cat['slug'] ?? '') : $cat;
                                            $catName = is_array($cat) ? ($cat['category_name'] ?? $catSlug) : ucwords(str_replace(['_', '-'], ' ', $cat));
                                        ?>
                                        <option value="<?= esc($catSlug) ?>">
                                            <?= esc($catName) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="facials">Aesthetic Facials</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" id="editServicePrice" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Duration</label>
                            <input type="text" name="duration" id="editServiceDuration" class="form-control clean-input">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Description &amp; Biological Protocol</label>
                        <textarea name="description" id="editServiceDesc" rows="3" class="form-control clean-textarea"></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Image URL / Path</label>
                            <input type="text" name="image_url" id="editServiceImage" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload New Image</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Button Text</label>
                            <input type="text" name="button_text" id="editServiceBtnText" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Button Link URL</label>
                            <input type="text" name="button_url" id="editServiceBtnUrl" class="form-control clean-input">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" id="editServiceOrder" class="form-control clean-input">
                        </div>
                        <div class="col-md-4 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="editServiceFeatured">
                                <label class="form-check-label fw-bold" for="editServiceFeatured" style="font-size: 12.5px;">Spotlight / Featured</label>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editServiceActive">
                                <label class="form-check-label fw-bold" for="editServiceActive" style="font-size: 12.5px;">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Update Ritual</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Manage Categories Modal -->
<div class="modal fade" id="manageCategoriesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <div class="modal-header border-bottom">
                <div>
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Category Management</h5>
                    <div style="font-size: 12px; color: #7a6e78;">Create, update, or remove treatment categories. Changes update live across the services catalog and website.</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Add New Category Form -->
                <div class="p-3 mb-4 rounded-3" style="background: #faf7fc; border: 1px solid #ede6e4;">
                    <h6 class="fw-bold mb-2" style="font-size: 13px; color: #483C46;">Add New Category</h6>
                    <form action="<?= base_url('admin/services/category/save') ?>" method="post" class="row g-2 align-items-end">
                        <?= csrf_field() ?>
                        <div class="col-md-8">
                            <label class="form-label fw-bold mb-1" style="font-size: 12px; color: #7a6e78;">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="category_name" class="form-control clean-input" placeholder="e.g. Web Development or Scalp Care" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn-clean-primary w-100 justify-content-center">
                                <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                                <span>Add Category</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Existing Categories Table -->
                <h6 class="fw-bold mb-2" style="font-size: 13px; color: #483C46;">Existing Categories</h6>
                <div class="table-responsive border rounded-3 overflow-hidden" style="border-color: #ede6e4 !important;">
                    <table class="clean-table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Category Name</th>
                                <th>Slug Code</th>
                                <th style="text-align: center; width: 100px;">Rituals</th>
                                <th style="text-align: right; width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categories)): ?>
                                <?php $cIdx = 1; ?>
                                <?php foreach ($categories as $catItem): ?>
                                    <?php
                                        $cId   = is_array($catItem) ? ($catItem['id'] ?? 0) : 0;
                                        $cName = is_array($catItem) ? ($catItem['category_name'] ?? '') : $catItem;
                                        $cSlug = is_array($catItem) ? ($catItem['slug'] ?? '') : $catItem;
                                        $cCount = $categoryStats[$cSlug] ?? 0;
                                    ?>
                                    <tr>
                                        <td class="fw-bold" style="color: #7a6e78;">#<?= $cIdx++ ?></td>
                                        <td>
                                            <span class="fw-bold" style="color: #483C46; font-size: 13.5px;"><?= esc($cName) ?></span>
                                        </td>
                                        <td>
                                            <code style="font-size: 12px; background: #f3eff5; padding: 2px 6px; border-radius: 4px; color: #592E83;"><?= esc($cSlug) ?></code>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="badge" style="background: rgba(89, 46, 131, 0.1); color: #592E83; font-weight: 700; border-radius: 999px; padding: 4px 10px;">
                                                <?= $cCount ?>
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn btn-sm btn-outline-secondary edit-category-btn me-1"
                                                data-id="<?= esc($cId) ?>"
                                                data-name="<?= esc($cName) ?>"
                                                data-slug="<?= esc($cSlug) ?>"
                                                data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                                style="padding: 3px 8px; border-radius: 6px;"
                                                title="Edit category">
                                                <span class="material-symbols-outlined" style="font-size: 15px;">edit</span>
                                            </button>
                                            <?php if ($cCount > 0): ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger disabled" style="padding: 3px 8px; border-radius: 6px; opacity: 0.45;" title="<?= $cCount ?> ritual(s) assigned. Cannot delete.">
                                                    <span class="material-symbols-outlined" style="font-size: 15px;">delete</span>
                                                </button>
                                            <?php else: ?>
                                                <a href="<?= base_url('admin/services/category/delete/' . $cId) ?>" onclick="return confirm('Delete category &quot;<?= esc(addslashes($cName)) ?>&quot;?');" class="btn btn-sm btn-outline-danger" style="padding: 3px 8px; border-radius: 6px;" title="Delete category">
                                                    <span class="material-symbols-outlined" style="font-size: 15px;">delete</span>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4" style="color: #7a6e78;">No categories found in database.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/services/category/save') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="modalEditCatId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="category_name" id="modalEditCatName" class="form-control clean-input" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Slug Identifier <small class="text-muted">(Optional)</small></label>
                        <input type="text" name="slug" id="modalEditCatSlug" class="form-control clean-input" placeholder="leave blank to auto-generate">
                        <small class="text-muted" style="font-size: 11.5px;">Updating the slug will automatically update existing services assigned to it.</small>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-toggle="modal" data-bs-target="#manageCategoriesModal">Back</button>
                    <button type="submit" class="btn-clean-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Service Edit Modal
    document.querySelectorAll('.edit-service-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editServiceId').value = this.dataset.id;
            document.getElementById('editServiceName').value = this.dataset.name;
            const editCatSelect = document.getElementById('editServiceCategory');
            editCatSelect.value = this.dataset.category;
            if (this.dataset.category && editCatSelect.value !== this.dataset.category) {
                const opt = new Option(this.dataset.category, this.dataset.category, true, true);
                editCatSelect.add(opt);
            }
            document.getElementById('editServicePrice').value = this.dataset.price;
            document.getElementById('editServiceDuration').value = this.dataset.duration;
            document.getElementById('editServiceDesc').value = this.dataset.desc;
            document.getElementById('editServiceImage').value = this.dataset.image;
            document.getElementById('editServiceBtnText').value = this.dataset.btnText;
            document.getElementById('editServiceBtnUrl').value = this.dataset.btnUrl;
            document.getElementById('editServiceOrder').value = this.dataset.order;
            document.getElementById('editServiceActive').checked = this.dataset.active == '1';
            document.getElementById('editServiceFeatured').checked = this.dataset.featured == '1';
        });
    });

    // Category Edit Modal
    document.querySelectorAll('.edit-category-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('modalEditCatId').value = this.dataset.id;
            document.getElementById('modalEditCatName').value = this.dataset.name;
            document.getElementById('modalEditCatSlug').value = this.dataset.slug;
        });
    });
});
</script>

<?= $this->endSection() ?>
