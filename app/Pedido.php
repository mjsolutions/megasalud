<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table="pedidos";

    protected $fillable=['cliente_id','medico_id','importe','total','impuesto','total','fecha_pedido','confirmacion','fecha_pago','metodo','detalle'];

    public function productos(){
    	return $this->belongsToMany('MegaSalud\Producto')->withPivot('cantidad')->withTimestamps();
    }
    public function paciente(){
    	return $this->belongsTo('MegaSalud\Paciente');
    }
    public function user(){
    	return $this->belongsTo('MegaSalud\User');
    }
}
