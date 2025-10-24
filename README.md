<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 📚 Blog Laravel - Projet Pédagogique WebTech Institute

## 📖 Table des matières

- [À propos du projet](#-à-propos-du-projet)
- [Technologies utilisées](#-technologies-utilisées)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Architecture du projet](#-architecture-du-projet)
- [Base de données](#-base-de-données)
- [Modèles et relations](#-modèles-et-relations)
- [Système d'authentification](#-système-dauthentification)
- [Système d'autorisation](#-système-dautorisation)
- [Contrôleurs](#-contrôleurs)
- [Routes](#-routes)
- [Vues et composants](#-vues-et-composants)
- [Système d'abonnement](#-système-dabonnement)
- [Fonctionnalités](#-fonctionnalités)
- [Tests](#-tests)
- [Commandes utiles](#-commandes-utiles)
- [Concepts clés Laravel](#-concepts-clés-laravel)

---

## 🎯 À propos du projet

Ce projet est une **application de blog complète** développée avec Laravel 11. Il a été conçu comme un exercice pédagogique complet pour explorer l'ensemble des fonctionnalités essentielles du framework Laravel.

### Objectifs pédagogiques

Ce projet vous permet d'apprendre et de pratiquer :

1. **Architecture MVC** : Comprendre la séparation des responsabilités
2. **Eloquent ORM** : Maîtriser les relations entre modèles
3. **Authentification & Autorisation** : Sécuriser une application
4. **Middleware & Policies** : Contrôler l'accès aux ressources
5. **Form Requests** : Valider les données utilisateur
6. **Blade Templates** : Créer des interfaces dynamiques
7. **Seeders & Factories** : Peupler la base de données
8. **Relations Many-to-Many** : Gérer des tables pivot complexes

---

## 🛠 Technologies utilisées

### Backend
- **Laravel 11** - Framework PHP moderne
- **PHP 8.2+** - Langage de programmation
- **SQLite** - Base de données (par défaut)
- **Eloquent ORM** - Gestion de la base de données

### Frontend
- **Tailwind CSS 3** - Framework CSS utility-first
- **Alpine.js** - Framework JavaScript léger
- **Blade** - Moteur de templates Laravel
- **Vite 5** - Build tool moderne

### Outils de développement
- **Laravel Breeze** - Scaffolding d'authentification
- **Laravel Pint** - Code style fixer
- **PHPUnit** - Tests unitaires et fonctionnels
- **Faker** - Génération de données de test

---

## 📋 Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP** 8.2 ou supérieur
- **Composer** (gestionnaire de dépendances PHP)
- **Node.js** 18+ et **NPM** (pour les assets frontend)
- **SQLite** (installé par défaut sur la plupart des systèmes)
- **Git** (pour le versionnement)

### Vérifier les versions

```bash
php --version        # Doit afficher 8.2 ou plus
composer --version   # Composer 2.x
node --version       # Node 18+
npm --version        # NPM 9+
```

---

## 🚀 Installation

### 1. Cloner le projet

```bash
git clone <url-du-repo>
cd blog_final
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances JavaScript

```bash
npm install
```

### 4. Configurer l'environnement

Copier le fichier `.env.example` et le renommer en `.env` :

```bash
cp .env.example .env
```

### 5. Générer la clé d'application

```bash
php artisan key:generate
```

### 6. Créer la base de données

Le projet utilise SQLite par défaut. La base de données `database.sqlite` existe déjà, mais si vous voulez repartir de zéro :

```bash
rm database/database.sqlite
touch database/database.sqlite
```

### 7. Exécuter les migrations

```bash
php artisan migrate
```

### 8. Peupler la base de données

```bash
php artisan db:seed
```

Cette commande va créer :
- 2 rôles (admin, user)
- 2 utilisateurs de test
- 10 articles (5 gratuits, 5 payants)
- 2 types d'abonnements

### 9. Compiler les assets

```bash
npm run build
# ou pour le développement avec hot reload
npm run dev
```

### 10. Lancer le serveur

```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

### 🎉 Comptes de test

Après le seeding, vous disposez de ces comptes :

| Email | Mot de passe | Rôle |
|-------|--------------|------|
| admin@example.com | password | Admin |
| test@example.com | password | User |

---

## 🏗 Architecture du projet

### Structure des dossiers

```
blog_final/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Logique métier
│   │   ├── Middleware/       # Filtres de requêtes
│   │   └── Requests/         # Validation des formulaires
│   ├── Models/               # Modèles Eloquent
│   ├── Policies/             # Règles d'autorisation
│   └── Providers/            # Services providers
├── database/
│   ├── factories/            # Générateurs de données
│   ├── migrations/           # Structure de la BDD
│   └── seeders/              # Données initiales
├── resources/
│   ├── css/                  # Styles CSS
│   ├── js/                   # JavaScript
│   └── views/                # Templates Blade
├── routes/
│   ├── web.php              # Routes web
│   └── auth.php             # Routes d'authentification
└── public/                   # Fichiers publics
```

---

## 🗄 Base de données

### Schéma de la base de données

Le projet utilise **6 tables principales** :

#### 1. **users** - Utilisateurs
```sql
- id (clé primaire)
- name (nom)
- email (unique)
- password (hashé)
- role_id (clé étrangère vers roles)
- email_verified_at
- remember_token
- timestamps (created_at, updated_at)
```

#### 2. **roles** - Rôles utilisateur
```sql
- id (clé primaire)
- name (admin, user) unique
- timestamps
```

#### 3. **posts** - Articles du blog
```sql
- id (clé primaire)
- title (titre)
- content (contenu)
- slug (URL friendly, unique)
- user_id (clé étrangère vers users)
- is_published (booléen)
- published_at (date de publication)
- paid (booléen - article payant ou non)
- timestamps
```

#### 4. **comments** - Commentaires
```sql
- id (clé primaire)
- content (contenu)
- user_id (clé étrangère vers users)
- post_id (clé étrangère vers posts)
- timestamps
```

#### 5. **subscriptions** - Types d'abonnements
```sql
- id (clé primaire)
- name (Free, Premium)
- description
- price (prix)
- timestamps
```

#### 6. **users_subscriptions** - Table pivot
```sql
- id (clé primaire)
- user_id (clé étrangère vers users)
- subscription_id (clé étrangère vers subscriptions)
- active (booléen)
- start_date (date de début)
- end_date (date de fin)
- timestamps
```

### Diagramme de relations

```
┌─────────────┐       ┌──────────────┐       ┌──────────────┐
│    roles    │──1:N──│    users     │──1:N──│    posts     │
└─────────────┘       └──────────────┘       └──────────────┘
                             │                       │
                             │ 1:N                   │ 1:N
                             │                       │
                      ┌──────┴────────┐       ┌──────┴────────┐
                      │               │       │               │
                      ▼               ▼       ▼               ▼
              ┌──────────────┐  ┌──────────────┐     ┌──────────────┐
              │  comments    │  │ users_subs   │     │   comments   │
              └──────────────┘  └──────────────┘     └──────────────┘
                                       │
                                       │ N:M
                                       ▼
                                ┌──────────────┐
                                │subscriptions │
                                └──────────────┘
```

---

## 🎭 Modèles et relations

### Modèle User

**Fichier** : `app/Models/User.php`

```php
// Relations
- belongsTo(Role::class)           // Un user a un rôle
- hasMany(Post::class)             // Un user a plusieurs posts
- hasMany(Comment::class)          // Un user a plusieurs commentaires
- belongsToMany(Subscription::class) // Un user a plusieurs abonnements (N:M)

// Méthodes personnalisées
- hasRole($role): bool             // Vérifie si l'user a un rôle spécifique
```

**Attributs fillable** :
- `name`, `email`, `password`, `role_id`

**Attributs cachés** :
- `password`, `remember_token`

**Casting** :
- `email_verified_at` → datetime
- `password` → hashed (automatiquement crypté)

### Modèle Post

**Fichier** : `app/Models/Post.php`

```php
// Relations
- belongsTo(User::class)           // Un post appartient à un user
- hasMany(Comment::class)          // Un post a plusieurs commentaires
```

**Attributs fillable** :
- `title`, `content`, `user_id`

### Modèle Comment

**Fichier** : `app/Models/Comment.php`

```php
// Relations
- belongsTo(User::class)           // Un commentaire appartient à un user
- belongsTo(Post::class)           // Un commentaire appartient à un post
```

**Attributs fillable** :
- `content`, `user_id`, `post_id`

### Modèle Role

**Fichier** : `app/Models/Role.php`

```php
// Relations
- hasMany(User::class)             // Un rôle a plusieurs users
```

**Attributs fillable** :
- `name`

### Modèle Subscription

**Fichier** : `app/Models/Subscription.php`

```php
// Relations
- belongsToMany(User::class)       // Un abonnement a plusieurs users (N:M)
```

**Attributs fillable** :
- `name`, `description`, `price`

### Modèle UsersSubscriptions

**Fichier** : `app/Models/UsersSubscriptions.php`

C'est le **modèle pivot** pour la relation N:M entre Users et Subscriptions.

**Attributs fillable** :
- `user_id`, `subscription_id`, `start_date`, `end_date`, `active`

---

## 🔐 Système d'authentification

Le projet utilise **Laravel Breeze**, une solution d'authentification légère et moderne.

### Routes d'authentification

**Fichier** : `routes/auth.php`

#### Routes publiques (guest)

| Méthode | Route | Contrôleur | Description |
|---------|-------|------------|-------------|
| GET | `/register` | RegisteredUserController@create | Formulaire d'inscription |
| POST | `/register` | RegisteredUserController@store | Traiter l'inscription |
| GET | `/login` | AuthenticatedSessionController@create | Formulaire de connexion |
| POST | `/login` | AuthenticatedSessionController@store | Traiter la connexion |
| GET | `/forgot-password` | PasswordResetLinkController@create | Mot de passe oublié |
| POST | `/forgot-password` | PasswordResetLinkController@store | Envoyer le lien de réinitialisation |
| GET | `/reset-password/{token}` | NewPasswordController@create | Formulaire de nouveau mot de passe |
| POST | `/reset-password` | NewPasswordController@store | Réinitialiser le mot de passe |

#### Routes authentifiées (auth)

| Méthode | Route | Contrôleur | Description |
|---------|-------|------------|-------------|
| GET | `/verify-email` | EmailVerificationPromptController | Page de vérification email |
| GET | `/verify-email/{id}/{hash}` | VerifyEmailController | Vérifier l'email |
| POST | `/email/verification-notification` | EmailVerificationNotificationController@store | Renvoyer l'email de vérification |
| GET | `/confirm-password` | ConfirmablePasswordController@show | Confirmer le mot de passe |
| POST | `/confirm-password` | ConfirmablePasswordController@store | Traiter la confirmation |
| PUT | `/password` | PasswordController@update | Mettre à jour le mot de passe |
| POST | `/logout` | AuthenticatedSessionController@destroy | Se déconnecter |

---

## 🛡 Système d'autorisation

Le projet implémente deux mécanismes d'autorisation complémentaires :

### 1. Middleware CheckUserRole

**Fichier** : `app/Http/Middleware/CheckUserRole.php`

Ce middleware vérifie si l'utilisateur possède un **rôle spécifique**.

**Fonctionnement** :
```php
// Dans web.php
Route::get('/dashboard', ...)
    ->middleware(['auth', 'verified', CheckUserRole::class . ':admin']);
```

**Logique** :
1. Vérifie si l'utilisateur est connecté
2. Appelle la méthode `hasRole($role)` sur le user
3. Si le rôle correspond → accès autorisé
4. Sinon → redirection vers la page d'accueil avec message d'erreur

**Utilisation** :
- Protection du dashboard (réservé aux admins)
- Protection de la création de posts (réservée aux admins)

### 2. Policy PostPolicy

**Fichier** : `app/Policies/PostPolicy.php`

Les **Policies** définissent des règles d'autorisation granulaires pour un modèle spécifique.

#### Méthodes disponibles

##### `viewAny(User $user): bool`
- Permet de voir la liste des posts
- Retourne toujours `true` (public)

##### `view(?User $user, Post $post): bool`
- Permet de voir un post spécifique
- **Logique complexe** :

```php
Si le post est payant (paid = true):
    Si l'utilisateur n'est pas connecté:
        ❌ Accès refusé
    
    Si l'utilisateur est admin:
        ✅ Accès autorisé
    
    Si l'utilisateur a un abonnement actif:
        ✅ Accès autorisé
    
    Sinon:
        ❌ Accès refusé

Sinon (post gratuit):
    ✅ Accès autorisé pour tous
```

##### `create(User $user): bool`
- Permet de créer un post
- Réservé aux admins uniquement

##### `update(User $user, Post $post): bool`
##### `delete(User $user, Post $post): bool`
##### `restore(User $user, Post $post): bool`
##### `forceDelete(User $user, Post $post): bool`
- Toutes réservées aux admins

**Utilisation dans le contrôleur** :
```php
// Dans PostController@show
$authorized = Gate::allows('view', $post);
if (!$authorized) {
    return redirect()->route('posts.index');
}
```

---

## 🎮 Contrôleurs

### PostController

**Fichier** : `app/Http/Controllers/PostController.php`

Gère toutes les opérations CRUD sur les posts.

#### Méthodes

##### `index()`
```php
// Liste tous les posts
$posts = Post::all();
return view('posts.index', compact('posts'));
```

##### `create()`
```php
// Affiche le formulaire de création
// Protégé par middleware CheckUserRole:admin
return view('posts.create');
```

##### `store(StorePostRequest $request)`
```php
// Crée un nouveau post
// Validation automatique via StorePostRequest
// Ajoute automatiquement l'user_id de l'utilisateur connecté
$request->merge(['user_id' => auth()->user()->id]);
$post = Post::create($request->all());
return redirect()->route('posts.index');
```

**StorePostRequest** (`app/Http/Requests/StorePostRequest.php`) :
- Vérifie l'autorisation via Policy : `Gate::allows('create', Post::class)`
- Règles de validation :
  - `title` : requis, string, max 255 caractères
  - `content` : requis, string

##### `show(Post $post)`
```php
// Affiche un post spécifique
// Vérifie l'autorisation via PostPolicy@view
$authorized = Gate::allows('view', $post);
if (!$authorized) {
    return redirect()->route('posts.index');
}
return view('posts.show', compact('post'));
```

**Note** : Laravel utilise le **Route Model Binding** pour injecter automatiquement le modèle Post.

##### `edit(Post $post)`, `update(...)`, `destroy(Post $post)`
Ces méthodes sont définies mais pas encore implémentées (exercice à compléter).

### CommentController

**Fichier** : `app/Http/Controllers/CommentController.php`

Gère les commentaires sur les posts.

#### Méthodes

##### `store(Request $request, Post $post)`
```php
// Crée un nouveau commentaire
// Validation manuelle
$request->validate([
    'content' => 'required|string|max:1000',
    'post_id' => 'required|exists:posts,id',
]);

Comment::create([
    'content' => $request->input('content'),
    'post_id' => $request->input('post_id'),
    'user_id' => auth()->id(),
]);

return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
```

**Points clés** :
- Validation en ligne (pas de FormRequest)
- Ajoute automatiquement l'`user_id` de l'utilisateur connecté
- Redirection vers la page précédente avec message flash

##### `getCommentsByPostId($postId)`
```php
// Récupère tous les commentaires d'un post
$comments = Comment::where('post_id', $postId)->get();
return view('comments.index', compact('comments'));
```

##### `index()`
```php
// Liste tous les commentaires (tous posts confondus)
$comments = Comment::all();
return view('comments.index', compact('comments'));
```

### SubscriptionsController

**Fichier** : `app/Http/Controllers/SubscriptionsController.php`

Gère le système d'abonnements.

#### Méthodes

##### `index()`
```php
// Affiche tous les abonnements disponibles
$subscriptions = Subscription::all();
$user = auth()->user();

if ($user) {
    // Récupère les abonnements actifs de l'utilisateur
    $userSubscriptions = $user->subscriptions()
        ->wherePivot('active', true)
        ->get();
    
    return view('subscriptions.index', 
        compact('subscriptions', 'userSubscriptions'));
}

// Si non connecté
$userSubscriptions = collect([]);
return view('subscriptions.index', 
    compact('subscriptions', 'userSubscriptions'));
```

**Points clés** :
- `wherePivot('active', true)` : Filtre sur une colonne de la table pivot
- `collect([])` : Crée une collection vide pour éviter les erreurs dans la vue

##### `subscribe(Subscription $subscription)`

Méthode complexe gérant la souscription à un abonnement.

```php
// 1. Vérifie si l'utilisateur est connecté
if (!auth()->check()) {
    return redirect()->route('login');
}

$user = auth()->user();

// 2. Vérifie si l'utilisateur a déjà cet abonnement actif
$existingSubscriptionActiveWithThisID = $user->subscriptions()
    ->where('subscription_id', $subscription->id)
    ->where('active', true)
    ->first();

if ($existingSubscriptionActiveWithThisID) {
    return redirect()->route('subscriptions.index')
        ->with('error', 'Vous avez déjà cet abonnement actif');
}

// 3. Désactive l'abonnement actif actuel s'il existe
$activeSubscription = $user->subscriptions()
    ->wherePivot('active', true)
    ->first();

if ($activeSubscription) {
    $user->subscriptions()->updateExistingPivot($activeSubscription->id, [
        'active' => false,
        'end_date' => now()
    ]);
}

// 4. Crée le nouvel abonnement
$user->subscriptions()->attach($subscription, [
    'active' => true,
    'start_date' => now(),
    'end_date' => now()->addDays($subscription->duration)
]);

return redirect()->route('subscriptions.index')
    ->with('success', 'Vous avez souscrit à l\'abonnement ' . $subscription->name);
```

**Méthodes Eloquent utilisées** :
- `attach()` : Ajoute une relation dans la table pivot
- `updateExistingPivot()` : Met à jour les données pivot d'une relation existante
- `wherePivot()` : Filtre sur les colonnes de la table pivot

### ProfileController

**Fichier** : `app/Http/Controllers/ProfileController.php`

Fourni par Laravel Breeze, gère le profil utilisateur (edit, update, destroy).

---

## 🛣 Routes

### Routes web principales

**Fichier** : `routes/web.php`

#### Routes publiques

```php
// Page d'accueil - Liste tous les posts
GET / → view('welcome')

// Liste des posts
GET /posts → PostController@index

// Détail d'un post
GET /posts/{post} → PostController@show

// Liste des abonnements (accessible sans connexion)
GET /subscriptions → SubscriptionsController@index
```

#### Routes authentifiées

```php
// Profil utilisateur
GET    /profile → ProfileController@edit
PATCH  /profile → ProfileController@update
DELETE /profile → ProfileController@destroy

// Souscrire à un abonnement
POST /subscriptions/{subscription}/subscribe 
    → SubscriptionsController@subscribe

// Ajouter un commentaire
POST /comments → CommentController@store
```

#### Routes admin (auth + CheckUserRole:admin)

```php
// Dashboard admin
GET /dashboard → view('dashboard')
    →middleware(['auth', 'verified', CheckUserRole::class.':admin'])

// Créer un post
GET  /posts/create → PostController@create
POST /posts → PostController@store
```

### Groupes de routes

Laravel permet de grouper les routes avec des middlewares communs :

```php
// Groupe avec middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit']);
    // ...
});

// Groupe avec middleware guest (non connecté)
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create']);
    // ...
});
```

---

## 🎨 Vues et composants

### Architecture Blade

Le projet utilise le moteur de templates **Blade** de Laravel avec une architecture en layouts.

### Layouts principaux

#### `resources/views/layouts/app.blade.php`
Layout principal de l'application pour les pages authentifiées.

**Structure** :
```html
<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <!-- Styles Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    @include('layouts.navigation')
    
    <!-- En-tête de page (optionnel) -->
    @if (isset($header))
        <header>{{ $header }}</header>
    @endif
    
    <!-- Contenu principal -->
    <main>
        {{ $slot }}
    </main>
</body>
</html>
```

#### `resources/views/layouts/guest.blade.php`
Layout pour les pages publiques (login, register).

#### `resources/views/layouts/navigation.blade.php`
Barre de navigation responsive avec menu desktop et mobile (hamburger).

### Pages principales

#### Posts

**`resources/views/posts/index.blade.php`**
- Liste tous les posts
- Affiche titre, extrait, auteur, date
- Liens vers la page de détail

**`resources/views/posts/show.blade.php`**
- Affiche un post complet
- Système de commentaires
- Vérifie les autorisations (payant/gratuit)

**`resources/views/posts/create.blade.php`**
- Formulaire de création de post
- Réservé aux admins
- Validation côté client et serveur

#### Abonnements

**`resources/views/subscriptions/index.blade.php`**
- Liste tous les abonnements disponibles
- Affiche le prix, la description
- Bouton "S'abonner" (si connecté)
- Badge "Actif" si l'utilisateur est déjà abonné

#### Authentification

Les vues d'authentification sont générées par Laravel Breeze :
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/forgot-password.blade.php`
- etc.

### Composants Blade

Laravel permet de créer des composants réutilisables.

**Exemple** : `resources/views/components/input-label.blade.php`

```blade
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
```

**Utilisation** :
```blade
<x-input-label for="email" :value="__('Email')" />
```

**Composants disponibles** :
- `<x-text-input>` : Champ de texte
- `<x-input-label>` : Label de formulaire
- `<x-input-error>` : Message d'erreur
- `<x-primary-button>` : Bouton principal
- `<x-secondary-button>` : Bouton secondaire
- `<x-danger-button>` : Bouton danger

---

## 💳 Système d'abonnement

### Concept

Le projet implémente un **système d'abonnement payant** pour accéder au contenu premium.

### Types d'abonnements

1. **Free** (0€) : Accès aux articles gratuits uniquement
2. **Premium** (3€) : Accès à tous les articles (gratuits + payants)

### Fonctionnement

#### 1. Table pivot `users_subscriptions`

Cette table stocke les relations entre users et subscriptions avec des **données supplémentaires** :

| Colonne | Description |
|---------|-------------|
| `user_id` | ID de l'utilisateur |
| `subscription_id` | ID de l'abonnement |
| `active` | Booléen : abonnement actif ou non |
| `start_date` | Date de début |
| `end_date` | Date de fin |

#### 2. Relation Many-to-Many avec pivot

Dans le modèle User :
```php
public function subscriptions()
{
    return $this->belongsToMany(Subscription::class, 'users_subscriptions')
        ->withPivot('active', 'start_date', 'end_date');
}
```

**`withPivot()`** permet d'accéder aux colonnes supplémentaires de la table pivot.

#### 3. Vérification de l'abonnement actif

Dans la Policy PostPolicy :
```php
$user->subscriptions()->wherePivot('active', true)->exists()
```

Cette requête vérifie si l'utilisateur a **au moins un abonnement actif**.

#### 4. Souscription à un abonnement

Processus dans `SubscriptionsController@subscribe` :

1. Vérifie si l'utilisateur est connecté
2. Vérifie s'il n'a pas déjà cet abonnement actif
3. **Désactive** l'ancien abonnement actif (un seul abonnement actif à la fois)
4. **Crée** le nouvel abonnement avec les dates
5. Redirige avec un message de succès

### Règles d'accès aux posts

| Type d'utilisateur | Post gratuit | Post payant |
|--------------------|--------------|-------------|
| Non connecté | ✅ Accès | ❌ Refusé |
| User sans abonnement | ✅ Accès | ❌ Refusé |
| User avec abonnement actif | ✅ Accès | ✅ Accès |
| Admin | ✅ Accès | ✅ Accès (toujours) |

---

## ✨ Fonctionnalités

### Pour tous les utilisateurs (visiteurs)

- ✅ Voir la liste des posts
- ✅ Lire les posts gratuits
- ✅ Voir les abonnements disponibles
- ✅ S'inscrire / Se connecter

### Pour les utilisateurs connectés (user)

- ✅ Toutes les fonctionnalités visiteur
- ✅ Souscrire à un abonnement
- ✅ Lire les posts payants (si abonnement actif)
- ✅ Ajouter des commentaires sur les posts
- ✅ Gérer son profil

### Pour les administrateurs (admin)

- ✅ Toutes les fonctionnalités user
- ✅ Accéder au dashboard admin
- ✅ Créer des posts (gratuits ou payants)
- ✅ Modifier/Supprimer des posts (à implémenter)
- ✅ Accès illimité à tous les posts

---

## 🧪 Tests

Le projet inclut une suite de tests avec **PHPUnit**.

### Structure des tests

```
tests/
├── Feature/           # Tests fonctionnels (tests d'intégration)
│   ├── Auth/          # Tests d'authentification
│   ├── ExampleTest.php
│   └── ProfileTest.php
├── Unit/              # Tests unitaires
│   └── ExampleTest.php
└── TestCase.php       # Classe de base pour les tests
```

### Exécuter les tests

```bash
# Tous les tests
php artisan test

# Tests spécifiques
php artisan test --filter=ExampleTest

# Avec coverage
php artisan test --coverage
```

### Créer un test

```bash
# Test fonctionnel
php artisan make:test PostTest

# Test unitaire
php artisan make:test PostTest --unit
```

---

## 📝 Commandes utiles

### Artisan (CLI Laravel)

```bash
# Créer un contrôleur
php artisan make:controller NomController

# Créer un modèle (avec migration, factory, seeder)
php artisan make:model Nom -mfs

# Créer une migration
php artisan make:migration create_table_name

# Créer un seeder
php artisan make:seeder NomSeeder

# Créer un middleware
php artisan make:middleware NomMiddleware

# Créer une policy
php artisan make:policy NomPolicy --model=Nom

# Créer une request
php artisan make:request StoreNomRequest

# Créer un composant Blade
php artisan make:component NomComponent
```

### Base de données

```bash
# Exécuter les migrations
php artisan migrate

# Annuler la dernière migration
php artisan migrate:rollback

# Réinitialiser et relancer les migrations
php artisan migrate:fresh

# Réinitialiser et seeder
php artisan migrate:fresh --seed

# Exécuter un seeder spécifique
php artisan db:seed --class=NomSeeder

# Vider la base de données
php artisan db:wipe
```

### Cache

```bash
# Vider tous les caches
php artisan optimize:clear

# Vider le cache de l'application
php artisan cache:clear

# Vider le cache de configuration
php artisan config:clear

# Vider le cache des routes
php artisan route:clear

# Vider le cache des vues
php artisan view:clear
```

### Développement

```bash
# Lister toutes les routes
php artisan route:list

# Mode maintenance
php artisan down
php artisan up

# Générer l'IDE helper (autocomplétion)
composer require --dev barryvdh/laravel-ide-helper
php artisan ide-helper:generate

# Formater le code (Laravel Pint)
./vendor/bin/pint

# Lancer les tests
php artisan test
```

### Composer

```bash
# Installer les dépendances
composer install

# Mettre à jour les dépendances
composer update

# Ajouter une dépendance
composer require vendor/package

# Ajouter une dépendance de dev
composer require --dev vendor/package

# Autoload (régénérer l'autoloader)
composer dump-autoload
```

### NPM

```bash
# Installer les dépendances
npm install

# Compiler les assets (production)
npm run build

# Compiler les assets (développement avec watch)
npm run dev

# Mettre à jour les dépendances
npm update
```

---

## 🎓 Concepts clés Laravel

### 1. MVC (Model-View-Controller)

**Laravel suit le pattern MVC** :

- **Model** (`app/Models/`) : Représente les données et la logique métier
- **View** (`resources/views/`) : Interface utilisateur (templates Blade)
- **Controller** (`app/Http/Controllers/`) : Logique de l'application, fait le lien entre Model et View

**Flux d'une requête** :
```
Requête HTTP → Route → Controller → Model → Database
                  ↓                      ↑
                View ← Controller ← Model
```

### 2. Eloquent ORM

**Eloquent** est l'ORM (Object-Relational Mapping) de Laravel.

**Principes** :
- Un modèle = Une table
- Une instance de modèle = Une ligne dans la table
- Les relations SQL deviennent des méthodes PHP

**Exemples** :
```php
// Récupérer tous les posts
$posts = Post::all();

// Récupérer un post par ID
$post = Post::find(1);

// Créer un post
Post::create(['title' => 'Mon titre', 'content' => 'Mon contenu']);

// Mettre à jour un post
$post->update(['title' => 'Nouveau titre']);

// Supprimer un post
$post->delete();

// Relations
$post->user;           // Récupère l'auteur du post
$user->posts;          // Récupère tous les posts d'un user
$user->posts()->get(); // Idem mais avec méthode query builder
```

### 3. Relations Eloquent

#### One to Many (1:N)

**Exemple** : Un User a plusieurs Posts

```php
// Dans User.php
public function posts()
{
    return $this->hasMany(Post::class);
}

// Dans Post.php
public function user()
{
    return $this->belongsTo(User::class);
}

// Utilisation
$user->posts;           // Collection de posts
$post->user;            // Instance de User
```

#### Many to Many (N:M)

**Exemple** : Un User a plusieurs Subscriptions, une Subscription a plusieurs Users

```php
// Dans User.php
public function subscriptions()
{
    return $this->belongsToMany(Subscription::class, 'users_subscriptions')
        ->withPivot('active', 'start_date', 'end_date');
}

// Dans Subscription.php
public function users()
{
    return $this->belongsToMany(User::class, 'users_subscriptions');
}

// Utilisation
$user->subscriptions;                    // Collection de subscriptions
$user->subscriptions()->attach($subId);  // Ajouter une relation
$user->subscriptions()->detach($subId);  // Supprimer une relation
$user->subscriptions()->sync([$subId]);  // Synchroniser

// Accéder aux données pivot
foreach ($user->subscriptions as $subscription) {
    $subscription->pivot->active;
    $subscription->pivot->start_date;
}
```

### 4. Migrations

Les **migrations** sont des "versions" de la structure de la base de données.

**Avantages** :
- Versioning de la BDD
- Travail en équipe facilité
- Rollback possible

**Structure** :
```php
public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();                           // BIGINT UNSIGNED AUTO_INCREMENT
        $table->string('title');                // VARCHAR(255)
        $table->text('content');                // TEXT
        $table->foreignId('user_id')            // BIGINT UNSIGNED
              ->constrained('users');           // FOREIGN KEY
        $table->boolean('paid')->default(false);// TINYINT(1)
        $table->timestamps();                   // created_at, updated_at
    });
}

public function down(): void
{
    Schema::dropIfExists('posts');
}
```

### 5. Seeders et Factories

#### Factories

Les **factories** génèrent des données de test.

```php
// PostFactory.php
public function definition(): array
{
    return [
        'title' => fake()->sentence(),          // Phrase aléatoire
        'content' => fake()->paragraph(),        // Paragraphe aléatoire
        'user_id' => 1,
        'slug' => fake()->slug(),               // slug-aleatoire
        'is_published' => true,
        'published_at' => now(),
        'paid' => false,
    ];
}

// Utilisation
Post::factory()->count(10)->create();           // 10 posts
Post::factory()->create(['paid' => true]);      // 1 post payant
```

#### Seeders

Les **seeders** peuplent la base de données avec des données initiales.

```php
// DatabaseSeeder.php
public function run(): void
{
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'user']);
    
    User::factory()->create([
        'email' => 'admin@example.com',
        'role_id' => 1,
    ]);
    
    $this->call([
        PostSeeder::class,
        SubscriptionSeeder::class,
    ]);
}
```

### 6. Middleware

Les **middleware** sont des filtres qui s'exécutent avant ou après une requête.

**Exemples de middleware Laravel** :
- `auth` : Vérifie que l'utilisateur est connecté
- `guest` : Vérifie que l'utilisateur n'est PAS connecté
- `verified` : Vérifie que l'email est vérifié
- `throttle:60,1` : Rate limiting (60 requêtes par minute)

**Middleware personnalisé** : `CheckUserRole`
```php
public function handle(Request $request, Closure $next, string $role): Response
{
    if (auth()->user()->hasRole($role)) {
        return $next($request);
    }
    return redirect('/')->with('error', 'Accès refusé.');
}
```

**Application** :
```php
Route::get('/dashboard', ...)
    ->middleware(['auth', CheckUserRole::class . ':admin']);
```

### 7. Policies

Les **Policies** définissent des règles d'autorisation pour un modèle.

**Différence Middleware vs Policy** :

| Middleware | Policy |
|------------|--------|
| Filtre basé sur l'utilisateur/route | Autorisation basée sur un modèle spécifique |
| "Est-ce que tu es admin ?" | "Est-ce que tu peux voir **ce** post ?" |
| Contrôle global | Contrôle granulaire |

**Utilisation** :
```php
// Dans le contrôleur
if (Gate::allows('view', $post)) {
    // Autorisé
}

// Avec Blade
@can('view', $post)
    <a href="{{ route('posts.show', $post) }}">Voir</a>
@endcan

// Avec middleware
Route::get('/posts/{post}/edit', ...)
    ->middleware('can:update,post');
```

### 8. Form Requests

Les **Form Requests** encapsulent la logique de validation et d'autorisation.

**Avantages** :
- Code plus propre dans les contrôleurs
- Validation centralisée
- Autorisation intégrée

**Exemple** : `StorePostRequest`
```php
public function authorize(): bool
{
    return Gate::allows('create', Post::class);
}

public function rules(): array
{
    return [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];
}
```

**Utilisation** :
```php
public function store(StorePostRequest $request)
{
    // Si on arrive ici, c'est que :
    // 1. L'utilisateur est autorisé (authorize() = true)
    // 2. Les données sont valides (rules())
    
    $post = Post::create($request->all());
}
```

### 9. Blade Templates

**Blade** est le moteur de templates de Laravel.

**Directives principales** :

```blade
{{-- Afficher une variable (échappée) --}}
{{ $variable }}

{{-- Afficher du HTML brut (NON échappé, attention XSS !) --}}
{!! $html !!}

{{-- Structures de contrôle --}}
@if ($condition)
    <!-- ... -->
@elseif ($autre)
    <!-- ... -->
@else
    <!-- ... -->
@endif

@foreach ($items as $item)
    {{ $item }}
@endforeach

@for ($i = 0; $i < 10; $i++)
    {{ $i }}
@endfor

@while ($condition)
    <!-- ... -->
@endwhile

{{-- Authentification --}}
@auth
    <!-- Utilisateur connecté -->
@endauth

@guest
    <!-- Utilisateur non connecté -->
@endguest

{{-- Autorisation --}}
@can('view', $post)
    <!-- Autorisé -->
@endcan

@cannot('edit', $post)
    <!-- Non autorisé -->
@endcannot

{{-- Layouts --}}
@extends('layouts.app')

@section('content')
    <!-- Contenu -->
@endsection

{{-- Inclure une vue --}}
@include('partials.header')

{{-- Composants --}}
<x-button type="submit">Envoyer</x-button>

{{-- CSRF Token (obligatoire dans les formulaires POST/PUT/DELETE) --}}
@csrf

{{-- Method Spoofing (pour PUT/PATCH/DELETE) --}}
@method('PUT')
```

### 10. Validation

Laravel offre un **système de validation puissant**.

**Règles communes** :

| Règle | Description | Exemple |
|-------|-------------|---------|
| `required` | Champ obligatoire | `'title' => 'required'` |
| `string` | Doit être une chaîne | `'name' => 'string'` |
| `email` | Email valide | `'email' => 'email'` |
| `max:n` | Maximum n caractères | `'title' => 'max:255'` |
| `min:n` | Minimum n caractères | `'password' => 'min:8'` |
| `unique:table,column` | Unique dans la table | `'email' => 'unique:users,email'` |
| `exists:table,column` | Existe dans la table | `'user_id' => 'exists:users,id'` |
| `confirmed` | Champ de confirmation | `'password' => 'confirmed'` |
| `numeric` | Valeur numérique | `'age' => 'numeric'` |
| `integer` | Entier | `'quantity' => 'integer'` |
| `boolean` | Booléen | `'active' => 'boolean'` |
| `date` | Date valide | `'birth_date' => 'date'` |
| `in:val1,val2` | Valeur dans la liste | `'role' => 'in:admin,user'` |

**Utilisation** :
```php
$request->validate([
    'title' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|string|min:8|confirmed',
]);
```

**Messages d'erreur personnalisés** :
```php
$request->validate([
    'title' => 'required|max:255',
], [
    'title.required' => 'Le titre est obligatoire.',
    'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
]);
```

### 11. Route Model Binding

Laravel peut **injecter automatiquement** des modèles dans les contrôleurs.

**Exemple** :
```php
// Route
Route::get('/posts/{post}', [PostController::class, 'show']);

// Contrôleur (AVANT)
public function show($id)
{
    $post = Post::findOrFail($id);
    return view('posts.show', compact('post'));
}

// Contrôleur (APRÈS - avec Route Model Binding)
public function show(Post $post)
{
    // Laravel a automatiquement récupéré le post !
    return view('posts.show', compact('post'));
}
```

**Personnalisation** :
```php
// Par défaut : recherche par ID
// Rechercher par slug :
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
```

### 12. Messages Flash

Les **messages flash** sont stockés dans la session pour un seul affichage.

**Créer un message** :
```php
return redirect()->route('posts.index')
    ->with('success', 'Post créé avec succès !');
```

**Afficher dans la vue** :
```blade
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
```

---

## 🎯 Exercices pratiques suggérés

Pour approfondir votre compréhension, voici des exercices à réaliser :

### Niveau débutant

1. **Ajouter un champ "bio" au profil utilisateur**
   - Ajouter une migration
   - Mettre à jour le formulaire de profil
   - Afficher la bio sur le profil

2. **Compter le nombre de commentaires par post**
   - Afficher le compteur dans la liste des posts
   - Utiliser `$post->comments()->count()`

3. **Ajouter une page "À propos"**
   - Créer la route
   - Créer la vue
   - Ajouter le lien dans le menu

### Niveau intermédiaire

4. **Implémenter l'édition de posts**
   - Terminer `PostController@edit` et `@update`
   - Créer la vue `posts/edit.blade.php`
   - Créer `UpdatePostRequest` pour la validation
   - Vérifier les autorisations (Policy)

5. **Système de likes sur les posts**
   - Créer la migration `likes` (user_id, post_id)
   - Créer le modèle `Like`
   - Ajouter la relation dans `User` et `Post`
   - Créer le contrôleur `LikeController`
   - Ajouter les routes
   - Mettre à jour les vues

6. **Pagination des posts**
   - Remplacer `Post::all()` par `Post::paginate(10)`
   - Ajouter les liens de pagination dans la vue

### Niveau avancé

7. **Recherche de posts**
   - Créer un formulaire de recherche
   - Implémenter la recherche sur titre et contenu
   - Utiliser les query scopes

8. **Catégories de posts**
   - Créer la table `categories`
   - Ajouter la relation Many-to-Many (posts-categories)
   - Permettre de filtrer les posts par catégorie

9. **API REST pour les posts**
   - Créer `ApiPostController`
   - Définir les routes API dans `routes/api.php`
   - Retourner du JSON
   - Implémenter l'authentification API (Sanctum)

10. **Notifications par email**
    - Créer une notification `NewCommentNotification`
    - Envoyer un email à l'auteur quand quelqu'un commente son post
    - Utiliser les queues pour l'envoi asynchrone

---

## 📚 Ressources supplémentaires

### Documentation officielle

- [Laravel Documentation](https://laravel.com/docs/11.x)
- [Eloquent ORM](https://laravel.com/docs/11.x/eloquent)
- [Blade Templates](https://laravel.com/docs/11.x/blade)
- [Validation](https://laravel.com/docs/11.x/validation)
- [Authorization](https://laravel.com/docs/11.x/authorization)

### Tutoriels

- [Laracasts](https://laracasts.com/) - Vidéos de formation Laravel
- [Laravel Daily](https://laraveldaily.com/) - Tutoriels et tips quotidiens
- [Laravel News](https://laravel-news.com/) - Actualités Laravel

### Outils

- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar) - Barre de debug
- [Laravel Telescope](https://laravel.com/docs/11.x/telescope) - Monitoring de l'application
- [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper) - Autocomplétion IDE

---

## 🐛 Résolution de problèmes

### Erreur : "Vite manifest not found"

**Solution** :
```bash
npm run build
# ou pour le dev avec hot reload
npm run dev
```

### Erreur : "Class 'App\...' not found"

**Solution** :
```bash
composer dump-autoload
```

### Erreur : "SQLSTATE[HY000]"

**Solution** :
1. Vérifier que le fichier `database/database.sqlite` existe
2. Relancer les migrations : `php artisan migrate:fresh`

### Erreur 403 : "This action is unauthorized"

**Solution** :
1. Vérifier les Policies dans `app/Policies/`
2. Vérifier que le middleware `CheckUserRole` est correctement appliqué
3. Vérifier que l'utilisateur a le bon rôle

### Erreur 419 : "Page expired"

**Cause** : Token CSRF manquant ou expiré

**Solution** :
1. Ajouter `@csrf` dans tous les formulaires POST/PUT/DELETE
2. Vider le cache : `php artisan cache:clear`

### Erreur : "Base table or view not found"

**Solution** :
```bash
php artisan migrate:fresh --seed
```

---

## 🤝 Contribution

Ce projet est un exercice pédagogique. N'hésitez pas à :

- Poser des questions sur les concepts que vous ne comprenez pas
- Proposer des améliorations
- Signaler des bugs
- Partager vos solutions aux exercices

---

## 📄 Licence

Ce projet est open source et disponible sous la licence MIT.

---

## ✍️ Auteur

**WebTech Institute** - Projet pédagogique Laravel

---

## 🎓 Conclusion

Ce projet vous a permis de découvrir les concepts fondamentaux de Laravel :

✅ **Architecture MVC** propre et organisée  
✅ **Eloquent ORM** et relations complexes  
✅ **Authentification** complète avec Laravel Breeze  
✅ **Autorisation** via Middleware et Policies  
✅ **Validation** des données avec Form Requests  
✅ **Relations Many-to-Many** avec table pivot  
✅ **Blade** pour des vues dynamiques et réutilisables  

Continuez à pratiquer et à explorer les fonctionnalités avancées de Laravel !

**Happy coding! 🚀**
