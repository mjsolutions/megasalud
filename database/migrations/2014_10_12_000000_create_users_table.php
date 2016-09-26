<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('fecha_nacimiento');
            $table->enum('sexo',['Masculino','Femenino']);
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
            $table->string('contrasena');
            $table->enum('tipo_usuario',['Administrador', 'Administrador de sucursal','Medico']);
            $table->string('cedula');
            $table->string('especialidad');
            $table->string('cuenta_bancaria');
            $table->string('banco');
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
