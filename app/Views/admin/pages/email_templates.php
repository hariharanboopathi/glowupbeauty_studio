<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Overview Header -->
<div class="glass-panel p-4 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h5 class="fw-bold mb-1" style="color: var(--text-main); font-family: 'Playfair Display', serif;">Automated Business Email Templates</h5>
            <p class="text-muted mb-0" style="font-size: 13px;">
                Manage dynamic email notifications dispatched across appointments, billing, client CRM, inquiries, and marketing.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge" style="background: rgba(89, 46, 131, 0.1); color: var(--accent); font-size: 12px; padding: 8px 14px; border-radius: 20px;">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 15px;">mark_email_read</span>
                <?= count($templates) ?> Active Business Templates
            </span>
        </div>
    </div>
</div>

<!-- Template Cards Grid -->
<div class="row g-3 mb-4">
    <?php foreach ($templates as $tpl): ?>
        <div class="col-md-6 col-xl-4">
            <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-between position-relative">
                <div>
                    <!-- Top Ribbon -->
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-light text-dark font-monospace" style="font-size: 10px; letter-spacing: 0.05em; border: 1px solid #e0d7ea;">
                            <?= esc($tpl['template_key']) ?>
                        </span>
                        <?php if ($tpl['is_active']): ?>
                            <span class="badge bg-success bg-opacity-10 text-success" style="font-size: 10px;">Active</span>
                        <?php else: ?>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary" style="font-size: 10px;">Disabled</span>
                        <?php endif; ?>
                    </div>

                    <h6 class="fw-bold mb-2" style="color: var(--text-main); font-size: 15px;">
                        <?= esc($tpl['title']) ?>
                    </h6>

                    <div class="mb-3" style="font-size: 12.5px;">
                        <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Subject Line:</span>
                        <div class="text-truncate fw-medium" title="<?= esc($tpl['subject']) ?>" style="color: #483C46;">
                            <?= esc($tpl['subject']) ?>
                        </div>
                    </div>

                    <!-- Available Tags Hints -->
                    <?php if (!empty($tpl['variables_hint'])): ?>
                        <div class="mb-3">
                            <span class="text-muted d-block mb-1" style="font-size: 10.5px; text-transform: uppercase; font-weight: 600;">Dynamic Tokens:</span>
                            <div class="d-flex flex-wrap gap-1">
                                <?php 
                                    $tags = explode(',', $tpl['variables_hint']);
                                    foreach (array_slice($tags, 0, 3) as $tag): 
                                ?>
                                    <code class="text-muted" style="font-size: 10px; background: rgba(0,0,0,0.04); padding: 2px 6px; border-radius: 4px;"><?= trim($tag) ?></code>
                                <?php endforeach; ?>
                                <?php if (count($tags) > 3): ?>
                                    <small class="text-muted" style="font-size: 10px;">+<?= count($tags) - 3 ?> more</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Card Actions -->
                <div class="pt-3 border-top d-flex align-items-center justify-content-between mt-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1" style="font-size: 11.5px; border-radius: 6px;"
                            onclick="previewEmailTemplate(<?= $tpl['id'] ?>)">
                        <span class="material-symbols-outlined" style="font-size: 14px;">visibility</span>
                        Live Preview
                    </button>
                    <button type="button" class="btn btn-sm btn-primary d-flex align-items-center gap-1" style="font-size: 11.5px; background: var(--accent); border-color: var(--accent); border-radius: 6px;"
                            onclick='openEditTemplateModal(<?= json_encode($tpl, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                        <span class="material-symbols-outlined" style="font-size: 14px;">edit</span>
                        Edit Template
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Edit Template Modal -->
<div class="modal fade" id="editTemplateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: var(--accent); padding: 18px 24px;">
                <h6 class="modal-title fw-bold" id="editTemplateModalTitle">Edit Email Template</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/settings/email-templates/save') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="tpl_id" value="0">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Subject Line *</label>
                        <input type="text" name="subject" id="tpl_subject" class="form-control" required placeholder="Subject with {{placeholders}}">
                    </div>

                    <!-- Token Chips Helper -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted" style="font-size: 11px; text-transform: uppercase;">Click token to insert into body:</label>
                        <div id="tpl_tokens_container" class="d-flex flex-wrap gap-1"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Email Body (HTML Supported) *</label>
                        <textarea name="body_html" id="tpl_body_html" class="form-control font-monospace" rows="9" required style="font-size: 13px;"></textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="tpl_is_active" value="1" checked>
                        <label class="form-check-label fw-bold" for="tpl_is_active" style="font-size: 12.5px;">Enable this automated email notification</label>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save Template</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Live Preview Modal -->
