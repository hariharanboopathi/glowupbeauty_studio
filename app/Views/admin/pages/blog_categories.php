<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Categories</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Editorial taxonomy departments</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">category</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Active Topics</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['active'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Active in public journal filter</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
    </div>
</div>

<!-- Action Bar -->
<div class="glass-panel p-3 mb-4 d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('admin/blog') ?>" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
            <span>Back to Articles</span>
        </a>
        <span class="fw-bold ms-2" style="color: var(--text-main); font-size: 14px;">Journal Taxonomy & Classifications</span>
    </div>
    <button type="button" class="btn btn-luxury-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="resetCategoryModal()">
        <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
        <span>Add Category</span>
    </button>
</div>

<!-- Table Card -->
<div class="glass-panel p-0 mb-4" style="overflow: hidden;">
    <div class="table-responsive">
        <table class="table align-middle mb-0" style="font-size: 13px;">
            <thead style="background: #faf7f5; border-bottom: 1px solid var(--border-subtle); color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                <tr>
                    <th style="padding: 14px 18px; width: 60px;">#</th>
                    <th style="padding: 14px 18px;">Category Name</th>
                    <th style="padding: 14px 18px;">Slug Identifier</th>
                    <th style="padding: 14px 18px;">Scope Description</th>
                    <th style="padding: 14px 18px; text-align: center;">Order</th>
                    <th style="padding: 14px 18px; text-align: center;">Active</th>
                    <th style="padding: 14px 18px; text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories) && count($categories) > 0): ?>
                    <?php foreach ($categories as $idx => $cat): ?>
                        <tr style="border-bottom: 1px solid rgba(89, 46, 131, 0.05);">
                            <td style="padding: 14px 18px; color: var(--text-muted);"><?= $idx + 1 ?></td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-bold" style="color: var(--text-main); font-size: 13.5px;"><?= esc($cat['name']) ?></div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <code style="color: var(--accent); font-size: 12px;"><?= esc($cat['slug']) ?></code>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="text-muted text-truncate" style="max-width: 320px; font-size: 12px;">
                                    <?= esc($cat['description'] ?? 'No description.') ?>
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <span class="badge bg-light text-dark"><?= esc($cat['sort_order']) ?></span>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <span class="badge <?= $cat['is_active'] ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' ?>" style="font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                                    <?= $cat['is_active'] ? 'Active' : 'Disabled' ?>
                                </span>
                            </td>
                            <td style="padding: 14px 18px; text-align: right;">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <button type="button" class="btn btn-sm btn-icon-round" title="Edit Category" onclick="editCategory(<?= htmlspecialchars(json_encode($cat), ENT_QUOTES, 'UTF-8') ?>)">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">edit</span>
                                    </button>
                                    <a href="<?= base_url('admin/blog/category/delete/' . $cat['id']) ?>" class="btn btn-sm btn-icon-round" title="Delete Category" onclick="return confirm('Remove this editorial category?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d32f2f;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.4;">category</span>
                            <div class="mt-2 fw-semibold text-muted">No editorial categories found</div>
                            <small class="text-muted">Click "Add Category" above to configure your first blog subject.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Add / Edit Category -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-panel border-0" style="box-shadow: 0 20px 48px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom pb-3" style="border-color: var(--border-subtle) !important;">
                <h5 class="modal-title fw-bold" id="catModalTitle" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                    Add Blog Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/blog/category/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="cat_id" value="">

                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Category Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="cat_name" class="form-control" required placeholder="e.g. Haute Bridal Insights">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Custom URL Slug (Optional)
                            </label>
                            <input type="text" name="slug" id="cat_slug" class="form-control" placeholder="haute-bridal-insights">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Sort Index
                            </label>
                            <input type="number" name="sort_order" id="cat_sort_order" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Scope Description
                        </label>
                        <textarea name="description" id="cat_description" rows="2" class="form-control" placeholder="Describe the topics covered in this editorial department..."></textarea>
                    </div>

                    <div class="form-check form-switch p-2 rounded" style="background: #faf7f5; border: 1px solid var(--border-subtle); padding-left: 2.5rem;">
                        <input class="form-check-input" type="checkbox" name="is_active" id="cat_is_active" value="1" checked>
                        <label class="form-check-label fw-semibold" for="cat_is_active" style="font-size: 12px;">Active in Public Filtering</label>
                    </div>
                </div>

                <div class="modal-footer border-top pt-3" style="border-color: var(--border-subtle) !important;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Save Category</button>
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
function resetCategoryModal() {
    document.getElementById('catModalTitle').innerText = 'Add Blog Category';
    document.getElementById('cat_id').value = '';
    document.getElementById('cat_name').value = '';
    document.getElementById('cat_slug').value = '';
    document.getElementById('cat_sort_order').value = '0';
    document.getElementById('cat_description').value = '';
    document.getElementById('cat_is_active').checked = true;
}

function editCategory(cat) {
    document.getElementById('catModalTitle').innerText = 'Edit Blog Category';
    document.getElementById('cat_id').value = cat.id;
    document.getElementById('cat_name').value = cat.name;
    document.getElementById('cat_slug').value = cat.slug;
    document.getElementById('cat_sort_order').value = cat.sort_order;
    document.getElementById('cat_description').value = cat.description || '';
    document.getElementById('cat_is_active').checked = (cat.is_active == 1);

    const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
    modal.show();
}
</script>

<?= $this->endSection() ?>
