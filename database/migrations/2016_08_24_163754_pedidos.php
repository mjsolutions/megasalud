<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_medico')->unsigned();
            $table->float('importe');
            $table->float('impuesto');
            $table->float('total');
            $table->timestamp('fecha_pedido');
            $table->string('confirmacion');
            $table->timestamp('fecha_pago');
            $table->enum('metodo',['Efectivo','Tarjeta','Paypal','OXXO','Deposito']);
            $table->string('detalle');
            $table->timestamps();
            $table->foreign('id_cliente')->references('id')->on('pacientes')->onDetele('cascade')->onUpdate('cascade');
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
        Schema::drop('pedidos');
    }
}