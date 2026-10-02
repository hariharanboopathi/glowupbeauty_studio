<?php
/**
 * Glowup Studio - Reusable Dynamic Booking Popup Modal
 * Shares the exact same booking form markup, design system, and backend logic as /booking.
 */

$serviceModel = new \App\Models\ServiceModel();
$modalServices = $serviceModel->getFilteredServices(null, null, '1', 100, 0);

$modalCustomer = null;
$customerAuth = new \App\Libraries\CustomerAuth();
if ($customerAuth->isLoggedIn()) {
    $modalCustomer = $customerAuth->user();
}
?>

<!-- ==================== UNIVERSAL BOOKING POPUP MODAL ==================== -->
<div class="modal fade glowup-booking-modal-root" id="glowupBookingModal" tabindex="-1" aria-labelledby="glowupBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background: #140c1d; border: 1px solid rgba(184, 163, 208, 0.35); border-radius: 20px; box-shadow: 0 30px 80px rgba(0,0,0,0.85); overflow: hidden;">

      <!-- Luxury Header -->
      <div class="modal-header border-bottom border-subtle px-4 py-3 d-flex align-items-center justify-content-between" style="background: rgba(45, 31, 61, 0.95); backdrop-filter: blur(16px);">
        <div>
          <span class="eyebrow d-block mb-1" style="font-size: 10px; color: var(--accent); letter-spacing: 0.15em;">GLOWUP BEAUTY STUDIO &amp; ACADEMY</span>
          <h4 class="modal-title text-white mb-0" id="glowupBookingModalLabel" style="font-family:'Playfair Display',serif; font-size: 1.35rem;">
            Reserve Your Treatment
          </h4>
        </div>
        <button type="button" class="btn-close-glowup" data-bs-dismiss="modal" aria-label="Close" title="Close booking window">
          <span class="material-symbols-outlined" style="font-size: 20px;">close</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-3 p-md-4 p-lg-4" style="background: rgba(20, 12, 29, 0.98);">
        <div class="row g-4">

          <!-- Left Column: Interactive Wizard Steps -->
          <div class="col-lg-8">
            <div class="booking-card p-3 p-md-4" style="background: rgba(45, 31, 61, 0.65); border: 1px solid rgba(229, 221, 240, 0.16); border-radius: 16px;">

              <!-- Wizard Step Markers -->
              <div class="wizard-steps modal-wizard-steps mb-4">
                <div class="step-item modal-step-item active" data-modal-step-indicator="1">
                  <div class="step-circle">1</div>
                  <div class="step-title">Choose Service</div>
                </div>
                <div class="step-item modal-step-item" data-modal-step-indicator="2">
                  <div class="step-circle">2</div>
                  <div class="step-title">Date &amp; Time</div>
                </div>
                <div class="step-item modal-step-item" data-modal-step-indicator="3">
                  <div class="step-circle">3</div>
                  <div class="step-title">Your Details</div>
                </div>
              </div>

              <form id="modalBookingWizardForm">

                <!-- STEP 1: SELECT RITUAL -->
                <div class="modal-step-pane" data-modal-step="1">
                  <h5 class="mb-2 text-white" style="font-family:'Playfair Display',serif;">Choose Your Service</h5>
                  <p class="text-dim mb-3" style="font-size:13px;">Click any card to select. Price adjusts based on strand length during consultation.</p>

                  <div class="row g-3" style="max-height: 420px; overflow-y: auto; padding-right: 4px;">
                    <?php if (!empty($modalServices)): ?>
                      <?php foreach ($modalServices as $idx => $s): ?>
                        <?php 
                          $sName = $s['name'] ?? $s['title'] ?? 'Treatment';
                          $sRawPrice = $s['price'] ?? 3500;
                          $sCleanPrice = (float) preg_replace('/[^\d.]/', '', (string)$sRawPrice);
                          $sDuration = $s['duration'] ?? '60 Min';
                          $sDesc = $s['description'] ?? 'Indulgent bespoke beauty ritual tailored by our master specialists.';
                          $sId = $s['id'] ?? '';
                        ?>
                        <div class="col-md-6">
                          <div class="service-radio-card modal-service-card <?= ($idx === 0) ? 'selected' : '' ?>"
                            data-service-id="<?= esc($sId) ?>"
                            data-service-name="<?= esc($sName) ?>"
                            data-service-price="<?= esc($sCleanPrice) ?>"
                            data-service-duration="<?= esc($sDuration) ?>">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                              <h6 class="text-white mb-0" style="font-family:'Playfair Display',serif;font-size:1.1rem;">
                                <?= esc($sName) ?>
                              </h6>
                              <span class="text-accent fw-bold">₹<?= number_format($sCleanPrice) ?></span>
                            </div>
                            <p class="text-dim mb-2" style="font-size:12px;line-height:1.45;">
                              <?= esc($sDesc) ?>
                            </p>
                            <small class="text-accent-2" style="font-size:11px;">Duration: <?= esc($sDuration) ?></small>
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
                <div class="modal-step-pane" data-modal-step="2" style="display:none;">
                  <h5 class="mb-2 text-white" style="font-family:'Playfair Display',serif;">Preferred Date &amp; Time</h5>
                  <p class="text-dim mb-3" style="font-size:13px;">Reserved slots guarantee private attention in your acoustic treatment suite.</p>

                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Preferred Specialist</label>
                      <select class="form-select-violet" id="modalArtistSelect">
                        <option value="Any Master Specialist">Any Master Specialist (Fastest Available)</option>
                        <option value="Dr. Elena Ross (Clinical Director)">Dr. Elena Ross (Clinical Director)</option>
                        <option value="Maya Sundaram (Master Trichologist)">Maya Sundaram (Master Trichologist)</option>
                        <option value="Aarav Mehta (Creative Hair Director)">Aarav Mehta (Creative Hair Director)</option>
                        <option value="Priya Chandran (Lead Bridal Couturier)">Priya Chandran (Lead Bridal Couturier)</option>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label class="form-label">Preferred Date *</label>
                      <input type="date" class="form-control-violet" id="modalBookingDate" />
                    </div>

                    <div class="col-12 mt-3">
                      <label class="form-label">Preferred Time *</label>
                      <div class="row g-2">
                        <div class="col-6 col-sm-4 col-md-3"><div class="slot-pill modal-slot-pill">10:00 AM</div></div>
                        <div class="col-6 col-sm-4 col-md-3"><div class="slot-pill modal-slot-pill selected">11:00 AM</div></div>
                        <div class="col-6 col-sm-4 col-md-3"><div class="slot-pill modal-slot-pill">12:30 PM</div></div>
                        <div class="col-6 col-sm-4 col-md-3"><div class="slot-pill modal-slot-pill">02:00 PM</div></div>
                        <div class="col-6 col-sm-4 col-md-3"><div class="slot-pill modal-slot-pill">03:30 PM</div></div>
                        <div class="col-6 col-sm-4 col-md-3"><div class="slot-pill modal-slot-pill">05:00 PM</div></div>
                        <div class="col-6 col-sm-4 col-md-3"><div class="slot-pill modal-slot-pill">06:30 PM</div></div>
                        <div class="col-6 col-sm-4 col-md-3"><div class="slot-pill modal-slot-pill">07:30 PM</div></div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- STEP 3: PATRON DETAILS -->
                <div class="modal-step-pane" data-modal-step="3" style="display:none;">
                  <h5 class="mb-2 text-white" style="font-family:'Playfair Display',serif;">Your Details</h5>
                  <p class="text-dim mb-3" style="font-size:13px;">Your details are protected under our private confidentiality protocol.</p>

                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Full Name *</label>
                      <input type="text" class="form-control-violet" id="modalClientNameInput" value="<?= esc($modalCustomer['name'] ?? '') ?>" placeholder="e.g. Shalini Ramesh" required />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Mobile / WhatsApp *</label>
                      <input type="tel" class="form-control-violet" id="modalClientPhoneInput" value="<?= esc($modalCustomer['phone'] ?? '') ?>" placeholder="+91 98765 43210" required />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Email Address (For Confirmation &amp; Invoice)</label>
                      <input type="email" class="form-control-violet" id="modalClientEmailInput" value="<?= esc($modalCustomer['email'] ?? '') ?>" placeholder="shalini@example.com" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Complimentary Suite Beverage</label>
                      <select class="form-select-violet" id="modalClientBeverageInput">
                        <option value="Organic Matcha Latte">Organic Japanese Matcha Latte</option>
                        <option value="Lavender Chamomile Infusion">Lavender &amp; Chamomile Herbal Infusion</option>
                        <option value="Single-Origin Espresso">Artisanal Single-Origin Espresso</option>
                        <option value="Citrus Sparkling Water">Chilled Citrus Sparkling Water</option>
                      </select>
                    </div>
                    <div class="col-12">
                      <label class="form-label">Any Special Requests or Preferences?</label>
                      <textarea class="form-control-violet" id="modalClientNotesInput" rows="2" placeholder="Mention any sensitivities, occasion details, stylist preferences, or questions..."></textarea>
                    </div>
                  </div>
                </div>

                <!-- Wizard Navigation Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top border-subtle">
                  <button type="button" class="btn btn-ghost btn-sm" id="modalBtnPrevStep" style="display:none;">
                    <span class="material-symbols-outlined me-1" style="font-size: 16px;">arrow_back</span> Back
                  </button>
                  <div class="ms-auto">
                    <button type="button" class="btn btn-violet" id="modalBtnNextStep">
                      Continue <span class="material-symbols-outlined ms-1" style="font-size: 16px;">arrow_forward</span>
                    </button>
                  </div>
                </div>

              </form>
            </div>
          </div>

          <!-- Right Column: Live Reservation Summary Card -->
          <div class="col-lg-4">
            <div class="booking-card h-100 p-3 p-md-4" style="background: rgba(45, 31, 61, 0.55); border: 1px solid rgba(229, 221, 240, 0.16); border-radius: 16px;">
              <h5 class="text-white mb-3" style="font-family:'Playfair Display',serif; font-size: 1.15rem;">Reservation Summary</h5>

              <div class="py-2 border-bottom border-subtle">
                <span class="eyebrow" style="font-size:9px; color: var(--accent);">Selected Ritual</span>
                <h6 class="text-white mt-1 mb-0" id="modalSummaryService" style="font-size:14px;">Hydra Facial Ritual</h6>
                <small class="text-accent" id="modalSummaryDuration">75 Min</small>
              </div>

              <div class="py-2 border-bottom border-subtle">
                <span class="eyebrow" style="font-size:9px; color: var(--accent);">Specialist</span>
                <div class="text-white mt-1" id="modalSummaryArtist" style="font-size:13px;">Any Master Specialist</div>
              </div>

              <div class="py-2 border-bottom border-subtle">
                <span class="eyebrow" style="font-size:9px; color: var(--accent);">Scheduled Date &amp; Time</span>
                <div class="text-white mt-1" id="modalSummaryDateTime" style="font-size:13px;">Today at 11:00 AM</div>
              </div>

              <div class="py-2 border-bottom border-subtle">
                <div class="d-flex justify-content-between align-items-center">
                  <span class="text-dim" style="font-size:13px;">Estimated Total:</span>
                  <span class="text-white fw-bold" id="modalSummaryTotal" style="font-family:'Playfair Display',serif;font-size:1.35rem;">₹3,500</span>
                </div>
                <small class="text-dim" style="font-size:11px;display:block;margin-top:2px;">Pay securely at studio or via UPI upon arrival.</small>
              </div>

              <div class="mt-3 pt-1">
                <div class="d-flex align-items-center gap-2 mb-2" style="font-size:11.5px;color:var(--text-soft);">
                  <span class="material-symbols-outlined text-accent" style="font-size:15px;">verified</span>
                  100% Guaranteed Private Suite
                </div>
                <div class="d-flex align-items-center gap-2 mb-2" style="font-size:11.5px;color:var(--text-soft);">
                  <span class="material-symbols-outlined text-accent" style="font-size:15px;">verified</span>
                  Free Rescheduling Prior to 12 Hours
                </div>
                <div class="d-flex align-items-center gap-2" style="font-size:11.5px;color:var(--text-soft);">
                  <span class="material-symbols-outlined text-accent" style="font-size:15px;">verified</span>
                  Valet Parking Provided
                </div>
              </div>

              <div class="mt-3 pt-3 border-top border-subtle">
                <small class="text-dim d-block mb-2 text-center" style="font-size:11px;">Need immediate assistance?</small>
                <div class="d-flex flex-column gap-2">
                  <a href="<?= business_phone_url() ?>" class="btn btn-outline-light btn-sm w-100 d-flex align-items-center justify-content-center gap-2 py-1" style="font-size:12px;" aria-label="Call concierge: <?= esc(business_phone()) ?>">
                    <span class="material-symbols-outlined" style="font-size:14px;color:var(--accent);">call</span>
                    <span>Call Concierge (<?= esc(business_phone()) ?>)</span>
                  </a>
                  <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about making a booking.') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-2 py-1" style="background:#25D366;color:#ffffff;font-weight:600;font-size:12px;" aria-label="Chat on WhatsApp">
                    <?= glowup_whatsapp_icon('', 14) ?>
                    <span>Chat on WhatsApp</span>
                  </a>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- ==================== BOOKING CONFIRMATION MODAL ==================== -->
