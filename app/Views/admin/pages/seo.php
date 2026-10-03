<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Page Selection Bar -->
<div class="glass-panel p-3 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #f4edf7; border: 1px solid #eedcd6; display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined" style="font-size: 24px;">travel_explore</span>
            </div>
            <div>
                <label for="pageSelector" class="form-label mb-0 fw-bold" style="font-size: 13px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">
                    Target Page
                </label>
                <div class="d-flex align-items-center gap-2 mt-1">
                    <select id="pageSelector" class="form-select form-select-sm" style="min-width: 250px; font-weight: 600; color: var(--text-main);" onchange="window.location.href='<?= base_url('admin/seo?page=') ?>' + this.value">
                        <?php foreach ($catalog as $key => $info): ?>
                            <?php $isConfigured = !empty($allIndexed[$key]['seo_title']); ?>
                            <option value="<?= esc($key) ?>" <?= ($activeKey === $key) ? 'selected' : '' ?>>
                                <?= esc($info['name']) ?> (<?= esc($info['route']) ?>) <?= $isConfigured ? '✓' : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1" style="background: #fcfbfa; border: 1px dashed #eedcd6; border-radius: 999px; font-size: 12px; color: var(--text-muted);">
                <span class="material-symbols-outlined" style="font-size: 15px; color: var(--accent);">link</span>
                <span>Public Route: <strong style="color: var(--accent);"><?= esc($activeInfo['route']) ?></strong></span>
            </div>

            <a href="<?= base_url(ltrim($activeInfo['route'], '/')) ?>" target="_blank" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1" style="border-radius: 8px;" title="View Live Page">
                <span class="material-symbols-outlined" style="font-size: 16px;">open_in_new</span>
                <span>View Live Page</span>
            </a>
        </div>
    </div>
</div>

