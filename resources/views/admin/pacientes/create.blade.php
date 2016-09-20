@extends('main')
@section('title','Pacientes | Nuevo')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.productos.store', 'method'=>'POST']) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Nuevo Paciente</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
	    	<div class="input-field">
                <i class="material-icons prefix">account_circle</i>
	    		{!! Form::label('name','Nombre') !!}
    			{!! Form::text('nombre', null, ['class'=>'validate','required']) !!}
	    	</div>	
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                {!! Form::label('apellido_paterno','Apellido Paterno') !!}
                {!! Form::text('apellido_p', null, ['class'=>'validate','required']) !!}
            </div>
            <div class="input-field">
                <i class="material-icons prefix">account_circle</i>
                {!! Form::label('apellido_materno','Apellido Materno') !!}
                {!! Form::text('apellido_m', null, ['class'=>'validate','required']) !!}
            </div>
            <div class="input-field">
                <i class="material-icons prefix">perm_contact_calendar</i>
                {!! Form::label('fecha_nacimiento','Fecha de Nacimiento') !!}
                {!! Form::date('fecha_nacimiento', null, ['class'=>'datepicker','required']) !!}
            </div> 
            <div class="input-field">
                <i class="material-icons prefix">perm_contact_calendar</i>                
                {!! Form::select('sexo',['Masculino'=>'Masculino','Femenino'=>'Femenino'],null,['class'=>'select-dropdown']) !!}
                {!! Form::label('sexo','Sexo') !!}
            </div>
            <div class="input-field">
                <i class="material-icons prefix">textsms</i>
                {!! Form::label('País_o','País de Origen') !!}
                {!! Form::text('pais_o',null,['class'=>'autocomplete','id'=>'pais_o']) !!}
            </div>
            <div class="input-field">
                <i class="material-icons prefix">textsms</i>
                {!! Form::label('Estado_o','Estado de Origen') !!}
                {!! Form::text('estado_o',null,['class'=>'autocomplete','id'=>'estado_o']) !!}
            </div>
            <div class="input-field">
                <i class="material-icons prefix">textsms</i>
                {!! Form::label('Ciudad_o','Ciudad de Origen') !!}
                {!! Form::text('ciudad_o',null,['class'=>'autocomplete','id'=>'ciudad_o']) !!}
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
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
        $(document).ready(function() {
            $('select').material_select();
        });
        $.get('{!! route('admin.pacientes.pais') !!}').done(function(datos){
            $('#pais_o.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
        });
        $.get('{!! route('admin.pacientes.estado') !!}').done(function(datos){
            $('#estado_o.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
            alert(datos);
        });
        $.get('{!! route('admin.pacientes.ciudad') !!}').done(function(datos){
            $('#ciudad_o.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
        });
@endsection