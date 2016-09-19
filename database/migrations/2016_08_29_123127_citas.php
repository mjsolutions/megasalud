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
            $table->integer('user_id')->unsigned();//medico
            $table->timestamp('fecha');
            $table->text('observacion');
            $table->timestamps();
            $table->integer('status')->unsigned()->default(1);//1-En Espera, 2-Atendida, 3-Reprogramada, 4- Cancelada
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDetele('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDetele('cascade')->onUpdate('cascade');
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
