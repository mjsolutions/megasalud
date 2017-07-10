<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HisclinicTrat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hisclinic_trat', function (Blueprint $table) {
            $table->integer('id_paciente')->unsigned();
            $table->text('trat');
            $table->timestamp('fecha');
            $table->foreign('id_paciente')->references('id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hisclinic_trat');
    }
}
