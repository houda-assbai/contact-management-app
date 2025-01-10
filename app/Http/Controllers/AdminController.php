<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    /**
     * Constructeur : applique un middleware 'admin' pour s'assurer que seul un administrateur peut accéder aux actions.
     */
    public function __construct()
    {
        $this->middleware('admin'); // Le middleware 'admin' permet de vérifier que seul un utilisateur avec un rôle d'administrateur peut accéder aux actions de ce contrôleur.
    }

    /**
     * Affiche la liste de tous les utilisateurs (sans leurs contacts).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
{
    // Récupère les paramètres de recherche, d'ordre et de tri depuis la requête HTTP
    $search = $request->query('search'); // Paramètre de recherche (recherche sur le nom ou l'email)
    $order = $request->query('order', 'asc'); // Ordre de tri, 'asc' par défaut pour croissant
    $sortBy = $request->query('sortBy', 'name'); // Par défaut, on trie par nom
    $filterBy = $request->query('filterBy'); // Paramètre de filtre si nécessaire

    // Récupère tous les utilisateurs qui ne sont pas administrateurs
    // Applique un filtre de recherche sur le nom ou l'email si un terme est fourni
    $users = User::where('is_admin', false) // Exclut les administrateurs
                 ->when($search, function ($query, $search) { // Si un terme de recherche est fourni
                     return $query->where('name', 'like', "%$search%") // Recherche par nom
                                  ->orWhere('email', 'like', "%$search%"); // Recherche par email
                 })
                 // Filtrage basé sur un critère spécifique (si nécessaire)
                 ->when($filterBy, function ($query, $filterBy) {
                     return $query->where('status', $filterBy); // Exemple de filtre sur le champ "status"
                 })
                 ->orderBy($sortBy, $order) // Trie les utilisateurs par le champ choisi, selon l'ordre spécifié
                 ->paginate(10); // Utilise la pagination pour afficher 10 utilisateurs par page

    // Retourne la vue 'admin.contacts.index' avec les utilisateurs récupérés et les paramètres de recherche
    return view('admin.contacts.index', compact('users', 'search', 'order', 'sortBy', 'filterBy'));
}

    public function create($userId)
    {
        // Vérifie si l'utilisateur existe ou échoue si l'utilisateur n'existe pas
        $user = User::findOrFail($userId);
    
        // Retourne la vue 'admin.contacts.create' avec l'utilisateur pour lequel on crée le contact
        return view('admin.contacts.create', compact('user'));
    }
    /**
     * Affiche les détails d'un utilisateur spécifique et la liste de ses contacts.
     *
     * @param int $userId
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function show($userId, Request $request)
    {
        // Récupère l'utilisateur à partir de son ID ou échoue si l'utilisateur n'existe pas
        $user = User::findOrFail($userId);

        // Récupère la valeur de recherche pour filtrer les contacts
        $search = $request->query('search');

        // Si un terme de recherche est fourni, on filtre les contacts en fonction de celui-ci
        if ($search) {
            // On effectue une recherche sur les contacts en cherchant dans le prénom, nom ou téléphone
            $contacts = $user->contacts()->where(function($query) use ($search) {
                $query->where(function($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                          ->where('last_name', 'like', "%$search%");
                })
                ->orWhere(function($query) use ($search) {
                    $query->where('last_name', 'like', "%$search%")
                          ->where('first_name', 'like', "%$search%");
                })
                ->orWhere('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%"); // Recherche par téléphone
            })->get();
        } else {
            // Sinon, récupère tous les contacts de cet utilisateur
            $contacts = $user->contacts;
        }

        // Retourne la vue 'admin.contacts.show' avec les détails de l'utilisateur et la liste de ses contacts
        return view('admin.contacts.show', compact('user', 'contacts'));
    }

    /**
     * Enregistre un nouveau contact pour un utilisateur spécifique.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire pour créer un nouveau contact
        $validated = $request->validate([
            'first_name' => 'required|string|max:255', // Le prénom est requis
            'last_name' => 'required|string|max:255', // Le nom est requis
            'email' => 'required|email|unique:contacts,email', // L'email est requis et doit être unique dans la table contacts
            'phone' => 'required|string|max:15', // Le téléphone est requis
            'user_id' => 'required|exists:users,id', // Vérifie que l'utilisateur auquel le contact appartient existe dans la table users
            'address' => 'nullable|string|max:500', // L'adresse est optionnelle
            'notes' => 'nullable|string|max:1000',  // Les notes sont optionnelles
        ]);

        // Crée un nouveau contact en utilisant les données validées
        Contact::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'user_id' => $validated['user_id'], // Associe ce contact à l'utilisateur spécifié
            'address' => $validated['address'],  // Ajoute l'adresse (optionnelle)
            'notes' => $validated['notes'],      // Ajoute les notes (optionnelles)
        ]);

        // Redirige vers la page de l'utilisateur avec ses contacts et affiche un message de succès
        return redirect()->route('admin.contacts.show', $validated['user_id'])->with('success', 'Contact ajouté avec succès.');
    }

    /**
     * Affiche le formulaire de modification d'un contact.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\View\View
     */
    public function edit(Contact $contact)
    {
        // Retourne la vue 'admin.contacts.edit' avec le contact à modifier
        return view('admin.contacts.edit', compact('contact'));
    }

    /**
     * Met à jour un contact dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Contact $contact)
    {
        // Validation des données de mise à jour du contact
        $validated = $request->validate([
            'first_name' => 'required|string|max:255', // Le prénom est requis
            'last_name' => 'required|string|max:255', // Le nom est requis
            'email' => 'required|email|unique:contacts,email,' . $contact->id, // L'email doit être unique sauf pour ce contact
            'phone' => 'required|string|max:15', // Le téléphone est requis
            'address' => 'nullable|string|max:500', // L'adresse est optionnelle
            'notes' => 'nullable|string|max:1000',  // Les notes sont optionnelles
        ]);

        // Met à jour les informations du contact avec les données validées
        $contact->update($validated);

        // Redirige vers la page des contacts de l'utilisateur et affiche un message de succès
        return redirect()->route('admin.contacts.show', $contact->user_id)->with('success', 'Contact mis à jour avec succès.');
    }

    /**
     * Supprime un contact.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        // Supprime le contact de la base de données
        $contact->delete();

        // Redirige vers la page des contacts de l'utilisateur et affiche un message de succès
        return redirect()->route('admin.contacts.show', $contact->user_id)->with('success', 'Contact supprimé avec succès.');
    }
}
