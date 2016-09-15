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
                    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger" data-target="create"><i class="material-icons">add</i></a>
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
                            <td><a href="{!! route('admin.productos.edit', $producto->id) !!}" class="btn-floating btn-small waves-effect waves-light amber accent-3 mr-10"><i class="material-icons">edit</i></a><a href="{!! route('admin.productos.destroy', $producto->id) !!}" class="btn-floating btn-small waves-effect waves-light  red darken-1"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {!! (new Landish\Pagination\Materialize($productos))->render() !!}
            </div>
    	</div>
        <!-- Modal Structure Create -->
        <div id="create" class="modal">
            <div class="modal-content">
                <div class="center-align">
                    <h3>Nuevo Producto</h3>
                </div>
                <div class="row">
                    <div class="col s8 col-center divider"></div>
                </div>
                {!! Form::open(['route'=>'admin.productos.store', 'method'=>'POST', 'id'=>'form']) !!}
                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::label('name','Nombre') !!}
                        {!! Form::text('nombre', null, ['class'=>'validate','required']) !!}
                    </div>  
                    <div class="input-field">
                        <i class="material-icons prefix">mode_edit</i>
                        {!! Form::label('desc','Descripción') !!}
                        {!! Form::textarea('descripcion', null, ['class'=>'materialize-textarea','required']) !!}
                    </div> 
                    <div class="input-field">
                        <i class="material-icons prefix">payment</i>
                        {!! Form::label('cost','Precio') !!}
                        {!! Form::number('precio', null, ['class'=>'validate','required']) !!}
                    </div>
                    <div class="input-field center-align">
                        {!! Form::submit('Crear',['class'=>'btn waves-effect waves-light']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
              <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
            </div>
        </div>
        <!-- End Modal Structure Create -->
    </div>
@endsection
@section('scripts')
$('.modal-trigger').leanModal();
$('#form').submit(function(){
    var data=$('#form').serialize();
    $.ajax({
        url: "{!! route('admin.productos.store') !!}",
        type: "POST",
        data: data
    }).done(function(data){
        if(data=="success"){
            alert("Holis");
        }
        else{
            alert("no holis");
        }
    });
    return false;
});
@endsection