<div class="modal fade" id="bookingSuccessModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4" style="background:var(--bg-deep);border:1px solid var(--accent);border-radius:20px; box-shadow: 0 30px 80px rgba(0,0,0,0.85);">
      <div class="modal-body">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center"
          style="width:70px;height:70px;border-radius:50%;background:rgba(184,163,208,0.2);color:var(--accent);">
          <span class="material-symbols-outlined" style="font-size:40px;font-variation-settings:'FILL' 1;">check_circle</span>
        </div>
        <h3 class="text-white mb-2" style="font-family:'Playfair Display',serif;">Appointment Confirmed!</h3>
        <p class="text-dim mb-4" style="font-size:14px;">We are delighted to welcome you to Glowup Beauty Studio &amp; Academy.</p>

        <div class="p-3 mb-4 text-start" style="background:rgba(255,255,255,0.04);border-radius:12px;border:1px solid rgba(229,221,240,0.15);">
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

        <p class="text-soft mb-4" style="font-size:12px;">A confirmation SMS &amp; WhatsApp has been sent. Please arrive 10 minutes prior for your diagnostic consultation.</p>

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
            <button type="button" class="btn btn-outline-light flex-grow-1" data-bs-dismiss="modal">Close</button>
            <a href="<?= base_url('profile') ?>" class="btn btn-violet flex-grow-1"><span class="material-symbols-outlined align-middle me-1" style="font-size: 16px;">account_circle</span> View in My Profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
