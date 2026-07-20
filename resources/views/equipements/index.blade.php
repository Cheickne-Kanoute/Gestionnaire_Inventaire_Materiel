@extends('layouts.app')

@section('count', $totalCount)

@section('content')

{{-- ── Page Header ── --}}
<div class="d-flex justify-content-between align-items-end mb-4 animate-in">
    <div>
        <h4 style="font-weight: 800; letter-spacing: -0.5px; margin-bottom: 2px;">Overview</h4>
        <p style="color: var(--text-muted); font-size: 0.88rem; margin: 0;">Vue d'ensemble de votre parc informatique</p>
    </div>
    <a href="{{ route('equipements.create') }}" class="btn-pro btn-primary-pro">
        <i class="fas fa-plus" style="font-size: 0.8rem;"></i> Ajouter
    </a>
</div>

{{-- ── Stat Cards ── --}}
<div class="row g-3 mb-5">
    <div class="col-6 col-lg-3 animate-in animate-in-delay-1">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total équipements</div>
                <div class="stat-value">{{ $totalCount }}</div>
            </div>
            <div class="stat-icon" style="background: var(--primary-50); color: var(--primary);">
                <i class="fas fa-boxes"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 animate-in animate-in-delay-2">
        <div class="stat-card">
            <div>
                <div class="stat-label">Actifs</div>
                <div class="stat-value" style="color: var(--green);">{{ $actifCount }}</div>
            </div>
            <div class="stat-icon" style="background: var(--green-bg); color: var(--green);">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 animate-in animate-in-delay-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">En maintenance</div>
                <div class="stat-value" style="color: var(--amber);">{{ $maintenanceCount }}</div>
            </div>
            <div class="stat-icon" style="background: var(--amber-bg); color: var(--amber);">
                <i class="fas fa-wrench"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 animate-in animate-in-delay-4">
        <div class="stat-card">
            <div>
                <div class="stat-label">Taux opérationnel</div>
                <div class="stat-value">
                    {{ $totalCount > 0 ? round(($actifCount / $totalCount) * 100) : 0 }}<span style="font-size: 1rem; font-weight: 600;">%</span>
                </div>
            </div>
            <div class="stat-icon" style="background: #f0f0ff; color: #7c3aed;">
                <i class="fas fa-chart-pie"></i>
            </div>
        </div>
    </div>
</div>

{{-- ── Table ── --}}
<div class="content-card animate-in animate-in-delay-5">
    <div class="content-card-header">
        <div>
            <h6 style="font-weight: 700; font-size: 1rem; margin: 0;">Équipements récents</h6>
            <small style="color: var(--text-muted);">{{ $totalCount }} matériel{{ $totalCount > 1 ? 's' : '' }} enregistré{{ $totalCount > 1 ? 's' : '' }}</small>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="padding-left: 1.5rem;">Équipement</th>
                    <th>Type</th>
                    <th>Adresse IP</th>
                    <th>Acquisition</th>
                    <th>Statut</th>
                    <th style="text-align: right; padding-right: 1.5rem;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipements as $equipement)
                <tr>
                    <td style="padding-left: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="eq-avatar"
                                @if($equipement->type == 'PC')
                                    style="background: var(--primary-50); color: var(--primary);"
                                @elseif($equipement->type == 'Serveur')
                                    style="background: #f3e8ff; color: #7c3aed;"
                                @else
                                    style="background: #ecfeff; color: #0891b2;"
                                @endif
                            >
                                @if($equipement->type == 'PC')
                                    <i class="fas fa-laptop"></i>
                                @elseif($equipement->type == 'Serveur')
                                    <i class="fas fa-server"></i>
                                @else
                                    <i class="fas fa-network-wired"></i>
                                @endif
                            </div>
                            <div>
                                <div style="font-weight: 600; color: var(--text); font-size: 0.88rem;">{{ $equipement->nom }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">
                                    <span class="id-badge">EQ-{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-weight: 500; color: var(--text-secondary);">{{ $equipement->type }}</span>
                    </td>
                    <td>
                        <span class="ip-tag">{{ $equipement->adresse_ip }}</span>
                    </td>
                    <td>
                        <span style="color: var(--text-secondary); font-size: 0.85rem;">
                            {{ \Carbon\Carbon::parse($equipement->date_acquisition)->format('d M Y') }}
                        </span>
                    </td>
                    <td>
                        @if($equipement->statut == 'Actif')
                            <span class="status-pill status-actif">
                                <span class="dot"></span> Actif
                            </span>
                        @else
                            <span class="status-pill status-maintenance">
                                <span class="dot"></span> Maintenance
                            </span>
                        @endif
                    </td>
                    <td style="padding-right: 1.5rem;">
                        <div class="action-btn-group">
                            <a href="{{ route('equipements.edit', $equipement->id) }}" class="action-btn" title="Modifier">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button type="button" class="action-btn action-btn-danger" title="Supprimer"
                                data-mdb-ripple-init
                                data-mdb-modal-init
                                data-mdb-target="#deleteModal{{ $equipement->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 4rem 1rem;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--bg); border-radius: 16px; margin-bottom: 1rem;">
                            <i class="fas fa-inbox" style="font-size: 1.5rem; color: var(--text-muted);"></i>
                        </div>
                        <p style="font-weight: 600; color: var(--text); margin-bottom: 4px;">Aucun équipement</p>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1rem;">Commencez par ajouter votre premier matériel</p>
                        <a href="{{ route('equipements.create') }}" class="btn-pro btn-primary-pro" style="font-size: 0.82rem;">
                            <i class="fas fa-plus"></i> Ajouter un équipement
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── Delete Modals ── --}}
@foreach($equipements as $equipement)
<div class="modal fade" id="deleteModal{{ $equipement->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
        <div class="modal-content">
            <div class="modal-body text-center" style="padding: 2rem 1.75rem 1rem;">
                <div style="width: 56px; height: 56px; background: var(--red-bg); border-radius: 16px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <i class="fas fa-trash-alt" style="color: var(--red); font-size: 1.25rem;"></i>
                </div>
                <h6 style="font-weight: 700; margin-bottom: 8px;">Confirmer la suppression</h6>
                <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin: 0;">
                    L'équipement <strong style="color: var(--text);">{{ $equipement->nom }}</strong> sera supprimé définitivement de l'inventaire.
                </p>
            </div>
            <div style="display: flex; gap: 10px; padding: 1rem 1.75rem 1.75rem; justify-content: center;">
                <button type="button" class="btn-pro btn-light-pro" style="flex: 1;" data-mdb-dismiss="modal">Annuler</button>
                <form action="{{ route('equipements.destroy', $equipement->id) }}" method="POST" style="flex: 1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-pro" style="background: var(--red); color: #fff; width: 100%; box-shadow: 0 1px 3px rgba(220,38,38,0.25);">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection