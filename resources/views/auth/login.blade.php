<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-xl font-extrabold text-slate-800">Connexion</h1>
        <p class="text-xs text-slate-500 mt-0.5">Accédez à votre espace de gestion d'inventaire</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adresse Email" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="email" class="block w-full text-sm px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="exemple@entreprise.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <!-- Password -->
        <div class="mt-3">
            <x-input-label for="password" value="Mot de passe" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="password" class="block w-full text-sm px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-3">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4" name="remember">
                <span class="ms-2 text-xs text-slate-600">Se souvenir de moi</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-blue-600 hover:text-blue-800 font-medium hover:underline" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <div class="mt-4">
            <button type="submit" style="background-color: #3b82f6 !important; text-transform: none !important;" class="w-full justify-center py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold rounded-xl shadow-md transition duration-150 ease-in-out flex items-center justify-center">
                <i class="fas fa-sign-in-alt me-2"></i> Se connecter
            </button>
        </div>

        @if (Route::has('register'))
            <div class="mt-4 text-center border-t border-slate-200 pt-3 text-xs text-slate-600">
                Vous n'avez pas de compte ? 
                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                    Créer un compte
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
