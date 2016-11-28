<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use Laracasts\Flash\Flash;

use MegaSalud\User;

use MegaSalud\Sucursal;

use MegaSalud\Http\Controllers\Controller;

class MedicosSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $medicos=User::where('tipo_usuario', '=', 'Medico')->where(function($query){ $query->where('status', 1);})->orderBy('nombre','ASC')->paginate(10);
      return view('sucursal.medicos.list')->with('medicos',$medicos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = Sucursal::all()->pluck('razon_social', 'id');
        return view('sucursal.medicos.create')->with('sucursales', $sucursales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medico = User::find($id);

        if(!empty($medico->telefono_a)) {

            $medico->telefono_a="(".substr($medico->telefono_a, 0, 3).") ".substr($medico->telefono_a, 3, 3)."-".substr($medico->telefono_a,6);

            if(!empty($medico->telefono_b)) {

                $medico->telefono_b=" | (".substr($medico->telefono_b, 0, 3).") ".substr($medico->telefono_b, 3, 3)."-".substr($medico->telefono_b,6);
            }
        }elseif(!empty($medico->telefono_b)){
            $medico->telefono_b="(".substr($medico->telefono_b, 0, 3).") ".substr($medico->telefono_b, 3, 3)."-".substr($medico->telefono_b,6);
        }else{
            $medico->telefono_a = "N/A";
        }
        
        return json_encode($medico);
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
        $medico = User::find($id);
        $medico->status = 0;
        if($medico->save()) {
            Flash::overlay('Se ha eliminado ' . $medico->nombre . ' de forma exitosa', 'Operación exitosa');
        } else {
            Flash::overlay('Ha ocurrido un erro al eliminar al médico ' . $medico->nombre, 'Error');
        }

        return redirect()->route('sucursal.medicos.index');
    }

    public function busqueda(Request $req){
      $data=$req->data;
      $data=explode(" ",trim($data));
      $medicos = User::where('tipo_usuario', '=', 'Medico')->where(function($query) use ($data) {
        foreach ($data as $dato) {
          $query->where('users.nombre', 'like', '%'.$dato.'%')
          ->orwhere('users.apellido_p', 'like', '%'.$dato.'%')
          ->orwhere('users.apellido_m', 'like', '%'.$dato.'%')
          ->orwhere('users.id', 'like', '%'.$dato.'%')
          ->orwhere('users.especialidad', 'like', '%'.$dato.'%')
          ->orwhere('users.clave_bancaria', 'like', '%'.$dato.'%');
        }
      })->orderBy('nombre', 'DESC')
      ->paginate(10);
      return view('sucursal.medicos.list')->with('medicos',$medicos);
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
  }
