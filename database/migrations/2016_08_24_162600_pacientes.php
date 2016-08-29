<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('email')->unique();
            $table->string('fecha_nacimiento');
            $table->enum('sexo',['Masculino,Femenino']);
            $table->string('municipio_o');
            $table->string('estado_o');
            $table->string('pais_o');
            $table->string('municipio');
            $table->string('estado');
            $table->string('pais');
            $table->string('direccion');
            $table->string('colonia');
            $table->string('cp');
            $table->string('rfc');
            $table->string('curp');
            $table->string('telefono_a');
            $table->string('telefono_b');
            $table->string('clave_bancaria');
            $table->string('religion');
            $table->string('ocupacion');
            $table->string('foto');
            $table->timestamps();
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pacientes');
    }
}
