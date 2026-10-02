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

    <style>
        :root {
            /* 3 Core Theme Colors */
            --color-primary: #592E83;     /* Primary Purple */
            --color-secondary: #A36952;   /* Secondary Warm Brown */
            --color-dark: #483C46;        /* Dark Plum/Charcoal */

            /* Canvas & Cards (White / light neutral backgrounds) */
            --bg-dark: #fcfbfa;
            --bg-card: #ffffff;
            --bg-card-hover: #faf7f6;
            --bg-sidebar: #ffffff;

            /* Borders & Delimiters */
            --border-glow: #ede6e4;
            --border-glow-focus: #592E83;
            --border-secondary: #A36952;

            /* #592E83: Primary Purple System */
            --accent: #592E83;
            --accent-hover: #452168;
            --accent-light: #592E83;
            --accent-tint: #f4edf7;
            --accent-subtle: #eae0f0;
            --accent-purple-mid: #592E83;
            --accent-gold: #A36952;
            --accent-emerald: #16a34a;
            --accent-rose: #dc2626;

            /* #A36952: Secondary Warm Brown System */
            --secondary: #A36952;
            --secondary-hover: #8a5540;
            --secondary-tint: #f8f1ee;
            --secondary-subtle: #eedcd6;

            /* #483C46: Dark Plum/Charcoal System */
            --dark-plum: #483C46;
            --text-main: #483C46;
            --text-muted: #6f626d;
            --text-dim: #988b97;

            /* Shadows */
            --card-shadow: 0 1px 3px rgba(72, 60, 70, 0.05), 0 1px 2px rgba(72, 60, 70, 0.03);
            --card-shadow-hover: 0 6px 18px rgba(89, 46, 131, 0.12);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scrollbar-width: thin;
            scrollbar-color: #592E83 #fcfbfa;
        }

        /* Custom Elegant 3-Color Scrollbar */
        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }

        ::-webkit-scrollbar-track {
            background: #fcfbfa;
        }

        ::-webkit-scrollbar-thumb {
            background: #592E83;
            border-radius: 999px;
            border: 1px solid #ede6e4;
            transition: background 0.25s ease, border-color 0.25s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #A36952;
            border-color: #A36952;
        }

        ::-webkit-scrollbar-corner {
            background: #fcfbfa;
        }

        body {
            background-color: var(--bg-dark);
            background-image:
                radial-gradient(circle at 12% 15%, rgba(89, 46, 131, 0.04) 0%, transparent 45%),
                radial-gradient(circle at 88% 85%, rgba(163, 105, 82, 0.04) 0%, transparent 40%);
            background-attachment: fixed;
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        /* Layout */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - White Base with #483C46 Dark Text, #592E83 Active Item & Icons, #A36952 Accents */
        .sidebar {
            width: 260px;
            background: #ffffff;
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--border-glow);
            padding: 24px 14px;
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
            transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.32s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 2px 0 12px rgba(72, 60, 70, 0.03);
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #eedcd6;
            border-radius: 999px;
            transition: background 0.25s ease;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #A36952;
        }

        .sidebar-brand {
            display: flex;
            flex-direction: column;
            padding: 0 10px 20px;
            border-bottom: 1px solid var(--border-glow);
            margin-bottom: 16px;
        }

        .sidebar-brand-logo {
            height: 50px;
            width: auto;
            max-width: 160px;
            object-fit: contain;
            filter: none !important;
            display: block;
            margin-bottom: 4px;
        }

        .sidebar-brand strong {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            color: var(--text-main);
            letter-spacing: 0.5px;
        }

        .sidebar-brand small {
            font-size: 9.5px;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #A36952;
            font-weight: 700;
            margin-top: 2px;
        }

        .sidebar-label {
            font-size: 9.5px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #A36952;
            font-weight: 700;
            padding: 0 12px;
            margin: 14px 0 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid transparent;
            color: #483C46 !important;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 3px;
            text-decoration: none;
            transition: background 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        color 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        transform 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        border-color 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        box-shadow 0.24s cubic-bezier(0.25, 0.8, 0.25, 1);
            will-change: transform, background, border-color, box-shadow;
        }

        .sidebar-link .material-symbols-outlined {
            font-size: 20px;
            color: #592E83;
            transition: transform 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        color 0.24s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .sidebar-link:hover {
            background: #f4edf7;
            border-color: #eedcd6;
            color: #592E83 !important;
            transform: translateX(3px);
        }

        .sidebar-link:hover .material-symbols-outlined {
            color: #592E83;
            transform: scale(1.06);
        }

        .sidebar-link:active {
            transform: translateX(1px);
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
            border-radius: 999px;
            background: #f8f1ee;
            color: #A36952;
            border: 1px solid #eedcd6;
            margin-left: auto;
        }

        /* Sidebar Dropdown & Submenu */
        .sidebar-dropdown {
            margin-bottom: 3px;
        }

        .sidebar-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid transparent;
            color: #483C46 !important;
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        color 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        transform 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        border-color 0.24s cubic-bezier(0.25, 0.8, 0.25, 1),
                        box-shadow 0.24s cubic-bezier(0.25, 0.8, 0.25, 1);
            user-select: none;
            will-change: transform, background, border-color, box-shadow;
        }

        .sidebar-dropdown-toggle .material-symbols-outlined:first-child {
            font-size: 20px;
            color: #592E83;
            transition: color 0.24s ease, transform 0.24s ease;
        }

        .sidebar-dropdown-toggle .arrow-icon {
            margin-left: auto;
            font-size: 18px;
            color: #483C46;
            transition: transform 0.25s ease;
        }

        .sidebar-dropdown-toggle:hover {
            background: #f4edf7;
            border-color: #eedcd6;
            color: #592E83 !important;
            transform: translateX(3px);
        }

        .sidebar-dropdown-toggle:hover .material-symbols-outlined:first-child {
            color: #592E83;
        }

        .sidebar-dropdown-toggle.active {
            background: #f4edf7;
            color: #592E83 !important;
            border-color: #A36952;
            box-shadow: 0 2px 8px rgba(89, 46, 131, 0.12);
            transform: translateX(3px);
            font-weight: 600;
        }

        .sidebar-dropdown-toggle.active .material-symbols-outlined:first-child {
            color: #592E83;
        }

        .sidebar-dropdown.open .sidebar-dropdown-toggle .arrow-icon {
            transform: rotate(180deg);
        }

        .sidebar-submenu {
            display: none;
            flex-direction: column;
            gap: 2px;
            padding-left: 14px;
            margin: 4px 0 6px 14px;
            border-left: 2px solid #A36952;
            animation: fadeInSubmenu 0.22s ease forwards;
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
            gap: 9px;
            padding: 7px 12px;
            border-radius: 8px;
            color: #483C46 !important;
            font-size: 12.5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .sidebar-submenu-link::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #A36952;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .sidebar-submenu-link:hover {
            color: #592E83 !important;
            background: #f8f1ee;
            transform: translateX(3px);
        }

        .sidebar-submenu-link:hover::before {
            background: #592E83;
            transform: scale(1.3);
        }

        .sidebar-submenu-link.active {
            color: #ffffff !important;
            background: #592E83;
            font-weight: 600;
        }

        .sidebar-submenu-link.active::before {
            background: #ffffff;
            box-shadow: 0 0 6px rgba(255, 255, 255, 0.8);
        }

        /* Target section scroll margin and pulse animation */
        [id^="section"] {
            scroll-margin-top: 24px;
        }

        .section-highlight {
            animation: highlightPulse 1.6s ease;
        }

        @keyframes highlightPulse {
            0% { box-shadow: 0 0 0 rgba(89, 46, 131, 0); }
            30% { box-shadow: 0 0 25px rgba(89, 46, 131, 0.35); border-color: #592E83; }
            100% { box-shadow: 0 0 0 rgba(89, 46, 131, 0); }
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 24px 32px 80px;
            min-width: 0;
        }

        /* Topbar */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 20px;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border-glow);
            gap: 16px;
        }

        .topbar-left h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.65rem;
            font-weight: 600;
            color: var(--text-main) !important;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
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
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .topbar-left .breadcrumb-sub a:hover {
            color: #A36952;
            text-decoration: underline;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Notification Dropdown */
        .notification-dropdown {
            position: relative;
        }

        .notification-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid var(--border-glow);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #483C46;
            cursor: pointer;
            transition: all 0.22s ease;
            position: relative;
            box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
        }

        .notification-btn:hover,
        .notification-btn[aria-expanded="true"] {
            background: #f4edf7;
            color: #592E83;
            border-color: #592E83;
            box-shadow: 0 3px 10px rgba(89, 46, 131, 0.15);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            min-width: 18px;
            height: 18px;
            padding: 0 4px;
            border-radius: 999px;
            background: #dc2626;
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 6px rgba(220, 38, 38, 0.4);
        }

        .notification-menu {
            width: 350px;
            max-width: calc(100vw - 32px);
            padding: 0 !important;
            border-radius: 16px !important;
            border: 1px solid var(--border-glow) !important;
            box-shadow: 0 16px 40px rgba(72, 60, 70, 0.14) !important;
            overflow: hidden;
        }

        .notification-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            background: #fcfbfa;
            border-bottom: 1px solid var(--border-glow);
        }

        .notification-head h6 {
            margin: 0;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-main);
        }

        .notification-head a {
            font-size: 11.5px;
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        .notification-head a:hover {
            color: #A36952;
            text-decoration: underline;
        }

        .notification-body {
            max-height: 290px;
            overflow-y: auto;
            padding: 6px 0;
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

        .notification-item:last-child {
            border-bottom: none;
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
            background: #f4edf7;
            color: #592E83;
            border: 1px solid #dfcfeb;
        }

        .notification-icon-box .material-symbols-outlined {
            font-size: 18px;
        }

        .notification-content {
            flex: 1;
            min-width: 0;
        }

        .notification-title {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 2px;
            line-height: 1.3;
        }

        .notification-text {
            font-size: 11.5px;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
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
            border-top: 1px solid var(--border-glow);
        }

        .notification-foot a {
            font-size: 12px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
        }

        .notification-foot a:hover {
            color: #A36952;
            text-decoration: underline;
        }

        /* User Profile Dropdown */
        .user-dropdown {
            position: relative;
        }

        .admin-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            border: 1px solid var(--border-glow);
            border-radius: 999px;
            padding: 4px 14px 4px 5px;
            cursor: pointer;
            transition: all 0.22s;
            box-shadow: 0 1px 3px rgba(72, 60, 70, 0.04);
            user-select: none;
        }

        .admin-chip:hover,
        .admin-chip[aria-expanded="true"] {
            border-color: var(--accent);
            background: #f4edf7;
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
            color: #A36952;
            font-weight: 600;
        }

        .user-dropdown-menu {
            width: 250px;
            border-radius: 14px !important;
            border: 1px solid var(--border-glow) !important;
            box-shadow: 0 16px 36px rgba(72, 60, 70, 0.14) !important;
            padding: 8px !important;
        }

        .user-dropdown-header {
            padding: 10px 12px 12px;
            border-bottom: 1px solid var(--border-glow);
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
            transition: all 0.18s ease;
        }

        .user-dropdown-item .material-symbols-outlined {
            font-size: 18px;
            color: #A36952;
            transition: color 0.18s ease;
        }

        .user-dropdown-item:hover {
            background: #f4edf7;
            color: #592E83 !important;
        }

        .user-dropdown-item:hover .material-symbols-outlined {
            color: #592E83;
        }

        .user-dropdown-item.text-danger:hover {
            background: #fee2e2;
            color: #dc2626 !important;
        }

        .user-dropdown-item.text-danger:hover .material-symbols-outlined {
            color: #dc2626;
        }

        /* Admin Layout Footer */
        .admin-footer {
            margin-top: 48px;
            padding-top: 20px;
            border-top: 1px solid var(--border-glow);
            font-size: 12px;
            color: var(--text-dim);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .admin-footer a {
            color: #A36952;
            text-decoration: none;
            font-weight: 600;
        }

        .admin-footer a:hover {
            color: #592E83;
            text-decoration: underline;
        }

        /* Buttons: Primary (#592E83) & Secondary (#A36952) */
        .btn-glow {
            background: linear-gradient(135deg, #592E83, #48236d);
            color: #ffffff !important;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 18px;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 3px 12px rgba(89, 46, 131, 0.25);
            transition: all 0.22s ease;
            cursor: pointer;
        }

        .btn-glow:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #683699, #592E83);
            box-shadow: 0 6px 18px rgba(89, 46, 131, 0.35);
            color: #ffffff !important;
        }

        .btn-ghost-glow {
            background: #ffffff;
            color: #A36952 !important;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 16px;
            border-radius: 10px;
            border: 1px solid #A36952;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.22s;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(72, 60, 70, 0.03);
        }

        .btn-ghost-glow:hover {
            background: #f8f1ee;
            border-color: #8a5540;
            color: #8a5540 !important;
        }

        /* Glass Panel / Cards */
        .glass-panel {
            background: #ffffff;
            border: 1px solid var(--border-glow);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
            backdrop-filter: none;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .panel-header h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: var(--text-main) !important;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-header .subtitle {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        /* Stat Metrics Cards */
        .metric-card {
            background: #ffffff;
            border: 1px solid var(--border-glow);
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            border-color: #A36952;
            box-shadow: var(--card-shadow-hover);
        }

        .metric-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .metric-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4edf7;
            border: 1px solid #dfcfeb;
            color: var(--accent);
        }

        .metric-icon-box .material-symbols-outlined {
            font-size: 22px;
            color: var(--accent);
        }

        .metric-trend-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        .trend-up {
            background: #dcfce7;
            color: var(--accent-emerald);
            border: 1px solid #bbf7d0;
        }

        .trend-neutral {
            background: #f8f1ee;
            color: #A36952;
            border: 1px solid #eedcd6;
        }

        .metric-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-main) !important;
            line-height: 1.1;
            margin-bottom: 4px;
            font-family: 'Playfair Display', serif;
        }

        .metric-title {
            font-size: 12.5px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .metric-subtitle {
            font-size: 11px;
            color: var(--text-dim);
            margin-top: 6px;
        }

        /* Filter Controls & Search */
        .filter-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .filter-pills {
            display: flex;
            gap: 6px;
            background: #f8f6f8;
            padding: 4px;
            border-radius: 10px;
            border: 1px solid var(--border-glow);
            overflow-x: auto;
        }

        .filter-pill-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .filter-pill-btn:hover {
            color: var(--text-main);
        }

        .filter-pill-btn.active {
            background: #ffffff;
            color: #592E83;
            border: 1px solid #592E83;
            box-shadow: 0 1px 3px rgba(89, 46, 131, 0.15);
        }

        .search-box-glow {
            position: relative;
            min-width: 260px;
        }

        .search-box-glow .material-symbols-outlined {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #A36952;
            font-size: 18px;
            pointer-events: none;
        }

        .search-input-glow {
            width: 100%;
            background: #ffffff !important;
            border: 1px solid #dcd3db !important;
            border-radius: 10px !important;
            color: var(--text-main) !important;
            font-size: 13px !important;
            padding: 8px 14px 8px 38px !important;
            transition: all 0.2s !important;
        }

        .search-input-glow:focus {
            outline: none !important;
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.18) !important;
        }

        .search-input-glow::placeholder {
            color: #988b97 !important;
        }

        /* Clean Tables (#483C46 Headers/Text, #592E83 Highlights) */
        .table-glow {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            color: var(--text-main);
        }

        .table-glow th {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #483C46;
            font-weight: 700;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-glow);
            background: #faf8fa;
            white-space: nowrap;
        }

        .table-glow th:first-child {
            border-top-left-radius: 10px;
        }

        .table-glow th:last-child {
            border-top-right-radius: 10px;
        }

        .table-glow td {
            padding: 14px 16px;
            font-size: 13px;
            border-bottom: 1px solid #f2ecf1;
            vertical-align: middle;
            background: #ffffff;
            color: var(--text-main);
        }

        .table-glow tr:hover td {
            background: #f9f6f8;
        }

        .table-glow td code {
            background: #f4edf7;
            color: var(--accent);
            border: 1px solid #eae0f0;
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* Status Pills */
        .badge-status {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .st-confirmed, .st-active, .st-published, .st-completed {
            background: #dcfce7;
            color: var(--accent-emerald);
            border: 1px solid #bbf7d0;
        }

        .st-pending, .st-scheduled, .st-in-progress {
            background: #f8f1ee;
            color: #A36952;
            border: 1px solid #eedcd6;
        }

        .st-cancelled, .st-inactive, .st-draft {
            background: #fee2e2;
            color: var(--accent-rose);
            border: 1px solid #fecaca;
        }

        /* Action Buttons */
        .btn-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #fdfcff;
            border: 1px solid var(--border-glow);
            color: var(--text-main);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-action-icon:hover {
            background: #f4edf7;
            color: var(--accent);
            border-color: #592E83;
        }

        .btn-action-icon.btn-danger-icon:hover {
            background: #fee2e2;
            color: var(--accent-rose);
            border-color: #fecaca;
        }

        .btn-action-icon .material-symbols-outlined {
            font-size: 17px;
        }

        /* Modal Customization */
        .modal-content-glow {
            background: #ffffff !important;
            border: 1px solid var(--border-glow) !important;
            border-radius: 18px !important;
            box-shadow: 0 20px 45px rgba(72, 60, 70, 0.16) !important;
            color: var(--text-main) !important;
        }

        .modal-header-glow {
            border-bottom: 1px solid #ede6e4 !important;
            padding: 18px 24px !important;
            color: var(--text-main) !important;
        }

        .modal-header-glow .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            color: var(--text-main) !important;
            font-weight: 700;
        }

        .modal-header-glow .btn-close-white,
        .modal-header .btn-close-white {
            filter: invert(0.25) !important;
            opacity: 0.65 !important;
        }

        .modal-header-glow .btn-close-white:hover,
        .modal-header .btn-close-white:hover {
            opacity: 1 !important;
        }

        .modal-footer-glow {
            border-top: 1px solid #ede6e4 !important;
            background: #faf8fa !important;
            padding: 16px 24px !important;
        }

        .modal-body {
            color: var(--text-main) !important;
        }

        .form-label-glow {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 700;
            color: #483C46;
            margin-bottom: 7px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-label-glow .material-symbols-outlined {
            color: #592E83;
            font-size: 16px;
        }

        .form-control-glow,
        .form-control,
        .form-select {
            background: #ffffff !important;
            border: 1px solid #d5ccd3 !important;
            border-radius: 10px !important;
            color: var(--text-main) !important;
            font-size: 13.5px !important;
            padding: 10px 14px !important;
            transition: all 0.2s ease !important;
        }

        .form-control-glow:focus,
        .form-control:focus,
        .form-select:focus {
            background: #ffffff !important;
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.18) !important;
            outline: none !important;
            color: var(--text-main) !important;
        }

        .form-control-glow::placeholder,
        .form-control::placeholder {
            color: #988b97 !important;
        }

        /* Toaster Notifications */
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

        .toast-warning {
            border-color: #fde68a;
        }

        .toast-warning .toast-icon-box {
            color: #d97706;
            background: #fef3c7;
            border: 1px solid #fde68a;
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
            color: var(--text-main);
            margin-bottom: 3px;
        }

        .toast-message {
            font-size: 12.5px;
            color: var(--text-muted);
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

        .toast-warning .toast-progress-bar {
            background: linear-gradient(90deg, #A36952, #d97706);
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

        /* Responsive */
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
        }

        .mobile-toggle {
            display: none;
            background: #ffffff;
            border: 1px solid var(--border-glow);
            color: #483C46;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(72, 60, 70, 0.4);
            z-index: 1025;
            backdrop-filter: blur(2px);
        }

        .sidebar-backdrop.show {
            display: block;
        }

        /* Universal High-Contrast Heading & Text Overrides (#483C46) */
        .main-content h1,
        .main-content h2,
        .main-content h3,
        .main-content h4,
        .main-content h5,
        .panel-header h3,
        .topbar h1 {
            color: var(--text-main) !important;
        }

        .main-content p {
            color: var(--text-muted);
        }

        .table-glow td > div[style*="color: #ffffff"],
        .table-glow td > div[style*="color:#ffffff"],
        .table-glow td strong,
        .table-glow td b {
            color: var(--text-main) !important;
        }

        /* Placeholder card icon & pill styling */
        .glass-panel > div[style*="width: 72px"] {
            background: #f4edf7 !important;
            border: 1px solid #dfcfeb !important;
            box-shadow: 0 4px 15px rgba(89, 46, 131, 0.12) !important;
        }

        .glass-panel > div[style*="width: 72px"] .material-symbols-outlined {
            color: var(--accent) !important;
        }

        .main-content div[style*="border: 1px dashed"] {
            background: #fcfbfa !important;
            border-color: #A36952 !important;
            color: #6f626d !important;
        }

        .main-content div[style*="border: 1px dashed"] code {
            color: var(--accent) !important;
        }

        /* Tabs (#592E83 Active, #A36952 Border Highlights) */
        .nav-tabs {
            border-bottom: 2px solid var(--border-glow);
            gap: 4px;
        }

        .nav-tabs .nav-link {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13px;
            border: none;
            border-bottom: 2px solid transparent;
            padding: 10px 18px;
            background: transparent;
            border-radius: 0;
            transition: all 0.2s ease;
        }

        .nav-tabs .nav-link:hover {
            color: var(--accent);
            border-bottom-color: #A36952;
            background: #fcfbfa;
        }

        .nav-tabs .nav-link.active {
            color: #592E83 !important;
            border-bottom: 2px solid #592E83 !important;
            background: transparent;
            font-weight: 700;
        }

        .nav-pills {
            gap: 6px;
        }

        .nav-pills .nav-link {
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 600;
            border-radius: 10px;
            padding: 8px 16px;
            transition: all 0.2s ease;
            background: #ffffff;
            border: 1px solid var(--border-glow);
        }

        .nav-pills .nav-link:hover {
            color: var(--accent);
            background: #f4edf7;
            border-color: #A36952;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #592E83, #48236d) !important;
            color: #ffffff !important;
            border-color: #592E83 !important;
            box-shadow: 0 3px 12px rgba(89, 46, 131, 0.25);
        }

        /* Pagination (#592E83 Active, #A36952 Secondary Accents) */
        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
        }

        .page-link {
            background: #ffffff;
            border: 1px solid #eedcd6;
            color: #483C46;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px !important;
            padding: 7px 13px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(72, 60, 70, 0.03);
            text-decoration: none;
        }

        .page-link:hover {
            background: #f8f1ee;
            border-color: #A36952;
            color: #A36952;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #592E83, #48236d) !important;
            border-color: #592E83 !important;
            color: #ffffff !important;
            box-shadow: 0 3px 10px rgba(89, 46, 131, 0.3) !important;
        }

        .page-item.disabled .page-link {
            background: #fcfbfa;
            border-color: var(--border-glow);
            color: #988b97;
            pointer-events: none;
        }

        /* Dropdowns */
        .dropdown-menu {
            background: #ffffff;
            border: 1px solid var(--border-glow);
            border-radius: 12px;
            box-shadow: 0 12px 28px rgba(72, 60, 70, 0.12);
            padding: 6px;
        }

        .dropdown-item {
            color: var(--text-main);
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            padding: 8px 14px;
            transition: all 0.18s ease;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background: #f4edf7;
            color: #592E83;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background: #592E83;
            color: #ffffff;
        }

        .dropdown-divider {
            border-color: #ede6e4;
            margin: 4px 0;
        }

        /* Form Checks & Switches */
        .form-check-input {
            border: 1px solid #A36952;
            background-color: #ffffff;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #592E83;
            border-color: #592E83;
            box-shadow: 0 2px 6px rgba(89, 46, 131, 0.25);
        }

        .form-check-input:focus {
            border-color: #592E83;
            box-shadow: 0 0 0 3px rgba(89, 46, 131, 0.18);
        }

        /* Badges / Status Indicators (#A36952 & #592E83) */
        .badge {
            border-radius: 999px;
            font-weight: 600;
            padding: 5px 10px;
        }

        .badge.bg-primary,
        .badge-primary {
            background-color: #f4edf7 !important;
            color: #592E83 !important;
            border: 1px solid #dfcfeb;
        }

        .badge.bg-secondary,
        .badge-secondary {
            background-color: #f8f1ee !important;
            color: #A36952 !important;
            border: 1px solid #eedcd6;
        }

        /* Alerts */
        .alert-primary,
        .alert-info {
            background-color: #f4edf7;
            border-color: #dfcfeb;
            color: #592E83;
            border-radius: 12px;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
            border-radius: 12px;
        }

        .alert-danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
            border-radius: 12px;
        }

        .alert-warning {
            background-color: #fffbeb;
            border-color: #fde68a;
            color: #b45309;
            border-radius: 12px;
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
            <a href="<?= base_url('admin/website/contact') ?>" class="sidebar-link <?= ($activeMenu ?? '') === 'website_contact' ? 'active' : '' ?>">
                <span class="material-symbols-outlined">contact_phone</span>
                Contact Information
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
