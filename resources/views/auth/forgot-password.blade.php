<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-xl font-extrabold text-slate-800">Mot de passe oublié</h1>
        <p class="text-xs text-slate-500 mt-0.5">Saisissez votre email pour recevoir le lien de réinitialisation</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adresse Email" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="email" class="block w-full text-sm px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="email" name="email" :value="old('email')" required autofocus placeholder="exemple@entreprise.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <div class="mt-4">
            <button type="submit" style="background-color: #3b82f6 !important; text-transform: none !important;" class="w-full justify-center py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold rounded-xl shadow-md transition duration-150 ease-in-out flex items-center justify-center">
                <i class="fas fa-paper-plane me-2"></i> Envoyer le lien
            </button>
        </div>

        <div class="mt-4 text-center border-t border-slate-200 pt-3 text-xs text-slate-600">
            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                <i class="fas fa-arrow-left me-1"></i> Retour à la connexion
            </a>
        </div>
    </form>
</x-guest-layout>
