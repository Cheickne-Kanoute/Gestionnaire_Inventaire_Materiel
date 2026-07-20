<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Assets Manager</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

    <style>
        /* ═══════════════════════════════════
           DESIGN TOKENS
        ═══════════════════════════════════ */
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-50: #eff6ff;
            --primary-100: #dbeafe;
            --primary-200: #bfdbfe;

            --sidebar-w: 256px;

            --bg: #f1f5f9;
            --surface: #ffffff;
            --border: #e2e8f0;
            --border-light: #f1f5f9;

            --text: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;

            --green: #16a34a;
            --green-bg: #f0fdf4;
            --green-border: #bbf7d0;

            --amber: #d97706;
            --amber-bg: #fffbeb;
            --amber-border: #fde68a;

            --red: #dc2626;
            --red-bg: #fef2f2;

            --shadow-sm: 0 1px 2px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.06), 0 2px 4px -2px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.07), 0 4px 6px -4px rgba(0,0,0,0.07);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.06);

            --radius: 12px;
            --radius-lg: 16px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ═══════════════════════════════════
           ANIMATIONS
        ═══════════════════════════════════ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        .animate-in {
            animation: fadeInUp 0.4s ease-out both;
        }
        .animate-in-delay-1 { animation-delay: 0.05s; }
        .animate-in-delay-2 { animation-delay: 0.1s; }
        .animate-in-delay-3 { animation-delay: 0.15s; }
        .animate-in-delay-4 { animation-delay: 0.2s; }
        .animate-in-delay-5 { animation-delay: 0.25s; }

        /* ═══════════════════════════════════
           SIDEBAR
        ═══════════════════════════════════ */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 1040;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-logo {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        }
        .sidebar-brand-name {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text);
            letter-spacing: -0.5px;
        }
        .sidebar-brand-sub {
            font-size: 0.68rem;
            color: var(--text-muted);
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            padding: 0.5rem 0.75rem;
            overflow-y: auto;
        }
        .sidebar-label {
            padding: 1.25rem 0.75rem 0.5rem;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            font-weight: 700;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0.6rem 0.85rem;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.87rem;
            font-weight: 500;
            border-radius: 10px;
            margin-bottom: 2px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .sidebar-link i {
            width: 18px;
            text-align: center;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .sidebar-link:hover {
            background: var(--primary-50);
            color: var(--primary);
        }
        .sidebar-link:hover i { color: var(--primary); }

        .sidebar-link.active {
            background: var(--primary-50);
            color: var(--primary);
            font-weight: 600;
        }
        .sidebar-link.active i { color: var(--primary); }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: -0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: var(--primary);
            border-radius: 0 4px 4px 0;
        }

        .sidebar-link .link-badge {
            margin-left: auto;
            background: var(--primary);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border);
        }
        .sidebar-footer-link {
            display: flex; align-items: center; gap: 10px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .sidebar-footer-link:hover { color: var(--primary); }

        /* ═══════════════════════════════════
           MAIN AREA
        ═══════════════════════════════════ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
        }

        /* ═══════════════════════════════════
           TOP BAR
        ═══════════════════════════════════ */
        .top-bar {
            background: var(--surface);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1020;
        }
        .search-box {
            position: relative;
            width: 380px;
        }
        .search-box input {
            width: 100%;
            padding: 0.55rem 1rem 0.55rem 2.6rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 0.87rem;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: all 0.2s;
        }
        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .search-box input::placeholder { color: var(--text-muted); }
        .search-box .search-icon {
            position: absolute;
            left: 0.9rem; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.82rem;
        }

        .top-bar-right {
            display: flex; align-items: center; gap: 8px;
        }
        .top-icon-btn {
            width: 38px; height: 38px;
            border-radius: 10px;
            border: none;
            background: transparent;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.15s;
            position: relative;
        }
        .top-icon-btn:hover { background: var(--bg); color: var(--primary); }
        .notif-dot {
            position: absolute;
            top: 8px; right: 8px;
            width: 8px; height: 8px;
            background: var(--red);
            border-radius: 50%;
            border: 2px solid var(--surface);
        }

        .divider-v {
            width: 1px; height: 28px;
            background: var(--border);
            margin: 0 6px;
        }

        .user-pill {
            display: flex; align-items: center; gap: 10px;
            padding: 4px 12px 4px 4px;
            border-radius: 24px;
            background: var(--bg);
            cursor: pointer;
            transition: background 0.15s;
        }
        .user-pill:hover { background: var(--border); }
        .user-avatar {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .user-pill-name {
            font-size: 0.82rem; font-weight: 600; color: var(--text);
        }

        /* ═══════════════════════════════════
           CONTENT
        ═══════════════════════════════════ */
        .content-area { padding: 2rem; }

        /* ═══════════════════════════════════
           STAT CARDS
        ═══════════════════════════════════ */
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.35rem 1.5rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: default;
        }
        .stat-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
            border-color: var(--primary-200);
        }
        .stat-value {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -1px;
            line-height: 1;
            margin-top: 0.35rem;
        }
        .stat-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }

        /* ═══════════════════════════════════
           CONTENT CARD
        ═══════════════════════════════════ */
        .content-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }
        .content-card-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        /* ═══════════════════════════════════
           TABLE
        ═══════════════════════════════════ */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table thead th {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
            background: var(--bg);
        }
        .data-table tbody td {
            padding: 0.95rem 1rem;
            font-size: 0.875rem;
            color: var(--text);
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }
        .data-table tbody tr {
            transition: background 0.15s;
        }
        .data-table tbody tr:hover {
            background: #f8fafc;
        }
        .data-table tbody tr:last-child td { border-bottom: none; }

        /* ═══════════════════════════════════
           EQUIPMENT AVATAR
        ═══════════════════════════════════ */
        .eq-avatar {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        /* ═══════════════════════════════════
           BADGES & PILLS
        ═══════════════════════════════════ */
        .id-badge {
            display: inline-block;
            background: var(--primary-50);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 6px;
            letter-spacing: 0.3px;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }
        .status-pill .dot {
            width: 6px; height: 6px;
            border-radius: 50%;
        }
        .status-actif {
            background: var(--green-bg);
            color: var(--green);
        }
        .status-actif .dot {
            background: var(--green);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.2);
        }
        .status-maintenance {
            background: var(--amber-bg);
            color: var(--amber);
        }
        .status-maintenance .dot {
            background: var(--amber);
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.2);
        }

        .ip-tag {
            font-family: 'SF Mono', 'Cascadia Code', Consolas, monospace;
            font-size: 0.82rem;
            color: var(--text-secondary);
            background: var(--bg);
            padding: 3px 10px;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

        /* ═══════════════════════════════════
           ACTION BUTTONS (icon style)
        ═══════════════════════════════════ */
        .action-btn-group {
            display: flex; gap: 4px; justify-content: flex-end;
        }
        .action-btn {
            width: 34px; height: 34px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--surface);
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            font-size: 0.8rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }
        .action-btn:hover {
            background: var(--primary-50);
            color: var(--primary);
            border-color: var(--primary-200);
        }
        .action-btn-danger:hover {
            background: var(--red-bg);
            color: var(--red);
            border-color: #fecaca;
        }

        /* ═══════════════════════════════════
           BTNS
        ═══════════════════════════════════ */
        .btn-pro {
            padding: 0.55rem 1.25rem;
            border-radius: 10px;
            font-size: 0.87rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            border: none;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }
        .btn-primary-pro {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 1px 3px rgba(37, 99, 235, 0.25);
        }
        .btn-primary-pro:hover {
            background: var(--primary-hover);
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            transform: translateY(-1px);
        }
        .btn-light-pro {
            background: var(--surface);
            color: var(--text-secondary);
            border: 1.5px solid var(--border);
        }
        .btn-light-pro:hover {
            background: var(--bg);
            color: var(--text);
        }

        /* ═══════════════════════════════════
           FORMS
        ═══════════════════════════════════ */
        .form-label-pro {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
        }
        .form-label-pro .required { color: var(--red); }

        .form-input-pro {
            width: 100%;
            padding: 0.6rem 0.85rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 0.87rem;
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--surface);
            transition: all 0.2s;
        }
        .form-input-pro:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .form-input-pro.is-invalid { border-color: var(--red); }
        .form-input-pro.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1); }
        .form-error {
            color: var(--red);
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ═══════════════════════════════════
           ALERTS
        ═══════════════════════════════════ */
        .alert-pro {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius);
            font-size: 0.87rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            border: none;
            animation: fadeInUp 0.3s ease-out;
        }
        .alert-success-pro {
            background: var(--green-bg);
            color: #15803d;
            border: 1px solid var(--green-border);
        }
        .alert-danger-pro {
            background: var(--red-bg);
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        /* ═══════════════════════════════════
           MODAL OVERRIDE
        ═══════════════════════════════════ */
        .modal-content {
            border: none !important;
            border-radius: var(--radius-lg) !important;
            box-shadow: var(--shadow-xl) !important;
        }

        /* ═══════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════ */
        .sidebar-toggle { display: none; }
        .sidebar-overlay { display: none; }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .sidebar-toggle { display: inline-flex; }
            .search-box { width: 220px; }
            .sidebar-overlay {
                display: none;
                position: fixed; inset: 0;
                background: rgba(0,0,0,0.25);
                backdrop-filter: blur(4px);
                z-index: 1035;
                animation: fadeIn 0.2s;
            }
            .sidebar-overlay.show { display: block; }
        }
        @media (max-width: 575.98px) {
            .content-area { padding: 1.25rem; }
            .search-box { display: none; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- ════ SIDEBAR ════ -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-logo"><i class="fas fa-server"></i></div>
            <div>
                <div class="sidebar-brand-name">IT Assets</div>
                <div class="sidebar-brand-sub">Parc Informatique</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-label">Principal</div>
            <a href="{{ route('equipements.index') }}" class="sidebar-link @if(request()->routeIs('equipements.index')) active @endif">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="{{ route('equipements.index') }}" class="sidebar-link @if(request()->routeIs('equipements.index')) active @endif">
                <i class="fas fa-list"></i> Inventaire
                <span class="link-badge">@yield('count', '—')</span>
            </a>
            <a href="{{ route('equipements.create') }}" class="sidebar-link @if(request()->routeIs('equipements.create')) active @endif">
                <i class="fas fa-plus-circle"></i> Ajouter
            </a>

            <div class="sidebar-label">Catégories</div>
            <a href="{{ route('equipements.index') }}" class="sidebar-link">
                <i class="fas fa-laptop"></i> Ordinateurs
            </a>
            <a href="{{ route('equipements.index') }}" class="sidebar-link">
                <i class="fas fa-server"></i> Serveurs
            </a>
            <a href="{{ route('equipements.index') }}" class="sidebar-link">
                <i class="fas fa-network-wired"></i> Switches
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="#" class="sidebar-footer-link">
                <i class="fas fa-life-ring"></i> Centre d'aide
            </a>
        </div>
    </aside>

    <!-- ════ MAIN ════ -->
    <div class="main-wrapper">

        <header class="top-bar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm sidebar-toggle top-icon-btn" onclick="toggleSidebar()" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" placeholder="Rechercher un équipement..." />
                </div>
            </div>
            <div class="top-bar-right">
                <button class="top-icon-btn" type="button">
                    <i class="far fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <button class="top-icon-btn" type="button">
                    <i class="far fa-question-circle"></i>
                </button>
                <div class="divider-v"></div>
                <div class="user-pill">
                    <div class="user-avatar">A</div>
                    <span class="user-pill-name">Admin</span>
                </div>
            </div>
        </header>

        <div class="content-area">
            @if(session('success'))
                <div class="alert-pro alert-success-pro">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert-pro alert-danger-pro">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>
    @yield('scripts')
</body>
</html>