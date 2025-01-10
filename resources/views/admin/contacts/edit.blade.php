@extends('layouts.app')  <!-- Utilisation du layout principal pour cette page -->

@section('content')  <!-- Début de la section 'content' qui sera remplie avec le contenu spécifique à cette page -->

    <div class="container">
        <h1>Modifier le contact de {{ $contact->first_name }} {{ $contact->last_name }}</h1>  <!-- Titre dynamique avec le prénom et le nom du contact -->

        <!-- Formulaire pour mettre à jour le contact -->
        <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
            @csrf  <!-- Protection contre les attaques CSRF -->
            @method('PATCH')  <!-- Spécifie que cette requête HTTP est de type PATCH (modification) -->

            <!-- Champ pour le prénom -->
            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $contact->first_name }}" required>  <!-- Valeur initiale du champ remplie avec le prénom actuel du contact -->
            </div>

            <!-- Champ pour le nom -->
            <div class="mb-3">
                <label for="last_name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $contact->last_name }}" required>  <!-- Valeur initiale remplie avec le nom actuel du contact -->
            </div>

            <!-- Champ pour l'email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $contact->email }}" required>  <!-- Valeur initiale remplie avec l'email actuel du contact -->
            </div>

            <!-- Champ pour le téléphone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $contact->phone }}" required>  <!-- Valeur initiale remplie avec le téléphone actuel du contact -->
            </div>

            <!-- Champ pour l'adresse -->
            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $contact->address }}" required>  <!-- Valeur initiale remplie avec l'adresse actuelle du contact -->
            </div>

            <!-- Champ pour les notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="4" required>{{ $contact->notes }}</textarea>  <!-- Utilisation de <textarea> au lieu de <input> pour les notes, avec une valeur initiale -->
            </div>

            <!-- Bouton de soumission du formulaire -->
            <button type="submit" class="btn btn-warning">Mettre à jour le contact</button>
        </form>
    </div>

@endsection  <!-- Fin de la section 'content' -->
