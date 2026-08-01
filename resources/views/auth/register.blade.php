<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-xl font-extrabold text-slate-800">Créer un compte</h1>
        <p class="text-xs text-slate-500 mt-0.5">Rejoignez la gestion du parc informatique</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nom complet" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="name" class="block w-full text-sm px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Jean Dupont" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
        </div>

        <!-- Email Address -->
        <div class="mt-2.5">
            <x-input-label for="email" value="Adresse Email" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="email" class="block w-full text-sm px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="exemple@entreprise.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <!-- Password -->
        <div class="mt-2.5">
            <x-input-label for="password" value="Mot de passe" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="password" class="block w-full text-sm px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2.5">
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="password_confirmation" class="block w-full text-sm px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
        </div>

        <div class="mt-4">
            <button type="submit" style="background-color: #3b82f6 !important; text-transform: none !important;" class="w-full justify-center py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold rounded-xl shadow-md transition duration-150 ease-in-out flex items-center justify-center">
                <i class="fas fa-user-plus me-2"></i> S'inscrire
            </button>
        </div>

        <div class="mt-3 text-center border-t border-slate-200 pt-2.5 text-xs text-slate-600">
            Déjà inscrit ? 
            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                Se connecter
            </a>
        </div>
    </form>
</x-guest-layout>
