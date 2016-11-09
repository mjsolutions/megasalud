<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use MegaSalud\Http\Requests;

use MegaSalud\Paciente;

use MegaSalud\User;

use MegaSalud\Sucursal;

use Laracasts\Flash\Flash;

use Illuminate\Support\Facades\Storage;

use MegaSalud\Http\Requests\PacienteRequest;

class PacientesSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal=2;//obtenida de sesión
        $pacientes=DB::table('pacientes')
                        ->join('paciente_user','pacientes.id','=','paciente_user.paciente_id')
                        ->join('user_sucursal','user_sucursal.user_id','=','paciente_user.user_id')
                        ->where('user_sucursal.sucursal_id',$sucursal)
                        ->where('status',1)
                        ->orderBy('nombre','ASC')->paginate(10);
        return view('sucursal.pacientes.list')->with("pacientes",$pacientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursal=2;//obtenida de sesión
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
    public function store(PacienteRequest $request)
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
        $sucursal=2;//obtenida de sesión
        $paciente=Paciente::find($id);
        $paciente->users;
        $sucursal=Sucursal::find($sucursal);
        $medicos=$sucursal->users->lists('nombre','id');
        return view('sucursal.pacientes.edit')->with('paciente',$paciente)->with('medicos',$medicos);
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
        $foto_name=$paciente->foto;
        $dr_v=$paciente->users[0]->id;//obtenemos el medico que tenía asginado'
        $paciente->fill($request->all());//aseguramos todos los cambios
        $dr_n=intval($request->medico);//obtenemos el médico nuevo'
        if($paciente->users()->detach($dr_v)){//borramos el médico viejo
            $paciente->users()->attach($dr_n);//agregamos el nuevo medico
            if($request->file('foto')){//comprobamos si se sube una fotografía
                $path=public_path()."/images/paciente/";//ruta donde se almacenan
                $foto_file=$request->file('foto');//obtenemos el objeto de la imagen
                if(Storage::disk('local')->has('images/paciente/'.$foto_name)&&$foto_name!=""){//comprobamos si ya hay una foto de ese paciente, si existe, borramos el archivo y ponemos el nuevo
                    $foto_file->move($path,$foto_name);
                    $paciente->foto=$foto_name;
                }
                else{//si no existe, creamos el nombre del archivo y movemos el archivo a la carpeta
                    $foto_name=$request->nombre.time().'.'.$foto_file->getClientOriginalExtension();//nombre de archivo
                    $foto_file->move($path,$foto_name);
                    $paciente->foto=$foto_name;
                }
            }
            if($paciente->save()){//guardamos los cambios en la tabla de pacientes
                Flash::overlay('Se actualizó a  '.$paciente->nombre.' de forma exitosa.', 'Operación exitosa');
            }else{
                Flash::overlay('Ha ocurrido un error al editar al paciente  '.$paciente->nombre, 'Error');
            }
        }
        else{
            Flash::overlay('Ha ocurrido un error al editar el medico del paciente  '.$paciente->nombre, 'Error');
        }
        return redirect()->route('sucursal.pacientes.index');
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
        return redirect()->route('sucursal.pacientes.index');
    }
}
