<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use MegaSalud\Paciente;

class PruebaController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public function index(){
    	return "prueba controlador";
    }
    public function nombre($nombre){
    	return $nombre;
    }
    public function id($id){
    	$paciente=Paciente::find($id);
    	$paciente->each(function($paciente){
    			$paciente->citas;
    		});
    	return view('test.index',['paciente'=>$paciente]);
    }
}