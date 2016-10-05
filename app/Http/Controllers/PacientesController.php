<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use MegaSalud\Paciente;

use MegaSalud\User;

use Laracasts\Flash\Flash;

use MegaSalud\Http\Requests\PacienteRequest;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

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
        $paciente=new Paciente($request->all());//pasando el array que se recibe del formulario
        unset($paciente->foto);
        //creando clave bancaria
        $count=Paciente::count();
        $paciente->clave_bancaria=PacientesController::clave($request->estado,$count+1,"P");
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
        $foto_name=$paciente->foto;
        $dr_v=$paciente->users[0]->id;//obtenemos el medico que tenía asginado'
        $paciente->fill($request->all());//aseguramos todos los cambios
        $dr_n=intval($request->medico);//obtenemos el médico nuevo'
        if($paciente->users()->detach($dr_v)){//borramos el médico viejo
            $paciente->users()->attach($dr_n);//agregamos el nuevo medico
            if($request->file('foto')){//comprobamos si se sube una fotografía
                $path=public_path()."/images/paciente/";//ruta donde se almacenan
                $foto_file=$request->file('foto');//obtenemos el objeto de la imagen
                if(Storage::disk('local')->has('images/paciente/'.$foto_name)){//comprobamos si ya hay una foto de ese paciente, si existe, borramos el archivo y ponemos el nuevo
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
            $data[$value->id." - ".$value->nombre." ".$value->apellido_p." ".$value->apellido_m]="";
        }
        return json_encode($data);
    }
    public function detalle($id){
        $paciente=Paciente::find($id);
        $paciente->ruta=asset('images/paciente/');
        $paciente->telefono_a="(".substr($paciente->telefono_a, 0, 3).") ".substr($paciente->telefono_a, 3, 3)."-".substr($paciente->telefono_a,6);
        $paciente->telefono_b="(".substr($paciente->telefono_b, 0, 3).") ".substr($paciente->telefono_b, 3, 3)."-".substr($paciente->telefono_b,6);
        return json_encode($paciente);
    }
    public function clave($estado,$id,$tipo){
        $prefijo = 0;
        switch ($estado) {
            case "Aguascalientes":
                    $clave = "AG";
                    $prefijo = 17;
                    break;
            case "Baja California":
                    $clave="BC";
                    $prefijo = 23;
                    break;
            case "Baja California Sur":
                    $clave="BS";
                    $prefijo = 22;
                    break;
            case "Campeche":
                    $clave="CC";
                    $prefijo = 33;
                    break;
            case "Chiapas":
                    $clave="CS";
                    $prefijo = 32;
                    break;
            case "Chihuahua":
                    $clave="CH";
                    $prefijo = 38;
                    break;
            case "Coahuila":
                    $clave="CL";
                    $prefijo = 33;
                    break;
            case "Colima":
                    $clave="CM";
                    $prefijo = 34;
                    break;
            case "Distrito Federal":
                    $clave="DF";
                    $prefijo = 46;
                    break;
            case "Durango":
                    $clave="DR";
                    $prefijo = 49;
                    break;
            case "Guanajuato":
                    $clave="GN";
                    $prefijo = 75;
                    break;
            case "Guerrero":
                    $clave="GR";
                    $prefijo = 79;
                    break;
            case "Hidalgo":
                    $clave="HD";
                    $prefijo = 84;
                    break;
            case "Jalisco":
                    $clave="JL";
                    $prefijo = 13;
                    break;
            case "Mexico":
            case "México":
                    $clave="MX";
                    $prefijo = 47;
                    break;
            case "Michoacan":
            case "Michoacán":
                    $clave="MC";
                    $prefijo = 43;
                    break;
            case "Morelos":
                    $clave="MR";
                    $prefijo = 49;
                    break;
            case "Nayarit":
                    $clave="NY";
                    $prefijo = 58;
                    break;
            case "Nuevo Leon":
            case "Nuevo León":
                    $clave="NL";
                    $prefijo = 53;
                    break;
            case "Oaxaca":
                    $clave="OX";
                    $prefijo = 67;
                    break;
            case "Puebla":
                    $clave="PB";
                    $prefijo = 72;
                    break;
            case "Queretaro":
            case "Querétaro":
                    $clave="QU";
                    $prefijo = 84;
                    break;
            case "Quintana Roo":
                    $clave="QR";
                    $prefijo = 89;
                    break;
            case "San Luis Potosi":
            case "San Luis Potosí":
                    $clave="SL";
                    $prefijo = 23;
                    break;
            case "Sinaloa":
                    $clave="SN";
                    $prefijo = 25;
                    break;
            case "Sonora":
                    $clave="SR";
                    $prefijo = 29;
                    break;
            case "Tabasco":
                    $clave="TB";
                    $prefijo = 32;
                    break;
            case "Tamaulipas":
                    $clave="TM";
                    $prefijo = 34;
                    break;
            case "Tlaxcala":
                    $clave="TX";
                    $prefijo = 37;
                    break;
            case "Veracruz":
                    $clave="VR";
                    $prefijo = 59;
                    break;
            case "Yucatan":
            case "Yucatán":
                    $clave="YC";
                    $prefijo = 83;
                    break;
            case "Zacatecas":
                    $clave="ZC";
                    $prefijo = 93;
                    break;
            default:
                    $clave="EX";
                    $prefijo = 57;
                    break;
        }
        switch ($tipo) {
            case "D":
                    $posfijo = 4;
                    break;
            case "P":
                    $posfijo = 7;
                    break;
            case "R":
                    $posfijo = 9;
                    break;
            case "S":
                    $posfijo = 2;
                    break;
        }
        $num="";
        for($x=0; $x < 6-strlen($id); $x++){
            $clave = $clave."0";
            $num = $num."0";
        }      
        $clave = $clave.$id;
        $referencia = $prefijo.$num.$id.$posfijo;
        $ref = str_split ($referencia);
        $alg = str_split ("212121212");
        $mult = array();
        $ver = 0; 
        for ($x = 0; $x < 9; $x++){
            $mult[$x] = $ref[$x] * $alg[$x];
            if ($mult[$x] > 9){
                $dig = str_split($mult[$x]);
                $mult[$x] = $dig[0] + $dig[1];
            }
            $ver += $mult[$x];
            }
        $Y = fmod($ver, 10);
        if($Y>0)
            $Y=10-$Y;
        $clave = $clave.$tipo.$Y;
        return $clave;
    }
}
