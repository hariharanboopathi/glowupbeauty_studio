<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-main); margin-bottom: 4px;">
            Footer Bottom Management
        </h2>
        <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
            Manage the copyright text and legal disclaimer displayed across the footer baseline.
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
                        <span class="material-symbols-outlined" style="color: var(--accent);">copyright</span>
                        Footer Bottom Notes &amp; Legal
                    </h3>
                    <div class="subtitle">Copyright line and additional pricing disclaimer</div>
                </div>
            </div>

            <form action="<?= base_url('admin/website/footer/update-bottom') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label-glow">Copyright Statement *</label>
                    <input type="text" name="copyright_text" class="form-control form-control-glow" value="<?= esc($settings['copyright_text'] ?? '') ?>" placeholder="© 2025 Glowup Beauty Studio & Academy. All rights reserved." required />
                    <small style="font-size: 11px; color: var(--text-dim); margin-top: 4px; display: block;">
                        Displayed on the left side of the footer baseline.
                    </small>
                </div>

                <div class="mb-4">
                    <label class="form-label-glow">Additional Footer Disclaimer Text</label>
                    <input type="text" name="additional_text" class="form-control form-control-glow" value="<?= esc($settings['additional_text'] ?? '') ?>" placeholder="Price varies based on hair length & texture." />
                    <small style="font-size: 11px; color: var(--text-dim); margin-top: 4px; display: block;">
                        Displayed on the right side of the footer baseline (e.g. hair length pricing notice).
                    </small>
                </div>

                <button type="submit" class="btn-glow">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Save Footer Bottom Notes
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
