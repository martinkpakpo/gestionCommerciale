<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_creation');
            $table->date('date_livraison_pre');
            $table->unsignedBigInteger('emetteur_id')->nullable();
            $table->foreign('emetteur_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('tiers_id')->nullable();
            $table->foreign('tiers_id')->references('id')->on('tiers')->nullOnDelete();
            $table->enum('status', ['ENABLE', 'DISABLE', 'BROUILLON','VALIDE','LIVRE' ])->default('ENABLE');
            $table->enum('etat', ['SOLDE', 'NON-SOLDE' ])->default('SOLDE');
            $table->enum('type', ['PLUSIEUR', 'UNE' ])->default('UNE');
            $table->string('valeur_hors_taxe');
            $table->string('valeur_taxe');
            $table->string('valeur_taux');
            $table->string('valeur_ttc');
            $table->string('valeur_remise');
            $table->string('valeur_total');
            $table->string('valeur_solde');
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
        Schema::dropIfExists('ventes');
    }
}
