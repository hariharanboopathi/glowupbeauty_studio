<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Online Appointment Booking | Glowup Beauty Studio &amp; Academy</title>
  <meta name="description"
    content="Reserve your bespoke beauty treatment, trichology diagnosis, or bridal consultation with our master artists in Madurai." />

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
  <style>
    /* ========== LUXURY TOAST NOTIFICATIONS ========== */
    .toast-container {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 12px;
        max-width: 420px;
        width: calc(100% - 48px);
        pointer-events: none;
    }

    .toast-item {
        pointer-events: auto;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px 18px 18px;
        background: rgba(26, 14, 38, 0.94);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 16px;
        box-shadow: 0 24px 50px rgba(0, 0, 0, 0.65), 0 0 25px rgba(0, 0, 0, 0.35);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        transform: translateX(125%);
        opacity: 0;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
    }

    .toast-item.show {
        transform: translateX(0);
        opacity: 1;
    }

    .toast-item.hide {
        transform: translateX(125%);
        opacity: 0;
    }

    .toast-error {
        border-color: rgba(244, 63, 94, 0.55);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6), 0 0 30px rgba(244, 63, 94, 0.3);
    }

    .toast-error .toast-icon-box {
        color: #fb7185;
        background: rgba(244, 63, 94, 0.18);
        border: 1px solid rgba(244, 63, 94, 0.3);
    }

    .toast-success {
        border-color: rgba(16, 185, 129, 0.55);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6), 0 0 30px rgba(16, 185, 129, 0.3);
    }

    .toast-success .toast-icon-box {
        color: #34d399;
        background: rgba(16, 185, 129, 0.18);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .toast-icon-box {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .toast-icon-box .material-symbols-outlined {
        font-size: 22px;
        color: inherit !important;
    }

    .toast-body {
        flex-grow: 1;
        padding-top: 1px;
    }

    .toast-title {
        font-size: 13.5px;
        font-weight: 700;
        letter-spacing: 0.02em;
        color: #ffffff;
        margin-bottom: 3px;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    .toast-message {
        font-size: 12.5px;
        color: #e5d7f5;
        line-height: 1.45;
        margin: 0;
    }

    .toast-close-btn {
        background: none;
        border: none;
        color: #c8b3e0 !important;
        cursor: pointer;
        padding: 2px;
        margin-left: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: color 0.2s, background 0.2s;
    }

    .toast-close-btn:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.12);
    }

    .toast-close-btn .material-symbols-outlined {
        font-size: 18px;
        color: inherit !important;
    }

    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
    }

    .toast-progress-bar {
        height: 100%;
        width: 100%;
        animation: toastCountdown 5s linear forwards;
    }

    .toast-error .toast-progress-bar {
        background: linear-gradient(90deg, #f43f5e, #fb7185);
    }

    .toast-success .toast-progress-bar {
        background: linear-gradient(90deg, #10b981, #34d399);
    }

    @keyframes toastCountdown {
        from { width: 100%; }
        to { width: 0%; }
    }
  </style>
</head>

<body>

  <!-- LUXURY TOAST CONTAINER -->
  <div class="toast-container" id="toastContainer" aria-live="polite"></div>

  <!-- ==================== NAVBAR ==================== -->
  <?= view('glowup/partials/navbar', ['activePage' => 'booking']) ?>

  <!-- ==================== PAGE HERO ==================== -->
  <section class="page-hero">
    <div class="container" style="max-width: 1420px;">
      <h1>Reserve Your Treatment</h1>
      <p>
        Select your desired therapy, specify your preferred practitioner, and choose an undisturbed time slot in our
        architectural suites.
      </p>
      <div class="breadcrumb-custom">
        <a href="<?= base_url('/') ?>">Home</a>
        <span class="separator">/</span>
        <span style="color:#fff;">Book Appointment</span>
      </div>
    </div>
  </section>

  <!-- ==================== BOOKING WIZARD INTERFACE ==================== -->
  <section class="section-pad">
    <div class="container" style="max-width: 1200px;">
      <div class="row g-5">

        <!-- Left Column: Interactive Wizard Steps -->
        <div class="col-lg-8">
          <div class="booking-card">

            <!-- Wizard Step Markers -->
            <div class="wizard-steps">
              <div class="step-item active" data-step-indicator="1">
                <div class="step-circle">1</div>
                <div class="step-title">Choose Service</div>
              </div>
              <div class="step-item" data-step-indicator="2">
                <div class="step-circle">2</div>
                <div class="step-title">Date &amp; Time</div>
              </div>
              <div class="step-item" data-step-indicator="3">
                <div class="step-circle">3</div>
                <div class="step-title">Your Details</div>
              </div>
            </div>

            <form id="bookingWizardForm">

              <!-- STEP 1: SELECT RITUAL -->
              <div class="step-pane" data-step="1">
                <h4 class="mb-3 text-white">Choose Your Service</h4>
                <p class="text-dim mb-4" style="font-size:13.5px;">Click any card to select. Price adjusts based on
                  strand length during consultation.</p>

                                <div class="row g-3">
                  <?php if (!empty($services)): ?>
                    <?php foreach ($services as $idx => $s): ?>
                      <div class="col-md-6">
                        <div class="service-radio-card <?= ($idx === 0) ? 'selected' : '' ?>"
                          data-service-id="<?= esc($s['id']) ?>"
                          data-service-name="<?= esc($s['name']) ?>"
                          data-service-price="<?= esc($s['price']) ?>"
                          data-service-duration="<?= esc($s['duration'] ?? '60 Min') ?>">
                          <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="text-white mb-0" style="font-family:'Playfair Display',serif;font-size:1.15rem;">
                              <?= esc($s['name']) ?>
                            </h6>
                            <span class="text-accent fw-bold">₹<?= number_format((float) $s['price']) ?></span>
                          </div>
                          <p class="text-dim mb-2" style="font-size:12.5px;line-height:1.5;">
                            <?= esc($s['description'] ?: 'Indulgent bespoke beauty ritual tailored by our master specialists.') ?>
                          </p>
                          <small class="text-accent-2" style="font-size:11px;">Duration: <?= esc($s['duration'] ?? '60 Minutes') ?></small>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="col-12 text-center py-4 text-dim">
                      <p>No active services found at this time. Please contact our concierge desk.</p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

                  <!-- STEP 2: TIME & SPECIALIST -->
              <div class="step-pane" data-step="2" style="display:none;">
                <h4 class="mb-3 text-white">Preferred Date &amp; Time</h4>
                <p class="text-dim mb-4" style="font-size:13.5px;">Reserved slots guarantee private attention in your
                  acoustic treatment suite.</p>

                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label">Preferred Specialist</label>
                    <select class="form-select-violet" id="artistSelect">
                      <option value="Any Master Specialist">Any Master Specialist (Fastest Available)</option>
                      <option value="Dr. Elena Ross (Clinical Director)">Dr. Elena Ross (Clinical Director)</option>
                      <option value="Maya Sundaram (Master Trichologist)">Maya Sundaram (Master Trichologist)</option>
                      <option value="Aarav Mehta (Creative Hair Director)">Aarav Mehta (Creative Hair Director)</option>
                      <option value="Priya Chandran (Lead Bridal Couturier)">Priya Chandran (Lead Bridal Couturier)
                      </option>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Preferred Date *</label>
                    <input type="date" class="form-control-violet" id="bookingDate" />
                  </div>

                  <div class="col-12">
                    <label class="form-label">Preferred Time *</label>
                    <div class="row g-2">
                      <div class="col-6 col-sm-4 col-md-3">
                        <div class="slot-pill">10:00 AM</div>
                      </div>
                      <div class="col-6 col-sm-4 col-md-3">
                        <div class="slot-pill selected">11:00 AM</div>
                      </div>
                      <div class="col-6 col-sm-4 col-md-3">
                        <div class="slot-pill">12:30 PM</div>
                      </div>
                      <div class="col-6 col-sm-4 col-md-3">
                        <div class="slot-pill">02:00 PM</div>
                      </div>
                      <div class="col-6 col-sm-4 col-md-3">
                        <div class="slot-pill">03:30 PM</div>
                      </div>
                      <div class="col-6 col-sm-4 col-md-3">
                        <div class="slot-pill">05:00 PM</div>
                      </div>
                      <div class="col-6 col-sm-4 col-md-3">
                        <div class="slot-pill">06:30 PM</div>
                      </div>
                      <div class="col-6 col-sm-4 col-md-3">
                        <div class="slot-pill">07:30 PM</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- STEP 3: PATRON DETAILS -->
              <div class="step-pane" data-step="3" style="display:none;">
                <h4 class="mb-3 text-white">Your Details</h4>
                <p class="text-dim mb-4" style="font-size:13.5px;">Your details are protected under our private medical
                  confidentiality protocol.</p>

                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-control-violet" id="clientName" value="<?= esc($customer['name'] ?? '') ?>" placeholder="e.g. Shalini Ramesh"
                      required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Mobile / WhatsApp *</label>
                    <input type="tel" class="form-control-violet" id="clientPhone" value="<?= esc($customer['phone'] ?? '') ?>" placeholder="+91 98765 43210"
                      required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email Address (For Confirmation &amp; Invoice)</label>
                    <input type="email" class="form-control-violet" id="clientEmail" value="<?= esc($customer['email'] ?? '') ?>"
                      placeholder="shalini@example.com" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Complimentary Suite Beverage</label>
                    <select class="form-select-violet" id="clientBeverage">
                      <option value="Organic Matcha Latte">Organic Japanese Matcha Latte</option>
                      <option value="Lavender Chamomile Infusion">Lavender &amp; Chamomile Herbal Infusion</option>
                      <option value="Single-Origin Espresso">Artisanal Single-Origin Espresso</option>
                      <option value="Citrus Sparkling Water">Chilled Citrus Sparkling Water</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Any Special Requests or Preferences?</label>
                    <textarea class="form-control-violet" id="clientNotes" rows="3"
                      placeholder="Mention any sensitivities, occasion details, stylist preferences, or questions..."></textarea>
                  </div>
                </div>
              </div>

              <!-- Wizard Navigation Buttons -->
              <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top border-subtle">
                <button type="button" class="btn btn-ghost" id="btnPrevStep" style="display:none;">
                  <span class="material-symbols-outlined me-1">arrow_back</span> Back
                </button>
                <div class="ms-auto">
                  <button type="button" class="btn btn-violet" id="btnNextStep">
                    Continue <span class="material-symbols-outlined ms-1">arrow_forward</span>
                  </button>
                </div>
              </div>

            </form>
          </div>
        </div>

        <!-- Right Column: Live Summary Card -->
        <div class="col-lg-4">
          <div class="booking-card" style="position:sticky;top:100px;">
            <h5 class="text-white mb-3" style="font-family:'Playfair Display',serif;">Reservation Summary</h5>

            <div class="py-3 border-bottom border-subtle">
              <span class="eyebrow" style="font-size:9.5px;">Selected Ritual</span>
              <h6 class="text-white mt-1 mb-0" id="summaryService" style="font-size:15px;">Hydra Facial Ritual</h6>
              <small class="text-accent" id="summaryDuration">75 Min</small>
            </div>

            <div class="py-3 border-bottom border-subtle">
              <span class="eyebrow" style="font-size:9.5px;">Specialist</span>
              <div class="text-white mt-1" id="summaryArtist" style="font-size:13.5px;">Any Master Specialist</div>
            </div>

            <div class="py-3 border-bottom border-subtle">
              <span class="eyebrow" style="font-size:9.5px;">Scheduled Date &amp; Time</span>
              <div class="text-white mt-1" id="summaryDateTime" style="font-size:13.5px;">Today at 11:00 AM</div>
            </div>

            <div class="py-3 border-bottom border-subtle">
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-dim" style="font-size:13px;">Estimated Total:</span>
                <span class="text-white fw-bold" id="summaryTotal"
                  style="font-family:'Playfair Display',serif;font-size:1.4rem;">₹3,500</span>
              </div>
              <small class="text-dim" style="font-size:11px;display:block;margin-top:4px;">Pay securely at the studio or
                via UPI upon arrival.</small>
            </div>

            <div class="mt-4 pt-1">
              <div class="d-flex align-items-center gap-2 mb-2" style="font-size:12px;color:var(--text-soft);">
                <span class="material-symbols-outlined text-accent" style="font-size:16px;">verified</span>
                100% Guaranteed Private Suite
              </div>
              <div class="d-flex align-items-center gap-2 mb-2" style="font-size:12px;color:var(--text-soft);">
                <span class="material-symbols-outlined text-accent" style="font-size:16px;">verified</span>
                Free Rescheduling Prior to 12 Hours
              </div>
              <div class="d-flex align-items-center gap-2" style="font-size:12px;color:var(--text-soft);">
                <span class="material-symbols-outlined text-accent" style="font-size:16px;">verified</span>
                Valet Parking Provided
              </div>
            </div>

            <div class="mt-4 pt-3 border-top border-subtle">
              <small class="text-dim d-block mb-2 text-center">Need help with your reservation?</small>
              <div class="d-flex flex-column gap-2">
                <a href="<?= business_phone_url() ?>" class="btn btn-outline-light btn-sm w-100 d-flex align-items-center justify-content-center gap-2" aria-label="Need help? Call us at <?= esc(business_phone()) ?>" title="Call Concierge">
                  <span class="material-symbols-outlined" style="font-size:16px;color:var(--accent);">call</span>
                  <span>Need help? Call us (<?= esc(business_phone()) ?>)</span>
                </a>
                <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about making a booking.') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-2" style="background:#25D366;color:#ffffff;font-weight:600;" aria-label="Chat on WhatsApp" title="Chat on WhatsApp">
                  <?= glowup_whatsapp_icon('', 16) ?>
                  <span>Chat on WhatsApp</span>
                </a>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== BOOKING CONFIRMATION MODAL ==================== -->
  <div class="modal fade" id="bookingSuccessModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4"
        style="background:var(--bg-deep);border:1px solid var(--accent);border-radius:20px;">
        <div class="modal-body">
          <div class="mb-3 d-inline-flex align-items-center justify-content-center"
            style="width:70px;height:70px;border-radius:50%;background:rgba(184,163,208,0.2);color:var(--accent);">
            <span class="material-symbols-outlined"
              style="font-size:40px;font-variation-settings:'FILL' 1;">check_circle</span>
          </div>
          <h3 class="text-white mb-2" style="font-family:'Playfair Display',serif;">Appointment Confirmed!</h3>
          <p class="text-dim mb-4" style="font-size:14px;">We are delighted to welcome you to Glowup Beauty Studio &amp;
            Academy.</p>

          <div class="p-3 mb-4 text-start"
            style="background:rgba(255,255,255,0.04);border-radius:12px;border:1px solid rgba(229,221,240,0.15);">
            <div class="d-flex justify-content-between mb-2">
              <span class="text-dim" style="font-size:12px;">Reservation ID:</span>
              <span class="text-accent fw-bold" id="modalBookingRef" style="font-size:12px;">#GLW-CONFIRMED</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span class="text-dim" style="font-size:12px;">Patron Name:</span>
              <span class="text-white fw-bold" id="modalClientName" style="font-size:12px;">Shalini</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span class="text-dim" style="font-size:12px;">Treatment:</span>
              <span class="text-white fw-bold" id="modalService" style="font-size:12px;">Hydra Facial</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span class="text-dim" style="font-size:12px;">Practitioner:</span>
              <span class="text-white fw-bold" id="modalArtist" style="font-size:12px;">Master Specialist</span>
            </div>
            <div class="d-flex justify-content-between">
              <span class="text-dim" style="font-size:12px;">Time:</span>
              <span class="text-accent fw-bold" id="modalTime" style="font-size:12px;">11:00 AM</span>
            </div>
          </div>

          <p class="text-soft mb-4" style="font-size:12px;">A confirmation SMS &amp; WhatsApp has been sent. Please
            arrive 10 minutes prior for your diagnostic consultation.</p>

          <div class="d-flex flex-column gap-2">
            <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about my booking.') ?>" 
               id="modalWhatsAppEnquiry" 
               data-base-url="<?= business_whatsapp_url() ?>"
               target="_blank" 
               rel="noopener noreferrer" 
               class="btn btn-sm d-flex align-items-center justify-content-center gap-2" 
               style="background:#25D366;color:#ffffff;font-weight:600;padding:10px;border-radius:10px;" 
               aria-label="Chat with Concierge about this booking on WhatsApp">
              <?= glowup_whatsapp_icon('', 18) ?>
              <span>Enquire About Booking on WhatsApp</span>
            </a>
            <div class="d-flex gap-2 justify-content-center mt-1">
              <a href="<?= base_url('/') ?>" class="btn btn-outline-light flex-grow-1">Return to Home</a>
              <a href="<?= base_url('profile') ?>" class="btn btn-violet flex-grow-1"><span class="material-symbols-outlined align-middle me-1" style="font-size: 16px;">account_circle</span> View in My Profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ==================== FOOTER ==================== -->
<?= view('glowup/partials/footer') ?>



  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Main JS -->
  <script src="<?= base_url('js/main.js') ?>"></script>

  <script>
    // Universal Booking Luxury Toaster Notification Function
    function showBookingToast(type, title, message) {
        const container = document.getElementById('toastContainer');
        if (!container) return;

        container.innerHTML = '';

        const toast = document.createElement('div');
        toast.className = `toast-item toast-${type}`;

        let iconName = 'info';
        if (type === 'success') iconName = 'check_circle';
        else if (type === 'error') iconName = 'error';
        else if (type === 'warning') iconName = 'warning';

        toast.innerHTML = `
            <div class="toast-icon-box">
                <span class="material-symbols-outlined">${iconName}</span>
            </div>
            <div class="toast-body">
                <div class="toast-title">${title}</div>
                <p class="toast-message">${message}</p>
            </div>
            <button type="button" class="toast-close-btn" aria-label="Dismiss notification">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="toast-progress">
                <div class="toast-progress-bar"></div>
            </div>
        `;

        container.appendChild(toast);

        requestAnimationFrame(() => {
            toast.classList.add('show');
        });

        const removeToast = () => {
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => {
                if (toast.parentElement) toast.parentElement.removeChild(toast);
            }, 400);
        };

        const closeBtn = toast.querySelector('.toast-close-btn');
        if (closeBtn) closeBtn.addEventListener('click', removeToast);

        setTimeout(removeToast, 5000);
    }

    // Auto-select service if passed in URL: ?service=...
    document.addEventListener('DOMContentLoaded', () => {
      const urlParams = new URLSearchParams(window.location.search);
      const targetService = urlParams.get('service');
      if (targetService) {
        const cards = document.querySelectorAll('.service-radio-card');
        let matched = false;
        cards.forEach(card => {
          const sName = card.dataset.serviceName || '';
          if (sName.toLowerCase().includes(targetService.toLowerCase()) || targetService.toLowerCase().includes(sName.toLowerCase())) {
            cards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            card.click();
            matched = true;
          }
        });
      }
    });
  </script>
</body>

</html>