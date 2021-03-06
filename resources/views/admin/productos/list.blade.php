@extends('main')
@section('title','Productos')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    <div class="container">
    	<div class="card-panel">
            <div class="row">
                <div class="col push-s1 s10 center-align">
                    <h4>Productos</h4>
                </div>
                <div class="col pull-s1 s1">
                    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger tooltipped" href="{!! route('admin.productos.create') !!}" data-position="right" data-delay="50" data-tooltip="Nuevo Producto" ><i class="material-icons">add</i></a>
                </div>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <table class="responsive-table centered">
                <thead>
                  <tr>
                      <th data-field="id">Nombre</th>
                      <th data-field="name">Descripción</th>
                      <th data-field="price">Precio</th>
                      <th data-field="option">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->precio }}</td>
                            <td><a href="{!! route('admin.productos.edit', $producto->id) !!}" data-position="right" data-delay="50" data-tooltip="Editar" class="tooltipped btn-floating btn-small waves-effect waves-light amber accent-3 mr-10"><i class="material-icons">edit</i></a><a href="{!! route('admin.productos.destroy', $producto->id) !!}" data-position="right" data-delay="50" data-tooltip="Eliminar" class="tooltipped btn-floating btn-small waves-effect waves-light  red darken-1"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {!! (new Landish\Pagination\Materialize($productos))->render() !!}
            </div>
    	</div>
    </div>
@endsection