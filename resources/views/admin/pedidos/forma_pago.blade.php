@extends('main')
@section('title','Pedidos | Forma de Pago')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.pedidos.store', 'method'=>'POST']) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Forma de pago</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <div class="row">
                <div class="col l12">
                    <nav>
                        <div class="nav-wrapper blue darken-1">
                          <div class="col s12">
                            <a href="{{ route('admin.pedidos.create') }}" class="breadcrumb">Generar Pedido</a>
                            <a href="#!" class="breadcrumb">Forma de Pago</a>
                          </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col l4 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2">Nombre</span>
                </div>
                <div class="col l8" id="nombre">
                
                </div>
            </div>
            <div class="row">
                <div class="col l4 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2">Telefonos</span>
                </div>
                <div class="col l8" id="telefonos">
                
                </div>
            </div>
            <div class="row">
                <div class="col l4 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2">Correo electronico</span>
                </div>
                <div class="col l8" id="mail">
                
                </div>
            </div>
            <div class="row">
                <div class="col l4 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2">Sucursal</span>
                </div>
                <div class="col l8" id="sucursal">
                
                </div>
            </div>

            <div class="input-field center-align">
                {!! Form::submit('Crear',['class'=>'btn waves-effect waves-light']) !!}
            </div>
    	</div>
    </div>
    {!! Form::close() !!}
@endsection
@section('scripts')
        @if($errors)
            @foreach($errors->all() as $error)
                Materialize.toast('{{ $error }}', 4000);
            @endforeach
        @endif
@endsection