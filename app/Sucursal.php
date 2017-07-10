<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table="sucursales";

    protected $fillable=['razon_social','pais','estado','municipio','direccion','cp','telefono','cuenta_bancaria','banco'];

    public function user(){
    	return $this->belongsTo('MegaSalud\User');
    }

    public function users(){
    	return $this->belongsToMany('MegaSalud\User','user_sucursal')->withTimestamps();
    }
    public function agendas(){
    	return $this->hasMany('MegaSalud\Agenda');
    }
    public function producto_sucursal(){
        return $this->belongsToMany('MegaSalud\Producto','producto_sucursal')->withPivot('existencia')->withTimestamps();
    }
}
