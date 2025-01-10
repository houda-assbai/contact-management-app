<?php 

use App\Http\Middleware\AdminMiddleware; // Importation du middleware AdminMiddleware, utilisé pour vérifier si un utilisateur est administrateur
use Illuminate\Foundation\Application; // Importation de la classe Application de Laravel, utilisée pour configurer et créer l'application
use Illuminate\Foundation\Configuration\Exceptions; // Importation des exceptions liées à la configuration de l'application
use Illuminate\Foundation\Configuration\Middleware; // Importation de la classe Middleware de Laravel pour la gestion des middlewares

// Configuration de l'application
return Application::configure(basePath: dirname(__DIR__)) // On configure l'application en définissant son répertoire de base
    ->withRouting( // Configuration des routes de l'application
        web: __DIR__.'/../routes/web.php', // Définition du fichier contenant les routes web (HTTP)
        commands: __DIR__.'/../routes/console.php', // Définition du fichier contenant les routes pour les commandes Artisan
        health: '/up', // Définition de l'URL pour vérifier la santé de l'application (utilisé pour les vérifications d'état)
    )
    ->withMiddleware(function (Middleware $middleware) { // Ajout de middlewares à l'application
        $middleware->alias([ // Définition des alias pour les middlewares
            'admin' => AdminMiddleware::class, // Alias 'admin' pour le middleware AdminMiddleware
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) { // Gestion des exceptions liées à la configuration de l'application
        // Ici vous pouvez gérer les exceptions ou configurer des comportements personnalisés en cas d'erreur
    })
    ->create(); // Création de l'application avec la configuration définie
