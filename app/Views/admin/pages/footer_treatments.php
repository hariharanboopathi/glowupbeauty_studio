<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-main); margin-bottom: 4px;">
            Popular Treatments Management
        </h2>
        <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
            Manage and reorder treatment links displayed in the footer popular treatments column.
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <button type="button" class="btn-glow" onclick="openAddTreatmentModal()">
            <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
            Add Treatment
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
                        <span class="material-symbols-outlined" style="color: var(--accent);">spa</span>
                        Popular Treatments Column
                    </h3>
                    <div class="subtitle">Highlighted treatment links displayed in the third column of the footer</div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table-glow">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Order</th>
                            <th>Treatment Title</th>
                            <th>Target URL</th>
                            <th style="width: 110px;">Status</th>
                            <th style="width: 175px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($popularTreatments)): ?>
                            <?php foreach ($popularTreatments as $idx => $link): ?>
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
                                                class="btn-action-icon" title="Move Down (Reorder)" <?= $idx === count($popularTreatments) - 1 ? 'style="opacity: 0.35; pointer-events: none;"' : '' ?>>
                                                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_downward</span>
                                            </a>
                                            <button type="button" class="btn-action-icon" title="Edit Treatment Link"
                                                onclick="openEditTreatmentModal(<?= htmlspecialchars(json_encode($link), ENT_QUOTES, 'UTF-8') ?>)">
                                                <span class="material-symbols-outlined">edit</span>
                                            </button>
                                            <a href="<?= base_url('admin/website/footer/link/delete/' . $link['id']) ?>"
                                                class="btn-action-icon btn-danger-icon" title="Delete Treatment"
                                                onclick="return confirm('Are you sure you want to delete this treatment link?');">
                                                <span class="material-symbols-outlined">delete</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: var(--text-dim); padding: 30px;">
                                    No Popular Treatments configured yet. Click "Add Treatment" above to add one.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ==================== TREATMENT MODAL (ADD / EDIT) ==================== -->
<div class="modal fade" id="treatmentModal" tabindex="-1" aria-labelledby="treatmentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-glow">
            <div class="modal-header modal-header-glow">
                <h5 class="modal-title" id="treatmentModalTitle">Add Treatment Link</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/website/footer/link/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="modalTreatmentId" value="0" />
                <input type="hidden" name="group_name" id="modalTreatmentGroup" value="popular_treatments" />

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label-glow">Treatment Name / Title *</label>
                        <input type="text" name="title" id="modalTreatmentTitle" class="form-control form-control-glow" placeholder="e.g. Keratin Infusion Therapy" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label-glow">Target URL / Route *</label>
                        <input type="text" name="url" id="modalTreatmentUrl" class="form-control form-control-glow" placeholder="e.g. services or https://..." required />
                        <small style="font-size: 11px; color: var(--text-dim); display: block; margin-top: 4px;">Enter relative route like <code>services</code> or full URL.</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label-glow">Display Order</label>
                            <input type="number" name="sort_order" id="modalTreatmentOrder" class="form-control form-control-glow" value="1" min="0" />
                        </div>
                        <div class="col-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="modalTreatmentStatus" value="1" checked />
                                <label class="form-check-label ms-2" for="modalTreatmentStatus" style="font-size: 13px; color: var(--text-main);">
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
                        Save Treatment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let treatmentModalInstance = null;

    function getTreatmentModal() {
        if (!treatmentModalInstance) {
            treatmentModalInstance = new bootstrap.Modal(document.getElementById('treatmentModal'));
        }
        return treatmentModalInstance;
    }

    function openAddTreatmentModal() {
        document.getElementById('treatmentModalTitle').innerText = 'Add Treatment Link';
        document.getElementById('modalTreatmentId').value = '0';
        document.getElementById('modalTreatmentGroup').value = 'popular_treatments';
        document.getElementById('modalTreatmentTitle').value = '';
        document.getElementById('modalTreatmentUrl').value = '';
        document.getElementById('modalTreatmentOrder').value = '0';
        document.getElementById('modalTreatmentStatus').checked = true;

        getTreatmentModal().show();
    }

    function openEditTreatmentModal(linkData) {
        document.getElementById('treatmentModalTitle').innerText = 'Edit Treatment Link';
        document.getElementById('modalTreatmentId').value = linkData.id;
        document.getElementById('modalTreatmentGroup').value = 'popular_treatments';
        document.getElementById('modalTreatmentTitle').value = linkData.title || '';
        document.getElementById('modalTreatmentUrl').value = linkData.url || '';
        document.getElementById('modalTreatmentOrder').value = linkData.sort_order || 0;
        document.getElementById('modalTreatmentStatus').checked = parseInt(linkData.status) === 1;

        getTreatmentModal().show();
    }
</script>

<?= $this->endSection() ?>
