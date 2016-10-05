@extends('main')
@section('title','Pedidos | Nuevo')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.productos.store', 'method'=>'POST']) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Nuevo Pedido</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
	    	<div class="row">
                <div class="left-align col l6">
                    <h5>Paciente</h5>
                </div>
                <div class="col l6 input-field">
                    <i class="material-icons prefix">search</i>
                    {!! Form::text('busqueda', null, ['class'=>'validate']) !!}
                    <label for="icon_prefix2">Buscar paciente</label>
                </div>      
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