<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presion_Arterial extends Model
{
    protected $table="presion_arterial";
    protected $fillable=['id','fecha','horario','posicion','alta','baja'];

    public function pacientes(){
    	return $this->belongsToMany('App\Paciente');
    }
}
