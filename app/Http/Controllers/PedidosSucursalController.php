<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use MegaSalud\Producto;

use MegaSalud\Sucursal;

use MegaSalud\Pedido;

use MegaSalud\Paciente;

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
    public function index()
    {
        $sucursal=1;
        $pedidos=DB::table('pedidos')
                        ->join('users','users.id','=','pedidos.user_id')
                        ->join('user_sucursal','user_sucursal.user_id','=','users.id')
                        ->join('pacientes','pacientes.id','=','pedidos.paciente_id')
                        ->select('pedidos.id','pacientes.nombre','pacientes.apellido_p','pacientes.apellido_m','pedidos.fecha_pedido','pedidos.status')
                        ->where('user_sucursal.sucursal_id',$sucursal)
                        ->orderBy('fecha_pedido','DESC')
                        ->paginate(10);
            return view('sucursal.pedidos.list')->with('pedidos',$pedidos);
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
                return view('sucursal.pedidos.forma_pago')->with('paciente',$paciente)->with('productos',$productos)->with('lista',$request);
            }
            else{
                Flash::overlay('No debes exceder el limite de productos en inventario', '¡Ocurrio un problema!');
                return redirect()->route('sucursal.pedidos.create');
            }
            
        }
        else{
            Flash::overlay('Debes agregar al menos un producto', '¡Ocurrio un problema!');
            return redirect()->route('sucursal.pedidos.create');
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
                if(session()->has($producto->id)&&session($producto->id)>0){//comprobamos que el producto este en el carrito
                    $actual=$producto->pivot->existencia;
                    if($producto->producto_sucursal()->updateExistingPivot($sucursal->id,['existencia'=>$actual-session($producto->id)])){//se realiza la reducción del inventario del producto
                        $producto->pedidos()->attach($pedido[0]->id,['cantidad'=>session($producto->id)]);// se crea el registro del producto a su respectivo pedido
                    }

                }
            }
            return view('sucursal.pedidos.confirmar')->with('pedido',$pedido[0]);
        }
        else{//si no se guarda el pedido
            Flash::overlay('No fue posible crear el pedido', '¡Ocurrio un problema!');
            return redirect()->route("sucursal.pedidos.craete");
        }     
    }
    public function busqueda_index(Request $request)
    {
        $sucursal=1;
        $data=$request->data;
         $pedidos=DB::table('pedidos')
                        ->join('users','users.id','=','pedidos.user_id')
                        ->join('user_sucursal','user_sucursal.user_id','=','users.id')
                        ->join('pacientes','pacientes.id','=','pedidos.paciente_id')
                        ->select('pedidos.id','pacientes.nombre','pacientes.apellido_p','pacientes.apellido_m','pedidos.fecha_pedido','pedidos.status')
                        ->where('user_sucursal.sucursal_id',$sucursal)
                        ->orwhere('pacientes.apellido_p','like','%'.$data.'%')
                        ->orwhere('pacientes.apellido_m','like','%'.$data.'%')
                        ->orwhere('pacientes.id','like','%'.$data.'%')
                        ->orwhere('pacientes.clave_bancaria','like','%'.$data.'%')
                        ->orderBy('fecha_pedido','DESC')
                        ->paginate(10);
                        dd($pedidos);
            return view('sucursal.pedidos.list')->with('pedidos',$pedidos);
    }
}
