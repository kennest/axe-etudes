<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filieres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre')->unique();
            $table->timestamps();
        });


        //Many To Many
        Schema::create('etablissement_filiere',function (Blueprint $table){
            $table->increments('id');
            $table->integer('etablissement_id')->unsigned()->index();
            $table->integer('filiere_id')->unsigned()->index();
            $table->foreign('etablissement_id')
                ->references('id')
                ->on('etablissements')
                ->onDelete('cascade');
            $table->foreign('filiere_id')
                ->references('id')
                ->on('filieres')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filieres');
        Schema::dropIfExists('etablissements_filieres');
    }
}
