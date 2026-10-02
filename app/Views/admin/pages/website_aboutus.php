<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<style>
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
        padding: 12px 20px;
        border-radius: 10px 10px 0 0;
        background: transparent;
        display: flex;
        align-items: center;
        gap: 8px;
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
    }

    .btn-clean-secondary:hover {
        background: #fbf6f4;
        color: #8a5540 !important;
        border-color: #8a5540;
    }

    .cms-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .cms-table th {
        background: #f8f6f8;
        color: #483C46;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 14px 16px;
        border-top: 1px solid #ede6e4;
        border-bottom: 1px solid #ede6e4;
    }

    .cms-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #ede6e4;
        font-size: 13.5px;
        color: #483C46;
        vertical-align: middle;
        background: #ffffff;
    }

    .cms-table tr:hover td {
        background: #faf8fb;
    }

    .badge-pill-status {
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .status-active {
        background: rgba(34, 197, 94, 0.12);
        color: #15803d;
        border: 1px solid rgba(34, 197, 94, 0.25);
    }

    .status-inactive {
        background: rgba(148, 163, 184, 0.15);
        color: #64748b;
        border: 1px solid rgba(148, 163, 184, 0.25);
    }

    .team-thumb {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ede6e4;
    }
</style>

<!-- Tab Navigation -->
<ul class="nav nav-tabs nav-tabs-cms mb-4" id="aboutTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="story-tab" data-bs-toggle="tab" data-bs-target="#storyPane" type="button" role="tab">
            <span class="material-symbols-outlined" style="font-size: 18px;">auto_stories</span>
            <span>Genesis Narrative &amp; Philosophy</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="team-tab" data-bs-toggle="tab" data-bs-target="#teamPane" type="button" role="tab">
            <span class="material-symbols-outlined" style="font-size: 18px;">badge</span>
            <span>Master Practitioners &amp; Faculty (<?= count($team ?? []) ?>)</span>
        </button>
    </li>
</ul>

<div class="tab-content" id="aboutTabContent">

    <!-- ========================================== -->
    <!-- TAB 1: STORY & GENESIS                      -->
    <!-- ========================================== -->
    <div class="tab-pane fade show active" id="storyPane" role="tabpanel">
        <div class="cms-card">
            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                <div>
                    <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">About Us Brand Story</h4>
                    <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Manage the narrative, historical genesis, master diagnostic statistics, and editorial photograph on <code>/about</code>.</p>
                </div>
                <a href="<?= base_url('about') ?>" target="_blank" class="btn-clean-secondary" style="padding: 6px 14px; font-size: 12px; height: 34px;">
                    <span>View Public Page</span>
                    <span class="material-symbols-outlined" style="font-size: 14px;">open_in_new</span>
                </a>
            </div>

            <form action="<?= base_url('admin/website/aboutus/update-content') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="p-3 mb-3" style="background: #faf8fb; border-radius: 12px; border: 1px solid #ede6e4;">
                            <label class="fw-bold mb-2 d-block" style="font-size: 12.5px; color: #592E83;">Page Top Hero Banner</label>
                            <div class="mb-2">
                                <label class="form-label" style="font-size: 11.5px; color: #7a6e78;">Main Hero Title</label>
                                <input type="text" name="hero_title" class="form-control clean-input" value="<?= esc($settings['hero_title'] ?? 'The Art of Mindful Beauty') ?>" required>
                            </div>
                            <div>
                                <label class="form-label" style="font-size: 11.5px; color: #7a6e78;">Hero Subtitle</label>
                                <textarea name="hero_subtitle" rows="2" class="form-control clean-textarea"><?= esc($settings['hero_subtitle'] ?? 'An architectural sanctuary founded to restore biological harmony, empower individual grace, and mentor future masters of the craft.') ?></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Eyebrow / Subtitle</label>
                            <input type="text" name="genesis_eyebrow" class="form-control clean-input" value="<?= esc($settings['genesis_eyebrow'] ?? 'The Genesis') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Genesis Main Title <span class="text-danger">*</span></label>
                            <input type="text" name="genesis_title" class="form-control clean-input" value="<?= esc($settings['genesis_title'] ?? 'Born From a Reverence For Stillness') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Primary Story Paragraph</label>
                            <textarea name="genesis_copy1" rows="3" class="form-control clean-textarea"><?= esc($settings['genesis_copy1'] ?? 'Founded in the cultural heart of Madurai, Glowup was conceived not simply as a salon, but as a temple of rejuvenation.') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Secondary Story Paragraph</label>
                            <textarea name="genesis_copy2" rows="3" class="form-control clean-textarea"><?= esc($settings['genesis_copy2'] ?? 'We recognized that true beauty therapy transcends standard cosmetic procedures.') ?></textarea>
                        </div>

                        <!-- 3 Statistics -->
                        <div class="p-3 mb-3" style="background: #faf8fb; border-radius: 12px; border: 1px solid #ede6e4;">
                            <label class="fw-bold mb-2 d-block" style="font-size: 12.5px; color: #592E83;">Studio Achievement Metrics</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <input type="text" name="stat1_value" class="form-control clean-input text-center fw-bold" value="<?= esc($settings['stat1_value'] ?? '7+') ?>">
                                    <input type="text" name="stat1_label" class="form-control clean-input mt-1 text-center" style="font-size: 11px !important;" value="<?= esc($settings['stat1_label'] ?? 'Years of Mastery') ?>">
                                </div>
                                <div class="col-4">
                                    <input type="text" name="stat2_value" class="form-control clean-input text-center fw-bold" value="<?= esc($settings['stat2_value'] ?? '15K+') ?>">
                                    <input type="text" name="stat2_label" class="form-control clean-input mt-1 text-center" style="font-size: 11px !important;" value="<?= esc($settings['stat2_label'] ?? 'Radiant Patrons') ?>">
                                </div>
                                <div class="col-4">
                                    <input type="text" name="stat3_value" class="form-control clean-input text-center fw-bold" value="<?= esc($settings['stat3_value'] ?? '850+') ?>">
                                    <input type="text" name="stat3_label" class="form-control clean-input mt-1 text-center" style="font-size: 11px !important;" value="<?= esc($settings['stat3_label'] ?? 'Certified Alumni') ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="p-3" style="background: #ffffff; border: 1px solid #ede6e4; border-radius: 12px;">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Archival Studio Image</label>
                            <?php
                                $img = $settings['genesis_image'] ?? 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1000&q=80';
                                if (strpos($img, 'http') !== 0) {
                                    $img = base_url($img);
                                }
                            ?>
                            <div class="mb-3 text-center">
                                <img src="<?= esc($img) ?>" alt="About Visual" style="width: 100%; max-height: 280px; object-fit: cover; border-radius: 10px; border: 1px solid #ede6e4;">
                            </div>
                            <div class="mb-2">
                                <label class="form-label" style="font-size: 11.5px; color: #7a6e78;">Image URL / Path</label>
                                <input type="text" name="genesis_image" class="form-control clean-input" value="<?= esc($settings['genesis_image'] ?? '') ?>">
                            </div>
                            <div>
                                <label class="form-label" style="font-size: 11.5px; color: #7a6e78;">Or Upload New Image</label>
                                <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-4 mt-3 border-top">
                    <span style="font-size: 12px; color: #7a6e78;">Last Updated: <?= !empty($settings['updated_at']) ? date('M d, Y h:i A', strtotime($settings['updated_at'])) : 'Recently' ?></span>
                    <button type="submit" class="btn-clean-primary">
                        <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                        <span>Save Story Narrative</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TAB 2: MASTER PRACTITIONERS & TEAM          -->
    <!-- ========================================== -->
    <div class="tab-pane fade" id="teamPane" role="tabpanel">
        <div class="cms-card">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
                <div>
                    <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">Master Practitioners &amp; Faculty</h4>
                    <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Manage the mentors, clinical directors, and celebrity artists featured on the About Us page.</p>
                </div>
                <button type="button" class="btn-clean-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                    <span class="material-symbols-outlined" style="font-size: 18px;">person_add</span>
                    <span>Add Practitioner</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="cms-table">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Order</th>
                            <th style="width: 70px;">Avatar</th>
                            <th>Full Name</th>
                            <th>Designation / Role</th>
                            <th>Certification Badge</th>
                            <th style="width: 100px; text-align: center;">Status</th>
                            <th style="width: 130px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($team)): ?>
                            <?php foreach ($team as $m): ?>
                                <tr>
                                    <td class="fw-bold" style="color: #7a6e78;">#<?= esc($m['sort_order']) ?></td>
                                    <td>
                                        <?php
                                            $tImg = (strpos($m['image_url'], 'http') === 0) ? $m['image_url'] : base_url($m['image_url']);
                                        ?>
                                        <img src="<?= esc($tImg) ?>" alt="<?= esc($m['name']) ?>" class="team-thumb" onerror="this.src='https://placehold.co/100?text=Artist'">
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: #483C46; font-size: 14px;"><?= esc($m['name']) ?></div>
                                        <div style="font-size: 11.5px; color: #7a6e78; max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?= esc($m['bio']) ?></div>
                                    </td>
                                    <td style="color: #592E83; font-weight: 600; font-size: 13px;"><?= esc($m['role']) ?></td>
                                    <td>
                                        <?php if (!empty($m['badge'])): ?>
                                            <span style="font-size: 11px; padding: 3px 10px; border-radius: 999px; background: rgba(163, 105, 82, 0.1); color: #A36952; font-weight: 700;">
                                                <?= esc($m['badge']) ?>
                                            </span>
                                        <?php else: ?>
                                            <span style="color: #cbd5e1;">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <form action="<?= base_url('admin/website/aboutus/member/toggle/' . $m['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                <span class="badge-pill-status <?= $m['is_active'] ? 'status-active' : 'status-inactive' ?>">
                                                    <span class="material-symbols-outlined" style="font-size: 13px;"><?= $m['is_active'] ? 'check_circle' : 'block' ?></span>
                                                    <?= $m['is_active'] ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                    <td style="text-align: right;">
                                        <button type="button" class="btn btn-sm btn-outline-secondary edit-member-btn me-1"
                                            data-id="<?= esc($m['id']) ?>"
                                            data-name="<?= esc($m['name']) ?>"
                                            data-role="<?= esc($m['role']) ?>"
                                            data-bio="<?= esc($m['bio']) ?>"
                                            data-badge="<?= esc($m['badge']) ?>"
                                            data-image="<?= esc($m['image_url']) ?>"
                                            data-order="<?= esc($m['sort_order']) ?>"
                                            data-active="<?= esc($m['is_active']) ?>"
                                            data-bs-toggle="modal" data-bs-target="#editMemberModal"
                                            style="padding: 4px 8px; border-radius: 6px;">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                        </button>
                                        <a href="<?= base_url('admin/website/aboutus/member/delete/' . $m['id']) ?>" onclick="return confirm('Remove this practitioner from faculty?');" class="btn btn-sm btn-outline-danger" style="padding: 4px 8px; border-radius: 6px;">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4" style="color: #7a6e78;">No practitioners registered yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/website/aboutus/member/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Add Master Practitioner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control clean-input" required placeholder="e.g. Maya Sundaram">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Role / Designation <span class="text-danger">*</span></label>
                        <input type="text" name="role" class="form-control clean-input" required placeholder="e.g. Founder & Master Trichologist">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Bio / Professional Background</label>
                        <textarea name="bio" rows="2" class="form-control clean-textarea" placeholder="15+ years formulating bespoke hair chemistry..."></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Certification Badge</label>
                            <input type="text" name="badge" class="form-control clean-input" placeholder="e.g. Paris Certified">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control clean-input" value="1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Avatar Image URL</label>
                        <input type="text" name="image_url" class="form-control clean-input" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload Photo</label>
                        <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                    </div>
                    <div class="form-check form-switch pt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="addMemberActive" checked>
                        <label class="form-check-label fw-bold" for="addMemberActive" style="font-size: 12.5px;">Active on About Page</label>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Save Practitioner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Member Modal -->
<div class="modal fade" id="editMemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/website/aboutus/member/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editMemberId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Practitioner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="editMemberName" class="form-control clean-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Role / Designation <span class="text-danger">*</span></label>
                        <input type="text" name="role" id="editMemberRole" class="form-control clean-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Bio / Professional Background</label>
                        <textarea name="bio" id="editMemberBio" rows="2" class="form-control clean-textarea"></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Certification Badge</label>
                            <input type="text" name="badge" id="editMemberBadge" class="form-control clean-input">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" id="editMemberOrder" class="form-control clean-input">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Avatar Image URL</label>
                        <input type="text" name="image_url" id="editMemberImage" class="form-control clean-input">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload New Photo</label>
                        <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                    </div>
                    <div class="form-check form-switch pt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editMemberActive">
                        <label class="form-check-label fw-bold" for="editMemberActive" style="font-size: 12.5px;">Active on About Page</label>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Update Practitioner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.location.hash) {
        var tabTrigger = document.querySelector('button[data-bs-target="' + window.location.hash + '"]');
        if (tabTrigger) {
            new bootstrap.Tab(tabTrigger).show();
        }
    }

    document.querySelectorAll('.edit-member-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editMemberId').value = this.dataset.id;
            document.getElementById('editMemberName').value = this.dataset.name;
            document.getElementById('editMemberRole').value = this.dataset.role;
            document.getElementById('editMemberBio').value = this.dataset.bio;
            document.getElementById('editMemberBadge').value = this.dataset.badge;
            document.getElementById('editMemberImage').value = this.dataset.image;
            document.getElementById('editMemberOrder').value = this.dataset.order;
            document.getElementById('editMemberActive').checked = this.dataset.active == '1';
        });
    });
});
</script>

<?= $this->endSection() ?>
