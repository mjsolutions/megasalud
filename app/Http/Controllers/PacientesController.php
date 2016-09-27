<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use MegaSalud\Paciente;

use MegaSalud\User;

use Laracasts\Flash\Flash;

use MegaSalud\Http\Requests\PacienteRequest;

use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes=Paciente::where('status',1)->orderBy('nombre','ASC')->paginate(10);
        return view('admin.pacientes.list')->with('pacientes',$pacientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteRequest $request)
    {
        //Encontrando médico
        $medico=$request->medico;
        //dd(substr($medico,0,stripos($medico,' ')));
        $id=intval($medico);
        $dr=User::find($id);
        //tratando archivos
        $foto=$request->file('foto');
        $foto_name=$request->nombre.time().'.'.$foto->getClientOriginalExtension();
        $path=public_path()."/images/paciente/";
        $request->foto=$foto_name;
        $paciente=new Paciente($request->all());
        unset($paciente->foto);
        $paciente->foto=$foto_name;
        if($paciente->save()){
            $paciente->users()->attach($dr);
            $foto->move($path,$foto_name);
            Flash::overlay('Se ha registrado '.$paciente->nombre.' de forma exitosa.', 'Alta exitosa');
        }
        else{
            Flash::overlay('Ha ocurrido un error al registrar al paciente  '.$paciente->nombre, 'Error');
        }
        return redirect()->route('admin.pacientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente=Paciente::find($id);
        $paciente->users;
        return view('admin.pacientes.edit')->with('paciente',$paciente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteRequest $request, $id)
    {
        $paciente=Paciente::find($id);
        $dr_v=$paciente->users[0]->id;//obtenemos el medico que tenía asginado'
        $paciente->fill($request->all());//aseguramos todos los cambios
        $dr_n=intval($request->medico);//obtenemos el médico nuevo'
        if($paciente->users()->detach($dr_v)){//borramos el médico viejo
            $paciente->users()->attach($dr_n);//agregamos el nuevo medico
            if($paciente->save()){//guardamos los cambios en la tabla de pacientes
                Flash::overlay('Se actualizó a  '.$paciente->nombre.' de forma exitosa.', 'Operación exitosa');
            }else{
                Flash::overlay('Ha ocurrido un error al editar al paciente  '.$paciente->nombre, 'Error');
            }
        }
        else{
            Flash::overlay('Ha ocurrido un error al editar el medico del paciente  '.$paciente->nombre, 'Error');
        }
        return redirect()->route('admin.pacientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente=Paciente::find($id);
        $paciente->status=0;
        if($paciente->save()){
            Flash::overlay('Se ha eliminado a  '.$paciente->nombre.' de forma exitosa.', 'Operación exitosa');
        }
        else{
            Flash::overlay('Ha ocurrido un error al eliminar al paciente  '.$paciente->nombre, 'Error');
        }
        return redirect()->route('admin.pacientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pais()
    {
        $paises=DB::table('pacientes')->select('pais')->distinct()->get();
        $data=array();
        foreach ($paises as $pais => $value) {
            $data[$value->pais]=null;
        }
        return json_encode($data);
    }
    public function estado()
    {
        $estados=DB::table('pacientes')->select('estado')->distinct()->get();
        $data=array();
        foreach ($estados as $estado => $value) {
            $data[$value->estado]=null;
        }
        return json_encode($data);
    }
    public function ciudad()
    {
        $municipios=DB::table('pacientes')->select('municipio')->distinct()->get();
        $data=array();
        foreach ($municipios as $municipio => $value) {
            $data[$value->municipio]=null;
        }
        return json_encode($data);
    }
    public function medico()
    {
        $users=User::all();
        $data=array();
        foreach ($users as $user => $value) {
            $data[$value->id." - ".$value->nombre." ".$value->apellido_p." ".$value->apellido_m]=null;
        }
        return json_encode($data);
    }
    public function detalle($id){
        $paciente=Paciente::find($id);
        $data=array(
            'nombre'=>$paciente->nombre." ".$paciente->apellido_p." ".$paciente->apellido_m
        );
        return json_encode($data);
    }
}
