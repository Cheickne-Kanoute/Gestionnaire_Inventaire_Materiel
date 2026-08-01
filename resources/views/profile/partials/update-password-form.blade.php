<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" class="form-label-pro">Mot de passe actuel <span class="required">*</span></label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-input-pro @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password" placeholder="••••••••" />
            @error('current_password', 'updatePassword')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password" class="form-label-pro">Nouveau mot de passe <span class="required">*</span></label>
            <input id="update_password_password" name="password" type="password" class="form-input-pro @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password" placeholder="••••••••" />
            @error('password', 'updatePassword')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation" class="form-label-pro">Confirmer le nouveau mot de passe <span class="required">*</span></label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input-pro @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password" placeholder="••••••••" />
            @error('password_confirmation', 'updatePassword')
                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; align-items: center; gap: 12px; margin-top: 1.5rem;">
            <button type="submit" class="btn-pro btn-primary-pro">
                <i class="fas fa-key"></i> Enregistrer le mot de passe
            </button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    style="font-size: 0.82rem; color: var(--green); font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"
                ><i class="fas fa-check"></i> Mot de passe mis à jour</span>
            @endif
        </div>
    </form>
</section>
