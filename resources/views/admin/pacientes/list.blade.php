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
                    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger" href="{!! route('admin.pacientes.create') !!}"><i class="material-icons">add</i></a>
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
                            <td>{{ $paciente->telefono }}</td>
                            <td><a href="{!! route('admin.pacientes.edit', $paciente->id) !!}" class="btn-floating btn-small waves-effect waves-light amber accent-3 mr-10"><i class="material-icons">edit</i></a><a href="{!! route('admin.pacientes.destroy', $paciente->id) !!}" class="btn-floating btn-small waves-effect waves-light  red darken-1"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {!! (new Landish\Pagination\Materialize($pacientes))->render() !!}
            </div>
    	</div>
    </div>
@endsection