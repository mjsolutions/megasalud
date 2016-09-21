<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Agendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sucursal_id')->unsigned();
            $table->string('nombre');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('telefono');
            $table->string('email');
            $table->string('comentario');
            $table->timestamps();
            $table->boolean('status')->default(1);//1-En Espera, 2.-Atendida, 3.- Reprogramada, 4.- Cancelada
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
        Schema::drop('agendas');
    }
}
