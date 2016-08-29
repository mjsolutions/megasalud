<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstudioPaciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudio_paciente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_paciente')->unsigned();
            $table->string('nombre_estudio');
            $table->string('ruta_documento');
            $table->timestamp('fecha');
            $table->timestamps();
            $table->foreign('id_paciente')->references('id')->on('pacientes')->onDetele('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estudio_paciente');
    }
}
