@extends('layouts.app')  <!-- Cette directive permet de récupérer la structure de la page principale de l'application -->

@section('content')  <!-- La section 'content' définit la partie du contenu qui sera insérée dans la mise en page -->

    <div class="container">  <!-- Conteneur pour centrer et espacer correctement le contenu sur la page -->
        <h1>Modifier le Contact</h1>  <!-- Titre de la page pour indiquer que c'est un formulaire de modification -->

        {{-- Formulaire pour modifier un contact --}}
        <form action="{{ route('contacts.update', $contact) }}" method="POST">
            <!-- Le formulaire envoie une requête HTTP POST à la route 'contacts.update' et transmet l'objet $contact -->

            @csrf  <!-- Protection contre les attaques CSRF (Cross-Site Request Forgery) pour sécuriser le formulaire -->
            @method('PATCH')  <!-- Spécifie que ce formulaire utilise la méthode PATCH, ce qui est plus approprié pour une mise à jour -->

            <!-- Champ pour le prénom -->
            <div class="form-group">
                <label for="first_name">Prénom</label>
                <!-- Champ de saisie pour le prénom du contact -->
                <input type="text" name="first_name" id="first_name" class="form-control" 
                       value="{{ old('first_name', $contact->first_name) }}" required>
                <!-- La valeur de l'input est définie sur la valeur déjà existante du contact ou l'ancienne valeur saisie par l'utilisateur en cas d'erreur -->
                @error('first_name')  <!-- Si une erreur de validation existe pour le prénom -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour le nom -->
            <div class="form-group">
                <label for="last_name">Nom</label>
                <!-- Champ de saisie pour le nom du contact -->
                <input type="text" name="last_name" id="last_name" class="form-control" 
                       value="{{ old('last_name', $contact->last_name) }}" required>
                @error('last_name')  <!-- Si une erreur de validation existe pour le nom -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour l'email -->
            <div class="form-group">
                <label for="email">Email</label>
                <!-- Champ de saisie pour l'email du contact -->
                <input type="email" name="email" id="email" class="form-control" 
                       value="{{ old('email', $contact->email) }}" required>
                @error('email')  <!-- Si une erreur de validation existe pour l'email -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour le téléphone -->
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <!-- Champ de saisie pour le téléphone du contact -->
                <input type="text" name="phone" id="phone" class="form-control" 
                       value="{{ old('phone', $contact->phone) }}">
                @error('phone')  <!-- Si une erreur de validation existe pour le téléphone -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour l'adresse -->
            <div class="form-group">
                <label for="address">Adresse</label>
                <!-- Champ de saisie pour l'adresse du contact -->
                <input type="text" name="address" id="address" class="form-control" 
                       value="{{ old('address', $contact->address) }}">
                @error('address')  <!-- Si une erreur de validation existe pour l'adresse -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Champ pour les notes -->
            <div class="form-group">
                <label for="notes">Notes</label>
                <!-- Champ de texte pour ajouter des notes supplémentaires pour le contact -->
                <textarea name="notes" id="notes" class="form-control">{{ old('notes', $contact->notes) }}</textarea>
                @error('notes')  <!-- Si une erreur de validation existe pour les notes -->
                    <div class="alert alert-danger">{{ $message }}</div>  <!-- Affiche l'erreur sous le champ -->
                @enderror
            </div>

            <!-- Bouton de soumission du formulaire -->
            <button type="submit" class="btn btn-warning mt-3">Mettre à jour le contact</button>
        </form>
    </div>

@endsection  <!-- Fin de la section 'content', le contenu est maintenant inséré dans la mise en page -->
