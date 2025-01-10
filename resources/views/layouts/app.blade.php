<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition du jeu de caractères de la page en UTF-8 -->
    <meta charset="UTF-8">
    
    <!-- Définition de la largeur de la page pour une meilleure compatibilité avec les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>Gestion des Contacts</title>

    <!-- Lien vers le CSS de Bootstrap version 4.5.2 pour la mise en forme -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Ajoutez ces scripts à la fin de votre fichier body -->
    <!-- Inclus la bibliothèque jQuery (indispensable pour certains composants Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclus le bundle Bootstrap avec les fonctionnalités JavaScript nécessaires (comme le menu déroulant, modales, etc.) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

<!-- Lien vers le CSS de Bootstrap version 5.3.0-alpha1 pour plus de fonctionnalités modernes -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Directive Blade pour ajouter des styles CSS personnalisés ou supplémentaires à la page -->
@stack('styles')

</head>
<body>

    <!-- Vérifie si l'utilisateur est authentifié -->
    @auth
        <!-- Si l'utilisateur est authentifié et est un administrateur -->
        @if(auth()->user()->is_admin)
            <!-- Inclut la navbar spécifique pour les administrateurs -->
            @include('layouts.admin-navbar')  <!-- Navbar pour l'admin -->
        @else
            <!-- Si l'utilisateur est connecté mais n'est pas un administrateur, inclut la navbar classique -->
            @include('layouts.navbar')  <!-- Navbar pour l'utilisateur -->
        @endif
    @endauth

    <!-- Conteneur principal pour le contenu spécifique à chaque page -->
    <div class="container mt-4">
        <!-- Affiche le contenu de chaque vue spécifique -->
        @yield('content')
    </div>

    <!-- Inclus le fichier JavaScript de Bootstrap pour les fonctionnalités interactives -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Directive Blade pour ajouter des scripts JavaScript personnalisés ou supplémentaires -->
    @stack('scripts')
</body>
</html>
