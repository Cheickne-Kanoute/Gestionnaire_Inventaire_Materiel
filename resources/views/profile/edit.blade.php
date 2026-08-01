@extends('layouts.app')

@section('title', 'Profil Utilisateur — IT Assets Manager')

@section('content')
<div class="page-header" style="margin-bottom: 1.5rem;">
    <div>
        <h1 class="page-title" style="font-size: 1.5rem; font-weight: 800; color: var(--text); margin: 0;">Profil Utilisateur</h1>
        <p class="page-subtitle" style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px;">Gérez vos informations de compte et vos paramètres de sécurité</p>
    </div>
</div>

<div style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 900px;">
    {{-- Section 1 : Informations du profil --}}
    <div class="content-card">
        <div class="content-card-header">
            <div>
                <h6><i class="fas fa-user-circle text-primary me-2"></i> Informations du Profil</h6>
                <small>Mettez à jour vos informations personnelles et votre adresse email</small>
            </div>
        </div>
        <div class="content-card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Section 2 : Modifier le mot de passe --}}
    <div class="content-card">
        <div class="content-card-header">
            <div>
                <h6><i class="fas fa-key text-primary me-2"></i> Modifier le mot de passe</h6>
                <small>Assurez-vous d'utiliser un mot de passe fort et sécurisé</small>
            </div>
        </div>
        <div class="content-card-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Section 3 : Supprimer le compte --}}
    <div class="content-card" style="border-color: #fee2e2;">
        <div class="content-card-header" style="background: #fef2f2; border-bottom-color: #fee2e2;">
            <div>
                <h6 style="color: var(--red);"><i class="fas fa-exclamation-triangle me-2"></i> Supprimer le compte</h6>
                <small style="color: #991b1b;">Zone de danger : cette action est irréversible</small>
            </div>
        </div>
        <div class="content-card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
