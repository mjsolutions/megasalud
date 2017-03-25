@extends('main')
@section('title','Sucursales')
@section('nav')
@include('admin.nav')
@endsection
@section('content')

<div class="container">
  <div class="card-panel">
    <div class="row">
      <div class="col push-s1 s10 center-align">
        <h4>Sucursales</h4>
      </div>
      <div class="col pull-s1 s1">
        <a class="btn-floating btn-large waves-effect waves-light green tooltipped" data-position="right" data-delay="50" data-tooltip="Nueva Sucursal" href="{!! route('admin.sucursales.create') !!}"><i class="material-icons">add</i></a>
      </div>
    </div>
    <div class="row">
     <div class="col s8 col-center divider"></div>
   </div>
   <div class="row">
     {!! Form::open(['route'=>['admin.sucursales.busqueda'], 'method'=>'GET']) !!}
     <div class="col l6 offset-l4 input-field mt-0">
      <i class="material-icons prefix">search</i>
      {!! Form::text('data', null, ['class'=>'validate','id'=>'data','required'=>'required']) !!}
      <label for="icon_prefix2">(Nombre de Sucursal, Identificador, Clave bancaria)</label>
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
     <th data-field="name">Razón social</th>
     <th data-field="lugar">Lugar</th>
     <th data-field="telefono">Telefono</th>
     <th data-field="option">Opciones</th>
   </tr>
 </thead>
 <tbody>

  @foreach($sucursales as $sucursal)
  <tr>
   <td>{{ $sucursal->id }}</td>
   <td>{{ $sucursal->razon_social }}</td>
   <td>{{ $sucursal->municipio . " " . $sucursal->estado }}</td>
   <td>{{ $sucursal->telefono }}</td>
   <td>
    <a class="tooltipped btn-floating btn-small waves-effect waves-light mr-5" data-position="right" data-delay="50" data-tooltip="Detalles" onclick="detalle({{ $sucursal->id }})"><i class="material-icons">receipt</i></a>
    <a href="{!! route('admin.sucursales.edit', $sucursal->id) !!}" class="btn-floating btn-small waves-effect waves-light amber accent-3 mr-5 tooltipped" data-position="right" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
    <a href="{!! route('admin.sucursales.destroy', $sucursal->id) !!}" class="btn-floating btn-small waves-effect waves-light  red darken-1 mr-5 tooltipped" data-position="right" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
  </td>
</tr>
@endforeach
</tbody>
</table>

@endsection