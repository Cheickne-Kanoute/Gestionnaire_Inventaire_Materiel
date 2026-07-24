@extends('layouts.app')

@section('title', 'Inventaire — IT Assets Manager')
@section('count', $totalCount)

@section('content')

{{-- ── En-tête ── --}}
<div class="page-header animate-in">
    <div>
        <h1 class="page-title">
            @if($type)
                {{ $type === 'PC' ? 'Ordinateurs' : ($type === 'Serveur' ? 'Serveurs' : 'Switches') }}
            @elseif($search)
                Résultats de recherche
            @else
                Inventaire
            @endif
        </h1>
        <p class="page-subtitle">
            @if($type || $search)
                {{ $equipements->count() }} résultat{{ $equipements->count() > 1 ? 's' : '' }} —
                <a href="{{ route('equipements.index') }}" class="reset-link">Tout afficher</a>
            @else
                Gérez l'ensemble de votre parc informatique
            @endif
        </p>
    </div>
    <a href="{{ route('equipements.create') }}" class="btn-pro btn-primary-pro">
        <i class="fas fa-plus" aria-hidden="true"></i> Ajouter
    </a>
</div>

{{-- ── Statistiques ── --}}
<div class="stat-grid animate-in animate-in-delay-1">
    <div class="stat-card">
        <div>
            <div class="stat-card__label">Total</div>
            <div class="stat-card__value">{{ $totalCount }}</div>
        </div>
        <div class="stat-card__icon" style="background:var(--primary-50);color:var(--primary);">
            <i class="fas fa-boxes" aria-hidden="true"></i>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-card__label">Actifs</div>
            <div class="stat-card__value" style="color:var(--green);">{{ $actifCount }}</div>
        </div>
        <div class="stat-card__icon" style="background:var(--green-bg);color:var(--green);">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-card__label">En maintenance</div>
            <div class="stat-card__value" style="color:var(--amber);">{{ $maintenanceCount }}</div>
        </div>
        <div class="stat-card__icon" style="background:var(--amber-bg);color:var(--amber);">
            <i class="fas fa-wrench" aria-hidden="true"></i>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-card__label">Taux opérationnel</div>
            <div class="stat-card__value">
                {{ $totalCount > 0 ? round(($actifCount / $totalCount) * 100) : 0 }}<span style="font-size:1rem;font-weight:600;">%</span>
            </div>
        </div>
        <div class="stat-card__icon" style="background:var(--purple-bg);color:var(--purple);">
            <i class="fas fa-chart-pie" aria-hidden="true"></i>
        </div>
    </div>
</div>

