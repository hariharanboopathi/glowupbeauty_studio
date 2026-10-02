<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Quick KPI Summary Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Articles</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($stats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Beauty & trichology journal essays</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">article</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Published</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($stats['published'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Publicly indexed & visible</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <span class="material-symbols-outlined">publish</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Featured Reads</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #c98860; font-family: 'Playfair Display', serif;"><?= esc($stats['featured'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Curated spotlight stories</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(201, 136, 96, 0.12); display: flex; align-items: center; justify-content: center; color: #c98860;">
                <span class="material-symbols-outlined">stars</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Reads</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--accent); font-family: 'Playfair Display', serif;"><?= number_format($stats['views'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Accumulated patron pageviews</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
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
            <a href="<?= base_url('admin/blog?category=all') ?>" class="badge-pill <?= ($currentCategory === 'all') ? 'active-pill' : 'inactive-pill' ?>">
                All Categories
            </a>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <a href="<?= base_url('admin/blog?category=' . $cat['id']) ?>" class="badge-pill <?= ($currentCategory == $cat['id']) ? 'active-pill' : 'inactive-pill' ?>">
                        <?= esc($cat['name']) ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
            <a href="<?= base_url('admin/blog/categories') ?>" class="badge-pill inactive-pill d-flex align-items-center gap-1" style="border-style: dashed;">
                <span class="material-symbols-outlined" style="font-size: 14px;">settings</span>
                <span>Manage Categories</span>
            </a>
        </div>

        <!-- Search & Add Button -->
        <div class="d-flex align-items-center gap-2">
            <form action="<?= base_url('admin/blog') ?>" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="category" value="<?= esc($currentCategory) ?>">
                <div class="input-group input-group-sm" style="width: 220px;">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <span class="material-symbols-outlined" style="font-size: 16px;">search</span>
                    </span>
                    <input type="text" name="q" value="<?= esc($searchQuery ?? '') ?>" class="form-control border-start-0 ps-0" placeholder="Search essays...">
                </div>
            </form>
            <button type="button" class="btn btn-luxury-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#blogModal" onclick="resetBlogModal()">
                <span class="material-symbols-outlined" style="font-size: 18px;">edit_note</span>
                <span>Write Article</span>
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
                    <th style="padding: 14px 18px;">Article Details</th>
                    <th style="padding: 14px 18px;">Category</th>
                    <th style="padding: 14px 18px;">Author & Views</th>
                    <th style="padding: 14px 18px; text-align: center;">Featured</th>
                    <th style="padding: 14px 18px; text-align: center;">Published</th>
                    <th style="padding: 14px 18px; text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($posts) && count($posts) > 0): ?>
                    <?php foreach ($posts as $idx => $post): ?>
                        <tr style="border-bottom: 1px solid rgba(89, 46, 131, 0.05);">
                            <td style="padding: 14px 18px; color: var(--text-muted);"><?= $idx + 1 ?></td>
                            <td style="padding: 14px 18px;">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 58px; height: 58px; border-radius: 8px; overflow: hidden; background: #faf7f5; border: 1px solid var(--border-subtle); flex-shrink: 0;">
                                        <img src="<?= esc($post['featured_image'] ? (str_starts_with($post['featured_image'], 'http') ? $post['featured_image'] : base_url($post['featured_image'])) : 'https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=200&q=80') ?>" alt="<?= esc($post['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=200&q=80'">
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: var(--text-main); font-size: 13.5px;"><?= esc($post['title']) ?></div>
                                        <div class="text-muted text-truncate" style="max-width: 320px; font-size: 11.5px;"><?= esc($post['summary']) ?></div>
                                        <small class="text-muted" style="font-size: 10.5px;">Slug: <code><?= esc($post['slug']) ?></code></small>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 14px 18px;">
                                <span class="badge" style="background: rgba(89, 46, 131, 0.08); color: var(--accent); font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                                    <?= esc($post['category_name']) ?>
                                </span>
                            </td>
                            <td style="padding: 14px 18px;">
                                <div class="fw-semibold" style="color: var(--text-main); font-size: 12.5px;">✍ <?= esc($post['author_name']) ?></div>
                                <div class="text-muted" style="font-size: 11px;">👁 <?= number_format($post['views_count']) ?> reads</div>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" role="switch" <?= $post['is_featured'] ? 'checked' : '' ?> onchange="toggleFeatured(<?= $post['id'] ?>)">
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: center;">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input" type="checkbox" role="switch" <?= $post['is_published'] ? 'checked' : '' ?> onchange="togglePublish(<?= $post['id'] ?>)">
                                </div>
                            </td>
                            <td style="padding: 14px 18px; text-align: right;">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <button type="button" class="btn btn-sm btn-icon-round" title="Edit Article" onclick="editBlogPost(<?= htmlspecialchars(json_encode($post), ENT_QUOTES, 'UTF-8') ?>)">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">edit</span>
                                    </button>
                                    <a href="<?= base_url('admin/blog/delete/' . $post['id']) ?>" class="btn btn-sm btn-icon-round" title="Delete Article" onclick="return confirm('Remove this article?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; color: #d32f2f;">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.4;">article</span>
                            <div class="mt-2 fw-semibold text-muted">No journal articles found in this category</div>
                            <small class="text-muted">Click "Write Article" to publish your first editorial piece.</small>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Add / Edit Blog Post -->
<div class="modal fade" id="blogModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content glass-panel border-0" style="box-shadow: 0 20px 48px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom pb-3" style="border-color: var(--border-subtle) !important;">
                <h5 class="modal-title fw-bold" id="blogModalTitle" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                    Write Editorial Article
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/blog/save') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="post_id" value="">

                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Article Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="post_title" class="form-control" required placeholder="e.g. The Science of Molecular Keratin">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Category <span class="text-danger">*</span>
                            </label>
                            <select name="category_id" id="post_category_id" class="form-select" required>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= esc($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="1">Haute Bridal Insights</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Author Name
                            </label>
                            <input type="text" name="author_name" id="post_author_name" class="form-control" placeholder="Priya Varma (Creative Director)">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Banner Image (URL or Upload)
                        </label>
                        <input type="text" name="featured_image" id="post_featured_image" class="form-control mb-2" placeholder="https://... or images/slide-bridal.jpg">
                        <input type="file" name="image_file" class="form-control form-control-sm" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Summary / Teaser Excerpt <span class="text-danger">*</span>
                        </label>
                        <textarea name="summary" id="post_summary" rows="2" class="form-control" required placeholder="A brief 1-2 sentence teaser displayed in article cards..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Complete Article Content
                        </label>
                        <textarea name="content" id="post_content" rows="6" class="form-control" placeholder="Write full article body or embed HTML formatting..."></textarea>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-2 rounded" style="background: #faf7f5; border: 1px solid var(--border-subtle);">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="post_is_featured" value="1">
                            <label class="form-check-label fw-semibold" for="post_is_featured" style="font-size: 12px;">Spotlight / Featured Article</label>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="is_published" id="post_is_published" value="1" checked>
                            <label class="form-check-label fw-semibold" for="post_is_published" style="font-size: 12px;">Publicly Published</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top pt-3" style="border-color: var(--border-subtle) !important;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-luxury-primary btn-sm px-4">Save Article</button>
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
function resetBlogModal() {
    document.getElementById('blogModalTitle').innerText = 'Write Editorial Article';
    document.getElementById('post_id').value = '';
    document.getElementById('post_title').value = '';
    document.getElementById('post_author_name').value = 'Priya Varma';
    document.getElementById('post_featured_image').value = '';
    document.getElementById('post_summary').value = '';
    document.getElementById('post_content').value = '';
    document.getElementById('post_is_featured').checked = false;
    document.getElementById('post_is_published').checked = true;
}

function editBlogPost(post) {
    document.getElementById('blogModalTitle').innerText = 'Edit Editorial Article';
    document.getElementById('post_id').value = post.id;
    document.getElementById('post_title').value = post.title;
    document.getElementById('post_category_id').value = post.category_id;
    document.getElementById('post_author_name').value = post.author_name;
    document.getElementById('post_featured_image').value = post.featured_image || '';
    document.getElementById('post_summary').value = post.summary;
    document.getElementById('post_content').value = post.content || '';
    document.getElementById('post_is_featured').checked = (post.is_featured == 1);
    document.getElementById('post_is_published').checked = (post.is_published == 1);

    const modal = new bootstrap.Modal(document.getElementById('blogModal'));
    modal.show();
}

function togglePublish(id) {
    fetch('<?= base_url('admin/blog/toggle') ?>/' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (!data.status) {
            alert('Failed to toggle publish status');
        }
    })
    .catch(() => alert('Network error toggling status'));
}

function toggleFeatured(id) {
    fetch('<?= base_url('admin/blog/toggle-featured') ?>/' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (!data.status) {
            alert('Failed to toggle featured status');
        }
    })
    .catch(() => alert('Network error toggling featured'));
}
</script>

<?= $this->endSection() ?>
