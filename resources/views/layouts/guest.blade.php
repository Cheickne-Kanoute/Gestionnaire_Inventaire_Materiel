<!DOCTYPE html>
<html lang="fr" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'IT Assets Manager — Authentification')</title>

        {{-- Fonts & Icons --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        {{-- Styles CSS du projet --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- Scripts & Tailwind fallback --}}
        @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    <body style="font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b;" class="h-full antialiased overflow-hidden">
        <div class="h-full min-h-screen flex flex-col justify-center items-center px-4 py-4 bg-slate-50 overflow-y-auto sm:overflow-hidden">
            
            <div class="w-full sm:max-w-md px-6 py-5 bg-white shadow-lg sm:rounded-2xl border border-slate-200">
                <div class="flex justify-center mb-4">
                    <a href="/">
                        <x-application-logo />
                    </a>
                </div>

                {{ $slot }}
            </div>

            <div class="mt-3 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} IT Assets Manager — Gestion du parc informatique
            </div>
        </div>
    </body>
</html>
