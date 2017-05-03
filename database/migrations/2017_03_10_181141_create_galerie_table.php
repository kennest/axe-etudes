<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalerieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->integer('etablissement_id')->unsigned()->index();
            $table->timestamps();
        });
        Schema::table('galeries',function (Blueprint $table){
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
        Schema::dropIfExists('galeries');
    }
}
