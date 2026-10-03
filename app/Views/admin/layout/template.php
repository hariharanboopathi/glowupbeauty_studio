<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= esc($pageTitle ?? 'Glowup Admin Portal') ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" />
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" />
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" />

    <!-- Scroll Stability Management -->
    <script>
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        (function() {
            const savedY = sessionStorage.getItem('glowup_admin_scroll_y');
            if (savedY !== null) {
                const y = parseInt(savedY, 10);
                if (!isNaN(y) && y > 0) {
                    window.scrollTo(0, y);
                }
            }
        })();
    </script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts & Material Symbols (Unified Single Network Request + Non-blocking display:swap) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap"
        rel="stylesheet" />

    <style>
        /* ==========================================================================
           GLOWUP BEAUTY STUDIO & ACADEMY - UNIFIED ADMIN DESIGN SYSTEM
           Core Palette: #592E83 (Royal Purple), #A36952 (Warm Rose-Gold), #483C46 (Plum/Charcoal)
           Canvas: #fcfbfa | Surfaces: #ffffff | Borders: #ede6e4
           ========================================================================== */
        :root {
            /* ==========================================================================
               GLOWUP BEAUTY STUDIO & ACADEMY - CENTRALIZED ADMIN COLOR SYSTEM
               Core Palette:
                 Primary Purple:   #592E83
                 Secondary Brown:  #A36952
                 Dark Neutral:     #483C46
                 White:            #FFFFFF
                 Light Lavender:   #F8F5FA / #F4EDF7 (subtle tints)
               ========================================================================== */
            --glowup-primary: #592E83;
            --glowup-primary-hover: #48236d;
            --glowup-primary-light: #6a379c;
            --glowup-primary-subtle: #f4edf7;
            --glowup-primary-border: #dfcfeb;

            --glowup-secondary: #A36952;
            --glowup-secondary-hover: #8a5540;
            --glowup-secondary-light: #ba7e66;
            --glowup-secondary-subtle: #f8f1ee;
            --glowup-secondary-border: #eedcd6;

            --glowup-dark: #483C46;
            --glowup-dark-hover: #382e37;
            --glowup-dark-subtle: #f2edf1;
            --glowup-dark-border: #ded8dc;

            --glowup-white: #FFFFFF;
            --glowup-canvas: #fcfbfa;
            --glowup-lavender-subtle: #f8f5fa;
            --glowup-border-subtle: #ede6e4;

            /* Backward compatibility aliases */
            --color-primary: var(--glowup-primary);
            --color-primary-hover: var(--glowup-primary-hover);
            --color-primary-light: var(--glowup-primary-light);
            --color-primary-subtle: var(--glowup-primary-subtle);
            --color-primary-border: var(--glowup-primary-border);

            --color-secondary: var(--glowup-secondary);
            --color-secondary-hover: var(--glowup-secondary-hover);
            --color-secondary-light: var(--glowup-secondary-light);
            --color-secondary-subtle: var(--glowup-secondary-subtle);
            --color-secondary-border: var(--glowup-secondary-border);

            --color-dark: var(--glowup-dark);
            --text-main: var(--glowup-dark);
            --text-muted: #6f626d;
            --text-dim: #988b97;

            /* Surfaces & Canvases */
            --bg-canvas: var(--glowup-canvas);
            --bg-card: var(--glowup-white);
            --bg-card-hover: var(--glowup-lavender-subtle);
            --bg-sidebar: var(--glowup-white);

            /* Borders & Dividers */
            --border-subtle: var(--glowup-border-subtle);
            --border-glow: var(--glowup-border-subtle);
            --border-focus: var(--glowup-primary);
            --border-secondary: var(--glowup-secondary);

            /* Semantic Accents */
            --accent: var(--glowup-primary);
            --accent-hover: var(--glowup-primary-hover);
            --accent-tint: var(--glowup-primary-subtle);
            --accent-emerald: #16a34a;
            --accent-emerald-subtle: #dcfce7;
            --accent-emerald-border: #bbf7d0;
            --accent-rose: #dc2626;
            --accent-rose-subtle: #fee2e2;
            --accent-rose-border: #fecaca;
            --accent-amber: #d97706;
            --accent-amber-subtle: #fef3c7;
            --accent-amber-border: #fde68a;

            /* Typography */
            --font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --font-serif: 'Playfair Display', Georgia, serif;

            /* Radii */
            --radius-card: 14px;
            --radius-btn: 10px;
            --radius-input: 10px;
            --radius-badge: 999px;

            /* Elevation Shadows */
            --card-shadow: 0 1px 3px rgba(72, 60, 70, 0.05), 0 1px 2px rgba(72, 60, 70, 0.03);
            --card-shadow-hover: 0 6px 18px rgba(89, 46, 131, 0.11), 0 2px 6px rgba(72, 60, 70, 0.04);
            --dropdown-shadow: 0 16px 36px rgba(72, 60, 70, 0.12), 0 4px 12px rgba(72, 60, 70, 0.04);
            --modal-shadow: 0 24px 60px rgba(72, 60, 70, 0.18), 0 8px 24px rgba(72, 60, 70, 0.08);

            /* Transitions */
            --transition-smooth: all 0.22s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        /* Reset & Base */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scrollbar-width: thin;
            scrollbar-color: #592E83 #fcfbfa;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #fcfbfa;
        }

        ::-webkit-scrollbar-thumb {
            background: #592E83;
            border-radius: 999px;
            border: 1px solid #ede6e4;
            transition: background 0.2s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #A36952;
            border-color: #A36952;
        }

        body {
            background-color: var(--bg-canvas);
            background-image:
                radial-gradient(circle at 12% 12%, rgba(89, 46, 131, 0.035) 0%, transparent 45%),
                radial-gradient(circle at 88% 88%, rgba(163, 105, 82, 0.035) 0%, transparent 40%);
            background-attachment: fixed;
            color: var(--text-main);
            font-family: var(--font-sans);
            font-size: 14px;
            line-height: 1.5;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        a {
            text-decoration: none;
            color: var(--accent);
            transition: var(--transition-smooth);
        }

        a:hover {
            color: var(--color-secondary);
        }

        /* Layout Structure */
        .admin-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 260px;
            background: #ffffff;
            border-right: 1px solid var(--border-subtle);
            padding: 24px 14px 40px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: #eedcd6 transparent;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
            box-shadow: 2px 0 10px rgba(72, 60, 70, 0.03);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #eedcd6;
            border-radius: 999px;
        }

        .sidebar-brand {
            display: flex;
            flex-direction: column;
            padding: 0 10px 18px;
            border-bottom: 1px solid var(--border-subtle);
            margin-bottom: 16px;
        }

        .sidebar-brand-logo {
            height: 46px;
            width: auto;
            max-width: 160px;
            object-fit: contain;
            display: block;
            margin-bottom: 4px;
        }

        .sidebar-brand small {
            font-size: 10px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--color-secondary);
            font-weight: 700;
        }

        .sidebar-label {
            font-size: 10px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--color-secondary);
            font-weight: 700;
            padding: 0 12px;
            margin: 18px 0 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: var(--radius-btn);
            border: 1px solid transparent;
            color: var(--text-main) !important;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 3px;
            text-decoration: none;
            transition: var(--transition-smooth);
            user-select: none;
        }

        .sidebar-link .material-symbols-outlined {
            font-size: 20px;
            color: var(--color-primary);
            flex-shrink: 0;
            transition: var(--transition-smooth);
        }

        .sidebar-link:hover {
            background: var(--color-primary-subtle);
            border-color: var(--color-secondary-border);
            color: var(--color-primary) !important;
            transform: translateX(3px);
        }

        .sidebar-link:hover .material-symbols-outlined {
            color: var(--color-primary);
            transform: scale(1.06);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #592E83, #48236d);
            color: #ffffff !important;
            border-color: #592E83;
            box-shadow: 0 3px 12px rgba(89, 46, 131, 0.28);
            transform: translateX(3px);
            font-weight: 600;
        }

        .sidebar-link.active .material-symbols-outlined {
            color: #ffffff !important;
        }

        .sidebar-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: var(--radius-badge);
            background: var(--color-secondary-subtle);
            color: var(--color-secondary);
            border: 1px solid var(--color-secondary-border);
            margin-left: auto;
        }

        /* Sidebar Accordion Submenu */
        .sidebar-dropdown {
            margin-bottom: 3px;
        }

        .sidebar-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: var(--radius-btn);
            border: 1px solid transparent;
            color: var(--text-main) !important;
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition-smooth);
            user-select: none;
        }

        .sidebar-dropdown-toggle .material-symbols-outlined:first-child {
            font-size: 20px;
            color: var(--color-primary);
            transition: var(--transition-smooth);
        }

        .sidebar-dropdown-toggle .arrow-icon {
            margin-left: auto;
            font-size: 18px;
            color: var(--text-muted);
            transition: transform 0.25s ease;
        }

        .sidebar-dropdown-toggle:hover {
            background: var(--color-primary-subtle);
            border-color: var(--color-secondary-border);
            color: var(--color-primary) !important;
            transform: translateX(3px);
        }

        .sidebar-dropdown-toggle.active {
            background: var(--color-primary-subtle);
            color: var(--color-primary) !important;
            border-color: var(--color-secondary);
            font-weight: 600;
        }

        .sidebar-dropdown.open .sidebar-dropdown-toggle .arrow-icon {
            transform: rotate(180deg);
        }

        .sidebar-submenu {
            display: none;
            flex-direction: column;
            gap: 2px;
            padding-left: 12px;
            margin: 4px 0 6px 14px;
            border-left: 2px solid var(--color-secondary);
            animation: fadeInSubmenu 0.2s ease forwards;
        }

        .sidebar-dropdown.open .sidebar-submenu {
            display: flex;
        }

        @keyframes fadeInSubmenu {
            from { opacity: 0; transform: translateY(-3px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .sidebar-submenu-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 8px;
            color: var(--text-main) !important;
            font-size: 12.5px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .sidebar-submenu-link::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--color-secondary);
            transition: var(--transition-smooth);
            flex-shrink: 0;
        }

        .sidebar-submenu-link:hover {
            color: var(--color-primary) !important;
            background: var(--color-secondary-subtle);
            transform: translateX(3px);
        }

        .sidebar-submenu-link:hover::before {
            background: var(--color-primary);
            transform: scale(1.3);
        }

        .sidebar-submenu-link.active {
            color: #ffffff !important;
            background: var(--color-primary);
            font-weight: 600;
        }

        .sidebar-submenu-link.active::before {
            background: #ffffff;
            box-shadow: 0 0 6px rgba(255, 255, 255, 0.8);
        }

        /* ==================== MAIN CONTENT AREA ==================== */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 28px 36px 80px;
            min-width: 0;
        }

        /* ==================== TOPBAR HEADER ==================== */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 20px;
            margin-bottom: 26px;
            border-bottom: 1px solid var(--border-subtle);
            gap: 16px;
        }

        .topbar-left h1 {
            font-family: var(--font-serif);
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-main) !important;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.01em;
        }

        .topbar-left .breadcrumb-sub {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-left .breadcrumb-sub a {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 500;
        }

        .topbar-left .breadcrumb-sub a:hover {
            color: var(--color-secondary);
            text-decoration: underline;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Mobile Hamburger Toggle */
        .mobile-toggle {
            display: none;
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            color: var(--text-main);
            width: 40px;
            height: 40px;
            border-radius: var(--radius-btn);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--card-shadow);
            transition: var(--transition-smooth);
        }

        .mobile-toggle:hover {
            background: var(--color-primary-subtle);
            color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(72, 60, 70, 0.45);
            z-index: 1025;
            backdrop-filter: blur(3px);
        }

        .sidebar-backdrop.show {
            display: block;
        }

        /* Notification Dropdown */
        .notification-btn {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-btn);
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            cursor: pointer;
            transition: var(--transition-smooth);
            position: relative;
            box-shadow: var(--card-shadow);
        }

        .notification-btn:hover,
        .notification-btn[aria-expanded="true"] {
            background: var(--color-primary-subtle);
            color: var(--color-primary);
            border-color: var(--color-primary);
            box-shadow: 0 2px 8px rgba(89, 46, 131, 0.15);
        }

        .notification-badge {
            position: absolute;
            top: -3px;
            right: -3px;
            min-width: 18px;
            height: 18px;
            padding: 0 4px;
            border-radius: var(--radius-badge);
            background: #dc2626;
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
        }

        .notification-menu {
            width: 350px;
            max-width: calc(100vw - 32px);
            padding: 0 !important;
            border-radius: 14px !important;
            border: 1px solid var(--border-subtle) !important;
            box-shadow: var(--dropdown-shadow) !important;
            overflow: hidden;
            background: #ffffff;
        }

        .notification-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            background: #fcfbfa;
            border-bottom: 1px solid var(--border-subtle);
        }

        .notification-head h6 {
            margin: 0;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-main);
        }

        .notification-head a {
            font-size: 11.5px;
            color: var(--color-primary);
            font-weight: 600;
            text-decoration: none;
        }

        .notification-body {
            max-height: 290px;
            overflow-y: auto;
            padding: 4px 0;
        }

        .notification-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 11px 18px;
            text-decoration: none !important;
            color: var(--text-main) !important;
            border-bottom: 1px solid #f8f6f8;
            transition: background 0.18s ease;
        }

        .notification-item:hover {
            background: #fdfafd;
        }

        .notification-icon-box {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: var(--color-primary-subtle);
            color: var(--color-primary);
            border: 1px solid var(--color-primary-border);
        }

        .notification-title {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 2px;
        }

        .notification-text {
            font-size: 11.5px;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .notification-time {
            font-size: 10.5px;
            color: var(--text-dim);
            margin-top: 3px;
        }

        .notification-foot {
            padding: 10px 18px;
            text-align: center;
            background: #fcfbfa;
            border-top: 1px solid var(--border-subtle);
        }

        .notification-foot a {
            font-size: 12px;
            font-weight: 600;
            color: var(--color-primary);
        }

        /* User Profile Dropdown */
        .admin-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-badge);
            padding: 4px 14px 4px 5px;
            cursor: pointer;
            transition: var(--transition-smooth);
            box-shadow: var(--card-shadow);
            user-select: none;
        }

        .admin-chip:hover,
        .admin-chip[aria-expanded="true"] {
            border-color: var(--color-primary);
            background: var(--color-primary-subtle);
            box-shadow: 0 2px 8px rgba(89, 46, 131, 0.12);
        }

        .admin-chip-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #592E83, #A36952);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .admin-chip-name {
            font-size: 12.5px;
            color: var(--text-main);
            font-weight: 600;
            line-height: 1.2;
        }

        .admin-chip-role {
            font-size: 10px;
            color: var(--color-secondary);
            font-weight: 600;
        }

        .user-dropdown-menu {
            width: 250px;
            border-radius: 14px !important;
            border: 1px solid var(--border-subtle) !important;
            box-shadow: var(--dropdown-shadow) !important;
            padding: 8px !important;
            background: #ffffff;
        }

        .user-dropdown-header {
            padding: 10px 12px 12px;
            border-bottom: 1px solid var(--border-subtle);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-main) !important;
            border-radius: 8px;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .user-dropdown-item .material-symbols-outlined {
            font-size: 18px;
            color: var(--color-secondary);
        }

        .user-dropdown-item:hover {
            background: var(--color-primary-subtle);
            color: var(--color-primary) !important;
        }

        .user-dropdown-item:hover .material-symbols-outlined {
            color: var(--color-primary);
        }

        .user-dropdown-item.text-danger:hover {
            background: #fee2e2;
            color: #dc2626 !important;
        }

        .user-dropdown-item.text-danger:hover .material-symbols-outlined {
            color: #dc2626;
        }

        /* ==================== PAGE HEADER COMPONENT ==================== */
        .admin-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-subtle);
        }

        .admin-page-header-title {
            font-family: var(--font-serif);
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-page-header-subtitle {
            font-size: 12.5px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .admin-page-header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* ==================== CARDS & PANELS ==================== */
        .card,
        .glass-panel,
        .clean-card,
        .cms-card,
        .panel-card {
            background: #ffffff !important;
            border: 1px solid var(--border-subtle) !important;
            border-radius: var(--radius-card) !important;
            padding: 24px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
            color: var(--text-main);
            position: relative;
        }

        .panel-header,
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 0 0 16px 0 !important;
            border-bottom: 1px solid var(--border-subtle) !important;
            background: transparent !important;
            gap: 16px;
            flex-wrap: wrap;
        }

        .panel-header h3,
        .card-header h3,
        .panel-header h4,
        .card-header h4,
        .panel-header h5,
        .card-header h5,
        .panel-header h6,
        .card-header h6 {
            font-family: var(--font-serif);
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-main) !important;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-header .subtitle,
        .card-header .subtitle {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 3px;
            font-weight: 400;
        }

        /* KPI & Stat Cards */
        .metric-card,
        .clean-stat-card,
        .cms-stat-card,
        .stat-card {
            background: #ffffff !important;
            border: 1px solid var(--border-subtle) !important;
            border-radius: var(--radius-card) !important;
            padding: 18px 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition-smooth);
            text-decoration: none !important;
            color: inherit !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .metric-card:hover,
        .clean-stat-card:hover,
        .cms-stat-card:hover,
        .stat-card:hover {
            transform: translateY(-2px);
            border-color: var(--color-secondary) !important;
            box-shadow: var(--card-shadow-hover);
        }

        .metric-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--color-primary-subtle);
            border: 1px solid var(--color-primary-border);
            color: var(--color-primary);
            flex-shrink: 0;
        }

        .metric-icon-box .material-symbols-outlined {
            font-size: 22px;
            color: var(--color-primary);
        }

        .metric-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-main) !important;
            line-height: 1.1;
            margin: 2px 0;
            font-family: var(--font-serif);
        }

        .metric-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            font-weight: 700;
        }

        .metric-subtitle {
            font-size: 11px;
            color: var(--text-dim);
            margin-top: 4px;
        }

        /* ==================== UNIFIED GLOWUP ACTION BUTTONS ==================== */

        /* 1. Base Button Architecture & Resets */
        .btn,
        .btn-clean-primary,
        .btn-luxury-primary,
        .btn-clean-secondary,
        .btn-glow,
        .btn-ghost-glow,
        .btn-neutral,
        .btn-action-clean {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            line-height: 1.4 !important;
            letter-spacing: 0.01em !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 7px !important;
            padding: 8px 18px !important;
            height: 38px !important;
            border-radius: var(--radius-btn) !important;
            text-decoration: none !important;
            cursor: pointer !important;
            user-select: none !important;
            white-space: nowrap !important;
            vertical-align: middle !important;
            transition: all 0.18s cubic-bezier(0.16, 1, 0.3, 1) !important;
            position: relative !important;
            outline: none !important;
        }

        .btn .material-symbols-outlined,
        .btn-clean-primary .material-symbols-outlined,
        .btn-luxury-primary .material-symbols-outlined,
        .btn-clean-secondary .material-symbols-outlined,
        .btn-glow .material-symbols-outlined,
        .btn-ghost-glow .material-symbols-outlined,
        .btn-action-clean .material-symbols-outlined {
            font-size: 18px !important;
            line-height: 1 !important;
            vertical-align: middle !important;
            transition: transform 0.18s ease !important;
        }

        /* 2. Interactive Micro-Interactions & Accessible States */
        .btn:active,
        .btn-clean-primary:active,
        .btn-luxury-primary:active,
        .btn-clean-secondary:active,
        .btn-action-icon:active,
        .btn-action-clean:active,
        .btn-icon-round:active {
            transform: scale(0.98) !important;
        }

        .btn:focus-visible,
        .btn-action-icon:focus-visible,
        .btn-action-clean:focus-visible,
        .btn-icon-round:focus-visible {
            outline: 2px solid var(--glowup-primary) !important;
            outline-offset: 2px !important;
        }

        .btn:disabled,
        .btn.disabled,
        button:disabled.btn {
            opacity: 0.55 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            transform: none !important;
            box-shadow: none !important;
        }

        /* 3. Primary Actions (Add, Create, Save, Update, Submit, Confirm) */
        .btn-primary,
        .btn-clean-primary,
        .btn-luxury-primary,
        .btn-glow {
            background: linear-gradient(135deg, #592E83 0%, #48236d 100%) !important;
            color: #ffffff !important;
            border: 1px solid transparent !important;
            box-shadow: 0 2px 8px rgba(89, 46, 131, 0.24), 0 1px 2px rgba(0, 0, 0, 0.04) !important;
        }

        .btn-primary:hover,
        .btn-clean-primary:hover,
        .btn-luxury-primary:hover,
        .btn-glow:hover {
            background: linear-gradient(135deg, #683699 0%, #592E83 100%) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 5px 16px rgba(89, 46, 131, 0.38), 0 2px 4px rgba(0, 0, 0, 0.06) !important;
        }

        /* 4. Secondary Actions (Cancel, Back, Close, Reset, Filter, Export) */
        .btn-secondary,
        .btn-outline-secondary,
        .btn-clean-secondary,
        .btn-ghost-glow {
            background: #ffffff !important;
            color: var(--glowup-secondary) !important;
            border: 1px solid var(--glowup-secondary) !important;
            box-shadow: 0 1px 3px rgba(72, 60, 70, 0.05) !important;
        }

        .btn-secondary:hover,
        .btn-outline-secondary:hover,
        .btn-clean-secondary:hover,
        .btn-ghost-glow:hover {
            background: var(--glowup-lavender-subtle) !important;
            color: var(--color-secondary-hover) !important;
            border-color: var(--color-secondary-hover) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(163, 105, 82, 0.18) !important;
        }

        /* 5. Outline Primary Actions */
        .btn-outline-primary {
            background: #ffffff !important;
            color: var(--glowup-primary) !important;
            border: 1px solid var(--glowup-primary) !important;
            box-shadow: 0 1px 3px rgba(89, 46, 131, 0.08) !important;
        }

        .btn-outline-primary:hover {
            background: var(--color-primary-subtle) !important;
            color: var(--glowup-primary) !important;
            border-color: var(--glowup-primary) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(89, 46, 131, 0.22) !important;
        }

        /* 6. Neutral / Dark Actions */
        .btn-dark,
        .btn-neutral {
            background: var(--glowup-dark) !important;
            color: #ffffff !important;
            border: 1px solid var(--glowup-dark) !important;
            box-shadow: 0 1px 4px rgba(72, 60, 70, 0.12) !important;
        }

        .btn-dark:hover,
        .btn-neutral:hover {
            background: var(--glowup-dark-hover) !important;
            border-color: var(--glowup-dark-hover) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(72, 60, 70, 0.25) !important;
        }

        /* 7. Destructive / Delete Actions (Delete, Remove, Reject, Destroy) */
        .btn-danger {
            background: #dc2626 !important;
            color: #ffffff !important;
            border: 1px solid #dc2626 !important;
            box-shadow: 0 2px 6px rgba(220, 38, 38, 0.22) !important;
        }

        .btn-danger:hover {
            background: #b91c1c !important;
            border-color: #b91c1c !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.35) !important;
        }

        .btn-outline-danger,
        .btn-delete {
            background: #ffffff !important;
            color: #dc2626 !important;
            border: 1px solid rgba(220, 38, 38, 0.35) !important;
            box-shadow: 0 1px 2px rgba(220, 38, 38, 0.05) !important;
        }

        .btn-outline-danger:hover,
        .btn-delete:hover {
            background: #fef2f2 !important;
            color: #b91c1c !important;
            border-color: #dc2626 !important;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(220, 38, 38, 0.18) !important;
        }

        /* 8. Success / Approval Actions (Approve, Complete, Activate, Publish, Mark Paid) */
        .btn-success {
            background: #16a34a !important;
            color: #ffffff !important;
            border: 1px solid #16a34a !important;
            box-shadow: 0 2px 6px rgba(22, 163, 74, 0.22) !important;
        }

        .btn-success:hover {
            background: #15803d !important;
            border-color: #15803d !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(22, 163, 74, 0.35) !important;
        }

        .btn-outline-success {
            background: #ffffff !important;
            color: #16a34a !important;
            border: 1px solid rgba(22, 163, 74, 0.35) !important;
            box-shadow: 0 1px 2px rgba(22, 163, 74, 0.05) !important;
        }

        .btn-outline-success:hover {
            background: #f0fdf4 !important;
            color: #15803d !important;
            border-color: #16a34a !important;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(22, 163, 74, 0.18) !important;
        }

        /* 9. Warning / Pause Actions */
        .btn-warning {
            background: #d97706 !important;
            color: #ffffff !important;
            border: 1px solid #d97706 !important;
        }

        .btn-warning:hover {
            background: #b45309 !important;
            border-color: #b45309 !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .btn-outline-warning {
            background: #ffffff !important;
            color: #d97706 !important;
            border: 1px solid rgba(217, 119, 6, 0.35) !important;
        }

        .btn-outline-warning:hover {
            background: #fffbeb !important;
            color: #b45309 !important;
            border-color: #d97706 !important;
            transform: translateY(-1px);
        }

        /* 10. Table Action Buttons (Compact, Icon-First, Perfectly Aligned) */
        .btn-action-icon,
        .btn-action-clean,
        .btn-icon-round {
            width: 32px !important;
            height: 32px !important;
            padding: 0 !important;
            border-radius: 8px !important;
            background: #ffffff !important;
            border: 1px solid var(--glowup-border-subtle) !important;
            color: var(--glowup-dark) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            transition: all 0.18s cubic-bezier(0.16, 1, 0.3, 1) !important;
            text-decoration: none !important;
            flex-shrink: 0 !important;
            box-shadow: 0 1px 2px rgba(72, 60, 70, 0.04) !important;
        }

        .btn-icon-round {
            border-radius: 50% !important;
        }

        .btn-action-icon .material-symbols-outlined,
        .btn-action-clean .material-symbols-outlined,
        .btn-icon-round .material-symbols-outlined {
            font-size: 17px !important;
            line-height: 1 !important;
            transition: transform 0.18s ease !important;
        }

        /* Default hover for table action buttons */
        .btn-action-icon:hover,
        .btn-action-clean:hover,
        .btn-icon-round:hover {
            background: var(--color-primary-subtle) !important;
            color: var(--glowup-primary) !important;
            border-color: rgba(89, 46, 131, 0.35) !important;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(89, 46, 131, 0.15) !important;
        }

        .btn-action-icon:hover .material-symbols-outlined,
        .btn-action-clean:hover .material-symbols-outlined,
        .btn-icon-round:hover .material-symbols-outlined {
            transform: scale(1.08);
        }

        /* Destructive action button variant */
        .btn-action-icon.btn-danger-icon,
        .btn-action-clean.btn-delete,
        .btn-icon-round.text-danger,
        .delete_btn {
            color: #dc2626 !important;
            border-color: rgba(220, 38, 38, 0.25) !important;
        }

        .btn-action-icon.btn-danger-icon:hover,
        .btn-action-clean.btn-delete:hover,
        .btn-icon-round.text-danger:hover,
        .delete_btn:hover {
            background: #fef2f2 !important;
            color: #b91c1c !important;
            border-color: #dc2626 !important;
            box-shadow: 0 3px 8px rgba(220, 38, 38, 0.2) !important;
        }

        /* Success action button variant */
        .btn-action-icon.btn-success-icon,
        .btn-icon-round.text-success {
            color: #16a34a !important;
            border-color: rgba(22, 163, 74, 0.25) !important;
        }

        .btn-action-icon.btn-success-icon:hover,
        .btn-icon-round.text-success:hover {
            background: #f0fdf4 !important;
            color: #15803d !important;
            border-color: #16a34a !important;
            box-shadow: 0 3px 8px rgba(22, 163, 74, 0.2) !important;
        }

        /* 11. Sizing Hierarchy */
        .btn-xs {
            height: 26px !important;
            padding: 2px 8px !important;
            font-size: 11px !important;
            border-radius: 6px !important;
            gap: 4px !important;
        }

        .btn-xs .material-symbols-outlined {
            font-size: 14px !important;
        }

        .btn-sm {
            height: 32px !important;
            padding: 4px 12px !important;
            font-size: 12px !important;
            border-radius: 8px !important;
            gap: 5px !important;
        }

        .btn-sm .material-symbols-outlined {
            font-size: 16px !important;
        }

        .btn-md {
            height: 38px !important;
            padding: 8px 18px !important;
            font-size: 13px !important;
            border-radius: 10px !important;
        }

        .btn-lg {
            height: 44px !important;
            padding: 10px 22px !important;
            font-size: 14px !important;
            border-radius: 12px !important;
            gap: 8px !important;
        }

        .btn-lg .material-symbols-outlined {
            font-size: 20px !important;
        }

        /* 12. Table Action Groups Container */
        td .d-flex.gap-1,
        td .d-inline-flex.gap-1 {
            flex-wrap: nowrap;
            align-items: center;
        }
        /* ==================== GLOBAL FORM DESIGN SYSTEM ==================== */

        /* 1. Form Card & Container */
        .clean-card,
        .form-card,
        .glass-panel {
            background: #ffffff !important;
            border: 1px solid var(--border-subtle) !important;
            border-radius: var(--radius-card) !important;
            box-shadow: var(--card-shadow) !important;
            padding: 24px !important;
            position: relative;
            transition: var(--transition-smooth);
        }

        .form-section-header,
        .clean-card-header {
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border-subtle);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .form-section-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--glowup-dark);
            margin: 0 0 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title .material-symbols-outlined {
            color: var(--glowup-primary);
            font-size: 20px;
        }

        .form-section-desc {
            font-size: 12.5px;
            color: var(--glowup-muted);
            margin: 0;
            line-height: 1.5;
        }

        /* 2. Labels & Required Indicators */
        .form-label,
        .form-label-glow {
            font-size: 11.5px !important;
            letter-spacing: 0.06em !important;
            text-transform: uppercase !important;
            font-weight: 700 !important;
            color: var(--glowup-dark) !important;
            margin-bottom: 6px !important;
            display: flex !important;
            align-items: center !important;
            gap: 6px !important;
        }

        .form-label .material-symbols-outlined,
        .form-label-glow .material-symbols-outlined {
            color: var(--glowup-primary) !important;
            font-size: 16px !important;
        }

        .form-label.required::after,
        .form-label .required-star,
        .req-star {
            content: " *" !important;
            color: #dc2626 !important;
            font-weight: 700 !important;
        }

        /* 3. Input Fields & Select Dropdowns */
        .form-control,
        .form-select,
        .clean-input,
        .clean-select,
        .form-control-glow {
            background-color: #ffffff !important;
            border: 1px solid var(--glowup-border) !important;
            border-radius: var(--radius-input) !important;
            color: var(--glowup-dark) !important;
            font-size: 13.5px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            padding: 8px 14px !important;
            height: 40px !important;
            box-shadow: 0 1px 2px rgba(72, 60, 70, 0.02) !important;
            transition: all 0.18s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }

        .form-control:hover,
        .form-select:hover,
        .clean-input:hover,
        .clean-select:hover,
        .form-control-glow:hover {
            border-color: #ba7e66 !important;
        }

        .form-control:focus,
        .form-select:focus,
        .clean-input:focus,
        .clean-select:focus,
        .form-control-glow:focus {
            background-color: #ffffff !important;
            border-color: var(--glowup-primary) !important;
            box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.14), 0 1px 3px rgba(0, 0, 0, 0.05) !important;
            outline: none !important;
            color: var(--glowup-dark) !important;
        }

        .form-control::placeholder,
        .clean-input::placeholder,
        .form-control-glow::placeholder {
            color: #988b97 !important;
            font-weight: 400 !important;
        }

        .form-control:disabled,
        .form-control[readonly],
        .form-select:disabled {
            background-color: #faf8fa !important;
            border-color: #ede6e4 !important;
            color: #887a86 !important;
            cursor: not-allowed !important;
            opacity: 0.85 !important;
        }

        /* Custom Elegant Select Arrow */
        .form-select,
        .clean-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23592E83' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center !important;
            background-size: 14px 10px !important;
            padding-right: 38px !important;
        }

        /* 4. Textarea Controls */
        textarea.form-control,
        textarea.clean-textarea,
        textarea.form-control-glow {
            height: auto !important;
            min-height: 105px !important;
            padding: 12px 14px !important;
            line-height: 1.5 !important;
            resize: vertical !important;
        }

        /* 5. Input Groups & Addons */
        .input-group {
            border-radius: var(--radius-input);
        }

        .input-group .input-group-text {
            background: var(--glowup-lavender-subtle) !important;
            border: 1px solid var(--glowup-border) !important;
            color: var(--glowup-secondary) !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            padding: 8px 13px !important;
            border-radius: var(--radius-input) !important;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        .input-group > :not(:last-child):not(.dropdown-toggle):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        /* 6. File Upload Controls */
        .form-control[type="file"],
        .clean-file-input {
            height: 42px !important;
            padding: 6px 12px !important;
            display: flex !important;
            align-items: center !important;
        }

        .form-control[type="file"]::file-selector-button,
        .clean-file-input::file-selector-button {
            background: var(--glowup-lavender-subtle) !important;
            border: 1px solid rgba(89, 46, 131, 0.22) !important;
            color: var(--glowup-primary) !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            padding: 5px 12px !important;
            margin-right: 12px !important;
            cursor: pointer !important;
            transition: all 0.18s ease !important;
        }

        .form-control[type="file"]::file-selector-button:hover,
        .clean-file-input::file-selector-button:hover {
            background: var(--glowup-primary) !important;
            color: #ffffff !important;
        }

        /* 7. Checkbox, Radio, and Toggle Switch Controls */
        .form-check {
            min-height: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .form-check-input {
            width: 18px !important;
            height: 18px !important;
            margin-top: 0 !important;
            border: 1.5px solid var(--glowup-border) !important;
            background-color: #ffffff !important;
            cursor: pointer !important;
            transition: all 0.15s ease-in-out !important;
            flex-shrink: 0;
        }

        .form-check-input:checked {
            background-color: var(--glowup-primary) !important;
            border-color: var(--glowup-primary) !important;
            box-shadow: 0 2px 6px rgba(89, 46, 131, 0.22) !important;
        }

        .form-check-input:focus {
            border-color: var(--glowup-primary) !important;
            box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.14) !important;
        }

        .form-check-label {
            color: var(--glowup-dark) !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            cursor: pointer !important;
            user-select: none;
        }

        .form-switch .form-check-input {
            width: 36px !important;
            height: 20px !important;
            border-radius: 20px !important;
        }

        /* 8. Help Text & Validation Messages */
        .form-text,
        .form-helper {
            font-size: 11.5px !important;
            color: var(--glowup-muted) !important;
            margin-top: 5px !important;
            line-height: 1.4 !important;
        }

        .invalid-feedback,
        .error-feedback {
            font-size: 11.5px !important;
            font-weight: 600 !important;
            color: #dc2626 !important;
            margin-top: 5px !important;
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
        }

        .is-invalid,
        .was-validated .form-control:invalid,
        .was-validated .form-select:invalid {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.14) !important;
        }

        .is-valid,
        .was-validated .form-control:valid,
        .was-validated .form-select:valid {
            border-color: #16a34a !important;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.14) !important;
        }

        .valid-feedback {
            font-size: 11.5px !important;
            font-weight: 600 !important;
            color: #16a34a !important;
            margin-top: 5px !important;
        }

        /* 9. Form Actions Footer Bar */
        .form-actions,
        .card-footer-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid var(--border-subtle);
            flex-wrap: wrap;
        }

        /* ==================== GLOBAL TABLE DESIGN SYSTEM ==================== */

        /* 1. Table Responsive Wrapper & Sleek Scrollbar */
        .table-responsive {
            border: 1px solid var(--border-subtle) !important;
            border-radius: var(--radius-card) !important;
            background: #ffffff !important;
            box-shadow: 0 2px 10px rgba(72, 60, 70, 0.03) !important;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #fcfbfa;
            border-radius: 3px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #d5ccd3;
            border-radius: 3px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: var(--glowup-secondary);
        }

        /* 2. Table Structure & Typography */
        .table,
        .clean-table,
        .cms-table,
        .table-glow {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            color: var(--glowup-dark) !important;
            margin-bottom: 0 !important;
        }

        /* 3. Table Header */
        .table thead th,
        .clean-table thead th,
        .cms-table thead th,
        .table-glow thead th {
            font-size: 11px !important;
            letter-spacing: 0.08em !important;
            text-transform: uppercase !important;
            color: var(--glowup-dark) !important;
            font-weight: 700 !important;
            padding: 13px 16px !important;
            border-bottom: 1.5px solid var(--border-subtle) !important;
            border-top: none !important;
            background: var(--glowup-lavender-subtle) !important;
            white-space: nowrap !important;
            vertical-align: middle !important;
        }

        /* 4. Table Body Rows & Cells */
        .table tbody td,
        .clean-table tbody td,
        .cms-table tbody td,
        .table-glow tbody td {
            padding: 13px 16px !important;
            font-size: 13px !important;
            line-height: 1.45 !important;
            border-bottom: 1px solid #f2ecf1 !important;
            border-top: none !important;
            vertical-align: middle !important;
            background: #ffffff;
            color: var(--glowup-dark);
            transition: background 0.15s ease !important;
        }

        .table tbody tr:hover td,
        .clean-table tbody tr:hover td,
        .cms-table tbody tr:hover td,
        .table-glow tbody tr:hover td {
            background: rgba(89, 46, 131, 0.025) !important;
        }

        .table tbody tr:last-child td,
        .clean-table tbody tr:last-child td,
        .cms-table tbody tr:last-child td,
        .table-glow tbody tr:last-child td {
            border-bottom: none !important;
        }

        /* Empty Table Row State */
        .table tbody td[colspan],
        .clean-table tbody td[colspan],
        .cms-table tbody td[colspan],
        .table-glow tbody td[colspan] {
            text-align: center !important;
            padding: 42px 20px !important;
            color: var(--glowup-muted) !important;
            font-size: 13.5px !important;
            background: #ffffff !important;
            font-weight: 500;
        }

        .table tbody td[colspan] .material-symbols-outlined,
        .clean-table tbody td[colspan] .material-symbols-outlined,
        .cms-table tbody td[colspan] .material-symbols-outlined,
        .table-glow tbody td[colspan] .material-symbols-outlined {
            color: var(--glowup-secondary) !important;
            opacity: 0.55;
            margin-bottom: 8px;
            display: inline-block;
        }

        /* 5. Cell Content Alignment */
        .table .text-end,
        .table th.text-end,
        .table td.text-end,
        .clean-table th.text-end,
        .clean-table td.text-end {
            text-align: right !important;
        }

        .table .text-center,
        .table th.text-center,
        .table td.text-center,
        .clean-table th.text-center,
        .clean-table td.text-center {
            text-align: center !important;
        }

        /* Truncation & Narrative Safety */
        .table td .text-truncate,
        .clean-table td .text-truncate {
            max-width: 320px;
            display: inline-block;
            vertical-align: middle;
        }

        /* Code identifiers in tables */
        .table td code,
        .clean-table td code,
        .table-glow td code {
            background: var(--color-primary-subtle) !important;
            color: var(--glowup-primary) !important;
            border: 1px solid rgba(89, 46, 131, 0.15) !important;
            padding: 2px 7px !important;
            border-radius: 6px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
        }

        /* Table Thumbnails */
        .bridal-thumb,
        .table-thumb,
        .service-thumb,
        .avatar-thumb {
            width: 44px !important;
            height: 44px !important;
            border-radius: 8px !important;
            object-fit: cover !important;
            border: 1px solid var(--border-subtle) !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06) !important;
            vertical-align: middle !important;
        }

        /* 6. Pagination System */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 4px;
            padding: 14px 20px;
            border-top: 1px solid var(--border-subtle);
            background: #ffffff;
            margin-bottom: 0;
            list-style: none;
        }

        .page-link {
            height: 34px;
            padding: 6px 13px;
            font-size: 12.5px;
            font-weight: 600;
            border-radius: 8px !important;
            border: 1px solid #eedcd6 !important;
            color: var(--glowup-dark) !important;
            background: #ffffff !important;
            text-decoration: none !important;
            transition: all 0.18s ease !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .page-link:hover {
            background: #f8f1ee !important;
            color: var(--glowup-secondary) !important;
            border-color: var(--glowup-secondary) !important;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #592E83 0%, #48236d 100%) !important;
            border-color: #592E83 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(89, 46, 131, 0.28) !important;
        }

        .page-item.disabled .page-link {
            opacity: 0.45 !important;
            cursor: not-allowed !important;
            background: #faf8fa !important;
        }

        /* ==================== STANDARDIZED STATUS BADGES ==================== */
        .badge,
        .badge-status,
        .badge-pill-status {
            font-size: 11px !important;
            font-weight: 700 !important;
            letter-spacing: 0.04em !important;
            text-transform: uppercase !important;
            padding: 4px 10px !important;
            border-radius: 999px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 4px !important;
            white-space: nowrap !important;
            line-height: 1.3 !important;
        }

        /* Success / Active / Confirmed / Completed / Published / Paid */
        .badge.bg-success,
        .badge-success,
        .badge-status.st-confirmed,
        .badge-status.st-active,
        .badge-status.st-published,
        .badge-status.st-completed,
        .badge-pill-status.status-active {
            background: #dcfce7 !important;
            color: #16a34a !important;
            border: 1px solid #bbf7d0 !important;
        }

        /* Warning / Pending / In Progress / Scheduled / Partially Paid / Under Review */
        .badge.bg-warning,
        .badge-warning,
        .badge-status.st-pending,
        .badge-status.st-scheduled,
        .badge-status.st-in-progress,
        .badge-status.st-warning {
            background: #f8f1ee !important;
            color: #A36952 !important;
            border: 1px solid #eedcd6 !important;
        }

        /* Danger / Cancelled / Inactive / Overdue / Rejected */
        .badge.bg-danger,
        .badge-danger,
        .badge-status.st-cancelled,
        .badge-status.st-inactive,
        .badge-status.st-draft,
        .badge-status.st-overdue,
        .badge-pill-status.status-inactive {
            background: #fee2e2 !important;
            color: #dc2626 !important;
            border: 1px solid #fecaca !important;
        }

        /* Primary / Sent / Converted / Featured / Premium */
        .badge.bg-primary,
        .badge.bg-info,
        .badge-primary,
        .badge-info,
        .badge-status.st-primary,
        .badge-status.st-info {
            background: #f4edf7 !important;
            color: #592E83 !important;
            border: 1px solid #dfcfeb !important;
        }

        /* Neutral / Draft / Closed / Archived */
        .badge.bg-secondary,
        .badge-secondary,
        .badge-status.st-secondary {
            background: #f4f2f4 !important;
            color: #6f626d !important;
            border: 1px solid #ede6e4 !important;
        }

        /* ==================== SEARCH & FILTER TOOLBAR ==================== */
        .filter-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .filter-pills {
            display: inline-flex;
            gap: 4px;
            background: #f8f6f8;
            padding: 3px;
            border-radius: 10px;
            border: 1px solid var(--border-subtle);
            overflow-x: auto;
            max-width: 100%;
        }

        .filter-pill-btn {
            background: transparent;
            border: none;
            color: var(--glowup-muted);
            font-size: 12px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 7px;
            cursor: pointer;
            transition: all 0.15s ease;
            white-space: nowrap;
        }

        .filter-pill-btn:hover {
            color: var(--glowup-dark);
        }

        .filter-pill-btn.active {
            background: #ffffff;
            color: var(--glowup-primary);
            border: 1px solid var(--glowup-primary);
            box-shadow: 0 1px 3px rgba(89, 46, 131, 0.15);
        }

        .search-box-glow {
            position: relative;
            min-width: 250px;
            flex: 1;
            max-width: 360px;
        }

        .search-box-glow .material-symbols-outlined {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--glowup-secondary);
            font-size: 18px;
            pointer-events: none;
        }

        .search-input-glow {
            width: 100%;
            background: #ffffff !important;
            border: 1px solid var(--glowup-border) !important;
            border-radius: var(--radius-input) !important;
            color: var(--glowup-dark) !important;
            font-size: 13px !important;
            padding: 8px 14px 8px 38px !important;
            height: 38px !important;
            transition: var(--transition-smooth) !important;
        }

        .search-input-glow:focus {
            outline: none !important;
            border-color: var(--glowup-primary) !important;
            box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.14) !important;
        }

        /* ==================== MODALS ==================== */
        .modal-content,
        .modal-content-glow {
            background: #ffffff !important;
            border: 1px solid var(--border-subtle) !important;
            border-radius: 16px !important;
            box-shadow: var(--modal-shadow) !important;
            color: var(--text-main) !important;
        }

        .modal-header,
        .modal-header-glow {
            border-bottom: 1px solid var(--border-subtle) !important;
            padding: 18px 24px !important;
            color: var(--text-main) !important;
            background: #ffffff !important;
            border-top-left-radius: 16px !important;
            border-top-right-radius: 16px !important;
        }

        .modal-header .btn-close,
        .modal-header .btn-close-white {
            filter: none !important;
            opacity: 0.65;
            transition: var(--transition-smooth);
        }

        .modal-header .btn-close:hover,
        .modal-header .btn-close-white:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .modal-title {
            font-family: var(--font-serif);
            font-size: 1.35rem;
            color: var(--text-main) !important;
            font-weight: 700;
        }

        .modal-body {
            padding: 24px !important;
            color: var(--text-main) !important;
        }

        .modal-footer,
        .modal-footer-glow {
            border-top: 1px solid var(--border-subtle) !important;
            background: #faf8fa !important;
            padding: 16px 24px !important;
            border-bottom-left-radius: 16px !important;
            border-bottom-right-radius: 16px !important;
        }

        /* ==================== EMPTY STATES ==================== */
        .admin-empty-state {
            padding: 48px 24px;
            text-align: center;
        }

        .admin-empty-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--color-primary-subtle);
            border: 1px solid var(--color-primary-border);
            color: var(--color-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 4px 14px rgba(89, 46, 131, 0.08);
        }

        .admin-empty-icon .material-symbols-outlined {
            font-size: 30px;
        }

        .admin-empty-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .admin-empty-desc {
            font-size: 13px;
            color: var(--text-muted);
            max-width: 440px;
            margin: 0 auto 20px;
            line-height: 1.5;
        }

        /* ==================== LOADING & SKELETON ==================== */
        .admin-spinner {
            width: 24px;
            height: 24px;
            border: 2px solid var(--color-primary-subtle);
            border-top-color: var(--color-primary);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .admin-skeleton {
            background: linear-gradient(90deg, #f4edf7 25%, #faf7fc 50%, #f4edf7 75%);
            background-size: 200% 100%;
            animation: skeletonShimmer 1.5s infinite;
            border-radius: 6px;
        }

        @keyframes skeletonShimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ==================== TOASTERS ==================== */
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
            border: 1px solid var(--color-secondary);
            border-radius: 16px;
            box-shadow: 0 16px 36px rgba(72, 60, 70, 0.15);
            color: var(--text-main);
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

        .toast-error { border-color: #fecaca; }
        .toast-error .toast-icon-box { color: #dc2626; background: #fee2e2; border: 1px solid #fecaca; }
        .toast-success { border-color: #bbf7d0; }
        .toast-success .toast-icon-box { color: #16a34a; background: #dcfce7; border: 1px solid #bbf7d0; }
        .toast-info { border-color: var(--color-secondary); }
        .toast-info .toast-icon-box { color: #592E83; background: #f4edf7; border: 1px solid #dfcfeb; }
        .toast-warning { border-color: #fde68a; }
        .toast-warning .toast-icon-box { color: #d97706; background: #fef3c7; border: 1px solid #fde68a; }

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

        .toast-body { flex-grow: 1; padding-top: 1px; }
        .toast-title { font-size: 13.5px; font-weight: 700; color: var(--text-main); margin-bottom: 3px; }
        .toast-message { font-size: 12.5px; color: var(--text-muted); line-height: 1.45; margin: 0; }

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
            transition: var(--transition-smooth);
        }

        .toast-close-btn:hover {
            color: var(--color-primary) !important;
            background: var(--color-primary-subtle);
        }

        .toast-close-btn .material-symbols-outlined { font-size: 18px; color: inherit !important; }

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

        .toast-error .toast-progress-bar { background: linear-gradient(90deg, #ef4444, #f87171); }
        .toast-success .toast-progress-bar { background: linear-gradient(90deg, #10b981, #34d399); }
        .toast-info .toast-progress-bar { background: linear-gradient(90deg, #592E83, #A36952); }
        .toast-warning .toast-progress-bar { background: linear-gradient(90deg, #A36952, #d97706); }

        @keyframes toastCountdown {
            from { width: 100%; }
            to { width: 0%; }
        }

        /* ==================== TABS & PAGINATION ==================== */
        .nav-tabs,
        .nav-tabs-cms {
            border-bottom: 2px solid var(--border-subtle);
            gap: 6px;
        }

        .nav-tabs .nav-link,
        .nav-tabs-cms .nav-link {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13.5px;
            border: none;
            border-bottom: 2px solid transparent;
            padding: 10px 18px;
            background: transparent;
            border-radius: 0;
            transition: var(--transition-smooth);
        }

        .nav-tabs .nav-link:hover,
        .nav-tabs-cms .nav-link:hover {
            color: var(--color-primary);
            border-bottom-color: var(--color-secondary);
        }

        .nav-tabs .nav-link.active,
        .nav-tabs-cms .nav-link.active {
            color: var(--color-primary) !important;
            border-bottom: 2px solid var(--color-primary) !important;
            background: transparent;
            font-weight: 700;
        }

        .nav-pills .nav-link {
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 600;
            border-radius: var(--radius-btn);
            padding: 8px 16px;
            transition: var(--transition-smooth);
            background: #ffffff;
            border: 1px solid var(--border-subtle);
        }

        .nav-pills .nav-link:hover {
            color: var(--color-primary);
            background: var(--color-primary-subtle);
            border-color: var(--color-secondary);
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #592E83, #48236d) !important;
            color: #ffffff !important;
            border-color: #592E83 !important;
            box-shadow: 0 3px 12px rgba(89, 46, 131, 0.25);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
        }

        .page-link {
            background: #ffffff;
            border: 1px solid #eedcd6;
            color: var(--text-main);
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px !important;
            padding: 7px 13px;
            transition: var(--transition-smooth);
            box-shadow: 0 1px 2px rgba(72, 60, 70, 0.03);
            text-decoration: none;
        }

        .page-link:hover {
            background: #f8f1ee;
            border-color: var(--color-secondary);
            color: var(--color-secondary);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #592E83, #48236d) !important;
            border-color: #592E83 !important;
            color: #ffffff !important;
            box-shadow: 0 3px 10px rgba(89, 46, 131, 0.3) !important;
        }

        /* ==================== FOOTER ==================== */
        .admin-footer {
            margin-top: 48px;
            padding-top: 20px;
            border-top: 1px solid var(--border-subtle);
            font-size: 12px;
            color: var(--text-dim);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .admin-footer a {
            color: var(--color-secondary);
            text-decoration: none;
            font-weight: 600;
        }

        .admin-footer a:hover {
            color: var(--color-primary);
            text-decoration: underline;
        }

        /* ==================== RESPONSIVE OVERRIDES ==================== */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 18px 16px 60px;
            }
            .mobile-toggle {
                display: flex !important;
            }
            .card,
            .glass-panel,
            .clean-card,
            .cms-card {
                padding: 16px;
            }
        }

        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }
            .form-actions .btn {
                width: 100%;
            }
            .pagination {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .topbar-right {
                width: 100%;
                justify-content: space-between;
            }
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }
            .filter-pills {
                width: 100%;
            }
            .search-box-glow {
                min-width: 100%;
                max-width: 100%;
            }
            .table thead th,
            .table tbody td,
            .clean-table thead th,
            .clean-table tbody td {
                padding: 10px 12px !important;
                font-size: 12px !important;
            }
            .clean-card,
            .form-card,
            .glass-panel {
                padding: 18px 14px !important;
                border-radius: 12px !important;
            }
        }
    </style>
</head>

<body>

<?php
// Dynamic notifications & Admin user resolution
$unreadCount = 0;
$notificationList = [];
try {
    $dbConn = \Config\Database::connect();
    if ($dbConn) {
        if ($dbConn->tableExists('reviews')) {
            $pendingReviews = $dbConn->table('reviews')->where('status', 'draft')->orWhere('status', 'pending')->countAllResults();
            $unreadCount += $pendingReviews;
            $recentReviews = $dbConn->table('reviews')->orderBy('id', 'DESC')->limit(3)->get()->getResultArray();
            foreach ($recentReviews as $rr) {
                $notificationList[] = [
                    'icon'  => 'rate_review',
                    'title' => 'Review: ' . esc($rr['customer_name'] ?? 'Patron'),
                    'desc'  => esc($rr['headline'] ?? substr($rr['review_text'] ?? '', 0, 42) . '...'),
                    'time'  => !empty($rr['created_at']) ? date('M d, H:i', strtotime($rr['created_at'])) : 'Recent',
                    'url'   => base_url('admin/website/reviews'),
                ];
            }
        }
        if ($dbConn->tableExists('customers')) {
            $recentCust = $dbConn->table('customers')->orderBy('id', 'DESC')->limit(2)->get()->getResultArray();
            foreach ($recentCust as $rc) {
                $notificationList[] = [
                    'icon'  => 'person',
                    'title' => 'Client: ' . esc($rc['name'] ?? 'Guest'),
                    'desc'  => esc($rc['email'] ?? 'Registered online'),
                    'time'  => !empty($rc['created_at']) ? date('M d, H:i', strtotime($rc['created_at'])) : 'Recent',
                    'url'   => base_url('admin/website/customer'),
                ];
            }
        }
    }
} catch (\Throwable $e) {}

$adminUser = $admin ?? [
    'name'   => session()->get('admin_name') ?? 'Alex Vance',
    'role'   => session()->get('admin_role') ?? 'Super Administrator',
    'avatar' => session()->get('admin_avatar') ?? 'AV',
    'email'  => session()->get('admin_email') ?? 'admin@glowup.com',
];
?>

    <div class="admin-layout">

        <!-- ==================== SIDEBAR ==================== -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <a href="<?= base_url('admin/dashboard') ?>" style="display: block; text-decoration: none;">
                    <img src="<?= base_url('assets/images/Glowup_Logo_Black_White.png') ?>" alt="Glowup Logo" class="sidebar-brand-logo" />
                </a>
                <small>Beauty &amp; Academy Admin</small>
            </div>

            <!-- DASHBOARD -->
            <div class="sidebar-label">Main</div>
            <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'dashboard' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>

            <!-- WEBSITE CONTENT -->
            <div class="sidebar-label">Website Content</div>
            <a href="<?= base_url('admin/homepage') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'homepage' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">home</span>
                Homepage
            </a>
            <a href="<?= base_url('admin/website/aboutus') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'website_aboutus' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">info</span>
                About Us
            </a>
            <a href="<?= base_url('admin/website/services') ?>" class="sidebar-link <?= in_array(($activeMenu ?? ''), ['website_services', 'services']) ? 'active' : '' ?>">
                <span class="material-symbols-outlined">spa</span>
                Services
            </a>
            <a href="<?= base_url('admin/seo') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'seo' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">search</span>
                SEO
            </a>
            <!-- FOOTER CMS ACCORDION -->
            <?php $isFooterActive = str_starts_with(($activeMenu ?? ''), 'footer_') || ($activeMenu ?? '') === 'website_footer'; ?>
            <div class="sidebar-dropdown <?= $isFooterActive ? 'open active-group' : '' ?>" id="footerSidebarDropdown">
                <a href="javascript:void(0);" class="sidebar-dropdown-toggle <?= $isFooterActive ? 'active' : '' ?>" id="footerDropdownToggle">
                    <span class="material-symbols-outlined">dock</span>
                    <span>Footer CMS</span>
                    <span class="material-symbols-outlined arrow-icon">expand_more</span>
                </a>
                <div class="sidebar-submenu" id="footerSubmenu">
                    <a href="<?= base_url('admin/website/footer/brand') ?>" class="sidebar-submenu-link <?= ($activeMenu ?? '') === 'footer_brand' ? 'active' : '' ?>">
                        <span>Brand &amp; Logo</span>
                    </a>
                    <a href="<?= base_url('admin/website/footer/quick-links') ?>" class="sidebar-submenu-link <?= ($activeMenu ?? '') === 'footer_quick_links' ? 'active' : '' ?>">
                        <span>Quick Links</span>
                    </a>
                    <a href="<?= base_url('admin/website/footer/treatments') ?>" class="sidebar-submenu-link <?= ($activeMenu ?? '') === 'footer_treatments' ? 'active' : '' ?>">
                        <span>Popular Treatments</span>
                    </a>
                    <a href="<?= base_url('admin/website/footer/concierge') ?>" class="sidebar-submenu-link <?= ($activeMenu ?? '') === 'footer_concierge' ? 'active' : '' ?>">
                        <span>Concierge &amp; Address</span>
                    </a>
                    <a href="<?= base_url('admin/website/footer/social') ?>" class="sidebar-submenu-link <?= ($activeMenu ?? '') === 'footer_social' ? 'active' : '' ?>">
                        <span>Social Handles</span>
                    </a>
                    <a href="<?= base_url('admin/website/footer/bottom') ?>" class="sidebar-submenu-link <?= ($activeMenu ?? '') === 'footer_bottom' ? 'active' : '' ?>">
                        <span>Bottom &amp; Copyright</span>
                    </a>
                </div>
            </div>

            <!-- BUSINESS -->
            <div class="sidebar-label">Business Management</div>
            <a href="<?= base_url('admin/bookings') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'bookings' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">calendar_month</span>
                Bookings &amp; Schedule
            </a>
            <a href="<?= base_url('admin/invoices') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'invoices' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">receipt_long</span>
                Invoices &amp; Billing
            </a>
            <a href="<?= base_url('admin/courses') ?>" class="sidebar-link <?= in_array(($activeMenu ?? ''), ['courses', 'website_academy']) ? 'active' : '' ?>">
                <span class="material-symbols-outlined">school</span>
                Academy Courses
            </a>
            <a href="<?= base_url('admin/business/bridal') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'bridal' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">diamond</span>
                Bridal Packages
            </a>
            <a href="<?= base_url('admin/business/rentals') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'rentals' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">styler</span>
                Rentals &amp; Jewellery
            </a>
            <a href="<?= base_url('admin/business/photoshoot') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'photoshoot' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">photo_camera</span>
                Photoshoot
            </a>

            <!-- CRM & CLIENT PIPELINE -->
            <div class="sidebar-label">CRM &amp; Client Pipeline</div>
            <a href="<?= base_url('admin/crm/leads') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'crm_leads' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">filter_alt</span>
                Leads Pipeline
            </a>
            <a href="<?= base_url('admin/crm/followups') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'crm_followups' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">alarm</span>
                Client Follow-ups
            </a>
            <a href="<?= base_url('admin/website/customer') ?>" class="sidebar-link <?= in_array(($activeMenu ?? ''), ['website_customer', 'clients']) ? 'active' : '' ?>">
                <span class="material-symbols-outlined">group</span>
                Customer Dossiers
            </a>
            <a href="<?= base_url('admin/enquiry') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'enquiry' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">mail</span>
                Website Enquiries
            </a>
            <a href="<?= base_url('admin/website/reviews') ?>" class="sidebar-link <?= in_array(($activeMenu ?? ''), ['website_reviews', 'system_reviews']) ? 'active' : '' ?>">
                <span class="material-symbols-outlined">rate_review</span>
                Reviews Folio
                <?php if ($unreadCount > 0): ?>
                    <span class="sidebar-badge"><?= $unreadCount ?></span>
                <?php endif; ?>
            </a>

            <!-- MARKETING & COMMUNICATION -->
            <div class="sidebar-label">Marketing &amp; Growth</div>
            <a href="<?= base_url('admin/marketing/offers') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'offers' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">local_offer</span>
                Promotional Offers
            </a>
            <a href="<?= base_url('admin/marketing/communication-center') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'communication_center' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">campaign</span>
                Communication Center
            </a>
            <a href="<?= base_url('admin/settings/email-templates') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'email_templates' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">mark_email_read</span>
                Email Templates
            </a>

            <!-- INTEGRATIONS -->
            <div class="sidebar-label">Integrations &amp; APIs</div>
            <a href="<?= base_url('admin/settings/integrations') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'integrations' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">hub</span>
                API Keys &amp; Channels
            </a>

            <!-- MEDIA -->
            <div class="sidebar-label">Media &amp; Stories</div>
            <a href="<?= base_url('admin/website/gallery') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'website_gallery' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">photo_library</span>
                Lookbook Gallery
            </a>
            <a href="<?= base_url('admin/media/portfolio') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'portfolio' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">auto_awesome_mosaic</span>
                Portfolio Folio
            </a>
            <a href="<?= base_url('admin/blog') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'blog' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">article</span>
                Editorial Blog
            </a>

            <!-- SETTINGS & SYSTEM -->
            <div class="sidebar-label">Settings &amp; System</div>
            <a href="<?= base_url('admin/settings') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'settings' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">settings</span>
                General Settings
            </a>
            <a href="<?= base_url('admin/settings/profile') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'profile' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">manage_accounts</span>
                Admin Profile
            </a>
            <a href="<?= base_url('admin/logout') ?>" class="sidebar-link" style="color: #dc2626 !important;">
                <span class="material-symbols-outlined" style="color: #dc2626;">logout</span>
                Sign Out
            </a>
        </aside>

        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <!-- ==================== MAIN CONTENT ==================== -->
        <main class="main-content">

            <!-- TOPBAR -->
            <div class="topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="mobile-toggle" id="menuToggle" aria-label="Toggle menu">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <div class="topbar-left">
                        <h1>
                            <?php if (!empty($pageIcon)): ?>
                                <span class="material-symbols-outlined" style="color: var(--accent); font-size: 28px;"><?= esc($pageIcon) ?></span>
                            <?php endif; ?>
                            <?= esc($pageHeading ?? 'Beauty & Academy Admin') ?>
                        </h1>
                        <div class="breadcrumb-sub">
                            <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                            <?php if (($breadcrumbTitle ?? '') !== 'Dashboard'): ?>
                                <?php if (!empty($breadcrumbSection)): ?>
                                    <span class="material-symbols-outlined" style="font-size: 14px;">chevron_right</span>
                                    <span><?= esc($breadcrumbSection) ?></span>
                                <?php endif; ?>
                                <span class="material-symbols-outlined" style="font-size: 14px;">chevron_right</span>
                                <span style="color: var(--text-main); font-weight: 600;"><?= esc($breadcrumbTitle ?? $pageHeading ?? '') ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="topbar-right">
                    <!-- Live Site Link -->
                    <a href="<?= base_url('/') ?>" target="_blank" class="btn-ghost-glow d-none d-md-inline-flex" title="Preview Frontend Website">
                        <span class="material-symbols-outlined" style="font-size: 18px;">open_in_new</span>
                        Live Site
                    </a>

                    <!-- Notifications Dropdown -->
                    <div class="dropdown notification-dropdown">
                        <button type="button" class="notification-btn" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                            <span class="material-symbols-outlined" style="font-size: 22px;">notifications</span>
                            <?php if ($unreadCount > 0): ?>
                                <span class="notification-badge"><?= $unreadCount ?></span>
                            <?php endif; ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end notification-menu">
                            <div class="notification-head">
                                <h6>Notifications</h6>
                                <a href="<?= base_url('admin/website/reviews') ?>">Mark All Read</a>
                            </div>
                            <div class="notification-body">
                                <?php if (!empty($notificationList)): ?>
                                    <?php foreach ($notificationList as $note): ?>
                                        <a href="<?= $note['url'] ?>" class="notification-item">
                                            <div class="notification-icon-box">
                                                <span class="material-symbols-outlined"><?= $note['icon'] ?></span>
                                            </div>
                                            <div class="notification-content">
                                                <div class="notification-title"><?= $note['title'] ?></div>
                                                <div class="notification-text"><?= $note['desc'] ?></div>
                                                <div class="notification-time"><?= $note['time'] ?></div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-4 text-muted" style="font-size: 12.5px;">
                                        <span class="material-symbols-outlined d-block mb-1" style="font-size: 32px; color: var(--text-dim);">notifications_off</span>
                                        No new notifications at this time
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="notification-foot">
                                <a href="<?= base_url('admin/website/reviews') ?>">View All Recent Activity</a>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Profile Dropdown -->
                    <div class="dropdown user-dropdown">
                        <div class="admin-chip" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                            <div class="admin-chip-avatar">
                                <?= esc($adminUser['avatar'] ?? 'AV') ?>
                            </div>
                            <div class="d-none d-sm-block text-start">
                                <div class="admin-chip-name"><?= esc($adminUser['name'] ?? 'Alex Vance') ?></div>
                                <div class="admin-chip-role"><?= esc($adminUser['role'] ?? 'Super Administrator') ?></div>
                            </div>
                            <span class="material-symbols-outlined d-none d-sm-inline" style="font-size: 18px; color: var(--text-dim);">expand_more</span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-end user-dropdown-menu">
                            <div class="user-dropdown-header">
                                <div class="admin-chip-avatar" style="width: 40px; height: 40px; font-size: 14px;">
                                    <?= esc($adminUser['avatar'] ?? 'AV') ?>
                                </div>
                                <div style="min-width: 0;">
                                    <div style="font-weight: 700; font-size: 13.5px; color: var(--text-main);"><?= esc($adminUser['name'] ?? 'Alex Vance') ?></div>
                                    <div style="font-size: 11.5px; color: var(--text-muted); text-overflow: ellipsis; overflow: hidden;"><?= esc($adminUser['email'] ?? 'admin@glowup.com') ?></div>
                                    <span class="badge bg-primary mt-1" style="font-size: 10px;"><?= esc($adminUser['role'] ?? 'Administrator') ?></span>
                                </div>
                            </div>
                            <a href="<?= base_url('admin/settings/profile') ?>" class="user-dropdown-item">
                                <span class="material-symbols-outlined">person</span>
                                Edit Profile
                            </a>
                            <a href="<?= base_url('admin/settings') ?>" class="user-dropdown-item">
                                <span class="material-symbols-outlined">settings</span>
                                System Settings
                            </a>
                            <a href="<?= base_url('/') ?>" target="_blank" class="user-dropdown-item">
                                <span class="material-symbols-outlined">visibility</span>
                                View Live Site
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('admin/logout') ?>" class="user-dropdown-item text-danger">
                                <span class="material-symbols-outlined">logout</span>
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAGE CONTENT INJECTION -->
            <?= $this->renderSection('content') ?>

            <!-- ADMIN LAYOUT FOOTER -->
            <footer class="admin-footer">
                <div>&copy; <?= date('Y') ?> <strong>Glowup Beauty Studio &amp; Academy</strong>. All Rights Reserved.</div>
                <div>Curated with Luxury Precision &bull; <a href="<?= base_url('/') ?>" target="_blank">Live Frontend Portal</a></div>
            </footer>

        </main>
    </div>

    <!-- TOAST CONTAINER -->
    <div id="toastContainer" class="toast-container" aria-live="polite"></div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CORE INTERACTION SCRIPT -->
    <script>
        // Sidebar drawer
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const menuToggle = document.getElementById('menuToggle');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                backdrop.classList.toggle('show');
            });
        }
        if (backdrop) {
            backdrop.addEventListener('click', () => {
                sidebar.classList.remove('open');
                backdrop.classList.remove('show');
            });
        }

        // ==================== SMOOTH SIDEBAR ACTIVE STATE & SCROLL STABILITY ====================
        function initSidebarActiveState() {
            const sidebarLinks = document.querySelectorAll('.sidebar-link, .sidebar-submenu-link');
            if (!sidebarLinks.length) return;

            // 1. Immediately and smoothly activate clicked sidebar menu item
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (e.ctrlKey || e.metaKey || e.shiftKey || this.target === '_blank') return;

                    const currentPath = window.location.pathname.replace(/\/+$/, '').toLowerCase();
                    const currentUrl = window.location.href.split(/[?#]/)[0].replace(/\/+$/, '').toLowerCase();
                    const linkHref = this.href ? this.href.split(/[?#]/)[0].replace(/\/+$/, '').toLowerCase() : '';
                    let linkPath = '';
                    try {
                        linkPath = new URL(this.href, window.location.origin).pathname.replace(/\/+$/, '').toLowerCase();
                    } catch (err) {}

                    // If already on this page: prevent automatic scroll-to-top / reload
                    if (linkHref === currentUrl || linkPath === currentPath) {
                        e.preventDefault();
                        return;
                    }

                    // Save current page and sidebar scroll positions to keep them stable during navigation
                    const pageY = window.scrollY || window.pageYOffset || document.documentElement.scrollTop || 0;
                    sessionStorage.setItem('glowup_admin_scroll_y', String(pageY));
                    if (sidebar) {
                        sessionStorage.setItem('glowup_admin_sidebar_scroll_y', String(sidebar.scrollTop || 0));
                    }

                    // Immediately and smoothly activate clicked item
                    if (this.classList.contains('sidebar-submenu-link')) {
                        document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                        document.querySelectorAll('.sidebar-submenu-link').forEach(l => l.classList.remove('active'));
                        this.classList.add('active');

                        const parentDropdown = this.closest('.sidebar-dropdown');
                        if (parentDropdown) {
                            parentDropdown.classList.add('open');
                            parentDropdown.classList.add('active-group');
                            const toggle = parentDropdown.querySelector('.sidebar-dropdown-toggle');
                            if (toggle) toggle.classList.add('active');
                        }
                    } else {
                        document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                        document.querySelectorAll('.sidebar-submenu-link').forEach(l => l.classList.remove('active'));
                        document.querySelectorAll('.sidebar-dropdown').forEach(d => {
                            d.classList.remove('active-group');
                            const toggle = d.querySelector('.sidebar-dropdown-toggle');
                            if (toggle) toggle.classList.remove('active');
                        });
                        this.classList.add('active');
                    }
                });
            });

            // 2. On page load: sync active sidebar item accurately based on current page URL
            const currentPath = window.location.pathname.replace(/\/+$/, '').toLowerCase();
            const currentUrl = window.location.href.split(/[?#]/)[0].replace(/\/+$/, '').toLowerCase();

            let matchedLink = null;
            sidebarLinks.forEach(link => {
                if (!link.href) return;
                const linkHref = link.href.split(/[?#]/)[0].replace(/\/+$/, '').toLowerCase();
                let linkPath = '';
                try {
                    linkPath = new URL(link.href, window.location.origin).pathname.replace(/\/+$/, '').toLowerCase();
                } catch (err) {}

                if (linkHref === currentUrl || linkPath === currentPath) {
                    matchedLink = link;
                }
            });

            if (matchedLink) {
                if (matchedLink.classList.contains('sidebar-submenu-link')) {
                    document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                    document.querySelectorAll('.sidebar-submenu-link').forEach(l => l.classList.remove('active'));
                    matchedLink.classList.add('active');

                    const parentDropdown = matchedLink.closest('.sidebar-dropdown');
                    if (parentDropdown) {
                        parentDropdown.classList.add('open');
                        parentDropdown.classList.add('active-group');
                        const toggle = parentDropdown.querySelector('.sidebar-dropdown-toggle');
                        if (toggle) toggle.classList.add('active');
                    }
                } else {
                    document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                    matchedLink.classList.add('active');
                }
            }
        }

        // Restore scroll positions stably on navigation
        function restoreAdminScrollPositions() {
            const savedPageScroll = sessionStorage.getItem('glowup_admin_scroll_y');
            const savedSidebarScroll = sessionStorage.getItem('glowup_admin_sidebar_scroll_y');

            if (savedPageScroll !== null) {
                const topY = parseInt(savedPageScroll, 10);
                if (!isNaN(topY)) {
                    window.scrollTo(0, topY);
                    document.documentElement.scrollTop = topY;
                    document.body.scrollTop = topY;
                }
            }

            if (savedSidebarScroll !== null && sidebar) {
                const sY = parseInt(savedSidebarScroll, 10);
                if (!isNaN(sY)) {
                    const prevBehavior = sidebar.style.scrollBehavior;
                    sidebar.style.scrollBehavior = 'auto';
                    sidebar.scrollTop = sY;
                    requestAnimationFrame(() => {
                        sidebar.style.scrollBehavior = prevBehavior;
                    });
                }
            }

            requestAnimationFrame(() => {
                sessionStorage.removeItem('glowup_admin_scroll_y');
                sessionStorage.removeItem('glowup_admin_sidebar_scroll_y');
            });
        }

        initSidebarActiveState();
        initFooterSubmenu();
        restoreAdminScrollPositions();
        window.addEventListener('DOMContentLoaded', restoreAdminScrollPositions);

        // ==================== SIDEBAR SUBMENU ACCORDIONS ====================
        function initFooterSubmenu() {
            document.querySelectorAll('.sidebar-dropdown-toggle').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = this.closest('.sidebar-dropdown');
                    if (parent) parent.classList.toggle('open');
                });
            });

            const isFooterPage = window.location.pathname.toLowerCase().includes('/admin/website/footer');
            const footerDropdown = document.getElementById('footerSidebarDropdown');
            const footerToggle = document.getElementById('footerDropdownToggle');
            if (isFooterPage && footerDropdown && footerToggle) {
                footerDropdown.classList.add('open');
                footerDropdown.classList.add('active-group');
                footerToggle.classList.add('active');
            }
        }

        // Universal Luxury Toaster Notification Function
        function showToast(type, title, message) {
            const container = document.getElementById('toastContainer');
            if (!container) return;

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

        // Backward-compatible helper: showGlowToast(message, type, title)
        function showGlowToast(message, type = 'success', title = '') {
            if (!title) {
                if (type === 'success') {
                    title = /authentication\s+verified|welcome/i.test(message) ? 'Verified' : (/updated/i.test(message) ? 'Updated' : (/deleted|removed/i.test(message) ? 'Deleted' : 'Success'));
                } else if (type === 'error') {
                    title = 'Notice';
                } else if (type === 'warning') {
                    title = 'Warning';
                } else {
                    title = 'Info';
                }
            }
            showToast(type, title, message);
        }

        // Trigger Server Flash Toasts on page load
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($flashSuccess = session()->getFlashdata('success')): ?>
                <?php 
                    $successTitle = (stripos($flashSuccess, 'Authentication verified') !== false || stripos($flashSuccess, 'Welcome') !== false) 
                        ? 'Verified' 
                        : (stripos($flashSuccess, 'updated') !== false ? 'Updated' : (stripos($flashSuccess, 'removed') !== false || stripos($flashSuccess, 'deleted') !== false ? 'Deleted' : 'Success'));
                ?>
                showToast('success', <?= json_encode($successTitle) ?>, <?= json_encode($flashSuccess) ?>);
            <?php endif; ?>

            <?php if ($flashError = session()->getFlashdata('error')): ?>
                showToast('error', 'Action Notice', <?= json_encode($flashError) ?>);
            <?php endif; ?>

            <?php if ($flashErrors = session()->getFlashdata('errors')): ?>
                <?php foreach ((array) $flashErrors as $err): ?>
                    showToast('error', 'Validation Notice', <?= json_encode($err) ?>);
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($flashInfo = session()->getFlashdata('info')): ?>
                showToast('info', 'Information', <?= json_encode($flashInfo) ?>);
            <?php endif; ?>

            <?php if ($flashWarning = session()->getFlashdata('warning')): ?>
                showToast('warning', 'Notice', <?= json_encode($flashWarning) ?>);
            <?php endif; ?>
        });

        // Generic Table Search Filter
        function setupTableSearch(inputId, tableId) {
            const input = document.getElementById(inputId);
            const table = document.getElementById(tableId);
            if (!input || !table) return;

            input.addEventListener('input', function() {
                const term = this.value.toLowerCase().trim();
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(term) ? '' : 'none';
                });
            });
        }

        // Generic Status Filter Pills
        function setupStatusFilters(containerClass, tableId) {
            const pills = document.querySelectorAll(containerClass + ' .filter-pill-btn');
            const table = document.getElementById(tableId);
            if (!pills.length || !table) return;

            pills.forEach(pill => {
                pill.addEventListener('click', function() {
                    pills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    const status = this.getAttribute('data-status');
                    const rows = table.querySelectorAll('tbody tr');
                    rows.forEach(row => {
                        if (status === 'all' || !status) {
                            row.style.display = '';
                        } else {
                            const rowStatus = row.getAttribute('data-status') || '';
                            row.style.display = rowStatus.toLowerCase() === status.toLowerCase() ? '' : 'none';
                        }
                    });
                });
            });
        }
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>
