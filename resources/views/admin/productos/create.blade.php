@extends('main')
@section('title','Productos | Nuevo')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.productos.store', 'method'=>'POST']) !!}
    <div class="container">
    	<div class="card-panel">
	    	<div class="input-field">
	    		{!! Form::label('name','Nombre') !!}
    			{!! Form::text('name', null, ['class'=>'validate']) !!}
	    	</div>	

    	</div>
    </div>
    {!! Form::close() !!}
@endsection