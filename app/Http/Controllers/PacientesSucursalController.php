<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use MegaSalud\Http\Requests;

use MegaSalud\Paciente;

use MegaSalud\User;

use MegaSalud\Sucursal;

use Laracasts\Flash\Flash;

class PacientesSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal=2;//sucursal obtenida de sesion
        $pacientes=DB::table('pacientes')
                        ->join('paciente_user','pacientes.id','=','paciente_user.paciente_id')
                        ->join('user_sucursal','user_sucursal.user_id','=','paciente_user.user_id')
                        ->where('user_sucursal.sucursal_id',$sucursal)->orderBy('nombre','ASC')->paginate(10);
        return view('sucursal.pacientes.list')->with("pacientes",$pacientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursal=2;
        $sucursal=Sucursal::find($sucursal);
        $medicos=$sucursal->users->lists('nombre','id');
        return view('sucursal.pacientes.create')->with('medicos',$medicos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Encontrando médico
        $id=$request->medico;
        $dr=User::find($id);
        $paciente=new Paciente($request->all());//pasando el array que se recibe del formulario
        unset($paciente->foto);
        //creando clave bancaria
        $count=Paciente::count();
        $paciente->clave_bancaria=app('MegaSalud\Http\Controllers\PacientesController')->clave($request->estado,$count+1,"P");
        if($id!=0){
            if($request->file('foto')){
                $foto=$request->file('foto');
                $foto_name=$request->nombre.time().'.'.$foto->getClientOriginalExtension();
                $path=public_path()."/images/paciente/";
                $request->foto=$foto_name;
                $paciente->foto=$foto_name;
            }
            if($paciente->save()){
                if($request->file('foto'))
                    $foto->move($path,$foto_name);
                $paciente->users()->attach($dr);
                Flash::overlay('Se ha registrado '.$paciente->nombre.' de forma exitosa.', 'Alta exitosa');
            }
            else{
                Flash::overlay('Ha ocurrido un error al registrar al paciente  '.$paciente->nombre, 'Error');
            }
        }
        else{
            Flash::overlay('Debes seleccionar un médico registrado.', 'Error');
        }
        return redirect()->route('sucursal.pacientes.index');
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
    public function update(Request $request, $id)
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
}
