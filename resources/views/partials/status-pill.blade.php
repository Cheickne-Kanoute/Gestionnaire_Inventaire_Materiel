{{--
    PARTIAL: partials/status-pill.blade.php
    Affiche le badge de statut d'un équipement.

    Variables :
      - $statut (string) : 'Actif' ou 'En maintenance'
--}}
@if($statut === 'Actif')
    <span class="status-pill status-actif">
        <span class="dot" aria-hidden="true"></span>
        Actif
    </span>
@else
    <span class="status-pill status-maintenance">
        <span class="dot" aria-hidden="true"></span>
        Maintenance
    </span>
@endif