<form action="<?= base_url('admin/seo/save') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="page_key" value="<?= esc($activeKey) ?>">

    <div class="row g-4">
        <!-- Left Column: SEO Meta Inputs -->
        <div class="col-lg-7 col-xl-8">
            <!-- 1. Search Engine Metadata Card -->
            <div class="glass-panel p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom" style="border-color: #ede6e4 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <span class="material-symbols-outlined" style="color: var(--accent);">search</span>
                        <h5 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                            Search Engine Metadata (Google / Bing)
                        </h5>
                    </div>
                    <span class="badge" style="background: #f4edf7; color: var(--accent); border: 1px solid #dfcfeb;">
                        <?= esc($activeInfo['name']) ?>
                    </span>
                </div>

                <div class="row g-3">
                    <!-- SEO Title -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="seoTitleInput" class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                SEO Title Tag <span class="text-danger">*</span>
                            </label>
                            <span id="titleCounter" style="font-size: 11px; color: var(--text-dim);">0 / 60 characters</span>
                        </div>
                        <input type="text" id="seoTitleInput" name="seo_title" class="form-control" maxlength="255" required
                            value="<?= esc($seo['seo_title'] ?? '') ?>"
                            placeholder="e.g. <?= esc($activeInfo['name']) ?> | Glowup Beauty Studio & Academy"
                            oninput="updateSeoPreview()">
                        <small class="text-muted" style="font-size: 11.5px;">Recommended length: 50–60 characters. Appears as the clickable headline in search results.</small>
                    </div>

                    <!-- Meta Description -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="metaDescInput" class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                                Meta Description
                            </label>
                            <span id="descCounter" style="font-size: 11px; color: var(--text-dim);">0 / 160 characters</span>
                        </div>
                        <textarea id="metaDescInput" name="meta_description" rows="3" class="form-control" maxlength="500"
                            placeholder="Briefly summarize the page content for search engines..."
                            oninput="updateSeoPreview()"><?= esc($seo['meta_description'] ?? '') ?></textarea>
                        <small class="text-muted" style="font-size: 11.5px;">Recommended length: 140–160 characters. Displayed beneath the title tag on search engine result pages.</small>
                    </div>

                    <!-- Meta Keywords -->
                    <div class="col-12">
                        <label for="metaKeywordsInput" class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Meta Keywords
                        </label>
                        <input type="text" id="metaKeywordsInput" name="meta_keywords" class="form-control"
                            value="<?= esc($seo['meta_keywords'] ?? '') ?>"
                            placeholder="e.g. hair salon, beauty academy, facials, bridal makeover, Madurai">
                        <small class="text-muted" style="font-size: 11.5px;">Comma-separated keywords representing target search terms.</small>
                    </div>

                    <!-- Canonical URL -->
                    <div class="col-md-7">
                        <label for="canonicalUrlInput" class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Canonical URL (Optional)
                        </label>
                        <input type="url" id="canonicalUrlInput" name="canonical_url" class="form-control"
                            value="<?= esc($seo['canonical_url'] ?? '') ?>"
                            placeholder="<?= esc(base_url(ltrim($activeInfo['route'], '/'))) ?>">
                        <small class="text-muted" style="font-size: 11.5px;">Leave empty to automatically use the standard page URL: <code><?= esc(base_url(ltrim($activeInfo['route'], '/'))) ?></code></small>
                    </div>

                    <!-- Robots Directive -->
                    <div class="col-md-5">
                        <label for="robotsSelect" class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Robots Directive
                        </label>
                        <?php $currentRobots = strtolower(trim((string)($seo['robots'] ?? 'index, follow'))); ?>
                        <select id="robotsSelect" name="robots" class="form-select">
                            <option value="index, follow" <?= ($currentRobots === 'index, follow' || empty($currentRobots)) ? 'selected' : '' ?>>index, follow (Standard)</option>
                            <option value="noindex, follow" <?= ($currentRobots === 'noindex, follow') ? 'selected' : '' ?>>noindex, follow (Do not index)</option>
                            <option value="index, nofollow" <?= ($currentRobots === 'index, nofollow') ? 'selected' : '' ?>>index, nofollow (Do not follow links)</option>
                            <option value="noindex, nofollow" <?= ($currentRobots === 'noindex, nofollow') ? 'selected' : '' ?>>noindex, nofollow (Block all)</option>
                        </select>
                        <small class="text-muted" style="font-size: 11.5px;">Directs crawler indexing and link-following behavior.</small>
                    </div>
                </div>
            </div>

            <!-- 2. Social Media & Open Graph Card -->
            <div class="glass-panel p-4 mb-4">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: #ede6e4 !important;">
                    <span class="material-symbols-outlined" style="color: var(--accent);">share</span>
                    <h5 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                        Social Media &amp; Open Graph (Facebook / WhatsApp / Twitter)
                    </h5>
                </div>

                <div class="row g-3">
                    <!-- OG Title -->
                    <div class="col-12">
                        <label for="ogTitleInput" class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Open Graph Title (Optional)
                        </label>
                        <input type="text" id="ogTitleInput" name="og_title" class="form-control"
                            value="<?= esc($seo['og_title'] ?? '') ?>"
                            placeholder="Defaults to SEO Title if left empty"
                            oninput="updateSocialPreview()">
                        <small class="text-muted" style="font-size: 11.5px;">Custom title used when shared on WhatsApp, Facebook, iMessage, and LinkedIn.</small>
                    </div>

                    <!-- OG Description -->
                    <div class="col-12">
                        <label for="ogDescInput" class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Open Graph Description (Optional)
                        </label>
                        <textarea id="ogDescInput" name="og_description" rows="2" class="form-control"
                            placeholder="Defaults to Meta Description if left empty"
                            oninput="updateSocialPreview()"><?= esc($seo['og_description'] ?? '') ?></textarea>
                    </div>

                    <!-- OG Image Input & Upload -->
                    <div class="col-12">
                        <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                            Social Share Card Image (1200 x 630 px recommended)
                        </label>
                        
                        <div class="row g-2 align-items-center">
                            <div class="col-md-7">
                                <input type="text" id="ogImageInput" name="og_image" class="form-control"
                                    value="<?= esc($seo['og_image'] ?? '') ?>"
                                    placeholder="assets/images/Glowup_Logo_Black_White.png"
                                    oninput="updateSocialPreview()">
                                <small class="text-muted" style="font-size: 11px;">Path relative to public directory or full HTTPS URL.</small>
                            </div>
                            <div class="col-md-5">
                                <input type="file" name="og_image_file" class="form-control form-control-sm" accept="image/*" onchange="previewUploadFile(this)">
                                <small class="text-muted" style="font-size: 11px;">Or upload file (JPG, PNG, WEBP, max 4MB).</small>
                            </div>
                        </div>

                        <?php if (!empty($seo['og_image'])): ?>
                            <div class="mt-2 d-flex align-items-center gap-2">
                                <span style="font-size: 11.5px; color: var(--text-muted);">Current Image Preview:</span>
                                <?php 
                                    $imgSrc = (str_starts_with($seo['og_image'], 'http://') || str_starts_with($seo['og_image'], 'https://'))
                                        ? $seo['og_image']
                                        : base_url(ltrim($seo['og_image'], '/'));
                                ?>
                                <img src="<?= esc($imgSrc) ?>" alt="OG Preview" id="ogImageCurrentThumb" style="max-height: 48px; max-width: 120px; border-radius: 6px; border: 1px solid #eedcd6; object-fit: cover;">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Save Action Button -->
            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 py-2" style="background: linear-gradient(135deg, #592E83, #48236d); border: none; border-radius: 10px; font-weight: 600; box-shadow: 0 4px 14px rgba(89, 46, 131, 0.25);">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    <span>Save SEO Configuration</span>
                </button>
                <a href="<?= current_url() . '?page=' . esc($activeKey) ?>" class="btn btn-outline-secondary px-3 py-2" style="border-radius: 10px;">
                    Discard Changes
                </a>
            </div>
        </div>

        <!-- Right Column: Live Search & Social Snippet Previews -->
        <div class="col-lg-5 col-xl-4">
            <!-- Google Search Engine Snippet Preview -->
            <div class="glass-panel p-4 mb-4" style="background: #ffffff;">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: #ede6e4 !important;">
                    <span class="material-symbols-outlined" style="color: #4285F4; font-size: 20px;">preview</span>
                    <h6 class="mb-0 fw-bold" style="font-size: 13.5px; color: var(--text-main);">
                        Google Search Result Preview
                    </h6>
                </div>

                <div class="p-3" style="background: #ffffff; border: 1px solid #ebebeb; border-radius: 12px; box-shadow: 0 1px 6px rgba(32,33,36,0.08); font-family: arial, sans-serif;">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <div style="width: 22px; height: 22px; border-radius: 50%; background: #f4edf7; display: flex; align-items: center; justify-content: center; font-size: 11px; color: #592E83; font-weight: bold;">
                            G
                        </div>
                        <div style="font-size: 12px; color: #202124; line-height: 1.3;">
                            <div style="font-weight: 500;">Glowup Beauty Studio</div>
                            <div style="font-size: 11px; color: #4d5156; word-break: break-all;">
                                <?= esc(base_url(ltrim($activeInfo['route'], '/'))) ?>
                            </div>
                        </div>
                    </div>
                    <div id="previewGoogleTitle" style="font-size: 18px; color: #1a0dab; line-height: 1.3; font-weight: 400; margin-bottom: 4px; word-break: break-word; cursor: pointer;">
                        <?= esc($seo['seo_title'] ?: ($activeInfo['name'] . ' | Glowup Beauty Studio & Academy')) ?>
                    </div>
                    <div id="previewGoogleDesc" style="font-size: 13px; color: #4d5156; line-height: 1.5; word-break: break-word;">
                        <?= esc($seo['meta_description'] ?: $activeInfo['desc']) ?>
                    </div>
                </div>

                <div class="mt-3 text-muted" style="font-size: 11.5px; line-height: 1.4;">
                    <span class="material-symbols-outlined" style="font-size: 14px; vertical-align: -2px; color: #16a34a;">check_circle</span>
                    Title &amp; description will update live as you type.
                </div>
            </div>

            <!-- Social Card / Open Graph Preview -->
            <div class="glass-panel p-4 mb-4" style="background: #ffffff;">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: #ede6e4 !important;">
                    <span class="material-symbols-outlined" style="color: #25D366; font-size: 20px;">chat</span>
                    <h6 class="mb-0 fw-bold" style="font-size: 13.5px; color: var(--text-main);">
                        Social Share Card Preview
                    </h6>
                </div>

                <div style="border: 1px solid #e1e4e8; border-radius: 12px; overflow: hidden; background: #ffffff;">
                    <div id="previewOgImageBox" style="height: 140px; background: #f4edf7; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <?php 
                            $cardImgSrc = !empty($seo['og_image']) 
                                ? ((str_starts_with($seo['og_image'], 'http://') || str_starts_with($seo['og_image'], 'https://')) ? $seo['og_image'] : base_url(ltrim($seo['og_image'], '/')))
                                : base_url('assets/images/Glowup_Logo_Black_White.png');
                        ?>
                        <img src="<?= esc($cardImgSrc) ?>" id="previewOgImg" alt="Social Card" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="p-3" style="background: #fcfbfa; border-top: 1px solid #e1e4e8;">
                        <small style="font-size: 10px; text-transform: uppercase; color: #8a5540; font-weight: 700; letter-spacing: 0.05em;">
                            <?= parse_url(base_url(), PHP_URL_HOST) ?: 'glowupbeautystudio.com' ?>
                        </small>
                        <div id="previewSocialTitle" style="font-size: 13.5px; font-weight: 700; color: #483C46; margin: 3px 0; line-height: 1.3;">
                            <?= esc($seo['og_title'] ?: ($seo['seo_title'] ?: ($activeInfo['name'] . ' | Glowup'))) ?>
                        </div>
                        <div id="previewSocialDesc" style="font-size: 12px; color: #6f626d; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= esc($seo['og_description'] ?: ($seo['meta_description'] ?: $activeInfo['desc'])) ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Quick Switcher List -->
            <div class="glass-panel p-4">
                <h6 class="fw-bold mb-3" style="font-size: 13px; color: var(--text-main); text-transform: uppercase; letter-spacing: 0.05em;">
                    All Managed Pages (<?= count($catalog) ?>)
                </h6>
                <div style="max-height: 280px; overflow-y: auto; padding-right: 4px;">
                    <?php foreach ($catalog as $pKey => $pInfo): ?>
                        <?php 
                            $isCurrent = ($activeKey === $pKey);
                            $hasSeo = !empty($allIndexed[$pKey]['seo_title']);
                        ?>
                        <a href="<?= base_url('admin/seo?page=' . $pKey) ?>" class="d-flex align-items-center justify-content-between p-2 mb-1 text-decoration-none rounded" style="background: <?= $isCurrent ? '#f4edf7' : '#ffffff' ?>; border: 1px solid <?= $isCurrent ? '#592E83' : '#ede6e4' ?>; transition: all 0.2s;">
                            <span style="font-size: 12.5px; font-weight: <?= $isCurrent ? '700' : '500' ?>; color: <?= $isCurrent ? '#592E83' : 'var(--text-main)' ?>;">
                                <?= esc($pInfo['name']) ?>
                            </span>
                            <?php if ($hasSeo): ?>
                                <span class="badge" style="background: #dcfce7; color: #16a34a; font-size: 10px; font-weight: 600;">Configured</span>
                            <?php else: ?>
                                <span class="badge" style="background: #f8f1ee; color: #A36952; font-size: 10px; font-weight: 600;">Default</span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function updateSeoPreview() {
    const titleVal = document.getElementById('seoTitleInput').value.trim();
    const descVal  = document.getElementById('metaDescInput').value.trim();
    const fallbackTitle = "<?= esc($activeInfo['name']) ?> | Glowup Beauty Studio & Academy";
    const fallbackDesc  = "<?= esc($activeInfo['desc']) ?>";

    // Update characters counters
    const titleLen = document.getElementById('seoTitleInput').value.length;
    const descLen  = document.getElementById('metaDescInput').value.length;
    
    const titleCounter = document.getElementById('titleCounter');
    titleCounter.innerText = titleLen + " / 60 characters";
    titleCounter.style.color = (titleLen > 60) ? '#dc2626' : (titleLen >= 35 ? '#16a34a' : 'var(--text-dim)');

    const descCounter = document.getElementById('descCounter');
    descCounter.innerText = descLen + " / 160 characters";
    descCounter.style.color = (descLen > 160) ? '#dc2626' : (descLen >= 100 ? '#16a34a' : 'var(--text-dim)');

    // Update Google snippet preview
    document.getElementById('previewGoogleTitle').innerText = titleVal || fallbackTitle;
    document.getElementById('previewGoogleDesc').innerText = descVal || fallbackDesc;

    updateSocialPreview();
}

function updateSocialPreview() {
    const titleVal  = document.getElementById('seoTitleInput').value.trim();
    const ogTitle   = document.getElementById('ogTitleInput').value.trim();
    const descVal   = document.getElementById('metaDescInput').value.trim();
    const ogDesc    = document.getElementById('ogDescInput').value.trim();
    const ogImage   = document.getElementById('ogImageInput').value.trim();

    const fallbackTitle = "<?= esc($activeInfo['name']) ?> | Glowup Beauty Studio & Academy";
    const fallbackDesc  = "<?= esc($activeInfo['desc']) ?>";

    document.getElementById('previewSocialTitle').innerText = ogTitle || titleVal || fallbackTitle;
    document.getElementById('previewSocialDesc').innerText  = ogDesc || descVal || fallbackDesc;

    if (ogImage) {
        let fullImg = ogImage;
        if (!ogImage.startsWith('http://') && !ogImage.startsWith('https://')) {
            fullImg = "<?= base_url() ?>" + ogImage.replace(/^\/+/, '');
        }
        document.getElementById('previewOgImg').src = fullImg;
    }
}

function previewUploadFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewOgImg').src = e.target.result;
            const currentThumb = document.getElementById('ogImageCurrentThumb');
            if (currentThumb) {
                currentThumb.src = e.target.result;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateSeoPreview();
});
</script>

<?= $this->endSection() ?>
