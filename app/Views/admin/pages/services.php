<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="glass-panel" style="min-height: 480px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 48px 24px;">
    <div style="width: 72px; height: 72px; border-radius: 20px; background: #f4edf7; border: 1px solid #eedcd6; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 4px 16px rgba(89, 46, 131, 0.12);">
        <span class="material-symbols-outlined" style="font-size: 36px; color: var(--accent);"><?= esc($pageIcon ?? 'spa') ?></span>
    </div>

    <h2 style="font-family: 'Playfair Display', serif; font-size: 1.75rem; color: var(--text-main); margin-bottom: 10px; font-weight: 600;">
        <?= esc($pageHeading ?? 'Services') ?>
    </h2>

    <p style="font-size: 13.5px; color: var(--text-muted); max-width: 480px; margin: 0 auto 20px; line-height: 1.6;">
        Empty placeholder view. Service catalog, spa treatments, pricing packages, and category definitions will be managed here.
    </p>

    <div class="d-inline-flex align-items-center gap-2" style="background: #fcfbfa; border: 1px dashed #eedcd6; border-radius: 999px; padding: 6px 16px; font-size: 12px; color: var(--text-muted);">
        <span class="material-symbols-outlined" style="font-size: 16px; color: var(--accent);">link</span>
        <span>Route: <code style="color: var(--accent);"><?= esc(current_url()) ?></code></span>
    </div>
</div>

<?= $this->endSection() ?>
