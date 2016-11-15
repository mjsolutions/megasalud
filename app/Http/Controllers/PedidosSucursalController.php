<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use MegaSalud\Producto;

use MegaSalud\Sucursal;

use MegaSalud\Pedido;

use Laracasts\Flash\Flash;

use Illuminate\Support\Facades\DB;

class PedidosSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal=2;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
