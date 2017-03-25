@extends('main')
@section('title','Medico | Nuevo')
@section('nav')
@include('sucursal.nav')
@endsection
@section('content')
{!! Form::open(['route'=>'sucursal.medicos.store', 'method'=>'POST']) !!}
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
          {!! Form::label('fecha_nacimiento','Fecha de nacimiento') !!}
          {!! Form::date('fecha_nacimiento', null, ['class'=>'datepicker']) !!}
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

      <div class="col l6 sucursal-div">
        <div class="input-field">
          <i class="material-icons prefix">perm_identity</i>
          {!! Form::select('sucursal', $sucursales, null, ['class' => 'select-dropdown', 'id' => 'sucursal', 'placeholder' => 'Seleccione una opción']) !!} 
          {!! Form::label('sucursal','Sucursal') !!}
        </div>
      </div>

    </div>

    <div class="input-field center-align">
      {!! Form::submit('Guardar',['class'=>'btn btn-large btn-block btn-block-large waves-effect waves-light']) !!}
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


$.get('{!! route('sucursal.medicos.pais') !!}').done(function(datos){
  $('#pais.autocomplete').autocomplete({
    data:JSON.parse(datos)
  });
});

$.get('{!! route('sucursal.medicos.estado') !!}').done(function(datos){
  $('#estado.autocomplete').autocomplete({
    data:JSON.parse(datos)
  });
});

$.get('{!! route('sucursal.medicos.municipio') !!}').done(function(datos){
  $('#municipio.autocomplete').autocomplete({
    data:JSON.parse(datos)
  });
});

$.get('{!! route('sucursal.medicos.banco') !!}').done(function(datos){
  $('#banco.autocomplete').autocomplete({
    data:JSON.parse(datos)
  });
});

{{-- $('form').submit(function(e){
  e.preventDefault();
  alert($(this).serialize());
}) --}}

@endsection
@section('scripts-2')
  <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
  <script type="text/javascript">
    var date = new Date();
    initDatepicker({
        selectYears: 100,
        min: [date.getFullYear() - 100, date.getMonth(), date.getDate()],
        max: [date.getFullYear(), date.getMonth(), date.getDate()],
        hiddenName: true, //enviar con el formato dado (no necesita input hidden)
            });

    // $('form').submit(function(){
    //       // alert(date);
    //       alert($(this).serialize());
    //       return false;
    //     })
    
  </script>
@endsection