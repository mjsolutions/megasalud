<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Citas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_paciente')->unsigned();
            $table->integer('id_medico')->unsigned();
            $table->timestamp('fecha');
            $table->text('observacion');
            $table->timestamps();
            $table->integer('status')->unsigned();
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
        Schema::drop('citas');
    }
}
