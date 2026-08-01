<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Gestionnaire d'inventaire du parc informatique — IT Assets Manager">
    <title>@yield('title', config('app.name', 'IT Assets Manager'))</title>

    {{-- Fonts & Icons (CDN) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- MDB CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet">

    {{-- Vite Assets & Custom CSS --}}
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
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
                @if(isset($inventoryCount))
                    <span class="link-badge" aria-label="Total équipements">{{ $inventoryCount }}</span>
                @endif
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

            @auth
                <div class="sidebar-label">Compte</div>

                <a href="{{ route('profile.edit') }}"
                   class="sidebar-link @if(request()->routeIs('profile.edit')) active @endif">
                    <i class="fas fa-user-circle" aria-hidden="true"></i>
                    {{ Auth::user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}" style="display: block; margin: 0;">
                    @csrf
                    <button type="submit" class="sidebar-link" style="width: 100%; border: none; background: transparent; text-align: left; cursor: pointer; color: inherit;">
                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                        Déconnexion
                    </button>
                </form>
            @endauth
        </nav>

    </aside>

    {{-- ════ CONTENU PRINCIPAL ════ --}}
    <div class="main-wrapper">

        @isset($header)
            <header class="bg-white shadow mb-4 p-4">
                <div class="max-w-7xl mx-auto">
                    {{ $header }}
                </div>
            </header>
        @endisset

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

            {{ $slot ?? '' }}
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
