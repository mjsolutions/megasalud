<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glucosa extends Model
{
    protected $table="glucosa";
    protected $fillable=['id','fecha','glucosa'];

    public function pacientes(){
    	return $this->belongsToMany('App\Paciente');
    }
}
