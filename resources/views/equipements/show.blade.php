@extends('layouts.app')

@section('title', 'Fiche matériel — ' . $equipement->nom . ' — IT Assets Manager')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">

        {{-- Lien retour --}}
        <div class="animate-in" style="margin-bottom:1rem;">
            <a href="{{ route('equipements.index') }}"
               style="color:var(--text-muted);text-decoration:none;font-weight:500;font-size:0.85rem;display:inline-flex;align-items:center;gap:6px;transition:color 0.15s;">
                <i class="fas fa-arrow-left" style="font-size:0.7rem;" aria-hidden="true"></i>
                Retour à l'inventaire
            </a>
        </div>

        {{-- Carte principale du matériel --}}
        <div class="content-card animate-in animate-in-delay-1">
            <div class="content-card-header" style="padding:1.5rem 1.75rem;">
                <div style="display:flex;align-items:center;gap:16px;">
                    @include('partials.equipment-avatar', ['type' => $equipement->type])
                    <div>
                        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                            <h5 style="font-weight:700;margin:0;color:var(--text-primary);">{{ $equipement->nom }}</h5>
                            <span class="id-badge">EQ-{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <small style="color:var(--text-muted);">{{ $equipement->type }} &bull; Parc IT</small>
                    </div>
                </div>

                <div>
                    @include('partials.status-pill', ['statut' => $equipement->statut])
                </div>
            </div>

            <div class="content-card-body" style="padding:1.75rem;">
                <div class="row g-4">
                    {{-- Adresse IP --}}
                    <div class="col-md-6">
                        <div style="background:var(--bg-main);padding:1rem;border-radius:10px;border:1px solid var(--border-color);">
                            <div style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--text-muted);font-weight:600;margin-bottom:4px;">
                                <i class="fas fa-network-wired" style="margin-right:6px;" aria-hidden="true"></i>Adresse IP Réseau
                            </div>
                            <div style="font-size:1.1rem;font-weight:700;color:var(--primary);">
                                <span class="ip-tag" style="font-size:0.95rem;padding:4px 10px;">{{ $equipement->adresse_ip }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Date d'acquisition --}}
                    <div class="col-md-6">
                        <div style="background:var(--bg-main);padding:1rem;border-radius:10px;border:1px solid var(--border-color);">
                            <div style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--text-muted);font-weight:600;margin-bottom:4px;">
                                <i class="fas fa-calendar-alt" style="margin-right:6px;" aria-hidden="true"></i>Date d'acquisition
                            </div>
                            <div style="font-size:1.05rem;font-weight:600;color:var(--text-primary);">
                                {{ \Carbon\Carbon::parse($equipement->date_acquisition)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- Prix estimé --}}
                    <div class="col-md-6">
                        <div style="background:var(--bg-main);padding:1rem;border-radius:10px;border:1px solid var(--border-color);">
                            <div style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--text-muted);font-weight:600;margin-bottom:4px;">
                                <i class="fas fa-coins" style="margin-right:6px;" aria-hidden="true"></i>Valeur / Prix
                            </div>
                            <div style="font-size:1.1rem;font-weight:700;color:var(--green);">
                                {{ $equipement->prix ? number_format($equipement->prix, 0, ',', ' ') . ' FCFA' : 'Non renseigné' }}
                            </div>
                        </div>
                    </div>

                    {{-- Date de mise à jour --}}
                    <div class="col-md-6">
                        <div style="background:var(--bg-main);padding:1rem;border-radius:10px;border:1px solid var(--border-color);">
                            <div style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--text-muted);font-weight:600;margin-bottom:4px;">
                                <i class="fas fa-clock" style="margin-right:6px;" aria-hidden="true"></i>Dernière mise à jour
                            </div>
                            <div style="font-size:0.95rem;font-weight:500;color:var(--text-secondary);">
                                {{ $equipement->updated_at ? $equipement->updated_at->diffForHumans() : 'Non enregistrée' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2rem;padding-top:1.25rem;border-top:1px solid var(--border-color);">
                    <a href="{{ route('equipements.index') }}" class="btn-pro btn-light-pro">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i> Retour
                    </a>

                    <div style="display:flex;gap:10px;">
                        <a href="{{ route('equipements.edit', $equipement->id) }}" class="btn-pro btn-primary-pro">
                            <i class="fas fa-pen" aria-hidden="true"></i> Modifier
                        </a>
                        <button type="button"
                                class="btn-pro btn-danger-pro"
                                data-mdb-ripple-init
                                data-mdb-modal-init
                                data-mdb-target="#deleteModal{{ $equipement->id }}">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i> Supprimer
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- Modale de suppression --}}
@include('partials.delete-modal', ['equipement' => $equipement])

@endsection
