<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importation du modèle User, car chaque contact appartient à un utilisateur.

class Contact extends Model
{
    use HasFactory; // Utilisation du trait HasFactory pour faciliter la création de factory pour les tests.

    /**
     * Attributs qui peuvent être assignés en masse.
     *
     * Le tableau $fillable contient les noms des colonnes de la table
     * qui peuvent être assignées en masse (mass-assignment). Cela permet
     * de créer un contact via un tableau de données sans devoir spécifier
     * chaque colonne individuellement.
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'phone', 'address', 'notes',  // Colonnes autorisées pour l'assignation en masse
    ];

    /**
     * Relation inverse avec l'utilisateur.
     *
     * Chaque contact appartient à un utilisateur.
     * Cette méthode définit la relation inverse, c'est-à-dire que chaque contact
     * est associé à un utilisateur spécifique.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Déclare que le modèle Contact "appartient" à un modèle User.
        // La clé étrangère est 'user_id', ce qui signifie qu'un contact est lié à un utilisateur via cette colonne.
        return $this->belongsTo(User::class); // Retourne une relation inverse (belongsTo)
    }

    /**
     * Les attributs qui doivent être convertis.
     *
     * Cette méthode spécifie comment certains attributs du modèle doivent être
     * convertis avant d'être utilisés, notamment pour les dates ou autres types.
     *
     * @return array<string, string>
     */
    protected $casts = [
        // Si le modèle a un champ 'email_verified_at', il sera automatiquement casté en un objet Carbon pour une gestion facile des dates.
        'email_verified_at' => 'datetime',  // Si vous avez ce champ dans votre base de données
    ];
}
