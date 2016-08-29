<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MedicoSucursal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medico_sucursal', function (Blueprint $table) {
            $table->integer('id_medico')->unsigned();
            $table->integer('id_sucursal')->unsigned();
            $table->timestamps();
            $table->foreign('id_medico')->references('id')->on('users')->onDetele('cascade')->onUpdate('cascade');
            $table->foreign('id_sucursal')->references('id')->on('sucursales')->onDetele('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medico_sucursal');
    }
}
