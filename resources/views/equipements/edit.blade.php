@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">

        {{-- Back link --}}
        <div class="mb-4 animate-in" style="font-size: 0.85rem;">
            <a href="{{ route('equipements.index') }}" style="color: var(--text-muted); text-decoration: none; font-weight: 500; transition: color 0.15s; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fas fa-arrow-left" style="font-size: 0.7rem;"></i> Retour à l'inventaire
            </a>
        </div>

        <div class="content-card animate-in animate-in-delay-1">
            <div class="content-card-header">
                <div style="display: flex; align-items: center; gap: 14px;">
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
                        <h6 style="font-weight: 700; color: var(--text); margin: 0 0 2px; font-size: 1rem;">{{ $equipement->nom }}</h6>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span class="id-badge">EQ-{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}</span>
                            <span style="color: var(--text-muted); font-size: 0.78rem;">{{ $equipement->type }}</span>
                        </div>
                    </div>
                </div>
                @if($equipement->statut == 'Actif')
                    <span class="status-pill status-actif"><span class="dot"></span> Actif</span>
                @else
                    <span class="status-pill status-maintenance"><span class="dot"></span> Maintenance</span>
                @endif
            </div>

            <div style="padding: 1.75rem;">
                <form action="{{ route('equipements.update', $equipement->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 1.25rem;">
                        <label class="form-label-pro" for="nom">Nom de l'équipement <span class="required">*</span></label>
                        <input type="text" name="nom" id="nom"
                            class="form-input-pro @error('nom') is-invalid @enderror"
                            value="{{ old('nom', $equipement->nom) }}" />
                        @error('nom')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 1.25rem;">
                            <label class="form-label-pro" for="type">Type <span class="required">*</span></label>
                            <select name="type" id="type" class="form-input-pro @error('type') is-invalid @enderror">
                                <option value="PC"      {{ old('type', $equipement->type) == 'PC'      ? 'selected' : '' }}>Ordinateur (PC)</option>
                                <option value="Serveur" {{ old('type', $equipement->type) == 'Serveur' ? 'selected' : '' }}>Serveur</option>
                                <option value="Switch"  {{ old('type', $equipement->type) == 'Switch'  ? 'selected' : '' }}>Switch</option>
                            </select>
                            @error('type')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1.25rem;">
                            <label class="form-label-pro" for="statut">Statut <span class="required">*</span></label>
                            <select name="statut" id="statut" class="form-input-pro @error('statut') is-invalid @enderror">
                                <option value="Actif"          {{ old('statut', $equipement->statut) == 'Actif'          ? 'selected' : '' }}>Actif</option>
                                <option value="En maintenance" {{ old('statut', $equipement->statut) == 'En maintenance' ? 'selected' : '' }}>En maintenance</option>
                            </select>
                            @error('statut')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 1.25rem;">
                            <label class="form-label-pro" for="adresse_ip">Adresse IP <span class="required">*</span></label>
                            <input type="text" name="adresse_ip" id="adresse_ip"
                                class="form-input-pro @error('adresse_ip') is-invalid @enderror"
                                value="{{ old('adresse_ip', $equipement->adresse_ip) }}" />
                            @error('adresse_ip')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1.25rem;">
                            <label class="form-label-pro" for="date_acquisition">Date d'acquisition <span class="required">*</span></label>
                            <input type="date" name="date_acquisition" id="date_acquisition"
                                class="form-input-pro @error('date_acquisition') is-invalid @enderror"
                                value="{{ old('date_acquisition', $equipement->date_acquisition) }}" />
                            @error('date_acquisition')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 10px; padding-top: 1.25rem; margin-top: 0.75rem; border-top: 1px solid var(--border);">
                        <a href="{{ route('equipements.index') }}" class="btn-pro btn-light-pro">Annuler</a>
                        <button type="submit" class="btn-pro btn-primary-pro">
                            <i class="fas fa-save" style="font-size: 0.8rem;"></i> Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection