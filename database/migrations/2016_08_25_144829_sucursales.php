<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sucursales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();//encargado
            $table->string('razon_social');
            $table->string('cuenta_bancaria');
            $table->string('banco');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDetele('cascade')->onUpdate('cascade');
        });
        Schema::create('user_sucursal', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('sucursal_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDetele('cascade')->onUpdate('cascade');
            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDetele('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sucursales');
    }
}
