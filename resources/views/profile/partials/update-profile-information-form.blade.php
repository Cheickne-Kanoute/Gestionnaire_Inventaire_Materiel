<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="form-label-pro">Nom complet <span class="required">*</span></label>
            <input id="name" name="name" type="text" class="form-input-pro @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label-pro">Adresse Email <span class="required">*</span></label>
            <input id="email" name="email" type="email" class="form-input-pro @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: 10px;">
                    <p style="font-size: 0.8rem; color: var(--text-secondary);">
                        Votre adresse email n'est pas vérifiée.
                        <button form="send-verification" class="btn-pro btn-light-pro" style="padding: 4px 8px; font-size: 0.75rem;">
                            Renvoyer l'email de vérification
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="font-size: 0.8rem; color: var(--green); margin-top: 5px;">
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 12px; margin-top: 1.5rem;">
            <button type="submit" class="btn-pro btn-primary-pro">
                <i class="fas fa-check-circle"></i> Enregistrer
            </button>

            @if (session('status') === 'profile-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    style="font-size: 0.82rem; color: var(--green); font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"
                ><i class="fas fa-check"></i> Modifications enregistrées</span>
            @endif
        </div>
    </form>
</section>
