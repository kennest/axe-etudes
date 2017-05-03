<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->timestamps();
        });


        Schema::table('niveaux',function (Blueprint $table){
            $table->integer('systeme_id')->unsigned()->index();
            $table->foreign('systeme_id')
                ->references('id')
                ->on('systemes')
                ->onDelete('cascade');
        });

        //Many To Many
        Schema::create('etablissement_systeme',function (Blueprint $table){
            $table->increments('id');
            $table->integer('etablissement_id')->unsigned()->index();
            $table->integer('systeme_id')->unsigned()->index();
            $table->foreign('etablissement_id')
                ->references('id')
                ->on('etablissements')
                ->onDelete('cascade');
            $table->foreign('systeme_id')
                ->references('id')
                ->on('systemes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('systemes');
    }
}
