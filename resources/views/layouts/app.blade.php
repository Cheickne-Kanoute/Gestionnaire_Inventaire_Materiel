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
                <span class="link-badge" aria-label="Total équipements">{{ $inventoryCount }}</span>
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

    </aside>

    {{-- ════ CONTENU PRINCIPAL ════ --}}
    <div class="main-wrapper">

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