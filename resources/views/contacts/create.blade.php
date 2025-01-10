@extends('layouts.app')  <!-- Cette directive permet d'hériter de la mise en page principale définie dans 'layouts.app' -->

@section('content')  <!-- La section 'content' définit la partie spécifique au contenu de la page -->

    <div class="container">  <!-- Conteneur pour centrer et espacer correctement le contenu sur la page -->
        <h1>Ajouter un Contact</h1>  <!-- Titre de la page qui indique que l'on est sur un formulaire d'ajout de contact -->

        {{-- Formulaire pour ajouter un contact --}}
        <form action="{{ route('contacts.store') }}" method="POST"> 
            <!-- Le formulaire envoie une requête HTTP POST à la route 'contacts.store' pour enregistrer un nouveau contact -->

            @csrf  <!-- Cette directive insère un jeton CSRF pour protéger le formulaire contre les attaques CSRF -->

            <!-- Champ pour le prénom -->
            <div class="form-group">
                <label for="first_name">Prénom</label>
                <!-- Champ de saisie pour le prénom du contact -->
                <input type="text" name="first_name" id="first_name" class="form-control" 
                       placeholder="Entrez le prénom..." value="{{ old('first_name') }}" required>
                <!-- La valeur du champ est définie sur la valeur précédente ou l'ancienne valeur en cas d'erreur -->
                @error('first_name')  <!-- Si une erreur de validation existe pour le prénom -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour le nom -->
            <div class="form-group">
                <label for="last_name">Nom</label>
                <!-- Champ de saisie pour le nom du contact -->
                <input type="text" name="last_name" id="last_name" class="form-control" 
                       placeholder="Entrez le nom..." value="{{ old('last_name') }}" required>
                @error('last_name')  <!-- Si une erreur de validation existe pour le nom -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour l'email -->
            <div class="form-group">
                <label for="email">Email</label>
                <!-- Champ de saisie pour l'email du contact -->
                <input type="email" name="email" id="email" class="form-control" 
                       placeholder="Entrez l'email..." value="{{ old('email') }}" required>
                @error('email')  <!-- Si une erreur de validation existe pour l'email -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour le téléphone -->
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <!-- Champ de saisie pour le téléphone du contact -->
                <input type="text" name="phone" id="phone" class="form-control" 
                       placeholder="Entrez le téléphone..." value="{{ old('phone') }}">
                @error('phone')  <!-- Si une erreur de validation existe pour le téléphone -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour l'adresse -->
            <div class="form-group">
                <label for="address">Adresse</label>
                <!-- Champ de saisie pour l'adresse du contact -->
                <textarea name="address" id="address" class="form-control" rows="4" 
                          placeholder="Entrez l'adresse...">{{ old('address') }}</textarea>
                @error('address')  <!-- Si une erreur de validation existe pour l'adresse -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour les notes -->
            <div class="form-group">
                <label for="notes">Notes</label>
                <!-- Champ de saisie pour les notes du contact -->
                <textarea name="notes" id="notes" class="form-control" 
                          placeholder="Entrez une note...">{{ old('notes') }}</textarea>
                @error('notes')  <!-- Si une erreur de validation existe pour les notes -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Bouton de soumission du formulaire -->
            <button type="submit" class="btn btn-success mt-3">Enregistrer le contact</button>
        </form>
    </div>

@endsection  <!-- Fin de la section 'content', ce qui signifie que ce contenu sera intégré dans la mise en page -->
