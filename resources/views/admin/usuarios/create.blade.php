@extends('main')
@section('title','Usuarios | Nuevo')
@section('nav')
@include('admin.nav')
@endsection
@section('content')
{!! Form::open(['route'=>'admin.usuarios.store', 'method'=>'POST']) !!}
<div class="container">
  <div class="card-panel">
    <div class="center-align">
      <h3>Nuevo Usuario</h3>
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
          {!! Form::text('nombre', null, ['class'=>'validate','required']) !!}
        </div>      
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          {!! Form::label('apellido_p','Apellido paterno') !!}
          {!! Form::text('apellido_p', null, ['class'=>'validate','required']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          {!! Form::label('apellido_m','Apellido materno') !!}
          {!! Form::text('apellido_m', null, ['class'=>'validate','required']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l6">
        <div class="input-field">
          <i class="material-icons prefix">perm_contact_calendar</i>
          {!! Form::label('fecha','Fecha de nacimiento') !!}
          {!! Form::date('fecha', null, ['class'=>'datepicker','required']) !!}
        </div>
      </div>

      <div class="col l6">
        <div class="input-fields">
          {{-- <p>Sexo</p> --}}
          {!! Form::radio('sexo', 'Masculino', false, ['id' => 'sexo1', 'class' => 'with-gap']) !!}
          {!! Form::label('sexo1', 'Masculino') !!}
          {!! Form::radio('sexo', 'Femenino', false, ['id' => 'sexo2', 'class' => 'with-gap']) !!}
          {!! Form::label('sexo2', 'Femenino') !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l6">
        <div class="input-field">
          <i class="material-icons prefix">lock</i>
          {!! Form::label('password', 'Contraseña') !!}
          {!! Form::password('password', ['class' => 'validate', 'required']) !!}
        </div>
      </div>

      <div class="col l6">
        <div class="input-field">
          <i class="material-icons prefix">lock</i>
          {!! Form::label('password_confirmation', 'Verifique contraseña') !!}
          {!! Form::password('password_confirmation', ['class' => 'validate', 'required']) !!}
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
          {!! Form::text('pais','Mexico',['class'=>'autocomplete validate','id'=>'pais']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('estado','Estado') !!}
          {!! Form::text('estado',null,['class'=>'autocomplete validate','id'=>'estado']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('municipio','Municipio') !!}
          {!! Form::text('municipio',null,['class'=>'autocomplete validate','id'=>'municipio']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('direccion','Dirección') !!}
          {!! Form::text('direccion',null,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('colonia','Colonia') !!}
          {!! Form::text('colonia',null,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">textsms</i>
          {!! Form::label('cp','Código postal') !!}
          {!! Form::text('cp',null,['class'=>'validate']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">email</i>
          {!! Form::label('email','Email') !!}
          {!! Form::email('email', null, ['class'=>'validate','required']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('telefono_a','Telefono 1') !!}
          {!! Form::tel('telefono_a',null,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('telefono_b','Telefono 2') !!}
          {!! Form::tel('telefono_b',null,['class'=>'validate']) !!}
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
          {!! Form::text('curp',null,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          {!! Form::label('rfc','RFC') !!}
          {!! Form::text('rfc',null,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('cedula','Cédula') !!}
          {!! Form::text('cedula',null,['class'=>'validate']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('especialidad','Especialidad') !!}
          {!! Form::text('especialidad',null,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('cuenta_bancaria','Cuenta bancaria') !!}
          {!! Form::number('cuenta_bancaria',null,['class'=>'validate']) !!}
        </div>
      </div>

      <div class="col l4">
        <div class="input-field">
          <i class="material-icons prefix">phone</i>
          {!! Form::label('banco','Banco') !!}
          {!! Form::text('banco',null,['class'=>'autocomplete validate']) !!}
        </div>
      </div>

    </div>

    <div class="row">

      <div class="col l6">
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          {!! Form::select('tipo_usuario', ['Administrador' => 'Administrador', 'Administrador de sucursal' => 'Administrador de sucursal', 'Medico' => 'Médico'],'Medico', ['class' => 'select-dropdown', 'required', 'id' => 'tipo_usuario']) !!}
          {!! Form::label('tipo_usuario','Tipo de Usuario') !!}
        </div>
      </div>

      <div class="col l6" id="hidden-div">
        {{-- En caso de seleccionar Administrador de sucursal se mostrara la lista de sucusales --}}
        <div class="input-field">
          <div class="input-field">
            <i class="material-icons prefix">perm_identity</i>
            {!! Form::select('sucursal', $sucursales, null, ['class' => 'select-dropdown', 'required', 'id' => 'sucursal']) !!}
            {!! Form::label('sucursal','Sucursal') !!}
          </div>
        </div>
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

$('select').material_select();

$("#hidden-div").hide();

$("select#tipo_usuario").change(function() {
  if ($(this).val() == "Administrador de sucursal"){
    $("#hidden-div").fadeIn('slow');
  }else{
    $("#hidden-div").hide();
  }
});



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

$('form').submit(function(e){
  e.preventDefault();
  alert($(this).serialize());
})

@endsection
@section('scripts-2')
  <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
  <script type="text/javascript">
    var date = new Date();
    initDatepicker({
        selectYears: 100,
        min: [date.getFullYear() - 100, date.getMonth(), date.getDate()],
        max: [date.getFullYear(), date.getMonth(), date.getDate()],
        hiddenName: 'fecha',
        hiddenSuffix: '_nacimiento'
            });
    
  </script>
@endsection