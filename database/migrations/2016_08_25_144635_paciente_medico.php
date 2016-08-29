<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PacienteMedico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente_medico', function (Blueprint $table) {
            $table->integer('id_paciente')->unsigned();
            $table->integer('id_medico')->unsigned();
            $table->timestamps();
            $table->foreign('id_paciente')->references('id')->on('pacientes')->onDetele('cascade')->onUpdate('cascade');
            $table->foreign('id_medico')->references('id')->on('users')->onDetele('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paciente_medico');
    }
}
