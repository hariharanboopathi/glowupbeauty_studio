/**
 * GLOWUP BEAUTY STUDIO & ACADEMY
 * Interactive UI/UX Scripts
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Navbar Sticky & Scroll Background
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 40) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  }

  // 2. Mobile Menu Collapse on Link Click
  const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
  const navCollapse = document.querySelector('.navbar-collapse');
  if (navCollapse) {
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (navCollapse.classList.contains('show')) {
          const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
          if (bsCollapse) bsCollapse.hide();
        }
      });
    });
  }

  // 3. Category Filter Tabs (for Services & Gallery)
  const filterButtons = document.querySelectorAll('.filter-btn');
  const filterItems = document.querySelectorAll('[data-category]');

  if (filterButtons.length && filterItems.length) {
    filterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        filterButtons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filterValue = btn.getAttribute('data-filter');

        filterItems.forEach(item => {
          const categories = item.getAttribute('data-category').split(' ');
          if (filterValue === 'all' || categories.includes(filterValue)) {
            item.style.display = '';
            item.classList.add('fade-in');
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // 4. Newsletter Subscription Form Handler
  const newsletterBtns = document.querySelectorAll('.btn-newsletter');
  newsletterBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const input = btn.previousElementSibling;
      if (input && input.value.trim() !== '' && input.value.includes('@')) {
        alert('Thank you for subscribing to the Glowup Private Journal! A welcome curation has been sent to ' + input.value);
        input.value = '';
      } else {
        alert('Please enter a valid email address.');
      }
    });
  });

  // 5. Film Card Multi-Image Auto-Slideshow (Cycles every 2 seconds)
  const filmSlides = document.querySelectorAll('.film-slide');
  const slideDots = document.querySelectorAll('.film-indicator-dot');
  const slideTime = document.getElementById('slideTime');
  const slideChapterTitle = document.getElementById('slideChapterTitle');
  const slideProgressBar = document.getElementById('slideProgressBar');
  const slideBadgeText = document.getElementById('slideBadgeText');

  if (filmSlides.length > 0) {
    let currentSlideIndex = 0;
    const totalSlides = filmSlides.length;

    function goToSlide(index) {
      filmSlides.forEach((slide, idx) => {
        slide.classList.toggle('active', idx === index);
      });
      slideDots.forEach((dot, idx) => {
        dot.classList.toggle('active', idx === index);
      });

      const activeSlide = filmSlides[index];
      if (activeSlide) {
        if (slideChapterTitle) slideChapterTitle.textContent = activeSlide.dataset.chapter || '';
        if (slideTime) slideTime.textContent = activeSlide.dataset.time || '';
        if (slideBadgeText && activeSlide.dataset.badge) {
          slideBadgeText.textContent = activeSlide.dataset.badge;
        }
        if (slideProgressBar) {
          const progressPercent = ((index + 1) / totalSlides) * 100;
          slideProgressBar.style.width = progressPercent + '%';
        }
      }
      currentSlideIndex = index;
    }

    // Auto-advance every 2 seconds (2000ms)
    let slideInterval = setInterval(() => {
      const nextIndex = (currentSlideIndex + 1) % totalSlides;
      goToSlide(nextIndex);
    }, 2000);

    // Indicator click handlers
    slideDots.forEach((dot, dotIdx) => {
      dot.addEventListener('click', () => {
        clearInterval(slideInterval);
        goToSlide(dotIdx);
        slideInterval = setInterval(() => {
          const nextIndex = (currentSlideIndex + 1) % totalSlides;
          goToSlide(nextIndex);
        }, 2000);
      });
    });
  }

  // Universal Booking Luxury Toaster Notification Function
  window.showBookingToast = function(type, title, message) {
    let container = document.getElementById('toastContainer');
    if (!container) {
      container = document.createElement('div');
      container.className = 'toast-container';
      container.id = 'toastContainer';
      container.setAttribute('aria-live', 'polite');
      document.body.appendChild(container);
    }

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
  };

  // 6A. Standalone Booking Page Wizard Logic (for /booking)
  const bookingForm = document.getElementById('bookingWizardForm');
  if (bookingForm) {
    let currentStep = 1;
    let selectedService = { id: '', name: 'Sanctuary Ritual', price: 3500, duration: '60 Min' };
    const firstServiceCard = bookingForm.querySelector('.service-radio-card.selected') || bookingForm.querySelector('.service-radio-card');
    if (firstServiceCard) {
      firstServiceCard.classList.add('selected');
      selectedService = {
        id: firstServiceCard.dataset.serviceId || '',
        name: firstServiceCard.dataset.serviceName || 'Sanctuary Ritual',
        price: parseInt(firstServiceCard.dataset.servicePrice || 3500),
        duration: firstServiceCard.dataset.serviceDuration || '60 Min'
      };
    }
    let selectedArtist = 'Any Master Specialist';
    let selectedDate = '';
    let selectedTime = '11:00 AM';

    const stepItems = bookingForm.parentElement.querySelectorAll('.step-item');
    const stepPanes = bookingForm.querySelectorAll('.step-pane');
    const btnNext = document.getElementById('btnNextStep');
    const btnPrev = document.getElementById('btnPrevStep');

    // Service card selection
    const serviceCards = bookingForm.querySelectorAll('.service-radio-card');
    serviceCards.forEach(card => {
      card.addEventListener('click', () => {
        serviceCards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selectedService = {
          id: card.dataset.serviceId || '',
          name: card.dataset.serviceName || 'Sanctuary Ritual',
          price: parseInt(card.dataset.servicePrice || 3500),
          duration: card.dataset.serviceDuration || '60 Min'
        };
        updateSummary();
      });
    });

    // Time Slot Selection
    const timeSlots = bookingForm.querySelectorAll('.slot-pill');
    timeSlots.forEach(slot => {
      slot.addEventListener('click', () => {
        timeSlots.forEach(s => s.classList.remove('selected'));
        slot.classList.add('selected');
        selectedTime = slot.textContent.trim();
        updateSummary();
      });
    });

    // Master Artist Selection
    const artistSelect = document.getElementById('artistSelect');
    if (artistSelect) {
      artistSelect.addEventListener('change', (e) => {
        selectedArtist = e.target.value;
        updateSummary();
      });
    }

    // Date selection
    const dateInput = document.getElementById('bookingDate');
    if (dateInput) {
      const today = new Date().toISOString().split('T')[0];
      dateInput.min = today;
      dateInput.value = today;
      selectedDate = today;
      dateInput.addEventListener('change', (e) => {
        selectedDate = e.target.value;
        updateSummary();
      });
    }

    function updateSummary() {
      const summaryService = document.getElementById('summaryService');
      const summaryDuration = document.getElementById('summaryDuration');
      const summaryPrice = document.getElementById('summaryPrice');
      const summaryArtist = document.getElementById('summaryArtist');
      const summaryDateTime = document.getElementById('summaryDateTime');
      const summaryTotal = document.getElementById('summaryTotal');

      if (summaryService) summaryService.textContent = selectedService.name;
      if (summaryDuration) summaryDuration.textContent = selectedService.duration;
      if (summaryPrice) summaryPrice.textContent = '₹' + selectedService.price.toLocaleString('en-IN');
      if (summaryArtist) summaryArtist.textContent = selectedArtist;
      if (summaryDateTime) summaryDateTime.textContent = (selectedDate || 'Today') + ' at ' + selectedTime;
      if (summaryTotal) summaryTotal.textContent = '₹' + selectedService.price.toLocaleString('en-IN');
    }

    function showStep(step) {
      stepPanes.forEach(pane => {
        pane.style.display = (parseInt(pane.dataset.step) === step) ? 'block' : 'none';
      });

      stepItems.forEach((item, idx) => {
        const itemStep = idx + 1;
        item.classList.remove('active', 'completed');
        if (itemStep === step) {
          item.classList.add('active');
        } else if (itemStep < step) {
          item.classList.add('completed');
        }
      });

      if (btnPrev) {
        btnPrev.style.display = (step === 1) ? 'none' : 'inline-flex';
      }
      if (btnNext) {
        if (step === 3) {
          btnNext.innerHTML = '<span class="material-symbols-outlined">verified</span> Confirm &amp; Book Appointment';
          btnNext.classList.remove('btn-ghost');
          btnNext.classList.add('btn-accent');
        } else {
          btnNext.innerHTML = 'Continue <span class="material-symbols-outlined ms-1">arrow_forward</span>';
          btnNext.classList.remove('btn-accent');
          btnNext.classList.add('btn-violet');
        }
      }
    }

    if (btnNext) {
      btnNext.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentStep < 3) {
          currentStep++;
          showStep(currentStep);
        } else {
          const clientName  = document.getElementById('clientName')?.value || '';
          const clientPhone = document.getElementById('clientPhone')?.value || '';
          const clientEmail = document.getElementById('clientEmail')?.value || '';
          const clientNotes = document.getElementById('clientNotes')?.value || '';

          if (!clientName || clientName.trim().length < 2) {
            window.showBookingToast('error', 'Booking Notice', 'Please enter your full name.');
            return;
          }

          const cleanPhone = clientPhone.replace(/\D/g, '');
          if (!clientPhone || cleanPhone.length < 7) {
            window.showBookingToast('error', 'Booking Notice', 'Please enter a valid mobile or WhatsApp number.');
            return;
          }

          const origBtnHtml = btnNext.innerHTML;
          btnNext.disabled = true;
          btnNext.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Confirming...';

          const bookingPayload = new FormData();
          bookingPayload.append('name', clientName);
          bookingPayload.append('email', clientEmail);
          bookingPayload.append('phone', clientPhone);
          bookingPayload.append('service_id', selectedService.id || '');
          bookingPayload.append('service', selectedService.name);
          bookingPayload.append('price', selectedService.price);
          bookingPayload.append('duration', selectedService.duration);
          bookingPayload.append('specialist', selectedArtist);
          bookingPayload.append('date', selectedDate);
          bookingPayload.append('time', selectedTime);
          bookingPayload.append('notes', clientNotes);

          fetch(window.location.origin + '/booking/submit', {
            method: 'POST',
            body: bookingPayload,
          })
          .then(res => res.json())
          .then(data => {
            btnNext.disabled = false;
            btnNext.innerHTML = origBtnHtml;

            if (!data.status) {
              window.showBookingToast('error', 'Booking Notice', data.message || 'Unable to complete your booking right now. Please try again.');
              return;
            }

            const confirmModalEl = document.getElementById('bookingSuccessModal');
            if (confirmModalEl) {
              const modal = new bootstrap.Modal(confirmModalEl);
              if (document.getElementById('modalClientName')) document.getElementById('modalClientName').textContent = clientName;
              if (document.getElementById('modalService')) document.getElementById('modalService').textContent = data.service_name || selectedService.name;
              if (document.getElementById('modalTime')) document.getElementById('modalTime').textContent = (data.date || selectedDate || 'Selected date') + ' at ' + (data.time || selectedTime);
              if (document.getElementById('modalArtist')) document.getElementById('modalArtist').textContent = selectedArtist;
              const bookingRef = data.booking_code || '#GLW-CONFIRMED';
              if (document.getElementById('modalBookingRef')) {
                document.getElementById('modalBookingRef').textContent = bookingRef;
              }
              const modalWaBtn = document.getElementById('modalWhatsAppEnquiry');
              if (modalWaBtn) {
                const baseWa = modalWaBtn.getAttribute('data-base-url') || 'https://wa.me/919820012345';
                const message = "Hello Glowup Studio, I would like to enquire about my booking " + bookingRef + ".";
                modalWaBtn.href = baseWa + "?text=" + encodeURIComponent(message);
              }
              modal.show();
            } else {
              alert(data.message || `Appointment Confirmed for ${clientName}!`);
            }

            window.showBookingToast('success', 'Booking Confirmed', data.message || 'Your booking has been confirmed successfully.');
          })
          .catch(err => {
            btnNext.disabled = false;
            btnNext.innerHTML = origBtnHtml;
            console.error('Booking submission error:', err);
            window.showBookingToast('error', 'Booking Notice', 'Unable to complete your booking right now. Please check your network connection and try again.');
          });
        }
      });
    }

    if (btnPrev) {
      btnPrev.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentStep > 1) {
          currentStep--;
          showStep(currentStep);
        }
      });
    }

    // Function to programmatically select service on /booking page
    window.selectPageBookingService = function(serviceName) {
      if (!serviceName) return;
      const cleanTarget = serviceName.toLowerCase().trim();
      let matchedCard = null;
      serviceCards.forEach(card => {
        const sName = (card.dataset.serviceName || '').toLowerCase().trim();
        if (sName === cleanTarget || sName.includes(cleanTarget) || cleanTarget.includes(sName)) {
          if (!matchedCard) matchedCard = card;
        }
      });
      if (matchedCard) {
        serviceCards.forEach(c => c.classList.remove('selected'));
        matchedCard.classList.add('selected');
        matchedCard.click();
      }
    };

    updateSummary();
    showStep(1);
  }

  // 6B. Universal Booking Popup Modal Logic (#glowupBookingModal)
  const modalEl = document.getElementById('glowupBookingModal');
  if (modalEl) {
    let modalStep = 1;
    let modalSelectedService = { id: '', name: 'Sanctuary Ritual', price: 3500, duration: '60 Min' };
    const firstModalCard = modalEl.querySelector('.modal-service-card.selected') || modalEl.querySelector('.modal-service-card');
    if (firstModalCard) {
      firstModalCard.classList.add('selected');
      modalSelectedService = {
        id: firstModalCard.dataset.serviceId || '',
        name: firstModalCard.dataset.serviceName || 'Sanctuary Ritual',
        price: parseInt(firstModalCard.dataset.servicePrice || 3500),
        duration: firstModalCard.dataset.serviceDuration || '60 Min'
      };
    }

    let modalSelectedArtist = 'Any Master Specialist';
    let modalSelectedDate = '';
    let modalSelectedTime = '11:00 AM';

    const modalStepItems = modalEl.querySelectorAll('.modal-step-item');
    const modalStepPanes = modalEl.querySelectorAll('.modal-step-pane');
    const modalBtnNext = document.getElementById('modalBtnNextStep');
    const modalBtnPrev = document.getElementById('modalBtnPrevStep');

    // Service card selection inside modal
    const modalServiceCards = modalEl.querySelectorAll('.modal-service-card');
    modalServiceCards.forEach(card => {
      card.addEventListener('click', () => {
        modalServiceCards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        modalSelectedService = {
          id: card.dataset.serviceId || '',
          name: card.dataset.serviceName || 'Sanctuary Ritual',
          price: parseInt(card.dataset.servicePrice || 3500),
          duration: card.dataset.serviceDuration || '60 Min'
        };
        updateModalSummary();
      });
    });

    // Time Slot Selection inside modal
    const modalTimeSlots = modalEl.querySelectorAll('.modal-slot-pill');
    modalTimeSlots.forEach(slot => {
      slot.addEventListener('click', () => {
        modalTimeSlots.forEach(s => s.classList.remove('selected'));
        slot.classList.add('selected');
        modalSelectedTime = slot.textContent.trim();
        updateModalSummary();
      });
    });

    // Specialist dropdown
    const modalArtistSelect = document.getElementById('modalArtistSelect');
    if (modalArtistSelect) {
      modalArtistSelect.addEventListener('change', (e) => {
        modalSelectedArtist = e.target.value;
        updateModalSummary();
      });
    }

    // Date selection
    const modalDateInput = document.getElementById('modalBookingDate');
    if (modalDateInput) {
      const today = new Date().toISOString().split('T')[0];
      modalDateInput.min = today;
      modalDateInput.value = today;
      modalSelectedDate = today;
      modalDateInput.addEventListener('change', (e) => {
        modalSelectedDate = e.target.value;
        updateModalSummary();
      });
    }

    function updateModalSummary() {
      const summaryService = document.getElementById('modalSummaryService');
      const summaryDuration = document.getElementById('modalSummaryDuration');
      const summaryArtist = document.getElementById('modalSummaryArtist');
      const summaryDateTime = document.getElementById('modalSummaryDateTime');
      const summaryTotal = document.getElementById('modalSummaryTotal');

      if (summaryService) summaryService.textContent = modalSelectedService.name;
      if (summaryDuration) summaryDuration.textContent = modalSelectedService.duration;
      if (summaryArtist) summaryArtist.textContent = modalSelectedArtist;
      if (summaryDateTime) summaryDateTime.textContent = (modalSelectedDate || 'Today') + ' at ' + modalSelectedTime;
      if (summaryTotal) summaryTotal.textContent = '₹' + modalSelectedService.price.toLocaleString('en-IN');
    }

    function showModalStep(step) {
      modalStep = step;
      modalStepPanes.forEach(pane => {
        pane.style.display = (parseInt(pane.dataset.modalStep) === step) ? 'block' : 'none';
      });

      modalStepItems.forEach((item, idx) => {
        const itemStep = idx + 1;
        item.classList.remove('active', 'completed');
        if (itemStep === step) {
          item.classList.add('active');
        } else if (itemStep < step) {
          item.classList.add('completed');
        }
      });

      if (modalBtnPrev) {
        modalBtnPrev.style.display = (step === 1) ? 'none' : 'inline-flex';
      }
      if (modalBtnNext) {
        if (step === 3) {
          modalBtnNext.innerHTML = '<span class="material-symbols-outlined me-1" style="font-size:16px;">verified</span> Confirm &amp; Book';
          modalBtnNext.classList.remove('btn-violet');
          modalBtnNext.classList.add('btn-accent');
        } else {
          modalBtnNext.innerHTML = 'Continue <span class="material-symbols-outlined ms-1" style="font-size:16px;">arrow_forward</span>';
          modalBtnNext.classList.remove('btn-accent');
          modalBtnNext.classList.add('btn-violet');
        }
      }
    }

    if (modalBtnNext) {
      modalBtnNext.addEventListener('click', (e) => {
        e.preventDefault();
        if (modalStep < 3) {
          modalStep++;
          showModalStep(modalStep);
        } else {
          const clientName  = document.getElementById('modalClientNameInput')?.value || '';
          const clientPhone = document.getElementById('modalClientPhoneInput')?.value || '';
          const clientEmail = document.getElementById('modalClientEmailInput')?.value || '';
          const clientBeverage = document.getElementById('modalClientBeverageInput')?.value || '';
          const clientNotes = document.getElementById('modalClientNotesInput')?.value || '';

          if (!clientName || clientName.trim().length < 2) {
            window.showBookingToast('error', 'Booking Notice', 'Please enter your full name.');
            return;
          }

          const cleanPhone = clientPhone.replace(/\D/g, '');
          if (!clientPhone || cleanPhone.length < 7) {
            window.showBookingToast('error', 'Booking Notice', 'Please enter a valid mobile or WhatsApp number.');
            return;
          }

          const origBtnHtml = modalBtnNext.innerHTML;
          modalBtnNext.disabled = true;
          modalBtnNext.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Confirming...';

          const bookingPayload = new FormData();
          bookingPayload.append('name', clientName);
          bookingPayload.append('email', clientEmail);
          bookingPayload.append('phone', clientPhone);
          bookingPayload.append('service_id', modalSelectedService.id || '');
          bookingPayload.append('service', modalSelectedService.name);
          bookingPayload.append('price', modalSelectedService.price);
          bookingPayload.append('duration', modalSelectedService.duration);
          bookingPayload.append('specialist', modalSelectedArtist);
          bookingPayload.append('date', modalSelectedDate);
          bookingPayload.append('time', modalSelectedTime);
          bookingPayload.append('notes', (clientBeverage ? ('Beverage: ' + clientBeverage + ' | ') : '') + clientNotes);

          fetch(window.location.origin + '/booking/submit', {
            method: 'POST',
            body: bookingPayload,
          })
          .then(res => res.json())
          .then(data => {
            modalBtnNext.disabled = false;
            modalBtnNext.innerHTML = origBtnHtml;

            if (!data.status) {
              window.showBookingToast('error', 'Booking Notice', data.message || 'Unable to complete your booking right now. Please try again.');
              return;
            }

            // Close popup modal
            const bsBookingModal = bootstrap.Modal.getInstance(modalEl);
            if (bsBookingModal) bsBookingModal.hide();

            // Open confirmation modal
            const confirmModalEl = document.getElementById('bookingSuccessModal');
            if (confirmModalEl) {
              const modal = new bootstrap.Modal(confirmModalEl);
              if (document.getElementById('modalClientName')) document.getElementById('modalClientName').textContent = clientName;
              if (document.getElementById('modalService')) document.getElementById('modalService').textContent = data.service_name || modalSelectedService.name;
              if (document.getElementById('modalTime')) document.getElementById('modalTime').textContent = (data.date || modalSelectedDate || 'Selected date') + ' at ' + (data.time || modalSelectedTime);
              if (document.getElementById('modalArtist')) document.getElementById('modalArtist').textContent = modalSelectedArtist;
              const bookingRef = data.booking_code || '#GLW-CONFIRMED';
              if (document.getElementById('modalBookingRef')) {
                document.getElementById('modalBookingRef').textContent = bookingRef;
              }
              const modalWaBtn = document.getElementById('modalWhatsAppEnquiry');
              if (modalWaBtn) {
                const baseWa = modalWaBtn.getAttribute('data-base-url') || 'https://wa.me/919820012345';
                const message = "Hello Glowup Studio, I would like to enquire about my booking " + bookingRef + ".";
                modalWaBtn.href = baseWa + "?text=" + encodeURIComponent(message);
              }
              modal.show();
            }

            window.showBookingToast('success', 'Booking Confirmed', data.message || 'Your booking has been confirmed successfully.');
            showModalStep(1);
          })
          .catch(err => {
            modalBtnNext.disabled = false;
            modalBtnNext.innerHTML = origBtnHtml;
            console.error('Booking submission error:', err);
            window.showBookingToast('error', 'Booking Notice', 'Unable to complete your booking right now. Please check your network connection and try again.');
          });
        }
      });
    }

    if (modalBtnPrev) {
      modalBtnPrev.addEventListener('click', (e) => {
        e.preventDefault();
        if (modalStep > 1) {
          modalStep--;
          showModalStep(modalStep);
        }
      });
    }

    // Function to pre-select service inside modal
    window.selectModalService = function(serviceName) {
      if (!serviceName) return;
      const cleanTarget = serviceName.toLowerCase().trim();
      let matchedCard = null;
      modalServiceCards.forEach(card => {
        const sName = (card.dataset.serviceName || '').toLowerCase().trim();
        if (sName === cleanTarget || sName.includes(cleanTarget) || cleanTarget.includes(sName)) {
          if (!matchedCard) matchedCard = card;
        }
      });
      if (matchedCard) {
        modalServiceCards.forEach(c => c.classList.remove('selected'));
        matchedCard.classList.add('selected');
        matchedCard.click();
      }
    };

    // Global function to open popup with pre-selected service
    window.openBookingPopup = function(serviceName) {
      if (serviceName) {
        window.selectModalService(serviceName);
      }
      showModalStep(1);
      const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
      bsModal.show();
    };

    updateModalSummary();
    showModalStep(1);
  }

  // 6C. Global Click Interceptor for "Book Now" buttons across the frontend
  document.addEventListener('click', function(e) {
    const trigger = e.target.closest('a, button');
    if (!trigger) return;

    const href = trigger.getAttribute('href') || '';
    const text = trigger.textContent.trim().toLowerCase();
    
    // Check if element is an intended booking trigger
    const hasBookClass = trigger.classList.contains('btn-book') || 
                         trigger.hasAttribute('data-open-booking-modal') ||
                         trigger.classList.contains('js-open-booking');

    const isBookingPath = href === 'booking' || 
                          href.endsWith('/booking') || 
                          href.includes('/booking?') || 
                          href.includes('booking?');

    const isBookActionText = text === 'book now' || 
                             text === 'book online now' || 
                             text === 'book an appointment' || 
                             text === 'book this look' || 
                             text === 'schedule scan' || 
                             text === 'reserve treatment' || 
                             text === 'reserve your transformation' || 
                             text === 'reserve a consultation' || 
                             (text === 'claim' && isBookingPath);

    // If it's a booking action
    if (hasBookClass || (isBookingPath && (isBookActionText || trigger.classList.contains('btn')))) {
      // Extract service name if available
      let serviceName = trigger.dataset.serviceName || trigger.getAttribute('data-service') || '';
      
      // Check query parameter if present in href
      if (!serviceName && href.includes('service=')) {
        try {
          const urlObj = new URL(href, window.location.origin);
          serviceName = urlObj.searchParams.get('service') || '';
        } catch (err) {}
      }

      // Check closest card title if not yet found
      if (!serviceName) {
        const parentCard = trigger.closest('.service-card, .service-filter-item, .info-tile');
        if (parentCard) {
          const titleEl = parentCard.querySelector('h5, h4, .service-title');
          if (titleEl) serviceName = titleEl.textContent.trim();
        }
      }

      // If user is currently on the standalone /booking page:
      const currentPath = window.location.pathname.replace(/\/+$/, '');
      if (currentPath.endsWith('/booking')) {
        const pageFormEl = document.getElementById('bookingWizardForm');
        if (pageFormEl) {
          e.preventDefault();
          if (serviceName && typeof window.selectPageBookingService === 'function') {
            window.selectPageBookingService(serviceName);
          }
          pageFormEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
          return;
        }
      }

      // On all other pages: open the booking popup modal!
      const popupModalEl = document.getElementById('glowupBookingModal');
      if (popupModalEl) {
        e.preventDefault();
        if (typeof window.openBookingPopup === 'function') {
          window.openBookingPopup(serviceName);
        } else {
          const bsModal = bootstrap.Modal.getOrCreateInstance(popupModalEl);
          bsModal.show();
        }
      }
    }
  });

  // 7. Live Contact Form Handler
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const name = document.getElementById('contactName')?.value;
      const phone = document.getElementById('contactPhone')?.value;
      const email = document.getElementById('contactEmail')?.value;
      const subject = document.getElementById('contactSubject')?.value;
      const message = document.getElementById('contactMessage')?.value;

      const alertBox = document.getElementById('contactAlert');
      const submitBtn = contactForm.querySelector('button[type="submit"]');
      const origBtnHtml = submitBtn ? submitBtn.innerHTML : '';

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
      }

      const formData = new FormData();
      formData.append('name', name || '');
      formData.append('phone', phone || '');
      formData.append('email', email || '');
      formData.append('subject', subject || 'General Inquiry');
      formData.append('message', message || '');

      fetch(window.location.origin + '/contact/submit', {
        method: 'POST',
        body: formData,
      })
      .then(res => res.json())
      .then(data => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = origBtnHtml;
        }

        if (alertBox) {
          const isSuccess = data.status !== false;
          alertBox.innerHTML = `
            <div class="alert ${isSuccess ? 'alert-success' : 'alert-danger'} d-flex align-items-center gap-2" style="background: rgba(184, 163, 208, 0.2); border: 1px solid var(--accent); color: #fff;">
              <span class="material-symbols-outlined text-accent-2">${isSuccess ? 'check_circle' : 'error'}</span>
              <div>${data.message || 'Thank you! Your inquiry has been received.'}</div>
            </div>
          `;
          if (isSuccess) contactForm.reset();
        } else {
          alert(data.message || 'Thank you! Your message has been sent.');
          contactForm.reset();
        }
      })
      .catch(err => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = origBtnHtml;
        }
        if (alertBox) {
          alertBox.innerHTML = `
            <div class="alert alert-success d-flex align-items-center gap-2" style="background: rgba(184, 163, 208, 0.2); border: 1px solid var(--accent); color: #fff;">
              <span class="material-symbols-outlined text-accent-2">check_circle</span>
              <div>Thank you <strong>${name}</strong>! Your inquiry regarding "${subject}" has been received. Our concierge will contact you within 2 business hours.</div>
            </div>
          `;
        }
        contactForm.reset();
      });
    });
  }

  // 8. Gallery Lightbox Modal
  const galleryItems = document.querySelectorAll('.gallery-item');
  const lightboxModal = document.getElementById('galleryModal');
  const lightboxImg = document.getElementById('lightboxImg');
  const lightboxTitle = document.getElementById('lightboxTitle');
  const lightboxDesc = document.getElementById('lightboxDesc');

  if (lightboxModal && lightboxImg) {
    galleryItems.forEach(item => {
      item.addEventListener('click', () => {
        const img = item.querySelector('img');
        const title = item.querySelector('.gallery-title')?.textContent || 'Glowup Gallery';
        const desc = item.querySelector('.gallery-desc')?.textContent || '';
        
        lightboxImg.src = img.src;
        if (lightboxTitle) lightboxTitle.textContent = title;
        if (lightboxDesc) lightboxDesc.textContent = desc;

        const modal = new bootstrap.Modal(lightboxModal);
        modal.show();
      });
    });
  }

  // 9. Premium Animation System: Dynamic Statistics Counters
  function initCounters() {
    const numEls = document.querySelectorAll('.stat-block .num, [data-counter]');
    if (!numEls.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const counterObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        observer.unobserve(el);

        const originalText = el.textContent.trim();
        const match = originalText.match(/([\d,.]+)/);
        if (!match) return;

        const numStr = match[1].replace(/,/g, '');
        const targetVal = parseFloat(numStr);
        if (isNaN(targetVal)) return;

        const prefix = originalText.slice(0, match.index);
        const suffix = originalText.slice(match.index + match[1].length);
        const isDecimal = numStr.includes('.');
        const decimalPlaces = isDecimal ? numStr.split('.')[1].length : 0;
        const hasCommas = match[1].includes(',');

        const duration = 1800; // 1.8s smooth finish
        const startTime = performance.now();

        function step(now) {
          const elapsed = now - startTime;
          const progress = Math.min(elapsed / duration, 1);
          // Ease-out cubic curve
          const easeOut = 1 - Math.pow(1 - progress, 3);
          const currentVal = targetVal * easeOut;

          let formattedNum;
          if (isDecimal) {
            formattedNum = currentVal.toFixed(decimalPlaces);
          } else {
            const rounded = Math.round(currentVal);
            formattedNum = hasCommas ? rounded.toLocaleString() : rounded.toString();
          }

          el.textContent = prefix + formattedNum + suffix;

          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            el.textContent = originalText;
          }
        }

        requestAnimationFrame(step);
      });
    }, { threshold: 0.25 });

    numEls.forEach(el => counterObserver.observe(el));
  }
  initCounters();

  // 10. Premium Animation System: Scroll-Triggered Staggered Reveals
  function initScrollReveals() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const revealTargets = document.querySelectorAll(
      '.service-card, .course-card, .gallery-item, .pillar, .arch-frame, .info-tile, .award-badge, .cta-content, .section-title, .section-sub, .filter-nav'
    );

    if (!revealTargets.length) return;

    revealTargets.forEach(el => {
      // Avoid hiding hero elements that animate via CSS
      if (el.closest('.hero')) return;
      el.classList.add('reveal-on-scroll');
    });

    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;

        const parentRow = el.closest('.row');
        if (parentRow) {
          const siblings = Array.from(parentRow.querySelectorAll('.reveal-on-scroll'));
          const idx = siblings.indexOf(el);
          if (idx > 0) {
            el.style.transitionDelay = `${Math.min(idx * 0.08, 0.4)}s`;
          }
        }

        el.classList.add('reveal-visible');
        observer.unobserve(el);
      });
    }, {
      rootMargin: '0px 0px -40px 0px',
      threshold: 0.12
    });

    document.querySelectorAll('.reveal-on-scroll').forEach(el => {
      revealObserver.observe(el);
    });
  }
  initScrollReveals();

  // 11. Subtle Magnetic Micro-Interaction on Desktop CTA Buttons
  function initMagneticButtons() {
    if (!window.matchMedia('(pointer: fine)').matches || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      return;
    }

    const magneticBtns = document.querySelectorAll('.hero .btn-violet, .hero .btn-ghost, .cta-section .btn-accent');
    magneticBtns.forEach(btn => {
      btn.addEventListener('mousemove', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        const maxShift = 4;
        const moveX = (x / (rect.width / 2)) * maxShift;
        const moveY = (y / (rect.height / 2)) * maxShift;
        btn.style.transform = `translate(${moveX}px, ${moveY - 2}px) scale(1.02)`;
      });

      btn.addEventListener('mouseleave', () => {
        btn.style.transform = '';
      });
    });
  }
  initMagneticButtons();
});
