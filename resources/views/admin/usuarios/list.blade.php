@extends('main')
@section('title','Usuarios')
@section('nav')
@include('admin.nav')
@endsection
@section('content')

<div class="container">
	<div class="card-panel">
		<div class="row">
			<div class="col push-s1 s10 center-align">
        <h4>Usuarios</h4>
      </div>
      <div class="col pull-s1 s1">
        <a class="btn-floating btn-large waves-effect waves-light green tooltipped" data-position="right" data-delay="50" data-tooltip="Nuevo Usuario" href="{!! route('admin.usuarios.create') !!}"><i class="material-icons">add</i></a>
      </div>
    </div>
    <div class="row">
     <div class="col s8 col-center divider"></div>
   </div>
   <div class="row">
   {!! Form::open(['route'=>['admin.usuarios.busqueda'], 'method'=>'GET']) !!}
    <div class="col l6 offset-l4 input-field mt-0">
      <i class="material-icons prefix">search</i>
      {!! Form::text('data', null, ['class'=>'validate','id'=>'data','required'=>'required']) !!}
      <label for="icon_prefix2">(Nombre de Usuario, Identificador, Clave bancaria, Rol)</label>
    </div>
    <div class="col l2">
      {!! Form::submit('Buscar',['class'=>'btn btn-block waves-effect waves-light']) !!}
    </div>
    {!! Form::close() !!}
  </div>
  <table class="responsive-table centered">
   <thead>
    <tr>
     <th data-field="id">Id</th>
     <th data-field="name">Nombre</th>
     <th data-field="sucursal">Email</th>
     <th data-field="telefono">Rol</th>
     <th data-field="sucursal">Sucursal</th>
     <th data-field="option">Opciones</th>
   </tr>
 </thead>
 <tbody>
{{--     {{ $usuarios[5]->sucursales }}
{{ $usuarios[5]->tipo_usuario }} --}}
@foreach($usuarios as $usuario)
<tr>
 <td>{{ $usuario->id }}</td>
 <td>{{ $usuario->nombre }}</td>
 <td>{{ $usuario->email }}</td>
 <td>
  @if ($usuario->tipo_usuario == "Administrador")
  <span class="c-white-normal p-5 br-2 blue">{{ $usuario->tipo_usuario }}</span>
  @elseif ($usuario->tipo_usuario == "Medico")
  <span class="c-white-normal p-5 br-2 green">{{ $usuario->tipo_usuario }}</span>
  @else
  <span class="c-white-normal p-5 br-2 red">Admin. de Suc.</span>
  @endif
</td>
<td>
      {{-- @if( count($usuario->sucursales) )
      {{  $usuario->sucursales[0]->razon_social }}
      @else
      {{"N/A"}}
      @endif --}}

      @forelse($usuario->sucursales as $sucursal)
      {{ $sucursal->razon_social }}
      @empty
      {{ 'N/A' }}
      @endforelse
    </td>
    <td>
      <a class="tooltipped btn-floating btn-small waves-effect waves-light mr-5" data-position="right" data-delay="50" data-tooltip="Detalles" onclick="detalle({{ $usuario->id }})"><i class="material-icons">receipt</i></a>
      <a href="{!! route('admin.usuarios.edit', $usuario->id) !!}" class="btn-floating btn-small waves-effect waves-light amber accent-3 mr-5 tooltipped" data-position="right" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
      @if(Auth::user()->id != $usuario->id)
      <a href="{!! route('admin.usuarios.destroy', $usuario->id) !!}" class="btn-floating btn-small waves-effect waves-light  red darken-1 mr-5 tooltipped" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
      @endif
      <a class="btn-floating btn-small waves-effect waves-light  grey darken-1 tooltipped" data-position="right" data-delay="50" data-tooltip="Cambiar Contraseña" onclick="change_password({{ $usuario->id }}, '{{ $usuario->nombre }}')"><i class="material-icons">vpn_key</i></a>
    </td>
  </tr>
  @endforeach
</tbody>
</table>
{!! Form::open(['route' => ['admin.usuarios.show', ':USER_ID'], 'method' => 'GET', 'id' => 'form']) !!}
{!! Form::close() !!}

<div id="detalles" class="modal">
  <div class="modal-footer">
    <div class="plr-5" id="contenido">
      <!-- ENcabezado -->
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-5 z-depth-0">
          <div class="row valign-wrapper">
            <div class="col s4">
              <img src="{{ asset('images/user.jpg') }}" alt="" id="foto" class="circle responsive-img"> 
            </div>
            <div class="col s10">
              <span class="black-text" id="datos">

              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin encabezado-->
      <!-- Información de Contacto-->
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-5 z-depth-2">
          <div class="row valign-wrapper">
            <div class="col l12 center-align">
              <legend><h5 class="c-blue-grey">Información de contacto</h5></legend>
            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Nombre</span>
            </div>
            <div class="col l8" id="nombre">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Telefono(s)</span>
            </div>
            <div class="col l8" id="telefonos">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Correo electronico</span>
            </div>
            <div class="col l8" id="mail">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Dirección</span>
            </div>
            <div class="col l8" id="direccion">

            </div>
          </div>
        </div>
      </div>
      <!-- Fin información de contacto-->
      <!-- Datos Generales -->
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-5 z-depth-2">
          <div class="row valign-wrapper">
            <div class="col l12 center-align">
              <legend><h5 class="c-blue-grey">Datos generales</h5></legend>
            </div>
          </div>

          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">CURP</span>
            </div>
            <div class="col l8" id="curp">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">RFC</span>
            </div>
            <div class="col l8" id="rfc">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Cedula</span>
            </div>
            <div class="col l8" id="cedula">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Fecha de Nacimiento</span>
            </div>
            <div class="col l8" id="fecha">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Sexo</span>
            </div>
            <div class="col l8" id="sexo">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Tipo de Usuario</span>
            </div>
            <div class="col l8" id="tipo_usuario">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Clave Bancaria</span>
            </div>
            <div class="col l8" id="clave">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Cuenta Bancaria</span>
            </div>
            <div class="col l8" id="cuenta">

            </div>
          </div>
          <div class="row">
            <div class="col l4 right-align">
              <span class="blue c-white p-8 br-2">Banco</span>
            </div>
            <div class="col l8" id="banco">

            </div>
          </div>

        </div>
      </div>
      <!-- Fin datos generales -->
    </div>
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
  </div>
