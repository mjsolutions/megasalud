<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use MegaSalud\Producto;

use MegaSalud\Sucursal;

use MegaSalud\Pedido;

use Laracasts\Flash\Flash;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class PedidosSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($data=0)
    {
        $sucursal=2;
        if($data){
            $pedidos=DB::table('pedidos')
                        ->join('users','users.id','=','pedidos.user_id')
                        ->join('user_sucursal','user_sucursal.user_id','=','users.id')
                        ->join('pacientes','pacientes.id','=','pedidos.paciente_id')
                        ->select('pedidos.id','pacientes.nombre','pacientes.apellido_p','pacientes.apellido_m','pedidos.fecha_pedido','pedidos.status')
                        ->where('user_sucursal.sucursal_id',$sucursal)
                        ->orwhere('pacientes.apellido_p','like',$data.'%')
                        ->orwhere('pacientes.apellido_m','like',$data.'%')
                        ->orwhere('pacientes.id','like',$data.'%')
                        ->orwhere('pacientes.clave_bancaria','like',$data.'%')
                        ->orderBy('fecha_pedido','DESC')
                        ->paginate(10);
            return view('sucursal.pedidos.list')->with('pedidos',$pedidos);
        }
        else{
            $pedidos=DB::table('pedidos')
                        ->join('users','users.id','=','pedidos.user_id')
                        ->join('user_sucursal','user_sucursal.user_id','=','users.id')
                        ->join('pacientes','pacientes.id','=','pedidos.paciente_id')
                        ->select('pedidos.id','pacientes.nombre','pacientes.apellido_p','pacientes.apellido_m','pedidos.fecha_pedido','pedidos.status')
                        ->where('user_sucursal.sucursal_id',$sucursal)
                        ->orderBy('fecha_pedido','DESC')
                        ->paginate(10);
            return view('sucursal.pedidos.list')->with('pedidos',$pedidos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursal=1;
        $productos=Producto::all();
        $pacientes=DB::table('pacientes')
                        ->join('paciente_user','paciente_user.paciente_id','=','pacientes.id')
                        ->join('users','users.id','=','paciente_user.user_id')
                        ->join('user_sucursal','userS.id','=','user_sucursal.user_id')
                        ->where('user_sucursal.user_id',$sucursal)
                        ->select('pacientes.id','pacientes.nombre','pacientes.apellido_p','pacientes.apellido_m','pacientes.telefono_a','pacientes.telefono_b')
                        ->get();
        return view('sucursal.pedidos.create')->with("productos",$productos)->with('pacientes',$pacientes);
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
        $pedidos=Pedido::find($id);
        $pedidos->productos;
        $pedidos->paciente;
        $pedidos->user;
        $pedidos->user->sucursales;
        $pedidos->paciente->telefono_a="(".substr($pedidos->paciente->telefono_a, 0, 3).") ".substr($pedidos->paciente->telefono_a, 3, 3)."-".substr($pedidos->paciente->telefono_a,6);
        $pedidos->paciente->telefono_b="(".substr($pedidos->paciente->telefono_b, 0, 3).") ".substr($pedidos->paciente->telefono_b, 3, 3)."-".substr($pedidos->paciente->telefono_b,6);
        setlocale(LC_MONETARY,'en_US');
        $pedidos->importe=money_format("%(#10n",$pedidos->importe);
        $pedidos->impuesto=money_format("%(#10n",$pedidos->impuesto);
        $pedidos->total=money_format("%(#10n",$pedidos->total);
        for($i=0;$i<sizeof($pedidos->productos);$i++)
            $pedidos->productos[$i]->precio=money_format('%(#10n',$pedidos->productos[$i]->precio);
        return json_encode($pedidos);
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
    public function estado(Request $request){
        $id=$request->pedido_id;
        $detalle=$request->detalle_m;
        $estado=$request->estado_m;
        $confirmacion=$request->confirmacion;
        $pedido=Pedido::find($id);
        if($pedido){//si existe el pedido se prosigue a guardar la información
            $pedido->detalle=$detalle;
            $pedido->status=$estado;
            $pedido->confirmacion=$confirmacion;
            $tiempo=Carbon::now();//objeto para obtener la fecha y hora actual
            $pedido->fecha_pago=$tiempo;
            if($pedido->save()){
                Flash::overlay('Operación existosa', '¡Alta Exitosa!');
                return redirect()->route('sucursal.pedidos.index');
            }
            else{
                Flash::overlay('No fue posible cambiar el estado del pedido', '¡Ocurrio un problema!');
                return redirect()->route("sucursal.pedidos.index");
            }
        }
        else{
            Flash::overlay('No fue posible encontrar el pedido solicitado', '¡Ocurrio un problema!');
            return redirect()->route("sucursal.pedidos.index");
        }
    }
    public function busqueda_pacientes($data)
    {
        $sucursal=2;
        $pacientes=DB::table('pacientes')
                        ->join('paciente_user','paciente_user.paciente_id','=','pacientes.id')
                        ->join('users','users.id','=','paciente_user.user_id')
                        ->join('user_sucursal','userS.id','=','user_sucursal.user_id')
                        ->where('user_sucursal.user_id',$sucursal)
                        ->orwhere('pacientes.status',1)
                        ->orwhere('pacientes.apellido_p','like',$data.'%')
                        ->orwhere('pacientes.apellido_m','like',$data.'%')
                        ->orwhere('pacientes.id','like',$data.'%')
                        ->orwhere('pacientes.clave_bancaria','like',$data.'%')
                        ->take(10)
                        ->select('pacientes.nombre','pacientes.apellido_p','pacientes.apellido_m','pacientes.id','pacientes.telefono_a','pacientes.telefono_b')
                        ->get();
        // $pacientes=Paciente::where('nombre','like',$data.'%')
        //             ->orwhere('apellido_p','like',$data.'%')
        //             ->orwhere('apellido_m','like',$data.'%')
        //             ->orwhere('id','like',$data.'%')
        //             ->orwhere('clave_bancaria','like',$data.'%')
        //             ->take(10)
        //             ->get();
        // foreach ($pacientes as $paciente) {
        //     $paciente->users;
        //     $paciente->users[0]->sucursales;
        // }
        return json_encode($pacientes);
    }
}
