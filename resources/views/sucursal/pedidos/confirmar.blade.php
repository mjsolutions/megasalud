@extends('main')
@section('title','Confirmación de Pedido')
@section('nav')
	@include('sucursal.nav')
@endsection
@section('content')
    <div class="container">
    	<div class="card-panel">
            <div class="row">
                <div class="col push-s1 s10 center-align">
                    <h4>Confirmación de Pedido</h4>
                </div>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2  ">Nombre</span>
                </div>
                <div class="col l6">
                    {{$pedido->paciente->nombre.' '.$pedido->paciente->apellido_p.' '.$pedido->paciente->apellido_m}}
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Telefonos</span>
                </div>
                <div class="col l6">
                    {{"(".substr($pedido->paciente->telefono_a, 0, 3).") ".substr($pedido->paciente->telefono_a, 3, 3)."-".substr($pedido->paciente->telefono_a,6)}}
                    {{"(".substr($pedido->paciente->telefono_b, 0, 3).") ".substr($pedido->paciente->telefono_b, 3, 3)."-".substr($pedido->paciente->telefono_b,6)}}
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Correo electronico</span>
                </div>
                <div class="col l6">
                    {{$pedido->paciente->email}}
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Sucursal</span>
                </div>
                <div class="col l6">
                    {{$pedido->user->sucursales[0]->razon_social}}
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Fecha de compra</span>
                </div>
                <div class="col l6">
                    {{$pedido->fecha_pedido}}
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Fecha de pago</span>
                </div>
                <div class="col l6">
                    {{$pedido->fecha_pago}}
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Forma de pago</span>
                </div>
                <div class="col l6">
                    {{$pedido->metodo}}
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Código de confirmación</span>
                </div>
                <div class="col l6">
                    {{$pedido->confirmacion}}
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Detalles</span>
                </div>
                <div class="col l6">
                    <p>{{$pedido->detalle}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col l6 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2 ">Estado Actual</span>
                </div>
                <div class="col l6">
                    @if($pedido->status==1)
                        <b>En Espera</b>
                    @elseif($pedido->status==2)
                        <b>Pagado</b>
                    @else
                        <b>Cancelado</b>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <div class="row valign-wrapper">
                <div class="col l12 center-align">
                  <legend><h5 class="c-blue-grey">Lista de productos</h5></legend>
                </div>
            </div>
            <table class="responsive-table striped">
                <thead>
                  <tr>
                      <th data-field="quantity">Cantidad</th>
                      <th data-field="name">Producto</th>
                      <th data-field="price">Precio</th>
                      <th data-field="importe">Importe</th>
                  </tr>
                </thead>
                <tbody id="tabla">
                    @foreach($pedido->productos as $producto)
                        <tr>
                            <td>{{$producto->pivot->cantidad}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->precio}}</td>
                            <td>{{$producto->precio*$producto->pivot->cantidad}}</td>
                        <tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <div class="row">
                <div class="col l10 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2">Importe</span>
                </div>
                <div class="col l2 left-align" id="importe">
                    {{'$'.$pedido->importe}}
                </div>
            </div>
            <div class="row">
                <div class="col l10 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2">Impuesto</span>
                </div>
                <div class="col l2 left-align" id="impuesto">
                    {{'$'.$pedido->impuesto}}
                </div>
            </div>
            <div class="row">
                <div class="col l10 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2"><b>Total</b></span>
                </div>
                <div class="col l2 left-align" id="total">
                   <b> {{'$'.$pedido->total}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col l12 center-align">
                    <a  class="btn waves-effect waves-light" href="{{route('sucursal.pedidos.index')}}">Volver</a>
                </div>
            </div>
    	</div>
    </div>
@endsection