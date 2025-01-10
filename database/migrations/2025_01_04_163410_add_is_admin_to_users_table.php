<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modification de la table 'users' pour ajouter la colonne 'is_admin'
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false); // Ajout de la colonne is_admin
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Annulation de l'ajout de la colonne 'is_admin'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin'); // Suppression de la colonne is_admin
        });
    }
};
