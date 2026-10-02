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
        height: 42px;
        text-decoration: none;
    }

    .btn-clean-secondary:hover {
        background: #fbf6f4;
        color: #8a5540 !important;
        border-color: #8a5540;
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

    .status-enrolled {
        background: rgba(34, 197, 94, 0.12);
        color: #15803d;
        border: 1px solid rgba(34, 197, 94, 0.25);
    }

    .status-inquiry {
        background: rgba(234, 179, 8, 0.12);
        color: #b45309;
        border: 1px solid rgba(234, 179, 8, 0.25);
    }

    .status-completed {
        background: rgba(89, 46, 131, 0.12);
        color: #592E83;
        border: 1px solid rgba(89, 46, 131, 0.25);
    }
</style>

<!-- Toolbar & Search -->
<div class="clean-card mb-4">
    <form method="get" action="<?= base_url('admin/students') ?>" class="row g-3 align-items-center">
        <div class="col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0" style="border-color: #d5ccd3; border-radius: 10px 0 0 10px;">
                    <span class="material-symbols-outlined" style="font-size: 18px; color: #7a6e78;">search</span>
                </span>
                <input type="text" name="search" class="form-control clean-input border-start-0" style="border-radius: 0 10px 10px 0 !important;" value="<?= esc($search ?? '') ?>" placeholder="Search student name, email, phone, course...">
            </div>
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select clean-select" onchange="this.form.submit()">
                <option value="all" <?= ($statusFilter ?? '') === 'all' ? 'selected' : '' ?>>All Statuses</option>
                <option value="enrolled" <?= ($statusFilter ?? '') === 'enrolled' ? 'selected' : '' ?>>Enrolled</option>
                <option value="inquiry" <?= ($statusFilter ?? '') === 'inquiry' ? 'selected' : '' ?>>Prospect / Inquiry</option>
                <option value="completed" <?= ($statusFilter ?? '') === 'completed' ? 'selected' : '' ?>>Graduated / Alumni</option>
            </select>
        </div>

        <div class="col-md-4 text-md-end d-flex justify-content-md-end gap-2">
            <button type="submit" class="btn-clean-secondary">
                <span>Filter</span>
            </button>
            <button type="button" class="btn-clean-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <span class="material-symbols-outlined" style="font-size: 18px;">person_add</span>
                <span>Enrol Student</span>
            </button>
        </div>
    </form>
</div>

<!-- Students Table -->
<div class="clean-card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="clean-table">
            <thead>
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>Student Name</th>
                    <th>Contact Info</th>
                    <th>Enrolled Course</th>
                    <th>Batch</th>
                    <th style="width: 110px; text-align: center;">Status</th>
                    <th>Notes</th>
                    <th style="width: 120px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $st): ?>
                        <tr>
                            <td class="fw-bold" style="color: #7a6e78;"><?= esc($st['id']) ?></td>
                            <td>
                                <div class="fw-bold" style="color: #483C46; font-size: 14px;"><?= esc($st['student_name']) ?></div>
                            </td>
                            <td>
                                <div style="font-size: 12.5px; color: #483C46;"><?= esc($st['email']) ?></div>
                                <div style="font-size: 11.5px; color: #7a6e78;"><?= esc($st['phone']) ?></div>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #592E83; font-size: 13px;">
                                    <?= esc($st['course_name'] ?? 'Custom Program') ?>
                                </span>
                            </td>
                            <td style="font-size: 12.5px; color: #7a6e78;"><?= esc($st['batch']) ?></td>
                            <td style="text-align: center;">
                                <?php
                                    $stClass = 'status-enrolled';
                                    if ($st['status'] === 'inquiry') $stClass = 'status-inquiry';
                                    elseif ($st['status'] === 'completed') $stClass = 'status-completed';
                                ?>
                                <span class="badge-pill-status <?= $stClass ?>">
                                    <?= ucfirst(esc($st['status'])) ?>
                                </span>
                            </td>
                            <td style="font-size: 12px; color: #7a6e78; max-width: 200px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                <?= esc($st['notes'] ?? '—') ?>
                            </td>
                            <td style="text-align: right;">
                                <button type="button" class="btn btn-sm btn-outline-secondary edit-student-btn me-1"
                                    data-id="<?= esc($st['id']) ?>"
                                    data-name="<?= esc($st['student_name']) ?>"
                                    data-email="<?= esc($st['email']) ?>"
                                    data-phone="<?= esc($st['phone']) ?>"
                                    data-course="<?= esc($st['course_id']) ?>"
                                    data-batch="<?= esc($st['batch']) ?>"
                                    data-status="<?= esc($st['status']) ?>"
                                    data-notes="<?= esc($st['notes']) ?>"
                                    data-bs-toggle="modal" data-bs-target="#editStudentModal"
                                    style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                </button>
                                <a href="<?= base_url('admin/students/delete/' . $st['id']) ?>" onclick="return confirm('Remove student record?');" class="btn btn-sm btn-outline-danger" style="padding: 4px 8px; border-radius: 6px;">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5" style="color: #7a6e78;">No student records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
        <div class="d-flex align-items-center justify-content-between p-3 border-top" style="background: #ffffff;">
            <div style="font-size: 12px; color: #7a6e78;">
                Showing <b><?= min($totalMatching, ($currentPage - 1) * $perPage + 1) ?></b> to <b><?= min($totalMatching, $currentPage * $perPage) ?></b> of <b><?= $totalMatching ?></b> students
            </div>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= base_url('admin/students?page=' . ($currentPage - 1) . '&search=' . urlencode($search ?? '')) ?>">Previous</a>
                </li>
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <li class="page-item <?= $p == $currentPage ? 'active' : '' ?>">
                        <a class="page-link" href="<?= base_url('admin/students?page=' . $p . '&search=' . urlencode($search ?? '')) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= base_url('admin/students?page=' . ($currentPage + 1) . '&search=' . urlencode($search ?? '')) ?>">Next</a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/students/save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Enrol New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Student Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="student_name" class="form-control clean-input" required placeholder="e.g. Kavitha Natarajan">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control clean-input" required placeholder="kavitha@gmail.com">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control clean-input" required placeholder="+91 98412 44321">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Enrolled Course</label>
                        <select name="course_id" class="form-select clean-select">
                            <option value="">Select a Course Program</option>
                            <?php foreach ($courses as $c): ?>
                                <option value="<?= esc($c['id']) ?>"><?= esc($c['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Batch</label>
                            <input type="text" name="batch" class="form-control clean-input" value="Autumn 2025">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Status</label>
                            <select name="status" class="form-select clean-select">
                                <option value="enrolled">Enrolled</option>
                                <option value="inquiry">Prospect / Inquiry</option>
                                <option value="completed">Graduated / Alumni</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Academic Notes / Progress</label>
                        <textarea name="notes" rows="2" class="form-control clean-textarea" placeholder="Special admissions or module notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Save Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/students/save') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editStudentId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Student Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Student Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="student_name" id="editStudentName" class="form-control clean-input" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="editStudentEmail" class="form-control clean-input" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="editStudentPhone" class="form-control clean-input" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Enrolled Course</label>
                        <select name="course_id" id="editStudentCourse" class="form-select clean-select">
                            <option value="">Select a Course Program</option>
                            <?php foreach ($courses as $c): ?>
                                <option value="<?= esc($c['id']) ?>"><?= esc($c['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Batch</label>
                            <input type="text" name="batch" id="editStudentBatch" class="form-control clean-input">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Status</label>
                            <select name="status" id="editStudentStatus" class="form-select clean-select">
                                <option value="enrolled">Enrolled</option>
                                <option value="inquiry">Prospect / Inquiry</option>
                                <option value="completed">Graduated / Alumni</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Academic Notes / Progress</label>
                        <textarea name="notes" id="editStudentNotes" rows="2" class="form-control clean-textarea"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-student-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editStudentId').value = this.dataset.id;
            document.getElementById('editStudentName').value = this.dataset.name;
            document.getElementById('editStudentEmail').value = this.dataset.email;
            document.getElementById('editStudentPhone').value = this.dataset.phone;
            document.getElementById('editStudentCourse').value = this.dataset.course;
            document.getElementById('editStudentBatch').value = this.dataset.batch;
            document.getElementById('editStudentStatus').value = this.dataset.status;
            document.getElementById('editStudentNotes').value = this.dataset.notes;
        });
    });
});
</script>

<?= $this->endSection() ?>
