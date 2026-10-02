<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- KPI Strip -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Total Outbound</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: var(--text-main); font-family: 'Playfair Display', serif;"><?= esc($logStats['total'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Client touchpoints logged</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                <span class="material-symbols-outlined">campaign</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">WhatsApp Messages</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #2e7d32; font-family: 'Playfair Display', serif;"><?= esc($logStats['whatsapp'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Delivered via Cloud API</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(46, 125, 50, 0.08); display: flex; align-items: center; justify-content: center; color: #2e7d32;">
                <i class="fab fa-whatsapp fs-5"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">SMS Messages</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #0288d1; font-family: 'Playfair Display', serif;"><?= esc($logStats['sms'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Transactional & promo SMS</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(2, 136, 209, 0.08); display: flex; align-items: center; justify-content: center; color: #0288d1;">
                <span class="material-symbols-outlined">sms</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="glass-panel p-3 d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted" style="font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Emails Delivered</span>
                <h3 class="mb-0 mt-1 fw-bold" style="color: #592E83; font-family: 'Playfair Display', serif;"><?= esc($logStats['email'] ?? 0) ?></h3>
                <small class="text-muted" style="font-size: 11px;">Delivered via SMTP</small>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: #592E83;">
                <span class="material-symbols-outlined">mail</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Row: Compose Console & Segments Panel -->
<div class="row g-4 mb-4">
    <!-- Compose Broadcast -->
    <div class="col-xl-7">
        <div class="glass-panel p-4 h-100">
            <h6 class="fw-bold mb-1" style="color: var(--text-main);">Compose Client Communication</h6>
            <small class="text-muted d-block mb-3">Dispatch direct messages, reminders, or privilege campaigns across WhatsApp, Email, or SMS.</small>

            <form action="<?= base_url('admin/marketing/communication-center/send') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Target Audience Selector -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Recipient Audience *</label>
                        <select name="target_type" id="target_type" class="form-select" onchange="handleTargetTypeChange(this.value)">
                            <option value="customer">Specific Customer</option>
                            <option value="lead">Inbound Lead</option>
                            <option value="segment">Dynamic Customer Segment</option>
                            <option value="all">All Active Patrons</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Communication Channel *</label>
                        <select name="channel" id="comm_channel" class="form-select">
                            <option value="whatsapp">WhatsApp Cloud API</option>
                            <option value="email">Email Notification</option>
                            <option value="sms">SMS Text Message</option>
                        </select>
                    </div>
                </div>

                <!-- Dynamic Target Containers -->
                <div id="container_customer" class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 12px;">Select Customer</label>
                    <select name="customer_id" class="form-select">
                        <?php foreach ($customers as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= esc($c['name']) ?> (<?= esc($c['phone']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="container_lead" class="mb-3 d-none">
                    <label class="form-label fw-bold" style="font-size: 12px;">Select Inbound Lead</label>
                    <select name="lead_id" class="form-select">
                        <?php foreach ($leads as $l): ?>
                            <option value="<?= $l['id'] ?>"><?= esc($l['name']) ?> - <?= esc($l['service_interested'] ?: 'General') ?> (<?= esc($l['phone']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="container_segment" class="mb-3 d-none">
                    <label class="form-label fw-bold" style="font-size: 12px;">Select Customer Segment</label>
                    <select name="segment" id="select_segment" class="form-select">
                        <option value="all">All Patrons (<?= esc($segments['all']['count']) ?>)</option>
                        <option value="new">New Customers (<?= esc($segments['new']['count']) ?>)</option>
                        <option value="returning">Returning Patrons (<?= esc($segments['returning']['count']) ?>)</option>
                        <option value="bridal">Bridal Inquiries (<?= esc($segments['bridal']['count']) ?>)</option>
                        <option value="vip">VIP High Value (<?= esc($segments['vip']['count']) ?>)</option>
                        <option value="inactive">Inactive Patrons (<?= esc($segments['inactive']['count']) ?>)</option>
                        <option value="leads">Inbound Leads (<?= esc($segments['leads']['count']) ?>)</option>
                    </select>
                </div>

                <!-- Template Selector -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Load Saved Template (Optional)</label>
                        <select id="template_picker" class="form-select" onchange="loadSelectedTemplate(this)">
                            <option value="">-- Choose Template to Auto-Fill --</option>
                            <?php foreach ($templates as $t): ?>
                                <option value="<?= $t['id'] ?>" data-subject="<?= esc($t['subject']) ?>" data-body="<?= esc(strip_tags($t['body_html'])) ?>">
                                    <?= esc($t['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Subject / Campaign Headline</label>
                        <input type="text" name="subject" id="comm_subject" class="form-control" placeholder="Subject line (for Email)">
                    </div>
                </div>

                <!-- Variable Tokens -->
                <div class="mb-2">
                    <span class="text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase;">Personalization Tokens:</span>
                    <div class="d-flex flex-wrap gap-1 mt-1">
                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="appendToken('{{customer_name}}')">{{customer_name}}</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="appendToken('{{business_name}}')">{{business_name}}</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="appendToken('{{service_name}}')">{{service_name}}</button>
                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="appendToken('{{coupon_code}}')">{{coupon_code}}</button>
                    </div>
                </div>

                <!-- Message Body -->
                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 12px;">Message Content *</label>
                    <textarea name="message" id="comm_message" class="form-control" rows="5" required placeholder="Type your client notification or campaign message here..."></textarea>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="previewMessage()">
                        <span class="material-symbols-outlined align-middle" style="font-size: 15px;">visibility</span>
                        Preview Message
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary d-flex align-items-center gap-1" style="background: var(--accent); border-color: var(--accent);">
                        <span class="material-symbols-outlined" style="font-size: 16px;">send</span>
                        Dispatch Communication
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Segments & Intelligence -->
    <div class="col-xl-5">
        <div class="glass-panel p-4 h-100">
            <h6 class="fw-bold mb-1" style="color: var(--text-main);">Dynamic Customer Segments</h6>
            <small class="text-muted d-block mb-3">Live audience groups built from client visit data and lifetime value.</small>

            <div class="list-group list-group-flush">
                <?php foreach ($segments as $key => $seg): ?>
                    <div class="list-group-item bg-transparent px-0 py-2 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold" style="font-size: 13px; color: var(--text-main);"><?= esc($seg['name']) ?></div>
                            <small class="text-muted" style="font-size: 11px;"><?= esc($seg['desc']) ?></small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge" style="background: rgba(89, 46, 131, 0.1); color: var(--accent); font-size: 12px; font-weight: 700; border-radius: 8px;">
                                <?= esc($seg['count']) ?>
                            </span>
                            <button type="button" class="btn btn-sm btn-outline-primary p-1" title="Target this segment"
                                    onclick="targetSegment('<?= $key ?>')">
                                <span class="material-symbols-outlined" style="font-size: 15px;">forward_to_inbox</span>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Communication History Log -->
<div class="glass-panel p-0 overflow-hidden mb-4">
    <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
        <h6 class="fw-bold mb-0" style="color: var(--text-main); font-size: 14px;">Recent Outbound Communication Log</h6>
        <span class="badge bg-light text-muted border" style="font-size: 11px;">Last 100 Dispatches</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 12.5px;">
            <thead style="background: rgba(89, 46, 131, 0.04); font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">
                <tr>
                    <th class="ps-4 py-3">Timestamp</th>
                    <th class="py-3">Channel</th>
                    <th class="py-3">Recipient</th>
                    <th class="py-3">Subject / Preview</th>
                    <th class="py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($logs)): ?>
                    <?php foreach ($logs as $l): ?>
                        <tr>
                            <td class="ps-4 text-muted" style="font-size: 11.5px;"><?= date('d M Y, h:i A', strtotime($l['sent_at'] ?: $l['created_at'])) ?></td>
                            <td>
                                <?php if ($l['channel'] === 'whatsapp'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success"><i class="fab fa-whatsapp me-1"></i> WhatsApp</span>
                                <?php elseif ($l['channel'] === 'email'): ?>
                                    <span class="badge bg-primary bg-opacity-10 text-primary"><span class="material-symbols-outlined align-middle" style="font-size: 12px;">mail</span> Email</span>
                                <?php elseif ($l['channel'] === 'sms'): ?>
                                    <span class="badge bg-info bg-opacity-10 text-info"><span class="material-symbols-outlined align-middle" style="font-size: 12px;">sms</span> SMS</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary"><?= esc($l['channel']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-bold" style="color: var(--text-main);"><?= esc($l['recipient_name'] ?: 'Client') ?></div>
                                <small class="text-muted"><?= esc($l['recipient_contact'] ?: ($l['recipient_phone'] ?? '')) ?></small>
                            </td>
                            <td style="max-width: 380px;">
                                <?php if (!empty($l['subject'])): ?>
                                    <div class="fw-semibold text-truncate"><?= esc($l['subject']) ?></div>
                                <?php endif; ?>
                                <div class="text-muted text-truncate" style="font-size: 11.5px;"><?= esc($l['message_content'] ?? ($l['message'] ?? '')) ?></div>
                            </td>
                            <td>
                                <?php if ($l['status'] === 'sent'): ?>
                                    <span class="badge bg-success" style="border-radius: 8px;">Sent</span>
                                <?php elseif ($l['status'] === 'failed'): ?>
                                    <span class="badge bg-danger" style="border-radius: 8px;" title="<?= esc($l['error_message'] ?? '') ?>">Failed</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark" style="border-radius: 8px;">Pending</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No communication records logged yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function handleTargetTypeChange(val) {
    document.getElementById('container_customer').classList.add('d-none');
    document.getElementById('container_lead').classList.add('d-none');
    document.getElementById('container_segment').classList.add('d-none');

    if (val === 'customer') {
        document.getElementById('container_customer').classList.remove('d-none');
    } else if (val === 'lead') {
        document.getElementById('container_lead').classList.remove('d-none');
    } else if (val === 'segment') {
        document.getElementById('container_segment').classList.remove('d-none');
    }
}

function targetSegment(segKey) {
    document.getElementById('target_type').value = 'segment';
    handleTargetTypeChange('segment');
    document.getElementById('select_segment').value = segKey;
    document.getElementById('comm_message').focus();
}

function loadSelectedTemplate(elem) {
    var opt = elem.options[elem.selectedIndex];
    if (opt && opt.value) {
        document.getElementById('comm_subject').value = opt.getAttribute('data-subject') || '';
        document.getElementById('comm_message').value = opt.getAttribute('data-body') || '';
    }
}

function appendToken(tok) {
    var area = document.getElementById('comm_message');
    area.value += ' ' + tok;
    area.focus();
}

function previewMessage() {
    var msg = document.getElementById('comm_message').value;
    var ch = document.getElementById('comm_channel').value;
    alert("Simulated Dispatch Preview (" + ch.toUpperCase() + "):\n\n" + msg);
}
</script>

<?= $this->endSection() ?>
