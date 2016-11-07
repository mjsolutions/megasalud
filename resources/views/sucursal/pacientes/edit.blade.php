@extends('main')
@section('title','Pacientes | Editar')
@section('nav')
	@include('sucursal.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>['sucursal.pacientes.update',$paciente->id], 'method'=>'PUT','files'=>true]) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Editar Paciente</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <div class="row valign-wrapper">
                <div class="col s3 col-center">
                    @if($paciente->foto==null||$paciente->foto=="")
                        <img src="{{ asset('/images/user.jpg') }}" alt="" class="circle responsive-img">
                    @else
                        <img src="{{ asset('/images/paciente/'.$paciente->foto) }}" alt="" class="circle responsive-img">
                    @endif
                </div>
            </div>
            <div class="row left-align">
                <div class="col l12">
                  <h5>Datos Generales</h5>
                </div>
            </div>
            <div class="row">
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::label('nombre','Nombre') !!}
                        {!! Form::text('nombre',$paciente->nombre, ['class'=>'validate','required']) !!}
                    </div>  
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::label('apellido_p','Apellido Paterno') !!}
                        {!! Form::text('apellido_p', $paciente->apellido_p, ['class'=>'validate','required']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::label('apellido_m','Apellido Materno') !!}
                        {!! Form::text('apellido_m', $paciente->apellido_m, ['class'=>'validate','required']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">perm_contact_calendar</i>
                        {!! Form::label('fecha_nacimiento','Fecha de Nacimiento') !!}
                        {!! Form::date('fecha_nacimiento', $paciente->fecha_nacimiento, ['class'=>'datepicker','required']) !!}
                    </div> 
                </div>
                <div class="col l4">
                    <div class="input-field">
                        @if($paciente->sexo=="Masculino")
                            {!! Form::radio('sexo','Masculino',true,['id'=>'sexo1','class'=>'with-gap']) !!}
                            {!! Form::label('sexo1','Masculino') !!}
                            {!! Form::radio('sexo','Femenino',false,['id'=>'sexo2','class'=>'with-gap']) !!}
                            {!! Form::label('sexo2','Femenino') !!}
                        @else
                            {!! Form::radio('sexo','Masculino',false,['id'=>'sexo1','class'=>'with-gap']) !!}
                            {!! Form::label('sexo1','Masculino') !!}
                            {!! Form::radio('sexo','Femenino',true,['id'=>'sexo2','class'=>'with-gap']) !!}
                            {!! Form::label('sexo2','Femenino') !!}
                        @endif              
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">textsms</i>
                        {!! Form::label('email','Email') !!}
                        {!! Form::email('email',$paciente->email,['class'=>'validate']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l6">
                    <div class="input-field">
                        <i class="material-icons prefix">phone</i>
                        {!! Form::label('telefono_a','Telefono 1') !!}
                        {!! Form::number('telefono_a',$paciente->telefono_a,['class'=>'validate']) !!}
                    </div>
                </div>
                <div class="col l6">
                    <div class="input-field">
                        <i class="material-icons prefix">phone</i>
                        {!! Form::label('telefono_b','Telefono 2') !!}
                        {!! Form::number('telefono_b',$paciente->telefono_b,['class'=>'validate']) !!}
                    </div>
                </div>
            </div>
            <div class="row left-align">
                <div class="col l12">
                  <h5>Contacto</h5>
                </div>
            </div>
            <div class="row">
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">textsms</i>
                        {!! Form::label('pais_o','País de Origen') !!}
                        {!! Form::text('pais_o',$paciente->pais_o,['class'=>'autocomplete','id'=>'pais_o']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">textsms</i>
                        {!! Form::label('estado_o','Estado de Origen') !!}
                        {!! Form::text('estado_o',$paciente->estado_o,['class'=>'autocomplete','id'=>'estado_o']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">textsms</i>
                        {!! Form::label('municipio_o','Municipio de Origen') !!}
                        {!! Form::text('municipio_o',$paciente->municipio_o,['class'=>'autocomplete','id'=>'municipio_o']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">textsms</i>
                        {!! Form::label('pais','País') !!}
                        {!! Form::text('pais',$paciente->pais,['class'=>'autocomplete','id'=>'pais']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">textsms</i>
                        {!! Form::label('estado','Estado') !!}
                        {!! Form::text('estado',$paciente->estado,['class'=>'autocomplete','id'=>'estado']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">textsms</i>
                        {!! Form::label('municipio','Municipio') !!}
                        {!! Form::text('municipio',$paciente->municipio,['class'=>'autocomplete','id'=>'municipio']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">my_location</i>
                        {!! Form::label('direccion','Dirección') !!}
                        {!! Form::text('direccion',$paciente->direccion,['class'=>'validate']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">my_location</i>
                        {!! Form::label('colonia','Colonia') !!}
                        {!! Form::text('colonia',$paciente->colonia,['class'=>'validate']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">my_location</i>
                        {!! Form::label('cp','Código Postal') !!}
                        {!! Form::text('cp',$paciente->cp,['class'=>'validate']) !!}
                    </div>
                </div>
            </div>
            <div class="row left-align">
                <div class="col l12">
                  <h5>Información adicional</h5>
                </div>
            </div>
            <div class="row">
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">perm_identity</i>
                        {!! Form::label('curp','CURP') !!}
                        {!! Form::text('curp',$paciente->curp,['class'=>'validate']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">perm_identity</i>
                        {!! Form::label('rfc','RFC') !!}
                        {!! Form::text('rfc',$paciente->rfc,['class'=>'validate']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::label('religion','Religión') !!}
                        {!! Form::text('religion',$paciente->religion,['class'=>'validate']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">group_work</i>
                        {!! Form::label('ocupacion','Ocupación') !!}
                        {!! Form::text('ocupacion',$paciente->ocupacion,['class'=>'validate']) !!}
                    </div>
                </div>
                <div class="col l4">
                    <div class="input-field">
                        <i class="material-icons prefix">perm_identity</i>
                        {!! Form::select('medico',$medicos,$paciente->users[0]->id,['id'=>'medico','placeholder'=>'Elige un médico']) !!}
                        <input type="hidden" id="medico_id" value="">
                    </div>
                </div>
            </div>
            <div class="input-field file-field">
                <div class="btn">
                    <span>
                        Fotografía        
                    </span>
                    {!! Form::file('foto') !!}
                </div>
                <div class="file-path-wrapper">
                    {!! Form::text('foto_1',null,['class'=>'file-path validate','placeholder'=>'Selecciona un fotografía']) !!}
                </div>
            </div>
            
            <div class="input-field center-align">
                {!! Form::submit('Editar',['class'=>'btn waves-effect waves-light']) !!}
            </div>
    	</div>
    </div>
    {!! Form::close() !!}
    {!! Form::open(['route'=>['admin.pacientes.medico',':USER_ID'], 'method'=>'GET','id'=>'form']) !!}
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
        $('select').material_select();
        $.get('{!! route('admin.pacientes.pais') !!}').done(function(datos){
            $('#pais_o.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
        });
        $.get('{!! route('admin.pacientes.estado') !!}').done(function(datos){
            $('#estado_o.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
        });
        $.get('{!! route('admin.pacientes.ciudad') !!}').done(function(datos){
            $('#municipio_o.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
        $.get('{!! route('admin.pacientes.pais') !!}').done(function(datos){
            $('#pais.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
        });
        $.get('{!! route('admin.pacientes.estado') !!}').done(function(datos){
            $('#estado.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
        });
        $.get('{!! route('admin.pacientes.ciudad') !!}').done(function(datos){
            $('#municipio.autocomplete').autocomplete({
            data:JSON.parse(datos)
            });
        });
        });
@endsection