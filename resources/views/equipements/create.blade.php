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
                <div>
                    <h6 style="font-weight: 700; color: var(--text); margin: 0 0 2px;">Nouvel équipement</h6>
                    <small style="color: var(--text-muted);">Renseignez les informations du matériel</small>
                </div>
                <div class="stat-icon" style="background: var(--primary-50); color: var(--primary);">
                    <i class="fas fa-plus"></i>
                </div>
            </div>

            <div style="padding: 1.75rem;">
                <form action="{{ route('equipements.store') }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 1.25rem;">
                        <label class="form-label-pro" for="nom">Nom de l'équipement <span class="required">*</span></label>
                        <input type="text" name="nom" id="nom"
                            class="form-input-pro @error('nom') is-invalid @enderror"
                            value="{{ old('nom') }}"
                            placeholder="Ex : PC-Compta-01" />
                        @error('nom')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 1.25rem;">
                            <label class="form-label-pro" for="type">Type <span class="required">*</span></label>
                            <select name="type" id="type" class="form-input-pro @error('type') is-invalid @enderror">
                                <option value="" disabled selected>Choisir un type...</option>
                                <option value="PC"      {{ old('type') == 'PC'      ? 'selected' : '' }}>Ordinateur (PC)</option>
                                <option value="Serveur" {{ old('type') == 'Serveur' ? 'selected' : '' }}>Serveur</option>
                                <option value="Switch"  {{ old('type') == 'Switch'  ? 'selected' : '' }}>Switch</option>
                            </select>
                            @error('type')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1.25rem;">
                            <label class="form-label-pro" for="statut">Statut <span class="required">*</span></label>
                            <select name="statut" id="statut" class="form-input-pro @error('statut') is-invalid @enderror">
                                <option value="" disabled selected>Choisir un statut...</option>
                                <option value="Actif"          {{ old('statut') == 'Actif'          ? 'selected' : '' }}>Actif</option>
                                <option value="En maintenance" {{ old('statut') == 'En maintenance' ? 'selected' : '' }}>En maintenance</option>
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
                                value="{{ old('adresse_ip') }}"
                                placeholder="192.168.1.100" />
                            @error('adresse_ip')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6" style="margin-bottom: 1.25rem;">
                            <label class="form-label-pro" for="date_acquisition">Date d'acquisition <span class="required">*</span></label>
                            <input type="date" name="date_acquisition" id="date_acquisition"
                                class="form-input-pro @error('date_acquisition') is-invalid @enderror"
                                value="{{ old('date_acquisition') }}" />
                            @error('date_acquisition')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 10px; padding-top: 1.25rem; margin-top: 0.75rem; border-top: 1px solid var(--border);">
                        <a href="{{ route('equipements.index') }}" class="btn-pro btn-light-pro">Annuler</a>
                        <button type="submit" class="btn-pro btn-primary-pro">
                            <i class="fas fa-check" style="font-size: 0.8rem;"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection