@extends('main')
@section('title','Productos | Nuevo')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.productos.store', 'method'=>'POST']) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Nuevo Producto</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
	    	<div class="input-field">
                <i class="material-icons prefix">account_circle</i>
	    		{!! Form::label('nombre','Nombre') !!}
    			{!! Form::text('nombre', null, ['class'=>'validate','required']) !!}
	    	</div>	
            <div class="input-field">
                <i class="material-icons prefix">mode_edit</i>
                {!! Form::label('descripcion','Descripción') !!}
                {!! Form::textarea('descripcion', null, ['class'=>'materialize-textarea','required']) !!}
            </div> 
            <div class="input-field">
                <i class="material-icons prefix">payment</i>
                {!! Form::label('precio','Precio') !!}
                {!! Form::number('precio', null, ['class'=>'validate','required']) !!}
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