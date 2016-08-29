<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Pedido_Detalle extends Model
{
    $table="pedido_detalle";

    $fillable=['id_pedido','id_producto','cantidad'];

    public function producto(){
    	return $this->belongsTo('App\Producto');
    }
    public function pedido(){
    	return $this->belongsTo('App\Pedido');
    }
}
