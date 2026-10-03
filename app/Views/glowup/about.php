<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?= view('glowup/partials/seo_meta', [
      'pageKey'       => 'about',
      'fallbackTitle' => 'About Us | Glowup Beauty Studio & Academy',
      'fallbackDesc'  => 'Discover the story, vision, and master artists behind Glowup Beauty Studio & Academy in Madurai.',
  ]) ?>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts & Material Symbols (Unified Single Network Request + Non-blocking display:swap) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap"
    rel="stylesheet" />

  <!-- Main Unified CSS -->
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />
</head>

<body>

  <!-- ==================== NAVBAR ==================== -->
  <?= view('glowup/partials/navbar', ['activePage' => 'about']) ?>

  <!-- ==================== PAGE HERO ==================== -->
  <section class="page-hero">
    <div class="container" style="max-width: 1420px;">
      <h1><?= esc($settings['hero_title'] ?? 'The Art of Mindful Beauty') ?></h1>
      <p>
        <?= esc($settings['hero_subtitle'] ?? 'An architectural sanctuary founded to restore biological harmony, empower individual grace, and mentor future masters of the craft.') ?>
      </p>
      <div class="breadcrumb-custom">
        <a href="<?= base_url('/') ?>">Home</a>
        <span class="separator">/</span>
        <span style="color:#fff;">About Us</span>
      </div>
    </div>
  </section>

  <!-- ==================== STORY SECTION ==================== -->
  <section class="section-pad">
    <div class="container" style="max-width: 1420px;">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <span class="eyebrow mb-3"><?= esc($settings['genesis_eyebrow'] ?? 'The Genesis') ?></span>
          <h2 class="section-title mb-4"><?= esc($settings['genesis_title'] ?? 'Born From a Reverence For Stillness') ?></h2>
          <p style="color:var(--text-soft);font-size:16px;line-height:1.85;font-weight:300;">
            <?= esc($settings['genesis_copy1'] ?? 'Founded in the cultural heart of Madurai, Glowup was conceived not simply as a salon, but as a temple of rejuvenation where the frenzy of modern pace dissolve into calm luxury.') ?>
          </p>
          <p style="color:var(--text-dim);font-size:14px;line-height:1.85;">
            <?= esc($settings['genesis_copy2'] ?? 'We recognized that true beauty therapy transcends standard cosmetic procedures. It begins with microscopic scalp diagnosis, cellular hydration, non-toxic bio-actives, and deeply restorative touch. Every treatment in our studio is calibrated to enhance your unique structural elegance.') ?>
          </p>
          <div class="row mt-4 g-3">
            <div class="col-4 stat-block">
              <div class="num"><?= esc($settings['stat1_value'] ?? '7+') ?></div>
              <div class="lbl"><?= esc($settings['stat1_label'] ?? 'Years of Mastery') ?></div>
            </div>
            <div class="col-4 stat-block">
              <div class="num"><?= esc($settings['stat2_value'] ?? '15K+') ?></div>
              <div class="lbl"><?= esc($settings['stat2_label'] ?? 'Radiant Patrons') ?></div>
            </div>
            <div class="col-4 stat-block">
              <div class="num"><?= esc($settings['stat3_value'] ?? '850+') ?></div>
              <div class="lbl"><?= esc($settings['stat3_label'] ?? 'Certified Alumni') ?></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-flex justify-content-center">
          <div class="arch-frame" style="max-width: 480px;">
            <?php
              $storyPhoto = $settings['genesis_image'] ?? 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1000&q=80';
              if (strpos($storyPhoto, 'http') !== 0) {
                  $storyPhoto = base_url($storyPhoto);
              }
            ?>
            <img src="<?= esc($storyPhoto) ?>" alt="Glowup Studio Interior &amp; Artistry" onerror="this.src='https://placehold.co/800x1000?text=Sanctuary'" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== ARCHITECTURE & ATMOSPHERE ==================== -->
  <section class="section-pad bg-violet-soft">
    <div class="container" style="max-width: 1420px;">
      <div class="text-center mb-5 mx-auto" style="max-width: 720px;">
        <span class="eyebrow eyebrow-center mb-3">Spatial Design</span>
        <h2 class="section-title mb-3">Curated In Architectural Stillness</h2>
        <p class="section-sub mx-auto">
          Every curve, shadow, and sound in our studio has been deliberately curated to soothe the nervous system while
          delivering advanced clinical results.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">volume_off</span>
            </div>
            <h5>Acoustic Isolation Suites</h5>
            <p>Private, sound-damped treatment alcoves shielded from urban commotion, featuring low-frequency calming
              soundscapes calibrated at 432 Hz.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">air</span>
            </div>
            <h5>Medical-Grade Air Purity</h5>
            <p>HEPA-14 biological filtration and continuous micro-climate humidity control protect sensitive
              post-treatment skin and hair pores.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">eco</span>
            </div>
            <h5>Vegan &amp; Clean Formulations</h5>
            <p>Strict exclusion of harsh sulfates, parabens, and animal byproducts. Only ethically harvested botanical
              oils and certified peptides touch your skin.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== MASTER ARTISTS & FACULTY ==================== -->
  <section class="section-pad">
    <div class="container" style="max-width: 1420px;">
      <div class="row align-items-end mb-5 g-3">
        <div class="col-lg-8">
          <span class="eyebrow mb-3">World-Class Mentors</span>
          <h2 class="section-title mb-3">Meet Our Master Practitioners</h2>
          <p class="section-sub mb-0">
            Trained across Paris, Geneva, and Mumbai, our senior artisans and clinical directors bring uncompromising
            dedication to every silhouette.
          </p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <a href="<?= base_url('booking') ?>" class="btn btn-ghost">
            Request Senior Stylist
            <span class="material-symbols-outlined ms-1" style="font-size:16px;">arrow_forward</span>
          </a>
        </div>
      </div>

      <div class="row g-4">
        <?php if (!empty($team)): ?>
          <?php foreach ($team as $m): ?>
            <?php
              $photo = (strpos($m['image_url'], 'http') === 0) ? $m['image_url'] : base_url($m['image_url']);
            ?>
            <div class="col-sm-6 col-lg-3">
              <div class="team-card">
                <div class="team-avatar">
                  <img src="<?= esc($photo) ?>" alt="<?= esc($m['name']) ?>" onerror="this.src='https://placehold.co/400x500?text=Artist'" />
                </div>
                <h5><?= esc($m['name']) ?></h5>
                <div class="team-role"><?= esc($m['role']) ?></div>
                <p><?= esc($m['bio']) ?></p>
                <?php if (!empty($m['badge'])): ?>
                  <div class="d-flex justify-content-center gap-2">
                    <span class="badge" style="background:rgba(184,163,208,0.15);color:var(--accent-2);font-size:9px;letter-spacing:.1em;text-transform:uppercase;">
                      <?= esc($m['badge']) ?>
                    </span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12 text-center text-muted py-4">Faculty profiles updating soon.</div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==================== TIMELINE OF EXCELLENCE ==================== -->
  <section class="section-pad bg-violet-deep">
    <div class="container" style="max-width: 1100px;">
      <div class="text-center mb-5 mx-auto" style="max-width: 650px;">
        <span class="eyebrow eyebrow-center mb-3">Our Evolution</span>
        <h2 class="section-title mb-3">A Trajectory of Excellence</h2>
        <p class="section-sub mx-auto">From an intimate aesthetic suite to South India's acclaimed beauty academy.</p>
      </div>

      <div class="row g-4 position-relative">
        <div class="col-md-6 col-lg-3">
          <div class="p-4"
            style="background:rgba(255,255,255,0.04);border:1px solid rgba(229,221,240,0.15);border-radius:14px;height:100%;">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">2018</div>
            <h5 class="text-white mb-2" style="font-size:1.1rem;">Sanctuary Inception</h5>
            <p style="font-size:13px;color:var(--text-dim);line-height:1.7;">Founded our first private 3-chair
              diagnostic clinic in Madurai focused on trichological scalp recovery.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="p-4"
            style="background:rgba(255,255,255,0.04);border:1px solid rgba(229,221,240,0.15);border-radius:14px;height:100%;">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">2021</div>
            <h5 class="text-white mb-2" style="font-size:1.1rem;">Hair Alchemy Lab</h5>
            <p style="font-size:13px;color:var(--text-dim);line-height:1.7;">Introduced clean Japanese thermal
              reconditioning and organic caviar hair botox therapies.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="p-4"
            style="background:rgba(255,255,255,0.04);border:1px solid rgba(229,221,240,0.15);border-radius:14px;height:100%;">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">2023</div>
            <h5 class="text-white mb-2" style="font-size:1.1rem;">Academy Inauguration</h5>
            <p style="font-size:13px;color:var(--text-dim);line-height:1.7;">Expanded with state-of-the-art training
              lecture suites and live model clinical stations.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="p-4"
            style="background:rgba(255,255,255,0.04);border:1px solid rgba(229,221,240,0.15);border-radius:14px;height:100%;">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">2025</div>
            <h5 class="text-white mb-2" style="font-size:1.1rem;">Vogue Recognition</h5>
            <p style="font-size:13px;color:var(--text-dim);line-height:1.7;">Honored as Best Luxury Wellness Academy,
              expanding diplomas across international standards.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== CTA BANNER ==================== -->
  <section class="section-pad cta-section">
    <div class="container cta-content text-center" style="max-width: 900px;">
      <div class="cta-pill">
        <span class="material-symbols-outlined" style="font-size:16px;">explore</span>
        Experience the Sanctuary
      </div>
      <h2 class="section-title mb-3">Begin Your Transformation</h2>
      <p class="section-sub mx-auto mb-4">
        Whether seeking a transformative hair ritual or pursuing a prestigious career in beauty artistry,
        our doors in Madurai are open for you.
      </p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="<?= base_url('booking') ?>" class="btn btn-accent">Reserve Treatment</a>
        <a href="<?= base_url('academy') ?>" class="btn btn-ghost">Explore Academy</a>
      </div>
    </div>
  </section>

  <!-- ==================== FOOTER ==================== -->
<?= view('glowup/partials/footer') ?>



  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Main JS -->
  <script src="<?= base_url('js/main.js') ?>"></script>

</body>

</html>