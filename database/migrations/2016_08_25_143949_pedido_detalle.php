<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PedidoDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pedido')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDetele('cascade')->onUpdate('cascade');
            $table->foreign('id_producto')->references('id')->on('productos')->onDetele('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedido_detalle');
    }
}
