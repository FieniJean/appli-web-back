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
        Schema::create('clients', function (Blueprint $table) {
            // $table->inherits('users');
            $table->id();
            $table->string('nom_client');
            $table->string('statut_client')->nullable();
            $table->string('prenom_client')->nullable();
            $table->string('email_client')->unique();
            $table->string('password_client');
            $table->string('adresse_client')->nullable();
            $table->integer('telephone_client')->nullable();
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('clients');
    }
};
