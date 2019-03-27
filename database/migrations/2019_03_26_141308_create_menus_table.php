<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('description');
            $table->integer('prix')->unsigned();
            $table->Integer('id_restaurant')->unsigned();
            $table->Integer('id_user')->unsigned();
            $table->timestamps();
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('id_restaurants')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
