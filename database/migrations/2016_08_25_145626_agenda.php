<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Agenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sucursales_id')->unsigned();
            $table->string('nombre');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('telefono');
            $table->string('email');
            $table->string('comentario');
            $table->timestamps();
            $table->boolean('status');
            $table->foreign('sucursales_id')->references('id')->on('sucursales')->onDetele('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('agenda');
    }
}
