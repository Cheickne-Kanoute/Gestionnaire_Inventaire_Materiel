# 🖥️ IT Assets Manager — Gestionnaire d'Inventaire Matériel (Thème 04)

> **Examen Pratique : Développement d'Applications CRUD avec Laravel**  
> **Établissement :** TechnoLAB-ISTA | **Niveau :** Licence 3 Génie Logiciel (2025-2026)  
> **Thème 04 :** Gestionnaire d'Inventaire Matériel (IT Assets)

---

## 🌐 Liens Officiels du Rendu

- **🚀 Application en Production (Render) :** [https://gestionnaire-inventaire-materiel.onrender.com](https://gestionnaire-inventaire-materiel.onrender.com)
- **💻 Code Source (GitHub) :** [https://github.com/Cheickne-Kanoute/Gestionnaire_Inventaire_Materiel](https://github.com/Cheickne-Kanoute/Gestionnaire_Inventaire_Materiel)

---

## 📋 Description du Projet

L'application **IT Assets Manager** est une solution web professionnelle permettant d'assurer le suivi et la gestion du parc informatique physique d'une entreprise (ordinateurs, serveurs, switches réseau). 

Elle implémente rigoureusement le pattern **MVC natif de Laravel** et couvre le cycle complet des 4 opérations **CRUD** (Create, Read, Update, Delete) ainsi qu'un tableau de bord décisionnel.

### Champs requis par le Thème 04 :
- **Nom de l'équipement** (ex: `PC-Compta-01`, `SRV-DATABASE-01`)
- **Type de matériel** (`PC`, `Serveur`, `Switch`)
- **Adresse IP** (valide et unique)
- **Date d'acquisition**
- **Statut opérationnel** (`Actif`, `En maintenance`)
- **Prix / Valeur** (en FCFA)

---

## 🛠️ Technologies & Stack Technique

| Composant | Technologie | Description |
|---|---|---|
| **Framework Backend** | **Laravel 13** | Architecture MVC, ORM Eloquent, Routage RESTful |
| **Langage** | **PHP 8.4** | Typage strict et meilleures pratiques |
| **Base de Données** | **SQLite** | SGBD léger avec migrations et seeders Eloquent |
| **UI & Styling** | **MDBootstrap 7** | Material Design for Bootstrap & CSS natif |
| **Iconographie & Fonts**| **Font Awesome 6 & Inter** | Design visuel haut de gamme |
| **Conteneurisation** | **Docker & Apache** | Déploiement automatisé sur Render.com |

---

## 📁 Structure du Projet

```
Gestionnaire_Inventaire_Materiel/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── EquipementController.php    ← Contrôleur MVC (Resource)
│   │   └── Requests/
│   │       ├── StoreEquipementRequest.php  ← Validation création
│   │       └── UpdateEquipementRequest.php ← Validation mise à jour
│   ├── Models/
│   │   └── Equipement.php                  ← Modèle Eloquent ($fillable)
│   └── Providers/
│       └── AppServiceProvider.php          ← Injection de données globales & HTTPS
│
├── database/
├── database/
│   ├── migrations/
│   │   └── 2026_07_20_..._create_equipements_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── EquipementSeeder.php            ← Données initiales FCFA
│
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php                   ← Sidebar & layout principal MDBootstrap
│   ├── partials/
│   │   ├── delete-modal.blade.php          ← Modale MDB de confirmation
│   │   ├── equipment-avatar.blade.php      ← Avatars dynamiques par type
│   │   └── status-pill.blade.php           ← Badges d'état lumineux
│   └── equipements/
│       ├── dashboard.blade.php            ← Tableau de bord analytique
│       ├── index.blade.php                ← Vue liste & filtres rapides
│       ├── show.blade.php                 ← Vue de détail d'un équipement
│       ├── create.blade.php               ← Formulaire de création
│       └── edit.blade.php                 ← Formulaire d'édition
│
├── Dockerfile                              ← Déploiement conteneurisé Render (PHP 8.4)
├── docker-start.sh                         ← Démarrage, migrations & seeders auto
└── routes/web.php                          ← Route::resource('equipements', ...)
```

---

## 🔒 Sécurité & Validations (Form Requests)

Le projet utilise des classes de requêtes formulaires dédiées (`FormRequest`) pour isoler les règles de validation et garantir la sécurité des données transmises :

- **`StoreEquipementRequest`** & **`UpdateEquipementRequest`** :
  - `nom`: obligatoire, chaîne, min 2 caractères, max 255
  - `type`: obligatoire, doit être strictement `PC`, `Serveur` ou `Switch`
  - `adresse_ip`: obligatoire, format IPv4 valide, **unique** dans la base de données (l'IP courante est ignorée lors de la modification)
  - `date_acquisition`: obligatoire, date valide, ne peut pas être dans le futur
  - `statut`: obligatoire, doit être `Actif` ou `En maintenance`
  - `prix`: optionnel, numérique, supérieur ou égal à 0
  - Protection CSRF obligatoire sur tous les formulaires via la directive native `@csrf`
  - Remontée d'erreurs ciblée en français sous chaque champ via `@error`

---

## 🎨 Interface & Ergonomie (Material Design)

- **Tableau de Bord** : Vue synthétique des KPIs (Nombre d'équipements, Taux d'activité, Valeur totale du parc en FCFA, Graphique de répartition).
- **Modales de confirmation** : Confirmation de suppression sécurisée via les modales MDBootstrap.
- **Formulaires interactifs** : Pré-remplissage des champs (`old()`), gestion des erreurs dynamiques.
- **Réactivité Mobile/Desktop** : Interface entièrement adaptée aux mobiles et tablettes avec sidebar escamotable.

---

## 🚀 Installation & Déploiement Local

### Prérequis :
- PHP ≥ 8.3 / 8.4
- Composer

### Procédure :
```bash
# 1. Cloner le dépôt
git clone https://github.com/Cheickne-Kanoute/Gestionnaire_Inventaire_Materiel.git
cd Gestionnaire_Inventaire_Materiel

# 2. Installer les dépendances
composer install

# 3. Copier l'environnement
cp .env.example .env

# 4. Générer la clé d'application
php artisan key:generate

# 5. Exécuter les migrations et le seeder de test
php artisan migrate --seed

# 6. Démarrer le serveur local
php artisan serve
```
L'application sera accessible sur `http://127.0.0.1:8000`.

---

## 📄 Évaluation & Conformité

Ce projet satisfait à 100% l'ensemble des règles de la grille d'évaluation du sujet d'examen :
- [x] ORM Eloquent exclusif pour les requêtes BDD.
- [x] Directives native `@csrf` sur toutes les formulaires POST/PUT/DELETE.
- [x] Form Requests de validation dédiées avec affichage `@error`.
- [x] Intégration MDBootstrap & Modales de confirmation.
- [x] Hébergement public en production sur Render (`APP_DEBUG=false`).
- [x] Code source disponible sur GitHub.

---
© 2026 **TechnoLAB-ISTA** — Licence 3 Génie Logiciel.
