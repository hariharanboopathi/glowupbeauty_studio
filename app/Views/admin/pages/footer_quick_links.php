<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-main); margin-bottom: 4px;">
            Quick Links Management
        </h2>
        <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
            Manage and reorder navigation links displayed in the footer quick links column.
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn-glow" onclick="openAddLinkModal()">
            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
            Add Quick Link
        </button>
        <a href="<?= base_url('/') ?>" target="_blank" class="btn-ghost-glow" title="View live frontend footer">
            <span class="material-symbols-outlined" style="font-size: 18px;">preview</span>
            Live Preview
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="glass-panel">
            <div class="panel-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="color: var(--accent);">link</span>
                        Quick Links Column
                    </h3>
                    <div class="subtitle">Navigation links displayed in the second column of the footer</div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-glow">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Order</th>
                            <th>Link Label</th>
                            <th>Target URL</th>
                            <th style="width: 110px;">Status</th>
                            <th style="width: 175px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($quickLinks)): ?>
                            <?php foreach ($quickLinks as $idx => $link): ?>
                                <tr>
                                    <td>
                                        <span style="font-weight: 700; color: var(--accent);">#<?= esc($link['sort_order']) ?></span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--text-main);"><?= esc($link['title']) ?></div>
                                    </td>
                                    <td>
                                        <code style="color: var(--accent); font-size: 12px;"><?= esc($link['url']) ?></code>
                                    </td>
                                    <td>
                                        <?php if ((int)$link['status'] === 1): ?>
                                            <span class="badge-status st-active">Visible</span>
                                        <?php else: ?>
                                            <span class="badge-status st-inactive">Hidden</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <a href="<?= base_url('admin/website/footer/link/move/' . $link['id'] . '/up') ?>"
                                                class="btn-action-icon" title="Move Up (Reorder)" <?= $idx === 0 ? 'style="opacity: 0.35; pointer-events: none;"' : '' ?>>
                                                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_upward</span>
                                            </a>
                                            <a href="<?= base_url('admin/website/footer/link/move/' . $link['id'] . '/down') ?>"
                                                class="btn-action-icon" title="Move Down (Reorder)" <?= $idx === count($quickLinks) - 1 ? 'style="opacity: 0.35; pointer-events: none;"' : '' ?>>
                                                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_downward</span>
                                            </a>
                                            <button type="button" class="btn-action-icon" title="Edit Link"
                                                onclick="openEditLinkModal(<?= htmlspecialchars(json_encode($link), ENT_QUOTES, 'UTF-8') ?>)">
                                                <span class="material-symbols-outlined">edit</span>
                                            </button>
                                            <a href="<?= base_url('admin/website/footer/link/delete/' . $link['id']) ?>"
                                                class="btn-action-icon btn-danger-icon" title="Delete Link"
                                                onclick="return confirm('Are you sure you want to delete this link?');">
                                                <span class="material-symbols-outlined">delete</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: var(--text-dim); padding: 30px;">
                                    No Quick Links configured yet. Click "Add Quick Link" above to add one.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==================== QUICK LINK MODAL (ADD / EDIT) ==================== -->
<div class="modal fade" id="linkModal" tabindex="-1" aria-labelledby="linkModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-glow">
            <div class="modal-header modal-header-glow">
                <h5 class="modal-title" id="linkModalTitle">Add Quick Link</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/website/footer/link/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="modalLinkId" value="0" />
                <input type="hidden" name="group_name" id="modalLinkGroup" value="quick_links" />

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label-glow">Link Title / Label *</label>
                        <input type="text" name="title" id="modalLinkTitle" class="form-control form-control-glow" placeholder="e.g. Services, About Us, or Book Online" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label-glow">Target URL / Route *</label>
                        <input type="text" name="url" id="modalLinkUrl" class="form-control form-control-glow" placeholder="e.g. services, about, or https://..." required />
                        <small style="font-size: 11px; color: var(--text-dim); display: block; margin-top: 4px;">Enter relative route like <code>services</code> or full URL.</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label-glow">Display Order</label>
                            <input type="number" name="sort_order" id="modalLinkOrder" class="form-control form-control-glow" value="1" min="0" />
                        </div>
                        <div class="col-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="modalLinkStatus" value="1" checked />
                                <label class="form-check-label ms-2" for="modalLinkStatus" style="font-size: 13px; color: var(--text-main);">
                                    Active / Visible
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer modal-footer-glow">
                    <button type="button" class="btn-ghost-glow" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-glow">
                        <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                        Save Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let linkModalInstance = null;

    function getLinkModal() {
        if (!linkModalInstance) {
            linkModalInstance = new bootstrap.Modal(document.getElementById('linkModal'));
        }
        return linkModalInstance;
    }

    function openAddLinkModal() {
        document.getElementById('linkModalTitle').innerText = 'Add Quick Link';
        document.getElementById('modalLinkId').value = '0';
        document.getElementById('modalLinkGroup').value = 'quick_links';
        document.getElementById('modalLinkTitle').value = '';
        document.getElementById('modalLinkUrl').value = '';
        document.getElementById('modalLinkOrder').value = '0';
        document.getElementById('modalLinkStatus').checked = true;

        getLinkModal().show();
    }

    function openEditLinkModal(linkData) {
        document.getElementById('linkModalTitle').innerText = 'Edit Quick Link';
        document.getElementById('modalLinkId').value = linkData.id;
        document.getElementById('modalLinkGroup').value = 'quick_links';
        document.getElementById('modalLinkTitle').value = linkData.title || '';
        document.getElementById('modalLinkUrl').value = linkData.url || '';
        document.getElementById('modalLinkOrder').value = linkData.sort_order || 0;
        document.getElementById('modalLinkStatus').checked = parseInt(linkData.status) === 1;

        getLinkModal().show();
    }
</script>

<?= $this->endSection() ?>
