<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HisclinicApnp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hisclinic_apnp', function (Blueprint $table) {
            $table->integer('id_paciente')->unsigned();
            $table->string('apnp_1r',2);
            $table->text('apnp_1ra');
            $table->text('apnp_1rb');
            $table->integer('apnp_1rc');
            $table->string('apnp_2r',2);
            $table->string('apnp_2ra',1);
            $table->string('apnp_2rb',1);
            $table->integer('apnp_2rc');
            $table->string('apnp_3r',2);
            $table->string('apnp_3ra',1);
            $table->string('apnp_3rb',1);
            $table->integer('apnp_3rc');
            $table->string('apnp_4r',2);
            $table->string('apnp_4ra',1);
            $table->integer('apnp_4rb');
            $table->text('apnp_4rc');
            $table->string('apnp_5ra',1);
            $table->string('apnp_5rb',1);
            $table->string('apnp_5rc',1);
            $table->string('apnp_6r',2);
            $table->text('apnp_6ra');
            $table->string('apnp_7ra',8);
            $table->string('apnp_7rb',8);
            $table->string('apnp_7rc',8);
            $table->string('apnp_7rd',8);
            $table->string('apnp_7re',8);
            $table->string('apnp_8r',2);
            $table->text('apnp_8ra');
            $table->text('apnp_8rb');
            $table->string('apnp_9r',2);
            $table->text('apnp_9ra');
            $table->string('apnp_10r',10);
            $table->string('apnp_11r',2);
            $table->integer('apnp_12r');
            $table->string('apnp_13r',1);
            $table->string('apnp_14r',1);
            $table->string('apnp_15r',1);
            $table->string('apnp_16r',1);
            $table->string('apnp_17r',1);
            $table->string('apnp_18r',1);
            $table->string('apnp_19r',1);
            $table->string('apnp_20r',1);
            $table->string('apnp_21r',1);
            $table->string('apnp_22r',1);
            $table->string('apnp_23r',1);
            $table->string('apnp_24r',1);
            $table->string('apnp_25r',1);
            $table->string('apnp_26r',2);
            $table->string('apnp_26ra',1);
            $table->string('apnp_27r',2);
            $table->integer('apnp_27ra');
            $table->string('apnp_28ra',7);
            $table->string('apnp_28rb',7);
            $table->string('apnp_28rc',7);
            $table->string('apnp_29r',2);
            $table->text('apnp_29ra');
            $table->text('apnp_29rb');
            $table->text('apnp_29rc');
            $table->text('apnp_29rd');
            $table->integer('apnp_30ra');
            $table->integer('apnp_30rb');
            $table->integer('apnp_30rc');
            $table->string('apnp_31r',2);
            $table->text('apnp_31ra');
            $table->text('observacion');
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
        Schema::drop('hisclinic_apnp');
    }
}
