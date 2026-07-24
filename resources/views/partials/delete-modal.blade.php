{{--
    PARTIAL: partials/delete-modal.blade.php
    Modale de confirmation de suppression.

    Variables :
      - $equipement (Equipement) : l'équipement à supprimer
--}}
<div class="modal fade"
     id="deleteModal{{ $equipement->id }}"
     tabindex="-1"
     aria-labelledby="deleteModalLabel{{ $equipement->id }}"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content">
            <div class="modal-body text-center" style="padding:2rem 1.75rem 1rem;">
                <div class="modal-icon modal-icon--danger">
                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </div>
                <h6 id="deleteModalLabel{{ $equipement->id }}" style="font-weight:700;margin-bottom:8px;">
                    Confirmer la suppression
                </h6>
                <p style="color:var(--text-muted);font-size:0.85rem;line-height:1.6;margin:0;">
                    L'équipement <strong style="color:var(--text);">{{ $equipement->nom }}</strong>
                    sera supprimé définitivement de l'inventaire.
                </p>
            </div>
            <div class="modal-actions">
                <button type="button"
                        class="btn-pro btn-light-pro"
                        data-mdb-dismiss="modal">
                    Annuler
                </button>
                <form action="{{ route('equipements.destroy', $equipement->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-pro btn-danger-pro" style="width:100%;">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
