@extends('layouts.app')  <!-- Étend la mise en page principale de l'application -->

@section('content')  <!-- Section où le contenu spécifique à cette page sera inséré -->

    <div class="container">  <!-- Conteneur pour contenir tout le contenu de la page -->
        <h1>Mes Contacts</h1>  <!-- Titre de la page -->

        {{-- Affichage du message de succès --}}
        @if (session('success'))
            <!-- Si une session de succès est présente, affichez le message -->
            <div class="alert alert-success">
                {{ session('success') }}  <!-- Affiche le message de succès -->
            </div>
        @endif

        {{-- Lien vers la page de création de contact --}}
        <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">Ajouter un contact</a>
        <!-- Lien pour ajouter un nouveau contact, redirige vers la route 'contacts.create' -->

        {{-- Liste des contacts --}}
        <table class="table">
            <!-- Table des contacts avec leurs informations -->
            <thead>
                <tr>
                    <th>Prénom</th>  <!-- Colonne pour le prénom du contact -->
                    <th>Nom</th>  <!-- Colonne pour le nom du contact -->
                    <th>Email</th>  <!-- Colonne pour l'email du contact -->
                    <th>Actions</th>  <!-- Colonne pour les actions (modifier et supprimer) -->
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <!-- Pour chaque contact, afficher une ligne dans le tableau -->
                    <tr>
                        <td>{{ $contact->first_name }}</td>
                        <!-- Affiche le prénom du contact -->
                        <td>{{ $contact->last_name }}</td>
                        <!-- Affiche le nom du contact -->
                        <td>{{ $contact->email }}</td>
                        <!-- Affiche l'email du contact -->
                        <td>
                            {{-- Lien vers la page d'édition d'un contact --}}
                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <!-- Lien pour modifier le contact, redirige vers la route 'contacts.edit' avec l'objet contact -->

                            {{-- Formulaire pour supprimer un contact --}}
                            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display:inline;">
                                <!-- Le formulaire pour supprimer le contact, envoyé en POST mais avec la méthode DELETE -->

                                @csrf  <!-- Protection CSRF pour la requête POST -->
                                @method('DELETE')  <!-- Spécifie que la méthode HTTP pour ce formulaire est DELETE -->

                                <!-- Bouton pour soumettre le formulaire et supprimer le contact -->
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection  <!-- Fin de la section de contenu spécifique à cette page -->
