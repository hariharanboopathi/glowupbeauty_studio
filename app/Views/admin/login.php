<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Glowup Beauty Studio &amp; Academy</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" />
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" />
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" />

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

    <style>
        :root {
            --glowup-primary: #592E83;
            --glowup-secondary: #A36952;
            --glowup-dark: #483C46;
            --glowup-white: #FFFFFF;
            --glowup-canvas: #FCFBFA;
            --glowup-lavender-subtle: #F8F5FA;
            --glowup-border-subtle: #EDE6E4;
            --glowup-muted: #6f626d;
            --glowup-border: #D5CCD3;

            /* Backward-compatible aliases */
            --color-primary: var(--glowup-primary);
            --color-secondary: var(--glowup-secondary);
            --color-dark: var(--glowup-dark);
            --color-white: var(--glowup-white);
            --color-canvas: var(--glowup-canvas);
        }

        /* ========== #592E83 + #A36952 + #483C46 THEME ========== */
        html, body {
            min-height: 100vh;
            color: var(--glowup-dark) !important;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--glowup-canvas);
            background-image:
                radial-gradient(circle at 15% 15%, rgba(89, 46, 131, 0.06) 0%, transparent 45%),
                radial-gradient(circle at 85% 85%, rgba(163, 105, 82, 0.06) 0%, transparent 40%);
            background-attachment: fixed;
        }

        /* Subtle ambient glow */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: transparent;
            z-index: 1;
            pointer-events: none;
        }

        /* ========== LOGIN CARD (WHITE BASE + #592E83 / #A36952 ACCENTS) ========== */
        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 440px;
            background: var(--glowup-white);
            border: 1px solid var(--glowup-border-subtle);
            border-radius: 22px;
            padding: 44px 40px 38px;
            box-shadow: 0 20px 50px rgba(72, 60, 70, 0.08), 0 4px 16px rgba(0, 0, 0, 0.03);
        }

        .login-head {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-head h2 {
            font-family: 'Playfair Display', serif;
            color: var(--glowup-dark) !important;
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 6px;
        }

        .login-head p {
            color: var(--glowup-muted) !important;
            font-size: 13.5px;
            line-height: 1.6;
            margin: 0;
        }

        /* ========== FIELDS ========== */
        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--glowup-dark) !important;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .field-inner {
            position: relative;
        }

        .field-inner .material-symbols-outlined {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 19px;
            color: var(--glowup-primary) !important;
            pointer-events: none;
            transition: color 0.25s;
        }

        .field-inner input {
            width: 100%;
            padding: 13px 46px 13px 44px;
            background: var(--glowup-white) !important;
            border: 1px solid var(--glowup-border);
            border-radius: 12px;
            color: var(--glowup-dark) !important;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .field-inner input::placeholder {
            color: #988b97 !important;
        }

        /* Autofill white background fix */
        .field-inner input:-webkit-autofill,
        .field-inner input:-webkit-autofill:hover,
        .field-inner input:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--glowup-dark) !important;
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .field-inner input:focus {
            border-color: var(--glowup-primary);
            background: var(--glowup-white) !important;
            box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.18);
        }

        .field-inner input:focus ~ .material-symbols-outlined {
            color: var(--glowup-primary) !important;
        }

        /* Password eye toggle */
        .pw-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--glowup-dark) !important;
            display: flex;
            align-items: center;
            padding: 4px;
            transition: color 0.25s;
        }

        .pw-toggle:hover {
            color: var(--glowup-primary) !important;
        }

        .pw-toggle .material-symbols-outlined {
            position: static;
            transform: none;
            font-size: 19px;
            pointer-events: none;
            color: inherit !important;
        }

        /* ========== SUBMIT BUTTON (#592E83) ========== */
        .btn-submit {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--glowup-primary) 0%, #48236d 100%);
            color: var(--glowup-white) !important;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
            box-shadow: 0 4px 14px rgba(89, 46, 131, 0.25);
            transition: transform 0.22s, box-shadow 0.22s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #683699 0%, #592E83 100%);
            box-shadow: 0 8px 24px rgba(89, 46, 131, 0.38);
            color: #ffffff !important;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .btn-submit:focus-visible {
            outline: 2px solid var(--glowup-primary);
            outline-offset: 2px;
        }

        .btn-submit .material-symbols-outlined {
            font-size: 18px;
            color: #ffffff !important;
        }

        @media (max-width: 480px) {
            body {
                background-attachment: scroll;
                padding: 24px 16px;
            }

            .login-card {
                padding: 34px 24px 30px;
                border-radius: 18px;
            }

            .login-head h2 {
                font-size: 1.65rem;
            }
        }

        /* ========== TOASTER NOTIFICATIONS ========== */
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
            background: #ffffff;
            border: 1px solid #A36952;
            border-radius: 16px;
            box-shadow: 0 16px 36px rgba(72, 60, 70, 0.15);
            color: #483C46;
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
            border-color: #fecaca;
        }

        .toast-error .toast-icon-box {
            color: #dc2626;
            background: #fee2e2;
            border: 1px solid #fecaca;
        }

        .toast-success {
            border-color: #bbf7d0;
        }

        .toast-success .toast-icon-box {
            color: #16a34a;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
        }

        .toast-info {
            border-color: #A36952;
        }

        .toast-info .toast-icon-box {
            color: #592E83;
            background: #f4edf7;
            border: 1px solid #dfcfeb;
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
            color: #483C46;
            margin-bottom: 3px;
        }

        .toast-message {
            font-size: 12.5px;
            color: #6f626d;
            line-height: 1.45;
            margin: 0;
        }

        .toast-close-btn {
            background: none;
            border: none;
            color: #988b97 !important;
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
            color: #592E83 !important;
            background: #f4edf7;
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
            background: #f4edf7;
        }

        .toast-progress-bar {
            height: 100%;
            width: 100%;
            animation: toastCountdown 5s linear forwards;
        }

        .toast-error .toast-progress-bar {
            background: linear-gradient(90deg, #ef4444, #f87171);
        }

        .toast-success .toast-progress-bar {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .toast-info .toast-progress-bar {
            background: linear-gradient(90deg, #592E83, #A36952);
        }

        @keyframes toastCountdown {
            from { width: 100%; }
            to { width: 0%; }
        }

        @media (max-width: 480px) {
            .toast-container {
                top: 16px;
                right: 16px;
                left: 16px;
                width: auto;
            }
        }
    </style>
</head>

<body>

    <!-- Toast Notification Container -->
    <div id="toastContainer" class="toast-container" aria-live="polite"></div>

    <form id="loginForm" class="login-card" action="<?= base_url('admin/login') ?>" method="POST" novalidate>
        <?= csrf_field() ?>

        <div class="login-head">
            <h2>Login</h2>
            <p>Sign in to continue to Glowup.</p>
        </div>

        <!-- EMAIL -->
        <div class="field">
            <label for="email">Email</label>
            <div class="field-inner">
                <span class="material-symbols-outlined">mail</span>
                <input type="email" id="email" name="email" value="<?= esc(old('email')) ?>" placeholder="you@example.com" required />
            </div>
        </div>

        <!-- PASSWORD -->
        <div class="field">
            <label for="password">Password</label>
            <div class="field-inner">
                <span class="material-symbols-outlined">lock</span>
                <input type="password" id="password" name="password" placeholder="Enter your password" required />
                <button type="button" class="pw-toggle" onclick="togglePassword()" aria-label="Show password">
                    <span class="material-symbols-outlined" id="pwIcon">visibility</span>
                </button>
            </div>
        </div>

        <!-- SUBMIT -->
        <button type="submit" id="btnSubmit" class="btn-submit">
            <span class="material-symbols-outlined">login</span>
            Submit
        </button>

    </form>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('pwIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        // Toaster Notification Function
        function showToast(type, title, message) {
            const container = document.getElementById('toastContainer');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast-item toast-${type}`;

            let iconName = 'error';
            if (type === 'success') iconName = 'check_circle';
            else if (type === 'info') iconName = 'info';

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

            // Animate in
            requestAnimationFrame(() => {
                toast.classList.add('show');
            });

            // Dismiss handler
            const removeToast = () => {
                toast.classList.remove('show');
                toast.classList.add('hide');
                setTimeout(() => {
                    if (toast.parentElement) toast.parentElement.removeChild(toast);
                }, 400);
            };

            const closeBtn = toast.querySelector('.toast-close-btn');
            if (closeBtn) closeBtn.addEventListener('click', removeToast);

            // Auto dismiss after 5 seconds
            setTimeout(removeToast, 5000);
        }

        // Handle client-side submission with toaster validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailVal = emailInput.value.trim();
            const passVal = passwordInput.value.trim();

            if (!emailVal) {
                e.preventDefault();
                showToast('error', 'Missing Email', 'Please enter your administrator email address.');
                emailInput.focus();
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailVal)) {
                e.preventDefault();
                showToast('error', 'Invalid Email', 'Please provide a valid email format (e.g. you@example.com).');
                emailInput.focus();
                return;
            }

            if (!passVal) {
                e.preventDefault();
                showToast('error', 'Missing Password', 'Please enter your account password.');
                passwordInput.focus();
                return;
            }

            // Valid submission - show quick info toast
            showToast('info', 'Authenticating...', 'Verifying your credentials, please wait...');
        });

        // Trigger Server Flash Toasts on page load
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($flashError = session()->getFlashdata('error')): ?>
                showToast('error', 'Authentication Notice', <?= json_encode($flashError) ?>);
            <?php endif; ?>

            <?php if ($flashErrors = session()->getFlashdata('errors')): ?>
                <?php foreach ((array) $flashErrors as $err): ?>
                    showToast('error', 'Validation Notice', <?= json_encode($err) ?>);
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($flashSuccess = session()->getFlashdata('success')): ?>
                showToast('success', 'Success', <?= json_encode($flashSuccess) ?>);
            <?php endif; ?>
        });
    </script>

</body>

</html>