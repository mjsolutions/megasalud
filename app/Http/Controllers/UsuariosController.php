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
                $usuario->clave_bancaria = claveBancaria($usuario->estado, $usuario->id, $tipo);
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
            Flash::overlay('Ha ocurrido un erro al eliminar al usuario ' . $usuario->nombre, 'Error');
        }

        return redirect()->route('admin.usuarios.index');
    }

    public function pais()
    {
        return userPaises();
    }

    public function estado()
    {
        return userEstados();
    }

    public function municipio()
    {
        return userMunicipios();
    }

    public function banco() {
        return userBanco();
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

}
