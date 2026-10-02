<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-main); margin-bottom: 4px;">
            Social Media Management
        </h2>
        <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
            Manage social media and location map URLs linked to footer channel icons.
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="<?= base_url('/') ?>" target="_blank" class="btn-ghost-glow" title="View live frontend footer">
            <span class="material-symbols-outlined" style="font-size: 18px;">preview</span>
            Live Preview
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-xl-7">
        <div class="glass-panel">
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
                    <input type="text" id="social_instagram" name="social_instagram" class="form-control form-control-glow" value="<?= esc($settings['social_instagram'] ?? '#') ?>" placeholder="https://instagram.com/yourhandle" />
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
                    <input type="text" id="social_pinterest" name="social_pinterest" class="form-control form-control-glow" value="<?= esc($settings['social_pinterest'] ?? '#') ?>" placeholder="https://pinterest.com/yourhandle" />
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
                    <input type="text" id="social_facebook" name="social_facebook" class="form-control form-control-glow" value="<?= esc($settings['social_facebook'] ?? '#') ?>" placeholder="https://facebook.com/yourpage" />
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
                    <input type="text" id="social_youtube" name="social_youtube" class="form-control form-control-glow" value="<?= esc($settings['social_youtube'] ?? '#') ?>" placeholder="https://youtube.com/@yourchannel" />
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <label class="form-label-glow mb-0" for="social_location">
                            <span class="material-symbols-outlined" style="font-size: 16px;">public</span>
                            Location / Google Maps URL
                        </label>
                        <button type="button" class="btn-ghost-glow py-0 px-2" style="font-size: 11px; height: 22px; border-radius: 4px;" title="Clear URL" onclick="document.getElementById('social_location').value='';">
                            Clear
                        </button>
                    </div>
                    <input type="text" id="social_location" name="social_location" class="form-control form-control-glow" value="<?= esc($settings['social_location'] ?? '#') ?>" placeholder="https://maps.google.com/..." />
                </div>

                <button type="submit" class="btn-glow">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Save Social Links
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
