<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','apellido_p','apellido_m', 'email', 'password','fecha_nacimiento','sexo','municipio','estado','pais','direccion','colonia','cp','rfc','curp','telefono_a','telefono_b','clave_bancaria', 'tipo_usuario', 'cedula', 'especialidad', 'cuenta_bancaria', 'banco','status'
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
        return $this->hasMany('App\Pedido');
    }
    public function pacientes(){
        return $this->belongsToMany('App\Paciente')->withTimestamps();
    }

    public function sucursales(){
        return $this->belongsToMany('App\Sucursal','user_sucursal')->withTimestamps();
    }
    //pivote de citas
    public function citas(){
        return $this->belongsToMany('App\Paciente','citas')->withPivot('paciente_id','user_id','fecha','observacion','status')->withTimestamps();
    }
    //Funciones para middlewares
    public function isAdmin() {
        return $this->tipo_usuario === 'Administrador';
    }

    public function isMedico() {
        return $this->tipo_usuario === 'Medico';
    }

    public function isAdminSucursal() {
        return $this->tipo_usuario === 'Administrador de sucursal';
    }
}
