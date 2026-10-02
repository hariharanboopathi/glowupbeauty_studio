<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gallery &amp; Portfolio | Glowup Beauty Studio &amp; Academy</title>
  <meta name="description"
    content="Explore our visual lookbook of bridal beauty, hair transformations, clinical hydra facials, and academy masterclasses." />

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
  <?= view('glowup/partials/navbar', ['activePage' => 'gallery']) ?>

  <!-- ==================== PAGE HERO ==================== -->
  <section class="page-hero">
    <div class="container" style="max-width: 1420px;">
      <h1>The Visual Gallery of Artistry</h1>
      <p>
        Immerse yourself in our living archive of bridal couture, transformative hair alchemy,
        dewy clinical skin resurfacing, and academy training sessions.
      </p>
      <div class="breadcrumb-custom">
        <a href="<?= base_url('/') ?>">Home</a>
        <span class="separator">/</span>
        <span style="color:#fff;">Gallery</span>
      </div>
    </div>
  </section>

  <!-- ==================== BEFORE & AFTER FEATURE ==================== -->
  <section class="section-pad-sm bg-violet-deep border-bottom border-subtle">
    <div class="container" style="max-width: 1100px;">
      <div class="text-center mb-4">
        <span class="eyebrow eyebrow-center mb-2">Signature Transformation</span>
        <h3 class="section-title mb-2" style="font-size:1.8rem;">Before &amp; After: Molecular Keratin Infusion</h3>
        <p class="text-dim" style="font-size:13.5px;">Hover or tap to witness how botanical peptides eliminate deep
          frizz and restore mirror luster.</p>
      </div>

      <div class="row g-4 align-items-center">
        <div class="col-md-6">
          <div class="position-relative"
            style="border-radius:16px;overflow:hidden;border:1px solid rgba(229,221,240,0.2);">
            <img src="https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=800&q=80"
              alt="Before Hair Transformation" class="w-100" style="height:320px;object-fit:cover;" />
            <div class="position-absolute"
              style="top:15px;left:15px;background:rgba(26,14,36,0.85);backdrop-filter:blur(6px);padding:.35rem .85rem;border-radius:6px;font-size:10px;letter-spacing:.15em;text-transform:uppercase;color:#ff9e9e;font-weight:700;">
              Before: Dehydrated &amp; Porous Frizz
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="position-relative"
            style="border-radius:16px;overflow:hidden;border:1px solid rgba(229,221,240,0.2);">
            <img src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?w=800&q=80"
              alt="After Hair Transformation" class="w-100" style="height:320px;object-fit:cover;" />
            <div class="position-absolute"
              style="top:15px;left:15px;background:rgba(26,14,36,0.85);backdrop-filter:blur(6px);padding:.35rem .85rem;border-radius:6px;font-size:10px;letter-spacing:.15em;text-transform:uppercase;color:var(--accent-2);font-weight:700;">
              After: 120-Min Keratin Ritual
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== GALLERY GRID WITH FILTER ==================== -->
  <section class="section-pad">
    <div class="container" style="max-width: 1420px;">

      <!-- Filter Buttons -->
      <div class="filter-nav mb-5">
        <button class="filter-btn active" data-filter="all">All Portfolios</button>
        <button class="filter-btn" data-filter="hair">Hair Alchemy</button>
        <button class="filter-btn" data-filter="bridal">Haute Bridal</button>
        <button class="filter-btn" data-filter="facials">Skin Radiance</button>
        <button class="filter-btn" data-filter="academy">Academy Masterclasses</button>
        <button class="filter-btn" data-filter="nails">Nails &amp; Lashes</button>
      </div>

      <!-- Gallery Items Grid -->
      <div class="row g-4" id="galleryGrid">
        <?php if (!empty($galleryItems) && count($galleryItems) > 0): ?>
          <?php foreach ($galleryItems as $gItem): ?>
            <?php 
              $tagNames = [
                'bridal'  => 'Haute Bridal',
                'hair'    => 'Hair Alchemy',
                'facials' => 'Skin Radiance',
                'academy' => 'Academy Masterclass',
                'nails'   => 'Nails & Lashes',
              ];
              $tagLabel = $tagNames[$gItem['category']] ?? ucfirst($gItem['category']);
              $imgSrc = $gItem['image_url'];
              if (!str_starts_with($imgSrc, 'http')) {
                $imgSrc = base_url($imgSrc);
              }
            ?>
            <div class="col-sm-6 col-lg-4" data-category="<?= esc($gItem['category']) ?>">
              <div class="gallery-item">
                <img src="<?= esc($imgSrc) ?>" alt="<?= esc($gItem['title']) ?>" onerror="this.src='https://images.unsplash.com/photo-1560066984-138dadb4c035?w=900&q=80'" />
                <div class="gallery-overlay">
                  <span class="gallery-tag"><?= esc($tagLabel) ?></span>
                  <h5 class="gallery-title"><?= esc($gItem['title']) ?></h5>
                  <p class="gallery-desc"><?= esc($gItem['description'] ?? 'Artisan haute couture finish.') ?></p>
                  <span class="badge" style="background:var(--accent);color:var(--bg-deep);width:fit-content;font-size:10px;">Click to Expand</span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- Static Fallbacks -->
          <div class="col-sm-6 col-lg-4" data-category="bridal">
            <div class="gallery-item">
              <img src="<?= base_url('images/slide-bridal.jpg') ?>" alt="Royal Heritage Bride" />
              <div class="gallery-overlay">
                <span class="gallery-tag">Haute Bridal</span>
                <h5 class="gallery-title">Royal Heritage Temple Bride</h5>
                <p class="gallery-desc">Traditional matte airbrush finish with gold temple jewelry and micro-jasmine braiding.</p>
                <span class="badge" style="background:var(--accent);color:var(--bg-deep);width:fit-content;font-size:10px;">Click to Expand</span>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4" data-category="hair">
            <div class="gallery-item">
              <img src="<?= base_url('images/slide-hair.jpg') ?>" alt="Japanese Straightening Gloss" />
              <div class="gallery-overlay">
                <span class="gallery-tag">Hair Alchemy</span>
                <h5 class="gallery-title">Japanese Sleek Thermal Gloss</h5>
                <p class="gallery-desc">Pin-straight mirror reconditioning on textured strands, maintaining organic bounce.</p>
                <span class="badge" style="background:var(--accent);color:var(--bg-deep);width:fit-content;font-size:10px;">Click to Expand</span>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4" data-category="facials">
            <div class="gallery-item">
              <img src="<?= base_url('images/slide-facial.jpg') ?>" alt="Glass Skin Hydra Resurfacing" />
              <div class="gallery-overlay">
                <span class="gallery-tag">Skin Radiance</span>
                <h5 class="gallery-title">Glass Skin Hydra Resurfacing</h5>
                <p class="gallery-desc">Immediate post-treatment dewy radiance achieved with peptide vortex infusion.</p>
                <span class="badge" style="background:var(--accent);color:var(--bg-deep);width:fit-content;font-size:10px;">Click to Expand</span>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==================== INSTAGRAM FEED STRIP ==================== -->
  <section class="section-pad-sm bg-violet-deep border-top border-subtle">
    <div class="container text-center" style="max-width: 900px;">
      <div class="d-inline-flex align-items-center gap-2 mb-3">
        <span class="material-symbols-outlined text-accent" style="font-size:24px;">photo_camera</span>
        <span
          style="font-size:11px;letter-spacing:.2em;text-transform:uppercase;color:var(--accent-2);font-weight:700;">
          Follow Our Story on Instagram
        </span>
      </div>
      <h3 class="section-title mb-2" style="font-size:1.8rem;">@GlowupStudioAcademy</h3>
      <p class="text-dim mb-4" style="font-size:14px;">Daily backstage glimpses, live student graduation reels, and
        patron transformations.</p>
      <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="btn btn-ghost">
        View Instagram Folio
        <span class="material-symbols-outlined ms-1" style="font-size:16px;">north_east</span>
      </a>
    </div>
  </section>

  <!-- ==================== CTA BANNER ==================== -->
  <section class="section-pad cta-section">
    <div class="container cta-content text-center" style="max-width: 900px;">
      <div class="cta-pill">
        <span class="material-symbols-outlined" style="font-size:16px;">auto_awesome</span>
        Craft Your Look
      </div>
      <h2 class="section-title mb-3">Inspired by What You See?</h2>
      <p class="section-sub mx-auto mb-4">
        Consult directly with our master stylists to customize any of these signature transformations for your event.
      </p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="<?= base_url('booking') ?>" class="btn btn-accent">Reserve Your Transformation</a>
        <a href="<?= base_url('contact') ?>" class="btn btn-ghost">Speak With A Stylist</a>
      </div>
    </div>
  </section>

  <!-- ==================== FOOTER ==================== -->
<?= view('glowup/partials/footer') ?>

  <!-- LIGHTBOX MODAL FOR GALLERY PREVIEW -->
  <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content"
        style="background:var(--bg-deep);border:1px solid rgba(229,221,240,0.25);border-radius:18px;overflow:hidden;">
        <div class="modal-header border-bottom border-subtle">
          <h5 class="modal-title text-white" id="lightboxTitle" style="font-family:'Playfair Display',serif;">Glowup
            Transformation</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0 text-center">
          <img src="" id="lightboxImg" alt="Enlarged Transformation"
            style="max-height:550px;width:100%;object-fit:contain;background:#1a0e24;" />
          <div class="p-4 text-start">
            <p id="lightboxDesc" class="text-soft mb-3" style="font-size:14px;"></p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="text-accent" style="font-size:12px;letter-spacing:.1em;text-transform:uppercase;">Glowup
                Studio &amp; Academy Portfolio</span>
              <a href="<?= base_url('booking') ?>" class="btn btn-accent btn-sm">Book This Look</a>
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