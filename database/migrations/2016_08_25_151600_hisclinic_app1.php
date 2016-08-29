<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HisclinicApp1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hisclinic_app1', function (Blueprint $table) {
            $table->integer('id_paciente')->unsigned();
            $table->text('enfermedad');
            $table->text('antecedente');
            $table->timestamp('fecha');
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
        Schema::drop('hisclinic_app1');
    }
}
