<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patron Reviews &amp; Testimonials | Glowup Beauty Studio &amp; Academy</title>
  <meta name="description" content="Read unedited reviews and reflections from cherished patrons who experienced our clinical facials, hair alchemy, and bridal couture." />

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet" />

  <!-- Material Symbols -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

  <!-- Main Unified CSS -->
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />


</head>
<body>

<!-- ==================== NAVBAR ==================== -->
<?= view('glowup/partials/navbar', ['activePage' => 'review']) ?>

<!-- ==================== PAGE HERO ==================== -->
<section class="page-hero">
  <div class="container" style="max-width: 1420px;">
    <h1>Voices of Radiance</h1>
    <p>
      Discover unedited feedback and personal transformations shared by our cherished patrons
      and academy alumni who experienced our sanctuary in Madurai.
    </p>
    <div class="breadcrumb-custom">
      <a href="<?= base_url('/') ?>">Home</a>
      <span class="separator">/</span>
      <span style="color:#fff;">Reviews</span>
    </div>
  </div>
</section>

<!-- ==================== RATING SCORECARD & METRICS ==================== -->
<section class="section-pad-sm bg-violet-soft border-bottom border-subtle">
  <div class="container" style="max-width: 1200px;">
    <div class="row g-4 align-items-center">

      <!-- Overall Score Box -->
      <div class="col-lg-4 text-center text-lg-start border-end-lg border-subtle pe-lg-4">
        <span class="eyebrow mb-2">Overall Score</span>
        <div class="d-flex align-items-baseline justify-content-center justify-content-lg-start gap-2 mt-1">
          <span style="font-family:'Playfair Display',serif;font-size:3.5rem;font-weight:700;line-height:1;color:#fff;">
            <?= esc($stats['average'] ?? '4.98') ?>
          </span>
          <span class="text-dim" style="font-size:1.4rem;">/ 5.0</span>
        </div>
        <div class="d-flex justify-content-center justify-content-lg-start gap-1 my-2 text-gold">
          <?php 
            $avgNum = (float) ($stats['average'] ?? 5.0);
            for ($st = 1; $st <= 5; $st++): 
          ?>
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' <?= $st <= round($avgNum) ? 1 : 0 ?>;font-size:22px;">star</span>
          <?php endfor; ?>
        </div>
        <p class="text-dim mb-3" style="font-size:13px;">Based on <?= number_format($stats['published'] ?? 0) ?> verified guest evaluations.</p>
        <a href="#writeReviewSection" class="btn btn-accent btn-sm">
          <span class="material-symbols-outlined" style="font-size:16px;">rate_review</span>
          Write a Review
        </a>
      </div>

      <!-- Rating Bar Breakdown -->
      <div class="col-lg-4">
        <h6 class="text-accent mb-3" style="font-size:11px;letter-spacing:.14em;text-transform:uppercase;">Rating Breakdown</h6>
        
        <?php for ($star = 5; $star >= 1; $star--): ?>
          <div class="rating-progress-row">
            <span style="width:50px;" class="text-dim"><?= $star ?> Star</span>
            <div class="rating-bar-bg"><div class="rating-bar-fill" style="width:<?= esc($stats['star_percentages'][$star] ?? 0) ?>%;"></div></div>
            <span style="width:40px;text-align:right;" class="<?= $star === 5 ? 'text-white fw-bold' : 'text-dim' ?>"><?= esc($stats['star_percentages'][$star] ?? 0) ?>%</span>
          </div>
        <?php endfor; ?>
      </div>

      <!-- Category Performance -->
      <div class="col-lg-4 ps-lg-4 border-start-lg border-subtle">
        <h6 class="text-accent mb-3" style="font-size:11px;letter-spacing:.14em;text-transform:uppercase;">Category Standards</h6>

        <?php 
          $catAvgs = $stats['category_averages'] ?? [
            'hair' => ['name' => 'Hair Alchemy & Textures', 'average' => '4.99'],
            'facials' => ['name' => 'Clinical Hydra Facials', 'average' => '4.98'],
            'bridal' => ['name' => 'Haute Bridal Artistry', 'average' => '5.00'],
            'academy' => ['name' => 'Academy Professional Courses', 'average' => '4.99'],
          ];
          $catKeys = array_keys($catAvgs);
          $lastCat = end($catKeys);
          foreach ($catAvgs as $ck => $cd):
            $isLast = ($ck === $lastCat);
        ?>
          <div class="d-flex justify-content-between align-items-center <?= !$isLast ? 'mb-2 pb-1 border-bottom border-subtle' : '' ?>">
            <span class="text-soft" style="font-size:13px;"><?= esc($cd['name']) ?></span>
            <span class="text-gold fw-bold" style="font-size:13px;"><?= esc($cd['average']) ?> ★</span>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ==================== REVIEWS DIRECTORY WITH CATEGORY FILTER ==================== -->
