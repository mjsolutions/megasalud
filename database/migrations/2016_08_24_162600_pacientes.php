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
            $table->string('email');
            $table->date('fecha_nacimiento');
            $table->enum('sexo',['Masculino','Femenino']);
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
            $table->boolean('status')->default(1);
        });

        Schema::create('paciente_user', function (Blueprint $table) {
            $table->integer('paciente_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paciente_user');
        Schema::drop('pacientes');
    }
}
