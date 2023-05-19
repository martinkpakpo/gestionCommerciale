<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemarquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demarques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produit_id')->nullable();
            $table->foreign('produit_id')->references('id')->on('produits')->nullOnDelete();
            $table->string('prix_unitaire_achat');
            $table->string('prix_unitaire_vente');
            $table->string('quantite');
            $table->string('prix_total_vente');
            $table->string('prix_total_achat');
            $table->string('marge');
            $table->string('code');
            $table->string('date_creation');
            $table->enum('status', ['ENABLE', 'DISABLE', 'VALIDE'])->default('ENABLE');
            $table->unsignedBigInteger('validateur_id')->nullable();
            $table->foreign('validateur_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('emetteur_id')->nullable();
            $table->foreign('emetteur_id')->references('id')->on('users')->nullOnDelete();
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
        Schema::dropIfExists('demarques');
    }
}
