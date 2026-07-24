<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gestionnaire d'inventaire du parc informatique — IT Assets Manager">
    <title>@yield('title', 'IT Assets Manager')</title>

    {{-- Fonts & Icons (CDN) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- MDB CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet">

    {{-- CSS & JS Custom --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ════ SIDEBAR ════ --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-logo">
                <i class="fas fa-server"></i>
            </div>
            <div>
                <div class="sidebar-brand-name">IT Assets</div>
                <div class="sidebar-brand-sub">Parc Informatique</div>
            </div>
        </div>

        <nav class="sidebar-nav" aria-label="Navigation principale">
            <div class="sidebar-label">Principal</div>

            <a href="{{ route('dashboard') }}"
               class="sidebar-link @if(request()->routeIs('dashboard')) active @endif"
               aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}">
                <i class="fas fa-th-large" aria-hidden="true"></i>
                Dashboard
            </a>

            <a href="{{ route('equipements.index') }}"
               class="sidebar-link @if(request()->routeIs('equipements.index') && !request('type')) active @endif"
               aria-current="{{ request()->routeIs('equipements.index') && !request('type') ? 'page' : 'false' }}">
                <i class="fas fa-list" aria-hidden="true"></i>
                Inventaire
                <span class="link-badge" aria-label="Total équipements">@yield('count', '—')</span>
            </a>

            <a href="{{ route('equipements.create') }}"
               class="sidebar-link @if(request()->routeIs('equipements.create')) active @endif">
                <i class="fas fa-plus-circle" aria-hidden="true"></i>
                Ajouter
            </a>

            <div class="sidebar-label">Catégories</div>

            <a href="{{ route('equipements.index', ['type' => 'PC']) }}"
               class="sidebar-link @if(request('type') === 'PC') active @endif">
                <i class="fas fa-laptop" aria-hidden="true"></i>
                Ordinateurs
            </a>

            <a href="{{ route('equipements.index', ['type' => 'Serveur']) }}"
               class="sidebar-link @if(request('type') === 'Serveur') active @endif">
                <i class="fas fa-server" aria-hidden="true"></i>
                Serveurs
            </a>

            <a href="{{ route('equipements.index', ['type' => 'Switch']) }}"
               class="sidebar-link @if(request('type') === 'Switch') active @endif">
                <i class="fas fa-network-wired" aria-hidden="true"></i>
                Switches
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('dashboard') }}" class="sidebar-footer-link">
                <i class="fas fa-chart-line" aria-hidden="true"></i>
                Statistiques
            </a>
        </div>
    </aside>

    {{-- ════ CONTENU PRINCIPAL ════ --}}
    <div class="main-wrapper">

        {{-- Top bar --}}
        <header class="top-bar" role="banner">
            <div class="top-bar-left">
                <button class="top-icon-btn sidebar-toggle"
                        id="sidebarToggleBtn"
                        type="button"
                        aria-label="Ouvrir le menu"
                        aria-controls="sidebar"
                        onclick="toggleSidebar()">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>

                <form class="search-box"
                      action="{{ route('equipements.index') }}"
                      method="GET"
                      role="search"
                      aria-label="Rechercher un équipement">
                    @if(request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    <i class="fas fa-search search-icon" aria-hidden="true"></i>
                    <input type="text"
                           id="globalSearch"
                           name="search"
                           placeholder="Rechercher un équipement..."
                           value="{{ request('search') }}"
                           autocomplete="off"
                           aria-label="Rechercher">
                </form>
            </div>

            <div class="top-bar-right">
                <div class="divider-v" aria-hidden="true"></div>
                <div class="user-pill" role="button" tabindex="0" aria-label="Menu utilisateur">
                    <div class="user-avatar" aria-hidden="true">A</div>
                    <span class="user-pill-name">Admin</span>
                </div>
            </div>
        </header>

        {{-- Barre de recherche mobile --}}
        <div class="mobile-search-bar" aria-hidden="true">
            <form class="search-box"
                  action="{{ route('equipements.index') }}"
                  method="GET"
                  role="search">
                @if(request('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                @endif
                <i class="fas fa-search search-icon" aria-hidden="true"></i>
                <input type="text"
                       name="search"
                       placeholder="Rechercher..."
                       value="{{ request('search') }}"
                       autocomplete="off">
            </form>
        </div>

        {{-- Zone de contenu --}}
        <main class="content-area" role="main">

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="alert-pro alert-success-pro" role="alert">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-pro alert-danger-pro" role="alert">
                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- MDB JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

    {{-- JS Custom --}}
    <script type="module" src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>