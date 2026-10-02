<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-main); margin-bottom: 4px;">
            Frontend Footer Management
        </h2>
        <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
            Customize brand statements, newsletter subscriptions, quick links, treatments, concierge contact info, and social channels in real-time.
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('/') ?>" target="_blank" class="btn-ghost-glow" title="View live frontend footer">
            <span class="material-symbols-outlined" style="font-size: 18px;">preview</span>
            Live Preview
        </a>
    </div>
</div>

<!-- SECTION QUICK NAV PILLS -->
<div class="d-flex align-items-center gap-2 mb-4 overflow-auto pb-2" style="scrollbar-width: none;">
    <a href="#sectionBrand" class="btn-ghost-glow" style="padding: 6px 14px; font-size: 12px; border-radius: 999px;">
        <span class="material-symbols-outlined" style="font-size: 16px;">branding_watermark</span>
        Brand
    </a>
    <a href="#sectionQuickLinks" class="btn-ghost-glow" style="padding: 6px 14px; font-size: 12px; border-radius: 999px;">
        <span class="material-symbols-outlined" style="font-size: 16px;">link</span>
        Quick Links (<?= count($quickLinks ?? []) ?>)
    </a>
    <a href="#sectionTreatments" class="btn-ghost-glow" style="padding: 6px 14px; font-size: 12px; border-radius: 999px;">
        <span class="material-symbols-outlined" style="font-size: 16px;">spa</span>
        Treatments (<?= count($popularTreatments ?? []) ?>)
    </a>
    <a href="#sectionConcierge" class="btn-ghost-glow" style="padding: 6px 14px; font-size: 12px; border-radius: 999px;">
        <span class="material-symbols-outlined" style="font-size: 16px;">contact_support</span>
        Concierge
    </a>
    <a href="#sectionSocial" class="btn-ghost-glow" style="padding: 6px 14px; font-size: 12px; border-radius: 999px;">
        <span class="material-symbols-outlined" style="font-size: 16px;">share</span>
        Social
    </a>
    <a href="#sectionBottom" class="btn-ghost-glow" style="padding: 6px 14px; font-size: 12px; border-radius: 999px;">
        <span class="material-symbols-outlined" style="font-size: 16px;">copyright</span>
        Bottom
    </a>
</div>

