@extends('main')
@section('title','Pedidos')
@section('nav')
    @include('sucursal.nav')
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
            <div class="row">
                <div class="col l6 offset-l6 input-field">
                    <i class="material-icons prefix">search</i>
                    {!! Form::text('busca_pedido', null, ['class'=>'validate','id'=>'busca_pedido']) !!}
                    <label for="icon_prefix2">Buscar pedido (Nombre de Paciente, Identificador, Clave bancaria)</label>
                </div>
            </div>
            <table class="responsive-table centered">
                <thead>
                  <tr>
                      <th data-field="id">#</th>
                      <th data-field="name">Nombre</th>
                      <th data-field="phone">Fecha</th>
                      <th data-field="status">Estado</th>
                      <th data-field="option">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->nombre.' '.$pedido->apellido_p.' '.$pedido->apellido_m }}</td>
                            <td>{{$pedido->fecha_pedido}}</td>
                            <td> 
                                @if($pedido->status==1)
                                    <span class="c-white-normal p-5 br-2 blue">En Espera</span>
                                @elseif($pedido->status==2)
                                    <span class="c-white-normal p-5 br-2 green">Pagado</span>
                                @else
                                    <span class="c-white-normal p-5 br-2 red">Cancelado</span>
                                @endif
                            </td>
                            <td><a class="tooltipped btn-floating btn-small waves-effect waves-light mr-10" data-position="right" data-delay="50" data-tooltip="Detalles" onclick="detalle({{ $pedido->id }})"><i class="material-icons">receipt</i></a>
                            @if($pedido->status==3)
                            {{-- En caso de que se quiera deshabilitar basta con poner clase diable --}}
                               <a onclick="cambiar_e({{$pedido->id}},0)" data-position="right" data-delay="50" data-tooltip="Cambiar estado" class="tooltipped btn-floating btn-small waves-effect waves-light amber accent-3 mr-10 disabled" id="camibar_ico"><i class="material-icons">edit</i></a>
                            @else
                                <a onclick="cambiar_e({{$pedido->id}},1)" data-position="right" data-delay="50" data-tooltip="Cambiar estado" class="tooltipped btn-floating btn-small waves-effect waves-light amber accent-3 mr-10" id="camibar_ico"><i class="material-icons">edit</i></a>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! Form::open(['route'=>['sucursal.pedidos.show',':USER_ID'], 'method'=>'GET','id'=>'form']) !!}
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
            {{-- Inicio de Modal cambio de estado --}}
            {!! Form::open(['route'=>['sucursal.pedidos.estado'], 'method'=>'POST','id'=>'form_cambio']) !!}
            <div id="cambiar_estado" class="modal">
                <div class="modal-content center-align">
                  <h4>Actualizar estado del pedido</h4>
                  <div class="row">
                    <div class="col s8 col-center divider"></div>
                  </div>
                  <div class="row">
                        <div class="col l6 mt-0">
                          {!! Form::select('estado_m',['1'=>'En espera','2'=>'Pagado','3'=>'Cancelado'],null,['id'=>'estado_m','placeholder'=>'Elige el estado','required'=>'required']) !!}
                        </div>
                        <div class="col l6 input-field m-0">
                            {!! Form::label('confirmacion','Código de confirmación') !!}
                            {!! Form::text('confirmacion',null,['class'=>'validate','id'=>'confirmacion','min'=>'0','required'=>'required']) !!}
                        </div>
                  </div>
                  <div class="row">
                    <div class="col l12 input-field">
                            {!! Form::label('detalle_m','Detalles') !!}
                            {!! Form::textarea('detalle_m',null,['class'=>'materialize-textarea','id'=>'detalle_m','required'=>'required']) !!}
                    </div>
                  </div>
                </div>
                <input type="hidden" id="pedido_id" name="pedido_id" value="">
                <div class="modal-footer">
                    <div class="row">
                        <div class="col l12">
                            {!! Form::submit('Actualizar',['class'=>'btn waves-effect waves-light']) !!} 
                            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</a>
                        </div>
                    </div>
                </div>
             </div>
            {!! Form::close() !!}
            {{-- Fin de modal cambio de estado --}}
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
            $("#metodo").html(
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
    function cambiar_e(id,b){
        if(b){
            $("#form_cambio")[0].reset();
            $('#pedido_id').val(id);
            $('#cambiar_estado').openModal();
        }
        else{
            return false;
        }
    }
@endsection