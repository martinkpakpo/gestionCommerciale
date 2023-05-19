<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle')->unique();
            $table->string('numero')->unique();
            $table->string('adresse');
            $table->string('email')->unique();
            $table->string('entree');
            $table->string('sortie');
            $table->text('autre');
            $table->enum('status', ['A', 'D'])->default('A');
            $table->enum('type', ['C', 'F'])->default('C');
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
        Schema::dropIfExists('tiers');
    }
}
