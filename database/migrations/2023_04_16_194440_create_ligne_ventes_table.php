<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigneVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_ventes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produit_id')->nullable();
            $table->foreign('produit_id')->references('id')->on('produits')->nullOnDelete();
            $table->string('prix_unitaire_achat');
            $table->string('quantite_init');
            $table->string('quantite_livre');
            $table->string('prix_ini');
            $table->string('prix_livre');
            $table->unsignedBigInteger('vente_id')->nullable();
            $table->foreign('vente_id')->references('id')->on('ventes')->nullOnDelete();
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
        Schema::dropIfExists('ligne_ventes');
    }
}
