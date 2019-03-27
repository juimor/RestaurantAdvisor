<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('description');
            $table->integer('note')->nullable();
            $table->string('localisation');
            $table->Integer('telephone')->nullable();
            $table->string('siteweb')->nullable();
            $table->date('horaire_semaine')->nullable();
            $table->date('horaire_weekend')->nullable();
            $table->Integer('id_user')->unsigned();
            $table->timestamps();
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
