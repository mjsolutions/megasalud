<?php

namespace MegaSalud;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function pedido(){
        return $this->hasMany('MegaSalud\Pedido');
    }
    public function pacientes(){
        return $this->belongsToMany('MegaSalud\Paciente')->withTimestamps();
    }
    public function sucursal(){
        return $this->hasOne('MegaSalud\Sucursal');
    }
    public function sucursales(){
        return $this->belongsToMany('MegaSalud\Sucursal','medico_sucursal')->withTimestamps();
    }
    //pivote de citas
    public function citas(){
        return $this->belongsToMany('MegaSalud\Paciente','citas')->withPivot('paciente_id','user_id','fecha','observacion','status')->withTimestamps();
    }
}
