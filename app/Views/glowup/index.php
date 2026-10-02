<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Glowup Beauty Studio &amp; Academy | Luxury Wellness &amp; Haircare</title>
    <meta name="description"
        content="Premium beauty treatments, clinical facials, and transformative hair alchemy curated within an architectural academy of stillness." />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet" />

    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />

    <!-- Main Unified CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />
</head>

<body>

    <!-- ==================== NAVBAR ==================== -->
    <?= view('glowup/partials/navbar', ['activePage' => 'home']) ?>

    <!-- ==================== HERO ==================== -->
    <section class="hero">
        <div class="container" style="max-width: 1420px;">
            <?php if (!empty($hero['meta']['pill_text'])): ?>
                <div class="mb-3">
                    <span class="eyebrow" style="background: rgba(163, 105, 82, 0.12); padding: 4px 14px; border-radius: 999px; font-size: 11px; letter-spacing: 0.12em; color: var(--accent);"><?= esc($hero['meta']['pill_text']) ?></span>
                </div>
            <?php endif; ?>

            <h1><?= !empty($hero['title']) ? $hero['title'] : 'Reveal Your<br />Natural Radiance' ?></h1>

            <p class="lead">
                <?= esc($hero['subtitle'] ?? 'Premium beauty treatments designed to help you look and feel your best, curated within an architectural Academy of stillness.') ?>
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
                <a href="<?= base_url($hero['meta']['primary_btn_url'] ?? 'booking') ?>" class="btn btn-violet">
                    <?= esc($hero['meta']['primary_btn_text'] ?? 'Book an Appointment') ?>
                </a>
                <a href="<?= base_url($hero['meta']['secondary_btn_url'] ?? 'services') ?>" class="btn btn-ghost">
                    <?= esc($hero['meta']['secondary_btn_text'] ?? 'Explore Services') ?>
                    <span class="material-symbols-outlined ms-1" style="font-size:16px;">arrow_forward</span>
                </a>
            </div>

            <!-- MULTI-IMAGE AUTO-SLIDESHOW (CYCLES EVERY 2 SECONDS) -->
            <div class="film-card" id="filmCardCarousel">
                <div class="film-slideshow" id="filmSlideshow">
                    <?php if (!empty($slides)): ?>
                        <?php foreach ($slides as $idx => $sld): ?>
                            <?php 
                                $sldImg = (strpos($sld['image_url'], 'http') === 0) ? $sld['image_url'] : base_url($sld['image_url']);
                            ?>
                            <div class="film-slide <?= $idx === 0 ? 'active' : '' ?>" 
                                data-chapter="<?= esc($sld['chapter_title']) ?>"
                                data-time="<?= esc($sld['time_text'] ?? '00:02 / 00:08') ?>" 
                                data-badge="<?= esc($sld['badge_text'] ?? 'Academy Sanctum') ?>">
                                <img src="<?= esc($sldImg) ?>" alt="<?= esc($sld['chapter_title']) ?>" />
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="film-slide active" data-chapter="Chapter I: The Architecture of Radiance"
                            data-time="00:02 / 00:08" data-badge="Academy Sanctum">
                            <img src="<?= base_url('images/academy-tour.jpg') ?>" alt="Chapter I: The Architecture of Radiance" />
                        </div>
                        <div class="film-slide" data-chapter="Chapter II: Clinical Glass-Skin Radiance"
                            data-time="00:04 / 00:08" data-badge="Aesthetic Facial">
                            <img src="<?= base_url('images/slide-facial.jpg') ?>" alt="Chapter II: Clinical Glass-Skin Radiance" />
                        </div>
                    <?php endif; ?>
                </div>

                <div class="film-overlay">
                    <div class="film-top">
                        <span class="film-badge"><span class="pulse"></span><span id="slideBadgeText"><?= esc($slides[0]['badge_text'] ?? 'Academy Sanctum') ?></span></span>
                        <div class="film-indicators" id="filmIndicators">
                            <?php $slideCount = !empty($slides) ? count($slides) : 2; ?>
                            <?php for ($i = 0; $i < $slideCount; $i++): ?>
                                <span class="film-indicator-dot <?= $i === 0 ? 'active' : '' ?>" data-slide-index="<?= $i ?>" title="Slide <?= $i + 1 ?>"></span>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div>
                        <div class="film-meta">
                            <span id="slideTime"><?= esc($slides[0]['time_text'] ?? '00:02 / 00:08') ?></span>
                            <span id="slideChapterTitle"><?= esc($slides[0]['chapter_title'] ?? 'Chapter I: The Architecture of Radiance') ?></span>
                        </div>
                        <div class="film-progress">
                            <div id="slideProgressBar" style="width: 25%; transition: width 0.5s ease;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    
    <?php if (!empty($offers) && count($offers) > 0): ?>
    <!-- ACTIVE PROMOTIONAL OFFERS STRIP -->
    <section class="py-4" style="background: linear-gradient(90deg, #1A0E26 0%, #301934 50%, #1A0E26 100%); border-top: 1px solid rgba(229, 221, 240, 0.15); border-bottom: 1px solid rgba(229, 221, 240, 0.15);">
        <div class="container" style="max-width: 1420px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined text-accent" style="font-size: 20px;">local_offer</span>
                    <strong class="text-white text-uppercase" style="letter-spacing: 0.1em; font-size: 13px;">Exclusive Privileges &amp; Limited Offers</strong>
                </div>
            </div>
            <div class="row g-3 justify-content-center">
                <?php foreach ($offers as $off): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="p-3 rounded-4 d-flex align-items-center justify-content-between gap-3 h-100" style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(163, 105, 82, 0.35);">
                            <div>
                                <span class="badge mb-1" style="background: rgba(163, 105, 82, 0.25); color: #ffcaa6; font-size: 11px;">
                                    <?= ($off['discount_type'] === 'percentage') ? ($off['discount_value'] . '% OFF') : ('₹' . number_format($off['discount_value']) . ' OFF') ?>
                                </span>
                                <h6 class="text-white mb-0 fw-bold" style="font-size: 13.5px;"><?= esc($off['title']) ?></h6>
                                <small class="text-dim" style="font-size: 11px;">Valid till <?= date('d M Y', strtotime($off['end_date'])) ?></small>
                            </div>
                            <div class="text-end">
                                <code class="text-accent fw-bold d-block mb-1" style="font-size: 13px; background: rgba(0,0,0,0.3); padding: 2px 6px; border-radius: 4px;"><?= esc($off['coupon_code']) ?></code>
                                <a href="<?= base_url('booking?service=' . urlencode($off['title'])) ?>" class="btn btn-sm btn-accent py-1 px-2" style="font-size: 11px;">Claim</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ==================== PHILOSOPHY ==================== -->
    <section class="section-pad bg-violet-soft" id="philosophy">
        <div class="container" style="max-width: 1420px;">
            <div class="row align-items-center g-5">

                <!-- Left -->
                <div class="col-lg-6">
                    <span class="eyebrow mb-3"><?= esc($philosophy['subtitle'] ?? 'The Glowup Philosophy') ?></span>
                    <h2 class="section-title mb-4"><?= esc($philosophy['title'] ?? 'Beauty, Care & Confidence') ?></h2>

                    <p style="color: var(--text-soft); font-size: 17px; font-weight: 300; line-height: 1.85;">
                        <?= esc($philosophy['content'] ?? 'Experience personalized beauty treatments delivered with care, expertise and attention to every detail. We believe self-renewal is an essential discipline, not an indulgence.') ?>
                    </p>
                    <p style="color: var(--text-dim); font-size: 14.5px; line-height: 1.85;">
                        <?= esc($philosophy['meta']['secondary_content'] ?? 'Step through arched colonnades sculpted in travertine and warm lavender limestone. Each visit begins with an intimate diagnostic consultation analyzing your hair porosity and dermis health before pairing with organic cold-pressed serums and clinically calibrated therapies.') ?>
                    </p>

                    <div class="row mt-4 g-3">
                        <div class="col-4 stat-block">
                            <div class="num"><?= esc($philosophy['meta']['stat1_value'] ?? '100%') ?></div>
                            <div class="lbl"><?= esc($philosophy['meta']['stat1_label'] ?? 'Bespoke Formulas') ?></div>
                        </div>
                        <div class="col-4 stat-block">
                            <div class="num"><?= esc($philosophy['meta']['stat2_value'] ?? '14+') ?></div>
                            <div class="lbl"><?= esc($philosophy['meta']['stat2_label'] ?? 'Master Artists') ?></div>
                        </div>
                        <div class="col-4 stat-block">
                            <div class="num"><?= esc($philosophy['meta']['stat3_value'] ?? '4.98') ?></div>
                            <div class="lbl"><?= esc($philosophy['meta']['stat3_label'] ?? 'Academy Score') ?></div>
                        </div>
                    </div>

                    <div class="mt-4 pt-2">
                        <a href="<?= base_url($philosophy['meta']['btn_url'] ?? 'about') ?>" class="btn btn-ghost">
                            <?= esc($philosophy['meta']['btn_text'] ?? 'Discover Our Story') ?>
                            <span class="material-symbols-outlined ms-1" style="font-size:16px;">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Right -->
                <div class="col-lg-6 d-flex justify-content-center justify-content-lg-end position-relative">
                    <div class="position-relative" style="max-width: 460px; width: 100%;">
                        <div class="arch-frame">
                            <?php
                                $storyImg = $philosophy['meta']['image_url'] ?? 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=900&q=80';
                                if (strpos($storyImg, 'http') !== 0) {
                                    $storyImg = base_url($storyImg);
                                }
                            ?>
                            <img src="<?= esc($storyImg) ?>" alt="Glowup Academy Sanctuary" />
                        </div>

                        <!-- Award badge -->
                        <div class="award-badge position-absolute d-flex align-items-start gap-3"
                            style="bottom: -1rem; left: -1rem;">
                            <div class="award-icon">
                                <span class="material-symbols-outlined"
                                    style="font-size:20px;font-variation-settings:'FILL' 1;">
                                    workspace_premium
                                </span>
                            </div>
                            <div>
                                <div
                                    style="font-size:9px;letter-spacing:0.16em;text-transform:uppercase;color:var(--accent);font-weight:700;">
                                    <?= esc($philosophy['meta']['award_title'] ?? 'Vogue Wellness') ?>
                                </div>
                                <div style="font-size:12.5px;color:#fff;line-height:1.35;margin-top:2px;">
                                    <?= esc($philosophy['meta']['award_desc'] ?? 'Best Luxury Wellness Academy 2024') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==================== SERVICES ==================== -->
    <section class="section-pad" id="services">
        <div class="container" style="max-width: 1420px;">

            <!-- Header -->
            <div class="row align-items-end mb-5 g-3">
                <div class="col-lg-8">
                    <span class="eyebrow mb-3">Exquisite Craftsmanship</span>
                    <h2 class="section-title mb-3">Our Popular Treatments</h2>
                    <p class="section-sub mb-0">
                        Signature clinical facials and transformative hair alchemy tailored to your individual silhouette.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="<?= base_url('services') ?>" class="text-decoration-none d-inline-flex align-items-center gap-2"
                        style="font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#fff;font-weight:600;border-bottom:1px solid var(--accent);padding-bottom:4px;">
                        View Full Ritual Folio
                        <span class="material-symbols-outlined"
                            style="font-size:16px;color:var(--accent);">north_east</span>
                    </a>
                </div>
            </div>

            <!-- Cards -->
            <div class="row g-4">
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $srv): ?>
                        <?php
                            $sImg = (strpos($srv['image_url'], 'http') === 0) ? $srv['image_url'] : base_url($srv['image_url']);
                            $sBtnUrl = (strpos($srv['button_url'], 'http') === 0) ? $srv['button_url'] : base_url($srv['button_url']);
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="service-card">
                                <div class="service-img">
                                    <img src="<?= esc($sImg) ?>" alt="<?= esc($srv['title']) ?>" onerror="this.src='https://placehold.co/600x400?text=Ritual'" />
                                    <div class="price-tag"><?= esc($srv['price']) ?></div>
                                    <div class="category-tag"><?= esc($srv['category'] ?? 'Treatment') ?></div>
                                </div>
                                <div class="service-body">
                                    <div>
                                        <h5><?= esc($srv['title']) ?></h5>
                                        <p><?= esc($srv['description']) ?></p>
                                    </div>
                                    <div class="service-footer">
                                        <span class="duration"><span class="material-symbols-outlined" style="font-size:14px;">schedule</span> <?= esc($srv['duration']) ?></span>
                                        <a href="<?= esc($sBtnUrl) ?>" class="btn-book" data-service-name="<?= esc($srv['title']) ?>"><?= esc($srv['button_text'] ?? 'Book Now') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center text-muted py-5">
                        <p>No featured treatments available at the moment.</p>
                    </div>
                <?php endif; ?>

                <!-- Complimentary Consultation Info Tile -->
                <div class="col-md-6 col-lg-4">
                    <div class="info-tile">
                        <div>
                            <div class="icon-badge mb-3">
                                <span class="material-symbols-outlined" style="font-size:22px;">auto_awesome</span>
                            </div>
                            <h5>Custom Ritual Formulation</h5>
                            <p class="mt-2">
                                Unsure which hair or aesthetic therapy fits your texture? Schedule an in-person capillary
                                microscope scan with our senior master stylist.
                            </p>
                        </div>
                        <div class="mt-4">
                            <a href="<?= business_phone_url() ?>"
                                class="text-decoration-none d-inline-flex align-items-center gap-2"
                                style="font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--accent-2);font-weight:700;"
                                aria-label="Call Concierge for complimentary consultation">
                                Complimentary Consultation
                                <span class="material-symbols-outlined" style="font-size:16px;">call</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>    </div>

            <!-- Disclaimer -->
            <div class="disclaimer">
                <span class="material-symbols-outlined"
                    style="color:var(--accent-2);font-size:20px;font-variation-settings:'FILL' 1;">
                    info
                </span>
                Note: Price varies based on hair length and natural density.
            </div>

        </div>
    </section>

    <!-- ==================== ACADEMY TEASER ==================== -->
    <section class="section-pad bg-violet-deep position-relative">
        <div class="container" style="max-width: 1420px;">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <span class="eyebrow mb-3">Professional Education</span>
                    <h2 class="section-title mb-4">Glowup Academy of Beauty Arts</h2>
                    <p style="color: var(--text-soft); font-size: 16px; font-weight: 300; line-height: 1.8;">
                        Step into a prestigious training sanctuary where European clinical beauty meets Indian bridal
                        mastery.
                        We offer diploma courses, hands-on masterclasses, and international certifications for aspiring
                        artists.
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex align-items-center gap-2 mb-2" style="font-size:14px;color:var(--text-soft);">
                            <span class="material-symbols-outlined text-accent"
                                style="font-size:18px;">check_circle</span>
                            Accredited Diplomas in Bridal Artistry &amp; Clinical Cosmetology
                        </li>
                        <li class="d-flex align-items-center gap-2 mb-2" style="font-size:14px;color:var(--text-soft);">
                            <span class="material-symbols-outlined text-accent"
                                style="font-size:18px;">check_circle</span>
                            Hands-on practical training on live models with luxury kits
                        </li>
                        <li class="d-flex align-items-center gap-2 mb-2" style="font-size:14px;color:var(--text-soft);">
                            <span class="material-symbols-outlined text-accent"
                                style="font-size:18px;">check_circle</span>
                            100% Placement assistance &amp; Studio internship opportunities
                        </li>
                    </ul>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?= base_url('academy') ?>" class="btn btn-accent">Explore Academy Courses</a>
                        <a href="<?= base_url('contact') ?>" class="btn btn-ghost">Inquire Admission</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="position-relative">
                        <div
                            style="border-radius:20px;overflow:hidden;border:1px solid rgba(229,221,240,0.2);box-shadow:0 25px 60px rgba(0,0,0,0.4);">
                            <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1000&q=80"
                                alt="Glowup Academy Students in Session" class="w-100"
                                style="object-fit:cover;height:380px;" />
                        </div>
                        <div class="position-absolute"
                            style="top:20px;right:20px;background:rgba(26,14,36,0.85);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.15);padding:.5rem 1rem;border-radius:999px;font-size:10px;letter-spacing:.15em;text-transform:uppercase;color:var(--accent-2);font-weight:700;">
                            Admissions Open 2025
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== WHY CHOOSE US ==================== -->
    <section class="section-pad bg-violet-soft">
        <div class="container" style="max-width: 1420px;">

            <div class="text-center mb-5 mx-auto" style="max-width: 700px;">
                <span class="eyebrow eyebrow-center mb-3">The Academy Standard</span>
                <h2 class="section-title mb-3">The Art of Bespoke Pampering</h2>
                <p class="section-sub mx-auto">
                    Every touchpoint in Glowup is engineered around silence, biological purity, and peerless technical
                    mastery.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-3">
                    <div class="pillar">
                        <div class="pillar-icon">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">verified_user</span>
                        </div>
                        <h5>Experienced Professionals</h5>
                        <p>Master stylists and certified clinical aestheticians holding European certifications and
                            ongoing academy training.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pillar">
                        <div class="pillar-icon">
                            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">spa</span>
                        </div>
                        <h5>Premium Products</h5>
                        <p>Exclusively formulated with certified organic, cruelty-free, and dermatologically tested
                            botanical elixirs and clean actives.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pillar">
                        <div class="pillar-icon">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">tune</span>
                        </div>
                        <h5>Personalized Care</h5>
                        <p>Comprehensive diagnostic scalp and skin analysis before every therapy session to formulate
                            tailored restorative blends.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pillar">
                        <div class="pillar-icon">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;">sanitizer</span>
                        </div>
                        <h5>Hygienic &amp; Serene</h5>
                        <p>Hospital-grade sterile protocols, private soundproof treatment suites, and calming custom
                            aromatherapeutic infusions.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==================== TESTIMONIALS ==================== -->
    <section class="section-pad">
        <div class="container" style="max-width: 1420px;">
            <div class="text-center mb-5 mx-auto" style="max-width: 700px;">
                <span class="eyebrow eyebrow-center mb-3">Patron Stories</span>
                <h2 class="section-title mb-3">Voices of Radiance</h2>
                <p class="section-sub mx-auto">
                    Read genuine reflections from patrons who have embraced the transformative Glowup ritual.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card p-4" style="height:100%;">
                        <div class="d-flex text-accent mb-3">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                        </div>
                        <p style="font-size:14px;color:var(--text-soft);font-style:italic;line-height:1.8;">
                            "The Hydra Facial Ritual at Glowup gave my skin a dewy glass glow I hadn't seen in years.
                            The private treatment suite felt like a sanctuary in the heart of Madurai."
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top border-subtle">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:var(--accent);color:var(--bg-deep);display:flex;align-items:center;justify-content:center;font-weight:700;">
                                SP
                            </div>
                            <div>
                                <h6 class="mb-0 text-white" style="font-size:14px;">Sneha Parthiban</h6>
                                <small class="text-dim" style="font-size:11px;">Bridal Client • Madurai</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service-card p-4" style="height:100%;">
                        <div class="d-flex text-accent mb-3">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                        </div>
                        <p style="font-size:14px;color:var(--text-soft);font-style:italic;line-height:1.8;">
                            "My frizzy curly hair was completely restored by their Keratin Infusion treatment. 3 months
                            later, it still feels weightless and silky soft. The master stylists are unmatched."
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top border-subtle">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:var(--accent);color:var(--bg-deep);display:flex;align-items:center;justify-content:center;font-weight:700;">
                                RM
                            </div>
                            <div>
                                <h6 class="mb-0 text-white" style="font-size:14px;">Rohini Mukherjee</h6>
                                <small class="text-dim" style="font-size:11px;">Fashion Architect</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service-card p-4" style="height:100%;">
                        <div class="d-flex text-accent mb-3">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings:'FILL' 1;font-size:20px;">star</span>
                        </div>
                        <p style="font-size:14px;color:var(--text-soft);font-style:italic;line-height:1.8;">
                            "Enrolling in the Glowup Bridal Artistry Diploma changed my career. The live-model practice
                            and continuous mentorship gave me the confidence to launch my own bridal studio."
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top border-subtle">
                            <div
                                style="width:42px;height:42px;border-radius:50%;background:var(--accent);color:var(--bg-deep);display:flex;align-items:center;justify-content:center;font-weight:700;">
                                AK
                            </div>
                            <div>
                                <h6 class="mb-0 text-white" style="font-size:14px;">Ananya Karthik</h6>
                                <small class="text-dim" style="font-size:11px;">Academy Graduate '24</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CTA / BOOKING ==================== -->
    <section class="section-pad cta-section" id="booking">
        <div class="container cta-content text-center" style="max-width: 900px;">

            <div class="cta-pill">
                <span class="material-symbols-outlined" style="font-size:16px;">calendar_today</span>
                Appointments &amp; Consultations
            </div>

            <h2 class="section-title mb-3" style="font-size: clamp(2rem, 5vw, 3.2rem);">
                Ready to Feel Your Best?
            </h2>

            <p class="section-sub mx-auto mb-4" style="font-size: 16px;">
                Book your appointment and give yourself the care you deserve. Reserved time slots ensure total
                privacy and uninterrupted practitioner dedication.
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                <a href="<?= base_url('booking') ?>" class="btn btn-accent">
                    <span class="material-symbols-outlined me-2" style="font-size:18px;">calendar_month</span>
                    Book an Appointment
                </a>
                <a href="<?= business_phone_url() ?>" class="btn btn-ghost" aria-label="Call Concierge: <?= esc(business_phone()) ?>" title="Call Concierge">
                    <span class="material-symbols-outlined me-2"
                        style="font-size:18px;color:var(--accent-2);">support_agent</span>
                    Concierge: <?= esc(business_phone()) ?>
                </a>
                <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-ghost d-flex align-items-center gap-2" style="border-color: rgba(37,211,102,0.4); color: #a7f3d0;" aria-label="Chat with Glowup Studio on WhatsApp" title="WhatsApp Concierge">
                    <?= glowup_whatsapp_icon('', 18) ?>
                    <span>Chat on WhatsApp</span>
                </a>
            </div>

            <div class="trust-badges">
                <span><span class="material-symbols-outlined">check_circle</span>Instant Confirmation</span>
                <span><span class="material-symbols-outlined">check_circle</span>Free 15-Min Consultation</span>
                <span><span class="material-symbols-outlined">check_circle</span>Flexible Rescheduling</span>
            </div>

        </div>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <?= view('glowup/partials/footer') ?>

    <!-- FILM PREVIEW MODAL -->
    <div class="modal fade" id="filmModal" tabindex="-1" aria-labelledby="filmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content"
                style="background:var(--bg-deep);border:1px solid rgba(229,221,240,0.25);border-radius:18px;overflow:hidden;">
                <div class="modal-header border-bottom border-subtle">
                    <h5 class="modal-title text-white" id="filmModalLabel"
                        style="font-family:'Playfair Display',serif;">Glowup Academy • Virtual Tour Preview</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <img src="<?= base_url('images/academy-tour.jpg') ?>" alt="Academy Tour Preview" style="object-fit:cover;" />
                        <div class="d-flex align-items-center justify-content-center"
                            style="background:rgba(26,14,36,0.6);">
                            <div class="text-center p-4">
                                <span class="material-symbols-outlined text-accent" style="font-size:54px;">movie</span>
                                <h5 class="mt-2 text-white">4K Cinematic Tour Ready</h5>
                                <p class="text-dim mb-3" style="font-size:13px;">Experience the serenity of our
                                    soundproof treatment suites &amp; training colonnades.</p>
                                <a href="<?= base_url('booking') ?>" class="btn btn-accent">Reserve a Private Tour &amp;
                                    Consultation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Main JS -->
    <script src="<?= base_url('js/main.js') ?>"></script>

</body>

</html>