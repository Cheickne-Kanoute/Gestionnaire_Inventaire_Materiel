@extends('layouts.app')

@section('title', 'Tableau de bord — IT Assets Manager')

@section('content')

{{-- ── En-tête ── --}}
<div class="dash-header animate-in">
    <div>
        <h1 class="dash-title">Tableau de bord</h1>
        <p class="dash-subtitle">Vue d'ensemble de votre parc informatique</p>
    </div>
    <a href="{{ route('equipements.create') }}" class="btn-pro btn-primary-pro">
        <i class="fas fa-plus" aria-hidden="true"></i>
        Ajouter un équipement
    </a>
</div>

{{-- ── Section médiane ── --}}
<div class="dash-mid-grid">

    {{-- Répartition par type --}}
    <div class="content-card animate-in animate-in-delay-5">
        <div class="content-card-header">
            <div>
                <h6>Répartition par type</h6>
                <small>{{ $totalCount }} équipement{{ $totalCount > 1 ? 's' : '' }} au total</small>
            </div>
            <div class="kpi-icon" style="background:var(--primary-50);color:var(--primary);width:36px;height:36px;font-size:0.85rem;">
                <i class="fas fa-chart-bar" aria-hidden="true"></i>
            </div>
        </div>
        <div class="content-card-body">
            @php
                $typesMeta = [
                    'PC'      => ['label' => 'Ordinateurs', 'icon' => 'fa-laptop',       'slug' => 'pc'],
                    'Serveur' => ['label' => 'Serveurs',    'icon' => 'fa-server',        'slug' => 'serveur'],
                    'Switch'  => ['label' => 'Switches',    'icon' => 'fa-network-wired', 'slug' => 'switch'],
                ];
            @endphp

            @foreach($typesMeta as $key => $meta)
                @php
                    $count = $byType[$key] ?? 0;
                    $pct   = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
                @endphp
                <div class="type-row">
                    <div class="type-row__header">
                        <div class="type-row__info">
                            <div class="type-icon type-icon--{{ $meta['slug'] }}">
                                <i class="fas {{ $meta['icon'] }}" aria-hidden="true"></i>
                            </div>
                            <div>
                                <div class="type-row__name">{{ $meta['label'] }}</div>
                                <div class="type-row__count">{{ $count }} appareil{{ $count > 1 ? 's' : '' }}</div>
                            </div>
                        </div>
                        <span class="type-row__pct pct--{{ $meta['slug'] }}">{{ $pct }}%</span>
                    </div>
                    <div class="type-bar-track" role="progressbar" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="type-bar-fill type-bar-fill--{{ $meta['slug'] }}"
                             data-width="{{ $pct }}%"
                             style="width:0;"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Santé du parc (anneau SVG) --}}
    <div class="content-card animate-in animate-in-delay-5" style="display:flex;flex-direction:column;">
        <div class="content-card-header">
            <div>
                <h6>Santé du parc</h6>
                <small>Statut des équipements</small>
            </div>
            <div class="kpi-icon" style="background:var(--purple-bg);color:var(--purple);width:36px;height:36px;font-size:0.85rem;">
                <i class="fas fa-heartbeat" aria-hidden="true"></i>
            </div>
        </div>
        <div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:2rem 1.5rem;">
            @php
                $radius  = 52;
                $circ    = round(2 * M_PI * $radius, 2);
                $dashArr = round($circ * $tauxOp / 100, 1);
                $dashOff = round($circ - $dashArr, 1);
                $ringColor = $tauxOp >= 75 ? 'var(--green)' : ($tauxOp >= 50 ? 'var(--amber)' : 'var(--red)');
            @endphp

            <div class="ring-wrapper">
                <svg width="140" height="140" viewBox="0 0 120 120" aria-hidden="true">
                    <circle cx="60" cy="60" r="{{ $radius }}" fill="none" stroke="var(--border)" stroke-width="10"/>
                    <circle cx="60" cy="60" r="{{ $radius }}" fill="none"
                        stroke="{{ $ringColor }}"
                        stroke-width="10"
                        stroke-linecap="round"
                        stroke-dasharray="{{ $dashArr }} {{ $dashOff }}"
                        class="ring-progress"/>
                </svg>
                <div class="ring-center">
                    <span class="ring-percent">{{ $tauxOp }}%</span>
                    <span class="ring-label">Opérationnel</span>
                </div>
            </div>

            <div class="health-stats">
                <div class="health-stat">
                    <div class="health-stat__value" style="color:var(--green);">{{ $actifCount }}</div>
                    <div class="health-stat__label">Actifs</div>
                </div>
                <div class="health-divider" aria-hidden="true"></div>
                <div class="health-stat">
                    <div class="health-stat__value" style="color:var(--amber);">{{ $maintenanceCount }}</div>
                    <div class="health-stat__label">Maintenance</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Ajouts récents ── --}}
<div class="content-card animate-in animate-in-delay-5">
    <div class="content-card-header">
        <div>
            <h6>Ajouts récents</h6>
            <small>Les 5 derniers équipements enregistrés</small>
        </div>
        <a href="{{ route('equipements.index') }}" class="btn-pro btn-light-pro" style="font-size:0.8rem;padding:0.4rem 0.9rem;">
            Voir tout <i class="fas fa-arrow-right" aria-hidden="true" style="font-size:0.7rem;"></i>
        </a>
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
                @forelse($recents as $eq)
                <tr>
                    <td>
                        <div class="eq-cell">
                            @include('partials.equipment-avatar', ['type' => $eq->type])
                            <div>
                                <div class="eq-cell__info-name">{{ $eq->nom }}</div>
                                <div class="eq-cell__info-sub">
                                    <span class="id-badge">EQ-{{ str_pad($eq->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="col-hide-mobile">
                        <span style="font-weight:500;color:var(--text-secondary);">{{ $eq->type }}</span>
                    </td>
                    <td class="col-hide-mobile">
                        <span class="ip-tag">{{ $eq->adresse_ip }}</span>
                    </td>
                    <td class="col-hide-mobile">
                        <span style="color:var(--text-secondary);font-size:0.85rem;">
                            {{ \Carbon\Carbon::parse($eq->date_acquisition)->format('d M Y') }}
                        </span>
                    </td>
                    <td>@include('partials.status-pill', ['statut' => $eq->statut])</td>
                    <td>
                        <div class="action-btn-group">
                            <a href="{{ route('equipements.edit', $eq->id) }}"
                               class="action-btn"
                               title="Modifier {{ $eq->nom }}">
                                <i class="fas fa-pen" aria-hidden="true"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="table-empty">
                            <div class="table-empty__icon">
                                <i class="fas fa-inbox" aria-hidden="true"></i>
                            </div>
                            <p class="table-empty__title">Aucun équipement</p>
                            <p class="table-empty__subtitle">Commencez par ajouter votre premier matériel</p>
                            <a href="{{ route('equipements.create') }}" class="btn-pro btn-primary-pro">
                                <i class="fas fa-plus" aria-hidden="true"></i> Ajouter
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
