<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
    <div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.6rem; color: var(--text-main); margin-bottom: 4px;">
            Academy Concierge Management
        </h2>
        <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
            Manage the studio location, contact details, and operating hours displayed in the concierge footer column.
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
                        <span class="material-symbols-outlined" style="color: var(--accent);">support_agent</span>
                        Concierge Information
                    </h3>
                    <div class="subtitle">Location, phone number, email, and studio hours</div>
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
                    <textarea name="concierge_address" rows="3" class="form-control form-control-glow" placeholder="Enter studio physical address..."><?= esc($settings['concierge_address'] ?? '') ?></textarea>
                    <small style="font-size: 11px; color: var(--text-dim); margin-top: 4px; display: block;">e.g. Flagship Academy: 12 Madurai, Tamil Nadu</small>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="form-label-glow">Direct Phone (Dialer / Call)</label>
                        <input type="text" name="concierge_phone" class="form-control form-control-glow" value="<?= esc($settings['concierge_phone'] ?? '+91 98200 12345') ?>" placeholder="+91 98200 12345" />
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-glow">WhatsApp Business Number</label>
                        <input type="text" name="concierge_whatsapp" class="form-control form-control-glow" value="<?= esc($settings['concierge_whatsapp'] ?? ($settings['concierge_phone'] ?? '+91 98200 12345')) ?>" placeholder="+91 98200 12345" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="form-label-glow">Email Address</label>
                        <input type="email" name="concierge_email" class="form-control form-control-glow" value="<?= esc($settings['concierge_email'] ?? 'glowup@gmail.com') ?>" placeholder="glowup@gmail.com" />
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-glow">Opening Hours</label>
                        <input type="text" name="concierge_hours" class="form-control form-control-glow" value="<?= esc($settings['concierge_hours'] ?? 'Tue – Sun: 10:00 AM – 8:00 PM') ?>" placeholder="Tue – Sun: 10:00 AM – 8:00 PM" />
                    </div>
                </div>
                </div>

                <button type="submit" class="btn-glow">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Save Concierge Info
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
