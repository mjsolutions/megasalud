@extends('main')
@section('title','Pedidos')
@section('nav')
    @include('admin.nav')
@endsection
@section('content')
    <div class="container">
        <div class="card-panel">
            <div class="row">
                <div class="col push-s1 s10 center-align">
                    <h4>Pedidos Globales</h4>
                </div>
                <div class="col pull-s1 s1">
                    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger tooltipped" href="{!! route('admin.pedidos.create') !!}" data-position="right" data-delay="50" data-tooltip="Nuevo Producto" ><i class="material-icons">add</i></a>
                </div>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <table class="responsive-table centered">
                <thead>
                  <tr>
                      <th data-field="id">#</th>
                      <th data-field="name">Nombre</th>
                      <th data-field="sucursal">Sucursal</th>
                      <th data-field="phone">Telefono</th>
                      <th data-field="status">Estado</th>
                      <th data-field="option">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->paciente->nombre." ".$pedido->paciente->apellido_p." ".$pedido->paciente->apellido_m }}</td>
                            <td>{{ $pedido->user->sucursales[0]->razon_social }}</td>
                            <td>{{ "(".substr($pedido->paciente->telefono_a, 0, 3).") ".substr($pedido->paciente->telefono_a, 3, 3)."-".substr($pedido->paciente->telefono_a,6) }}</td>
                            <td> 
                                @if($pedido->status==1)
                                    <b>En Espera</b>
                                @elseif($pedido->status==2)
                                    <b>Pagado</b>
                                @else
                                    <b>Cancelado</b>
                                @endif
                            </td>
                            <td><a class="tooltipped btn-floating btn-small waves-effect waves-light mr-10" data-position="right" data-delay="50" data-tooltip="Detalles" onclick="detalle({{ $pedido->id }})"><i class="material-icons">receipt</i></a><a href="" data-position="right" data-delay="50" data-tooltip="Editar Producto" class="tooltipped btn-floating btn-small waves-effect waves-light amber accent-3 mr-10"><i class="material-icons">edit</i></a><a href="" data-position="right" data-delay="50" data-tooltip="Eliminar producto" class="tooltipped btn-floating btn-small waves-effect waves-light  red darken-1"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {!! (new Landish\Pagination\Materialize($pedidos))->render() !!}
            </div>
        </div>
    </div>
@endsection