<div class="modal fade" id="previewEmailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-light py-3 px-4">
                <div>
                    <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700;">Client Inbox Simulation</span>
                    <h6 class="modal-title fw-bold text-dark mt-1" id="previewEmailTitle">Email Preview</h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="bg-white p-4 rounded-3 shadow-sm border" style="max-width: 600px; margin: 0 auto; font-family: 'Inter', sans-serif;">
                    <!-- Brand Header -->
                    <div class="text-center pb-3 mb-3 border-bottom">
                        <h4 style="font-family: 'Playfair Display', serif; color: #592E83; margin: 0; font-weight: 700; letter-spacing: -0.02em;">GLOWUP</h4>
                        <small style="color: #A36952; letter-spacing: 0.15em; font-size: 9px; text-transform: uppercase; font-weight: 700;">Luxury Studio & Academy</small>
                    </div>

                    <!-- Subject Simulation -->
                    <div class="mb-3 p-2 bg-light rounded text-muted" style="font-size: 12px;">
                        <strong>Subject:</strong> <span id="previewSubjectText" class="text-dark fw-semibold"></span>
                    </div>

                    <!-- Body Content -->
                    <div id="previewBodyContent" style="font-size: 13.5px; line-height: 1.7; color: #333;"></div>

                    <!-- Luxury Footer -->
                    <div class="text-center pt-4 mt-4 border-top text-muted" style="font-size: 11px;">
                        <p class="mb-1"><strong>Glowup Luxury Beauty Studio & Academy</strong></p>
                        <p class="mb-2">Road No. 36, Jubilee Hills, Hyderabad | +91 91234 56789</p>
                        <p class="mb-0" style="font-size: 10px; color: #aaa;">This is an automated bespoke communication from Glowup CRM.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light px-4 py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close Preview</button>
            </div>
        </div>
    </div>
</div>

<script>
function openEditTemplateModal(tpl) {
    document.getElementById('editTemplateModalTitle').textContent = 'Edit: ' + tpl.title;
    document.getElementById('tpl_id').value = tpl.id;
    document.getElementById('tpl_subject').value = tpl.subject || '';
    document.getElementById('tpl_body_html').value = tpl.body_html || '';
    document.getElementById('tpl_is_active').checked = (tpl.is_active == 1);

    // Build token buttons
    var container = document.getElementById('tpl_tokens_container');
    container.innerHTML = '';
    if (tpl.variables_hint) {
        var tokens = tpl.variables_hint.split(',');
        tokens.forEach(function(tok) {
            tok = tok.trim();
            if (tok) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-xs btn-outline-secondary';
                btn.style.cssText = 'font-size: 11px; padding: 2px 8px; border-radius: 4px;';
                btn.textContent = tok;
                btn.onclick = function() {
                    insertToken(tok);
                };
                container.appendChild(btn);
            }
        });
    }

    var modal = new bootstrap.Modal(document.getElementById('editTemplateModal'));
    modal.show();
}

function insertToken(token) {
    var textarea = document.getElementById('tpl_body_html');
    var start = textarea.selectionStart;
    var end = textarea.selectionEnd;
    var text = textarea.value;
    textarea.value = text.substring(0, start) + token + text.substring(end);
    textarea.focus();
    textarea.selectionStart = textarea.selectionEnd = start + token.length;
}

function previewEmailTemplate(id) {
    fetch('<?= base_url('admin/settings/email-templates/preview/') ?>' + id)
        .then(function(res) { return res.json(); })
        .then(function(data) {
            document.getElementById('previewEmailTitle').textContent = data.title;
            document.getElementById('previewSubjectText').textContent = data.subject;
            document.getElementById('previewBodyContent').innerHTML = data.body;
            var modal = new bootstrap.Modal(document.getElementById('previewEmailModal'));
            modal.show();
        })
        .catch(function(err) {
            alert('Failed to load email preview.');
        });
}
</script>

<?= $this->endSection() ?>
