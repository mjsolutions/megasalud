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
            $table->string('razon_social');
            $table->string('pais');
            $table->string('estado');
            $table->string('municipio');
            $table->string('direccion');
            $table->string('cp');
            $table->string('telefono');
            $table->string('cuenta_bancaria');
            $table->string('banco');
            $table->timestamps();
        });
        Schema::create('user_sucursal', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('sucursal_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::create('producto_sucursal', function (Blueprint $table) {
            $table->integer('producto_id')->unsigned();
            $table->integer('sucursal_id')->unsigned();
            $table->integer('existencia');
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_sucursal');
        Schema::drop('producto_sucursal');
        Schema::drop('sucursales');
    }
}
