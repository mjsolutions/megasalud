<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table="sucursales";

    protected $fillable=['user_id','razon_social','cuenta_bancaria','banco'];

    public function user(){
    	return $this->belongsTo('MegaSalud\User');
    }

    public function users(){
    	return $this->belongsToMany('MegaSalud\User','medico_sucursal')->withTimestamps();
    }
    public function agendas(){
    	return $this->hasMany('MegaSalud\Agenda');
    }
}
