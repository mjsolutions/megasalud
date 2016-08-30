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
            $table->integer('paciente_id')->unsigned();
            $table->integer('users_id')->unsigned();//medico
            $table->timestamp('fecha');
            $table->text('observacion');
            $table->timestamps();
            $table->integer('status')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDetele('cascade')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDetele('cascade')->onUpdate('cascade');
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
