@extends('layouts.app')  <!-- Cette directive permet d'utiliser la mise en page de base définie dans 'layouts.app' -->

@section('content')  <!-- Début de la section 'content' où sera placé le contenu spécifique à cette page -->

    <div class="container">  <!-- Conteneur principal pour la mise en page du contenu -->
        <h1>Détails de l'utilisateur : {{ $user->name }}</h1>  <!-- Titre avec le nom de l'utilisateur récupéré -->

        <!-- Si il y a un message de succès dans la session, l'afficher -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire de recherche de contacts -->
        <form action="{{ route('admin.contacts.show', $user->id) }}" method="GET" class="mb-4">
            <div class="input-group">
                <!-- Champ de recherche pour les contacts -->
                <input type="text" name="search" class="form-control" 
                       placeholder="Rechercher un contact par nom, prénom ou téléphone" 
                       value="{{ request()->query('search') }}">

                <!-- Bouton pour soumettre le formulaire de recherche -->
                <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
            </div>
        </form>

        <!-- Affichage des informations de l'utilisateur -->
        <div class="card mb-4">
            <div class="card-header">
                Informations de l'utilisateur
            </div>
            <div class="card-body">
                <!-- Détails de l'email et de la date d'inscription de l'utilisateur -->
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Date d'inscription:</strong> {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <!-- Affichage de la liste des contacts de l'utilisateur -->
        <h3>Contacts de {{ $user->name }} :</h3>
        
        <!-- Si l'utilisateur n'a aucun contact -->
        @if($contacts->isEmpty())
            <p>Aucun contact trouvé pour cet utilisateur.</p>
        @else
            <!-- Liste des contacts affichée sous forme de liste -->
            <ul class="list-group">
                @foreach ($contacts as $contact)
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <!-- Informations basiques sur chaque contact -->
                            <strong>Id:</strong> {{ $contact->id }} <br>
                            <strong>{{ $contact->first_name }} {{ $contact->last_name }}</strong> <br>
                            <strong>Téléphone:</strong> {{ $contact->phone }} <br>

                            <!-- Bouton pour ouvrir la modale avec plus de détails sur le contact -->
                            <button class="btn btn-info btn-sm mt-2" data-toggle="modal" 
                                    data-target="#contactModal{{ $contact->id }}">Voir</button>
                        </div>
                        
                        <div>
                            <!-- Boutons pour éditer ou supprimer le contact -->
                            <a href="{{ route('admin.contacts.edit', $contact->id) }}" 
                               class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </div>
                    </li>

                    <!-- Modale pour afficher plus de détails sur le contact -->
                    <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" role="dialog" 
                         aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contactModalLabel{{ $contact->id }}">
                                        Détails de {{ $contact->first_name }} {{ $contact->last_name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Affichage des détails supplémentaires du contact -->
                                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                                    <p><strong>Téléphone:</strong> {{ $contact->phone }}</p>
                                    <p><strong>Adresse:</strong> {{ $contact->address ?? 'Non renseignée' }}</p>
                                    <p><strong>Notes:</strong> {{ $contact->notes ?? 'Aucune note' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <!-- Bouton pour fermer la modale -->
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </ul>
        @endif

        <!-- Lien pour ajouter un nouveau contact pour cet utilisateur -->
        <a href="{{ route('admin.contacts.create', $user->id) }}" class="btn btn-success mt-4">Ajouter un contact</a>
    </div>

@endsection  <!-- Fin de la section 'content' -->
