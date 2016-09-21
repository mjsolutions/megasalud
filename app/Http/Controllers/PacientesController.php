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
        $medico=$request->medico;
        unset($request->medico);
        $ruta="/images/paciente";
        $request->foto=$ruta;
        $paciente=new Paciente($request->all());
        $paciente->save();
        Flash::overlay('Se ha registrado '.$paciente->nombre.' de forma exitosa.', 'Alta exitosa');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            $data[$value->nombre." ".$value->apellido_p." ".$value->apellido_m]=null;
        }
        return json_encode($data);
    }
}
