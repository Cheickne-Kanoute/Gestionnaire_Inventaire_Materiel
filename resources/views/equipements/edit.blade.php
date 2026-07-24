@extends('layouts.app')

@section('title', 'Modifier ' . $equipement->nom . ' — IT Assets Manager')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">

        {{-- Lien retour --}}
        <div class="animate-in" style="margin-bottom:1rem;">
            <a href="{{ route('equipements.index') }}"
               style="color:var(--text-muted);text-decoration:none;font-weight:500;font-size:0.85rem;display:inline-flex;align-items:center;gap:6px;transition:color 0.15s;">
                <i class="fas fa-arrow-left" style="font-size:0.7rem;" aria-hidden="true"></i>
                Retour à l'inventaire
            </a>
        </div>

        <div class="content-card animate-in animate-in-delay-1">
            <div class="content-card-header">
                <div style="display:flex;align-items:center;gap:14px;">
                    @include('partials.equipment-avatar', ['type' => $equipement->type])
                    <div>
                        <h6 style="font-size:1rem;">{{ $equipement->nom }}</h6>
                        <div style="display:flex;align-items:center;gap:8px;margin-top:2px;">
                            <span class="id-badge">EQ-{{ str_pad($equipement->id, 3, '0', STR_PAD_LEFT) }}</span>
                            <span style="color:var(--text-muted);font-size:0.78rem;">{{ $equipement->type }}</span>
                        </div>
                    </div>
                </div>
                @include('partials.status-pill', ['statut' => $equipement->statut])
            </div>

            <div class="content-card-body">
                <form action="{{ route('equipements.update', $equipement->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label-pro" for="nom">
                            Nom de l'équipement <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="nom"
                               id="nom"
                               class="form-input-pro @error('nom') is-invalid @enderror"
                               value="{{ old('nom', $equipement->nom) }}">
                        @error('nom')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-pro" for="type">
                                    Type <span class="required">*</span>
                                </label>
                                <select name="type" id="type"
                                        class="form-input-pro @error('type') is-invalid @enderror">
                                    <option value="PC"      {{ old('type', $equipement->type) === 'PC'      ? 'selected' : '' }}>Ordinateur (PC)</option>
                                    <option value="Serveur" {{ old('type', $equipement->type) === 'Serveur' ? 'selected' : '' }}>Serveur</option>
                                    <option value="Switch"  {{ old('type', $equipement->type) === 'Switch'  ? 'selected' : '' }}>Switch</option>
                                </select>
                                @error('type')
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-pro" for="statut">
                                    Statut <span class="required">*</span>
                                </label>
                                <select name="statut" id="statut"
                                        class="form-input-pro @error('statut') is-invalid @enderror">
                                    <option value="Actif"          {{ old('statut', $equipement->statut) === 'Actif'          ? 'selected' : '' }}>Actif</option>
                                    <option value="En maintenance" {{ old('statut', $equipement->statut) === 'En maintenance' ? 'selected' : '' }}>En maintenance</option>
                                </select>
                                @error('statut')
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-pro" for="adresse_ip">
                                    Adresse IP <span class="required">*</span>
                                </label>
                                <input type="text"
                                       name="adresse_ip"
                                       id="adresse_ip"
                                       class="form-input-pro @error('adresse_ip') is-invalid @enderror"
                                       value="{{ old('adresse_ip', $equipement->adresse_ip) }}">
                                @error('adresse_ip')
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label-pro" for="date_acquisition">
                                    Date d'acquisition <span class="required">*</span>
                                </label>
                                <input type="date"
                                       name="date_acquisition"
                                       id="date_acquisition"
                                       class="form-input-pro @error('date_acquisition') is-invalid @enderror"
                                       value="{{ old('date_acquisition', $equipement->date_acquisition) }}">
                                @error('date_acquisition')
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('equipements.index') }}" class="btn-pro btn-light-pro">
                            Annuler
                        </a>
                        <button type="submit" class="btn-pro btn-primary-pro">
                            <i class="fas fa-save" style="font-size:0.8rem;" aria-hidden="true"></i>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection