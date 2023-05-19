<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vente_id')->nullable();
            $table->foreign('vente_id')->references('id')->on('ventes')->nullOnDelete();
            $table->string('valeur_paye');
            $table->string('valeur_deja_paye');
            $table->string('valeur_du');
            $table->string('valeur_du_restant');
            $table->date('date_creation');
            $table->unsignedBigInteger('operateur_id')->nullable();
            $table->foreign('operateur_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('type_reglement')->nullable();
            $table->foreign('type_reglement')->references('id')->on('type_reglements')->nullOnDelete();
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
        Schema::dropIfExists('paiement_clients');
    }
}
