<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use MegaSalud\Pedido;

use MegaSalud\Producto;

use MegaSalud\Paciente;

use megaSalud\Sucursal;

use Carbon\Carbon;

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
        //dd($request->session());
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
        $request->session()->put('paciente',$request->paciente_id);//seteado del id del usuario en la variable de sesion
        //$x=Producto::count();//numero de productos
        $suma=0;
        $impuesto=0.15;//porcentaje de impuesto a cobrar
        $importe=0;
        $paciente=Paciente::find($request->paciente_id);
        $sucursal=$paciente->users[0]->sucursales[0]->id;
        $sucursal=Sucursal::find($sucursal);
        foreach($sucursal->producto_sucursal as $producto){
            $id_producto=$producto->id;
            $suma+=$request[$id_producto];
            $importe+=$request[$id_producto]*$producto->precio;
            $existencia=$producto->pivot->existencia;
            if($request->$id_producto<=$existencia){
                $bandera=true;
                $request->session()->put("$id_producto",$request[$id_producto]);//seteado de productos con cantidades en variable de sesion
            }
            else{
                $bandera=false;
                break;
            }
        }
        // Se guardar los valores en la variable de sesion y en la variable request para enviar a la vista
        $request->session()->put('importe',$importe);
        $total=($impuesto*$importe)+$importe;
        $request->session()->put('impuesto',$impuesto*$importe);
        $request->session()->put('total',$total);
        $request->importe=$importe;
        $request->impuesto=$impuesto*$importe;
        $request->total=$total;
        //$request->session()->flush();
        if($suma>0){//comprobar que al menos se haya seleccionado un producto
            if($bandera){//comprobar si excede limite de inventarios
                $paciente=Paciente::find($request->paciente_id);
                $productos=Producto::all();
                return view('admin.pedidos.forma_pago')->with('paciente',$paciente)->with('productos',$productos)->with('lista',$request);
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
    public function confirmacion(Request $request){
        //confirmación de pedido
        //Almacenamento de la información para el pedido
        $codigo_confirmacion="XXXXX";//Realizar método para cuando es en efectivo y cuando es 
        $detalle=$request->detalle;
        $metodo=$request->metodo;
        $importe=session("importe");
        $impuesto=session("impuesto");
        $total=session("total");
        $paciente=Paciente::find(session("paciente"));
        //creando pedido
        $pedido=new Pedido();
        $pedido->paciente_id=session("paciente");
        $pedido->user_id=$paciente->users[0]->id;
        $pedido->importe=$importe;
        $pedido->impuesto=$impuesto;
        $pedido->total=$total;
        $pedido->metodo=$metodo;
        $pedido->detalle=$detalle;
        $tiempo=Carbon::now();//objeto para obtener la fecha y hora actual
        $pedido->fecha_pedido=$tiempo;
        $sucursal=$paciente->users[0]->sucursales[0]->id;
        switch($metodo){
            case "Efectivo":
            case "Tarjeta":
                $pedido->status=2;//estado de pagado en casod e ser efectivo o tarjeta. Ya que hasta este punto ya debe estar aprobado
                $pedido->confirmacion=$codigo_confirmacion;
                $pedido->fecha_pago=$tiempo;
                break;
            default:
                $pedido->status=1;//pago en espera
        }
        if($pedido->save()){//guardando pedido
            $pedido=Pedido::where('fecha_pedido',$tiempo)
                            ->where('paciente_id',$paciente->id)->get();
            $sucursal=Sucursal::find($sucursal);
            foreach ($sucursal->producto_sucursal as $producto){
                //dd($producto->pivot->existencia);
                if(session()->has($producto->id)){//comprobamos que el producto este en el carrito
                    $actual=$producto->pivot->existencia;
                    if($producto->producto_sucursal()->updateExistingPivot($sucursal->id,['existencia'=>$actual-session($producto->id)])){//se realiza la reducción del inventario del producto
                        $producto->pedidos()->attach($pedido[0]->id,['cantidad'=>session($producto->id)]);// se crea el registro del producto a su respectivo pedido
                    }

                }
            }
            return view('admin.pedidos.confirmar')->with('pedido',$pedido[0]);
        }
        else{//si no se guarda el pedido
            Flash::overlay('No fue posible crear el pedido', '¡Ocurrio un problema!');
            return redirect()->route("admin.pedidos.craete");
        }     
    }

    public function productos($request){
        $paciente=Paciente::find($request);
        $sucursal=$paciente->users[0]->sucursales[0]->id;
        return json_encode($paciente->users[0]->sucursales[0]->producto_sucursal);
    }
}
