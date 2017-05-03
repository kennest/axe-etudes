<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtablissement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->string('sigle');
            $table->string('email');
            $table->string('logo');
            $table->longText('presentation')->nullable();
            $table->string('slug')->nullable();
            $table->string('code');
            $table->boolean('actif')->default(false);
            $table->string('password');
            $table->string('telephone');
            $table->string('statut')->nullable();
            $table->integer('type_id')->unsigned()->index();
            $table->rememberToken();
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
        Schema::dropIfExists('etablissements');
    }
}
