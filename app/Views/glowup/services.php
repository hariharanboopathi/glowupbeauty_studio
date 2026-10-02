<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Treatment Menu &amp; Services | Glowup Beauty Studio &amp; Academy</title>
  <meta name="description"
    content="Explore our complete treatment menu: Hydra facials, keratin hair alchemy, bridal couture, nail sculpting, and scalp wellness." />

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
  <?= view('glowup/partials/navbar', ['activePage' => 'services']) ?>

  <!-- ==================== PAGE HERO ==================== -->
  <section class="page-hero">
    <div class="container" style="max-width: 1420px;">
      <h1>Exquisite Rituals &amp; Therapies</h1>
      <p>
        Discover our signature clinical facials, transformative capillary chemistry,
        and haute bridal styling crafted to awaken your intrinsic radiance.
      </p>
      <div class="breadcrumb-custom">
        <a href="<?= base_url('/') ?>">Home</a>
        <span class="separator">/</span>
        <span style="color:#fff;">Services</span>
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

  <!-- ==================== SERVICES DIRECTORY WITH FILTER ==================== -->
  <section class="section-pad">
    <div class="container" style="max-width: 1420px;">

      <!-- Filter Buttons -->
      <div class="filter-nav mb-5">
        <button class="filter-btn active" data-filter="all">All Rituals</button>
        <?php if (!empty($categories)): ?>
          <?php foreach ($categories as $cat): ?>
            <?php
              $catSlug = is_array($cat) ? ($cat['slug'] ?? '') : $cat;
              $catName = is_array($cat) ? ($cat['category_name'] ?? $catSlug) : ucwords(str_replace(['_', '-'], ' ', $cat));
            ?>
            <button class="filter-btn" data-filter="<?= esc($catSlug) ?>"><?= esc($catName) ?></button>
          <?php endforeach; ?>
        <?php else: ?>
          <button class="filter-btn" data-filter="facials">Aesthetic Facials</button>
          <button class="filter-btn" data-filter="hair">Hair Alchemy</button>
          <button class="filter-btn" data-filter="bridal">Bridal Couture</button>
          <button class="filter-btn" data-filter="nails">Nails &amp; Lashes</button>
          <button class="filter-btn" data-filter="wellness">Scalp &amp; Wellness</button>
        <?php endif; ?>
      </div>

      <!-- Treatment Grid -->
            <div class="row g-4" id="servicesGrid">
        <?php if (!empty($services)): ?>
          <?php foreach ($services as $srv): ?>
            <?php
              $srvImg = (strpos($srv['image_url'], 'http') === 0) ? $srv['image_url'] : base_url($srv['image_url']);
              $btnUrl = (strpos($srv['button_url'], 'http') === 0) ? $srv['button_url'] : base_url($srv['button_url']);
              $rawCat = $srv['category'];
              $catDisplay = $categoryMap[$rawCat] ?? ($categoryMap[strtolower($rawCat)] ?? ucwords(str_replace(['_', '-'], ' ', $rawCat)));
            ?>
            <div class="col-md-6 col-lg-4" data-category="<?= esc($srv['category']) ?>">
              <div class="service-card">
                <div class="service-img">
                  <img src="<?= esc($srvImg) ?>" alt="<?= esc($srv['name']) ?>" onerror="this.src='https://placehold.co/800x600?text=Ritual'" />
                  <div class="price-tag">₹<?= number_format((float) $srv['price'], 0) ?></div>
                  <div class="category-tag"><?= esc($catDisplay) ?></div>
                </div>
                <div class="service-body">
                  <div>
                    <h5><?= esc($srv['name']) ?></h5>
                    <p><?= esc($srv['description']) ?></p>
                  </div>
                  <div class="service-footer d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <span class="duration"><span class="material-symbols-outlined" style="font-size:14px;">schedule</span> <?= esc($srv['duration']) ?></span>
                    <div class="d-flex align-items-center gap-2">
                      <a href="<?= business_whatsapp_url('Hello Glowup Studio, I am interested in ' . $srv['name'] . '. Please share more details.') ?>" 
                         target="_blank" 
                         rel="noopener noreferrer" 
                         class="btn-wa-enquire" 
                         aria-label="Enquire about <?= esc($srv['name']) ?> on WhatsApp" 
                         title="Enquire on WhatsApp">
                        <?= glowup_whatsapp_icon('', 14) ?>
                        <span>Enquire</span>
                      </a>
                      <a href="<?= esc($btnUrl) ?>" class="btn-book" data-service-name="<?= esc($srv['name']) ?>"><?= esc($srv['button_text'] ?? 'Book Now') ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

        <!-- Bespoke Trichology Diagnostics Tile -->
        <div class="col-md-6 col-lg-4" data-category="wellness">
          <div class="info-tile">
            <div>
              <div class="icon-badge mb-3">
                <span class="material-symbols-outlined" style="font-size:24px;">biotech</span>
              </div>
              <h5>Bespoke Trichology Diagnostics</h5>
              <p class="mt-2">
                Receive a 200x magnified scalp &amp; hair follicle evaluation with our senior specialist before selecting any chemical treatment.
              </p>
            </div>
            <div class="mt-4 d-flex gap-2">
              <a href="<?= base_url('booking') ?>" class="btn btn-accent flex-grow-1">
                Schedule Scan
              </a>
              <a href="<?= business_whatsapp_url('Hello Glowup Studio, I am interested in Bespoke Trichology Diagnostics. Please share more details.') ?>" target="_blank" rel="noopener noreferrer" class="btn-wa-enquire" title="Enquire on WhatsApp" aria-label="Enquire about Bespoke Trichology Diagnostics on WhatsApp">
                <?= glowup_whatsapp_icon('', 14) ?>
                <span>Enquire</span>
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- Note Disclaimer -->
      <div class="disclaimer mt-5">
        <span class="material-symbols-outlined"
          style="color:var(--accent-2);font-size:20px;font-variation-settings:'FILL' 1;">
          info
        </span>
        Note: Hair chemical services pricing depends on individual strand length, density, and prior porosity history.
      </div>

    </div>
  </section>

  <!-- ==================== THE 5-STEP RITUAL JOURNEY ==================== -->
  <section class="section-pad bg-violet-soft">
    <div class="container" style="max-width: 1420px;">
      <div class="text-center mb-5 mx-auto" style="max-width: 700px;">
        <span class="eyebrow eyebrow-center mb-3">The Protocol</span>
        <h2 class="section-title mb-3">The Glowup Diagnostic Protocol</h2>
        <p class="section-sub mx-auto">
          Every therapy follows a clinical five-step method ensuring safe, biologically radiant results.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-md">
          <div class="pillar text-center">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">01</div>
            <h5 style="font-size:1rem;">Micro-Scan</h5>
            <p style="font-size:12.5px;">Trichological and dermal high-magnification assessment.</p>
          </div>
        </div>
        <div class="col-md">
          <div class="pillar text-center">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">02</div>
            <h5 style="font-size:1rem;">Bespoke Blend</h5>
            <p style="font-size:12.5px;">Customized organic botanical peptides &amp; serums.</p>
          </div>
        </div>
        <div class="col-md">
          <div class="pillar text-center">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">03</div>
            <h5 style="font-size:1rem;">Acoustic Suite</h5>
            <p style="font-size:12.5px;">Therapy administered in soundproof private relaxation suites.</p>
          </div>
        </div>
        <div class="col-md">
          <div class="pillar text-center">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">04</div>
            <h5 style="font-size:1rem;">Molecular Seal</h5>
            <p style="font-size:12.5px;">Infrared or cryo sealing to lock in essential moisture.</p>
          </div>
        </div>
        <div class="col-md">
          <div class="pillar text-center">
            <div class="text-accent mb-2"
              style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;">05</div>
            <h5 style="font-size:1rem;">Home Regimen</h5>
            <p style="font-size:12.5px;">Personalized aftercare folio to preserve mirror shine.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== FAQ ACCORDION ==================== -->
  <section class="section-pad">
    <div class="container" style="max-width: 900px;">
      <div class="text-center mb-5">
        <span class="eyebrow eyebrow-center mb-3">Inquiries</span>
        <h2 class="section-title mb-3">Frequently Asked Questions</h2>
        <p class="section-sub mx-auto">
          Everything you need to know about our treatments, booking policy, and consultation.
        </p>
      </div>

      <div class="accordion faq-accordion" id="servicesFaq">

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
              What is the key difference between Keratin, Botox, and Cysteine?
            </button>
          </h2>
          <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#servicesFaq">
            <div class="accordion-body">
              Keratin focuses on eliminating frizz and sealing the outer cuticle layer with intense thermal smoothing.
              Hair Botox is an anti-aging, deep hydration filler with hyaluronic acid ideal for dry, bleached, or split
              ends. Cysteine is a 100% formaldehyde-free amino acid therapy that relaxes curl patterns while maintaining
              natural bounce.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
              Is the Hydra Facial suitable for sensitive or acne-prone skin?
            </button>
          </h2>
          <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#servicesFaq">
            <div class="accordion-body">
              Yes, our clinical Hydra Facial utilizes vacuum vortex extraction combined with customized soothing serums
              (centella asiatica, niacinamide, and hyaluronic acid) tailored explicitly for reactive or acne-prone
              complexions.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
              How early should I book for Bridal Couture services?
            </button>
          </h2>
          <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#servicesFaq">
            <div class="accordion-body">
              We recommend reserving your bridal date 2 to 4 months in advance. This allows us to plan your Pre-Bridal
              Radiance journey and schedule trial hair &amp; makeup consultations with Lead Couturier Priya Chandran.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
              Can I reschedule or cancel my appointment?
            </button>
          </h2>
          <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#servicesFaq">
            <div class="accordion-body">
              Yes, complimentary rescheduling is available up to 12 hours prior to your scheduled time slot by calling
              our academy concierge at <?= esc(business_phone()) ?>.
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== CTA BANNER ==================== -->
  <section class="section-pad cta-section">
    <div class="container cta-content text-center" style="max-width: 900px;">
      <div class="cta-pill">
        <span class="material-symbols-outlined" style="font-size:16px;">calendar_today</span>
        Direct Reservations
      </div>
      <h2 class="section-title mb-3">Immerse Yourself in Care</h2>
      <p class="section-sub mx-auto mb-4">
        Select your preferred ritual and time slot online, or contact our studio concierge for personalized assistance.
      </p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="<?= base_url('booking') ?>" class="btn btn-accent">Book Online Now</a>
        <a href="<?= business_phone_url() ?>" class="btn btn-ghost">
          <span class="material-symbols-outlined me-1" style="font-size:16px;">call</span>
          Call Concierge: <?= esc(business_phone()) ?>
        </a>
        <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-ghost d-flex align-items-center gap-2" style="border-color: rgba(37,211,102,0.4); color: #a7f3d0;" aria-label="Chat with Glowup Studio on WhatsApp">
          <?= glowup_whatsapp_icon('', 16) ?>
          <span>WhatsApp Us</span>
        </a>
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