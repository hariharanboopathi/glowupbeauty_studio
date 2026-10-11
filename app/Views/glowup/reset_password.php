<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= view('glowup/partials/seo_meta', [
        'pageKey'       => 'login',
        'fallbackTitle' => esc($pageTitle ?? 'Reset Password | Glowup Beauty Studio & Academy'),
        'fallbackDesc'  => 'Create a new password for your Glowup Beauty Studio & Academy patron account.',
    ]) ?>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap"
        rel="stylesheet" />

    <!-- Main Unified CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />

    <style>
        /* ========== BACKGROUND IMAGE (CLEAR) ========== */
        html, body {
            min-height: 100vh;
            color: #ffffff !important;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;

            /* BACKGROUND IMAGE */
            background-image: url('https://images.unsplash.com/photo-1560066984-138dadb4c035?w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* very light tint only */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(26, 14, 36, 0.35);
            z-index: 1;
            pointer-events: none;
        }

        /* ========== CARD ========== */
        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 460px;
            background: rgba(26, 14, 36, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 22px;
            padding: 38px 36px 34px;
            box-shadow: 0 35px 80px rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        /* ========== BACK TO HOME NAV ========== */
        .login-nav {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .btn-back-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #d9b8ff !important;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            padding: 7px 16px 7px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-back-home:hover {
            color: #ffffff !important;
            background: rgba(167, 108, 255, 0.3);
            border-color: #a76cff;
            transform: translateX(-3px);
        }

        .btn-back-home .material-symbols-outlined {
            font-size: 18px;
        }

        /* ========== HEAD ========== */
        .login-head {
            margin-bottom: 24px;
        }

        .login-head h2 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 28px;
            font-weight: 700;
            color: #ffffff !important;
            margin: 0 0 8px;
            letter-spacing: -0.01em;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .login-head p {
            color: #d0c2e0 !important;
            font-size: 13.5px;
            line-height: 1.5;
            margin: 0;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
        }

        /* ========== FIELDS ========== */
        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 10.5px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #d9b8ff !important;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
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
            color: #d0c2e0 !important;
            pointer-events: none;
            transition: color 0.25s;
        }

        .field-inner input {
            width: 100%;
            padding: 13px 46px 13px 44px;
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 12px;
            color: #ffffff !important;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
        }

        .field-inner input::placeholder {
            color: rgba(255, 255, 255, 0.55) !important;
        }

        .field-inner input:focus {
            border-color: #a76cff;
            background: rgba(255, 255, 255, 0.18) !important;
            box-shadow: 0 0 0 4px rgba(167, 108, 255, 0.25);
        }

        .field-inner input:focus ~ .material-symbols-outlined {
            color: #c99cff !important;
        }

        /* password toggle button */
        .pw-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #d0c2e0 !important;
            display: flex;
            align-items: center;
            padding: 4px;
            transition: color 0.25s;
        }

        .pw-toggle:hover {
            color: #c99cff !important;
        }

        .pw-toggle .material-symbols-outlined {
            position: static;
            transform: none;
            font-size: 19px;
            pointer-events: none;
            color: inherit !important;
        }

        /* ========== SUBMIT ========== */
        .btn-submit {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #a76cff 0%, #8b4fe0 100%);
            color: #1a0e24 !important;
            font-size: 14.5px;
            font-weight: 700;
            letter-spacing: 0.04em;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(167, 108, 255, 0.45);
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #b985ff 0%, #9b62f0 100%);
            color: #12071a !important;
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(167, 108, 255, 0.6);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit .material-symbols-outlined {
            font-size: 20px;
            color: inherit !important;
        }

        /* ========== FOOT ========== */
        .login-foot {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #d0c2e0 !important;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
        }

        .login-foot a {
            color: #ffffff !important;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.25s;
        }

        .login-foot a:hover {
            color: #a76cff !important;
            text-decoration: underline;
        }

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
            flex: 1;
            min-width: 0;
        }

        .toast-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 12.5px;
            color: #d5c5e5;
            line-height: 1.45;
            margin: 0;
            word-wrap: break-word;
        }

        .toast-close-btn {
            background: none;
            border: none;
            color: #c9b8d4;
            cursor: pointer;
            padding: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: color 0.2s, background-color 0.2s;
        }

        .toast-close-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
        }

        .toast-close-btn .material-symbols-outlined {
            font-size: 18px;
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: rgba(255, 255, 255, 0.1);
        }

        .toast-progress-bar {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, #a76cff, #d9b8ff);
            animation: toastProgress 5s linear forwards;
        }

        @keyframes toastProgress {
            from { width: 100%; }
            to { width: 0%; }
        }
    </style>
</head>

<body>

    <!-- LUXURY TOAST CONTAINER -->
    <div class="toast-container" id="toastContainer" aria-live="polite"></div>

    <form class="login-card" action="<?= base_url('reset-password') ?>" method="POST" novalidate>
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= esc($token) ?>" />

        <!-- BACK TO LOGIN NAVIGATION -->
        <div class="login-nav">
            <a href="<?= base_url('login') ?>" class="btn-back-home" title="Return to Sign In">
                <span class="material-symbols-outlined">arrow_back</span>
                <span>Back to Sign In</span>
            </a>
        </div>

        <div class="login-head">
            <h2>Set New Password</h2>
            <p>Create a strong and secure password for <?= esc($customer['name'] ?? 'your patron account') ?>.</p>
        </div>

        <!-- NEW PASSWORD -->
        <div class="field">
            <label for="password">New Password</label>
            <div class="field-inner">
                <span class="material-symbols-outlined">lock</span>
                <input type="password" id="password" name="password" placeholder="At least 6 characters" required minlength="6" />
                <button type="button" class="pw-toggle" onclick="togglePassword('password','pwIcon1')"
                    aria-label="Show password">
                    <span class="material-symbols-outlined" id="pwIcon1">visibility</span>
                </button>
            </div>
        </div>

        <!-- CONFIRM NEW PASSWORD -->
        <div class="field">
            <label for="confirm_password">Confirm New Password</label>
            <div class="field-inner">
                <span class="material-symbols-outlined">lock_reset</span>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat your new password" required minlength="6" />
                <button type="button" class="pw-toggle" onclick="togglePassword('confirm_password','pwIcon2')"
                    aria-label="Show password">
                    <span class="material-symbols-outlined" id="pwIcon2">visibility</span>
                </button>
            </div>
        </div>

        <!-- SUBMIT -->
        <button type="submit" class="btn-submit">
            <span class="material-symbols-outlined">check_circle</span>
            Save New Password
        </button>

        <!-- LINK TO LOGIN -->
        <div class="login-foot">
            Back to <a href="<?= base_url('login') ?>">Sign In</a>
        </div>

    </form>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        // Universal Luxury Toaster Notification Function
        function showToast(type, title, message) {
            const container = document.getElementById('toastContainer');
            if (!container) return;

            container.innerHTML = '';

            const toast = document.createElement('div');
            toast.className = `toast-item toast-${type}`;

            let iconName = 'info';
            if (type === 'success') iconName = 'check_circle';
            else if (type === 'error') iconName = 'error';

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

        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($flashSuccess = session()->getFlashdata('success')): ?>
                showToast('success', 'Password Reset', <?= json_encode($flashSuccess) ?>);
            <?php endif; ?>

            <?php if ($flashError = session()->getFlashdata('error')): ?>
                showToast('error', 'Reset Notice', <?= json_encode($flashError) ?>);
            <?php endif; ?>
        });
    </script>

</body>

</html>
