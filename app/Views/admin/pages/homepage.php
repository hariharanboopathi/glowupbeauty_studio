<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<style>
    /* Clean White Cards & Components for Homepage CMS */
    .cms-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        padding: 24px;
        margin-bottom: 24px;
    }

    .cms-stat-card {
        background: #ffffff;
        border: 1px solid #ede6e4;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .cms-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(89, 46, 131, 0.1);
        border-color: #A36952;
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
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
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

    .slide-thumb {
        width: 64px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #ede6e4;
    }
</style>

<!-- Top Statistics & Quick Summary -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="cms-stat-card">
            <div>
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7a6e78; font-weight: 700;">Hero Banner</div>
                <div style="font-size: 1.5rem; font-family: 'Playfair Display', serif; font-weight: 700; color: #483C46;">Active</div>
                <div style="font-size: 12px; color: #15803d;"><span class="material-symbols-outlined" style="font-size: 14px; vertical-align: middle;">check_circle</span> Live on Homepage</div>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: #592E83;">
                <span class="material-symbols-outlined" style="font-size: 24px;">view_headline</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="cms-stat-card">
            <div>
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7a6e78; font-weight: 700;">Film Slideshow</div>
                <div style="font-size: 1.5rem; font-family: 'Playfair Display', serif; font-weight: 700; color: #483C46;"><?= count($slides ?? []) ?> Slides</div>
                <div style="font-size: 12px; color: #7a6e78;">2-sec Auto Carousel</div>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(163, 105, 82, 0.1); display: flex; align-items: center; justify-content: center; color: #A36952;">
                <span class="material-symbols-outlined" style="font-size: 24px;">slideshow</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="cms-stat-card">
            <div>
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7a6e78; font-weight: 700;">Popular Treatments</div>
                <div style="font-size: 1.5rem; font-family: 'Playfair Display', serif; font-weight: 700; color: #483C46;"><?= count($services ?? []) ?> Items</div>
                <div style="font-size: 12px; color: #15803d;"><span class="material-symbols-outlined" style="font-size: 14px; vertical-align: middle;">verified</span> Featured Grid</div>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(89, 46, 131, 0.08); display: flex; align-items: center; justify-content: center; color: #592E83;">
                <span class="material-symbols-outlined" style="font-size: 24px;">spa</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="cms-stat-card">
            <div>
                <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.06em; color: #7a6e78; font-weight: 700;">Public View</div>
                <a href="<?= base_url() ?>" target="_blank" class="btn-clean-secondary mt-1" style="padding: 5px 12px; font-size: 12px; height: 32px;">
                    <span>Open Live Site</span>
                    <span class="material-symbols-outlined" style="font-size: 14px;">open_in_new</span>
                </a>
            </div>
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(34, 197, 94, 0.1); display: flex; align-items: center; justify-content: center; color: #15803d;">
                <span class="material-symbols-outlined" style="font-size: 24px;">language</span>
            </div>
        </div>
    </div>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-tabs nav-tabs-cms mb-4" id="homepageTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="hero-tab" data-bs-toggle="tab" data-bs-target="#heroPane" type="button" role="tab">
            <span class="material-symbols-outlined" style="font-size: 18px;">title</span>
            <span>Hero Headline &amp; CTA</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="slides-tab" data-bs-toggle="tab" data-bs-target="#slidesPane" type="button" role="tab">
            <span class="material-symbols-outlined" style="font-size: 18px;">movie</span>
            <span>Film Slideshow (<?= count($slides ?? []) ?>)</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="philosophy-tab" data-bs-toggle="tab" data-bs-target="#philosophyPane" type="button" role="tab">
            <span class="material-symbols-outlined" style="font-size: 18px;">history_edu</span>
            <span>Philosophy &amp; Story</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="treatments-tab" data-bs-toggle="tab" data-bs-target="#treatmentsPane" type="button" role="tab">
            <span class="material-symbols-outlined" style="font-size: 18px;">auto_awesome</span>
            <span>Featured Treatments (<?= count($services ?? []) ?>)</span>
        </button>
    </li>
</ul>

<!-- Tab Content Panes -->
<div class="tab-content" id="homepageTabContent">

    <!-- ========================================== -->
    <!-- TAB 1: HERO HEADLINE & CTA                  -->
    <!-- ========================================== -->
    <div class="tab-pane fade show active" id="heroPane" role="tabpanel">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="cms-card">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                        <div>
                            <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">Hero Banner Content</h4>
                            <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Update main headline, subheading, and call-to-action buttons shown at the top of the homepage.</p>
                        </div>
                        <span class="badge-pill-status status-active">
                            <span class="material-symbols-outlined" style="font-size: 14px;">check_circle</span> Live
                        </span>
                    </div>

                    <form action="<?= base_url('admin/homepage/update-hero') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Top Pill / Eyebrow Badge</label>
                            <input type="text" name="pill_text" class="form-control clean-input" value="<?= esc($hero['meta']['pill_text'] ?? 'Bespoke Beauty Sanctuary') ?>" placeholder="e.g. Bespoke Beauty Sanctuary">
                            <div class="form-text" style="font-size: 11.5px; color: #7a6e78;">Optional badge appearing above the primary title.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Main Hero Title <span class="text-danger">*</span></label>
                            <textarea name="title" rows="2" class="form-control clean-textarea" required placeholder="e.g. Reveal Your Natural Radiance"><?= esc($hero['title'] ?? 'Reveal Your<br />Natural Radiance') ?></textarea>
                            <div class="form-text" style="font-size: 11.5px; color: #7a6e78;">HTML line breaks like <code>&lt;br /&gt;</code> are supported.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Subtitle / Lead Text</label>
                            <textarea name="subtitle" rows="3" class="form-control clean-textarea" placeholder="Describe the sanctuary experience..."><?= esc($hero['subtitle'] ?? 'Premium beauty treatments designed to help you look and feel your best, curated within an architectural Academy of stillness.') ?></textarea>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Primary Button Text</label>
                                <input type="text" name="primary_btn_text" class="form-control clean-input" value="<?= esc($hero['meta']['primary_btn_text'] ?? 'Book an Appointment') ?>" placeholder="Book an Appointment">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Primary Button URL</label>
                                <input type="text" name="primary_btn_url" class="form-control clean-input" value="<?= esc($hero['meta']['primary_btn_url'] ?? 'booking') ?>" placeholder="booking">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Secondary Button Text</label>
                                <input type="text" name="secondary_btn_text" class="form-control clean-input" value="<?= esc($hero['meta']['secondary_btn_text'] ?? 'Explore Services') ?>" placeholder="Explore Services">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Secondary Button URL</label>
                                <input type="text" name="secondary_btn_url" class="form-control clean-input" value="<?= esc($hero['meta']['secondary_btn_url'] ?? 'services') ?>" placeholder="services">
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                            <span style="font-size: 12px; color: #7a6e78;">Last Updated: <?= !empty($hero['updated_at']) ? date('M d, Y h:i A', strtotime($hero['updated_at'])) : 'Recently' ?></span>
                            <button type="submit" class="btn-clean-primary">
                                <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="col-lg-4">
                <div class="cms-card" style="background: linear-gradient(180deg, #fbf9fb 0%, #ffffff 100%);">
                    <h5 style="font-family: 'Playfair Display', serif; font-size: 1.1rem; color: #483C46; margin-bottom: 14px;">Live Preview Preview</h5>
                    <div style="background: #ffffff; border: 1px solid #ede6e4; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 4px 12px rgba(89, 46, 131, 0.06);">
                        <span style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.1em; color: #A36952; font-weight: 700; background: rgba(163, 105, 82, 0.1); padding: 3px 10px; border-radius: 999px; display: inline-block; margin-bottom: 12px;">
                            <?= esc($hero['meta']['pill_text'] ?? 'Bespoke Beauty Sanctuary') ?>
                        </span>
                        <h3 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; color: #483C46; line-height: 1.25; margin-bottom: 10px;">
                            <?= strip_tags($hero['title'] ?? 'Reveal Your Natural Radiance', '<br>') ?>
                        </h3>
                        <p style="font-size: 12px; color: #7a6e78; line-height: 1.5; margin-bottom: 16px;">
                            <?= esc($hero['subtitle'] ?? 'Premium beauty treatments designed to help you look and feel your best.') ?>
                        </p>
                        <div class="d-flex justify-content-center gap-2">
                            <span style="font-size: 11px; font-weight: 600; padding: 6px 14px; background: #592E83; color: #fff; border-radius: 6px;">
                                <?= esc($hero['meta']['primary_btn_text'] ?? 'Book Appointment') ?>
                            </span>
                            <span style="font-size: 11px; font-weight: 600; padding: 6px 14px; border: 1px solid #483C46; color: #483C46; border-radius: 6px;">
                                <?= esc($hero['meta']['secondary_btn_text'] ?? 'Explore Services') ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TAB 2: FILM SLIDESHOW CAROUSEL              -->
    <!-- ========================================== -->
    <div class="tab-pane fade" id="slidesPane" role="tabpanel">
        <div class="cms-card">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
                <div>
                    <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">Hero Film Slideshow</h4>
                    <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Manage the visual story slides rotating on the homepage banner (auto-cycles every 2s with progress bar).</p>
                </div>
                <button type="button" class="btn-clean-primary" data-bs-toggle="modal" data-bs-target="#addSlideModal">
                    <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                    <span>Add New Slide</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="cms-table">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Order</th>
                            <th style="width: 90px;">Media</th>
                            <th>Chapter Title</th>
                            <th>Badge / Tag</th>
                            <th>Time Text</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 130px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($slides)): ?>
                            <?php foreach ($slides as $slide): ?>
                                <tr>
                                    <td class="fw-bold" style="color: #7a6e78;">#<?= esc($slide['display_order']) ?></td>
                                    <td>
                                        <?php
                                            $src = (strpos($slide['image_url'], 'http') === 0) ? $slide['image_url'] : base_url($slide['image_url']);
                                        ?>
                                        <img src="<?= esc($src) ?>" alt="Slide" class="slide-thumb" onerror="this.src='https://placehold.co/100x70?text=Film'">
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: #483C46;"><?= esc($slide['chapter_title']) ?></div>
                                        <div style="font-size: 11px; color: #7a6e78;"><?= esc($slide['image_url']) ?></div>
                                    </td>
                                    <td>
                                        <span style="font-size: 11.5px; padding: 3px 8px; border-radius: 6px; background: rgba(163, 105, 82, 0.1); color: #A36952; font-weight: 600;">
                                            <?= esc($slide['badge_text'] ?? 'Academy Sanctum') ?>
                                        </span>
                                    </td>
                                    <td style="font-size: 12.5px; color: #7a6e78;"><?= esc($slide['time_text'] ?? '00:02 / 00:08') ?></td>
                                    <td>
                                        <form action="<?= base_url('admin/homepage/slide/toggle/' . $slide['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                <span class="badge-pill-status <?= $slide['is_active'] ? 'status-active' : 'status-inactive' ?>">
                                                    <span class="material-symbols-outlined" style="font-size: 13px;"><?= $slide['is_active'] ? 'check_circle' : 'block' ?></span>
                                                    <?= $slide['is_active'] ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                    <td style="text-align: right;">
                                        <button type="button" class="btn btn-sm btn-outline-secondary edit-slide-btn me-1" 
                                            data-id="<?= esc($slide['id']) ?>"
                                            data-title="<?= esc($slide['chapter_title']) ?>"
                                            data-badge="<?= esc($slide['badge_text']) ?>"
                                            data-time="<?= esc($slide['time_text']) ?>"
                                            data-order="<?= esc($slide['display_order']) ?>"
                                            data-image="<?= esc($slide['image_url']) ?>"
                                            data-active="<?= esc($slide['is_active']) ?>"
                                            data-bs-toggle="modal" data-bs-target="#editSlideModal"
                                            style="padding: 4px 8px; border-radius: 6px;">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                        </button>
                                        <a href="<?= base_url('admin/homepage/slide/delete/' . $slide['id']) ?>" onclick="return confirm('Remove this slide from carousel?');" class="btn btn-sm btn-outline-danger" style="padding: 4px 8px; border-radius: 6px;">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4" style="color: #7a6e78;">No slides configured yet. Add your first film slide above.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TAB 3: PHILOSOPHY & BRAND STORY             -->
    <!-- ========================================== -->
    <div class="tab-pane fade" id="philosophyPane" role="tabpanel">
        <div class="cms-card">
            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                <div>
                    <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">The Glowup Philosophy &amp; Brand Story</h4>
                    <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Manage the brand narrative section with diagnostic statistics, featured arch portrait, and luxury award badge.</p>
                </div>
                <span class="badge-pill-status status-active">
                    <span class="material-symbols-outlined" style="font-size: 14px;">check_circle</span> Live
                </span>
            </div>

            <form action="<?= base_url('admin/homepage/update-philosophy') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row g-4">
                    <!-- Left Side: Copywriting -->
                    <div class="col-lg-7">
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Eyebrow / Subtitle</label>
                            <input type="text" name="subtitle" class="form-control clean-input" value="<?= esc($philosophy['subtitle'] ?? 'The Glowup Philosophy') ?>" placeholder="The Glowup Philosophy">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Main Heading <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control clean-input" required value="<?= esc($philosophy['title'] ?? 'Beauty, Care & Confidence') ?>" placeholder="Beauty, Care & Confidence">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Primary Story Paragraph</label>
                            <textarea name="content" rows="3" class="form-control clean-textarea" placeholder="Experience personalized beauty treatments delivered with care..."><?= esc($philosophy['content'] ?? 'Experience personalized beauty treatments delivered with care, expertise and attention to every detail. We believe self-renewal is an essential discipline, not an indulgence.') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Secondary Atmosphere Paragraph</label>
                            <textarea name="secondary_content" rows="3" class="form-control clean-textarea" placeholder="Step through arched colonnades sculpted in travertine..."><?= esc($philosophy['meta']['secondary_content'] ?? 'Step through arched colonnades sculpted in travertine and warm lavender limestone. Each visit begins with an intimate diagnostic consultation analyzing your hair porosity and dermis health before pairing with organic cold-pressed serums and clinically calibrated therapies.') ?></textarea>
                        </div>

                        <!-- 3 Statistics Blocks -->
                        <div class="p-3 mb-3" style="background: #faf8fb; border-radius: 12px; border: 1px solid #ede6e4;">
                            <label class="fw-bold mb-2 d-block" style="font-size: 12.5px; color: #592E83;">Diagnostic Numbers / Stat Badges</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <input type="text" name="stat1_value" class="form-control clean-input text-center fw-bold" value="<?= esc($philosophy['meta']['stat1_value'] ?? '100%') ?>" placeholder="100%">
                                    <input type="text" name="stat1_label" class="form-control clean-input mt-1 text-center" style="font-size: 11px !important;" value="<?= esc($philosophy['meta']['stat1_label'] ?? 'Bespoke Formulas') ?>" placeholder="Label">
                                </div>
                                <div class="col-4">
                                    <input type="text" name="stat2_value" class="form-control clean-input text-center fw-bold" value="<?= esc($philosophy['meta']['stat2_value'] ?? '14+') ?>" placeholder="14+">
                                    <input type="text" name="stat2_label" class="form-control clean-input mt-1 text-center" style="font-size: 11px !important;" value="<?= esc($philosophy['meta']['stat2_label'] ?? 'Master Artists') ?>" placeholder="Label">
                                </div>
                                <div class="col-4">
                                    <input type="text" name="stat3_value" class="form-control clean-input text-center fw-bold" value="<?= esc($philosophy['meta']['stat3_value'] ?? '4.98') ?>" placeholder="4.98">
                                    <input type="text" name="stat3_label" class="form-control clean-input mt-1 text-center" style="font-size: 11px !important;" value="<?= esc($philosophy['meta']['stat3_label'] ?? 'Academy Score') ?>" placeholder="Label">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Button Text</label>
                                <input type="text" name="btn_text" class="form-control clean-input" value="<?= esc($philosophy['meta']['btn_text'] ?? 'Discover Our Story') ?>" placeholder="Discover Our Story">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Button Link URL</label>
                                <input type="text" name="btn_url" class="form-control clean-input" value="<?= esc($philosophy['meta']['btn_url'] ?? 'about') ?>" placeholder="about">
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Imagery & Award -->
                    <div class="col-lg-5">
                        <div class="p-3 mb-3" style="background: #ffffff; border: 1px solid #ede6e4; border-radius: 12px;">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Arch Archival Image</label>
                            
                            <?php 
                                $philImg = $philosophy['meta']['image_url'] ?? 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=900&q=80';
                                if (strpos($philImg, 'http') !== 0) {
                                    $philImg = base_url($philImg);
                                }
                            ?>
                            <div class="mb-3 text-center">
                                <img src="<?= esc($philImg) ?>" id="philosophyImgPreview" alt="Story Visual" style="width: 100%; max-height: 240px; object-fit: cover; border-radius: 10px; border: 1px solid #ede6e4;">
                            </div>

                            <div class="mb-2">
                                <label class="form-label" style="font-size: 12px; color: #7a6e78;">Image URL or Path</label>
                                <input type="text" name="image_url" id="philosophyImgUrlInput" class="form-control clean-input" value="<?= esc($philosophy['meta']['image_url'] ?? 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=900&q=80') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="font-size: 12px; color: #7a6e78;">Or Upload New Archival Image</label>
                                <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                            </div>
                        </div>

                        <!-- Award Badge Card -->
                        <div class="p-3" style="background: #ffffff; border: 1px solid #ede6e4; border-radius: 12px;">
                            <label class="form-label fw-bold" style="font-size: 12.5px; color: #483C46;">Luxury Award Badge</label>
                            <div class="mb-2">
                                <label class="form-label" style="font-size: 11.5px; color: #7a6e78;">Publication / Organization</label>
                                <input type="text" name="award_title" class="form-control clean-input" value="<?= esc($philosophy['meta']['award_title'] ?? 'Vogue Wellness') ?>" placeholder="e.g. Vogue Wellness">
                            </div>
                            <div>
                                <label class="form-label" style="font-size: 11.5px; color: #7a6e78;">Accolade Description</label>
                                <input type="text" name="award_desc" class="form-control clean-input" value="<?= esc($philosophy['meta']['award_desc'] ?? 'Best Luxury Wellness Academy 2024') ?>" placeholder="Best Luxury Wellness Academy 2024">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-4 mt-3 border-top">
                    <span style="font-size: 12px; color: #7a6e78;">Last Updated: <?= !empty($philosophy['updated_at']) ? date('M d, Y h:i A', strtotime($philosophy['updated_at'])) : 'Recently' ?></span>
                    <button type="submit" class="btn-clean-primary">
                        <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                        <span>Save Philosophy Section</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TAB 4: POPULAR TREATMENTS / SERVICES        -->
    <!-- ========================================== -->
    <div class="tab-pane fade" id="treatmentsPane" role="tabpanel">
        <div class="cms-card">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-2 border-bottom">
                <div>
                    <h4 style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #483C46; margin: 0; font-weight: 600;">Popular Treatments Grid</h4>
                    <p style="font-size: 12.5px; color: #7a6e78; margin: 2px 0 0;">Manage signature treatments displayed on the homepage with image, price, duration and direct booking links.</p>
                </div>
                <button type="button" class="btn-clean-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
                    <span>Add Treatment</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="cms-table">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Order</th>
                            <th style="width: 90px;">Media</th>
                            <th>Treatment Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 130px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($services)): ?>
                            <?php foreach ($services as $srv): ?>
                                <tr>
                                    <td class="fw-bold" style="color: #7a6e78;">#<?= esc($srv['display_order']) ?></td>
                                    <td>
                                        <?php
                                            $srvImg = (strpos($srv['image_url'], 'http') === 0) ? $srv['image_url'] : base_url($srv['image_url']);
                                        ?>
                                        <img src="<?= esc($srvImg) ?>" alt="Treatment" class="slide-thumb" onerror="this.src='https://placehold.co/100x70?text=Service'">
                                    </td>
                                    <td>
                                        <div class="fw-bold" style="color: #483C46;"><?= esc($srv['title']) ?></div>
                                        <div style="font-size: 11.5px; color: #7a6e78; max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?= esc($srv['description']) ?></div>
                                    </td>
                                    <td>
                                        <span style="font-size: 11.5px; padding: 3px 8px; border-radius: 6px; background: rgba(89, 46, 131, 0.08); color: #592E83; font-weight: 600;">
                                            <?= esc($srv['category'] ?? 'Treatment') ?>
                                        </span>
                                    </td>
                                    <td class="fw-bold" style="color: #A36952;"><?= esc($srv['price']) ?></td>
                                    <td style="font-size: 12px; color: #7a6e78;"><?= esc($srv['duration']) ?></td>
                                    <td>
                                        <form action="<?= base_url('admin/homepage/service/toggle/' . $srv['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                <span class="badge-pill-status <?= $srv['is_active'] ? 'status-active' : 'status-inactive' ?>">
                                                    <span class="material-symbols-outlined" style="font-size: 13px;"><?= $srv['is_active'] ? 'check_circle' : 'block' ?></span>
                                                    <?= $srv['is_active'] ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                    <td style="text-align: right;">
                                        <button type="button" class="btn btn-sm btn-outline-secondary edit-service-btn me-1"
                                            data-id="<?= esc($srv['id']) ?>"
                                            data-title="<?= esc($srv['title']) ?>"
                                            data-category="<?= esc($srv['category']) ?>"
                                            data-price="<?= esc($srv['price']) ?>"
                                            data-duration="<?= esc($srv['duration']) ?>"
                                            data-desc="<?= esc($srv['description']) ?>"
                                            data-image="<?= esc($srv['image_url']) ?>"
                                            data-order="<?= esc($srv['display_order']) ?>"
                                            data-btn-text="<?= esc($srv['button_text']) ?>"
                                            data-btn-url="<?= esc($srv['button_url']) ?>"
                                            data-active="<?= esc($srv['is_active']) ?>"
                                            data-bs-toggle="modal" data-bs-target="#editServiceModal"
                                            style="padding: 4px 8px; border-radius: 6px;">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                        </button>
                                        <a href="<?= base_url('admin/homepage/service/delete/' . $srv['id']) ?>" onclick="return confirm('Remove this featured treatment?');" class="btn btn-sm btn-outline-danger" style="padding: 4px 8px; border-radius: 6px;">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4" style="color: #7a6e78;">No featured treatments configured. Add one above.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- ============================================================== -->