<section class="section-pad">
  <div class="container" style="max-width: 1420px;">

    <!-- Filter Buttons -->
    <div class="filter-nav mb-5">
      <button class="filter-btn active" data-filter="all">All Experiences (<?= number_format($stats['published'] ?? 0) ?>)</button>
      <button class="filter-btn" data-filter="hair">Hair Alchemy</button>
      <button class="filter-btn" data-filter="facials">Clinical Facials</button>
      <button class="filter-btn" data-filter="bridal">Haute Bridal</button>
      <button class="filter-btn" data-filter="academy">Academy Alumni</button>
    </div>

    <!-- Review Cards Grid -->
    <div class="row g-4" id="reviewsGrid">

      <?php if (empty($reviews)): ?>
        <div class="col-12 text-center py-5">
          <div class="p-5" style="background: rgba(255, 255, 255, 0.03); border: 1px dashed rgba(255, 255, 255, 0.15); border-radius: 16px;">
            <span class="material-symbols-outlined text-dim mb-3" style="font-size: 48px;">rate_review</span>
            <h4 class="text-white mb-2" style="font-family: 'Playfair Display', serif;">No Reviews Published Yet</h4>
            <p class="text-dim mb-0" style="font-size: 14px;">Be the first patron to share your experience with our sanctuary.</p>
          </div>
        </div>
      <?php else: ?>
        <?php foreach ($reviews as $review): ?>
          <?php
            $cat = esc(strtolower($review['category'] ?? 'all'));
            $initials = strtoupper(substr($review['customer_name'] ?? 'GP', 0, 2));
            $isAlumna = ($cat === 'academy');
            $ratingVal = max(1, min(5, (int) ($review['rating'] ?? 5)));
          ?>
          <div class="col-md-6 col-lg-4" data-category="<?= $cat ?>">
            <div class="service-card p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex align-items-center gap-3">
                  <?php if (!empty($review['customer_photo'])): ?>
                    <img src="<?= esc(base_url($review['customer_photo'])) ?>" alt="<?= esc($review['customer_name']) ?>" style="width:42px;height:42px;border-radius:50%;object-fit:cover;border:1px solid rgba(184,163,208,0.3);" />
                  <?php else: ?>
                    <div class="review-user-avatar"><?= esc($initials) ?></div>
                  <?php endif; ?>
                  <div>
                    <h6 class="text-white mb-0" style="font-size:14.5px;"><?= esc($review['customer_name']) ?></h6>
                    <small class="text-dim" style="font-size:11px;">
                      <?= esc($review['location'] ?? 'Madurai') ?> • <?= !empty($review['created_at']) ? date('M d, Y', strtotime($review['created_at'])) : 'Verified' ?>
                    </small>
                  </div>
                </div>
                <span class="verified-chip">
                  <span class="material-symbols-outlined" style="font-size:12px;"><?= $isAlumna ? 'school' : 'check_circle' ?></span>
                  <?= $isAlumna ? 'Alumna' : 'Verified' ?>
                </span>
              </div>

              <div class="d-flex text-gold mb-2">
                <?php for ($s = 1; $s <= 5; $s++): ?>
                  <span class="material-symbols-outlined" style="font-variation-settings:'FILL' <?= $s <= $ratingVal ? 1 : 0 ?>;font-size:18px;">star</span>
                <?php endfor; ?>
              </div>

              <?php if (!empty($review['headline'])): ?>
                <h5 class="text-white mb-2" style="font-size:1.15rem;font-family:'Playfair Display',serif;">
                  "<?= esc($review['headline']) ?>"
                </h5>
              <?php endif; ?>

              <p style="font-size:13.5px;color:var(--text-soft);line-height:1.75;">
                <?= nl2br(esc($review['review_text'])) ?>
              </p>

              <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top border-subtle">
                <span class="text-accent" style="font-size:11px;text-transform:uppercase;letter-spacing:.1em;"><?= esc($review['service_name'] ?? 'Bespoke Experience') ?></span>
                <span class="text-dim" style="font-size:11px;">
                  <?= !empty($review['specialist_name']) ? 'Attended by: ' . esc($review['specialist_name']) : date('M Y', strtotime($review['created_at'] ?? 'now')) ?>
                </span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </div>
