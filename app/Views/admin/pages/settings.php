<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<form action="<?= base_url('admin/settings/save') ?>" method="POST">
    <?= csrf_field() ?>

    <div class="row g-4">
        <!-- Left Column: Studio Identity & Contact -->
        <div class="col-lg-8">
            <!-- Studio Identity Card -->
            <div class="glass-panel p-4 mb-4">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                    <span class="material-symbols-outlined" style="color: var(--accent);">storefront</span>
                    <h5 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                        Studio Identity & Branding
                    </h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Studio Brand Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="brand_name" class="form-control" required value="<?= esc($settings['brand_name'] ?? 'Glowup') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Brand Subtitle / Tagline
                        </label>
                        <input type="text" name="brand_subtitle" class="form-control" value="<?= esc($settings['brand_subtitle'] ?? 'Beauty Studio & Academy') ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Brand Narrative & Mission Bio
                        </label>
                        <textarea name="brand_description" rows="3" class="form-control"><?= esc($settings['brand_description'] ?? '') ?></textarea>
                        <small class="text-muted" style="font-size: 11px;">Displayed across the footer, SEO metadata, and patron welcome touchpoints.</small>
                    </div>
                </div>
            </div>

            <!-- Concierge & Location Card -->
            <div class="glass-panel p-4 mb-4">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                    <span class="material-symbols-outlined" style="color: var(--accent);">contact_phone</span>
                    <h5 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                        Concierge, Location & Hours
                    </h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Concierge Direct Phone
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><span class="material-symbols-outlined" style="font-size: 18px; color: var(--text-muted);">call</span></span>
                            <input type="text" name="concierge_phone" class="form-control" value="<?= esc($settings['concierge_phone'] ?? '+91 98200 12345') ?>" placeholder="+91 98200 12345">
                        </div>
                        <small class="text-muted" style="font-size: 11px;">Used for customer phone dialer click-to-call actions.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Concierge WhatsApp Number
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><span class="material-symbols-outlined" style="font-size: 18px; color: #25D366;">chat</span></span>
                            <input type="text" name="concierge_whatsapp" class="form-control" value="<?= esc($settings['concierge_whatsapp'] ?? ($settings['concierge_phone'] ?? '+91 98200 12345')) ?>" placeholder="+91 98200 12345">
                        </div>
                        <small class="text-muted" style="font-size: 11px;">Formatted automatically to wa.me international click-to-chat format.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Concierge Inquiries Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><span class="material-symbols-outlined" style="font-size: 18px; color: var(--text-muted);">mail</span></span>
                            <input type="email" name="concierge_email" class="form-control" value="<?= esc($settings['concierge_email'] ?? 'glowup@gmail.com') ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Operating Hours Schedule
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><span class="material-symbols-outlined" style="font-size: 18px; color: var(--text-muted);">schedule</span></span>
                            <input type="text" name="concierge_hours" class="form-control" value="<?= esc($settings['concierge_hours'] ?? 'Tue – Sun: 10:00 AM – 8:00 PM') ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Copyright Declaration
                        </label>
                        <input type="text" name="copyright_text" class="form-control" value="<?= esc($settings['copyright_text'] ?? '© 2026 Glowup Beauty Studio & Academy. All Rights Reserved.') ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Flagship Academy Physical Address
                        </label>
                        <textarea name="concierge_address" rows="2" class="form-control"><?= esc($settings['concierge_address'] ?? "Flagship Academy:\n12 Madurai, Tamil Nadu") ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Social Media Channels Card -->
            <div class="glass-panel p-4 mb-4">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                    <span class="material-symbols-outlined" style="color: var(--accent);">share</span>
                    <h5 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                        Social Media Channels
                    </h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Instagram Profile URL
                        </label>
                        <input type="text" name="social_instagram" class="form-control" value="<?= esc($settings['social_instagram'] ?? '#') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Facebook Page URL
                        </label>
                        <input type="text" name="social_facebook" class="form-control" value="<?= esc($settings['social_facebook'] ?? '#') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            YouTube Channel URL
                        </label>
                        <input type="text" name="social_youtube" class="form-control" value="<?= esc($settings['social_youtube'] ?? '#') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Pinterest Moodboards URL
                        </label>
                        <input type="text" name="social_pinterest" class="form-control" value="<?= esc($settings['social_pinterest'] ?? '#') ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Quick Status & Quick Links -->
        <div class="col-lg-4">
            <!-- Publishing Actions Box -->
            <div class="glass-panel p-4 mb-4">
                <h6 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Save Changes</h6>
                <p class="text-muted small mb-3" style="font-size: 12px; line-height: 1.5;">
                    Updates take effect immediately across all website views, emails, footers, and appointment booking confirmation screens.
                </p>
                <button type="submit" class="btn btn-luxury-primary w-100 py-2 d-flex align-items-center justify-content-center gap-2">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    <span>Save Studio Settings</span>
                </button>
            </div>

            <!-- Quick Jump Navigation Card -->
            <div class="glass-panel p-4">
                <h6 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--text-main);">Settings Shortcuts</h6>
                <div class="list-group list-group-flush" style="font-size: 13px;">
                    <a href="<?= base_url('admin/settings/profile') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between px-0 bg-transparent">
                        <span class="d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined text-muted" style="font-size: 18px;">manage_accounts</span>
                            <span>Admin Profile & Security</span>
                        </span>
                        <span class="material-symbols-outlined text-muted" style="font-size: 16px;">chevron_right</span>
                    </a>
                    <a href="<?= base_url('admin/website/footer') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between px-0 bg-transparent">
                        <span class="d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined text-muted" style="font-size: 18px;">dock_to_bottom</span>
                            <span>Website Footer CMS</span>
                        </span>
                        <span class="material-symbols-outlined text-muted" style="font-size: 16px;">chevron_right</span>
                    </a>
                    <a href="<?= base_url('admin/website/homepage') ?>" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between px-0 bg-transparent">
                        <span class="d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined text-muted" style="font-size: 18px;">home</span>
                            <span>Homepage CMS Console</span>
                        </span>
                        <span class="material-symbols-outlined text-muted" style="font-size: 16px;">chevron_right</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>
