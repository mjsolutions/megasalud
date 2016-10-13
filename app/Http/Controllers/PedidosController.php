<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use MegaSalud\Pedido;

use MegaSalud\Producto;

use MegaSalud\Paciente;

use Laracasts\Flash\Flash;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $pedidos=Pedido::orderBy("fecha_pedido","asc")->paginate(10);
        return view('admin.pedidos.list')->with("pedidos",$pedidos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos=Producto::all();
        return view('admin.pedidos.create')->with("productos",$productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->session());
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
    public function busqueda_pacientes($data)
    {
        $pacientes=Paciente::where('nombre','like',$data.'%')
                    ->orwhere('apellido_p','like',$data.'%')
                    ->orwhere('apellido_m','like',$data.'%')
                    ->orwhere('id','like',$data.'%')
                    ->orwhere('clave_bancaria','like',$data.'%')
                    ->take(10)
                    ->get();
        foreach ($pacientes as $paciente) {
            $paciente->users;
            $paciente->users[0]->sucursales;
        }
        return json_encode($pacientes);
    }
    public function forma_pago(Request $request){
        $request->session()->reflash();
        $request->session()->put('producto',$request->paciente_id);
        $x=Producto::count();//numero de productos
        $suma=0;
        for($i=1;$i<=$x;$i++){
            $suma+=$request->$i;
            $producto=Producto::find($i);
            $existencia=$producto->producto_sucursal[0]->pivot->existencia;
            if($request->$i<=$existencia)
                $bandera=true;
            else{
                $bandera=false;
                break;
            }
        }
        if($suma>0){
            if($bandera){
                $paciente=Paciente::find($request->paciente_id);
                $productos=Producto::all();
                return view('admin.pedidos.forma_pago')->with('pacientes',$paciente)->with('productos',$productos);
            }
            else{
                Flash::overlay('No debes exceder el limite de productos en inventario', '¡Ocurrio un problema!');
                return redirect()->route('admin.pedidos.create');
            }
            
        }
        else{
            Flash::overlay('Debes agregar al menos un producto', '¡Ocurrio un problema!');
            return redirect()->route('admin.pedidos.create');
        }
    }
}
