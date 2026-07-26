@extends('layouts.app')

@section('title', 'Nouvel équipement — IT Assets Manager')

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
                <div>
                    <h6>Nouvel équipement</h6>
                    <small>Renseignez les informations du matériel</small>
                </div>
                <div class="kpi-icon" style="background:var(--primary-50);color:var(--primary);width:40px;height:40px;">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                </div>
            </div>

            <div class="content-card-body">
                <form action="{{ route('equipements.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="form-group">
                        <label class="form-label-pro" for="nom">
                            Nom de l'équipement <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="nom"
                               id="nom"
                               class="form-input-pro @error('nom') is-invalid @enderror"
                               value="{{ old('nom') }}"
                               placeholder="Ex : PC-Compta-01"
                               autocomplete="off">
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
                                    <option value="" disabled selected>Choisir un type…</option>
                                    <option value="PC"      {{ old('type') === 'PC'      ? 'selected' : '' }}>Ordinateur (PC)</option>
                                    <option value="Serveur" {{ old('type') === 'Serveur' ? 'selected' : '' }}>Serveur</option>
                                    <option value="Switch"  {{ old('type') === 'Switch'  ? 'selected' : '' }}>Switch</option>
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
                                    <option value="" disabled selected>Choisir un statut…</option>
                                    <option value="Actif"          {{ old('statut') === 'Actif'          ? 'selected' : '' }}>Actif</option>
                                    <option value="En maintenance" {{ old('statut') === 'En maintenance' ? 'selected' : '' }}>En maintenance</option>
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
                                       value="{{ old('adresse_ip') }}"
                                       placeholder="192.168.1.100">
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
                                       value="{{ old('date_acquisition') }}">
                                @error('date_acquisition')
                                    <div class="form-error">
                                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label-pro" for="prix">
                            Prix (FCFA)
                        </label>
                        <input type="number"
                               name="prix"
                               id="prix"
                               class="form-input-pro @error('prix') is-invalid @enderror"
                               value="{{ old('prix') }}"
                               placeholder="Ex : 450000"
                               min="0">
                        @error('prix')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('equipements.index') }}" class="btn-pro btn-light-pro">
                            Annuler
                        </a>
                        <button type="submit" class="btn-pro btn-primary-pro">
                            <i class="fas fa-check" style="font-size:0.8rem;" aria-hidden="true"></i>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection