@extends('layouts.app')  <!-- Étend la mise en page principale de l'application -->

@section('content')  <!-- Section où le contenu spécifique à cette page sera inséré -->

    <div class="container">  <!-- Conteneur pour contenir tout le contenu de la page -->
        <h1>Détails du contact</h1>  <!-- Titre de la page -->

        <!-- Affichage des détails du contact -->
        <p><strong>Prénom:</strong> {{ $contact->first_name }}</p>
        <!-- Affiche le prénom du contact -->
        <p><strong>Nom:</strong> {{ $contact->last_name }}</p>
        <!-- Affiche le nom du contact -->
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <!-- Affiche l'email du contact -->
        <p><strong>Téléphone:</strong> {{ $contact->phone }}</p>
        <!-- Affiche le téléphone du contact -->
        <p><strong>Adresse:</strong> {{ $contact->address }}</p>
        <!-- Affiche l'adresse du contact -->
        <p><strong>Notes:</strong> {{ $contact->notes }}</p>
        <!-- Affiche les notes associées au contact -->

        <!-- Lien pour modifier le contact -->
        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Modifier</a>
        <!-- Bouton pour modifier le contact, redirige vers la route 'contacts.edit' avec l'ID du contact -->

        <!-- Formulaire pour supprimer le contact -->
        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
            <!-- Le formulaire envoie une requête POST, mais utilise une méthode DELETE avec @method('DELETE') -->

            @csrf  <!-- Protection CSRF pour la requête POST -->
            @method('DELETE')  <!-- Spécifie que la méthode HTTP pour ce formulaire est DELETE -->

            <!-- Bouton pour soumettre le formulaire et supprimer le contact -->
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>

@endsection  <!-- Fin de la section de contenu spécifique à cette page -->
