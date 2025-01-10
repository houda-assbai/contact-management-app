@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Titre indiquant l'utilisateur pour lequel le contact est ajouté -->
    <h1 class="text-center mb-4">Ajouter un contact pour l'utilisateur <span class="text-primary">{{ $user->name }}</span></h1>

    <!-- Formulaire pour ajouter un contact avec une mise en forme -->
    <form action="{{ route('admin.contacts.store') }}" method="POST" enctype="multipart/form-data" class="p-4 shadow-lg rounded bg-light">
        @csrf  <!-- Protection contre les attaques CSRF -->
        <input type="hidden" name="user_id" value="{{ $user->id }}"> <!-- ID de l'utilisateur à qui appartient ce contact -->

        <!-- Champ pour le prénom -->
        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span> <!-- Icône à côté du champ -->
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Entrez le prénom" required>  <!-- Champ texte pour le prénom -->
            </div>
        </div>

        <!-- Champ pour le nom -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span> <!-- Icône à côté du champ -->
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Entrez le nom" required> <!-- Champ texte pour le nom -->
            </div>
        </div>

        <!-- Champ pour l'email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span> <!-- Icône email à côté du champ -->
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'email" required> <!-- Champ email -->
            </div>
        </div>

        <!-- Champ pour le téléphone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span> <!-- Icône téléphone à côté du champ -->
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Entrez le numéro de téléphone" required> <!-- Champ téléphone -->
            </div>
        </div>

        <!-- Champ pour l'adresse -->
        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Entrez l'adresse"></textarea> <!-- Champ pour l'adresse, avec un textarea pour plus d'espace -->
        </div>

        <!-- Champ pour les notes -->
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Ajoutez des notes"></textarea> <!-- Champ pour les notes, avec un textarea pour plus d'espace -->
        </div>

        <!-- Bouton d'envoi du formulaire -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-person-plus"></i> Ajouter le contact  <!-- Icône et texte pour le bouton -->
            </button>
        </div>
    </form>
</div>
@endsection
