<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table="productos";

    protected $fillable=['nombre','descripcion','precio','status'];

    public function pedidos(){
    	return $this->belongsToMany('MegaSalud\Pedido')->withPivot('cantidad')->withTimestamps();
    }
    public function producto_sucursal(){
    	return $this->belongsToMany('MegaSalud\Sucursal','producto_sucursal')->withPivot('existencia')->withTimestamps();
    }
}
