<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Constructeur : applique le middleware 'auth' pour s'assurer que seuls les utilisateurs authentifiés
     * peuvent accéder à ces actions.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Le middleware 'auth' assure que l'utilisateur est authentifié avant d'accéder aux méthodes.
    }

    /**
     * Affiche la liste des contacts de l'utilisateur authentifié.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Utilisation de Auth::user() pour obtenir l'utilisateur authentifié
        // Accède à l'utilisateur authentifié
        $user = Auth::user();

        // Récupère tous les contacts associés à cet utilisateur
        // Cela suppose que le modèle Contact est lié à l'utilisateur via une relation 'user' dans le modèle Contact.
        $contacts = $user->contacts; 

        // Retourne la vue 'contacts.index' et passe les contacts à cette vue
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Affiche le formulaire pour ajouter un nouveau contact.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Affiche la vue pour créer un contact
        return view('contacts.create');
    }

    /**
     * Enregistre un nouveau contact dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'first_name' => 'required|string|max:255', // Le prénom est requis et doit être une chaîne de caractères
            'last_name' => 'required|string|max:255', // Le nom est requis et doit être une chaîne de caractères
            'email' => 'required|email|unique:contacts,email,NULL,id,user_id,' . Auth::id(), // Email unique pour l'utilisateur
            'phone' => 'nullable|string|max:20', // Le téléphone est optionnel
            'address' => 'nullable|string|max:255', // L'adresse est optionnelle
            'notes' => 'nullable|string|max:500', // Les notes sont optionnelles
        ]);
    
        // Récupère l'utilisateur authentifié
        $user = Auth::user();
    
        // Crée un nouveau contact en utilisant les données validées
        $contact = new Contact($validated);
        $contact->user_id = $user->id; // Associe ce contact à l'utilisateur authentifié
        $contact->save(); // Sauvegarde le contact dans la base de données
    
        // Redirige vers la page des contacts avec un message de succès
        return redirect()->route('contacts.index')->with('success', 'Le contact a été ajouté avec succès.');
    }
    

    /**
     * Affiche le formulaire pour modifier un contact existant.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\View\View
     */
    public function edit(Contact $contact)
    {
        // Vérifie que le contact appartient bien à l'utilisateur authentifié
        if ($contact->user_id !== Auth::id()) {
            // Si ce n'est pas le cas, on renvoie une erreur 403 (accès non autorisé)
            abort(403, 'Unauthorized action.');
        }

        // Affiche le formulaire d'édition pour le contact
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Met à jour un contact existant dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Contact $contact)
    {
        // Vérifie que le contact appartient à l'utilisateur authentifié
        if ($contact->user_id !== Auth::id()) {
            // Si ce n'est pas le cas, on renvoie une erreur 403 (accès non autorisé)
            abort(403, 'Unauthorized action.');
        }

        // Validation des données envoyées pour la mise à jour
        $validated = $request->validate([
            'first_name' => 'required', // Prénom obligatoire
            'last_name' => 'required', // Nom obligatoire
            'email' => 'required|email|unique:contacts,email,' . $contact->id . ',id,user_id,' . Auth::id(), // Email unique pour l'utilisateur
            'phone' => 'required', // Téléphone obligatoire
            'address' => 'nullable', // Adresse optionnelle
            'notes' => 'nullable', // Notes optionnelles
        ]);

        // Met à jour les données du contact avec les nouvelles informations
        $contact->update($validated);

        // Redirige vers la page des contacts avec un message de succès
        return redirect()->route('contacts.index')->with('success', 'Contact mis à jour avec succès.');
    }

    /**
     * Supprime un contact de la base de données.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        // Vérifie que le contact appartient à l'utilisateur authentifié
        if ($contact->user_id !== Auth::id()) {
            // Si ce n'est pas le cas, on renvoie une erreur 403 (accès non autorisé)
            abort(403, 'Unauthorized action.');
        }

        // Supprime le contact de la base de données
        $contact->delete();

        // Redirige vers la page des contacts avec un message de succès
        return redirect()->route('contacts.index')->with('success', 'Contact supprimé avec succès.');
    }
}
