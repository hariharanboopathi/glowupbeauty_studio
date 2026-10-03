<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<!-- Header -->
<div class="glass-panel p-4 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h5 class="fw-bold mb-1" style="color: var(--text-main); font-family: 'Playfair Display', serif;">API Keys & Channel Integrations</h5>
            <p class="text-muted mb-0" style="font-size: 13px;">
                Configure real API keys, credentials, and live gateways for automated client communications, marketing, and lead synchronization.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-dark border px-3 py-2" style="font-size: 11px;">
                <span class="material-symbols-outlined align-middle me-1 text-success" style="font-size: 14px;">security</span>
                Credentials Encrypted & Server-Side Secured
            </span>
        </div>
    </div>
</div>

<!-- Nav Tabs -->
<div class="glass-panel p-2 mb-4">
    <ul class="nav nav-pills gap-1" id="integrationTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active d-flex align-items-center gap-2 px-3 py-2" id="whatsapp-tab" data-bs-toggle="pill" data-bs-target="#whatsapp-pane" style="font-size: 13px; border-radius: 8px;">
                <?= glowup_whatsapp_icon('text-success', 18) ?>
                WhatsApp Cloud API
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center gap-2 px-3 py-2" id="sms-tab" data-bs-toggle="pill" data-bs-target="#sms-pane" style="font-size: 13px; border-radius: 8px;">
                <span class="material-symbols-outlined text-primary fs-6">sms</span>
                SMS Gateway
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center gap-2 px-3 py-2" id="email-tab" data-bs-toggle="pill" data-bs-target="#email-pane" style="font-size: 13px; border-radius: 8px;">
                <span class="material-symbols-outlined text-warning fs-6">mail</span>
                Email (SMTP)
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center gap-2 px-3 py-2" id="meta-tab" data-bs-toggle="pill" data-bs-target="#meta-pane" style="font-size: 13px; border-radius: 8px;">
                <?= glowup_facebook_icon('text-primary', 18) ?>
                Facebook / Meta
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center gap-2 px-3 py-2" id="instagram-tab" data-bs-toggle="pill" data-bs-target="#instagram-pane" style="font-size: 13px; border-radius: 8px;">
                <?= glowup_instagram_icon('text-danger', 18) ?>
                Instagram
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link d-flex align-items-center gap-2 px-3 py-2" id="maps-tab" data-bs-toggle="pill" data-bs-target="#maps-pane" style="font-size: 13px; border-radius: 8px;">
                <span class="material-symbols-outlined text-danger fs-6">map</span>
                Google Maps
            </button>
        </li>
    </ul>
</div>

