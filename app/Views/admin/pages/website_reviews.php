<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<style>
    /* ==========================================================================
       CLEAN WHITE-BASED ADMIN UI - REVIEW & TESTIMONIAL MANAGEMENT
       ========================================================================== */

    /* White Cards & Panels */
    .white-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.05), 0 1px 2px rgba(72, 60, 70, 0.03);
    }

    /* Metric Stat Cards */
    .review-metric-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        padding: 20px 22px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .review-metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(89, 46, 131, 0.12);
        border-color: #A36952;
    }

    .metric-label-clean {
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .metric-value-clean {
        font-size: 1.85rem;
        font-weight: 700;
        color: #483C46;
        line-height: 1.1;
        font-family: 'Playfair Display', serif;
    }

    .metric-icon-clean {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .metric-icon-clean .material-symbols-outlined {
        font-size: 24px;
    }

    /* Filter Toolbar */
    .review-filter-toolbar {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        padding: 16px 20px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        margin-bottom: 24px;
    }

    /* Form Controls */
    .clean-input,
    .clean-select {
        background-color: #ffffff !important;
        border: 1px solid #d5ccd3 !important;
        border-radius: 10px !important;
        color: #483C46 !important;
        font-size: 13.5px !important;
        padding: 9px 14px !important;
        height: 42px !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
    }

    .clean-input:focus,
    .clean-select:focus {
        background-color: #ffffff !important;
        border-color: #592E83 !important;
        box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.18) !important;
        color: #483C46 !important;
        outline: none !important;
    }

    .clean-input::placeholder {
        color: #988b97 !important;
        opacity: 1;
    }

    /* Buttons: Secondary (#A36952) */
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
        text-decoration: none;
        transition: all 0.2s ease;
        height: 42px;
    }

    .btn-clean-secondary:hover {
        background: #f8f1ee;
        color: #8a5540 !important;
        border-color: #8a5540;
    }

    /* Buttons: Primary (#592E83) */
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
        text-decoration: none;
        box-shadow: 0 3px 10px rgba(89, 46, 131, 0.25);
        transition: all 0.22s ease;
        height: 42px;
        cursor: pointer;
    }

    .btn-clean-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(89, 46, 131, 0.38);
        color: #ffffff !important;
    }

    /* Table Container */
    .review-table-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        overflow: hidden;
    }

    .review-table-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f2ecf1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .review-table-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #483C46;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Playfair Display', serif;
    }

    .review-table-subtitle {
        font-size: 12.5px;
        color: #6f626d;
        margin-top: 3px;
    }

    .clean-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .clean-table thead th {
        background: #faf8fa;
        color: #483C46;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 13px 20px;
        border-bottom: 1px solid #ede6e4;
        border-top: none;
        white-space: nowrap;
    }

    .clean-table tbody tr {
        background: #ffffff;
        border-bottom: 1px solid #f2ecf1;
        transition: background 0.15s ease;
    }

    .clean-table tbody tr:hover {
        background: #fcfbfa;
    }

    .clean-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f2ecf1;
        color: #483C46;
    }

    /* Badges */
    .status-pill {
        font-size: 11.5px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
        user-select: none;
    }

    .status-published {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .status-published:hover {
        background: #bbf7d0;
        color: #166534;
    }

    .status-hidden {
        background: #f8f1ee;
        color: #A36952;
        border: 1px solid #eedcd6;
    }

    .status-hidden:hover {
        background: #eedcd6;
        color: #8a5540;
    }

    .category-pill {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-transform: capitalize;
    }

    .cat-hair {
        background: #f4edf7;
        color: #592E83;
        border: 1px solid #dfcfeb;
    }

    .cat-facials {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
    }

    .cat-bridal {
        background: #fdf2f8;
        color: #db2777;
        border: 1px solid #fce7f3;
    }

    .cat-academy {
        background: #fefce8;
        color: #ca8a04;
        border: 1px solid #fef08a;
    }

    .cat-all {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    /* Star Visuals */
    .star-gold {
        color: #eab308;
        font-variation-settings: 'FILL' 1;
        font-size: 16px;
    }

    .star-muted {
        color: #cbd5e1;
        font-size: 16px;
    }

    /* Action Buttons */
    .btn-action-clean {
        width: 33px;
        height: 33px;
        border-radius: 8px;
        background: #ffffff;
        border: 1px solid #ede6e4;
        color: #483C46;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-action-clean:hover {
        background: #f4edf7;
        color: #592E83;
        border-color: #A36952;
    }

    .btn-action-clean.btn-edit:hover {
        background: #f4edf7;
        color: #592E83;
        border-color: #592E83;
    }

    .btn-action-clean.btn-delete:hover {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }

    /* Pagination */
    .review-pagination-bar {
        padding: 16px 24px;
        border-top: 1px solid #f2ecf1;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .pagination-link-clean {
        background: #ffffff;
        border: 1px solid #eedcd6;
        color: #483C46;
        border-radius: 8px;
        padding: 6px 13px;
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
    }

    .pagination-link-clean:hover {
        background: #f8f1ee;
        color: #A36952;
        border-color: #A36952;
    }

    .pagination-link-active {
        background: linear-gradient(135deg, #592E83, #48236d);
        color: #ffffff;
        border-radius: 8px;
        padding: 6px 13px;
        font-size: 12.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        border: none;
        box-shadow: 0 2px 6px rgba(89, 46, 131, 0.25);
    }

    /* Modals */
    .white-modal-content {
        background: #ffffff !important;
        border: 1px solid #ede6e4 !important;
        border-radius: 16px !important;
        box-shadow: 0 20px 35px -5px rgba(72, 60, 70, 0.18), 0 10px 15px -5px rgba(72, 60, 70, 0.08) !important;
        color: #483C46 !important;
        overflow: hidden;
    }

    .white-modal-header {
        background: #ffffff !important;
        border-bottom: 1px solid #f2ecf1 !important;
        padding: 18px 24px !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .white-modal-header .modal-title {
        color: #483C46 !important;
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
    }

    .white-modal-body {
        background: #ffffff !important;
        color: #483C46 !important;
        padding: 24px !important;
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

    .white-modal-footer {
        background: #faf8fa !important;
        border-top: 1px solid #f2ecf1 !important;
        padding: 16px 24px !important;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }

    .white-form-label {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #483C46;
        margin-bottom: 6px;
        display: block;
    }

    /* Interactive Stars Picker */
    .stars-picker {
        display: inline-flex;
        gap: 4px;
        cursor: pointer;
    }

    .stars-picker .star-item {
        font-size: 26px;
        color: #cbd5e1;
        transition: color 0.18s ease, transform 0.18s ease;
        user-select: none;
    }

    .stars-picker .star-item.active {
        color: #eab308;
        font-variation-settings: 'FILL' 1;
    }

    .stars-picker .star-item:hover {
        transform: scale(1.15);
    }
</style>

<!-- ==================== PAGE HEADER ==================== -->
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.65rem; color: #483C46; margin-bottom: 4px; font-weight: 600;">
            Patron Reviews &amp; Testimonials
        </h2>
        <p style="font-size: 13px; color: #6f626d; margin: 0;">
            Curate authentic guest testimonials, rating stars, category filters, and live publishing statuses for the frontend website.
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('review') ?>" target="_blank" class="btn-clean-secondary">
            <span class="material-symbols-outlined" style="font-size: 18px;">open_in_new</span>
            View Live Reviews
        </a>
        <button type="button" class="btn-clean-primary" onclick="openAddReviewModal()">
            <span class="material-symbols-outlined" style="font-size: 19px;">rate_review</span>
            Add Review
        </button>
    </div>
</div>

<!-- ==================== OVERVIEW METRICS CARDS ==================== -->
<div class="row g-3 mb-4">
    <!-- Total Reviews -->
    <div class="col-xl-3 col-sm-6">
        <div class="review-metric-card">
            <div>
                <div class="metric-label-clean" style="color: #6f626d;">
                    Total Reviews
                </div>
                <div class="metric-value-clean">
                    <?= number_format($stats['total'] ?? 0) ?>
                </div>
            </div>
            <div class="metric-icon-clean" style="background: #f4edf7; color: #592E83; border: 1px solid #dfcfeb;">
                <span class="material-symbols-outlined">reviews</span>
            </div>
        </div>
    </div>

    <!-- Published / Live -->
    <div class="col-xl-3 col-sm-6">
        <div class="review-metric-card">
            <div>
                <div class="metric-label-clean" style="color: #16a34a;">
                    Published (Live)
                </div>
                <div class="metric-value-clean">
                    <?= number_format($stats['published'] ?? 0) ?>
                </div>
            </div>
            <div class="metric-icon-clean" style="background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7;">
                <span class="material-symbols-outlined">verified</span>
            </div>
        </div>
    </div>

    <!-- Hidden / Drafts -->
    <div class="col-xl-3 col-sm-6">
        <div class="review-metric-card">
            <div>
                <div class="metric-label-clean" style="color: #A36952;">
                    Hidden / Drafts
                </div>
                <div class="metric-value-clean">
                    <?= number_format($stats['hidden'] ?? 0) ?>
                </div>
            </div>
            <div class="metric-icon-clean" style="background: #f8f1ee; color: #A36952; border: 1px solid #eedcd6;">
                <span class="material-symbols-outlined">visibility_off</span>
            </div>
        </div>
    </div>

    <!-- Average Rating -->
    <div class="col-xl-3 col-sm-6">
        <div class="review-metric-card">
            <div>
                <div class="metric-label-clean" style="color: #eab308;">
                    Average Rating
                </div>
                <div class="metric-value-clean" style="display: flex; align-items: baseline; gap: 4px;">
                    <?= esc($stats['average'] ?? '5.00') ?>
                    <span style="font-size: 13px; color: #988b97; font-weight: 500;">/ 5.0</span>
                </div>
            </div>
            <div class="metric-icon-clean" style="background: #fefce8; color: #ca8a04; border: 1px solid #fef08a;">
                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">star</span>
            </div>
        </div>
    </div>
</div>

<!-- ==================== SEARCH & FILTER TOOLBAR ==================== -->
<div class="review-filter-toolbar">
    <form action="<?= base_url('admin/website/reviews') ?>" method="GET" class="row g-3 align-items-center">
        <!-- Search Input -->
        <div class="col-md-4">
            <div class="position-relative">
                <span class="material-symbols-outlined position-absolute" style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 19px; color: #988b97; pointer-events: none;">
                    search
                </span>
                <input type="text" name="search" class="form-control clean-input" style="padding-left: 42px !important;" 
                       placeholder="Search patron name, headline, text, service..." value="<?= esc($search ?? '') ?>" />
            </div>
        </div>

        <!-- Status Filter Dropdown -->
        <div class="col-md-2">
            <select name="status" class="form-select clean-select" style="cursor: pointer;">
                <option value="all" <?= ($statusFilter === null || $statusFilter === '' || $statusFilter === 'all') ? 'selected' : '' ?>>All Statuses</option>
                <option value="published" <?= ($statusFilter === 'published') ? 'selected' : '' ?>>Published Only</option>
                <option value="hidden" <?= ($statusFilter === 'hidden') ? 'selected' : '' ?>>Hidden Only</option>
            </select>
        </div>

        <!-- Category Filter Dropdown -->
        <div class="col-md-3">
            <select name="category" class="form-select clean-select" style="cursor: pointer;">
                <option value="all" <?= ($categoryFilter === null || $categoryFilter === '' || $categoryFilter === 'all') ? 'selected' : '' ?>>All Categories</option>
                <option value="hair" <?= ($categoryFilter === 'hair') ? 'selected' : '' ?>>Hair Alchemy</option>
                <option value="facials" <?= ($categoryFilter === 'facials') ? 'selected' : '' ?>>Clinical Facials</option>
                <option value="bridal" <?= ($categoryFilter === 'bridal') ? 'selected' : '' ?>>Haute Bridal</option>
                <option value="academy" <?= ($categoryFilter === 'academy') ? 'selected' : '' ?>>Academy Alumni</option>
            </select>
        </div>

        <!-- Rating Filter Dropdown -->
        <div class="col-md-3 d-flex align-items-center gap-2">
            <select name="rating" class="form-select clean-select" style="cursor: pointer;">
                <option value="all" <?= ($ratingFilter === null || $ratingFilter === '' || $ratingFilter === 'all') ? 'selected' : '' ?>>All Ratings</option>
                <option value="5" <?= ($ratingFilter === 5) ? 'selected' : '' ?>>5 Stars ★★★★★</option>
                <option value="4" <?= ($ratingFilter === 4) ? 'selected' : '' ?>>4 Stars ★★★★☆</option>
                <option value="3" <?= ($ratingFilter === 3) ? 'selected' : '' ?>>3 Stars ★★★☆☆</option>
                <option value="2" <?= ($ratingFilter === 2) ? 'selected' : '' ?>>2 Stars ★★☆☆☆</option>
                <option value="1" <?= ($ratingFilter === 1) ? 'selected' : '' ?>>1 Star ★☆☆☆☆</option>
            </select>

            <button type="submit" class="btn-clean-primary" style="height: 42px; padding: 0 16px;">
                <span class="material-symbols-outlined" style="font-size: 18px;">filter_list</span>
            </button>
            <?php if (!empty($search) || ($statusFilter !== null && $statusFilter !== 'all') || ($categoryFilter !== null && $categoryFilter !== 'all') || ($ratingFilter !== null && $ratingFilter !== 'all')): ?>
                <a href="<?= base_url('admin/website/reviews') ?>" class="btn-clean-secondary" title="Reset filters">
                    <span class="material-symbols-outlined" style="font-size: 18px;">restart_alt</span>
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- ==================== REVIEWS DIRECTORY TABLE ==================== -->
<div class="review-table-card">
    <div class="review-table-header">
        <div>
            <h3 class="review-table-title">
                <span class="material-symbols-outlined" style="color: #592E83; font-size: 24px;">rate_review</span>
                Patron Review Folio
            </h3>
            <div class="review-table-subtitle">All reviews stored in the database. Published reviews are visible on the frontend review page.</div>
        </div>
        <div style="font-size: 12.5px; color: #6f626d;">
            Matching Records: <strong style="color: #483C46; font-weight: 700;"><?= number_format($totalMatching ?? 0) ?></strong>
        </div>
    </div>

    <div class="table-responsive">
        <table class="clean-table align-middle">
            <thead>
                <tr>
                    <th style="padding-left: 24px;">Patron</th>
                    <th>Rating</th>
                    <th>Review Content</th>
                    <th>Category &amp; Service</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th style="padding-right: 24px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($reviews)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; color: #6f626d;">
                                <div style="width: 54px; height: 54px; border-radius: 50%; background: #fcfbfa; border: 1px solid #ede6e4; display: flex; align-items: center; justify-content: center;">
                                    <span class="material-symbols-outlined" style="font-size: 28px; color: #988b97;">reviews</span>
                                </div>
                                <div style="font-size: 14px; font-weight: 600; color: #483C46;">No review records found</div>
                                <div style="font-size: 12.5px; color: #6f626d;">Try adjusting your search criteria or add a new patron review.</div>
                                <button type="button" class="btn-clean-primary mt-2" onclick="openAddReviewModal()">
                                    <span class="material-symbols-outlined" style="font-size: 17px;">rate_review</span>
                                    Add New Review
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($reviews as $r): ?>
                        <?php 
                            $rRating = max(1, min(5, (int) ($r['rating'] ?? 5)));
                            $rCat = strtolower(trim((string) ($r['category'] ?? 'all')));
                            $initials = strtoupper(substr($r['customer_name'] ?? 'GP', 0, 2));
                        ?>
                        <tr>
                            <!-- PATRON AVATAR & NAME -->
                            <td style="padding-left: 24px;">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 42px; height: 42px; border-radius: 50%; overflow: hidden; background: #f4edf7; border: 1px solid #dfcfeb; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <?php if (!empty($r['customer_photo'])): ?>
                                            <img src="<?= esc(base_url($r['customer_photo'])) ?>" alt="<?= esc($r['customer_name']) ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                                        <?php else: ?>
                                            <span style="font-size: 13.5px; font-weight: 700; color: #592E83;">
                                                <?= esc($initials) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: #483C46; font-size: 13.5px; line-height: 1.3;">
                                            <?= esc($r['customer_name']) ?>
                                        </div>
                                        <div style="font-size: 11px; color: #6f626d; margin-top: 2px;">
                                            <span><?= esc($r['location'] ?? 'Madurai') ?></span>
                                            <?php if (!empty($r['phone'])): ?>
                                                • <code><?= esc($r['phone']) ?></code>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- RATING -->
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <?php for ($s = 1; $s <= 5; $s++): ?>
                                        <span class="material-symbols-outlined <?= $s <= $rRating ? 'star-gold' : 'star-muted' ?>">star</span>
                                    <?php endfor; ?>
                                    <span style="font-size: 12px; font-weight: 700; color: #483C46; margin-left: 4px;">
                                        <?= number_format($rRating, 1) ?>
                                    </span>
                                </div>
                            </td>

                            <!-- REVIEW HEADLINE & SNIPPET -->
                            <td style="max-width: 320px;">
                                <?php if (!empty($r['headline'])): ?>
                                    <div style="font-weight: 600; color: #483C46; font-size: 13px; line-height: 1.3; margin-bottom: 3px;">
                                        "<?= esc($r['headline']) ?>"
                                    </div>
                                <?php endif; ?>
                                <div style="font-size: 12px; color: #6f626d; line-height: 1.45; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?= esc($r['review_text']) ?>
                                </div>
                            </td>

                            <!-- CATEGORY & SERVICE -->
                            <td>
                                <div>
                                    <span class="category-pill cat-<?= esc($rCat) ?>">
                                        <?= esc($r['category'] ?? 'all') ?>
                                    </span>
                                </div>
                                <div style="font-size: 11.5px; color: #6f626d; margin-top: 4px;">
                                    <?= esc($r['service_name'] ?? 'Bespoke Experience') ?>
                                </div>
                                <?php if (!empty($r['specialist_name'])): ?>
                                    <div style="font-size: 10.5px; color: #A36952;">
                                        By: <?= esc($r['specialist_name']) ?>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <!-- STATUS (AJAX TOGGLE) -->
                            <td>
                                <?php if (($r['status'] ?? 'published') === 'published'): ?>
                                    <button type="button" class="btn p-0 border-0" onclick="toggleReviewStatus(<?= $r['id'] ?>, this)" title="Click to hide review">
                                        <span class="status-pill status-published">
                                            <span class="material-symbols-outlined" style="font-size: 13px;">check_circle</span>
                                            Published
                                        </span>
                                    </button>
                                <?php else: ?>
                                    <button type="button" class="btn p-0 border-0" onclick="toggleReviewStatus(<?= $r['id'] ?>, this)" title="Click to publish review">
                                        <span class="status-pill status-hidden">
                                            <span class="material-symbols-outlined" style="font-size: 13px;">visibility_off</span>
                                            Hidden
                                        </span>
                                    </button>
                                <?php endif; ?>
                            </td>

                            <!-- DATE -->
                            <td>
                                <div style="font-size: 12.5px; color: #483C46; font-weight: 500;">
                                    <?= !empty($r['created_at']) ? date('M d, Y', strtotime($r['created_at'])) : '—' ?>
                                </div>
                                <div style="font-size: 11px; color: #988b97; margin-top: 2px;">
                                    <?= !empty($r['created_at']) ? date('h:i A', strtotime($r['created_at'])) : '' ?>
                                </div>
                            </td>

                            <!-- ACTIONS -->
                            <td style="padding-right: 24px; text-align: right;">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <!-- VIEW DETAILS -->
                                    <button type="button" class="btn-action-clean" 
                                            onclick="viewReviewDetails(<?= $r['id'] ?>)" title="View Full Review Details">
                                        <span class="material-symbols-outlined" style="font-size: 17px;">visibility</span>
                                    </button>

                                    <!-- EDIT -->
                                    <button type="button" class="btn-action-clean btn-edit" 
                                            onclick='openEditReviewModal(<?= json_encode($r, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)' title="Edit Review">
                                        <span class="material-symbols-outlined" style="font-size: 17px;">edit</span>
                                    </button>

                                    <!-- DELETE -->
                                    <button type="button" class="btn-action-clean btn-delete" 
                                            onclick="confirmDeleteReview(<?= $r['id'] ?>, '<?= esc(addslashes($r['customer_name'])) ?>')" title="Delete Review">
                                        <span class="material-symbols-outlined" style="font-size: 17px;">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION BAR -->
    <?php if (($totalPages ?? 1) > 1): ?>
        <div class="review-pagination-bar">
            <div style="font-size: 12.5px; color: #6f626d;">
                Showing Page <strong style="color: #483C46;"><?= $currentPage ?></strong> of <strong style="color: #483C46;"><?= $totalPages ?></strong>
            </div>
            <div class="d-flex align-items-center gap-1">
                <?php if ($currentPage > 1): ?>
                    <a href="<?= base_url('admin/website/reviews?page=' . ($currentPage - 1) . '&search=' . urlencode($search ?? '') . '&status=' . urlencode($statusFilter ?? '') . '&category=' . urlencode($categoryFilter ?? '') . '&rating=' . urlencode((string)($ratingFilter ?? ''))) ?>" 
                       class="pagination-link-clean">
                        Previous
                    </a>
                <?php endif; ?>

                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <?php if ($p === $currentPage): ?>
                        <span class="pagination-link-active">
                            <?= $p ?>
                        </span>
                    <?php elseif ($p == 1 || $p == $totalPages || abs($p - $currentPage) <= 2): ?>
                        <a href="<?= base_url('admin/website/reviews?page=' . $p . '&search=' . urlencode($search ?? '') . '&status=' . urlencode($statusFilter ?? '') . '&category=' . urlencode($categoryFilter ?? '') . '&rating=' . urlencode((string)($ratingFilter ?? ''))) ?>" 
                           class="pagination-link-clean">
                            <?= $p ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= base_url('admin/website/reviews?page=' . ($currentPage + 1) . '&search=' . urlencode($search ?? '') . '&status=' . urlencode($statusFilter ?? '') . '&category=' . urlencode($categoryFilter ?? '') . '&rating=' . urlencode((string)($ratingFilter ?? ''))) ?>" 
                       class="pagination-link-clean">
                        Next
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- ==================== MODAL: ADD / EDIT REVIEW ==================== -->
<div class="modal fade" id="reviewFormModal" tabindex="-1" aria-labelledby="reviewFormModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content white-modal-content">
            <div class="white-modal-header">
                <h5 class="modal-title" id="reviewFormModalTitle">
                    Add Patron Review
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url('admin/website/reviews/save') ?>" method="POST" enctype="multipart/form-data" id="reviewForm">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="formReviewId" value="0" />
                <input type="hidden" name="remove_photo" id="formRemovePhoto" value="0" />

                <div class="white-modal-body">
                    <div class="row g-3">
                        <!-- CUSTOMER NAME -->
                        <div class="col-md-6">
                            <label class="white-form-label">Customer Name *</label>
                            <input type="text" name="customer_name" id="formCustomerName" class="form-control clean-input" 
                                   placeholder="e.g. Sneha Parthiban" required />
                        </div>

                        <!-- RATING SELECTOR -->
                        <div class="col-md-6">
                            <label class="white-form-label">Star Rating *</label>
                            <div class="d-flex align-items-center gap-3 mt-1">
                                <div class="stars-picker" id="modalStarsPicker">
                                    <span class="material-symbols-outlined star-item active" data-val="1">star</span>
                                    <span class="material-symbols-outlined star-item active" data-val="2">star</span>
                                    <span class="material-symbols-outlined star-item active" data-val="3">star</span>
                                    <span class="material-symbols-outlined star-item active" data-val="4">star</span>
                                    <span class="material-symbols-outlined star-item active" data-val="5">star</span>
                                </div>
                                <input type="hidden" name="rating" id="formReviewRating" value="5" />
                                <span id="formRatingLabel" style="font-size: 13px; font-weight: 700; color: #592E83;">5.0 Stars</span>
                            </div>
                        </div>

                        <!-- HEADLINE -->
                        <div class="col-12">
                            <label class="white-form-label">Review Headline</label>
                            <input type="text" name="headline" id="formReviewHeadline" class="form-control clean-input" 
                                   placeholder='e.g. "A royal experience that stayed flawless for 14 hours!"' />
                        </div>

                        <!-- REVIEW TEXT -->
                        <div class="col-12">
                            <label class="white-form-label">Review Experience Content *</label>
                            <textarea name="review_text" id="formReviewText" class="form-control" rows="4" 
                                      style="border: 1px solid #d5ccd3; border-radius: 10px; font-size: 13.5px; padding: 12px; color: #483C46;"
                                      placeholder="Detailed patron reflection, practitioner attention, longevity, and overall results..." required></textarea>
                        </div>

                        <!-- SERVICE NAME -->
                        <div class="col-md-6">
                            <label class="white-form-label">Service Received</label>
                            <input type="text" name="service_name" id="formServiceName" class="form-control clean-input" 
                                   placeholder="e.g. Couture Royal Bridal Package" />
                        </div>

                        <!-- CATEGORY -->
                        <div class="col-md-6">
                            <label class="white-form-label">Category</label>
                            <select name="category" id="formReviewCategory" class="form-select clean-select">
                                <option value="all">All / General</option>
                                <option value="hair">Hair Alchemy</option>
                                <option value="facials">Clinical Facials</option>
                                <option value="bridal">Haute Bridal</option>
                                <option value="academy">Academy Alumni</option>
                            </select>
                        </div>

                        <!-- SPECIALIST NAME -->
                        <div class="col-md-6">
                            <label class="white-form-label">Master Practitioner Attended</label>
                            <input type="text" name="specialist_name" id="formSpecialistName" class="form-control clean-input" 
                                   placeholder="e.g. Priya Chandran / Dr. Elena Ross" />
                        </div>

                        <!-- LOCATION -->
                        <div class="col-md-6">
                            <label class="white-form-label">Guest Location / Badge</label>
                            <input type="text" name="location" id="formReviewLocation" class="form-control clean-input" 
                                   placeholder="e.g. Madurai / Chennai" value="Madurai" />
                        </div>

                        <!-- PHONE -->
                        <div class="col-md-6">
                            <label class="white-form-label">Phone Number (Verification)</label>
                            <input type="tel" name="phone" id="formReviewPhone" class="form-control clean-input" 
                                   placeholder="+91 98765 43210" />
                        </div>

                        <!-- STATUS -->
                        <div class="col-md-6">
                            <label class="white-form-label">Publishing Status</label>
                            <select name="status" id="formReviewStatus" class="form-select clean-select">
                                <option value="published">Published (Visible on live website)</option>
                                <option value="hidden">Hidden / Draft (Only visible in admin)</option>
                            </select>
                        </div>

                        <!-- SORT ORDER -->
                        <div class="col-md-6">
                            <label class="white-form-label">Sort Order (Lower appears first)</label>
                            <input type="number" name="sort_order" id="formReviewSortOrder" class="form-control clean-input" 
                                   value="0" min="0" />
                        </div>

                        <!-- CUSTOMER PHOTO UPLOAD -->
                        <div class="col-md-6">
                            <label class="white-form-label">Customer Photo (Optional)</label>
                            <input type="file" name="customer_photo" id="formCustomerPhoto" class="form-control clean-input" 
                                   accept="image/*" onchange="previewReviewPhoto(event)" />
                            <div id="currentPhotoContainer" class="mt-2 d-flex align-items-center gap-2" style="display: none !important;">
                                <img id="currentPhotoImg" src="" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 1px solid #dfcfeb;" />
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeCurrentPhoto()">
                                    Remove Photo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="white-modal-footer">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">
                        <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                        <span id="formSubmitBtnText">Save Review</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================== MODAL: VIEW REVIEW DETAILS ==================== -->
<div class="modal fade" id="reviewDetailsModal" tabindex="-1" aria-labelledby="reviewDetailsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content white-modal-content">
            <div class="white-modal-header">
                <h5 class="modal-title" id="reviewDetailsModalTitle">
                    Patron Testimonial Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="white-modal-body" id="detailsModalBody">
                <div class="text-center py-4">
                    <div class="spinner-border" style="color: #592E83;" role="status"></div>
                </div>
            </div>

            <div class="white-modal-footer">
                <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ==================== MODAL: DELETE CONFIRMATION ==================== -->
<div class="modal fade" id="reviewDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content white-modal-content">
            <div class="white-modal-body text-center pt-4 pb-3">
                <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; border: 1px solid #fee2e2; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                    <span class="material-symbols-outlined" style="color: #dc2626; font-size: 28px;">delete</span>
                </div>
                <h5 style="font-family: 'Playfair Display', serif; color: #483C46; font-weight: 700; margin-bottom: 8px;">Delete Review?</h5>
                <p style="font-size: 13px; color: #6f626d; line-height: 1.5; margin-bottom: 0;" id="deleteConfirmText">
                    Are you sure you want to delete this patron review? This will remove it from the frontend website.
                </p>
            </div>

            <div class="white-modal-footer justify-content-center">
                <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteConfirmBtn" class="btn" style="background: #dc2626; color: #ffffff; font-weight: 600; font-size: 13px; border-radius: 10px; padding: 9px 20px; border: none; box-shadow: 0 2px 8px rgba(220, 38, 38, 0.25);">
                    Delete
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ==================== SCRIPTS ==================== -->
<script>
    let formModalInstance = null;
    let detailsModalInstance = null;
    let deleteModalInstance = null;

    function getFormModal() {
        if (!formModalInstance) {
            formModalInstance = new bootstrap.Modal(document.getElementById('reviewFormModal'));
        }
        return formModalInstance;
    }

    function getDetailsModal() {
        if (!detailsModalInstance) {
            detailsModalInstance = new bootstrap.Modal(document.getElementById('reviewDetailsModal'));
        }
        return detailsModalInstance;
    }

    function getDeleteModal() {
        if (!deleteModalInstance) {
            deleteModalInstance = new bootstrap.Modal(document.getElementById('reviewDeleteModal'));
        }
        return deleteModalInstance;
    }

    // Modal Star Rating Interactive Picker
    const starItems = document.querySelectorAll('#modalStarsPicker .star-item');
    const ratingInput = document.getElementById('formReviewRating');
    const ratingLabel = document.getElementById('formRatingLabel');

    starItems.forEach(star => {
        star.addEventListener('click', () => {
            const val = parseInt(star.getAttribute('data-val'));
            setModalRating(val);
        });
    });

    function setModalRating(val) {
        ratingInput.value = val;
        ratingLabel.innerText = val + '.0 Stars';
        starItems.forEach(s => {
            const sVal = parseInt(s.getAttribute('data-val'));
            if (sVal <= val) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });
    }

    // Open Add Review Modal
    function openAddReviewModal() {
        document.getElementById('reviewFormModalTitle').innerText = 'Add Patron Review';
        document.getElementById('formReviewId').value = '0';
        document.getElementById('formRemovePhoto').value = '0';
        document.getElementById('formCustomerName').value = '';
        document.getElementById('formReviewHeadline').value = '';
        document.getElementById('formReviewText').value = '';
        document.getElementById('formServiceName').value = '';
        document.getElementById('formReviewCategory').value = 'all';
        document.getElementById('formSpecialistName').value = '';
        document.getElementById('formReviewLocation').value = 'Madurai';
        document.getElementById('formReviewPhone').value = '';
        document.getElementById('formReviewStatus').value = 'published';
        document.getElementById('formReviewSortOrder').value = '0';
        document.getElementById('formCustomerPhoto').value = '';
        document.getElementById('currentPhotoContainer').style.setProperty('display', 'none', 'important');
        document.getElementById('formSubmitBtnText').innerText = 'Save Review';

        setModalRating(5);
        getFormModal().show();
    }

    // Open Edit Review Modal
    function openEditReviewModal(r) {
        document.getElementById('reviewFormModalTitle').innerText = 'Edit Patron Review';
        document.getElementById('formReviewId').value = r.id;
        document.getElementById('formRemovePhoto').value = '0';
        document.getElementById('formCustomerName').value = r.customer_name || '';
        document.getElementById('formReviewHeadline').value = r.headline || '';
        document.getElementById('formReviewText').value = r.review_text || '';
        document.getElementById('formServiceName').value = r.service_name || '';
        document.getElementById('formReviewCategory').value = r.category || 'all';
        document.getElementById('formSpecialistName').value = r.specialist_name || '';
        document.getElementById('formReviewLocation').value = r.location || 'Madurai';
        document.getElementById('formReviewPhone').value = r.phone || '';
        document.getElementById('formReviewStatus').value = r.status || 'published';
        document.getElementById('formReviewSortOrder').value = r.sort_order || '0';
        document.getElementById('formCustomerPhoto').value = '';

        setModalRating(parseInt(r.rating) || 5);

        const currentPhotoContainer = document.getElementById('currentPhotoContainer');
        const currentPhotoImg = document.getElementById('currentPhotoImg');
        if (r.customer_photo) {
            currentPhotoImg.src = '<?= base_url() ?>/' + r.customer_photo;
            currentPhotoContainer.style.removeProperty('display');
        } else {
            currentPhotoContainer.style.setProperty('display', 'none', 'important');
        }

        document.getElementById('formSubmitBtnText').innerText = 'Save Changes';
        getFormModal().show();
    }

    function previewReviewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const currentPhotoContainer = document.getElementById('currentPhotoContainer');
                const currentPhotoImg = document.getElementById('currentPhotoImg');
                currentPhotoImg.src = e.target.result;
                currentPhotoContainer.style.removeProperty('display');
                document.getElementById('formRemovePhoto').value = '0';
            };
            reader.readAsDataURL(file);
        }
    }

    function removeCurrentPhoto() {
        document.getElementById('formRemovePhoto').value = '1';
        document.getElementById('formCustomerPhoto').value = '';
        document.getElementById('currentPhotoContainer').style.setProperty('display', 'none', 'important');
    }

    // View Review Details via AJAX
    function viewReviewDetails(reviewId) {
        const bodyEl = document.getElementById('detailsModalBody');
        bodyEl.innerHTML = '<div class="text-center py-4"><div class="spinner-border" style="color: #592E83;" role="status"></div></div>';
        getDetailsModal().show();

        fetch('<?= base_url('admin/website/reviews/details') ?>/' + reviewId)
            .then(res => res.json())
            .then(data => {
                if (!data.status || !data.review) {
                    bodyEl.innerHTML = '<div class="alert alert-danger mb-0">Failed to load review details.</div>';
                    return;
                }

                const r = data.review;
                const statusBadge = (r.status === 'published')
                    ? '<span class="status-pill status-published"><span class="material-symbols-outlined" style="font-size: 13px;">check_circle</span> Published</span>'
                    : '<span class="status-pill status-hidden"><span class="material-symbols-outlined" style="font-size: 13px;">visibility_off</span> Hidden</span>';

                let starsHtml = '';
                const rScore = parseInt(r.rating) || 5;
                for (let i = 1; i <= 5; i++) {
                    starsHtml += `<span class="material-symbols-outlined ${i <= rScore ? 'star-gold' : 'star-muted'}" style="font-size: 18px;">star</span>`;
                }

                const avatarHtml = r.customer_photo
                    ? `<img src="<?= base_url() ?>/${r.customer_photo}" style="width: 72px; height: 72px; border-radius: 50%; object-fit: cover; border: 3px solid #dfcfeb; box-shadow: 0 4px 12px rgba(89, 46, 131, 0.18);" />`
                    : `<div style="width: 72px; height: 72px; border-radius: 50%; background: #f4edf7; border: 3px solid #dfcfeb; display: inline-flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 700; color: #592E83;">${(r.customer_name || 'GP').substring(0,2).toUpperCase()}</div>`;

                bodyEl.innerHTML = `
                    <div class="text-center mb-4">
                        ${avatarHtml}
                        <h4 class="mt-2 mb-1" style="font-family: 'Playfair Display', serif; color: #483C46; font-weight: 700;">${escapeHtml(r.customer_name)}</h4>
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-1">
                            ${statusBadge}
                            <span class="category-pill cat-${r.category || 'all'}">${r.category || 'all'}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-1 mt-2">
                            ${starsHtml}
                            <span class="ms-1 fw-bold" style="color: #483C46; font-size: 13px;">${rScore}.0</span>
                        </div>
                    </div>

                    ${r.headline ? `
                        <div class="p-3 mb-3" style="background: #f4edf7; border-left: 4px solid #592E83; border-radius: 8px;">
                            <div style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 14.5px; color: #483C46;">
                                "${escapeHtml(r.headline)}"
                            </div>
                        </div>
                    ` : ''}

                    <div class="p-3 mb-3" style="background: #faf8fa; border: 1px solid #ede6e4; border-radius: 12px; font-size: 13.5px; line-height: 1.6; color: #483C46;">
                        ${escapeHtml(r.review_text).replace(/\n/g, '<br>')}
                    </div>

                    <div style="background: #ffffff; border-radius: 12px; border: 1px solid #ede6e4; padding: 16px;">
                        <div class="row g-3" style="font-size: 12.5px;">
                            <div class="col-6">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Service Name</div>
                                <div style="color: #483C46; font-weight: 600;">${escapeHtml(r.service_name || 'Bespoke Experience')}</div>
                            </div>
                            <div class="col-6">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Practitioner</div>
                                <div style="color: #483C46; font-weight: 600;">${escapeHtml(r.specialist_name || 'Sanctuary Team')}</div>
                            </div>
                            <div class="col-6">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Location / City</div>
                                <div style="color: #483C46; font-weight: 600;">${escapeHtml(r.location || 'Madurai')}</div>
                            </div>
                            <div class="col-6">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Phone Number</div>
                                <div style="color: #483C46; font-weight: 600;">${escapeHtml(r.phone || 'None provided')}</div>
                            </div>
                            <div class="col-6">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Sort Order</div>
                                <div style="color: #483C46; font-weight: 600;">${r.sort_order || 0}</div>
                            </div>
                            <div class="col-6">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Created Date</div>
                                <div style="color: #483C46; font-weight: 600;">${r.created_at || '—'}</div>
                            </div>
                        </div>
                    </div>
                `;
            })
            .catch(err => {
                bodyEl.innerHTML = '<div class="alert alert-danger mb-0">Error communicating with server.</div>';
            });
    }

    // Toggle Review Status via AJAX
    function toggleReviewStatus(reviewId, btnElement) {
        fetch('<?= base_url('admin/website/reviews/toggle-status') ?>/' + reviewId, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                if (data.new_status === 'published') {
                    btnElement.innerHTML = `
                        <span class="status-pill status-published">
                            <span class="material-symbols-outlined" style="font-size: 13px;">check_circle</span>
                            Published
                        </span>
                    `;
                    btnElement.title = 'Click to hide review';
                } else {
                    btnElement.innerHTML = `
                        <span class="status-pill status-hidden">
                            <span class="material-symbols-outlined" style="font-size: 13px;">visibility_off</span>
                            Hidden
                        </span>
                    `;
                    btnElement.title = 'Click to publish review';
                }
                if (typeof showGlowToast === 'function') {
                    showGlowToast(data.message, 'success', 'Status Updated');
                }
            } else {
                if (typeof showGlowToast === 'function') {
                    showGlowToast(data.message || 'Failed to update status', 'error', 'Error');
                }
            }
        })
        .catch(err => {
            if (typeof showGlowToast === 'function') {
                showGlowToast('Failed to update review status', 'error', 'Error');
            }
        });
    }

    // Confirm Delete Review Modal
    function confirmDeleteReview(reviewId, customerName) {
        document.getElementById('deleteConfirmText').innerHTML = `Are you sure you want to delete review from <strong>${escapeHtml(customerName)}</strong>? This will remove it from the live website.`;
        document.getElementById('deleteConfirmBtn').href = '<?= base_url('admin/website/reviews/delete') ?>/' + reviewId;
        getDeleteModal().show();
    }

    // Helper: escape HTML
    function escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.toString().replace(/[&<>"']/g, function(m) { return map[m]; });
    }
</script>

<?= $this->endSection() ?>
