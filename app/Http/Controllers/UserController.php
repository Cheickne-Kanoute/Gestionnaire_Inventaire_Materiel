<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'     => ['required', 'in:admin,gestionnaire'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'name.required'      => 'Le nom est obligatoire.',
            'name.max'           => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required'     => 'L\'adresse e-mail est obligatoire.',
            'email.email'        => 'L\'adresse e-mail n\'est pas valide.',
            'email.unique'       => 'Cette adresse e-mail est déjà utilisée.',
            'role.required'      => 'Le rôle est obligatoire.',
            'role.in'            => 'Le rôle doit être admin ou gestionnaire.',
            'password.required'  => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'L\'utilisateur a été créé avec succès.');
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role'  => ['required', 'in:admin,gestionnaire'],
        ];

        $messages = [
            'name.required'  => 'Le nom est obligatoire.',
            'name.max'       => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email'    => 'L\'adresse e-mail n\'est pas valide.',
            'email.unique'   => 'Cette adresse e-mail est déjà utilisée.',
            'role.required'  => 'Le rôle est obligatoire.',
            'role.in'        => 'Le rôle doit être admin ou gestionnaire.',
        ];

        // Mot de passe optionnel lors de la modification
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Password::min(8)];
            $messages['password.confirmed'] = 'La confirmation du mot de passe ne correspond pas.';
            $messages['password.min']       = 'Le mot de passe doit contenir au moins 8 caractères.';
        }

        $validated = $request->validate($rules, $messages);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->role  = $validated['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')
                         ->with('success', 'L\'utilisateur a été mis à jour avec succès.');
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy(User $user)
    {
        // Empêcher l'admin de se supprimer lui-même
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                             ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'L\'utilisateur a été supprimé avec succès.');
    }
}
