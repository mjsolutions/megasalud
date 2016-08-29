<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    $table="pedidos";

    $fillable=['cliente_id','medico_id','importe','total','impuesto','total','fecha_pedido','confirmacion','fecha_pago','metodo','detalle'];

    public function pedido_detalle(){
    	return $this->belongsToMany('App\Producto');
    }
}
