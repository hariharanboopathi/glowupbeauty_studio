<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<style>
    /* Consistent CMS Design System Tokens matching website_aboutus & website_services */
    .cms-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        padding: 24px;
        margin-bottom: 24px;
    }

    .nav-tabs-cms {
        border-bottom: 2px solid #ede6e4;
        gap: 8px;
    }

    .nav-tabs-cms .nav-link {
        border: none;
        color: #7a6e78;
        font-size: 13.5px;
        font-weight: 600;
        padding: 12px 18px;
        border-radius: 10px 10px 0 0;
        background: transparent;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .nav-tabs-cms .nav-link:hover {
        color: #592E83;
        background: rgba(89, 46, 131, 0.04);
    }

    .nav-tabs-cms .nav-link.active {
        color: #592E83;
        background: #ffffff;
        border-bottom: 3px solid #592E83;
        font-weight: 700;
    }

    .clean-input, .clean-select, .clean-textarea {
        background-color: #ffffff !important;
        border: 1px solid #d5ccd3 !important;
        border-radius: 10px !important;
        color: #483C46 !important;
        font-size: 13.5px !important;
        padding: 10px 14px !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
    }

    .clean-input:focus, .clean-select:focus, .clean-textarea:focus {
        border-color: #592E83 !important;
        box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.18) !important;
        outline: none !important;
    }

    .form-field-label {
        font-size: 12px;
        letter-spacing: 0.04em;
        font-weight: 700;
        color: #483C46;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-field-label .material-symbols-outlined {
        color: #592E83;
        font-size: 17px;
    }

    .form-field-hint {
        font-size: 11.5px;
        color: #7a6e78;
        margin-top: 4px;
        line-height: 1.4;
    }

    .btn-clean-primary {
        background: linear-gradient(135deg, #592E83, #48236d);
        color: #ffffff !important;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 20px;
        border-radius: 10px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 3px 10px rgba(89, 46, 131, 0.25);
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-clean-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(89, 46, 131, 0.35);
        color: #ffffff !important;
    }

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
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-clean-secondary:hover {
        background: #fbf6f4;
        color: #8a5540 !important;
        border-color: #8a5540;
    }

    .logo-preview-box {
        background: #faf8fb;
        border: 1px solid #ede6e4;
        border-radius: 12px;
        padding: 16px;
        transition: all 0.2s ease;
    }

    .logo-preview-thumbnail {
        height: 64px;
        max-width: 100%;
        object-fit: contain;
        background: #2a2228;
        padding: 10px 18px;
        border-radius: 8px;
        border: 1px solid #ede6e4;
    }

    .footer-live-preview-card {
        background: #181317;
        color: #f7f4f6;
        border-radius: 14px;
        border: 1px solid #362934;
        padding: 24px;
        position: sticky;
        top: 90px;
        box-shadow: 0 10px 30px rgba(72, 60, 70, 0.12);
    }

    .preview-brand-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.45rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #ffffff;
        line-height: 1.2;
    }

    .preview-brand-tagline {
        font-size: 10px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #c98860;
        font-weight: 700;
        margin-top: 3px;
    }

    .preview-brand-description {
        font-size: 12.5px;
        color: #bfb5be;
        line-height: 1.7;
        margin-top: 12px;
    }
</style>

<!-- ==================== FOOTER CMS TABS ==================== -->
<ul class="nav nav-tabs nav-tabs-cms mb-4" id="footerNavTabs">
    <li class="nav-item">
        <a class="nav-link active" href="<?= base_url('admin/website/footer/brand') ?>">
            <span class="material-symbols-outlined" style="font-size: 18px;">badge</span>
            <span>Brand &amp; Logo</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/website/footer/quick-links') ?>">
            <span class="material-symbols-outlined" style="font-size: 18px;">link</span>
            <span>Quick Links</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/website/footer/treatments') ?>">
            <span class="material-symbols-outlined" style="font-size: 18px;">spa</span>
            <span>Popular Treatments</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/website/footer/concierge') ?>">
            <span class="material-symbols-outlined" style="font-size: 18px;">support_agent</span>
            <span>Academy Concierge</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/website/footer/social') ?>">
            <span class="material-symbols-outlined" style="font-size: 18px;">share</span>
            <span>Social Channels</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/website/footer/bottom') ?>">
            <span class="material-symbols-outlined" style="font-size: 18px;">copyright</span>
            <span>Bottom &amp; Legal</span>
        </a>
    </li>