<!-- Tab Content -->
<div class="tab-content" id="integrationTabContent">
    <!-- 1. WHATSAPP CLOUD API -->
    <div class="tab-pane fade show active" id="whatsapp-pane" role="tabpanel">
        <div class="glass-panel p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom gap-3">
                <div>
                    <h6 class="fw-bold mb-1" style="color: var(--text-main);">Meta WhatsApp Business Cloud API</h6>
                    <small class="text-muted">Official Graph API integration for automated booking confirmations, reminders, invoices, and offers.</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badge-whatsapp" class="badge <?= ($configs['whatsapp']['status'] === 'connected') ? 'bg-success' : (($configs['whatsapp']['status'] === 'connection_failed') ? 'bg-danger' : 'bg-secondary') ?> px-3 py-2" style="border-radius: 20px; font-size: 11px;">
                        <?= ($configs['whatsapp']['status'] === 'connected') ? 'Connected' : (($configs['whatsapp']['status'] === 'connection_failed') ? 'Connection Failed' : 'Not Configured') ?>
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1" onclick="runTestConnection('whatsapp')">
                        <span class="material-symbols-outlined" style="font-size: 15px;">wifi_find</span>
                        Test Connection
                    </button>
                </div>
            </div>

            <div id="test-alert-whatsapp" class="alert d-none mb-4" style="font-size: 12.5px;"></div>

            <form action="<?= base_url('admin/settings/integrations/save/whatsapp') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">WhatsApp Business Phone Number ID *</label>
                        <input type="text" name="phone_number_id" class="form-control font-monospace" value="<?= esc($configs['whatsapp']['phone_number_id'] ?? '') ?>" placeholder="e.g. 104523992817263">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">WhatsApp Business Account ID (WABA) *</label>
                        <input type="text" name="business_account_id" class="form-control font-monospace" value="<?= esc($configs['whatsapp']['business_account_id'] ?? '') ?>" placeholder="e.g. 109847261524332">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Meta App ID</label>
                        <input type="text" name="meta_app_id" class="form-control font-monospace" value="<?= esc($configs['whatsapp']['meta_app_id'] ?? '') ?>" placeholder="e.g. 847291048291029">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Meta App Secret</label>
                        <input type="password" name="meta_app_secret" class="form-control font-monospace" value="<?= esc($configs['whatsapp']['meta_app_secret_masked'] ?? '') ?>" placeholder="Enter App Secret">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 12px;">System User Permanent Access Token *</label>
                    <input type="password" name="access_token" class="form-control font-monospace" value="<?= esc($configs['whatsapp']['access_token_masked'] ?? '') ?>" placeholder="EAAX... (Meta System User Token)">
                    <small class="text-muted" style="font-size: 11px;">Generate a permanent access token with <code>whatsapp_business_messaging</code> and <code>whatsapp_business_management</code> permissions in Meta Business Manager.</small>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Webhook Verify Token</label>
                        <input type="text" name="webhook_verify_token" class="form-control font-monospace" value="<?= esc($configs['whatsapp']['webhook_verify_token'] ?? 'glowup_meta_webhook_2026') ?>" placeholder="glowup_meta_webhook_2026">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Graph API Version</label>
                        <input type="text" name="api_version" class="form-control font-monospace" value="<?= esc($configs['whatsapp']['api_version'] ?? 'v19.0') ?>" placeholder="v19.0">
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="enabled" value="1" id="wa_enabled" <?= !empty($configs['whatsapp']['enabled']) ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="wa_enabled" style="font-size: 12.5px;">Enable WhatsApp Cloud Service</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save WhatsApp Config</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. SMS GATEWAY -->
    <div class="tab-pane fade" id="sms-pane" role="tabpanel">
        <div class="glass-panel p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom gap-3">
                <div>
                    <h6 class="fw-bold mb-1" style="color: var(--text-main);">Transactional SMS Gateway</h6>
                    <small class="text-muted">Configurable SMS provider (Fast2SMS, Twilio, Msg91, or custom gateway) for client OTPs, appointment alerts, and invoice links.</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badge-sms" class="badge <?= ($configs['sms']['status'] === 'connected') ? 'bg-success' : (($configs['sms']['status'] === 'connection_failed') ? 'bg-danger' : 'bg-secondary') ?> px-3 py-2" style="border-radius: 20px; font-size: 11px;">
                        <?= ($configs['sms']['status'] === 'connected') ? 'Connected' : (($configs['sms']['status'] === 'connection_failed') ? 'Connection Failed' : 'Not Configured') ?>
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1" onclick="runTestConnection('sms')">
                        <span class="material-symbols-outlined" style="font-size: 15px;">wifi_find</span>
                        Test Connection
                    </button>
                </div>
            </div>

            <div id="test-alert-sms" class="alert d-none mb-4" style="font-size: 12.5px;"></div>

            <form action="<?= base_url('admin/settings/integrations/save/sms') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">SMS Gateway Provider *</label>
                        <select name="provider" class="form-select">
                            <option value="Fast2SMS" <?= (($configs['sms']['provider'] ?? '') === 'Fast2SMS') ? 'selected' : '' ?>>Fast2SMS (India Bulk & Quick)</option>
                            <option value="Twilio" <?= (($configs['sms']['provider'] ?? '') === 'Twilio') ? 'selected' : '' ?>>Twilio</option>
                            <option value="Msg91" <?= (($configs['sms']['provider'] ?? '') === 'Msg91') ? 'selected' : '' ?>>Msg91</option>
                            <option value="Custom" <?= (($configs['sms']['provider'] ?? '') === 'Custom') ? 'selected' : '' ?>>Custom HTTP API Gateway</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Sender ID / Header</label>
                        <input type="text" name="sender_id" class="form-control font-monospace" value="<?= esc($configs['sms']['sender_id'] ?? 'GLOWUP') ?>" placeholder="e.g. GLOWUP">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 12px;">Provider API Key / Secret *</label>
                    <input type="password" name="api_key" class="form-control font-monospace" value="<?= esc($configs['sms']['api_key_masked'] ?? '') ?>" placeholder="Enter SMS Provider API Key">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold" style="font-size: 12px;">API Endpoint URL</label>
                    <input type="text" name="api_url" class="form-control font-monospace" value="<?= esc($configs['sms']['api_url'] ?? 'https://www.fast2sms.com/dev/bulkV2') ?>" placeholder="https://www.fast2sms.com/dev/bulkV2">
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="enabled" value="1" id="sms_enabled" <?= !empty($configs['sms']['enabled']) ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="sms_enabled" style="font-size: 12.5px;">Enable SMS Gateway</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save SMS Config</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. EMAIL (SMTP) -->
    <div class="tab-pane fade" id="email-pane" role="tabpanel">
        <div class="glass-panel p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom gap-3">
                <div>
                    <h6 class="fw-bold mb-1" style="color: var(--text-main);">Transactional SMTP / Mail Service</h6>
                    <small class="text-muted">Configure outbound SMTP mail server for client invoices, booking schedules, and password reset communications.</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badge-email_smtp" class="badge <?= ($configs['email_smtp']['status'] === 'connected') ? 'bg-success' : (($configs['email_smtp']['status'] === 'connection_failed') ? 'bg-danger' : 'bg-secondary') ?> px-3 py-2" style="border-radius: 20px; font-size: 11px;">
                        <?= ($configs['email_smtp']['status'] === 'connected') ? 'Connected' : (($configs['email_smtp']['status'] === 'connection_failed') ? 'Connection Failed' : 'Not Configured') ?>
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1" onclick="runTestConnection('email_smtp')">
                        <span class="material-symbols-outlined" style="font-size: 15px;">wifi_find</span>
                        Test Socket Handshake
                    </button>
                </div>
            </div>

            <div id="test-alert-email_smtp" class="alert d-none mb-4" style="font-size: 12.5px;"></div>

            <form action="<?= base_url('admin/settings/integrations/save/email_smtp') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">SMTP Host *</label>
                        <input type="text" name="smtp_host" class="form-control font-monospace" value="<?= esc($configs['email_smtp']['smtp_host'] ?? 'smtp.gmail.com') ?>" placeholder="smtp.gmail.com">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Port *</label>
                        <input type="number" name="smtp_port" class="form-control font-monospace" value="<?= esc($configs['email_smtp']['smtp_port'] ?? '587') ?>" placeholder="587">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold" style="font-size: 12px;">Encryption</label>
                        <select name="smtp_crypto" class="form-select">
                            <option value="tls" <?= (($configs['email_smtp']['smtp_crypto'] ?? '') === 'tls') ? 'selected' : '' ?>>TLS (Port 587)</option>
                            <option value="ssl" <?= (($configs['email_smtp']['smtp_crypto'] ?? '') === 'ssl') ? 'selected' : '' ?>>SSL (Port 465)</option>
                            <option value="" <?= empty($configs['email_smtp']['smtp_crypto']) ? 'selected' : '' ?>>None (Port 25)</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">SMTP Username / Account *</label>
                        <input type="text" name="smtp_user" class="form-control font-monospace" value="<?= esc($configs['email_smtp']['smtp_user'] ?? '') ?>" placeholder="concierge@glowup.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">SMTP Password / App Secret *</label>
                        <input type="password" name="smtp_pass" class="form-control font-monospace" value="<?= esc($configs['email_smtp']['smtp_pass_masked'] ?? '') ?>" placeholder="Enter SMTP App Password">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">From Email Address *</label>
                        <input type="email" name="from_email" class="form-control" value="<?= esc($configs['email_smtp']['from_email'] ?? 'concierge@glowup.com') ?>" placeholder="concierge@glowup.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">From Sender Name *</label>
                        <input type="text" name="from_name" class="form-control" value="<?= esc($configs['email_smtp']['from_name'] ?? 'Glowup Studio & Academy') ?>" placeholder="Glowup Studio & Academy">
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="enabled" value="1" id="email_enabled" <?= !empty($configs['email_smtp']['enabled']) ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="email_enabled" style="font-size: 12.5px;">Enable SMTP Mail Dispatch</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save Email Config</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 4. FACEBOOK / META -->
    <div class="tab-pane fade" id="meta-pane" role="tabpanel">
        <div class="glass-panel p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom gap-3">
                <div>
                    <h6 class="fw-bold mb-1" style="color: var(--text-main);">Facebook & Meta Lead Ads Integration</h6>
                    <small class="text-muted">Synchronize inbound leads from Meta Lead Gen ads, Facebook Page enquiries, and event registrations.</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badge-facebook_meta" class="badge <?= ($configs['facebook_meta']['status'] === 'connected') ? 'bg-success' : (($configs['facebook_meta']['status'] === 'connection_failed') ? 'bg-danger' : 'bg-secondary') ?> px-3 py-2" style="border-radius: 20px; font-size: 11px;">
                        <?= ($configs['facebook_meta']['status'] === 'connected') ? 'Connected' : (($configs['facebook_meta']['status'] === 'connection_failed') ? 'Connection Failed' : 'Not Configured') ?>
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1" onclick="runTestConnection('facebook_meta')">
                        <span class="material-symbols-outlined" style="font-size: 15px;">wifi_find</span>
                        Test Meta Connection
                    </button>
                </div>
            </div>

            <div id="test-alert-facebook_meta" class="alert d-none mb-4" style="font-size: 12.5px;"></div>

            <form action="<?= base_url('admin/settings/integrations/save/facebook_meta') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Meta App ID</label>
                        <input type="text" name="app_id" class="form-control font-monospace" value="<?= esc($configs['facebook_meta']['app_id'] ?? '') ?>" placeholder="e.g. 192837465019283">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Meta App Secret</label>
                        <input type="password" name="app_secret" class="form-control font-monospace" value="<?= esc($configs['facebook_meta']['app_secret_masked'] ?? '') ?>" placeholder="Enter App Secret">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Facebook Page ID</label>
                        <input type="text" name="page_id" class="form-control font-monospace" value="<?= esc($configs['facebook_meta']['page_id'] ?? '') ?>" placeholder="e.g. 102938475610293">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold" style="font-size: 12px;">Page Access Token</label>
                        <input type="password" name="page_access_token" class="form-control font-monospace" value="<?= esc($configs['facebook_meta']['page_access_token_masked'] ?? '') ?>" placeholder="Enter Page Access Token">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold" style="font-size: 12px;">Webhook Verify Token</label>
                    <input type="text" name="webhook_verify_token" class="form-control font-monospace" value="<?= esc($configs['facebook_meta']['webhook_verify_token'] ?? 'glowup_meta_leads_2026') ?>" placeholder="glowup_meta_leads_2026">
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="enabled" value="1" id="fb_enabled" <?= !empty($configs['facebook_meta']['enabled']) ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="fb_enabled" style="font-size: 12.5px;">Enable Meta Lead Ads Sync</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save Meta Config</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 5. INSTAGRAM -->
    <div class="tab-pane fade" id="instagram-pane" role="tabpanel">
        <div class="glass-panel p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom gap-3">
                <div>
                    <h6 class="fw-bold mb-1" style="color: var(--text-main);">Instagram Professional API</h6>
                    <small class="text-muted">Connect Instagram business profile for lookbook media sync, DM lead inquiries, and campaign attribution.</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badge-instagram" class="badge <?= ($configs['instagram']['status'] === 'connected') ? 'bg-success' : (($configs['instagram']['status'] === 'connection_failed') ? 'bg-danger' : 'bg-secondary') ?> px-3 py-2" style="border-radius: 20px; font-size: 11px;">
                        <?= ($configs['instagram']['status'] === 'connected') ? 'Connected' : (($configs['instagram']['status'] === 'connection_failed') ? 'Connection Failed' : 'Not Configured') ?>
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1" onclick="runTestConnection('instagram')">
                        <span class="material-symbols-outlined" style="font-size: 15px;">wifi_find</span>
                        Test Instagram API
                    </button>
                </div>
            </div>

            <div id="test-alert-instagram" class="alert d-none mb-4" style="font-size: 12.5px;"></div>

            <form action="<?= base_url('admin/settings/integrations/save/instagram') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label fw-bold" style="font-size: 12px;">Instagram Professional Account ID</label>
                    <input type="text" name="instagram_account_id" class="form-control font-monospace" value="<?= esc($configs['instagram']['instagram_account_id'] ?? '') ?>" placeholder="e.g. 17841405309281726">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold" style="font-size: 12px;">Instagram User Access Token</label>
                    <input type="password" name="access_token" class="form-control font-monospace" value="<?= esc($configs['instagram']['access_token_masked'] ?? '') ?>" placeholder="Enter Instagram Graph Token">
                    <small class="text-muted" style="font-size: 11px;">Requires <code>instagram_basic</code> and <code>instagram_manage_messages</code> permissions granted via Meta App Review.</small>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="enabled" value="1" id="ig_enabled" <?= !empty($configs['instagram']['enabled']) ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="ig_enabled" style="font-size: 12.5px;">Enable Instagram Integration</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save Instagram Config</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 6. GOOGLE MAPS -->
    <div class="tab-pane fade" id="maps-pane" role="tabpanel">
        <div class="glass-panel p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-4 border-bottom gap-3">
                <div>
                    <h6 class="fw-bold mb-1" style="color: var(--text-main);">Google Maps Platform API</h6>
                    <small class="text-muted">Powers luxury location embed on website contact page and salon studio directions.</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badge-google_maps" class="badge <?= ($configs['google_maps']['status'] === 'connected') ? 'bg-success' : (($configs['google_maps']['status'] === 'connection_failed') ? 'bg-danger' : 'bg-secondary') ?> px-3 py-2" style="border-radius: 20px; font-size: 11px;">
                        <?= ($configs['google_maps']['status'] === 'connected') ? 'Connected' : (($configs['google_maps']['status'] === 'connection_failed') ? 'Connection Failed' : 'Not Configured') ?>
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1" onclick="runTestConnection('google_maps')">
                        <span class="material-symbols-outlined" style="font-size: 15px;">wifi_find</span>
                        Test Maps API Key
                    </button>
                </div>
            </div>

            <div id="test-alert-google_maps" class="alert d-none mb-4" style="font-size: 12.5px;"></div>

            <form action="<?= base_url('admin/settings/integrations/save/google_maps') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-4">
                    <label class="form-label fw-bold" style="font-size: 12px;">Google Maps JavaScript & Embed API Key</label>
                    <input type="password" name="api_key" class="form-control font-monospace" value="<?= esc($configs['google_maps']['api_key_masked'] ?? '') ?>" placeholder="AIzaSy...">
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="enabled" value="1" id="maps_enabled" <?= !empty($configs['google_maps']['enabled']) ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="maps_enabled" style="font-size: 12.5px;">Enable Google Maps Embed</label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" style="background: var(--accent); border-color: var(--accent);">Save Maps Key</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Check URL hash or query param for tab
document.addEventListener('DOMContentLoaded', function() {
    var params = new URLSearchParams(window.location.search);
    var tab = params.get('tab');
    if (tab) {
        var trigger = document.getElementById(tab + '-tab');
        if (trigger) {
            var tabObj = new bootstrap.Tab(trigger);
            tabObj.show();
        }
    }
});

