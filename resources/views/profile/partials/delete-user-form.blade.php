<section>
    <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 1rem;">
        Une fois votre compte supprimé, toutes vos données et accès seront définitivement effacés.
    </p>

    <button
        type="button"
        class="btn-pro btn-danger-pro"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        <i class="fas fa-trash-alt"></i> Supprimer mon compte
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 1.5rem;">
            @csrf
            @method('delete')

            <h5 style="font-weight: 700; font-size: 1.1rem; color: var(--text); margin-bottom: 0.5rem;">
                Êtes-vous sûr de vouloir supprimer votre compte ?
            </h5>

            <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 1.25rem;">
                Cette action est irréversible. Veuillez saisir votre mot de passe pour confirmer la suppression définitive.
            </p>

            <div class="form-group">
                <label for="password" class="form-label-pro">Mot de passe pour confirmation</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input-pro @error('password', 'userDeletion') is-invalid @enderror"
                    placeholder="Saisissez votre mot de passe"
                />
                @error('password', 'userDeletion')
                    <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem;">
                <button type="button" class="btn-pro btn-light-pro" x-on:click="$dispatch('close')">
                    Annuler
                </button>

                <button type="submit" class="btn-pro btn-danger-pro">
                    <i class="fas fa-trash-alt"></i> Confirmer la suppression
                </button>
            </div>
        </form>
    </x-modal>
</section>
