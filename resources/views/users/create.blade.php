@extends('layouts.app')

@section('title', 'Nouvel utilisateur — IT Assets Manager')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fas fa-user-plus" aria-hidden="true"></i>
            Nouvel utilisateur
        </h1>
        <p class="page-subtitle">Créer un compte avec un rôle défini</p>
    </div>
    <a href="{{ route('users.index') }}" class="btn-pro btn-secondary-pro">
        <i class="fas fa-arrow-left" aria-hidden="true"></i>
        Retour
    </a>
</div>

<div class="form-card-pro">
    <form method="POST" action="{{ route('users.store') }}" novalidate>
        @csrf

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
                   value="{{ old('name') }}"
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
                   value="{{ old('email') }}"
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
                    required>
                <option value="">-- Choisir un rôle --</option>
                <option value="gestionnaire" {{ old('role') === 'gestionnaire' ? 'selected' : '' }}>
                    Gestionnaire — Peut gérer l'inventaire
                </option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                    Administrateur — Accès complet
                </option>
            </select>
            @error('role')
                <span class="form-error-pro" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Mot de passe --}}
        <div class="form-group-pro @error('password') has-error @enderror">
            <label for="password" class="form-label-pro">
                <i class="fas fa-lock"></i>
                Mot de passe <span class="required">*</span>
            </label>
            <input type="password"
                   id="password"
                   name="password"
                   class="form-input-pro @error('password') input-error @enderror"
                   placeholder="Minimum 8 caractères"
                   required
                   autocomplete="new-password">
            @error('password')
                <span class="form-error-pro" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        {{-- Confirmation mot de passe --}}
        <div class="form-group-pro">
            <label for="password_confirmation" class="form-label-pro">
                <i class="fas fa-lock"></i>
                Confirmer le mot de passe <span class="required">*</span>
            </label>
            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   class="form-input-pro"
                   placeholder="Répéter le mot de passe"
                   required
                   autocomplete="new-password">
        </div>

        {{-- Boutons --}}
        <div class="form-actions-pro">
            <a href="{{ route('users.index') }}" class="btn-pro btn-secondary-pro">Annuler</a>
            <button type="submit" id="btn-create-user" class="btn-pro btn-primary-pro">
                <i class="fas fa-check" aria-hidden="true"></i>
                Créer l'utilisateur
            </button>
        </div>
    </form>
</div>
@endsection
