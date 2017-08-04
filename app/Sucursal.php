<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table="sucursales";

    protected $fillable=['razon_social','pais','estado','municipio','direccion','cp','telefono','cuenta_bancaria','banco'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function users(){
    	return $this->belongsToMany('App\User','user_sucursal')->withTimestamps();
    }
    public function agendas(){
    	return $this->hasMany('App\Agenda');
    }
    public function producto_sucursal(){
        return $this->belongsToMany('App\Producto','producto_sucursal')->withPivot('existencia')->withTimestamps();
    }
}
