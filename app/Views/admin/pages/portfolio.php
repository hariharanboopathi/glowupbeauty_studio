<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="glass-panel p-4 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h3 class="mb-1 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Haute Artistry Showcase</h3>
            <p class="text-muted mb-0" style="font-size: 13px;">Curated visual lookbook and bridal portfolio masonry grid displayed across patron touchpoints.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('admin/website/gallery') ?>" class="btn btn-luxury-primary btn-sm d-flex align-items-center gap-1">
                <span class="material-symbols-outlined" style="font-size: 18px;">settings_photo_camera</span>
                <span>Manage All Assets</span>
            </a>
            <a href="<?= base_url('gallery') ?>" target="_blank" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                <span class="material-symbols-outlined" style="font-size: 18px;">open_in_new</span>
                <span>Preview Public Lookbook</span>
            </a>
        </div>
    </div>
</div>

<!-- Portfolio Masonry Cards Grid -->
<div class="row g-4">
    <?php if (!empty($items) && count($items) > 0): ?>
        <?php foreach ($items as $item): ?>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="glass-panel p-0 h-100 d-flex flex-column" style="border-radius: 16px; overflow: hidden; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div style="height: 220px; position: relative; overflow: hidden; background: #faf7f5;">
                        <?php 
                            $imgSrc = $item['image_url'];
                            if (!str_starts_with($imgSrc, 'http')) {
                                $imgSrc = base_url($imgSrc);
                            }
                        ?>
                        <img src="<?= esc($imgSrc) ?>" alt="<?= esc($item['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1560066984-138dadb4c035?w=400&q=80'">
                        
                        <div style="position: absolute; top: 12px; left: 12px;">
                            <span class="badge" style="background: rgba(26, 14, 36, 0.85); backdrop-filter: blur(8px); color: #eedcd6; font-size: 10.5px; text-transform: uppercase; letter-spacing: 0.05em; padding: 4px 10px; border-radius: 6px;">
                                <?= esc(ucfirst($item['category'])) ?>
                            </span>
                        </div>

                        <?php if ($item['is_featured']): ?>
                            <div style="position: absolute; top: 12px; right: 12px;">
                                <span class="badge" style="background: #c98860; color: #fff; font-size: 10px; padding: 4px 8px; border-radius: 6px; display: flex; align-items: center; gap: 2px;">
                                    <span class="material-symbols-outlined" style="font-size: 12px;">star</span>
                                    <span>Featured</span>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <h6 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif; color: var(--text-main); font-size: 15px;">
                            <?= esc($item['title']) ?>
                        </h6>
                        <p class="text-muted small mb-3 flex-grow-1" style="font-size: 12px; line-height: 1.5;">
                            <?= esc($item['description'] ?? 'Artisan bridal & skin finishing.') ?>
                        </p>
                        <div class="d-flex align-items-center justify-content-between pt-2 border-top" style="border-color: var(--border-subtle) !important;">
                            <span class="badge <?= $item['is_active'] ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' ?>" style="font-size: 10px; border-radius: 999px; padding: 3px 8px;">
                                <?= $item['is_active'] ? 'Active Lookbook' : 'Hidden' ?>
                            </span>
                            <a href="<?= base_url('admin/website/gallery?q=' . urlencode($item['title'])) ?>" class="btn btn-sm btn-link p-0 text-decoration-none" style="color: var(--accent); font-size: 11.5px; font-weight: 600;">
                                Edit Asset &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="glass-panel p-5 text-center">
                <span class="material-symbols-outlined text-muted" style="font-size: 52px; opacity: 0.4;">auto_awesome_mosaic</span>
                <h5 class="mt-3 text-muted">No portfolio items available</h5>
                <p class="text-muted small mb-3">Add items in the Gallery manager to populate this showcase.</p>
                <a href="<?= base_url('admin/website/gallery') ?>" class="btn btn-luxury-primary btn-sm">Go to Gallery Manager</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
