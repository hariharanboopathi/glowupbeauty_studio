/**
 * GlowUp Admin Authentication Interactions
 */

document.addEventListener('DOMContentLoaded', () => {
  // Elements
  const passwordInput = document.getElementById('password');
  const togglePasswordBtn = document.getElementById('togglePasswordBtn');
  const eyeOpenIcon = document.getElementById('eyeOpenIcon');
  const eyeClosedIcon = document.getElementById('eyeClosedIcon');
  const demoPill = document.getElementById('demoPill');
  const emailInput = document.getElementById('email');
  const loginForm = document.getElementById('loginForm');
  const submitBtn = document.getElementById('submitBtn');
  const forgotBtn = document.getElementById('forgotBtn');
  const forgotModal = document.getElementById('forgotModal');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const cancelModalBtn = document.getElementById('cancelModalBtn');

  // Password Visibility Toggle
  if (togglePasswordBtn && passwordInput) {
    togglePasswordBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const isPassword = passwordInput.getAttribute('type') === 'password';
      passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

      if (isPassword) {
        eyeOpenIcon.style.display = 'none';
        eyeClosedIcon.style.display = 'block';
        togglePasswordBtn.setAttribute('aria-label', 'Hide password');
      } else {
        eyeOpenIcon.style.display = 'block';
        eyeClosedIcon.style.display = 'none';
        togglePasswordBtn.setAttribute('aria-label', 'Show password');
      }
      passwordInput.focus();
    });
  }

  // Quick-fill Demo Admin Credentials
  if (demoPill && emailInput && passwordInput) {
    demoPill.addEventListener('click', () => {
      emailInput.value = 'admin@glowup.com';
      passwordInput.value = 'Admin@12345';
      
      // Visual feedback
      demoPill.style.transform = 'scale(0.97)';
      setTimeout(() => {
        demoPill.style.transform = 'scale(1)';
      }, 150);

      // Trigger focus and brief highlight
      emailInput.focus();
      const actionBadge = demoPill.querySelector('.demo-pill-action');
      if (actionBadge) {
        const originalText = actionBadge.textContent;
        actionBadge.textContent = '✓ Autofilled!';
        actionBadge.style.background = 'rgba(16, 185, 129, 0.2)';
        actionBadge.style.color = '#34d399';
        setTimeout(() => {
          actionBadge.textContent = originalText;
          actionBadge.style.background = '';
          actionBadge.style.color = '';
        }, 2000);
      }
    });
  }

  // Form submission loading state
  if (loginForm && submitBtn) {
    loginForm.addEventListener('submit', (e) => {
      // Basic check
      if (!loginForm.checkValidity()) {
        return;
      }
      submitBtn.classList.add('is-loading');
      const submitText = submitBtn.querySelector('.btn-text');
      if (submitText) {
        submitText.textContent = 'Verifying Credentials...';
      }
    });
  }

  // Forgot Password Modal
  const openModal = () => {
    if (forgotModal) {
      forgotModal.classList.add('is-open');
      const resetEmail = document.getElementById('reset_email');
      if (resetEmail) {
        if (emailInput && emailInput.value) {
          resetEmail.value = emailInput.value;
        }
        setTimeout(() => resetEmail.focus(), 100);
      }
    }
  };

  const closeModal = () => {
    if (forgotModal) {
      forgotModal.classList.remove('is-open');
    }
  };

  if (forgotBtn) forgotBtn.addEventListener('click', openModal);
  if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
  if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

  if (forgotModal) {
    forgotModal.addEventListener('click', (e) => {
      if (e.target === forgotModal) closeModal();
    });
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && forgotModal && forgotModal.classList.contains('is-open')) {
      closeModal();
    }
  });

  // Auto-dismiss alert after 8 seconds
  const alerts = document.querySelectorAll('.alert-banner');
  alerts.forEach(alert => {
    const closeBtn = alert.querySelector('.alert-close');
    if (closeBtn) {
      closeBtn.addEventListener('click', () => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => alert.remove(), 300);
      });
    }

    setTimeout(() => {
      if (document.body.contains(alert)) {
        alert.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => alert.remove(), 400);
      }
    }, 8000);
  });
});
