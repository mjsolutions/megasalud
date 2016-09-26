@extends('main')
@section('title','Pacientes')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    <div class="container">
    	<div class="card-panel">
            <div class="row">
                <div class="col push-s1 s10 center-align">
                    <h4>Pacientes</h4>
                </div>
                <div class="col pull-s1 s1">
                    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger tooltipped" data-position="right" data-delay="50" data-tooltip="Nuevo Paciente" href="{!! route('admin.pacientes.create') !!}"><i class="material-icons">add</i></a>
                </div>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <table class="responsive-table centered">
                <thead>
                  <tr>
                    <th data-field="id">Id</th>
                    <th data-field="name">Nombre</th>
                    <th data-field="sucursal">Sucursal</th>
                    <th data-field="telefono">Telefono</th>
                    <th data-field="option">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->id }}</td>
                            <td>{{ $paciente->nombre }}</td>
                            <td></td>
                            <!--//$paciente->users[0]->sucursales[0]->razon_social-->
                            <td>{{ $paciente->telefono_a }}</td>
                            <td><a class="tooltipped btn-floating btn-small waves-effect waves-light mr-10" data-position="right" data-delay="50" data-tooltip="Detalles" onclick="detalle({{ $paciente->id }})"><i class="material-icons">receipt</i></a><a href="{!! route('admin.pacientes.edit', $paciente->id) !!}" data-position="right" data-delay="50" data-tooltip="Editar" class="tooltipped btn-floating btn-small waves-effect waves-light amber accent-3 mr-10"><i class="material-icons">edit</i></a><a href="{!! route('admin.pacientes.destroy', $paciente->id) !!}" data-position="right" data-delay="50" data-tooltip="Eliminar Paciente" class="tooltipped btn-floating btn-small waves-effect waves-light  red darken-1"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! Form::open(['route'=>['admin.pacientes.detalles',':USER_ID'], 'method'=>'GET','id'=>'form']) !!}
            {!! Form::close() !!}
            <div id="detalles" class="modal">
                <div class="modal-content" id="titulo">
                    
                </div>
                <div class="modal-footer" id="contenido">

                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
                </div>
            </div>
            <div class="center-align">
                {!! (new Landish\Pagination\Materialize($pacientes))->render() !!}
            </div>
    	</div>
    </div>
@endsection
@section('functions')
    function detalle(id){
        var form=$("#form");
        var url=form.attr('action').replace(':USER_ID',id);
        $.get(url).done(function(data){
            var datos=JSON.parse(data);
            $("#titulo").html("<h4>"+datos.nombre+"</h4>");
            $("#detalles").openModal();
        });
    }
@endsection