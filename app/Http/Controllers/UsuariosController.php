<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\User;

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
        return view('admin.usuarios.create');
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