function runTestConnection(providerKey) {
    var badge = document.getElementById('badge-' + providerKey);
    var alertBox = document.getElementById('test-alert-' + providerKey);

    badge.className = 'badge bg-warning text-dark px-3 py-2';
    badge.textContent = 'Testing...';
    alertBox.className = 'alert alert-info mb-4';
    alertBox.textContent = 'Connecting to ' + providerKey + ' endpoint and validating handshake...';
    alertBox.classList.remove('d-none');

    fetch('<?= base_url('admin/settings/integrations/test/') ?>' + providerKey)
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.status === 'connected') {
                badge.className = 'badge bg-success px-3 py-2';
                badge.textContent = 'Connected';
                alertBox.className = 'alert alert-success mb-4';
                alertBox.innerHTML = '<strong>Success!</strong> ' + data.message;
            } else if (data.status === 'connection_failed') {
                badge.className = 'badge bg-danger px-3 py-2';
                badge.textContent = 'Connection Failed';
                alertBox.className = 'alert alert-danger mb-4';
                alertBox.innerHTML = '<strong>Connection Failed:</strong> ' + data.message;
            } else {
                badge.className = 'badge bg-secondary px-3 py-2';
                badge.textContent = 'Not Configured';
                alertBox.className = 'alert alert-warning mb-4';
                alertBox.innerHTML = '<strong>Not Configured:</strong> ' + data.message;
            }
        })
        .catch(function(err) {
            badge.className = 'badge bg-danger px-3 py-2';
            badge.textContent = 'Error';
            alertBox.className = 'alert alert-danger mb-4';
            alertBox.textContent = 'Network error while attempting connection test.';
        });
}
</script>

<?= $this->endSection() ?>
