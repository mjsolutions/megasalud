<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HisclinicApgo1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hisclinic_apgo1', function (Blueprint $table) {
            $table->integer('id_paciente')->unsigned();
            $table->integer('menarca');
            $table->string('ciclo',1);
            $table->integer('ciclo1');
            $table->integer('cilco2');
            $table->text('cicloe');
            $table->timestamp('fur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hisclinic_apgo1');
    }
}
