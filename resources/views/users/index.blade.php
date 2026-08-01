@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs — IT Assets Manager')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fas fa-users-cog" aria-hidden="true"></i>
            Gestion des utilisateurs
        </h1>
        <p class="page-subtitle">Gérez les comptes et les droits d'accès</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn-pro btn-primary-pro">
        <i class="fas fa-user-plus" aria-hidden="true"></i>
        Ajouter un utilisateur
    </a>
</div>

{{-- Stats rapides --}}
<div class="stats-grid mb-4">
    <div class="stat-card stat-blue">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $users->count() }}</div>
            <div class="stat-label">Total utilisateurs</div>
        </div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon"><i class="fas fa-user-shield"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
            <div class="stat-label">Administrateurs</div>
        </div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="fas fa-user-cog"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $users->where('role', 'gestionnaire')->count() }}</div>
            <div class="stat-label">Gestionnaires</div>
        </div>
    </div>
</div>

{{-- Tableau utilisateurs --}}
<div class="card-pro">
    <div class="card-header-pro">
        <h2 class="card-title-pro">
            <i class="fas fa-list-ul"></i>
            Liste des utilisateurs
        </h2>
    </div>

    @if($users->isEmpty())
        <div class="empty-state">
            <i class="fas fa-user-slash" aria-hidden="true"></i>
            <p>Aucun utilisateur trouvé.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table-pro" role="grid" aria-label="Liste des utilisateurs">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Adresse e-mail</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Créé le</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar" aria-hidden="true">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="fw-600">{{ $user->name }}</span>
                                @if($user->id === auth()->id())
                                    <span class="badge-pro badge-info-pro ms-1">Vous</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge-pro badge-purple-pro">
                                    <i class="fas fa-shield-alt me-1"></i>Admin
                                </span>
                            @else
                                <span class="badge-pro badge-success-pro">
                                    <i class="fas fa-cog me-1"></i>Gestionnaire
                                </span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('users.edit', $user) }}"
                                   class="btn-action btn-edit"
                                   title="Modifier {{ $user->name }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ addslashes($user->name) }} ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"
                                            title="Supprimer {{ $user->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
