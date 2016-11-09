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
            <div id="existencia_actualizar" class="modal">
              {!! Form::open(['route'=>'sucursal.productos.store', 'method'=>'POST','id'=>'form']) !!}
                <input type="hidden" id="producto_id" name="producto_id">
                <div class="modal-content">
                  <h4>Cambiar existencias</h4>
                  <div class="row">
                    <div class="col l6 input-field">
                      <i class="material-icons prefix">store</i>
                      {!! Form::text('producto',' ',['class'=>'validate', 'disabled'=>'disabled','id'=>'producto']) !!}
                      {!! Form::label('producto','Producto') !!}
                    </div>
                    <div class="col l6 input-field">
                      <i class="material-icons prefix">store</i>
                      {!! Form::label('existencia','Existencias') !!}
                      {!! Form::number('existencia',0,['class'=>'validate','id'=>'existencia','min'=>'1']) !!}
                    </div>
                  </div>
                </div>
                <div class="divider"></div>
                <div class="modal-footer">
                  <a href="#!" onclick="confirmar()" class=" modal-action waves-effect waves-green btn-flat">Agregar</a>
                </div>
              
            </div>
            {{-- Fin modal actualización --}}
            {{-- Inicio Modal confirmacion --}}
            <div id="confirmacion" class="modal">
                <div class="modal-content center" id="existencia_mod">
                  
                </div>
                <div class="divider"></div>
                <div class="center mb-10 mt-10">
                  <a onclick="enviar()" class="center waves-effect  btn-flat green lighten-1">confirmar</a>
                  <a href="#!" onclick="cancelar()" class="waves-effect btn-flat">Volver</a>
                </div>

            </div>
            {!! Form::close() !!}
            {{-- Fin modal confirmacion --}}
    	</div>
    </div>
@endsection
@section('functions')
  function cambiar(id,nombre){
    $('#form')[0].reset();
    $('#producto').val(nombre);
    $('#producto_id').val(id);
    $('#existencia_actualizar').openModal();
  }
  function confirmar(){
      if($('#existencia').val()==0||$('#existencia').val()==0){
      Materialize.toast('Debes agregar al menos un producto', 4000);
      return false;
    }
    $("#existencia_mod").html('<h4>Se agregará la cantidad de '+$('#existencia').val()+' al inventario</h4>');
    $("#confirmacion").openModal();
  }
  function cancelar(){
    $('#existencia_actualizar').closeModal();
    $('#confirmacion').closeModal();
  }
  function enviar(){
    $("#form").submit();
  }
@endsection