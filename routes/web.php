<?php

use App\Http\Controllers\ProfileController; // Importation du contrôleur pour la gestion des profils
use App\Http\Controllers\ContactController; // Importation du contrôleur pour la gestion des contacts
use Illuminate\Support\Facades\Route; // Utilisation de la façade Route pour définir les routes
use App\Http\Controllers\AdminController; // Importation du contrôleur pour la gestion des fonctionnalités administratives

// Page d'accueil : route accessible à tout le monde
Route::get('/', function () {
    return view('welcome'); // Retourne la vue d'accueil
});

// Tableau de bord : cette route est uniquement accessible pour les utilisateurs authentifiés et vérifiés
Route::get('/dashboard', function () {
    return view('dashboard'); // Retourne la vue du tableau de bord
})->middleware(['auth', 'verified']) // Les middlewares 'auth' et 'verified' assurent que l'utilisateur est authentifié et a un email vérifié
->name('dashboard'); // Nomme cette route "dashboard"

// Routes pour la gestion des profils : elles sont protégées par le middleware 'auth' pour vérifier que l'utilisateur est authentifié
Route::middleware('auth')->group(function () {
    // Route pour afficher et modifier le profil de l'utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Route pour mettre à jour le profil de l'utilisateur
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Route pour supprimer le profil de l'utilisateur
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour gérer les contacts de l'utilisateur
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index'); // Affiche la liste des contacts
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create'); // Affiche le formulaire de création d'un contact
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store'); // Enregistre un nouveau contact
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit'); // Affiche le formulaire pour éditer un contact
    Route::patch('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update'); // Met à jour un contact
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy'); // Supprime un contact
});

// Routes administratives : accessibles uniquement pour les utilisateurs authentifiés et ayant des privilèges d'administrateur
Route::middleware(['auth', 'admin'])->group(function () {
    // Route pour afficher le tableau de bord de l'administrateur, réutilise la vue "dashboard"
    Route::get('/admin/dashboard', function () {
        return view('dashboard');  // Utilise la vue "dashboard" pour l'admin
    })->name('admin.dashboard'); // Nomme cette route "admin.dashboard"
});

// Routes pour la gestion des contacts par l'administrateur : uniquement accessibles pour les administrateurs
Route::middleware(['auth', 'admin'])->group(function () {
    // Affiche la liste de tous les contacts des utilisateurs
    Route::get('/admin/contacts', [AdminController::class, 'index'])->name('admin.contacts.index');

    // Affiche le formulaire de création d'un contact pour un utilisateur spécifique
    Route::get('/admin/contacts/create/{userId}', [AdminController::class, 'create'])->name('admin.contacts.create');

    // Enregistre un nouveau contact dans la base de données
    Route::post('/admin/contacts', [AdminController::class, 'store'])->name('admin.contacts.store');

    // Affiche les détails d'un contact spécifique
    Route::get('/admin/contacts/{contact}', [AdminController::class, 'show'])->name('admin.contacts.show');

    // Affiche le formulaire d'édition d'un contact spécifique
    Route::get('/admin/contacts/{contact}/edit', [AdminController::class, 'edit'])->name('admin.contacts.edit');

    // Met à jour un contact spécifique dans la base de données
    Route::patch('/admin/contacts/{contact}', [AdminController::class, 'update'])->name('admin.contacts.update');

    // Supprime un contact spécifique
    Route::delete('/admin/contacts/{contact}', [AdminController::class, 'destroy'])->name('admin.contacts.destroy');
});

// Charger les routes d'authentification générées par Breeze : ceci est une inclusion automatique des routes liées à l'authentification.
require __DIR__.'/auth.php';
