<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<style>
    .clean-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        padding: 24px;
        margin-bottom: 24px;
    }

    .clean-input, .clean-select, .clean-textarea {
        background-color: #ffffff !important;
        border: 1px solid #d5ccd3 !important;
        border-radius: 10px !important;
        color: #483C46 !important;
        font-size: 13.5px !important;
        padding: 9px 14px !important;
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
        padding: 9px 18px;
        border-radius: 10px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 3px 10px rgba(89, 46, 131, 0.25);
        cursor: pointer;
        transition: all 0.2s ease;
        height: 42px;
    }

    .btn-clean-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(89, 46, 131, 0.35);
        color: #ffffff !important;
    }

    .clean-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .clean-table th {
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

    .clean-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #ede6e4;
        font-size: 13.5px;
        color: #483C46;
        vertical-align: middle;
        background: #ffffff;
    }

    .clean-table tr:hover td {
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

    .course-thumb {
        width: 60px;
        height: 44px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #ede6e4;
    }
</style>

<!-- Action Header Card -->
<div class="clean-card mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">Diploma Courses Management</h4>
            <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Manage professional academy curricula, fees, certification badges, and admissions availability.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('academy') ?>" target="_blank" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1" style="border-radius: 10px; font-size: 13px; height: 42px;">
                <span>View Academy Page</span>
                <span class="material-symbols-outlined" style="font-size: 16px;">open_in_new</span>
            </a>
            <button type="button" class="btn-clean-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                <span>Add Diploma Course</span>
            </button>
        </div>
    </div>
</div>

<!-- Courses Table -->
<div class="clean-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="clean-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Order</th>
                    <th style="width: 80px;">Media</th>
                    <th>Course Title</th>
                    <th>Duration &amp; Level</th>
                    <th>Tuition Fee</th>
                    <th>Badge</th>
                    <th style="width: 100px; text-align: center;">Status</th>
                    <th style="width: 130px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $c): ?>
                        <tr>
                            <td class="fw-bold" style="color: #7a6e78;">#<?= esc($c['sort_order']) ?></td>
                            <td>
                                <?php
                                    $img = (strpos($c['image_url'], 'http') === 0) ? $c['image_url'] : base_url($c['image_url']);
                                ?>
                                <img src="<?= esc($img) ?>" alt="Course" class="course-thumb" onerror="this.src='https://placehold.co/100x70?text=Course'">
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #483C46; font-size: 14px;"><?= esc($c['title']) ?></div>
                                <div style="font-size: 11.5px; color: #7a6e78; max-width: 300px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?= esc($c['description']) ?></div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #592E83; font-size: 13px;"><?= esc($c['duration']) ?></div>
                                <div style="font-size: 11.5px; color: #7a6e78;"><?= esc($c['level']) ?></div>
                            </td>
                            <td class="fw-bold" style="color: #A36952;">₹<?= number_format((float) $c['price'], 2) ?></td>
                            <td>
                                <?php if (!empty($c['badge'])): ?>
                                    <span style="font-size: 11px; padding: 3px 10px; border-radius: 999px; background: rgba(163, 105, 82, 0.1); color: #A36952; font-weight: 700;">
                                        <?= esc($c['badge']) ?>
                                    </span>
                                <?php else: ?>
                                    <span style="color: #cbd5e1;">—</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <form action="<?= base_url('admin/courses/toggle/' . $c['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                        <span class="badge-pill-status <?= $c['is_active'] ? 'status-active' : 'status-inactive' ?>">
                                            <span class="material-symbols-outlined" style="font-size: 13px;"><?= $c['is_active'] ? 'check_circle' : 'block' ?></span>
                                            <?= $c['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <button type="button" class="btn btn-sm btn-outline-secondary edit-course-btn me-1"
                                    data-id="<?= esc($c['id']) ?>"
                                    data-title="<?= esc($c['title']) ?>"
                                    data-duration="<?= esc($c['duration']) ?>"
                                    data-level="<?= esc($c['level']) ?>"
                                    data-badge="<?= esc($c['badge']) ?>"
                                    data-price="<?= esc($c['price']) ?>"
                                    data-desc="<?= esc($c['description']) ?>"
                                    data-image="<?= esc($c['image_url']) ?>"
                                    data-order="<?= esc($c['sort_order']) ?>"
                                    data-active="<?= esc($c['is_active']) ?>"
                                    data-bs-toggle="modal" data-bs-target="#editCourseModal"
                                    style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                </button>
                                <a href="<?= base_url('admin/courses/delete/' . $c['id']) ?>" onclick="return confirm('Remove this course?');" class="btn btn-sm btn-outline-danger" style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5" style="color: #7a6e78;">No courses added yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/courses/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Add Academy Diploma Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Course Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control clean-input" required placeholder="e.g. Master Diploma in Bridal & Fashion Artistry">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Tuition Fee (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" class="form-control clean-input" required placeholder="75000.00">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Duration</label>
                            <input type="text" name="duration" class="form-control clean-input" value="6 Months" placeholder="6 Months">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Target Level</label>
                            <input type="text" name="level" class="form-control clean-input" value="All Levels" placeholder="All Levels / Intermediate">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Feature Badge</label>
                            <input type="text" name="badge" class="form-control clean-input" placeholder="e.g. Flagship Course">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Course Overview &amp; Curriculum Highlights</label>
                        <textarea name="description" rows="3" class="form-control clean-textarea" placeholder="Complete practical and theoretical syllabus..."></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Banner Image URL</label>
                            <input type="text" name="image_url" class="form-control clean-input" placeholder="https://...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload Image File</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control clean-input" value="1">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="addCourseActive" checked>
                                <label class="form-check-label fw-bold" for="addCourseActive" style="font-size: 12.5px;">Admissions Open / Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Save Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<div class="modal fade" id="editCourseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/courses/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editCourseId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Academy Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Course Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="editCourseTitle" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Tuition Fee (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" id="editCoursePrice" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Duration</label>
                            <input type="text" name="duration" id="editCourseDuration" class="form-control clean-input">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Target Level</label>
                            <input type="text" name="level" id="editCourseLevel" class="form-control clean-input">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Feature Badge</label>
                            <input type="text" name="badge" id="editCourseBadge" class="form-control clean-input">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Course Overview &amp; Curriculum Highlights</label>
                        <textarea name="description" id="editCourseDesc" rows="3" class="form-control clean-textarea"></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Banner Image URL</label>
                            <input type="text" name="image_url" id="editCourseImage" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload New Image</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Sort Order</label>
                            <input type="number" name="sort_order" id="editCourseOrder" class="form-control clean-input">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editCourseActive">
                                <label class="form-check-label fw-bold" for="editCourseActive" style="font-size: 12.5px;">Admissions Open / Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Update Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-course-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editCourseId').value = this.dataset.id;
            document.getElementById('editCourseTitle').value = this.dataset.title;
            document.getElementById('editCourseDuration').value = this.dataset.duration;
            document.getElementById('editCourseLevel').value = this.dataset.level;
            document.getElementById('editCourseBadge').value = this.dataset.badge;
            document.getElementById('editCoursePrice').value = this.dataset.price;
            document.getElementById('editCourseDesc').value = this.dataset.desc;
            document.getElementById('editCourseImage').value = this.dataset.image;
            document.getElementById('editCourseOrder').value = this.dataset.order;
            document.getElementById('editCourseActive').checked = this.dataset.active == '1';
        });
    });
});
</script>

<?= $this->endSection() ?>