<div class="row g-4">

    <!-- ==================== 1. BRAND & IDENTITY ==================== -->
    <div class="col-lg-6" id="sectionBrand">
        <div class="glass-panel h-100">
            <div class="panel-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="color: var(--accent);">badge</span>
                        Brand Information
                    </h3>
                    <div class="subtitle">Main studio brand name, tagline, and mission statement</div>
                </div>
            </div>

            <form action="<?= base_url('admin/website/footer/update-brand') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label-glow">Brand Name *</label>
                    <input type="text" name="brand_name" class="form-control form-control-glow" value="<?= esc($settings['brand_name'] ?? 'Glowup') ?>" required />
                </div>

                <div class="mb-3">
                    <label class="form-label-glow">Subtitle / Tagline</label>
                    <input type="text" name="brand_subtitle" class="form-control form-control-glow" value="<?= esc($settings['brand_subtitle'] ?? 'Beauty Studio & Academy') ?>" />
                </div>

                <div class="mb-4">
                    <label class="form-label-glow">Brand Description / Philosophy</label>
                    <textarea name="brand_description" rows="3" class="form-control form-control-glow"><?= esc($settings['brand_description'] ?? '') ?></textarea>
                    <small style="font-size: 11px; color: var(--text-dim);">Shown beneath the logo in the first footer column.</small>
                </div>

                <button type="submit" class="btn-glow">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Save Brand Details
                </button>
            </form>
        </div>
    </div>

    <!-- ==================== 2. NEWSLETTER ==================== -->
    <div class="col-lg-6" id="sectionNewsletter">
        <div class="glass-panel h-100">
            <div class="panel-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="color: var(--accent);">mark_email_read</span>
                        Newsletter Subscription
                    </h3>
                    <div class="subtitle">Private journal invitation and submission button text</div>
                </div>
            </div>

            <form action="<?= base_url('admin/website/footer/update-newsletter') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label-glow">Newsletter Title *</label>
                    <input type="text" name="newsletter_title" class="form-control form-control-glow" value="<?= esc($settings['newsletter_title'] ?? 'Private Journal') ?>" required />
                </div>

                <div class="mb-3">
                    <label class="form-label-glow">Newsletter Description</label>
                    <textarea name="newsletter_desc" rows="2" class="form-control form-control-glow"><?= esc($settings['newsletter_desc'] ?? '') ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label-glow">Button Text *</label>
                    <input type="text" name="newsletter_btn_text" class="form-control form-control-glow" value="<?= esc($settings['newsletter_btn_text'] ?? 'Join') ?>" required />
                </div>

                <button type="submit" class="btn-glow">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Save Newsletter Settings
                </button>
            </form>
        </div>
    </div>

    <!-- ==================== 3. QUICK LINKS ==================== -->
    <div class="col-12" id="sectionQuickLinks">
        <div class="glass-panel">
            <div class="panel-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="color: var(--accent);">link</span>
                        Quick Links Column
                    </h3>
                    <div class="subtitle">Navigation links displayed in the second column of the footer</div>
                </div>
                <button type="button" class="btn-glow" onclick="openAddLinkModal('quick_links', 'Quick Link')">
                    <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                    Add Quick Link
                </button>
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
                                    No Quick Links configured. Click "Add Quick Link" above to add one.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== 4. POPULAR TREATMENTS ==================== -->
    <div class="col-12" id="sectionTreatments">
        <div class="glass-panel">
            <div class="panel-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="color: var(--accent);">spa</span>
                        Popular Treatments Column
                    </h3>
                    <div class="subtitle">Highlighted treatment links displayed in the third column of the footer</div>
                </div>
                <button type="button" class="btn-glow" onclick="openAddLinkModal('popular_treatments', 'Treatment Link')">
                    <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                    Add Treatment
                </button>
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
                                                onclick="openEditLinkModal(<?= htmlspecialchars(json_encode($link), ENT_QUOTES, 'UTF-8') ?>)">
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
                                    No Popular Treatments configured. Click "Add Treatment" above to add one.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== 5. ACADEMY CONCIERGE ==================== -->
    <div class="col-lg-6" id="sectionConcierge">
        <div class="glass-panel h-100">
            <div class="panel-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="color: var(--accent);">support_agent</span>
                        Academy Concierge Contact
                    </h3>
                    <div class="subtitle">Location, phone number, email, and studio hours in fourth column</div>
                </div>
            </div>

            <form action="<?= base_url('admin/website/footer/update-concierge') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label-glow">Section Title *</label>
                    <input type="text" name="concierge_title" class="form-control form-control-glow" value="<?= esc($settings['concierge_title'] ?? 'Academy Concierge') ?>" required />
                </div>

                <div class="mb-3">
                    <label class="form-label-glow">Physical Location / Address</label>
                    <textarea name="concierge_address" rows="2" class="form-control form-control-glow"><?= esc($settings['concierge_address'] ?? '') ?></textarea>
                    <small style="font-size: 11px; color: var(--text-dim);">e.g. Flagship Academy: 12 Madurai, Tamil Nadu</small>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="form-label-glow">Direct Phone (Dialer / Call)</label>
                        <input type="text" name="concierge_phone" class="form-control form-control-glow" value="<?= esc($settings['concierge_phone'] ?? '+91 98200 12345') ?>" />
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-glow">WhatsApp Business Number</label>
                        <input type="text" name="concierge_whatsapp" class="form-control form-control-glow" value="<?= esc($settings['concierge_whatsapp'] ?? ($settings['concierge_phone'] ?? '+91 98200 12345')) ?>" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="form-label-glow">Email Address</label>
                        <input type="email" name="concierge_email" class="form-control form-control-glow" value="<?= esc($settings['concierge_email'] ?? 'glowup@gmail.com') ?>" />
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-glow">Opening Hours</label>
                        <input type="text" name="concierge_hours" class="form-control form-control-glow" value="<?= esc($settings['concierge_hours'] ?? 'Tue – Sun: 10:00 AM – 8:00 PM') ?>" />
                    </div>
                </div>

                <button type="submit" class="btn-glow">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Save Concierge Info
                </button>
            </form>
        </div>
    </div>

    <!-- ==================== 6. SOCIAL MEDIA ==================== -->
    <div class="col-lg-6" id="sectionSocial">
        <div class="glass-panel h-100">
            <div class="panel-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="color: var(--accent);">share</span>
                        Social Media Channels
                    </h3>
                    <div class="subtitle">Platform URLs linked to the round icon badges</div>
                </div>
            </div>

            <form action="<?= base_url('admin/website/footer/update-social') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <label class="form-label-glow mb-0" for="social_instagram">
                            <span class="material-symbols-outlined" style="font-size: 16px;">photo_camera</span>
                            Instagram Profile URL
                        </label>
                        <button type="button" class="btn-ghost-glow py-0 px-2" style="font-size: 11px; height: 22px; border-radius: 4px;" title="Clear URL" onclick="document.getElementById('social_instagram').value='';">
                            Clear
                        </button>
                    </div>
                    <input type="text" id="social_instagram" name="social_instagram" class="form-control form-control-glow" value="<?= esc($settings['social_instagram'] ?? '#') ?>" />
                </div>

                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <label class="form-label-glow mb-0" for="social_pinterest">
                            <span class="material-symbols-outlined" style="font-size: 16px;">push_pin</span>
                            Pinterest URL
                        </label>
                        <button type="button" class="btn-ghost-glow py-0 px-2" style="font-size: 11px; height: 22px; border-radius: 4px;" title="Clear URL" onclick="document.getElementById('social_pinterest').value='';">
                            Clear
                        </button>
                    </div>
                    <input type="text" id="social_pinterest" name="social_pinterest" class="form-control form-control-glow" value="<?= esc($settings['social_pinterest'] ?? '#') ?>" />
                </div>

                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <label class="form-label-glow mb-0" for="social_facebook">
                            <span class="material-symbols-outlined" style="font-size: 16px;">facebook</span>
                            Facebook Page URL
                        </label>
                        <button type="button" class="btn-ghost-glow py-0 px-2" style="font-size: 11px; height: 22px; border-radius: 4px;" title="Clear URL" onclick="document.getElementById('social_facebook').value='';">
                            Clear
                        </button>
                    </div>
                    <input type="text" id="social_facebook" name="social_facebook" class="form-control form-control-glow" value="<?= esc($settings['social_facebook'] ?? '#') ?>" />
                </div>

                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <label class="form-label-glow mb-0" for="social_youtube">
                            <span class="material-symbols-outlined" style="font-size: 16px;">smart_display</span>
                            YouTube Channel URL
                        </label>
                        <button type="button" class="btn-ghost-glow py-0 px-2" style="font-size: 11px; height: 22px; border-radius: 4px;" title="Clear URL" onclick="document.getElementById('social_youtube').value='';">
                            Clear
                        </button>
                    </div>
                    <input type="text" id="social_youtube" name="social_youtube" class="form-control form-control-glow" value="<?= esc($settings['social_youtube'] ?? '#') ?>" />
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <label class="form-label-glow mb-0" for="social_location">
                            <span class="material-symbols-outlined" style="font-size: 16px;">public</span>
                            Google Maps / Location URL
                        </label>
                        <button type="button" class="btn-ghost-glow py-0 px-2" style="font-size: 11px; height: 22px; border-radius: 4px;" title="Clear URL" onclick="document.getElementById('social_location').value='';">
                            Clear
                        </button>
                    </div>
                    <input type="text" id="social_location" name="social_location" class="form-control form-control-glow" value="<?= esc($settings['social_location'] ?? '#') ?>" />
                </div>

                <button type="submit" class="btn-glow">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Save Social Links
                </button>
            </form>
        </div>
    </div>

    <!-- ==================== 7. FOOTER BOTTOM ==================== -->
    <div class="col-12" id="sectionBottom">
        <div class="glass-panel">
            <div class="panel-header">
                <div>
                    <h3>
                        <span class="material-symbols-outlined" style="color: var(--accent);">copyright</span>
                        Footer Bottom Notes &amp; Legal
                    </h3>
                    <div class="subtitle">Copyright line and additional pricing disclaimer</div>
                </div>
            </div>

            <form action="<?= base_url('admin/website/footer/update-bottom') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-glow">Copyright Statement *</label>
                        <input type="text" name="copyright_text" class="form-control form-control-glow" value="<?= esc($settings['copyright_text'] ?? '') ?>" required />
                        <small style="font-size: 11px; color: var(--text-dim);">Left side of the footer baseline.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-glow">Additional Footer Disclaimer Text</label>
                        <input type="text" name="additional_text" class="form-control form-control-glow" value="<?= esc($settings['additional_text'] ?? '') ?>" />
                        <small style="font-size: 11px; color: var(--text-dim);">Right side of the footer baseline (e.g. hair length pricing notice).</small>
                    </div>
                </div>

                <button type="submit" class="btn-glow">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Save Footer Bottom Notes
                </button>
            </form>
        </div>
    </div>

