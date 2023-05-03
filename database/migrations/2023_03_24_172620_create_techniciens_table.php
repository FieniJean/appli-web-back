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
        Schema::create('techniciens', function (Blueprint $table) {
            // $table->inherits('users');
            $table->id();
            $table->string('nom_technicien');
            $table->string('prenom_technicien')->nullable();
            $table->string('email_technicien')->unique();
            $table->string('password_technicien');
            $table->string('adresse_technicien')->nullable();
            $table->integer('telephone_technicien')->nullable();
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
        Schema::dropIfExists('techniciens');
    }
};
