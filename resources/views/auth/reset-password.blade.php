<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-xl font-extrabold text-slate-800">Nouveau mot de passe</h1>
        <p class="text-xs text-slate-500 mt-0.5">Choisissez votre nouveau mot de passe sécurisé</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adresse Email" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="email" class="block w-full text-sm px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="exemple@entreprise.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <!-- Password -->
        <div class="mt-2.5">
            <x-input-label for="password" value="Nouveau mot de passe" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="password" class="block w-full text-sm px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2.5">
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" class="text-xs font-semibold text-slate-700 mb-1" />
            <x-text-input id="password_confirmation" class="block w-full text-sm px-3 py-1.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
        </div>

        <div class="mt-4">
            <button type="submit" style="background-color: #3b82f6 !important; text-transform: none !important;" class="w-full justify-center py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold rounded-xl shadow-md transition duration-150 ease-in-out flex items-center justify-center">
                <i class="fas fa-key me-2"></i> Réinitialiser le mot de passe
            </button>
        </div>
    </form>
</x-guest-layout>