</div>{{-- End modal --}}

<div id="change_password" class="modal plr-10">
  <div class="modal-content">
    <div class="row">
      <div class="col l5 center">
        <h5>Cambiar contraseña para <span id="cp_nombre"></span></h5>
        <div class="divider"></div>     
      </div>
      <div class="col l7">
        {!! Form::open(['route' => ['admin.usuarios.change_password'], 'method' => 'POST', 'id' => 'form_changep']) !!}
        
        <div class="input-field">
          <i class="material-icons prefix">vpn_key</i>
          {!! Form::label('password_admin','Contraseña de Administrador') !!}
          {!! Form::password('password_admin', null, ['class'=>'validate','required']) !!}
        </div>

        <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          {!! Form::label('password','Nueva contraseña') !!}
          {!! Form::password('password', null, ['class'=>'validate','required']) !!}
        </div>

        <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          {!! Form::label('password_confirmation','Confirme nueva contraseña') !!}
          {!! Form::password('password_confirmation', null, ['class'=>'validate','required']) !!}
        </div>

        {!! Form::hidden('id', null, ['id' => 'id']) !!}

        <div class="input-field right-align">
          <button href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" type="reset">Cerrar</button>
          {!! Form::submit('Guardar',['class'=>'btn waves-effect btn-block waves-light green']) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
    {{-- <div class="divider"></div> --}}


  </div>
</div>

<div class="center-align">
 {!! (new Landish\Pagination\Materialize($usuarios))->render() !!}
</div>
</div>
</div>

@endsection

@section('scripts')
@if($errors)
@foreach($errors->all() as $error)
Materialize.toast('{{ $error }}', 4000);
@endforeach
@endif
@endsection

@section('functions')
function detalle(id) {
var form = $('#form');
var url = form.attr('action').replace(':USER_ID', id);
$.get(url).done(function(data) {
var datos = JSON.parse(data);
$("#datos").html(
"<h4>"+datos.nombre+" "+datos.apellido_p+" "+datos.apellido_m+"</h4>"+
"<h6>"+datos.email+"</h6>"
);
$("#nombre").html(
"<span>"+datos.nombre+" "+datos.apellido_p+" "+datos.apellido_m+"</span>"
);
$("#telefonos").html(
"<span>"+datos.telefono_a+" "+datos.telefono_b+"</span>"
);
var direccion = "";
if(datos.direccion != ""){
direccion += datos.direccion + " ";
}
if(datos.colonia != ""){
direccion += datos.colonia + " ";
}
if(datos.municipio != ""){
direccion += datos.municipio + " ";
}
if(datos.estado != ""){
direccion += datos.estado + " ";
}
if(datos.pais != ""){
direccion += datos.pais + " ";
}
if(datos.cp != ""){
direccion += datos.cp + " ";
}
$("#direccion").html(
"<span>"+direccion+"</span>"
);
$("#cp").html(
"<span>"+datos.cp+"</span>"
);
$("#sexo").html(
"<span>"+datos.sexo+"</span>"
);
$("#curp").html(
"<span>"+datos.curp+"</span>"
);
$("#rfc").html(
"<span>"+datos.rfc+"</span>"
);
$("#mail").html(
"<span>"+datos.email+"</span>"
);

var options = {weekday: "long", year: "numeric", month: "long", day: "numeric"};
var fecha = datos.fecha_nacimiento + " GMT-6";
var f = new Date(fecha);
var nva = f.toLocaleDateString("es-ES", options);

$("#fecha").html(
"<span>"+nva+"</span>"
);
$("#cuenta").html(
"<span>"+datos.cuenta_bancaria+"</span>"
);
$("#tipo_usuario").html(
"<span>"+datos.tipo_usuario+"</span>"
);
if(datos.clave_bancaria != ''){
$("#clave").html(
"<span>"+datos.clave_bancaria+"</span>"
);
}else{
$("#clave").parent().hide();
}
$("#banco").html(
"<span>"+datos.banco+"</span>"
);
$("#cedula").html(
"<span>"+datos.cedula+"</span>"
); 

$('#detalles').openModal();
});
{{-- alert(id); --}}
}

function change_password(id, nombre) {
$("#cp_nombre").html(nombre);
$('#id').val(id);
$("#change_password").openModal();

}

@endsection