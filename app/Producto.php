<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table="productos";

    protected $fillable=['nombre','descripcion','precio','existencia','status'];

    public function pedido_detalle(){
    	return $this->belongsToMany('App\Pedido');
    }
}
