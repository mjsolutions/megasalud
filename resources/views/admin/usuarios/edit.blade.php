@extends('main')
@section('title','Usuarios | Editar')
@section('nav')
@include('admin.nav')
@endsection
@section('content')
{!! Form::open(['route'=>['admin.usuarios.update', $usuario->id], 'method'=>'PUT']) !!}
<div class="container">
  <div class="card-panel">
    <div class="center-align">
      <h3>Editar Usuario</h3>
    </div>

    <div class="row">
      <div class="col s8 col-center divider"></div>
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
          {!! Form::label('nombre','Nombre(s)') !!}
          {!! Form::text('nombre', $usuario->nombre, ['class'=>'validate','required']) !!}
        </div>      
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          {!! Form::label('apellido_p','Apellido paterno') !!}
          {!! Form::text('apellido_p', $usuario->apellido_p, ['class'=>'validate','required']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          {!! Form::label('apellido_m','Apellido materno') !!}
          {!! Form::text('apellido_m', $usuario->apellido_m, ['class'=>'validate','required']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l6">
        <div class="input-field">
          <i class="material-icons prefix">perm_contact_calendar</i>
          {!! Form::label('fecha','Fecha de nacimiento') !!}
          {!! Form::date('fecha', $usuario->fecha_nacimiento, ['class'=>'datepicker','required']) !!}
        </div>
      </div>

      <div class="col l6">
        <div class="input-fields">
          @if($usuario->sexo == "Masculino") 
            {!! Form::radio('sexo', 'Masculino', true, ['id' => 'sexo1', 'class' => 'with-gap']) !!}
            {!! Form::label('sexo1', 'Masculino') !!}
            {!! Form::radio('sexo', 'Femenino', false, ['id' => 'sexo2', 'class' => 'with-gap']) !!}
            {!! Form::label('sexo2', 'Femenino') !!}
          @else
            {!! Form::radio('sexo', 'Masculino', false, ['id' => 'sexo1', 'class' => 'with-gap']) !!}
            {!! Form::label('sexo1', 'Masculino') !!}
            {!! Form::radio('sexo', 'Femenino', true, ['id' => 'sexo2', 'class' => 'with-gap']) !!}
            {!! Form::label('sexo2', 'Femenino') !!}
          @endif
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
          {!! Form::label('pais','País') !!}
          {!! Form::text('pais', $usuario->pais,['class'=>'autocomplete validate','id'=>'pais']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('estado','Estado') !!}
          {!! Form::text('estado', $usuario->estado,['class'=>'autocomplete validate','id'=>'estado']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('municipio','Municipio') !!}
          {!! Form::text('municipio', $usuario->municipio,['class'=>'autocomplete validate','id'=>'municipio']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('direccion','Dirección') !!}
          {!! Form::text('direccion', $usuario->direccion,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('colonia','Colonia') !!}
          {!! Form::text('colonia', $usuario->colonia,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('cp','Código postal') !!}
          {!! Form::text('cp', $usuario->cp,['class'=>'validate']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">email</i>
          {!! Form::label('email','Email') !!}
          {!! Form::email('email', $usuario->email, ['class'=>'validate','required']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('telefono_a','Telefono 1') !!}
          {!! Form::tel('telefono_a', $usuario->telefono_a,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('telefono_b','Telefono 2') !!}
          {!! Form::tel('telefono_b', $usuario->telefono_b,['class'=>'validate']) !!}
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
          {!! Form::text('curp', $usuario->curp,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          {!! Form::label('rfc','RFC') !!}
          {!! Form::text('rfc', $usuario->rfc,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('cedula','Cédula') !!}
          {!! Form::text('cedula', $usuario->cedula,['class'=>'validate']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('especialidad','Especialidad') !!}
          {!! Form::text('especialidad', $usuario->especialidad,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('cuenta_bancaria','Cuenta bancaria') !!}
          {!! Form::number('cuenta_bancaria', $usuario->cuenta_bancaria,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('banco','Banco') !!}
          {!! Form::text('banco', $usuario->banco,['class'=>'autocomplete validate']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l6">
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          @if($usuario->tipo_usuario == "Administrador")
            {!! Form::select('tipo_usuario', ['Administrador' => 'Administrador', 'Administrador de sucursal' => 'Administrador de sucursal', 'Medico' => 'Médico'],'Administrador', ['class' => 'select-dropdown', 'required']) !!}
          @elseif($usuario->tipo_usuario == "Administrador de sucursal")
            {!! Form::select('tipo_usuario', ['Administrador' => 'Administrador', 'Administrador de sucursal' => 'Administrador de sucursal', 'Medico' => 'Médico'],'Administrador de sucursal', ['class' => 'select-dropdown', 'required']) !!}
          @else
            {!! Form::select('tipo_usuario', ['Administrador' => 'Administrador', 'Administrador de sucursal' => 'Administrador de sucursal', 'Medico' => 'Médico'],'Medico', ['class' => 'select-dropdown', 'required']) !!}
          @endif
          {!! Form::label('tipo_usuario','Tipo de Usuario') !!}
        </div>
      </div>

      <div class="col l6">
        {{-- En caso de seleccionar Administrador de sucursal se mostrara la lista de sucusales --}}
      </div>

    </div>

    <div class="input-field center-align">
      {!! Form::submit('Actualizar',['class'=>'btn waves-effect waves-light']) !!}
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

$('select').material_select();

$.get('{!! route('admin.usuarios.pais') !!}').done(function(datos){
  $('#pais.autocomplete').autocomplete({
    data:JSON.parse(datos)
  });
});

$.get('{!! route('admin.usuarios.estado') !!}').done(function(datos){
  $('#estado.autocomplete').autocomplete({
    data:JSON.parse(datos)
  });
});

$.get('{!! route('admin.usuarios.municipio') !!}').done(function(datos){
  $('#municipio.autocomplete').autocomplete({
    data:JSON.parse(datos)
  });
});

$.get('{!! route('admin.usuarios.banco') !!}').done(function(datos){
  $('#banco.autocomplete').autocomplete({
    data:JSON.parse(datos)
  });
});

@endsection
@section('scripts-2')
  <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
  <script type="text/javascript">
    var date = new Date();
    initDatepicker({
        format: 'd mmmm, yyyy',
        selectYears: 100,
        min: [date.getFullYear() - 100, date.getMonth(), date.getDate()],
        max: [date.getFullYear(), date.getMonth(), date.getDate()],
        hiddenSuffix: '_nacimiento',
        now: '1983-09-28'
            });
        // $('form').submit(function(){
        //   alert(date);
        //   // alert($(this).serialize());
        //   return false;
        // })
    
  </script>
@endsection