</ul>

<!-- ==================== MAIN BRAND MANAGEMENT CARD ==================== -->
<div class="cms-card">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom flex-wrap gap-3">
        <div>
            <h4 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #483C46; margin: 0; font-weight: 700;">
                Footer Brand Identity
            </h4>
            <p style="font-size: 12.5px; color: #7a6e78; margin: 3px 0 0;">
                Manage the signature studio moniker, sub-tagline, philosophy statement, and brand logo shown on the public footer.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('/') ?>" target="_blank" class="btn-clean-secondary" style="padding: 7px 14px; font-size: 12px;">
                <span>View Live Site</span>
                <span class="material-symbols-outlined" style="font-size: 15px;">open_in_new</span>
            </a>
        </div>
    </div>

    <form action="<?= base_url('admin/website/footer/update-brand') ?>" method="POST" enctype="multipart/form-data" id="brandForm">
        <?= csrf_field() ?>

        <div class="row g-4">
            <!-- LEFT COLUMN: FORM CONTROLS -->
            <div class="col-lg-7 col-xl-8">

                <!-- 1. BRAND NAME -->
                <div class="mb-3">
                    <label class="form-field-label" for="brandNameInput">
                        <span class="material-symbols-outlined">title</span>
                        Brand Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="brand_name" id="brandNameInput" 
                           class="form-control clean-input" 
                           value="<?= esc($settings['brand_name'] ?? 'Glowup') ?>" 
                           required 
                           placeholder="e.g., Glowup" />
                    <div class="form-field-hint">
                        Rendered prominently in the first column of the footer and in browser search indexing.
                    </div>
                </div>

                <!-- 2. BRAND SUBTITLE / TAGLINE -->
                <div class="mb-3">
                    <label class="form-field-label" for="brandSubtitleInput">
                        <span class="material-symbols-outlined">subtitles</span>
                        Subtitle / Tagline
                    </label>
                    <input type="text" name="brand_subtitle" id="brandSubtitleInput" 
                           class="form-control clean-input" 
                           value="<?= esc($settings['brand_subtitle'] ?? 'Beauty Studio & Academy') ?>" 
                           placeholder="e.g., Beauty Studio & Academy" />
                    <div class="form-field-hint">
                        Displayed in tracked luxury uppercase letters directly beneath the brand title.
                    </div>
                </div>

                <!-- 3. BRAND DESCRIPTION -->
                <div class="mb-4">
                    <label class="form-field-label" for="brandDescriptionInput">
                        <span class="material-symbols-outlined">description</span>
                        Brand Description / Philosophy
                    </label>
                    <textarea name="brand_description" id="brandDescriptionInput" rows="4" 
                              class="form-control clean-textarea" 
                              placeholder="An academy of mindful beauty, bespoke haircare, and transformative aesthetic therapies crafted for your natural radiance."><?= esc($settings['brand_description'] ?? '') ?></textarea>
                    <div class="form-field-hint d-flex align-items-center justify-content-between">
                        <span>Editorial philosophy displayed beneath the brand title in the first footer column.</span>
                        <span id="charCount" class="text-muted" style="font-size: 11px;">0 / 1000</span>
                    </div>
                </div>

                <!-- 4. LOGO UPLOADER BOX -->
                <div class="logo-preview-box mb-4">
                    <label class="form-field-label mb-2">
                        <span class="material-symbols-outlined">image</span>
                        Brand Logo Image (Optional)
                    </label>

                    <?php 
                        $hasCustomLogo = !empty($settings['brand_logo']) && file_exists(FCPATH . $settings['brand_logo']); 
                        $logoUrl = $hasCustomLogo ? base_url($settings['brand_logo']) : '';
                    ?>

                    <div class="d-flex align-items-start gap-3 mb-3 flex-wrap">
                        <div class="text-center">
                            <div style="font-size: 11px; font-weight: 700; color: #7a6e78; margin-bottom: 4px; text-transform: uppercase;">
                                Current / Active Logo
                            </div>
                            <div id="activeLogoContainer">
                                <?php if ($hasCustomLogo): ?>
                                    <img src="<?= esc($logoUrl) ?>" id="activeLogoImg" class="logo-preview-thumbnail" alt="Active Footer Logo" />
                                <?php else: ?>
                                    <div class="logo-preview-thumbnail d-flex align-items-center justify-content-center text-muted" style="min-width: 140px; font-size: 12px; font-style: italic;">
                                        No Image (Text Moniker)
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div id="newLogoPreviewContainer" class="text-center" style="display: none;">
                            <div style="font-size: 11px; font-weight: 700; color: #592E83; margin-bottom: 4px; text-transform: uppercase;">
                                New Selected Logo
                            </div>
                            <img src="" id="newLogoPreviewImg" class="logo-preview-thumbnail" style="border: 2px dashed #592E83;" alt="New Logo Preview" />
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600; color: #483C46;">Upload New Logo File</label>
                        <input type="file" name="brand_logo" id="brandLogoInput" 
                               class="form-control clean-input" 
                               accept="image/png,image/jpeg,image/webp,image/svg+xml" />
                    </div>

                    <?php if ($hasCustomLogo): ?>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="removeLogoCheck" style="cursor: pointer;">
                            <label class="form-check-label" for="removeLogoCheck" style="font-size: 12px; color: #dc2626; cursor: pointer; font-weight: 600;">
                                Remove custom logo and revert to text title
                            </label>
                        </div>
                    <?php endif; ?>

                    <div class="mt-2 p-2 rounded" style="background: rgba(89, 46, 131, 0.04); border: 1px solid rgba(89, 46, 131, 0.08); font-size: 11px; color: #592E83;">
                        <span class="material-symbols-outlined align-middle" style="font-size: 14px;">info</span>
                        Supported formats: <strong>PNG, JPG, WEBP, SVG</strong> &bull; Max size: <strong>2MB</strong> &bull; Recommended transparent background with height between 40px &ndash; 60px.
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: LIVE FRONTEND FOOTER PREVIEW CARD -->
            <div class="col-lg-5 col-xl-4">
                <div class="footer-live-preview-card">
                    <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom" style="border-color: rgba(255,255,255,0.12) !important;">
                        <span class="d-flex align-items-center gap-1" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: #c98860; font-weight: 700;">
                            <span class="material-symbols-outlined" style="font-size: 14px;">visibility</span>
                            Live Frontend Preview
                        </span>
                        <span class="badge" style="background: rgba(201, 136, 96, 0.2); color: #c98860; font-size: 10px; border: 1px solid rgba(201, 136, 96, 0.3);">
                            Column 1
                        </span>
                    </div>

                    <!-- PREVIEW BRAND CONTAINER -->
                    <div class="footer-brand-preview mb-3">
                        <div id="previewLogoWrapper" style="<?= $hasCustomLogo ? '' : 'display: none;' ?>" class="mb-2">
                            <img src="<?= esc($logoUrl) ?>" id="previewLogoImg" alt="Brand Logo Preview" style="max-height: 48px; max-width: 180px; object-fit: contain;" />
                        </div>
                        <div class="preview-brand-heading" id="previewBrandName">
                            <?= esc($settings['brand_name'] ?? 'Glowup') ?>
                        </div>
                        <div class="preview-brand-tagline" id="previewBrandSubtitle">
                            <?= esc($settings['brand_subtitle'] ?? 'Beauty Studio & Academy') ?>
                        </div>
                    </div>

                    <div class="preview-brand-description" id="previewBrandDesc">
                        <?= nl2br(esc($settings['brand_description'] ?? 'An academy of mindful beauty, bespoke haircare, and transformative aesthetic therapies crafted for your natural radiance.')) ?>
                    </div>

                    <!-- MOCK NEWSLETTER PREVIEW TO SHOW CONTEXT -->
                    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.08);">
                        <div style="font-size: 11px; font-weight: 700; color: #e5dde4; text-transform: uppercase; letter-spacing: 0.05em;">
                            <?= esc($settings['newsletter_title'] ?? 'Private Journal') ?>
                        </div>
                        <div style="font-size: 11px; color: #8f828e; margin-top: 2px;">
                            <?= esc($settings['newsletter_desc'] ?? 'Receive curated beauty journals and bespoke privileges.') ?>
                        </div>
                        <div class="d-flex mt-2" style="max-width: 260px;">
                            <input type="text" disabled placeholder="patron@domain.com" style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); color: #fff; font-size: 11px; padding: 6px 10px; border-radius: 6px 0 0 6px; width: 70%;">
                            <button type="button" disabled style="background: #A36952; border: none; color: #fff; font-size: 11px; font-weight: 600; padding: 6px 12px; border-radius: 0 6px 6px 0; width: 30%;">
                                <?= esc($settings['newsletter_btn_text'] ?? 'Join') ?>
                            </button>
                        </div>
                    </div>

                    <div class="mt-4 p-2 rounded" style="background: rgba(255, 255, 255, 0.04); font-size: 11px; color: #9f919e; line-height: 1.4;">
                        <span class="material-symbols-outlined align-middle" style="font-size: 13px; color: #c98860;">auto_awesome</span>
                        Interactive: Typing in the form instantly updates this visual display.
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM ACTION STRIP -->
        <div class="d-flex align-items-center justify-content-between pt-4 mt-4 border-top flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2" style="font-size: 12px; color: #7a6e78;">
                <span class="material-symbols-outlined" style="font-size: 16px; color: #592E83;">update</span>
                <span>
                    Last Updated: <strong><?= !empty($settings['updated_at']) ? date('M d, Y h:i A', strtotime($settings['updated_at'])) : 'Recently' ?></strong>
                </span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button type="reset" class="btn-clean-secondary" id="resetBtn">
                    <span class="material-symbols-outlined" style="font-size: 16px;">restart_alt</span>
                    <span>Discard Changes</span>
                </button>
                <button type="submit" class="btn-clean-primary" id="saveBrandBtn">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    <span>Save Brand Details</span>
                </button>
            </div>
        </div>
    </form>
