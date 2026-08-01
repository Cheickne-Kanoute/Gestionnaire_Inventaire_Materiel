@extends('layouts.app')

@section('title', 'Modifier l\'utilisateur — IT Assets Manager')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fas fa-user-edit" aria-hidden="true"></i>
            Modifier l'utilisateur
        </h1>
        <p class="page-subtitle">{{ $user->name }}</p>
    </div>
    <a href="{{ route('users.index') }}" class="btn-pro btn-secondary-pro">
        <i class="fas fa-arrow-left" aria-hidden="true"></i>
        Retour
    </a>
</div>

<div class="form-card-pro">
    <form method="POST" action="{{ route('users.update', $user) }}" novalidate>
        @csrf
        @method('PATCH')

        {{-- Nom --}}
        <div class="form-group-pro @error('name') has-error @enderror">
            <label for="name" class="form-label-pro">
                <i class="fas fa-user"></i>
                Nom complet <span class="required">*</span>
            </label>
            <input type="text"
                   id="name"
                   name="name"
                   class="form-input-pro @error('name') input-error @enderror"
                   value="{{ old('name', $user->name) }}"
                   placeholder="Ex : Jean Dupont"
                   required
                   autocomplete="name">
            @error('name')
                <span class="form-error-pro" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group-pro @error('email') has-error @enderror">
            <label for="email" class="form-label-pro">
                <i class="fas fa-envelope"></i>
                Adresse e-mail <span class="required">*</span>
            </label>
            <input type="email"
                   id="email"
                   name="email"
                   class="form-input-pro @error('email') input-error @enderror"
                   value="{{ old('email', $user->email) }}"
                   placeholder="exemple@domaine.com"
                   required
                   autocomplete="email">
            @error('email')
                <span class="form-error-pro" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Rôle --}}
        <div class="form-group-pro @error('role') has-error @enderror">
            <label for="role" class="form-label-pro">
                <i class="fas fa-user-tag"></i>
                Rôle <span class="required">*</span>
            </label>
            <select id="role" name="role"
                    class="form-input-pro @error('role') input-error @enderror"
                    required
                    {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                <option value="gestionnaire" {{ old('role', $user->role) === 'gestionnaire' ? 'selected' : '' }}>
                    Gestionnaire — Peut gérer l'inventaire
                </option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                    Administrateur — Accès complet
                </option>
            </select>
            @if($user->id === auth()->id())
                {{-- Champ caché si l'admin modifie son propre profil --}}
                <input type="hidden" name="role" value="{{ $user->role }}">
                <p class="form-hint">
                    <i class="fas fa-info-circle"></i>
                    Vous ne pouvez pas modifier votre propre rôle.
                </p>
            @endif
            @error('role')
                <span class="form-error-pro" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Nouveau mot de passe (optionnel) --}}
        <div class="form-section-divider">
            <span>Changer le mot de passe (optionnel)</span>
        </div>

        <div class="form-group-pro @error('password') has-error @enderror">
            <label for="password" class="form-label-pro">
                <i class="fas fa-lock"></i>
                Nouveau mot de passe
            </label>
            <input type="password"
                   id="password"
                   name="password"
                   class="form-input-pro @error('password') input-error @enderror"
                   placeholder="Laisser vide pour ne pas changer"
                   autocomplete="new-password">
            @error('password')
                <span class="form-error-pro" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-group-pro">
            <label for="password_confirmation" class="form-label-pro">
                <i class="fas fa-lock"></i>
                Confirmer le nouveau mot de passe
            </label>
            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   class="form-input-pro"
                   placeholder="Répéter le nouveau mot de passe"
                   autocomplete="new-password">
        </div>

        {{-- Boutons --}}
        <div class="form-actions-pro">
            <a href="{{ route('users.index') }}" class="btn-pro btn-secondary-pro">Annuler</a>
            <button type="submit" id="btn-update-user" class="btn-pro btn-primary-pro">
                <i class="fas fa-save" aria-hidden="true"></i>
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection
