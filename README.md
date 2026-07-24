# 🖥️ Gestionnaire d'Inventaire Matériel IT

> Application web CRUD pour la gestion de parc informatique — Développée avec **Laravel 13** et **MDBootstrap 7**

---

## 📋 Description du Projet

Ce projet est une application web de gestion d'inventaire de matériel informatique. Elle permet de suivre l'ensemble des équipements d'un parc IT (ordinateurs, serveurs, switches/routeurs) via une interface moderne et professionnelle.

L'application implémente les 4 opérations **CRUD** (Create, Read, Update, Delete) sur la ressource `Equipement`.

---

## 🛠️ Technologies Utilisées

| Technologie | Version | Rôle |
|---|---|---|
| **Laravel** | 13.20.0 | Framework PHP (Backend MVC) |
| **PHP** | 8.4.23 | Langage serveur |
| **SQLite** | — | Base de données (fichier `database/database.sqlite`) |
| **MDBootstrap** | 7.1.0 | Framework CSS (Material Design for Bootstrap) |
| **Font Awesome** | 6.0.0 | Icônes vectorielles |
| **Google Fonts (Inter)** | — | Typographie moderne |
| **Blade** | — | Moteur de templates Laravel |

---

## 📁 Structure du Projet

```
GestionnaireInventaire_Materiel/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── EquipementController.php    ← Contrôleur CRUD
│   └── Models/
│       └── Equipement.php                  ← Modèle Eloquent
│
├── database/
│   ├── migrations/
│   │   └── 2026_07_20_..._create_equipements_table.php  ← Migration
│   └── database.sqlite                    ← Base de données SQLite
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php              ← Layout principal (sidebar + topbar)
│       └── equipements/
│           ├── index.blade.php            ← Page d'inventaire (tableau + stats)
│           ├── create.blade.php           ← Formulaire d'ajout
│           └── edit.blade.php             ← Formulaire de modification
│
├── routes/
│   └── web.php                            ← Route::resource('equipements', ...)
│
└── .env                                   ← Configuration (DB_CONNECTION=sqlite)
```

---

## 🗃️ Base de Données

### Table `equipements`

| Colonne | Type | Description |
|---|---|---|
| `id` | `bigint` (auto-increment) | Identifiant unique |
| `nom` | `string` | Nom de l'équipement (ex : `PC-Compta-01`) |
| `type` | `string` | Type d'équipement : `PC`, `Serveur` ou `Switch` |
| `adresse_ip` | `string` (unique) | Adresse IPv4 de l'équipement |
| `date_acquisition` | `date` | Date d'acquisition du matériel |
| `statut` | `string` | Statut opérationnel : `Actif` ou `En maintenance` |
| `created_at` | `timestamp` | Date de création de l'enregistrement |
| `updated_at` | `timestamp` | Date de dernière modification |

### Migration

```php
Schema::create('equipements', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('type');
    $table->string('adresse_ip');
    $table->date('date_acquisition');
    $table->string('statut');
    $table->timestamps();
});
```

---

## 🔁 Routes (CRUD)

L'application utilise `Route::resource()` qui génère automatiquement les 7 routes RESTful :

```php
Route::resource('equipements', EquipementController::class);
```

| Méthode HTTP | URI | Action | Nom de la route | Description |
|---|---|---|---|---|
| `GET` | `/equipements` | `index()` | `equipements.index` | Afficher la liste |
| `GET` | `/equipements/create` | `create()` | `equipements.create` | Formulaire d'ajout |
| `POST` | `/equipements` | `store()` | `equipements.store` | Enregistrer un nouveau |
| `GET` | `/equipements/{id}` | `show()` | `equipements.show` | Afficher un seul |
| `GET` | `/equipements/{id}/edit` | `edit()` | `equipements.edit` | Formulaire de modification |
| `PUT/PATCH` | `/equipements/{id}` | `update()` | `equipements.update` | Mettre à jour |
| `DELETE` | `/equipements/{id}` | `destroy()` | `equipements.destroy` | Supprimer |

---

## 🏗️ Le Contrôleur : `EquipementController`

Le contrôleur gère les 7 méthodes CRUD. Il utilise le **Route Model Binding** de Laravel : les méthodes `edit()`, `update()` et `destroy()` reçoivent directement un objet `Equipement` au lieu d'un simple `$id`.

### `index()` — Afficher tous les équipements

```php
public function index()
{
    $equipements = Equipement::all();
    $totalCount = $equipements->count();
    $actifCount = $equipements->where('statut', 'Actif')->count();
    $maintenanceCount = $equipements->where('statut', 'En maintenance')->count();
    return view('equipements.index', compact('equipements', 'totalCount', 'actifCount', 'maintenanceCount'));
}
```

- Récupère **tous** les équipements via `Equipement::all()`
- Calcule les **statistiques** (total, actifs, en maintenance) pour les cartes du dashboard
- Passe les données à la vue `equipements.index`

### `create()` — Afficher le formulaire d'ajout

```php
public function create()
{
    return view('equipements.create');
}
```

- Retourne simplement la vue du formulaire vide

### `store()` — Enregistrer un nouvel équipement

```php
public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom'              => 'required|string|max:255',
        'type'             => 'required|string|max:50',
        'adresse_ip'       => 'required|ip|unique:equipements,adresse_ip',
        'date_acquisition' => 'required|date',
        'statut'           => 'required|string|in:Actif,En maintenance',
    ]);

    Equipement::create($validatedData);
    return redirect()->route('equipements.index')
                     ->with('success', 'L\'équipement a été ajouté avec succès.');
}
```

- **Validation** de tous les champs :
  - `nom` : obligatoire, chaîne, max 255 caractères
  - `type` : obligatoire, chaîne, max 50 caractères
  - `adresse_ip` : obligatoire, format IP valide, **unique** dans la table
  - `date_acquisition` : obligatoire, format date valide
  - `statut` : obligatoire, doit être exactement `Actif` ou `En maintenance`
- **Création** via le mass-assignment (`Equipement::create()`)
- **Redirection** vers l'index avec un message flash de succès

### `edit()` — Afficher le formulaire de modification

```php
public function edit(Equipement $equipement)
{
    return view('equipements.edit', compact('equipement'));
}
```

- Reçoit l'objet `$equipement` automatiquement grâce au **Route Model Binding**
- Passe l'objet à la vue pour pré-remplir le formulaire

### `update()` — Mettre à jour un équipement

```php
public function update(Request $request, Equipement $equipement)
{
    $validatedData = $request->validate([
        'nom'              => 'required|string|max:255',
        'type'             => 'required|string|max:50',
        'adresse_ip'       => 'required|ip|unique:equipements,adresse_ip,' . $equipement->id,
        'date_acquisition' => 'required|date',
        'statut'           => 'required|string|in:Actif,En maintenance',
    ]);

    $equipement->update($validatedData);
    return redirect()->route('equipements.index')
                     ->with('success', 'Les informations de l\'équipement ont été mises à jour.');
}
```

- Mêmes règles de validation que `store()`, **sauf** pour `adresse_ip` : on exclut l'ID actuel de la vérification d'unicité (`unique:equipements,adresse_ip,' . $equipement->id`) pour permettre à l'utilisateur de garder la même IP
- Met à jour l'enregistrement via `$equipement->update()`

### `destroy()` — Supprimer un équipement

```php
public function destroy(Equipement $equipement)
{
    $equipement->delete();
    return redirect()->route('equipements.index')
                     ->with('success', 'L\'équipement a été retiré de l\'inventaire avec succès.');
}
```

- Supprime l'enregistrement via `$equipement->delete()`
- Redirection avec message flash de confirmation

---

## 📦 Le Modèle : `Equipement`

```php
class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'adresse_ip',
        'date_acquisition',
        'statut',
    ];
}
```

- Utilise le trait `HasFactory` pour les factories (tests/seeders)
- **`$fillable`** : liste les colonnes autorisées pour le mass-assignment (`create()` et `update()`). Cela protège contre les injections de champs non désirés

---

## 🎨 Interface Utilisateur (Vues Blade)

### Architecture des vues

L'application utilise l'**héritage de templates Blade** :
- `layouts/app.blade.php` → Layout principal (sidebar, topbar, styles)
- Les pages enfants (`index`, `create`, `edit`) héritent du layout via `@extends('layouts.app')` et injectent leur contenu dans `@yield('content')`

### `layouts/app.blade.php` — Layout Principal

Le layout implémente un design de **panneau d'administration professionnel** :

- **Sidebar gauche** (260px) :
  - Logo avec dégradé bleu/violet
  - Navigation avec icônes Font Awesome
  - Indicateur de lien actif (barre bleue latérale)
  - Badge compteur sur "Inventaire"
  - Lien "Centre d'aide" en bas
  - Responsive : se cache sur mobile, accessible via bouton hamburger

- **Barre supérieure** (sticky) :
  - Champ de recherche avec icône
  - Boutons notification (cloche) et aide (?)
  - Pill utilisateur avec avatar

- **Zone de contenu** :
  - Alertes flash pour les messages de succès/erreur
  - Bloc `@yield('content')` pour le contenu des pages

- **Système de design** (CSS variables) :
  - Palette de couleurs cohérente (`--primary`, `--green`, `--amber`, `--red`)
  - Système d'ombres à 4 niveaux (`--shadow-sm` à `--shadow-xl`)
  - Animations d'entrée en cascade (`fadeInUp`)
  - Responsive avec overlay de sidebar pour mobile

### `equipements/index.blade.php` — Page d'Inventaire

- **4 cartes statistiques** :
  - Total des équipements (icône bleue)
  - Nombre d'actifs (icône verte)
  - Nombre en maintenance (icône orange)
  - Taux opérationnel en % (icône violette, calculé dynamiquement)

- **Tableau de données** :
  - Avatar coloré par type (bleu=PC, violet=Serveur, cyan=Switch)
  - Badge ID formaté (`EQ-001`)
  - Adresse IP en police monospace
  - Date d'acquisition formatée (`20 Jul 2026`)
  - Pill de statut avec indicateur lumineux
  - Boutons d'action (icônes crayon/poubelle avec hover coloré)

- **État vide** : Icône + message + bouton d'ajout si aucun équipement

- **Modale de suppression** : Confirmation centrée avec icône danger

### `equipements/create.blade.php` — Formulaire d'Ajout

- Lien retour vers l'inventaire
- Carte blanche avec header et icône "+"
- Champs organisés en grille 2 colonnes :
  - Nom (pleine largeur)
  - Type / Statut (2 colonnes)
  - Adresse IP / Date d'acquisition (2 colonnes)
- Validation en temps réel (messages d'erreur rouges sous chaque champ)
- Boutons Annuler / Enregistrer

### `equipements/edit.blade.php` — Formulaire de Modification

- Identique au formulaire de création, mais :
  - Header avec avatar du type d'équipement, nom, badge ID et pill de statut
  - Champs pré-remplis avec `old('champ', $equipement->champ)`
  - Champ caché `@method('PUT')` pour simuler la méthode HTTP PUT
  - Bouton "Mettre à jour" au lieu de "Enregistrer"

---

## ⚙️ Configuration

### Fichier `.env` (variables importantes)

```env
DB_CONNECTION=sqlite          # Utilise SQLite (pas besoin de MySQL)
SESSION_DRIVER=file           # Sessions stockées en fichier
CACHE_STORE=database          # Cache en base de données
```

### Pourquoi SQLite ?

- **Aucune installation** requise (pas de MySQL/PostgreSQL)
- Le fichier `database/database.sqlite` est créé automatiquement
- Parfait pour le développement et les projets de cours

---

## 🚀 Installation et Lancement

### Prérequis

- PHP ≥ 8.2
- Composer

### Étapes

```bash
# 1. Cloner le projet
git clone <url-du-repo>
cd GestionnaireInventaire_Materiel

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env

# 4. Configurer la base de données (dans .env)
# Remplacer DB_CONNECTION=mysql par :
# DB_CONNECTION=sqlite
# Et commenter DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 5. Configurer le driver de session (dans .env)
# Remplacer SESSION_DRIVER=database par :
# SESSION_DRIVER=file

# 6. Générer la clé d'application
php artisan key:generate

# 7. Lancer les migrations
php artisan migrate

# 8. Démarrer le serveur de développement
php artisan serve
```

L'application est accessible sur : **http://127.0.0.1:8000/equipements**

---

## 🔐 Validation des Données

Chaque champ est validé côté serveur avant insertion/modification :

| Champ | Règles | Explication |
|---|---|---|
| `nom` | `required\|string\|max:255` | Obligatoire, texte, max 255 caractères |
| `type` | `required\|string\|max:50` | Obligatoire, texte, max 50 caractères |
| `adresse_ip` | `required\|ip\|unique:equipements` | Obligatoire, format IP valide, unique en BDD |
| `date_acquisition` | `required\|date` | Obligatoire, format date valide |
| `statut` | `required\|in:Actif,En maintenance` | Obligatoire, valeur exacte parmi les 2 choix |

En cas d'erreur, l'utilisateur est redirigé vers le formulaire avec :
- Les **messages d'erreur** affichés sous chaque champ (`@error('nom')`)
- Les **anciennes valeurs** conservées grâce à `old('nom')` pour éviter de tout re-saisir

---

## 📝 Concepts Laravel Utilisés

| Concept | Utilisation dans le projet |
|---|---|
| **Route Model Binding** | `edit(Equipement $equipement)` — Laravel résout automatiquement l'ID en objet |
| **Mass Assignment** | `Equipement::create($validatedData)` — Insertion en une seule ligne |
| **`$fillable`** | Protection contre l'injection de champs non autorisés |
| **Validation** | `$request->validate([...])` — Validation déclarative côté serveur |
| **Flash Messages** | `->with('success', '...')` — Message affiché une seule fois après redirection |
| **Blade Inheritance** | `@extends`, `@section`, `@yield` — Héritage de templates |
| **Blade Directives** | `@foreach`, `@forelse`, `@if`, `@error`, `@csrf`, `@method` |
| **Resource Routes** | `Route::resource()` — Génère les 7 routes CRUD automatiquement |
| **Eloquent ORM** | `all()`, `create()`, `update()`, `delete()` — Manipulation de la BDD |
| **Migrations** | Création de la table `equipements` via schéma PHP |

---

## 📄 Licence

Projet réalisé dans le cadre d'un cours Laravel.
