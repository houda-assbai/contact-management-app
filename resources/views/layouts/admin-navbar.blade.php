<!-- Début de la barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
    <!-- Conteneur de la barre de navigation (fluidité sur différents écrans) -->
    <div class="container-fluid">
        
        <!-- Logo ou marque de l'application (redirection vers le tableau de bord) -->
        <a class="navbar-brand fs-4 fw-bold" href="{{ route('admin.dashboard') }}">
            Admin Dashboard <!-- Nom affiché du tableau de bord -->
        </a>

        <!-- Bouton pour afficher/masquer le menu sur les écrans plus petits -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <!-- Icône du bouton de menu mobile -->
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenu de la navigation qui peut être réduit sur les petits écrans -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Liste des éléments du menu, alignée à droite (ms-auto) -->
            <ul class="navbar-nav ms-auto">

                <!-- Section pour la gestion des contacts -->
                <li class="nav-item">
                    <!-- Lien vers la gestion des contacts avec une logique pour ajouter la classe "active" si la page actuelle est la gestion des contacts -->
                    <a class="nav-link 
                        @if(Route::currentRouteName() == 'admin.contacts.index') 
                            active fw-bold text-warning @else text-white @endif
                        transition-all duration-300" 
                        href="{{ route('admin.contacts.index') }}">
                        Gestion des contacts
                    </a>
                </li>

                <!-- Section pour l'accès au profil de l'utilisateur -->
                <li class="nav-item">
                    <!-- Lien vers la page de profil, avec une logique similaire pour ajouter la classe "active" lorsque le profil est en cours d'édition -->
                    <a class="nav-link 
                        @if(Route::currentRouteName() == 'profile.edit') 
                            active fw-bold text-warning @else text-white @endif
                        transition-all duration-300" 
                        href="{{ route('profile.edit') }}">
                        Profil
                    </a>
                </li>

                <!-- Section pour la déconnexion -->
                <li class="nav-item">
                    <!-- Lien pour se déconnecter, il soumet un formulaire de déconnexion (voir la section "formulaire de déconnexion" ci-dessous) -->
                    <a class="nav-link text-danger transition-all duration-300 hover:text-danger-dark" href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Déconnexion
                    </a>

                    <!-- Formulaire caché pour gérer la déconnexion -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf <!-- Token CSRF pour la sécurité -->
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- Fin de la barre de navigation -->
