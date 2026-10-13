<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Audience</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">All-time subscriber signups</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">mark_email_read</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Active Subscribers</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['active'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Receiving journal newsletters</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Unsubscribed</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #c98860; font-family: 'Playfair Display', serif;"><?= esc($stats['unsubscribed'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Opted-out or inactive</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(201, 136, 96, 0.12); display: flex; align-items: center; justify-content: center; color: #c98860;">
                <span class="material-symbols-outlined">unsubscribe</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">New (Last 30 Days)</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--color-primary, #592e83); font-family: 'Playfair Display', serif;"><?= esc($stats['recent_30d'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Recent subscriber growth</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--color-primary, #592e83);">
                <span class="material-symbols-outlined">trending_up</span>
            </div>
        </div>
    </div>
</div>

<!-- Controls & Filter Strip -->
<div class="glass-panel p-3 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Filter Pills -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="<?= base_url('admin/marketing/subscribers?status=all' . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
               class="badge-pill <?= ($statusFilter === 'all') ? 'active-pill' : 'inactive-pill' ?>">
                All (<?= esc($stats['total'] ?? 0) ?>)
            </a>
            <a href="<?= base_url('admin/marketing/subscribers?status=active' . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
               class="badge-pill <?= ($statusFilter === 'active') ? 'active-pill' : 'inactive-pill' ?>">
                Active (<?= esc($stats['active'] ?? 0) ?>)
            </a>
            <a href="<?= base_url('admin/marketing/subscribers?status=unsubscribed' . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
               class="badge-pill <?= ($statusFilter === 'unsubscribed') ? 'active-pill' : 'inactive-pill' ?>">
                Unsubscribed (<?= esc($stats['unsubscribed'] ?? 0) ?>)
            </a>
        </div>

        <!-- Search & Export -->
        <div class="d-flex align-items-center gap-2">
            <form action="<?= base_url('admin/marketing/subscribers') ?>" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="status" value="<?= esc($statusFilter) ?>">
                <div class="input-group input-group-sm" style="width: 240px;">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <span class="material-symbols-outlined" style="font-size: 16px;">search</span>
                    </span>
                    <input type="text" name="q" value="<?= esc($searchQuery ?? '') ?>" class="form-control border-start-0 ps-0" placeholder="Search by email...">
                </div>
            </form>

            <a href="<?= base_url('admin/marketing/subscribers/export?status=' . urlencode($statusFilter) . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
               class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1" title="Export Subscribers to CSV">
                <span class="material-symbols-outlined" style="font-size: 16px;">download</span>
                <span>Export CSV</span>
            </a>
        </div>
    </div>
</div>

<!-- Subscribers Table Card -->
<div class="glass-panel p-0 mb-4" style="overflow: hidden;">
    <div class="table-responsive">
        <table class="table align-middle mb-0" style="font-size: 13px;">
            <thead style="background: #faf7f5; border-bottom: 1px solid var(--border-subtle); color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                <tr>
                    <th style="padding: 14px 18px; width: 60px;">#</th>
                    <th style="padding: 14px 18px;">Email Address</th>
                    <th style="padding: 14px 18px;">Status</th>
                    <th style="padding: 14px 18px;">Source</th>
                    <th style="padding: 14px 18px;">IP Address</th>
                    <th style="padding: 14px 18px;">Subscribed Date</th>
                    <th style="padding: 14px 18px; text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($subscribers) && count($subscribers) > 0): ?>
                    <?php foreach ($subscribers as $idx => $s): ?>
                        <tr style="border-bottom: 1px solid rgba(89, 46, 131, 0.05);">
                            <td style="padding: 14px 18px; color: var(--text-muted);"><?= $idx + 1 ?></td>
                            <td style="padding: 14px 18px;">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 34px; height: 34px; border-radius: 50%; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent); font-weight: 600; font-size: 12px;">
                                        <?= strtoupper(substr($s['email'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: var(--text-main);"><?= esc($s['email']) ?></div>
                                        <small class="text-muted" style="font-size: 11px;">ID: #<?= esc($s['id']) ?></small>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <?php if ($s['status'] === 'active'): ?>
                                    <span class="badge" style="background: rgba(46, 125, 50, 0.12); color: #2e7d32; font-weight: 600; font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                                        Active
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background: rgba(108, 117, 125, 0.12); color: #6c757d; font-weight: 600; font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                                        Unsubscribed
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 14px 18px;">
                                <span class="badge" style="background: #faf7f5; color: var(--text-muted); border: 1px solid var(--border-subtle); font-size: 11px; padding: 3px 8px; border-radius: 6px;">
                                    <?= esc(ucfirst($s['source'] ?? 'footer')) ?>
                                </span>
                            </td>
                            <td style="padding: 14px 18px; color: var(--text-muted); font-size: 12px;">
                                <code><?= esc($s['ip_address'] ?? 'N/A') ?></code>
                            </td>
                            <td style="padding: 14px 18px; color: var(--text-muted); font-size: 12px;">
                                <?= !empty($s['created_at']) ? date('d M Y, h:i A', strtotime($s['created_at'])) : '—' ?>
                            </td>
                            <td style="padding: 14px 18px; text-align: right;">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <form action="<?= base_url('admin/marketing/subscribers/toggle/' . $s['id']) ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-icon-round" title="<?= ($s['status'] === 'active') ? 'Deactivate / Unsubscribe' : 'Reactivate Subscriber' ?>">
                                            <span class="material-symbols-outlined" style="font-size: 16px; color: <?= ($s['status'] === 'active') ? '#c98860' : '#2e7d32' ?>;">
                                                <?= ($s['status'] === 'active') ? 'toggle_on' : 'toggle_off' ?>
                                            </span>
                                        </button>
                                    </form>
                                    <a href="<?= base_url('admin/marketing/subscribers/delete/' . $s['id']) ?>" class="btn btn-sm btn-icon-round" title="Delete Subscriber" onclick="return confirm('Permanently remove <?= esc($s['email']) ?> from newsletter database?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d32f2f;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.4;">mark_email_unread</span>
                            <div class="mt-2 fw-semibold text-muted">No newsletter subscribers discovered</div>
                            <small class="text-muted">Subscribers joining via the website footer or promotions will appear here automatically.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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

<?= $this->endSection() ?>
