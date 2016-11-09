<?php

namespace MegaSalud\Http\Controllers;

use Illuminate\Http\Request;

use MegaSalud\Http\Requests;

use MegaSalud\Http\Controllers\Controller;

use MegaSalud\Producto;

use MegaSalud\Sucursal;

use Laracasts\Flash\Flash;

use MegaSalud\Http\Requests\ProductoSucursalRequest;

class ProductosSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal_id=1;//obtenido de la sesión
        $sucursal=Sucursal::find($sucursal_id);
        $productos=$sucursal->producto_sucursal;
        return view('sucursal.productos.list')->with('productos',$productos);
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
    public function store(ProductoSucursalRequest $request)
    {
        $sucursal=1;//obtenida de la sesión
        $sucursal=Sucursal::find($sucursal);
        $producto=Producto::find($request->producto_id);
        $antiguo=$producto->producto_sucursal->find($sucursal)->pivot->existencia;
        $sucursal->producto_sucursal()->updateExistingPivot($request->producto_id,['existencia'=>$antiguo+$request->existencia]);
        Flash::overlay('Se han agregado '.$request->existencia.' productos', 'Operación exitosa');
        return redirect()->route('sucursal.productos.index');
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
}
