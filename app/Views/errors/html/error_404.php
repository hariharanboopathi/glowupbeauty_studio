<?php
/**
 * Glowup Beauty Studio & Academy - Custom 404 Not Found Error Page
 *
 * Implements high-end royal deep violet & luminous lavender brand aesthetics,
 * clean responsive typography, fast loading, zero exposure of internal paths/traces,
 * and robust action buttons directing lost visitors to core experience routes.
 */

if (!function_exists('base_url')) {
    try {
        helper('url');
    } catch (\Throwable $e) {
        // Fallback silently
    }
}

$homeUrl     = function_exists('base_url') ? base_url('/') : '/';
$servicesUrl = function_exists('base_url') ? base_url('services') : '/services';
$contactUrl  = function_exists('base_url') ? base_url('contact') : '/contact';
$academyUrl  = function_exists('base_url') ? base_url('academy') : '/academy';
$galleryUrl  = function_exists('base_url') ? base_url('gallery') : '/gallery';
$reviewUrl   = function_exists('base_url') ? base_url('review') : '/review';
$bookingUrl  = function_exists('base_url') ? base_url('booking') : '/booking';
$faviconUrl  = function_exists('base_url') ? base_url('favicon.ico') : '/favicon.ico';
$logoEmblem  = function_exists('base_url') ? base_url('assets/images/Glowup_Favicon_512.png') : '/assets/images/Glowup_Favicon_512.png';
$cssUrl      = function_exists('base_url') ? base_url('css/style.css') : '/css/style.css';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 | Page Not Found | Glowup Beauty Studio &amp; Academy</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="description" content="The page you are looking for does not exist or may have been moved. Return to Glowup Beauty Studio &amp; Academy." />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= esc($logoEmblem, 'attr') ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= esc($faviconUrl, 'attr') ?>" />
    <link rel="apple-touch-icon" href="<?= esc($logoEmblem, 'attr') ?>" />

    <!-- Google Fonts & Material Symbols (Unified Single Network Request + Non-blocking display:swap) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Main Unified CSS (Optional enhancement when available) -->
    <link rel="stylesheet" href="<?= esc($cssUrl, 'attr') ?>" />

    <style>
        /* ===================================================================
           GLOWUP 404 BRAND STYLING & SELF-CONTAINED RESILIENCE
           =================================================================== */
        :root {
            --glowup-bg-main: #4d3d5c;
            --glowup-bg-deep: #2d1f3d;
            --glowup-bg-darkest: #1a0e24;
            --glowup-accent-lavender: #d5c5e5;
            --glowup-accent-lilac: #b8a3d0;
            --glowup-gold: #f1cf8e;
            --glowup-text-light: #ffffff;
            --glowup-text-soft: #e5ddf0;
            --glowup-text-dim: #c9b8d4;
            --glowup-card-bg: rgba(45, 31, 61, 0.72);
            --glowup-card-border: rgba(229, 221, 240, 0.16);
            --glowup-transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            width: 100%;
            background-color: var(--glowup-bg-main);
            color: var(--glowup-text-light);
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            background: radial-gradient(circle at 50% 20%, #684f7d 0%, #4d3d5c 45%, #2d1f3d 85%, #1a0e24 100%);
            background-attachment: fixed;
        }

        /* Ambient Glowing Background Blobs */
        .ambient-glow-1 {
            position: fixed;
            top: -10%;
            left: 20%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184, 163, 208, 0.18) 0%, rgba(77, 61, 92, 0) 70%);
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }

        .ambient-glow-2 {
            position: fixed;
            bottom: -15%;
            right: 15%;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(241, 207, 142, 0.08) 0%, rgba(45, 31, 61, 0) 70%);
            filter: blur(70px);
            pointer-events: none;
            z-index: 0;
        }

        /* Header Navigation */
        .glowup-header {
            position: relative;
            z-index: 10;
            padding: 28px 24px;
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
        }

        .glowup-brand {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: #ffffff;
            transition: var(--glowup-transition);
        }

        .glowup-brand:hover {
            color: #ffffff;
            transform: translateY(-1px);
        }

        .glowup-brand-logo {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(229, 221, 240, 0.25);
            background: #2d1f3d;
        }

        .glowup-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
        }

        .glowup-brand-text strong {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #ffffff;
        }

        .glowup-brand-text small {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--glowup-accent-lavender);
        }

        /* Main Content Container */
        .glowup-content-wrap {
            position: relative;
            z-index: 10;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 20px 40px;
        }

        .glowup-404-card {
            width: 100%;
            max-width: 740px;
            background: var(--glowup-card-bg);
            border: 1px solid var(--glowup-card-border);
            border-radius: 24px;
            padding: 56px 44px;
            text-align: center;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 24px 60px rgba(10, 5, 18, 0.55),
                        0 0 0 1px rgba(255, 255, 255, 0.05) inset;
            position: relative;
            overflow: hidden;
            animation: cardEntrance 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .glowup-404-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 20%;
            right: 20%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(213, 197, 229, 0.6), transparent);
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Decorative Badge Icon */
        .icon-badge {
            width: 68px;
            height: 68px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(213, 197, 229, 0.18), rgba(89, 46, 131, 0.35));
            border: 1px solid rgba(229, 221, 240, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3),
                        0 0 20px rgba(184, 163, 208, 0.25);
        }

        .icon-badge .material-symbols-outlined {
            font-size: 34px;
            color: var(--glowup-accent-lavender);
        }

        /* 404 Large Display */
        .error-code {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(84px, 14vw, 136px);
            font-weight: 700;
            line-height: 0.95;
            letter-spacing: -0.02em;
            margin: 0 0 16px;
            background: linear-gradient(135deg, #ffffff 15%, #d5c5e5 55%, #b8a3d0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 10px 40px rgba(184, 163, 208, 0.2);
            position: relative;
            display: inline-block;
        }

        .error-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 16px;
            border-radius: 999px;
            background: rgba(184, 163, 208, 0.12);
            border: 1px solid rgba(229, 221, 240, 0.22);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--glowup-accent-lavender);
            margin-bottom: 18px;
        }

        .error-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(24px, 4vw, 34px);
            font-weight: 600;
            color: #ffffff;
            margin: 0 0 14px;
            letter-spacing: 0.01em;
        }

        .error-desc {
            font-size: clamp(14px, 2.2vw, 16.5px);
            line-height: 1.65;
            color: var(--glowup-text-soft);
            max-width: 520px;
            margin: 0 auto 36px;
            font-weight: 400;
        }

        /* Action Buttons */
        .error-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 38px;
        }

        .btn-glowup-primary {
            background: linear-gradient(135deg, #2d1f3d 0%, #1a0e24 100%);
            color: #ffffff !important;
            border: 1px solid rgba(229, 221, 240, 0.35);
            border-radius: 10px;
            padding: 13px 26px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--glowup-transition);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
        }

        .btn-glowup-primary:hover {
            background: linear-gradient(135deg, #3d2a52 0%, #251433 100%);
            border-color: var(--glowup-accent-lavender);
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.45), 0 0 16px rgba(184, 163, 208, 0.25);
            color: #ffffff !important;
        }

        .btn-glowup-secondary {
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff !important;
            border: 1px solid rgba(229, 221, 240, 0.35);
            border-radius: 10px;
            padding: 13px 24px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--glowup-transition);
            backdrop-filter: blur(10px);
        }

        .btn-glowup-secondary:hover {
            background: rgba(255, 255, 255, 0.14);
            border-color: var(--glowup-accent-lavender);
            transform: translateY(-2px);
            color: #ffffff !important;
        }

        .btn-glowup-outline {
            background: transparent;
            color: var(--glowup-accent-lavender) !important;
            border: 1px solid rgba(213, 197, 229, 0.3);
            border-radius: 10px;
            padding: 13px 22px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--glowup-transition);
        }

        .btn-glowup-outline:hover {
            background: rgba(184, 163, 208, 0.12);
            border-color: var(--glowup-accent-lavender);
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        .btn-glowup-primary .material-symbols-outlined,
        .btn-glowup-secondary .material-symbols-outlined,
        .btn-glowup-outline .material-symbols-outlined {
            font-size: 18px;
        }

        /* Quick Discovery Links */
        .quick-nav {
            border-top: 1px solid rgba(229, 221, 240, 0.12);
            padding-top: 24px;
        }

        .quick-nav-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--glowup-text-dim);
            margin-bottom: 12px;
        }

        .quick-nav-links {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 18px;
        }

        .quick-nav-links a {
            color: var(--glowup-accent-lavender);
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: var(--glowup-transition);
        }

        .quick-nav-links a:hover {
            color: #ffffff;
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        /* Footer */
        .glowup-footer {
            position: relative;
            z-index: 10;
            padding: 24px 20px;
            text-align: center;
            color: var(--glowup-text-dim);
            font-size: 12px;
            letter-spacing: 0.02em;
        }

        /* Responsive Overrides */
        @media (max-width: 576px) {
            .glowup-header {
                padding: 20px 16px;
                text-align: center;
            }

            .glowup-brand {
                justify-content: center;
            }

            .glowup-404-card {
                padding: 38px 22px;
                border-radius: 20px;
            }

            .error-actions {
                flex-direction: column;
                width: 100%;
                gap: 10px;
            }

            .btn-glowup-primary,
            .btn-glowup-secondary,
            .btn-glowup-outline {
                width: 100%;
                padding: 12px 18px;
            }

            .quick-nav-links {
                gap: 12px 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Ambient Lighting Effects -->
    <div class="ambient-glow-1" aria-hidden="true"></div>
    <div class="ambient-glow-2" aria-hidden="true"></div>

    <!-- Header with Official Glowup Branding -->
    <header class="glowup-header">
        <a href="<?= esc($homeUrl, 'attr') ?>" class="glowup-brand" title="Glowup Beauty Studio &amp; Academy">
            <img src="<?= esc($logoEmblem, 'attr') ?>" alt="Glowup Emblem" class="glowup-brand-logo" />
            <div class="glowup-brand-text">
                <strong>Glowup</strong>
                <small>Beauty Studio &amp; Academy</small>
            </div>
        </a>
    </header>

    <!-- Main Error Content Card -->
    <main class="glowup-content-wrap">
        <section class="glowup-404-card" aria-labelledby="errorHeading">
            <!-- Decorative Icon Badge -->
            <div class="icon-badge" aria-hidden="true">
                <span class="material-symbols-outlined">explore_off</span>
            </div>

            <!-- Eyebrow Pill -->
            <div>
                <span class="error-eyebrow">
                    <span class="material-symbols-outlined" style="font-size: 13px;">error_outline</span>
                    Status 404
                </span>
            </div>

            <!-- Error Code & Title -->
            <div class="error-code">404</div>
            <h1 class="error-title" id="errorHeading">Page Not Found</h1>

            <!-- Friendly Message (No internal traces or controller names) -->
            <p class="error-desc">
                Oops! The page you're looking for doesn't exist or may have been moved.
            </p>

            <!-- Useful Direct Action Buttons -->
            <div class="error-actions">
                <a href="<?= esc($homeUrl, 'attr') ?>" class="btn-glowup-primary" id="btnBackHome">
                    <span class="material-symbols-outlined">home</span>
                    <span>Back to Home</span>
                </a>
                <a href="<?= esc($servicesUrl, 'attr') ?>" class="btn-glowup-secondary" id="btnGoServices">
                    <span class="material-symbols-outlined">spa</span>
                    <span>Go to Services</span>
                </a>
                <a href="<?= esc($contactUrl, 'attr') ?>" class="btn-glowup-outline" id="btnContactUs">
                    <span class="material-symbols-outlined">support_agent</span>
                    <span>Contact Us</span>
                </a>
            </div>

            <!-- Quick Site Exploration -->
            <nav class="quick-nav" aria-label="Quick directory">
                <div class="quick-nav-label">Explore Glowup Portals</div>
                <div class="quick-nav-links">
                    <a href="<?= esc($bookingUrl, 'attr') ?>">
                        <span class="material-symbols-outlined" style="font-size: 15px;">calendar_month</span>
                        <span>Book Appointment</span>
                    </a>
                    <a href="<?= esc($academyUrl, 'attr') ?>">
                        <span class="material-symbols-outlined" style="font-size: 15px;">school</span>
                        <span>Academy Courses</span>
                    </a>
                    <a href="<?= esc($galleryUrl, 'attr') ?>">
                        <span class="material-symbols-outlined" style="font-size: 15px;">photo_library</span>
                        <span>Gallery</span>
                    </a>
                    <a href="<?= esc($reviewUrl, 'attr') ?>">
                        <span class="material-symbols-outlined" style="font-size: 15px;">hotel_class</span>
                        <span>Patron Reviews</span>
                    </a>
                </div>
            </nav>
        </section>
    </main>

    <!-- Minimalist Brand Footer -->
    <footer class="glowup-footer">
        <div>&copy; <?= date('Y') ?> Glowup Beauty Studio &amp; Academy. All rights reserved.</div>
    </footer>
</body>
</html>
