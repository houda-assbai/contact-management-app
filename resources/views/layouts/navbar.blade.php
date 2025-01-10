<!-- Début de la barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <!-- Conteneur fluide de la barre de navigation (pour un affichage responsive) -->
    <div class="container-fluid">
        
        <!-- Logo / Branding -->
        <a class="navbar-brand fs-4 fw-bold text-light" href="{{ url('/') }}">
            <!-- Icône de carnet d'adresses avec le texte "Gestion des Contacts" -->
            <i class="fas fa-address-book me-2"></i> Gestion des Contacts
        </a>

        <!-- Bouton pour basculer le menu sur les petits écrans -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <!-- Icône du bouton de bascule -->
        </button>

        <!-- Liste des liens de navigation (ils seront réduits sur petits écrans) -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Liste des éléments du menu, alignée à droite (ms-auto) -->
            <ul class="navbar-nav ms-auto">

                <!-- Condition : Si l'utilisateur est authentifié -->
                @auth
                    <!-- Si l'utilisateur est connecté -->

                    <!-- Lien vers "Mes Contacts" -->
                    <li class="nav-item">
                        <a class="nav-link text-light hover:text-warning transition-all duration-200" href="{{ route('contacts.index') }}">
                            <!-- Icône d'utilisateurs -->
                            <i class="fas fa-users me-2"></i> Mes Contacts
                        </a>
                    </li>

                    <!-- Lien vers "Mon Profil" -->
                    <li class="nav-item">
                        <a class="nav-link text-light hover:text-warning transition-all duration-200" href="{{ route('profile.edit') }}">
                            <!-- Icône de profil -->
                            <i class="fas fa-user-circle me-2"></i> Mon Profil
                        </a>
                    </li>

                    <!-- Lien pour se déconnecter -->
                    <li class="nav-item">
                        <a class="nav-link text-danger hover:text-warning transition-all duration-200" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <!-- Icône de déconnexion -->
                            <i class="fas fa-sign-out-alt me-2"></i> Se Déconnecter
                        </a>

                        <!-- Formulaire caché pour gérer la déconnexion -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf <!-- Token CSRF pour la sécurité des requêtes POST -->
                        </form>
                    </li>

                <!-- Sinon, si l'utilisateur n'est pas authentifié -->
                @else
                    <!-- Si l'utilisateur n'est pas connecté -->

                    <!-- Lien vers "Se Connecter" -->
                    <li class="nav-item">
                        <a class="nav-link text-light hover:text-warning transition-all duration-200" href="{{ route('login') }}">
                            <!-- Icône de connexion -->
                            <i class="fas fa-sign-in-alt me-2"></i> Se Connecter
                        </a>
                    </li>

                    <!-- Lien vers "S'inscrire" -->
                    <li class="nav-item">
                        <a class="nav-link text-light hover:text-warning transition-all duration-200" href="{{ route('register') }}">
                            <!-- Icône d'inscription -->
                            <i class="fas fa-user-plus me-2"></i> S'Inscrire
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
<!-- Fin de la barre de navigation -->
