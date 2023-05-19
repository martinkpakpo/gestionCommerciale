<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelineApprovisionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_approvisionnements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->text('texte');
            $table->string('code');
            $table->date('date_creation');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->unsignedBigInteger('approvisionnement_id')->nullable();
            $table->foreign('approvisionnement_id')->references('id')->on('approvisionnements')->nullOnDelete();
           
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
        Schema::dropIfExists('timeline_approvisionnements');
    }
}
