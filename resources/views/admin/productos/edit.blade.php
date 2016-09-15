@extends('main')
@section('title','Productos | Editar')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>['admin.productos.update',$producto->id], 'method'=>'PUT']) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Editar Producto</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
	    	<div class="input-field">
                <i class="material-icons prefix">account_circle</i>
	    		{!! Form::label('name','Nombre') !!}
    			{!! Form::text('nombre', $producto->nombre, ['class'=>'validate','required']) !!}
	    	</div>	
            <div class="input-field">
                <i class="material-icons prefix">mode_edit</i>
                {!! Form::label('desc','Descripción') !!}
                {!! Form::textarea('descripcion', $producto->descripcion, ['class'=>'materialize-textarea','required']) !!}
            </div> 
            <div class="input-field">
                <i class="material-icons prefix">payment</i>
                {!! Form::label('cost','Precio') !!}
                {!! Form::number('precio', $producto->precio, ['class'=>'validate','required']) !!}
            </div>
            <div class="input-field center-align">
                {!! Form::submit('Editar',['class'=>'btn waves-effect waves-light']) !!}
            </div>
    	</div>
    </div>
    {!! Form::close() !!}
@endsection