<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivraisonApprovisionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraison_approvisionnements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('approvisionnement_id')->nullable();
            $table->foreign('approvisionnement_id')->references('id')->on('approvisionnements')->nullOnDelete();
            $table->date('date_livraison')->nullable();
            $table->unsignedBigInteger('recepteur_id')->nullable();
            $table->foreign('recepteur_id')->references('id')->on('users')->nullOnDelete();
            $table->string('livreur');
            $table->string('contact_livreur');
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
        Schema::dropIfExists('livraison_approvisionnements');
    }
}
