<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraitementApprovisionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traitement_approvisionnements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('validateur_id')->nullable();
            $table->foreign('validateur_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('approvisionnement_id')->nullable();
            $table->foreign('approvisionnement_id')->references('id')->on('approvisionnements')->nullOnDelete();
            $table->date('date_validation')->nullable();
            $table->string('commentaire');
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
        Schema::dropIfExists('traitement_approvisionnements');
    }
}
