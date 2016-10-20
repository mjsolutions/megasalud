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
            $table->integer('paciente_id')->unsigned();
            $table->integer('user_id')->unsigned();//medico
            $table->float('importe');
            $table->float('impuesto');
            $table->float('total');
            $table->timestamp('fecha_pedido')->default("0000-00-00 00:00:00");
            $table->string('confirmacion');
            $table->timestamp('fecha_pago');
            $table->enum('metodo',['Efectivo','Tarjeta','Paypal','OXXO','Deposito']);
            $table->string('detalle');
            $table->integer('status')->default(1);//1.- En Espera, 2.- Pagado, 3.- Cancelado
            $table->timestamps();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::create('pedido_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedido_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
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