{{-- ── Table ── --}}
<div class="content-card animate-in animate-in-delay-2">
    <div class="content-card-header">
        <div>
            <h6>
                @if($type)
                    Catégorie : {{ $type === 'PC' ? 'Ordinateurs' : ($type === 'Serveur' ? 'Serveurs' : 'Switches') }}
                @elseif($search)
                    Résultats pour &laquo;&nbsp;{{ $search }}&nbsp;&raquo;
                @else
                    Tous les équipements
                @endif
            </h6>
            <small>
                {{ $equipements->count() }} matériel{{ $equipements->count() > 1 ? 's' : '' }} affiché{{ $equipements->count() > 1 ? 's' : '' }}
                @if($type || $search)
                    &mdash; <a href="{{ route('equipements.index') }}" class="reset-link">Réinitialiser</a>
                @endif
            </small>
        </div>

        {{-- Filtres rapides --}}
        <div class="table-filters" role="group" aria-label="Filtrer par type">
            <a href="{{ route('equipements.index') }}"
               class="btn-pro {{ !$type && !$search ? 'btn-primary-pro' : 'btn-light-pro' }}"
               style="font-size:0.75rem;padding:0.35rem 0.85rem;">
                Tous
            </a>
            <a href="{{ route('equipements.index', ['type' => 'PC']) }}"
               class="btn-pro {{ $type === 'PC' ? 'btn-primary-pro' : 'btn-light-pro' }}"
               style="font-size:0.75rem;padding:0.35rem 0.85rem;">
                <i class="fas fa-laptop" aria-hidden="true" style="font-size:0.7rem;"></i> PC
            </a>
            <a href="{{ route('equipements.index', ['type' => 'Serveur']) }}"
               class="btn-pro {{ $type === 'Serveur' ? 'btn-primary-pro' : 'btn-light-pro' }}"
               style="font-size:0.75rem;padding:0.35rem 0.85rem;">
                <i class="fas fa-server" aria-hidden="true" style="font-size:0.7rem;"></i> Serveurs
            </a>
            <a href="{{ route('equipements.index', ['type' => 'Switch']) }}"
               class="btn-pro {{ $type === 'Switch' ? 'btn-primary-pro' : 'btn-light-pro' }}"
               style="font-size:0.75rem;padding:0.35rem 0.85rem;">
                <i class="fas fa-network-wired" aria-hidden="true" style="font-size:0.7rem;"></i> Switches
            </a>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Équipement</th>
                    <th class="col-hide-mobile">Type</th>
                    <th class="col-hide-mobile">Adresse IP</th>
                    <th class="col-hide-mobile">Acquisition</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipements as $equipement)
                <tr>
                    <td>
                        <div class="eq-cell">
                            @include('partials.equipment-avatar', ['type' => $equipement->type])
                            <div>
                                <div class="eq-cell__info-name">{{ $equipement->nom }}</div>
                                <div class="eq-cell__info-sub">
                                    <span class="id-badge">EQ-{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="col-hide-mobile">
                        <span style="font-weight:500;color:var(--text-secondary);">{{ $equipement->type }}</span>
                    </td>
                    <td class="col-hide-mobile">
                        <span class="ip-tag">{{ $equipement->adresse_ip }}</span>
                    </td>
                    <td class="col-hide-mobile">
                        <span style="color:var(--text-secondary);font-size:0.85rem;">
                            {{ \Carbon\Carbon::parse($equipement->date_acquisition)->format('d M Y') }}
                        </span>
                    </td>
                    <td>@include('partials.status-pill', ['statut' => $equipement->statut])</td>
                    <td>
                        <div class="action-btn-group">
                            <a href="{{ route('equipements.edit', $equipement->id) }}"
                               class="action-btn"
                               title="Modifier {{ $equipement->nom }}">
                                <i class="fas fa-pen" aria-hidden="true"></i>
                            </a>
                            <button type="button"
                                    class="action-btn action-btn-danger"
                                    title="Supprimer {{ $equipement->nom }}"
                                    data-mdb-ripple-init
                                    data-mdb-modal-init
                                    data-mdb-target="#deleteModal{{ $equipement->id }}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="table-empty">
                            <div class="table-empty__icon">
                                <i class="fas {{ $search || $type ? 'fa-search' : 'fa-inbox' }}" aria-hidden="true"></i>
                            </div>
                            @if($search || $type)
                                <p class="table-empty__title">Aucun résultat</p>
                                <p class="table-empty__subtitle">Aucun équipement ne correspond à votre filtre.</p>
                                <a href="{{ route('equipements.index') }}" class="btn-pro btn-light-pro">
                                    <i class="fas fa-times" aria-hidden="true"></i> Réinitialiser
                                </a>
                            @else
                                <p class="table-empty__title">Aucun équipement</p>
                                <p class="table-empty__subtitle">Commencez par ajouter votre premier matériel.</p>
                                <a href="{{ route('equipements.create') }}" class="btn-pro btn-primary-pro">
                                    <i class="fas fa-plus" aria-hidden="true"></i> Ajouter un équipement
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── Modales de suppression ── --}}
@foreach($equipements as $equipement)
    @include('partials.delete-modal', ['equipement' => $equipement])
@endforeach

@endsection