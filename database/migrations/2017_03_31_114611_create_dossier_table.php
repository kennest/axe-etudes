<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle');
            $table->double('frais')->nullable();
            $table->integer('etablissement_id')->unsigned()->index();
            $table->enum('types', array('new', 'old','candidat'))->default('new');
            $table->timestamps();
        });
        Schema::table('dossiers',function(Blueprint $table){
            $table->foreign('etablissement_id')
                ->references('id')
                ->on('etablissements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dossiers');
    }
}