<!-- MODALS FOR SLIDES & TREATMENTS                                  -->
<!-- ============================================================== -->

<!-- Add Slide Modal -->
<div class="modal fade" id="addSlideModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/homepage/slide/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Add Film Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Chapter Title <span class="text-danger">*</span></label>
                        <input type="text" name="chapter_title" class="form-control clean-input" required placeholder="e.g. Chapter I: The Architecture of Radiance">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Badge / Category</label>
                            <input type="text" name="badge_text" class="form-control clean-input" placeholder="e.g. Academy Sanctum">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Time Duration Text</label>
                            <input type="text" name="time_text" class="form-control clean-input" placeholder="00:02 / 00:08">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Image URL / Path</label>
                        <input type="text" name="image_url" class="form-control clean-input" placeholder="images/academy-tour.jpg or https://...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload Image File</label>
                        <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Display Order</label>
                            <input type="number" name="display_order" class="form-control clean-input" value="1" min="1">
                        </div>
                        <div class="col-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="addSlideActive" checked>
                                <label class="form-check-label fw-bold" for="addSlideActive" style="font-size: 12.5px;">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Save Slide</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Slide Modal -->
<div class="modal fade" id="editSlideModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/homepage/slide/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editSlideId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Film Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Chapter Title <span class="text-danger">*</span></label>
                        <input type="text" name="chapter_title" id="editSlideTitle" class="form-control clean-input" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Badge / Category</label>
                            <input type="text" name="badge_text" id="editSlideBadge" class="form-control clean-input">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Time Duration Text</label>
                            <input type="text" name="time_text" id="editSlideTime" class="form-control clean-input">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Image URL / Path</label>
                        <input type="text" name="image_url" id="editSlideImage" class="form-control clean-input">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload New Image File</label>
                        <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Display Order</label>
                            <input type="number" name="display_order" id="editSlideOrder" class="form-control clean-input" min="1">
                        </div>
                        <div class="col-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editSlideActive">
                                <label class="form-check-label fw-bold" for="editSlideActive" style="font-size: 12.5px;">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Update Slide</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Treatment Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/homepage/service/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Add Popular Treatment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Treatment Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control clean-input" required placeholder="e.g. Hydra Facial Ritual">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Category</label>
                            <input type="text" name="category" class="form-control clean-input" placeholder="e.g. Aesthetic Facial">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Price Tag</label>
                            <input type="text" name="price" class="form-control clean-input" placeholder="e.g. ₹3,500">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Duration</label>
                            <input type="text" name="duration" class="form-control clean-input" placeholder="e.g. 75 Minutes">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Description</label>
                        <textarea name="description" rows="2" class="form-control clean-textarea" placeholder="Brief treatment narrative..."></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Image URL / Path</label>
                            <input type="text" name="image_url" class="form-control clean-input" placeholder="https://...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload Image</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Button Text</label>
                            <input type="text" name="button_text" class="form-control clean-input" value="Book Now">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Button URL</label>
                            <input type="text" name="button_url" class="form-control clean-input" value="booking">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Display Order</label>
                            <input type="number" name="display_order" class="form-control clean-input" value="1" min="1">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="addSrvActive" checked>
                                <label class="form-check-label fw-bold" for="addSrvActive" style="font-size: 12.5px;">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Save Treatment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Treatment Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: 1px solid #ede6e4;">
            <form action="<?= base_url('admin/homepage/service/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="editSrvId">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; color: #483C46;">Edit Popular Treatment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Treatment Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="editSrvTitle" class="form-control clean-input" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Category</label>
                            <input type="text" name="category" id="editSrvCategory" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Price Tag</label>
                            <input type="text" name="price" id="editSrvPrice" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Duration</label>
                            <input type="text" name="duration" id="editSrvDuration" class="form-control clean-input">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="font-size: 12.5px;">Description</label>
                        <textarea name="description" id="editSrvDesc" rows="2" class="form-control clean-textarea"></textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Image URL / Path</label>
                            <input type="text" name="image_url" id="editSrvImage" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Or Upload Image</label>
                            <input type="file" name="image_file" class="form-control clean-input" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Button Text</label>
                            <input type="text" name="button_text" id="editSrvBtnText" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Button URL</label>
                            <input type="text" name="button_url" id="editSrvBtnUrl" class="form-control clean-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="font-size: 12.5px;">Display Order</label>
                            <input type="number" name="display_order" id="editSrvOrder" class="form-control clean-input" min="1">
                        </div>
                        <div class="col-md-6 d-flex align-items-center pt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editSrvActive">
                                <label class="form-check-label fw-bold" for="editSrvActive" style="font-size: 12.5px;">Active Status</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn-clean-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-clean-primary">Update Treatment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Preserve active tab across page reloads / hash navigation
    if (window.location.hash) {
        var hashTab = document.querySelector('button[data-bs-target="' + window.location.hash + '"]');
        if (hashTab) {
            new bootstrap.Tab(hashTab).show();
        }
    }

    // Modal data population for Slide Edit
    document.querySelectorAll('.edit-slide-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editSlideId').value = this.dataset.id;
            document.getElementById('editSlideTitle').value = this.dataset.title;
            document.getElementById('editSlideBadge').value = this.dataset.badge;
            document.getElementById('editSlideTime').value = this.dataset.time;
            document.getElementById('editSlideOrder').value = this.dataset.order;
            document.getElementById('editSlideImage').value = this.dataset.image;
            document.getElementById('editSlideActive').checked = this.dataset.active == '1';
        });
    });

    // Modal data population for Service Edit
    document.querySelectorAll('.edit-service-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('editSrvId').value = this.dataset.id;
            document.getElementById('editSrvTitle').value = this.dataset.title;
            document.getElementById('editSrvCategory').value = this.dataset.category;
            document.getElementById('editSrvPrice').value = this.dataset.price;
            document.getElementById('editSrvDuration').value = this.dataset.duration;
            document.getElementById('editSrvDesc').value = this.dataset.desc;
            document.getElementById('editSrvImage').value = this.dataset.image;
            document.getElementById('editSrvBtnText').value = this.dataset.btnText;
            document.getElementById('editSrvBtnUrl').value = this.dataset.btnUrl;
            document.getElementById('editSrvOrder').value = this.dataset.order;
            document.getElementById('editSrvActive').checked = this.dataset.active == '1';
        });
    });
});
</script>

<?= $this->endSection() ?>
