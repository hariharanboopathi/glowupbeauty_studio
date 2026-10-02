<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="row g-4">
    <!-- Left Column: Admin Identity Badge & Profile Form -->
    <div class="col-lg-6">
        <div class="glass-panel p-4 mb-4">
            <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom" style="border-color: var(--border-subtle) !important;">
                <div style="width: 64px; height: 64px; border-radius: 50%; background: linear-gradient(135deg, var(--accent) 0%, #3e1b60 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; box-shadow: 0 4px 14px rgba(89, 46, 131, 0.25);">
                    <?php if (!empty($admin['profile_image'])): ?>
                        <img src="<?= base_url($admin['profile_image']) ?>" alt="Avatar" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    <?php else: ?>
                        <?= esc($admin['avatar'] ?? 'AV') ?>
                    <?php endif; ?>
                </div>
                <div>
                    <h5 class="mb-1 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main); font-size: 18px;">
                        <?= esc($admin['name'] ?? 'Alex Vance') ?>
                    </h5>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge" style="background: rgba(89, 46, 131, 0.12); color: var(--accent); font-size: 11px; padding: 4px 10px; border-radius: 999px;">
                            <?= esc($admin['role'] ?? 'Super Administrator') ?>
                        </span>
                        <small class="text-muted" style="font-size: 12px;"><?= esc($admin['email'] ?? 'admin@glowup.com') ?></small>
                    </div>
                </div>
            </div>

            <form action="<?= base_url('admin/settings/profile/update') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                        Administrator Display Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" class="form-control" required value="<?= esc($admin['name'] ?? 'Alex Vance') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                        Email Address
                    </label>
                    <input type="email" class="form-control bg-light" disabled value="<?= esc($admin['email'] ?? 'admin@glowup.com') ?>">
                    <small class="text-muted" style="font-size: 11px;">Primary login identity. Fixed for security.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                        Profile Image / Headshot
                    </label>
                    <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*">
                    <small class="text-muted" style="font-size: 11px;">Recommended: 200x200 square jpg/png</small>
                </div>

                <button type="submit" class="btn btn-luxury-primary btn-sm px-4 d-flex align-items-center gap-1">
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    <span>Update Personal Info</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Right Column: Password & Security Console -->
    <div class="col-lg-6">
        <div class="glass-panel p-4 mb-4">
            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom" style="border-color: var(--border-subtle) !important;">
                <span class="material-symbols-outlined" style="color: var(--accent);">lock_reset</span>
                <h5 class="mb-0 fw-bold" style="font-family: 'Playfair Display', serif; color: var(--text-main);">
                    Security & Password Update
                </h5>
            </div>

            <form action="<?= base_url('admin/settings/profile/password') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                        Current Password <span class="text-danger">*</span>
                    </label>
                    <input type="password" name="current_password" class="form-control" required placeholder="Enter current admin password">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                        New Password <span class="text-danger">*</span>
                    </label>
                    <input type="password" name="new_password" class="form-control" required minlength="6" placeholder="At least 6 characters">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                        Confirm New Password <span class="text-danger">*</span>
                    </label>
                    <input type="password" name="confirm_password" class="form-control" required minlength="6" placeholder="Repeat new password">
                </div>

                <button type="submit" class="btn btn-luxury-primary btn-sm px-4 d-flex align-items-center gap-1">
                    <span class="material-symbols-outlined" style="font-size: 18px;">key</span>
                    <span>Change Password</span>
                </button>
            </form>
        </div>

        <!-- Security Notice Box -->
        <div class="glass-panel p-4" style="background: rgba(201, 136, 96, 0.05); border-left: 4px solid var(--accent-secondary);">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="material-symbols-outlined" style="color: var(--accent-secondary); font-size: 20px;">shield</span>
                <span class="fw-bold" style="color: var(--text-main); font-size: 13.5px;">Security Advisory</span>
            </div>
            <p class="text-muted small mb-0" style="font-size: 12px; line-height: 1.5;">
                All administrative authentication events are logged for security. Never share your credentials or login session cookies with unauthorized individuals.
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
