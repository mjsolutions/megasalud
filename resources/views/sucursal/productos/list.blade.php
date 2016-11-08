@extends('main')
@section('title','Productos')
@section('nav')
	@include('sucursal.nav')
@endsection
@section('content')
    <div class="container">
    	<div class="card-panel">
            <div class="row">
                <div class="col push-s1 s10 center-align">
                    <h4>Productos</h4>
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
                      <th data-field="price">Existencias</th>
                      <th data-field="option">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->precio }}</td>
                            <td>{{ $producto->pivot->existencia }}</td>
                            <td><a href="#" data-position="right" data-delay="50" onclick="cambiar({{$producto->id}},'{{$producto->nombre}}')" data-tooltip="Agregar existencias" class="tooltipped btn-floating btn-small waves-effect waves-light amber accent-3 mr-10"><i class="material-icons">playlist_add</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {{-- {!! (new Landish\Pagination\Materialize($productos))->render() !!} --}}
            </div>
            {{-- Inicio Modal --}}
            <div id="existencia" class="modal">
              {!! Form::open(['route'=>'sucursal.productos.store', 'method'=>'POST','files'=>true]) !!}
                <div class="modal-content">
                  <h4>Cambiar existencias</h4>
                  <div class="row">
                    <div class="col l6 input-field">
                      <i class="material-icons prefix">store</i>
                      {!! Form::label('producto','Producto') !!}
                      {!! Form::text('producto',null,['class'=>'validate', 'disabled'=>'disabled','id'=>'producto']) !!}
                    </div>
                    <div class="col l6 input-field">
                      <i class="material-icons prefix">store</i>
                      {!! Form::label('existencia','Existencias') !!}
                      {!! Form::number('existencia',0,['class'=>'validate','id'=>'existencia','min'=>'0']) !!}
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                </div>
              {!! Form::close() !!}
            </div>
            {{-- Fin modal actualización --}}
    	</div>
    </div>
@endsection
@section('functions')
  function cambiar(id,nombre){
    $('#producto').html(nombre);
    $('#existencia').openModal();
  }
@endsection