</section>

<!-- ==================== SUBMIT A REVIEW FORM ==================== -->
<section class="section-pad bg-violet-deep" id="writeReviewSection">
  <div class="container" style="max-width: 900px;">
    <div class="booking-card">

      <div class="text-center mb-4">
        <span class="eyebrow eyebrow-center mb-2">Share Your Voice</span>
        <h2 class="section-title mb-2">Submit Your Review</h2>
        <p class="text-dim" style="font-size:14px;">Your honest reflection inspires our practitioners and guides fellow patrons.</p>
      </div>

      <div id="reviewAlertBox"></div>

      <form id="reviewSubmitForm">
        <div class="row g-4">

          <!-- Star Rating Selector -->
          <div class="col-12 text-center">
            <label class="form-label d-block mb-2">Your Overall Rating *</label>
            <div class="star-rating-select" id="starRatingSelect">
              <span class="material-symbols-outlined star-icon active" data-rating="1">star</span>
              <span class="material-symbols-outlined star-icon active" data-rating="2">star</span>
              <span class="material-symbols-outlined star-icon active" data-rating="3">star</span>
              <span class="material-symbols-outlined star-icon active" data-rating="4">star</span>
              <span class="material-symbols-outlined star-icon active" data-rating="5">star</span>
            </div>
            <input type="hidden" id="selectedStarScore" value="5" />
            <div class="text-accent-2 mt-1" id="starScoreLabel" style="font-size:12px;font-weight:600;">5.0 - Exceptional Luxury Experience</div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Full Name *</label>
            <input type="text" class="form-control-violet" id="reviewAuthor" placeholder="e.g. Shalini Ramesh" required />
          </div>

          <div class="col-md-6">
            <label class="form-label">Mobile Number (For Verification) *</label>
            <input type="tel" class="form-control-violet" id="reviewPhone" placeholder="+91 98765 43210" required />
          </div>

          <div class="col-md-6">
            <label class="form-label">Service Received *</label>
            <select class="form-select-violet" id="reviewService" required>
              <option value="Hydra Facial Ritual">Hydra Facial Ritual</option>
              <option value="Keratin Infusion Therapy">Keratin Infusion Therapy</option>
              <option value="Botox Capillary Treatment">Botox Capillary Treatment</option>
              <option value="Japanese Hair Straightening">Japanese Hair Straightening</option>
              <option value="Silk Cysteine Smoothing">Silk Cysteine Smoothing</option>
              <option value="24K Gold Cellular Facial">24K Gold Cellular Facial</option>
              <option value="Couture Royal Bridal Package">Couture Royal Bridal Package</option>
              <option value="Academy Diploma Course">Academy Diploma Course</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Master Practitioner Attended</label>
            <select class="form-select-violet" id="reviewSpecialist">
              <option value="Dr. Elena Ross">Dr. Elena Ross (Clinical Director)</option>
              <option value="Maya Sundaram">Maya Sundaram (Master Trichologist)</option>
              <option value="Aarav Mehta">Aarav Mehta (Creative Hair Director)</option>
              <option value="Priya Chandran">Priya Chandran (Lead Bridal Couturier)</option>
              <option value="Academy Master Team">Academy Master Faculty Team</option>
            </select>
          </div>

          <div class="col-12">
            <label class="form-label">Review Headline *</label>
            <input type="text" class="form-control-violet" id="reviewHeadline" placeholder="e.g. Absolute serenity and mirror hair gloss" required />
          </div>

          <div class="col-12">
            <label class="form-label">Your Detailed Experience *</label>
            <textarea class="form-control-violet" id="reviewText" rows="4" placeholder="Tell us about the atmosphere, practitioner care, treatment longevity, and overall results..." required></textarea>
          </div>

          <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-accent px-5 py-3">
              <span class="material-symbols-outlined me-1">publish</span>
              Submit Verified Patron Review
            </button>
            <div class="text-dim mt-2" style="font-size:11px;">Reviews are verified by phone number to ensure authentic guest reflections.</div>
          </div>

        </div>
      </form>

    </div>
  </div>
</section>

<!-- ==================== CTA BANNER ==================== -->
<section class="section-pad cta-section">
  <div class="container cta-content text-center" style="max-width: 900px;">
    <div class="cta-pill">
      <span class="material-symbols-outlined" style="font-size:16px;">verified</span>
      Bespoke Perfection
    </div>
    <h2 class="section-title mb-3">Ready to Create Your Own Story?</h2>
    <p class="section-sub mx-auto mb-4">
      Join our community of radiant patrons and experience bespoke clinical therapies in our Madurai sanctuary.
    </p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a href="<?= base_url('booking') ?>" class="btn btn-accent">Reserve Appointment</a>
      <a href="<?= base_url('services') ?>" class="btn btn-ghost">Explore Treatment Folio</a>
    </div>
  </div>
