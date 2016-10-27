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
                    <h4>Pedidos</h4>
                </div>
                <div class="col pull-s1 s1">
                    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger tooltipped" href="{!! route('admin.pedidos.create') !!}" data-position="right" data-delay="50" data-tooltip="Nuevo Pedido" ><i class="material-icons">add</i></a>
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
                            <td><a class="tooltipped btn-floating btn-small waves-effect waves-light mr-10" data-position="right" data-delay="50" data-tooltip="Detalles" onclick="detalle({{ $pedido->id }})"><i class="material-icons">receipt</i></a><a href="" data-position="right" data-delay="50" data-tooltip="Editar" class="tooltipped btn-floating btn-small waves-effect waves-light amber accent-3 mr-10"><i class="material-icons">edit</i></a><a href="" data-position="right" data-delay="50" data-tooltip="Eliminar" class="tooltipped btn-floating btn-small waves-effect waves-light  red darken-1"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! Form::open(['route'=>['admin.pedidos.show',':USER_ID'], 'method'=>'GET','id'=>'form']) !!}
            {!! Form::close() !!}
            <!--Inicio modal-->
            <div id="detalles" class="modal">
                <div class="modal-footer">
                    <div class="plr-5" id="contenido">
                        <!-- ENcabezado -->
                        <div class="col s12 m8 offset-m2 l6 offset-l3">
                            <div class="card-panel grey lighten-5 z-depth-0">
                              <div class="row valign-wrapper">
                                <div class="col l12 center-align">
                                  <span class="black-text" id="datos">
                                    <h4>Detalles de Pedido</h4>
                                  </span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col s8 col-center divider"></div>
                              </div>
                            </div>
                        </div>
                        <!-- Fin encabezado-->
                        <!-- Información de Contacto-->
                        <div class="col s12 m8 offset-m2 l6 offset-l3">
                            <div class="card-panel grey lighten-5 z-depth-2">
                              <div class="row valign-wrapper">
                                <div class="col l12 center-align">
                                  <legend><h5 class="c-blue-grey">Información básica</h5></legend>
                                </div>
                              </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Nombre</span>
                                    </div>
                                    <div class="col l8" id="nombre">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Telefonos</span>
                                    </div>
                                    <div class="col l8" id="telefonos">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Correo electronico</span>
                                    </div>
                                    <div class="col l8" id="mail">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Sucursal</span>
                                    </div>
                                    <div class="col l8" id="sucursal">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Fecha de compra</span>
                                    </div>
                                    <div class="col l8" id="fecha">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Fecha de pago</span>
                                    </div>
                                    <div class="col l8" id="pago">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Forma de pago</span>
                                    </div>
                                    <div class="col l8" id="metodo">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Código de confirmación</span>
                                    </div>
                                    <div class="col l8" id="codigo">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Detalles</span>
                                    </div>
                                    <div class="col l8" id="detalle">
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Estado Actual</span>
                                    </div>
                                    <div class="col l8" id="estado">
                                        
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
                                      <legend><h5 class="c-blue-grey">Lista de productos</h5></legend>
                                    </div>
                                </div>
                                <table class="responsive-table striped">
                                    <thead>
                                      <tr>
                                          <th data-field="quantity">Cantidad</th>
                                          <th data-field="name">Producto</th>
                                          <th data-field="price">Precio</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tabla">
                                      
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col s8 col-center divider"></div>
                                </div>
                                <div class="row">
                                    <div class="col l10 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Importe</span>
                                    </div>
                                    <div class="col l2 right-align" id="importe">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l10 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Impuesto</span>
                                    </div>
                                    <div class="col l2 right-align" id="impuesto">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l10 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2"><b>Total</b></span>
                                    </div>
                                    <div class="col l2 right-align" id="total">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin datos generales -->
                    </div>
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
                </div>
            </div>
            <!-- Fin modal-->
            <div class="center-align">
                {!! (new Landish\Pagination\Materialize($pedidos))->render() !!}
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
            $("#nombre").html(
                "<span>"+datos.paciente.nombre+" "+datos.paciente.apellido_p+" "+datos.paciente.apellido_m+"</span>"
            );
            $("#telefonos").html(
                "<span>"+datos.paciente.telefono_a+" / "+datos.paciente.telefono_b+"</span>"
            );
            $("#mail").html(
                "<span>"+datos.paciente.email+"</span>"
            );
            $("#sucursal").html(
                "<span>"+datos.user.sucursales[0].razon_social+"</span>"
            );
            $("#fecha").html(
                "<span>"+datos.fecha_pedido+"</span>"
            );
            $("#pago").html(
                "<span>"+datos.fecha_pago+"</span>"
            );
            $("#detalle").html(
                "<p>"+datos.detalle+"</p>"
            );
            $("#forma").html(
                "<span>"+datos.metodo+"</span>"
            );
            $("#codigo").html(
                "<span>"+datos.confirmacion+"</span>"
            );
            if(datos.status==1)
                $("#estado").html(
                    "<span><b>En Espera</b></span>"
                );
            else if(datos.status==2)
                $("#estado").html(
                    "<span><b>Pagado</b></span>"
                );
            else
                $("#estado").html(
                    "<span><b>Cancelado</b></span>"
                );
            $("#tabla").html("");
            for(var i=0;i<datos.productos.length;i++){
                $("#tabla").append("<tr><td>"+datos.productos[i].pivot.cantidad+"</td><td>"+datos.productos[i].nombre+"</td><td>"+datos.productos[i].precio+"</td></tr>");
            }
            $("#importe").html(
                "<span>"+datos.importe+"</span>"
            );
            $("#impuesto").html(
                "<span>"+datos.impuesto+"</span>"
            );
            $("#total").html(
                "<span><b>"+datos.total+"</b></span>"
            );
            $("#detalles").openModal();
        });
    }
@endsection