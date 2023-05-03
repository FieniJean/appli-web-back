<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->date('date_intervention');
            $table->date('date_proch_intervention');
            $table->string('notes_intervention');
            $table->foreignId('extincteur_id')->constrained()->onDelete('cascade');
            $table->foreignId('technicien_id')->constrained()->onDelete('cascade');
            // $table->foreignId('technicien_id')->constrained();
            // $table->foreignId('extincteur_id')->constrained();
            // Ajoutez d'autres champs si nécessaire
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interventions');
    }
};
