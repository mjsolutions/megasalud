<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table='agendas';
    protected $fillable=['sucursal_id','nombre','apellido_p','apellido_m','telefono','email','comentario','status'];

    public function sucursal(){
    	return $this->belongsTo('MegaSalud\Sucursal');
    }
}
