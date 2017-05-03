<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frais', function (Blueprint $table) {
            $table->increments('id');
            $table->double('frais');
            $table->double('scolarite');
            $table->integer('niveau_id')->unsigned()->index();
            $table->integer('etablissement_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('versements',function(Blueprint $table){
            $table->foreign('frais_id')
                ->references('id')
                ->on('frais')
                ->onDelete('cascade');
        });

        Schema::table('frais',function (Blueprint $table){
            $table->foreign('niveau_id')
                ->references('id')
                ->on('niveaux')
                ->onDelete('cascade');
            $table->foreign('etablissement_id')
                ->references('id')
                ->on('etablissements')
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
        Schema::dropIfExists('Frais');
    }
}
