<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\User;

use MegaSalud\Sucursal;

use MegaSalud\Http\Requests;

use MegaSalud\Http\Controllers\Controller;

use Laracasts\Flash\Flash;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use MegaSalud\Http\Requests\UserRequest;

use MegaSalud\Http\Requests\CPRequest;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios=User::where('status',1)->orderBy('nombre','ASC')->paginate(10);
        return view('admin.usuarios.list')->with('usuarios',$usuarios);
        // $suc = Sucursal::find($usuarios[1]->id);
        // dd($usuarios[6]->sucursales[0]->razon_social);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = Sucursal::all()->pluck('razon_social', 'id');
        // dd($sucursales);
        return view('admin.usuarios.create')->with('sucursales', $sucursales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {   
        $validate = false;

        DB::beginTransaction();

        try {

            $usuario = new User($request->all());
            $usuario->password = bcrypt($usuario->password);         
            if($usuario->save()){
                $tipo = "";
                switch($usuario->tipo_usuario){
                    case "Administrador":
                        $tipo = "A";
                        break;
                    case "Administrador de sucursal":
                        $tipo = "S";
                        break;
                    case "Medico":
                        $tipo = "D";
                        break;
                }
                $usuario->clave_bancaria = UsuariosController::clave($usuario->estado, $usuario->id, $tipo);
                $usuario->save();
            }

            if($request->has("sucursal")) {
                $id = $request->sucursal;
                // dd($id);
                // $sucursal = Sucursal::find($id);            
                $usuario->sucursales()->attach($id);
                $validate = true;
            }else {
                $validate = true;
            }

            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollBack();
            $validate = false;
            $fail = $e;
            // throw $e;
        }        


        if($validate) {
            Flash::overlay('Se ha registrado '.$usuario->nombre.' de forma exitosa.', 'Alta exitosa');
        }else{
            Flash::overlay('Ha ocurrido un error al registrar al usuario  '.$usuario->nombre." : ".$fail, 'Error');            
        }

        
        return redirect()->route('admin.usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);

        if(!empty($usuario->telefono_a)) {

            $usuario->telefono_a="(".substr($usuario->telefono_a, 0, 3).") ".substr($usuario->telefono_a, 3, 3)."-".substr($usuario->telefono_a,6);

            if(!empty($usuario->telefono_b)) {

                $usuario->telefono_b=" | (".substr($usuario->telefono_b, 0, 3).") ".substr($usuario->telefono_b, 3, 3)."-".substr($usuario->telefono_b,6);
            }
        }elseif(!empty($usuario->telefono_b)){
            $usuario->telefono_b="(".substr($usuario->telefono_b, 0, 3).") ".substr($usuario->telefono_b, 3, 3)."-".substr($usuario->telefono_b,6);
        }else{
            $usuario->telefono_a = "N/A";
        }

        
        return json_encode($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        //si es administrador de sucursal se busca las sucursales que aun no tengan admin
        if($usuario->tipo_usuario == "Administrador de sucursal"){
            $sucursal = UsuariosController::adminsucursal();
            $sucursal[$usuario->sucursales[0]->id] = $usuario->sucursales[0]->razon_social;
        }else{
            $sucursal = UsuariosController::medicos();
        }
        
        //compact pasa las variables con sus nombres sin necesidad de referenciarlas
        //es lo mismo que hacer whth(array ('usuario'=>$usuario, 'sucursal'=>$sucursal))
        return view('admin.usuarios.edit', compact('usuario', 'sucursal'));
        // return view('admin.usuarios.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {   
        $validate = false;

        DB::beginTransaction();

        try {

            $usuario = User::find($id);
            $usuario->fill($request->all());
            if ($usuario->save()) {

               if($usuario->sucursales->isEmpty()){
                    //no tiene asociada sucursal aun y se envio registro
                    if($request->has("sucursal")){
                        $id = $request->sucursal;            
                        $usuario->sucursales()->attach($id);                    
                    }

                }else{
                    //tiene sucursal asociada y cambio a Administrador                    
                    if($request->tipo_usuario == "Administrador"){
                        //eliminar registro

                        $usuario->sucursales()->detach($usuario->sucursales[0]->id);

                    }else{
                        //ya tiene sucursal asociada y el id enviado es diferente
                        if($usuario->sucursales[0]->id != $request->sucursal){
                            //update a registro
                            $usuario->sucursales()->updateExistingPivot($request->sucursal);

                        }
                    }

                }
                $validate = true;

            }else{
                $validate = false;
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $validate = false;
            $fail = $e;
            // throw $e;
        }

        if($validate) {
            Flash::overlay('Se ha actualizado '.$usuario->nombre.' de forma exitosa.', 'Modificación exitosa');
        }else{
            Flash::overlay('Ha ocurrido un error al actualizar al usuario  '.$usuario->nombre." : ".$fail, 'Error');            
        }
        
        return redirect()->route('admin.usuarios.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->status = 0;
        if($usuario->save()) {
            Flash::overlay('Se ha eliminado ' . $usuario->nombre . ' de forma exitosa', 'Operación exitosa');
        } else {
            Flash::overlay('Ha ocurrido un erro al eliminar al paciente ' . $usuario->nombre, 'Error');
        }

        return redirect()->route('admin.usuarios.index');
    }

    public function pais()
    {
        $paises=DB::table('users')->select('pais')->distinct()->get();
        $data=array();
        foreach ($paises as $pais => $value) {
            $data[$value->pais]=null;
        }
        return json_encode($data);
    }

    public function estado()
    {
        $estados=DB::table('users')->select('estado')->distinct()->get();
        $data=array();
        foreach ($estados as $estado => $value) {
            $data[$value->estado]=null;
        }
        return json_encode($data);
    }

    public function municipio()
    {
        $municipios=DB::table('users')->select('municipio')->distinct()->get();
        $data=array();
        foreach ($municipios as $municipio => $value) {
            $data[$value->municipio]=null;
        }
        return json_encode($data);
    }

    public function banco() {
        $bancos = DB::table('users')->select('banco')->distinct()->get();
        $data = array();
        foreach ($bancos as $banco => $value) {
            $data[$value->banco] = null;
        }
        return json_encode($data);
    }

    public function medicos() {
        return Sucursal::all()->pluck('razon_social', 'id');
    }

    public function adminsucursal() {
        //regresar los id y nombre de las sucursales que aun no tienen administrador asignado
        
        return DB::table('sucursales')->select('id', 'razon_social')->whereNotIn('id', DB::table('user_sucursal')->join('users', 'users.id', '=', 'user_sucursal.user_id')->select('user_sucursal.sucursal_id')->where('users.tipo_usuario', '=', 'Administrador de sucursal'))->pluck('razon_social','id');
    }

    public function adminsucursal_edit($id){
        //buscar el usuario para saber si regresar la sucursal que es admin actual o solo la lista de sucursales
        //en caso de no ser admin de sucursal acutalmente
        $usuario = User::find($id);
        if($usuario->tipo_usuario == "Administrador de sucursal"){
             //regresar los id y nombre de las sucursales que aun no tienen administrador asignado mas la sucursal del id que se recibe en caso de ser admin de sucursal
            $sucursal = DB::table('sucursales')->select('id', 'razon_social')->whereNotIn('id', DB::table('user_sucursal')->join('users', 'users.id', '=', 'user_sucursal.user_id')->select('user_sucursal.sucursal_id')->where('users.tipo_usuario', '=', 'Administrador de sucursal'))->pluck('razon_social','id');

            $sucursal[$usuario->sucursales[0]->id] = $usuario->sucursales[0]->razon_social;
        }else {
            //regresar los id y nombre de las sucursales que aun no tienen administrador asignado
            $sucursal = DB::table('sucursales')->select('id', 'razon_social')->whereNotIn('id', DB::table('user_sucursal')->join('users', 'users.id', '=', 'user_sucursal.user_id')->select('user_sucursal.sucursal_id')->where('users.tipo_usuario', '=', 'Administrador de sucursal'))->pluck('razon_social','id');

        }

        return $sucursal;
    }

    public function change_password(CPRequest $req){
        $usuario = User::find($req->id);
        $route = "";
        //Comprobrar que coincida contraseña de administrador
        if( Hash::check($req->password_admin, Auth::user()->password)){
            $usuario->password = bcrypt($req->password);
            if($usuario->save()){
                Flash::overlay('Cambio de contraseña exitoso', 'Exito');
            }else{
                Flash::overlay('A ocurrido un error, intentelo de nuevo mas tarde ', 'Error');
            }
            $route = "admin.usuarios.index";
        }else{
            Flash::overlay('Contraseña de administrador incorrecta', 'Error');
        }

        $route = "admin.usuarios.index";

        if($req->id == Auth::user()->id){
            $route = "logout";
             //Flash::overlay('Cambio de contraseña exitoso, vuelve a iniciar sesión', 'Exito');
        }

        return redirect()->route($route);
    }

    public function busqueda(Request $req){

        $data=$req->data;
        $data=explode(" ",trim($data));
        $usuarios = User::where(function($query) use ($data) {
                        foreach ($data as $dato) {
                            $query->where('users.nombre', 'like', '%'.$dato.'%')
                            ->orwhere('users.apellido_p', 'like', '%'.$dato.'%')
                            ->orwhere('users.apellido_m', 'like', '%'.$dato.'%')
                            ->orwhere('users.id', 'like', '%'.$dato.'%')
                            ->orwhere('users.tipo_usuario', 'like', '%'.$dato.'%')
                            ->orwhere('users.clave_bancaria', 'like', '%'.$dato.'%');
                        }
                    })->orderBy('nombre', 'DESC')
                    ->paginate(10);
        return view('admin.usuarios.list')->with('usuarios',$usuarios);
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
            case "D"://medico
                    $posfijo = 4;
                    break;
            case "P"://paciente
                    $posfijo = 7;
                    break;
            case "A"://administrador
                    $posfijo = 9;
                    break;
            case "S"://administrador sucursal
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
