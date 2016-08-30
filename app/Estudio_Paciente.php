<?php

namespace MegaSalud;

use Illuminate\Database\Eloquent\Model;

class Estudio_Paciente extends Model
{
    protected $table="estudios_pacientes";
 	protected $fillable=['paciente_id','nombre_estudio','ruta_documento','fecha'];
 	
 	public function paciente(){
 		return $this->belongsTo('MegaSalud\Paciente');
 	}   
}
