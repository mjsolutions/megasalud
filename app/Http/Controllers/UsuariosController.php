<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\User;

use MegaSalud\Sucursal;

use MegaSalud\Http\Requests;

use MegaSalud\Http\Controllers\Controller;

use Laracasts\Flash\Flash;

use Illuminate\Support\Facades\DB;

use MegaSalud\Http\Requests\UserRequest;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = Sucursal::all()->lists('razon_social','id');
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
        $usuario = new User($request -> all());
        $usuario->password = bcrypt($usuario->password);
        if($usuario -> save()) {
            Flash::overlay('Se ha registrado '.$usuario->nombre.' de forma exitosa.', 'Alta exitosa');
        } else {
            Flash::overlay('Ha ocurrido un error al registrar al paciente  '.$usuario->nombre, 'Error');
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
        $usuario->telefono_a="(".substr($usuario->telefono_a, 0, 3).") ".substr($usuario->telefono_a, 3, 3)."-".substr($usuario->telefono_a,6);
        if(!empty($usuario->telefono_b)) {

            $usuario->telefono_b="/ (".substr($usuario->telefono_b, 0, 3).") ".substr($usuario->telefono_b, 3, 3)."-".substr($usuario->telefono_b,6);
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
        return view('admin.usuarios.edit')->with('usuario', $usuario);
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
        $usuario = User::find($id);
        $usuario->fill($request->all());//funcion para sustituir datos diferentes
        if ($usuario->save()) {//guardamos los cambios en la tabla de pacientes
            Flash::overlay('Se actualizó a  '.$usuario->nombre.' de forma exitosa.', 'Operación exitosa');
        }else{
            Flash::overlay('Ha ocurrido un error al editar al usuario  '.$usuario->nombre, 'Error');
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
}
