<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table="pacientes";
    protected $fillable=['nombre','apellido_p','apellido_m','email','fecha_nacimiento','sexo','municipio_o','estado_o','pais_o','municipio','estado','pais','direccion','colonia','cp','rfc','curp','telefono_a','telefono_b','clave_bancaria','religion','ocupacion','foto','status'];
    public function pedido(){
    	return $this->hasMany('MegaSalud\Pedido');
    }

    public function users(){
    	return $this->belongsToMany('MegaSalud\User')->withTimestamps();
    }
    public function estudio_paciente(){
    	return $this->hasMany('MegaSalud\Estudio_Paciente');
    }
    public function citas(){
        return $this->belongsToMany('MegaSalud\User','citas')->withPivot('paciente_id','user_id','fecha','observacion','status')->withTimestamps();
    }
}