</div>

<!-- ==================== INTERACTION SCRIPTS ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const brandNameInput        = document.getElementById('brandNameInput');
    const brandSubtitleInput    = document.getElementById('brandSubtitleInput');
    const brandDescriptionInput = document.getElementById('brandDescriptionInput');
    const brandLogoInput        = document.getElementById('brandLogoInput');
    const removeLogoCheck       = document.getElementById('removeLogoCheck');
    const charCount             = document.getElementById('charCount');

    // Live preview elements
    const previewBrandName      = document.getElementById('previewBrandName');
    const previewBrandSubtitle  = document.getElementById('previewBrandSubtitle');
    const previewBrandDesc      = document.getElementById('previewBrandDesc');
    const previewLogoWrapper    = document.getElementById('previewLogoWrapper');
    const previewLogoImg        = document.getElementById('previewLogoImg');
    const newLogoPreviewContainer = document.getElementById('newLogoPreviewContainer');
    const newLogoPreviewImg     = document.getElementById('newLogoPreviewImg');

    const initialLogoUrl = <?= json_encode($logoUrl) ?>;
    const hasInitialLogo = <?= $hasCustomLogo ? 'true' : 'false' ?>;

    // 1. Character count and live description update
    function updateCharCount() {
        if (!brandDescriptionInput || !charCount) return;
        const len = brandDescriptionInput.value.length;
        charCount.textContent = `${len} / 1000`;
        if (len > 1000) {
            charCount.classList.add('text-danger');
        } else {
            charCount.classList.remove('text-danger');
        }
    }

    if (brandDescriptionInput) {
        updateCharCount();
        brandDescriptionInput.addEventListener('input', function() {
            updateCharCount();
            if (previewBrandDesc) {
                previewBrandDesc.innerHTML = this.value.trim() 
                    ? this.value.replace(/\n/g, '<br>') 
                    : '<em class="text-muted">No description provided.</em>';
            }
        });
    }

    // 2. Brand Name live sync
    if (brandNameInput && previewBrandName) {
        brandNameInput.addEventListener('input', function() {
            previewBrandName.textContent = this.value.trim() || 'Glowup';
        });
    }

    // 3. Subtitle live sync
    if (brandSubtitleInput && previewBrandSubtitle) {
        brandSubtitleInput.addEventListener('input', function() {
            previewBrandSubtitle.textContent = this.value.trim() || 'Beauty Studio & Academy';
        });
    }

    // 4. Logo File Input Preview Handler
    if (brandLogoInput) {
        brandLogoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Client-side file size verification (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Warning: Selected file size is ' + (file.size / (1024 * 1024)).toFixed(2) + 'MB. Maximum permitted size is 2MB.');
                    this.value = '';
                    if (newLogoPreviewContainer) newLogoPreviewContainer.style.display = 'none';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(evt) {
                    const resultUrl = evt.target.result;
                    if (newLogoPreviewContainer && newLogoPreviewImg) {
                        newLogoPreviewImg.src = resultUrl;
                        newLogoPreviewContainer.style.display = 'block';
                    }
                    if (previewLogoWrapper && previewLogoImg) {
                        previewLogoImg.src = resultUrl;
                        previewLogoWrapper.style.display = 'block';
                    }
                    if (removeLogoCheck) {
                        removeLogoCheck.checked = false;
                    }
                };
                reader.readAsDataURL(file);
            } else {
                if (newLogoPreviewContainer) newLogoPreviewContainer.style.display = 'none';
                if (hasInitialLogo && (!removeLogoCheck || !removeLogoCheck.checked)) {
                    if (previewLogoWrapper && previewLogoImg) {
                        previewLogoImg.src = initialLogoUrl;
                        previewLogoWrapper.style.display = 'block';
                    }
                } else {
                    if (previewLogoWrapper) previewLogoWrapper.style.display = 'none';
                }
            }
        });
    }

    // 5. Remove Logo checkbox handler
    if (removeLogoCheck) {
        removeLogoCheck.addEventListener('change', function() {
            if (this.checked) {
                if (previewLogoWrapper) previewLogoWrapper.style.display = 'none';
                if (newLogoPreviewContainer) newLogoPreviewContainer.style.display = 'none';
                if (brandLogoInput) brandLogoInput.value = '';
            } else {
                if (hasInitialLogo) {
                    if (previewLogoWrapper && previewLogoImg) {
                        previewLogoImg.src = initialLogoUrl;
                        previewLogoWrapper.style.display = 'block';
                    }
                }
            }
        });
    }

    // 6. Reset button handler
    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            setTimeout(function() {
                if (brandNameInput && previewBrandName) {
                    previewBrandName.textContent = brandNameInput.value.trim() || 'Glowup';
                }
                if (brandSubtitleInput && previewBrandSubtitle) {
                    previewBrandSubtitle.textContent = brandSubtitleInput.value.trim() || 'Beauty Studio & Academy';
                }
                if (brandDescriptionInput && previewBrandDesc) {
                    previewBrandDesc.innerHTML = brandDescriptionInput.value.trim() 
                        ? brandDescriptionInput.value.replace(/\n/g, '<br>') 
                        : '';
                    updateCharCount();
                }
                if (newLogoPreviewContainer) {
                    newLogoPreviewContainer.style.display = 'none';
                }
                if (previewLogoWrapper && previewLogoImg) {
                    if (hasInitialLogo) {
                        previewLogoImg.src = initialLogoUrl;
                        previewLogoWrapper.style.display = 'block';
                    } else {
                        previewLogoWrapper.style.display = 'none';
                    }
                }
            }, 50);
        });
    }
});
</script>

<?= $this->endSection() ?>
