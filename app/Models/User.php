<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Utilisation de la classe Authenticatable pour l'authentification
use Illuminate\Notifications\Notifiable; // Trait permettant l'envoi de notifications
use Illuminate\Database\Eloquent\Factories\HasFactory; // Trait pour l'utilisation des factories
use App\Models\Contact; // Importation du modèle Contact car un utilisateur peut avoir plusieurs contacts

class User extends Authenticatable
{
    use HasFactory, Notifiable; // Application des traits HasFactory et Notifiable au modèle

    /**
     * Relation avec le modèle Contact.
     *
     * Un utilisateur peut avoir plusieurs contacts. La méthode `hasMany()` définit cette relation
     * dans laquelle un utilisateur (User) peut être lié à plusieurs contacts (Contact).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        // Retourne une relation "hasMany" avec le modèle Contact, ce qui signifie que chaque utilisateur
        // peut avoir plusieurs contacts associés. Cela permet d'accéder à tous les contacts d'un utilisateur.
        return $this->hasMany(Contact::class);
    }

    /**
     * Les attributs qui peuvent être remplis (pour éviter les attaques par assignment de masse).
     *
     * Le tableau $fillable définit les colonnes qui peuvent être assignées via un tableau de données
     * pour la création ou la mise à jour d'un utilisateur. Cela permet de protéger contre les attaques
     * par "mass-assignment" où des champs non autorisés seraient assignés.
     */
    protected $fillable = [
        'name',   // Nom de l'utilisateur
        'email',  // Email de l'utilisateur
        'password',  // Mot de passe de l'utilisateur
    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * Le tableau $hidden définit quels attributs ne doivent pas être exposés dans les tableaux,
     * par exemple lors de la sérialisation de l'objet en JSON.
     */
    protected $hidden = [
        'password',  // Le mot de passe doit être caché pour des raisons de sécurité
        'remember_token',  // Le jeton de rappel doit être caché
    ];

    /**
     * Les attributs de type de données.
     *
     * Le tableau $casts permet de spécifier la manière dont certains attributs doivent être traités.
     * Par exemple, nous utilisons ici le type 'datetime' pour la colonne 'email_verified_at' afin de la
     * convertir automatiquement en un objet Carbon (qui est une extension de PHP DateTime).
     */
    protected $casts = [
        'email_verified_at' => 'datetime',  // Ce champ sera traité comme une instance de Carbon pour faciliter les opérations de dates
    ];

    /**
     * Vérifie si l'utilisateur est un administrateur.
     *
     * Cette méthode est une manière simple de vérifier si un utilisateur a des privilèges d'administrateur.
     * Elle retourne true si l'attribut `is_admin` de l'utilisateur est égal à 1, sinon false.
     * Cette méthode est utile pour vérifier les droits d'accès des utilisateurs dans des rôles administratifs.
     *
     * @return bool
     */
    public function isAdmin()
    {
        // Retourne true si l'utilisateur est un administrateur (is_admin = 1), sinon false
        return $this->is_admin === 1;
    }
}
