<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact &amp; Concierge | Glowup Beauty Studio &amp; Academy</title>
  <meta name="description"
    content="Reach the Glowup Studio and Academy concierge in Madurai for treatment appointments, course admissions, or bridal bookings." />

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
  <?= view('glowup/partials/navbar', ['activePage' => 'contact']) ?>

  <!-- ==================== PAGE HERO ==================== -->
  <section class="page-hero">
    <div class="container" style="max-width: 1420px;">
      <h1>Connect With Our Sanctuary</h1>
      <p>
        Whether you wish to schedule a private ritual, discuss academy enrollment, or plan an exclusive bridal journey,
        our concierge is at your service.
      </p>
      <div class="breadcrumb-custom">
        <a href="<?= base_url('/') ?>">Home</a>
        <span class="separator">/</span>
        <span style="color:#fff;">Contact Us</span>
      </div>
    </div>
  </section>

  <!-- ==================== CONTACT CARDS ==================== -->
  <section class="section-pad-sm bg-violet-soft border-bottom border-subtle">
    <div class="container" style="max-width: 1420px;">
      <div class="row g-4">

        <!-- Card 1 -->
        <div class="col-md-6 col-lg-3">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">location_on</span>
            </div>
            <h5>Flagship Sanctuary</h5>
            <p><?= nl2br(esc(business_contact()['concierge_address'] ?? '12 Madurai, Tamil Nadu, India')) ?><br /><span class="text-accent-2" style="font-size:11px;">Valet parking available</span></p>
          </div>
        </div>

        <!-- Card 2: Call Us -->
        <div class="col-md-6 col-lg-3">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">phone_in_talk</span>
            </div>
            <h5>Call Us</h5>
            <p>
              <a href="<?= business_phone_url() ?>" class="text-white text-decoration-none d-block fw-bold" aria-label="Call Concierge: <?= esc(business_phone()) ?>"><?= esc(business_phone()) ?></a>
              <span class="text-accent-2" style="font-size:11px;">Direct line dialer support</span>
            </p>
            <div class="mt-2">
              <a href="<?= business_phone_url() ?>" class="btn btn-sm btn-outline-light w-100 py-1" style="font-size:11px;" aria-label="Call Glowup Studio Concierge">
                <span class="material-symbols-outlined align-middle me-1" style="font-size:14px;">call</span> Call Now
              </a>
            </div>
          </div>
        </div>

        <!-- Card 3: WhatsApp Us -->
        <div class="col-md-6 col-lg-3">
          <div class="pillar">
            <div class="pillar-icon" style="background: rgba(37, 211, 102, 0.15); border-color: rgba(37, 211, 102, 0.35); color: #25D366;">
              <?= glowup_whatsapp_icon('', 24) ?>
            </div>
            <h5>WhatsApp Us</h5>
            <p>
              <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.') ?>" target="_blank" rel="noopener noreferrer" class="d-block fw-bold text-decoration-none" style="color: #a7f3d0;" aria-label="Chat with Glowup Studio on WhatsApp"><?= esc(business_whatsapp()) ?></a>
              <span class="text-accent-2" style="font-size:11px;">Official click-to-chat active</span>
            </p>
            <div class="mt-2">
              <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm w-100 py-1" style="background:#25D366;color:#ffffff;font-size:11px;font-weight:600;" aria-label="Chat with Glowup Studio on WhatsApp">
                <?= glowup_whatsapp_icon('', 14) ?> Chat on WhatsApp
              </a>
            </div>
          </div>
        </div>

        <!-- Card 4: Hours & Email -->
        <div class="col-md-6 col-lg-3">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">schedule</span>
            </div>
            <h5>Sanctuary Hours</h5>
            <p>
              <?= esc(business_contact()['concierge_hours'] ?? 'Tue – Sun: 10:00 AM – 8:00 PM') ?><br />
              <a href="mailto:<?= esc(business_contact()['concierge_email'] ?? 'glowup@gmail.com') ?>" class="text-accent-2 text-decoration-none" style="font-size:11px;"><?= esc(business_contact()['concierge_email'] ?? 'glowup@gmail.com') ?></a>
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== FORM & MAP SECTION ==================== -->
  <section class="section-pad">
    <div class="container" style="max-width: 1420px;">
      <div class="row g-5">

        <!-- Left: Interactive Message Form -->
        <div class="col-lg-7">
          <div class="booking-card">
            <span class="eyebrow mb-2">Direct Inquiry</span>
            <h3 class="text-white mb-3" style="font-family:'Playfair Display',serif;">Send Us A Message</h3>
            <p class="text-dim mb-4" style="font-size:14px;">Our concierge responds to all inquiries within 2 hours
              during operating hours.</p>

            <div id="contactAlert"></div>

            <form id="contactForm">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Full Name *</label>
                  <input type="text" class="form-control-violet" id="contactName" placeholder="e.g. Kavitha Selvan"
                    required />
                </div>

                <div class="col-md-6">
                  <label class="form-label">Phone / WhatsApp *</label>
                  <input type="tel" class="form-control-violet" id="contactPhone" placeholder="+91 98765 43210"
                    required />
                </div>

                <div class="col-md-6">
                  <label class="form-label">Email Address *</label>
                  <input type="email" class="form-control-violet" id="contactEmail" placeholder="kavitha@domain.com"
                    required />
                </div>

                <div class="col-md-6">
                  <label class="form-label">Nature of Inquiry *</label>
                  <select class="form-select-violet" id="contactSubject">
                    <option value="Treatment Reservation">Treatment Reservation &amp; Consultation</option>
                    <option value="Academy Admission">Academy Admission &amp; Course Fees</option>
                    <option value="Bridal Couture Booking">Haute Bridal Couture Package</option>
                    <option value="Corporate / Private Suite">Private Suite Exclusive Booking</option>
                    <option value="Press &amp; Collaborations">Press, Media &amp; Brand Partnership</option>
                  </select>
                </div>

                <div class="col-12">
                  <label class="form-label">Your Message or Questions *</label>
                  <textarea class="form-control-violet" id="contactMessage" rows="4"
                    placeholder="How may we assist your beauty journey or career aspirations?" required></textarea>
                </div>

                <div class="col-12 mt-4">
                  <button type="submit" class="btn btn-accent px-4 py-3">
                    <span class="material-symbols-outlined me-1">send</span>
                    Send Message to Concierge
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Right: Studio Visit & Location Card -->
        <div class="col-lg-5">
          <div class="booking-card h-100 d-flex flex-column justify-content-between">
            <div>
              <span class="eyebrow mb-2">Find Us</span>
              <h3 class="text-white mb-3" style="font-family:'Playfair Display',serif;">Madurai Sanctuary</h3>
              <p class="text-dim mb-4" style="font-size:14px;line-height:1.75;">
                Nestled on a serene avenue away from commercial traffic, our flagship studio &amp; academy offers
                secluded elegance and acoustic serenity.
              </p>

              <!-- Map Mockup / Visual Card -->
              <div class="position-relative mb-4"
                style="border-radius:14px;overflow:hidden;border:1px solid rgba(229,221,240,0.2);">
                <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=800&q=80"
                  alt="Glowup Studio Architectural Entrance" class="w-100" style="height:220px;object-fit:cover;" />
                <div class="position-absolute inset-0 d-flex align-items-center justify-content-center"
                  style="background:rgba(26,14,36,0.65);inset:0;">
                  <div class="text-center p-3">
                    <span class="material-symbols-outlined text-accent" style="font-size:36px;">pin_drop</span>
                    <h6 class="text-white mb-1">12 Madurai, Tamil Nadu</h6>
                    <small class="text-dim">Coordinates: 9.9252° N, 78.1198° E</small>
                  </div>
                </div>
              </div>

              <div class="p-3 mb-4"
                style="background:rgba(255,255,255,0.04);border-radius:10px;border:1px solid rgba(229,221,240,0.12);">
                <h6 class="text-accent mb-2" style="font-size:12px;letter-spacing:.12em;text-transform:uppercase;">
                  Arrival Etiquette</h6>
                <ul class="list-unstyled mb-0" style="font-size:12.5px;color:var(--text-soft);">
                  <li class="mb-1">• Please arrive 10-15 minutes prior for diagnostic intake.</li>
                  <li class="mb-1">• Valet parking attendants are stationed at the main archway.</li>
                  <li>• Quiet acoustic protocol is observed within all treatment suites.</li>
                </ul>
              </div>
            </div>

            <div>
              <a href="https://maps.google.com" target="_blank" rel="noopener noreferrer"
                class="btn btn-ghost w-100 mb-2">
                <span class="material-symbols-outlined me-1">directions</span>
                Open in Google Maps
              </a>
              <div class="row g-2">
                <div class="col-sm-6">
                  <a href="<?= business_phone_url() ?>" class="btn btn-violet w-100 d-flex align-items-center justify-content-center gap-1" aria-label="Call Studio Concierge: <?= esc(business_phone()) ?>" title="Call Studio Concierge">
                    <span class="material-symbols-outlined" style="font-size:17px;">call</span>
                    Call Us
                  </a>
                </div>
                <div class="col-sm-6">
                  <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.') ?>" target="_blank" rel="noopener noreferrer" class="btn w-100 d-flex align-items-center justify-content-center gap-1" style="background:#25D366;color:#ffffff;font-weight:600;" aria-label="Chat with Glowup Studio on WhatsApp" title="WhatsApp Us">
                    <?= glowup_whatsapp_icon('', 17) ?>
                    WhatsApp Us
                  </a>
                </div>
              </div>
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
        <span class="material-symbols-outlined" style="font-size:16px;">verified</span>
        Bespoke Service
      </div>
      <h2 class="section-title mb-3">We Look Forward to Welcoming You</h2>
      <p class="section-sub mx-auto mb-4">
        Experience the harmony of medical-grade clean therapies and architectural serenity.
      </p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="<?= base_url('booking') ?>" class="btn btn-accent">Reserve Online Now</a>
        <a href="<?= base_url('services') ?>" class="btn btn-ghost">View Treatment Folio</a>
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