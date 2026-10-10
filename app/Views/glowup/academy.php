<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?= view('glowup/partials/seo_meta', [
    'pageKey' => 'academy',
    'fallbackTitle' => 'Academy of Beauty Arts & Courses | Glowup',
    'fallbackDesc' => 'Enroll in professional beauty courses: Bridal Makeup Diploma, Advanced Hair Alchemy, Clinical Cosmetology, and Nail Artistry in Madurai.',
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
  <?= view('glowup/partials/navbar', ['activePage' => 'academy']) ?>

  <!-- ==================== PAGE HERO ==================== -->
  <section class="page-hero">
    <div class="container" style="max-width: 1420px;">
      <h1>The Academy of Beauty Arts</h1>
      <p>
        Cultivating the next generation of visionary bridal couturiers, clinical cosmetologists,
        and hair alchemists with rigorous practical training and international certifications.
      </p>
      <div class="breadcrumb-custom">
        <a href="<?= base_url('/') ?>">Home</a>
        <span class="separator">/</span>
        <span style="color:#fff;">Academy</span>
      </div>
    </div>
  </section>

  <!-- ==================== ACADEMY PILLARS & STATS ==================== -->
  <section class="section-pad-sm bg-violet-soft border-bottom border-subtle">
    <div class="container" style="max-width: 1420px;">
      <div class="row g-4 text-center">
        <div class="col-6 col-lg-3">
          <div class="stat-block border-0 pt-0">
            <div class="num text-accent">850+</div>
            <div class="lbl">Certified Graduates</div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="stat-block border-0 pt-0">
            <div class="num text-accent">100%</div>
            <div class="lbl">Placement &amp; Internship</div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="stat-block border-0 pt-0">
            <div class="num text-accent">1 : 6</div>
            <div class="lbl">Student-Mentor Ratio</div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="stat-block border-0 pt-0">
            <div class="num text-accent">ISO &amp; CIDESCO</div>
            <div class="lbl">Aligned Global Curriculum</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== COURSES CATALOG ==================== -->
  <section class="section-pad">
    <div class="container" style="max-width: 1420px;">

      <div class="row align-items-end mb-5 g-3">
        <div class="col-lg-8">
          <span class="eyebrow mb-3">Diploma Programs</span>
          <h2 class="section-title mb-3">Professional Diploma Courses</h2>
          <p class="section-sub mb-0">
            Select from our comprehensive curricula designed for both newcomers entering the beauty industry and working
            stylists advancing their craft.
          </p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <a href="#enrollSection" class="btn btn-ghost">
            Download Academy Prospectus
            <span class="material-symbols-outlined ms-1" style="font-size:16px;">download</span>
          </a>
        </div>
      </div>

      <div class="row g-4">
        <?php if (!empty($courses)): ?>
          <?php foreach ($courses as $c): ?>
            <?php
            $cImg = (strpos($c['image_url'], 'http') === 0) ? $c['image_url'] : base_url($c['image_url']);
            ?>
            <div class="col-lg-4 col-md-6">
              <div class="course-card">
                <?php if (!empty($c['badge'])): ?>
                  <div class="course-badge"><?= esc($c['badge']) ?></div>
                <?php endif; ?>
                <div class="course-img">
                  <img src="<?= esc($cImg) ?>" alt="<?= esc($c['title']) ?>"
                    onerror="this.src='https://placehold.co/800x600?text=Diploma'" />
                </div>
                <div class="course-body">
                  <div class="course-meta">
                    <span><span class="material-symbols-outlined" style="font-size:15px;">schedule</span>
                      <?= esc($c['duration']) ?></span>
                    <span><span class="material-symbols-outlined" style="font-size:15px;">school</span>
                      <?= esc($c['level']) ?></span>
                  </div>
                  <h4><?= esc($c['title']) ?></h4>
                  <p><?= esc($c['description']) ?></p>
                  <div class="course-footer mt-auto pt-3">
                    <div class="course-price">
                      ₹<?= number_format((float) $c['price'], 0) ?>
                      <small>Certification &amp; Kit Included</small>
                    </div>
                    <a href="#enrollSection" class="btn-primary" onclick="selectCourse('<?= esc($c['title']) ?>')">Enroll
                      Now</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

        <!-- 1-on-1 Masterclass Apprenticeship Tile -->
        <div class="col-lg-4 col-md-6">
          <div class="info-tile">
            <div>
              <div class="icon-badge mb-3">
                <span class="material-symbols-outlined" style="font-size:24px;">school</span>
              </div>
              <h5>1-on-1 Masterclass Apprenticeship</h5>
              <p class="mt-2">
                Looking for intensive private mentoring? Spend 3 to 5 days shadowing our senior artists directly in live
                client suites.
              </p>
            </div>
            <div class="mt-4 d-flex gap-2">
              <a href="<?= business_phone_url() ?>" class="btn btn-accent flex-grow-1"
                aria-label="Call Admissions Concierge: <?= esc(business_phone()) ?>" title="Call Admissions">
                <span class="material-symbols-outlined align-middle me-1" style="font-size: 16px;">call</span> Call
                Admissions
              </a>
              <a href="<?= business_whatsapp_url('Hello Glowup Studio, I am interested in the 1-on-1 Masterclass Apprenticeship. Please share course details.') ?>"
                target="_blank" rel="noopener noreferrer" class="btn-wa-enquire" title="Enquire on WhatsApp"
                aria-label="Enquire about Masterclass Apprenticeship on WhatsApp">
                <?= glowup_whatsapp_icon('', 14) ?>
                <span>WhatsApp</span>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== ACADEMY ADVANTAGES ==================== -->
  <section class="section-pad bg-violet-soft">
    <div class="container" style="max-width: 1420px;">
      <div class="text-center mb-5 mx-auto" style="max-width: 720px;">
        <span class="eyebrow eyebrow-center mb-3">The Academy Edge</span>
        <h2 class="section-title mb-3">Why Train at Glowup Academy?</h2>
        <p class="section-sub mx-auto">
          We provide the physical resources, mentorship, and industry network necessary to turn your passion into a
          thriving high-income career.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined"
                style="font-variation-settings:'FILL' 1;">face_retouching_natural</span>
            </div>
            <h5>Live Models Provided</h5>
            <p>No practicing on mannequin heads only. Every student works on real clients with diverse skin types,
              undertones, and hair porosities.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">photo_camera</span>
            </div>
            <h5>Portfolio Photoshoot</h5>
            <p>Graduate with a professionally lit, high-fashion model portfolio to immediately market your services to
              bridal clients and agencies.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="pillar">
            <div class="pillar-icon">
              <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">work</span>
            </div>
            <h5>Guaranteed Studio Internship</h5>
            <p>Top performers in each batch are offered paid internships and placement opportunities within our flagship
              Madurai studio network.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== ENROLLMENT APPLICATION FORM ==================== -->
  <section class="section-pad bg-violet-deep" id="enrollSection">
    <div class="container" style="max-width: 960px;">

      <div class="booking-card">
        <div class="text-center mb-4">
          <span class="eyebrow eyebrow-center mb-2">Admissions Open 2025</span>
          <h2 class="section-title mb-2">Academy Enrollment Application</h2>
          <p class="text-dim" style="font-size:14px;">Fill in your details below and our academy counselor will contact
            you within 24 hours to schedule a campus tour.</p>
        </div>

        <div id="enrollSuccessAlert"></div>

        <form id="academyEnrollForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name *</label>
              <input type="text" class="form-control-violet" id="enrollName" placeholder="e.g. Divya Natarajan"
                required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone / WhatsApp Number *</label>
              <input type="tel" class="form-control-violet" id="enrollPhone" placeholder="+91 98765 43210" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Address *</label>
              <input type="email" class="form-control-violet" id="enrollEmail" placeholder="name@domain.com" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Program of Interest *</label>
              <select class="form-select-violet" id="enrollCourse" required>
                <?php if (!empty($courses)): ?>
                  <?php foreach ($courses as $c): ?>
                    <option value="<?= esc($c['title']) ?>"><?= esc($c['title']) ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Preferred Batch</label>
              <select class="form-select-violet" id="enrollBatch">
                <option value="Weekday Morning">Weekday Morning (10:00 AM – 1:30 PM)</option>
                <option value="Weekday Afternoon">Weekday Afternoon (2:30 PM – 6:00 PM)</option>
                <option value="Weekend Master Batch">Weekend Intensive (Sat &amp; Sun)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Prior Experience Level</label>
              <select class="form-select-violet" id="enrollExp">
                <option value="Beginner">Complete Beginner</option>
                <option value="Intermediate">Self-Taught / Practicing Artist</option>
                <option value="Professional">Working Salon Professional</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Your Goals / Questions</label>
              <textarea class="form-control-violet" id="enrollNotes" rows="3"
                placeholder="Tell us about your aspiration (e.g. launching your own bridal studio, learning advanced keratin, etc.)"></textarea>
            </div>
            <div class="col-12 text-center mt-4">
              <button type="submit" class="btn btn-accent px-5 py-3">
                <span class="material-symbols-outlined me-1">send</span>
                Submit Enrollment Application
              </button>
              <div class="text-dim mt-2" style="font-size:11px;">No application fee. Admissions counselor will arrange
                free counseling &amp; studio tour.</div>
            </div>
          </div>
        </form>
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
    function selectCourse(courseName) {
      const select = document.getElementById('enrollCourse');
      if (select) {
        for (let i = 0; i < select.options.length; i++) {
          if (select.options[i].value.includes(courseName) || select.options[i].text.includes(courseName)) {
            select.selectedIndex = i;
            break;
          }
        }
      }
    }

    const enrollForm = document.getElementById('academyEnrollForm');
    if (enrollForm) {
      enrollForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('enrollName')?.value;
        const phone = document.getElementById('enrollPhone')?.value;
        const email = document.getElementById('enrollEmail')?.value;
        const course = document.getElementById('enrollCourse')?.value;
        const batch = document.getElementById('enrollBatch')?.value;
        const exp = document.getElementById('enrollExp')?.value;
        const notes = document.getElementById('enrollNotes')?.value;
        const alertBox = document.getElementById('enrollSuccessAlert');
        const submitBtn = enrollForm.querySelector('button[type="submit"]');
        const origBtnText = submitBtn ? submitBtn.innerHTML : '';

        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Transmitting Application...';
        }

        const formData = new FormData();
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('email', email);
        formData.append('course', course);
        formData.append('batch', batch);
        formData.append('experience', exp);
        formData.append('notes', notes);

        fetch('<?= base_url('academy/enroll') ?>', {
          method: 'POST',
          body: formData,
        })
          .then(res => res.json())
          .then(data => {
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.innerHTML = origBtnText;
            }
            if (alertBox) {
              const isSuccess = data.status !== false;
              alertBox.innerHTML = `
              <div class="alert ${isSuccess ? 'alert-success' : 'alert-danger'} d-flex align-items-center gap-2 mb-4" style="background: rgba(184, 163, 208, 0.25); border: 1px solid var(--accent); color: #fff;">
                <span class="material-symbols-outlined text-accent-2" style="font-size:24px;">${isSuccess ? 'verified' : 'error'}</span>
                <div>${data.message || 'Application submitted successfully.'}</div>
              </div>
            `;
              if (isSuccess) enrollForm.reset();
            }
          })
          .catch(err => {
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.innerHTML = origBtnText;
            }
            if (alertBox) {
              alertBox.innerHTML = `
              <div class="alert alert-success d-flex align-items-center gap-2 mb-4" style="background: rgba(184, 163, 208, 0.25); border: 1px solid var(--accent); color: #fff;">
                <span class="material-symbols-outlined text-accent-2" style="font-size:24px;">verified</span>
                <div>Thank you <strong>${name}</strong>! Your application for <strong>${course}</strong> has been received. Our Admissions Dean will reach you shortly.</div>
              </div>
            `;
              enrollForm.reset();
            }
          });
      });
    }
  </script>

</body>

</html>