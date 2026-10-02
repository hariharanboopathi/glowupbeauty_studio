<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<style>
    /* ==========================================================================
       CLEAN WHITE-BASED ADMIN UI - CUSTOMER MANAGEMENT
       ========================================================================== */

    /* White Cards & Panels */
    .white-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.05), 0 1px 2px rgba(72, 60, 70, 0.03);
    }

    /* Metric Stat Cards */
    .customer-metric-card {
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

    .customer-metric-card:hover {
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
    .customer-filter-toolbar {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        padding: 16px 20px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        margin-bottom: 24px;
    }

    /* Form Controls on White Theme */
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

    /* White Table */
    .customer-table-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        overflow: hidden;
    }

    .customer-table-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f2ecf1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .customer-table-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #483C46;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Playfair Display', serif;
    }

    .customer-table-subtitle {
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

    .status-active {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .status-active:hover {
        background: #bbf7d0;
        color: #166534;
    }

    .status-inactive {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .status-inactive:hover {
        background: #fecaca;
        color: #991b1b;
    }

    .provider-pill {
        font-size: 11.5px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }

    .provider-google {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }

    .provider-local {
        background: #f4edf7;
        color: #592E83;
        border: 1px solid #dfcfeb;
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
    .customer-pagination-bar {
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

    /* Modals - Clean White Design */
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
</style>

<!-- ==================== PAGE HEADER ==================== -->
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.65rem; color: var(--text-main); margin-bottom: 4px; font-weight: 600;">
            Customer &amp; Patron Management
        </h2>
        <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
            Manage client directory, authentication providers, membership statuses, and credentials.
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn-clean-primary" onclick="openAddCustomerModal()">
            <span class="material-symbols-outlined" style="font-size: 19px;">person_add</span>
            Add Customer
        </button>
    </div>
</div>

<!-- ==================== OVERVIEW METRICS CARDS (WHITE) ==================== -->
<div class="row g-3 mb-4">
    <!-- Total Customers -->
    <div class="col-xl-3 col-sm-6">
        <div class="customer-metric-card">
            <div>
                <div class="metric-label-clean" style="color: #64748b;">
                    Total Customers
                </div>
                <div class="metric-value-clean">
                    <?= number_format($stats['total'] ?? 0) ?>
                </div>
            </div>
            <div class="metric-icon-clean" style="background: #f4edf7; color: #592E83; border: 1px solid #dfcfeb;">
                <span class="material-symbols-outlined">group</span>
            </div>
        </div>
    </div>

    <!-- Active Patrons -->
    <div class="col-xl-3 col-sm-6">
        <div class="customer-metric-card">
            <div>
                <div class="metric-label-clean" style="color: #16a34a;">
                    Active Patrons
                </div>
                <div class="metric-value-clean">
                    <?= number_format($stats['active'] ?? 0) ?>
                </div>
            </div>
            <div class="metric-icon-clean" style="background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7;">
                <span class="material-symbols-outlined">verified</span>
            </div>
        </div>
    </div>

    <!-- Suspended / Inactive -->
    <div class="col-xl-3 col-sm-6">
        <div class="customer-metric-card">
            <div>
                <div class="metric-label-clean" style="color: #dc2626;">
                    Suspended / Inactive
                </div>
                <div class="metric-value-clean">
                    <?= number_format($stats['inactive'] ?? 0) ?>
                </div>
            </div>
            <div class="metric-icon-clean" style="background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2;">
                <span class="material-symbols-outlined">block</span>
            </div>
        </div>
    </div>

    <!-- Google Verified -->
    <div class="col-xl-3 col-sm-6">
        <div class="customer-metric-card">
            <div>
                <div class="metric-label-clean" style="color: #2563eb;">
                    Google Verified
                </div>
                <div class="metric-value-clean">
                    <?= number_format($stats['google'] ?? 0) ?>
                </div>
            </div>
            <div class="metric-icon-clean" style="background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe;">
                <span class="material-symbols-outlined">token</span>
            </div>
        </div>
    </div>
</div>

<!-- ==================== SEARCH & FILTER TOOLBAR (WHITE) ==================== -->
<div class="customer-filter-toolbar">
    <form action="<?= base_url('admin/website/customer') ?>" method="GET" class="row g-3 align-items-center">
        <!-- Search Input -->
        <div class="col-md-5">
            <div class="position-relative">
                <span class="material-symbols-outlined position-absolute" style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 19px; color: #988b97; pointer-events: none;">
                    search
                </span>
                <input type="text" name="search" class="form-control clean-input" style="padding-left: 42px !important;" 
                       placeholder="Search by customer name, email, or phone..." value="<?= esc($search ?? '') ?>" />
            </div>
        </div>

        <!-- Status Filter Dropdown -->
        <div class="col-md-3">
            <select name="status" class="form-select clean-select" style="cursor: pointer;">
                <option value="all" <?= ($statusFilter === null || $statusFilter === '' || $statusFilter === 'all') ? 'selected' : '' ?>>All Statuses</option>
                <option value="1" <?= ($statusFilter === '1') ? 'selected' : '' ?>>Active Only</option>
                <option value="0" <?= ($statusFilter === '0') ? 'selected' : '' ?>>Inactive Only</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="col-md-4 d-flex align-items-center gap-2">
            <button type="submit" class="btn-clean-primary" style="height: 42px; padding: 0 20px;">
                <span class="material-symbols-outlined" style="font-size: 18px;">filter_list</span>
                Filter
            </button>
            <?php if (!empty($search) || ($statusFilter !== null && $statusFilter !== '' && $statusFilter !== 'all')): ?>
                <a href="<?= base_url('admin/website/customer') ?>" class="btn-clean-secondary" title="Reset filters">
                    <span class="material-symbols-outlined" style="font-size: 18px;">restart_alt</span>
                    Reset
                </a>
            <?php endif; ?>
            <span class="ms-auto" style="font-size: 12.5px; color: #6f626d;">
                Found: <strong style="color: #483C46; font-weight: 700;"><?= number_format($totalMatching ?? 0) ?></strong>
            </span>
        </div>
    </form>
</div>

<!-- ==================== CUSTOMER DIRECTORY TABLE (WHITE) ==================== -->
<div class="customer-table-card">
    <div class="customer-table-header">
        <div>
            <h3 class="customer-table-title">
                <span class="material-symbols-outlined" style="color: #592E83; font-size: 24px;">people</span>
                Registered Customer Directory
            </h3>
            <div class="customer-table-subtitle">Complete client records with provider tracking, status toggles, and profile controls</div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="clean-table align-middle">
            <thead>
                <tr>
                    <th style="padding-left: 24px;">Customer</th>
                    <th>Contact Info</th>
                    <th>Provider</th>
                    <th>Status</th>
                    <th>Registered</th>
                    <th style="padding-right: 24px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($customers)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; color: #6f626d;">
                                <div style="width: 54px; height: 54px; border-radius: 50%; background: #fcfbfa; border: 1px solid #ede6e4; display: flex; align-items: center; justify-content: center;">
                                    <span class="material-symbols-outlined" style="font-size: 28px; color: #988b97;">person_off</span>
                                </div>
                                <div style="font-size: 14px; font-weight: 600; color: #483C46;">No customer records found</div>
                                <div style="font-size: 12.5px; color: #6f626d;">Try adjusting your search criteria or add a new customer patron.</div>
                                <button type="button" class="btn-clean-primary mt-2" onclick="openAddCustomerModal()">
                                    <span class="material-symbols-outlined" style="font-size: 17px;">person_add</span>
                                    Add New Customer
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($customers as $c): ?>
                        <tr>
                            <!-- CUSTOMER NAME & AVATAR -->
                            <td style="padding-left: 24px;">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 42px; height: 42px; border-radius: 50%; overflow: hidden; background: #f4edf7; border: 1px solid #dfcfeb; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <?php if (!empty($c['profile_image'])): ?>
                                            <img src="<?= esc($c['profile_image']) ?>" alt="<?= esc($c['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                                        <?php else: ?>
                                            <span style="font-size: 13.5px; font-weight: 700; color: #592E83;">
                                                <?= esc(strtoupper(substr($c['name'] ?? 'C', 0, 2))) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: #483C46; font-size: 13.5px; line-height: 1.3;">
                                            <?= esc($c['name']) ?>
                                        </div>
                                        <div style="font-size: 11px; color: #6f626d; margin-top: 2px;">
                                            <code style="background: #f4edf7; color: #592E83; padding: 2px 6px; border-radius: 4px; font-family: monospace; font-size: 11px;">#GLW-<?= str_pad((string)$c['id'], 4, '0', STR_PAD_LEFT) ?></code>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- CONTACT INFO -->
                            <td>
                                <div style="font-size: 13px; color: #483C46; font-weight: 500; display: flex; align-items: center; gap: 5px;">
                                    <span class="material-symbols-outlined" style="font-size: 15px; color: #592E83;">mail</span>
                                    <span><?= esc($c['email']) ?></span>
                                </div>
                                <div style="font-size: 12px; color: #6f626d; margin-top: 3px; display: flex; align-items: center; gap: 5px;">
                                    <span class="material-symbols-outlined" style="font-size: 14px; color: #988b97;">call</span>
                                    <span><?= !empty($c['phone']) ? esc($c['phone']) : '<span style="color: #988b97; font-style: italic;">No phone</span>' ?></span>
                                </div>
                            </td>

                            <!-- PROVIDER -->
                            <td>
                                <?php if (($c['login_provider'] ?? '') === 'google'): ?>
                                    <span class="provider-pill provider-google">
                                        <svg style="width: 12px; height: 12px;" viewBox="0 0 24 24">
                                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                                        </svg>
                                        Google
                                    </span>
                                <?php else: ?>
                                    <span class="provider-pill provider-local">
                                        <span class="material-symbols-outlined" style="font-size: 13px; color: #592E83;">password</span>
                                        Email/Pass
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- STATUS (AJAX TOGGLE) -->
                            <td>
                                <?php if ((int)$c['status'] === 1): ?>
                                    <button type="button" class="btn p-0 border-0" onclick="toggleCustomerStatus(<?= $c['id'] ?>, this)" title="Click to toggle status">
                                        <span class="status-pill status-active">
                                            <span class="material-symbols-outlined" style="font-size: 13px;">check_circle</span>
                                            Active
                                        </span>
                                    </button>
                                <?php else: ?>
                                    <button type="button" class="btn p-0 border-0" onclick="toggleCustomerStatus(<?= $c['id'] ?>, this)" title="Click to toggle status">
                                        <span class="status-pill status-inactive">
                                            <span class="material-symbols-outlined" style="font-size: 13px;">cancel</span>
                                            Inactive
                                        </span>
                                    </button>
                                <?php endif; ?>
                            </td>

                            <!-- REGISTERED DATE -->
                            <td>
                                <div style="font-size: 13px; color: #334155; font-weight: 500;">
                                    <?= !empty($c['created_at']) ? date('M d, Y', strtotime($c['created_at'])) : '—' ?>
                                </div>
                                <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">
                                    <?= !empty($c['created_at']) ? date('h:i A', strtotime($c['created_at'])) : '' ?>
                                </div>
                            </td>

                            <!-- ACTIONS -->
                            <td style="padding-right: 24px; text-align: right;">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <!-- VIEW DETAILS -->
                                    <button type="button" class="btn-action-clean" 
                                            onclick="viewCustomerDetails(<?= $c['id'] ?>)" title="View Customer Details">
                                        <span class="material-symbols-outlined" style="font-size: 17px;">visibility</span>
                                    </button>

                                    <!-- EDIT -->
                                    <button type="button" class="btn-action-clean btn-edit" 
                                            onclick='openEditCustomerModal(<?= json_encode($c, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)' title="Edit Profile">
                                        <span class="material-symbols-outlined" style="font-size: 17px;">edit</span>
                                    </button>

                                    <!-- DELETE -->
                                    <button type="button" class="btn-action-clean btn-delete" 
                                            onclick="confirmDeleteCustomer(<?= $c['id'] ?>, '<?= esc(addslashes($c['name'])) ?>')" title="Delete Customer">
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
        <div class="customer-pagination-bar">
            <div style="font-size: 12.5px; color: #6f626d;">
                Showing Page <strong style="color: #483C46;"><?= $currentPage ?></strong> of <strong style="color: #483C46;"><?= $totalPages ?></strong>
            </div>
            <div class="d-flex align-items-center gap-1">
                <?php if ($currentPage > 1): ?>
                    <a href="<?= base_url('admin/website/customer?page=' . ($currentPage - 1) . '&search=' . urlencode($search ?? '') . '&status=' . urlencode($statusFilter ?? '')) ?>" 
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
                        <a href="<?= base_url('admin/website/customer?page=' . $p . '&search=' . urlencode($search ?? '') . '&status=' . urlencode($statusFilter ?? '')) ?>" 
                           class="pagination-link-clean">
                            <?= $p ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= base_url('admin/website/customer?page=' . ($currentPage + 1) . '&search=' . urlencode($search ?? '') . '&status=' . urlencode($statusFilter ?? '')) ?>" 
                       class="pagination-link-clean">
                        Next
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- ==================== MODAL: ADD / EDIT CUSTOMER (WHITE) ==================== -->
<div class="modal fade" id="customerFormModal" tabindex="-1" aria-labelledby="customerFormModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content white-modal-content">
            <div class="white-modal-header">
                <h5 class="modal-title" id="customerFormModalTitle">
                    Add Customer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url('admin/website/customer/save') ?>" method="POST" id="customerForm">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="formCustomerId" value="0" />

                <div class="white-modal-body">
                    <!-- NAME -->
                    <div class="mb-3">
                        <label class="white-form-label">Full Name *</label>
                        <input type="text" name="name" id="formCustomerName" class="form-control clean-input" 
                               placeholder="e.g. Meera Nair" required />
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="white-form-label">Email Address *</label>
                        <input type="email" name="email" id="formCustomerEmail" class="form-control clean-input" 
                               placeholder="customer@example.com" required />
                    </div>

                    <!-- PHONE -->
                    <div class="mb-3">
                        <label class="white-form-label">Phone Number</label>
                        <input type="tel" name="phone" id="formCustomerPhone" class="form-control clean-input" 
                               placeholder="+91 98765 43210" />
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="white-form-label" id="formCustomerPasswordLabel">Password *</label>
                        <input type="password" name="password" id="formCustomerPassword" class="form-control clean-input" 
                               placeholder="Enter secure password" />
                        <small id="formCustomerPasswordHelp" style="font-size: 11.5px; color: #64748b; margin-top: 4px; display: none;">
                            Leave blank to retain existing password.
                        </small>
                    </div>

                    <!-- STATUS -->
                    <div class="mb-1">
                        <label class="white-form-label">Account Status</label>
                        <select name="status" id="formCustomerStatus" class="form-select clean-select">
                            <option value="1">Active (Permitted to sign in &amp; book appointments)</option>
                            <option value="0">Inactive / Suspended (Access disabled)</option>
                        </select>
                    </div>
                </div>

                <div class="white-modal-footer">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">
                        <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                        <span id="formSubmitBtnText">Save Customer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================== MODAL: VIEW CUSTOMER DETAILS (WHITE) ==================== -->
<div class="modal fade" id="customerDetailsModal" tabindex="-1" aria-labelledby="customerDetailsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content white-modal-content">
            <div class="white-modal-header">
                <h5 class="modal-title" id="customerDetailsModalTitle">
                    Customer Details
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

<!-- ==================== MODAL: DELETE CONFIRMATION (WHITE) ==================== -->
<div class="modal fade" id="customerDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content white-modal-content">
            <div class="white-modal-body text-center pt-4 pb-3">
                <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; border: 1px solid #fee2e2; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                    <span class="material-symbols-outlined" style="color: #dc2626; font-size: 28px;">delete</span>
                </div>
                <h5 style="font-family: 'Playfair Display', serif; color: #483C46; font-weight: 700; margin-bottom: 8px;">Delete Customer?</h5>
                <p style="font-size: 13px; color: #6f626d; line-height: 1.5; margin-bottom: 0;" id="deleteConfirmText">
                    Are you sure you want to permanently delete this customer?
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
            formModalInstance = new bootstrap.Modal(document.getElementById('customerFormModal'));
        }
        return formModalInstance;
    }

    function getDetailsModal() {
        if (!detailsModalInstance) {
            detailsModalInstance = new bootstrap.Modal(document.getElementById('customerDetailsModal'));
        }
        return detailsModalInstance;
    }

    function getDeleteModal() {
        if (!deleteModalInstance) {
            deleteModalInstance = new bootstrap.Modal(document.getElementById('customerDeleteModal'));
        }
        return deleteModalInstance;
    }

    // Open Add Customer Modal
    function openAddCustomerModal() {
        document.getElementById('customerFormModalTitle').innerText = 'Add New Customer';
        document.getElementById('formCustomerId').value = '0';
        document.getElementById('formCustomerName').value = '';
        document.getElementById('formCustomerEmail').value = '';
        document.getElementById('formCustomerPhone').value = '';
        document.getElementById('formCustomerPassword').value = '';
        document.getElementById('formCustomerPassword').required = true;
        document.getElementById('formCustomerPasswordLabel').innerText = 'Password *';
        document.getElementById('formCustomerPasswordHelp').style.display = 'none';
        document.getElementById('formCustomerStatus').value = '1';
        document.getElementById('formSubmitBtnText').innerText = 'Create Customer';

        getFormModal().show();
    }

    // Open Edit Customer Modal
    function openEditCustomerModal(customer) {
        document.getElementById('customerFormModalTitle').innerText = 'Edit Customer Profile';
        document.getElementById('formCustomerId').value = customer.id;
        document.getElementById('formCustomerName').value = customer.name || '';
        document.getElementById('formCustomerEmail').value = customer.email || '';
        document.getElementById('formCustomerPhone').value = customer.phone || '';
        document.getElementById('formCustomerPassword').value = '';
        document.getElementById('formCustomerPassword').required = false;
        document.getElementById('formCustomerPasswordLabel').innerText = 'New Password (Optional)';
        document.getElementById('formCustomerPasswordHelp').style.display = 'block';
        document.getElementById('formCustomerStatus').value = customer.status !== undefined ? customer.status : '1';
        document.getElementById('formSubmitBtnText').innerText = 'Save Changes';

        getFormModal().show();
    }

    // View Customer Details
    function viewCustomerDetails(customerId) {
        const bodyEl = document.getElementById('detailsModalBody');
        bodyEl.innerHTML = '<div class="text-center py-4"><div class="spinner-border" style="color: #592E83;" role="status"></div></div>';
        getDetailsModal().show();

        fetch('<?= base_url('admin/website/customer/details') ?>/' + customerId)
            .then(res => res.json())
            .then(data => {
                if (!data.status || !data.customer) {
                    bodyEl.innerHTML = '<div class="alert alert-danger mb-0">Failed to load customer details.</div>';
                    return;
                }

                const c = data.customer;
                const statusBadge = parseInt(c.status) === 1 
                    ? '<span class="status-pill status-active"><span class="material-symbols-outlined" style="font-size: 13px;">check_circle</span> Active</span>' 
                    : '<span class="status-pill status-inactive"><span class="material-symbols-outlined" style="font-size: 13px;">cancel</span> Inactive</span>';
                
                const providerBadge = c.login_provider === 'google'
                    ? '<span class="provider-pill provider-google"><svg style="width: 12px; height: 12px;" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg> Google OAuth</span>'
                    : '<span class="provider-pill provider-local"><span class="material-symbols-outlined" style="font-size: 13px; color: #592E83;">password</span> Email &amp; Password</span>';

                const avatarHtml = c.profile_image 
                    ? `<img src="${c.profile_image}" style="width: 76px; height: 76px; border-radius: 50%; object-fit: cover; border: 3px solid #dfcfeb; box-shadow: 0 4px 12px rgba(89, 46, 131, 0.18);" />`
                    : `<div style="width: 76px; height: 76px; border-radius: 50%; background: #f4edf7; border: 3px solid #dfcfeb; display: inline-flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 700; color: #592E83;">${(c.name || 'C').substring(0,2).toUpperCase()}</div>`;

                bodyEl.innerHTML = `
                    <div class="text-center mb-4">
                        ${avatarHtml}
                        <h4 class="mt-2 mb-1" style="font-family: 'Playfair Display', serif; color: #483C46; font-weight: 700;">${escapeHtml(c.name)}</h4>
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-1">
                            ${statusBadge}
                            ${providerBadge}
                        </div>
                    </div>

                    <div style="background: #faf8fa; border-radius: 12px; border: 1px solid #ede6e4; padding: 18px; text-align: left;">
                        <div class="row g-3" style="font-size: 13px;">
                            <div class="col-6">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Customer ID</div>
                                <div style="color: #483C46; font-weight: 600; font-size: 13.5px;">#GLW-${String(c.id).padStart(4, '0')}</div>
                            </div>
                            <div class="col-6">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Registered Date</div>
                                <div style="color: #483C46; font-weight: 600; font-size: 13.5px;">${c.created_at || '—'}</div>
                            </div>
                            <div class="col-12">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Email Address</div>
                                <div style="color: #483C46; font-weight: 600; font-size: 13.5px;">${escapeHtml(c.email)}</div>
                            </div>
                            <div class="col-12">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Phone Number</div>
                                <div style="color: #483C46; font-weight: 600; font-size: 13.5px;">${c.phone ? escapeHtml(c.phone) : '<span style="color: #988b97; font-weight: normal;">No phone provided</span>'}</div>
                            </div>
                            ${c.google_id ? `
                            <div class="col-12">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Google ID</div>
                                <div style="font-family: monospace; font-size: 12px; color: #2563eb; font-weight: 600;">${escapeHtml(c.google_id)}</div>
                            </div>` : ''}
                            <div class="col-12">
                                <div style="font-size: 11px; text-transform: uppercase; color: #A36952; letter-spacing: 0.05em; font-weight: 700;">Last Profile Update</div>
                                <div style="color: #6f626d; font-size: 12px;">${c.updated_at || '—'}</div>
                            </div>
                        </div>
                    </div>
                `;
            })
            .catch(err => {
                bodyEl.innerHTML = '<div class="alert alert-danger mb-0">Error communicating with server.</div>';
            });
    }

    // Toggle Customer Status via AJAX
    function toggleCustomerStatus(customerId, btnElement) {
        fetch('<?= base_url('admin/website/customer/toggle-status') ?>/' + customerId, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                if (data.new_status === 1) {
                    btnElement.innerHTML = `
                        <span class="status-pill status-active">
                            <span class="material-symbols-outlined" style="font-size: 13px;">check_circle</span>
                            Active
                        </span>
                    `;
                } else {
                    btnElement.innerHTML = `
                        <span class="status-pill status-inactive">
                            <span class="material-symbols-outlined" style="font-size: 13px;">cancel</span>
                            Inactive
                        </span>
                    `;
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
                showGlowToast('Failed to update customer status', 'error', 'Error');
            }
        });
    }

    // Confirm Delete Customer Modal
    function confirmDeleteCustomer(customerId, customerName) {
        document.getElementById('deleteConfirmText').innerHTML = `Are you sure you want to delete customer <strong>${escapeHtml(customerName)}</strong>? This action cannot be undone.`;
        document.getElementById('deleteConfirmBtn').href = '<?= base_url('admin/website/customer/delete') ?>/' + customerId;
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
