<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Identifiant unique du contact
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relation avec la table 'users'
            $table->string('first_name'); // Prénom du contact
            $table->string('last_name'); // Nom de famille du contact
            $table->string('email')->unique(); // Adresse email du contact
            $table->string('phone')->nullable(); // Numéro de téléphone du contact
            $table->string('address')->nullable(); // Adresse du contact
            $table->text('notes')->nullable(); // Notes supplémentaires
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Annuler la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