</section>

<!-- ==================== FOOTER ==================== -->
<?= view('glowup/partials/footer') ?>



<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Main JS -->
<script src="<?= base_url('js/main.js') ?>"></script>

<script>
  // Interactive Star Rating Selector
  const starIcons = document.querySelectorAll('#starRatingSelect .star-icon');
  const starInput = document.getElementById('selectedStarScore');
  const starLabel = document.getElementById('starScoreLabel');

  const ratingDescriptions = {
    1: '1.0 - Needs Improvement',
    2: '2.0 - Satisfactory Care',
    3: '3.0 - Good Service',
    4: '4.0 - Very Good & Recommended',
    5: '5.0 - Exceptional Luxury Experience'
  };

  starIcons.forEach(icon => {
    icon.addEventListener('mouseenter', () => {
      const rating = parseInt(icon.dataset.rating);
      highlightStars(rating);
    });

    icon.addEventListener('mouseleave', () => {
      const activeRating = parseInt(starInput.value);
      highlightStars(activeRating);
    });

    icon.addEventListener('click', () => {
      const rating = parseInt(icon.dataset.rating);
      starInput.value = rating;
      if (starLabel) starLabel.textContent = ratingDescriptions[rating];
      highlightStars(rating);
    });
  });

  function highlightStars(score) {
    starIcons.forEach(icon => {
      const rating = parseInt(icon.dataset.rating);
      if (rating <= score) {
        icon.classList.add('active');
      } else {
        icon.classList.remove('active');
      }
    });
  }

  // Handle Review Form Submission via Backend API
  const reviewForm = document.getElementById('reviewSubmitForm');
  if (reviewForm) {
    reviewForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const submitBtn = reviewForm.querySelector('button[type="submit"]');
      const originalBtnText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Submitting...';

      const formData = new FormData();
      formData.append('name', document.getElementById('reviewAuthor').value);
      formData.append('phone', document.getElementById('reviewPhone').value);
      formData.append('service', document.getElementById('reviewService').value);
      formData.append('specialist', document.getElementById('reviewSpecialist') ? document.getElementById('reviewSpecialist').value : '');
      formData.append('score', starInput.value);
      formData.append('headline', document.getElementById('reviewHeadline').value);
      formData.append('experience', document.getElementById('reviewText').value);

      fetch('<?= base_url('review/submit') ?>', {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(res => res.json())
      .then(data => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;

        const alertBox = document.getElementById('reviewAlertBox');
        if (alertBox) {
          if (data.status) {
            alertBox.innerHTML = `
              <div class="alert alert-success d-flex align-items-center gap-3 mb-4" style="background: rgba(184, 163, 208, 0.25); border: 1px solid var(--accent); color: #fff; border-radius: 12px; padding: 1.25rem;">
                <span class="material-symbols-outlined text-accent-2" style="font-size:28px;">verified</span>
                <div>
                  <div class="fw-bold mb-1">${data.message || 'Thank you!'}</div>
                  <div style="font-size:13px;color:var(--text-soft);">Your authentic reflection has been saved and is now visible in our patron folio.</div>
                </div>
              </div>
            `;
            reviewForm.reset();
            highlightStars(5);
            starInput.value = 5;
            if (starLabel) starLabel.textContent = ratingDescriptions[5];
            alertBox.scrollIntoView({ behavior: 'smooth' });
            setTimeout(() => { window.location.reload(); }, 2000);
          } else {
            alertBox.innerHTML = `
              <div class="alert alert-danger mb-4" style="background: rgba(220, 38, 38, 0.25); border: 1px solid #ef4444; color: #fff; border-radius: 12px; padding: 1.25rem;">
                ${data.message || 'Failed to submit review. Please check all fields.'}
              </div>
            `;
          }
        }
      })
      .catch(err => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        const alertBox = document.getElementById('reviewAlertBox');
        if (alertBox) {
          alertBox.innerHTML = `
            <div class="alert alert-danger mb-4" style="background: rgba(220, 38, 38, 0.25); border: 1px solid #ef4444; color: #fff; border-radius: 12px; padding: 1.25rem;">
              An error occurred while saving your review. Please try again.
            </div>
          `;
        }
      });
    });
  }
</script>

</body>
</html>