</div>

<!-- ==================== LINK MODAL (ADD / EDIT) ==================== -->
<div class="modal fade" id="linkModal" tabindex="-1" aria-labelledby="linkModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-glow">
            <div class="modal-header modal-header-glow">
                <h5 class="modal-title" id="linkModalTitle">Add Link</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/website/footer/link/save') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="modalLinkId" value="0" />
                <input type="hidden" name="group_name" id="modalLinkGroup" value="quick_links" />

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label-glow">Link Title / Label *</label>
                        <input type="text" name="title" id="modalLinkTitle" class="form-control form-control-glow" placeholder="e.g. Facial Ritual" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label-glow">Target URL / Route *</label>
                        <input type="text" name="url" id="modalLinkUrl" class="form-control form-control-glow" placeholder="e.g. services, about, or https://..." required />
                        <small style="font-size: 11px; color: var(--text-dim);">Enter relative route like <code>services</code> or full URL.</small>
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

    function openAddLinkModal(groupName, label) {
        document.getElementById('linkModalTitle').innerText = 'Add ' + label;
        document.getElementById('modalLinkId').value = '0';
        document.getElementById('modalLinkGroup').value = groupName;
        document.getElementById('modalLinkTitle').value = '';
        document.getElementById('modalLinkUrl').value = '';
        document.getElementById('modalLinkOrder').value = '0';
        document.getElementById('modalLinkStatus').checked = true;

        getLinkModal().show();
    }

    function openEditLinkModal(linkData) {
        const groupLabel = linkData.group_name === 'quick_links' ? 'Quick Link' : 'Treatment Link';
        document.getElementById('linkModalTitle').innerText = 'Edit ' + groupLabel;
        document.getElementById('modalLinkId').value = linkData.id;
        document.getElementById('modalLinkGroup').value = linkData.group_name;
        document.getElementById('modalLinkTitle').value = linkData.title || '';
        document.getElementById('modalLinkUrl').value = linkData.url || '';
        document.getElementById('modalLinkOrder').value = linkData.sort_order || 0;
        document.getElementById('modalLinkStatus').checked = parseInt(linkData.status) === 1;

        getLinkModal().show();
    }
</script>

<?= $this->endSection() ?>
