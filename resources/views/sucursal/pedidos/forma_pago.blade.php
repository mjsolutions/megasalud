@extends('main')
@section('title','Pedidos | Forma de Pago')
@section('nav')
	@include('sucursal.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'sucursal.pedidos.confirmacion', 'method'=>'POST', 'id'=>'formulario']) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Forma de pago</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <div class="row">
                <div class="col l12">
                    <nav>
                        <div class="nav-wrapper blue darken-1">
                          <div class="col s12">
                            <a href="#!" onclick="back()" class="breadcrumb">Generar Pedido</a>
                            <a href="#!" class="breadcrumb">Forma de Pago</a>
                          </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="container">
                <ul class="collapsible" data-collapsible="accordion">
                    <li >
                        <div class="collapsible-header" id="Tarjeta">
                            <i class="icon-credit-card"></i>Tarjeta de credito o debito
                        </div>
                        <div class="collapsible-body">
                            <div class="ml-10 mr-10">
                                <div class="center-align">
                                    <h5>Ingrese los datos de su tarjeta</h5>
                                </div>
                                <div class="row">
                                    <div class="col l6 input-field">
                                        <i class="material-icons prefix">perm_identity</i>
                                        {!! Form::label('nombre','Nombre del tarjetahabiente') !!}
                                        {!! Form::text('nombre',null,['class'=>'validate','size'=>'20','id'=>'nombre','data-conekta'=>'card[name]']) !!}
                                    </div>
                                    <div class="col l6 input-field">
                                        <i class="material-icons prefix">payment</i>
                                        {!! Form::label('numero','Número de la Tarjeta') !!}
                                        {!! Form::text('numero',null,['class'=>'validate','id'=>'numero','size'=>'20','data-conekta'=>'card[number]']) !!}  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 input-field">
                                        <i class="material-icons prefix">today</i>
                                          {!! Form::label('mes','Mes de expiración') !!}
                                          {!! Form::text('mes',null,['class'=>'validate','id'=>'mes','size'=>'2','data-conekta'=>'card[exp_month]']) !!}
                                    </div>
                                    <div class="col l4 input-field">
                                        <i class="material-icons prefix">today</i>
                                          {!! Form::label('ano','Año de expiración') !!}
                                          {!! Form::text('ano',null,['class'=>'validate','id'=>'ano','size'=>'4','data-conekta'=>'card[exp_year]']) !!}
                                    </div>
                                    <div class="col l4 input-field">
                                        <i class="material-icons prefix">account_circle</i>
                                        {!! Form::label('cvc','Código CVC') !!}
                                        {!! Form::text('cvc',null,['class'=>'validate','id'=>'cvc','size'=>'4','data-conekta'=>'card[exp_year]']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                      <div class="collapsible-header" id="Oxxo">
                        <i class="iconos-OXXO_logo iconos-s-3"></i>Oxxo
                      </div>
                        <div class="collapsible-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col l6 right-align">
                                        <b>Nombre</b>
                                    </div>
                                    <div class="col l6">
                                        Dr. Jaime Humberto Rodriguez
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l6 right-align">
                                        <b>Número de cuenta</b>
                                        </div>
                                    <div class="col l6">
                                        XXXXXXXXX
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                      <div class="collapsible-header" id="Deposito"><i class="icon-university"></i>Deposito Bancario</div>
                      <div class="collapsible-body">
                        <div class="container">
                            <div class="row">
                              <div class="col l6 right-align">
                                  <b>Banco</b>
                              </div>
                              <div class="col l6">
                                  HSBC
                              </div>
                          </div>
                            <div class="row">
                                <div class="col l6 right-align">
                                    <b>Nombre del servicio</b>
                                </div>
                                <div class="col l6">
                                    MegaSalud Internacional S.A. de C.V.
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l6 right-align">
                                    <b>Clave de servicio</b>
                                    </div>
                                <div class="col l6">
                                    8684
                                </div>
                            </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="collapsible-header" id="Efectivo"><i class="icon-money"></i>Efectivo</div>
                      <div class="collapsible-body">
                            <p>Haz elegido seleccionado efectivo</p>
                      </div>
                    </li>
                </ul>
                <div class="row">
                    <div class="col l12 center-align">
                        <input type="hidden" name="metodo" id="metodo">
                        <a class="waves-effect waves-light btn" id="continuar">Continuar</a>
                    </div>
                </div>
                {{-- Inicio Modal de confirmación --}}
                <div id="confirmar" class="modal">
                    <div class="modal-content">
                      <h4>Detalles del pedido</h4>
                      <p></p>
                        {{-- Inicio de Información de contacto --}}
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
                                        {{ $paciente->nombre." ".$paciente->apellido_p." ".$paciente->apellido_m }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Telefonos</span>
                                    </div>
                                    <div class="col l8" id="telefonos">
                                        {{"(".substr($paciente->telefono_a, 0, 3).") ".substr($paciente->telefono_a, 3, 3)."-".substr($paciente->telefono_a,6)." ".$paciente->telefono_b="(".substr($paciente->telefono_b, 0, 3).") ".substr($paciente->telefono_b, 3, 3)."-".substr($paciente->telefono_b,6)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Correo electronico</span>
                                    </div>
                                    <div class="col l8" id="mail">
                                        {{$paciente->email}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Sucursal</span>
                                    </div>
                                    <div class="col l8" id="sucursal">
                                        {{$paciente->users[0]->sucursales[0]->razon_social}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Forma de pago</span>
                                    </div>
                                    <div class="col l8" id="forma_pago">
                                        
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Detalles</span>
                                    </div>
                                    <div class="col l8 input-field">
                                        {!! Form::label('detalle','Observaciones') !!}
                                        {!! Form::textarea('detalle',null,['class'=>'materialize-textarea']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Fin de información de contacto --}}
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
                                          <th data-field="importe">Importe</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tabla">
                                      @foreach($productos as $producto)
                                        @if($lista[$producto->id]>0)
                                            <tr>
                                                <td>
                                                    {{$lista[$producto->id]}}
                                                </td>
                                                <td>
                                                    {{$producto->nombre}}
                                                </td>
                                                <td>
                                                    {{$producto->precio}}
                                                </td>
                                                <td>
                                                    {{"$".$producto->precio*$lista[$producto->id] }}
                                                </td>
                                            </tr>
                                        @endif
                                      @endforeach
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
                                        {{"$".$lista->importe}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l10 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Impuesto</span>
                                    </div>
                                    <div class="col l2 right-align" id="impuesto">
                                        {{"$".$lista->impuesto}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l10 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2"><b>Total</b></span>
                                    </div>
                                    <div class="col l2 right-align" id="total">
                                        <b>
                                        {{"$".$lista->total}}
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin datos generales -->
                    </div>
                    <div class="modal-footer">
                        <div class="input-field">
                            {!! Form::submit('Confirmar',['class'=>'btn waves-effect waves-light']) !!}
                            <a href="#!" class="mr-10 modal-action modal-close waves-effect waves-green btn-flat">Volver</a>
                        </div>
                    </div>
                </div>
                {{-- Fin modal de confirmación --}}
            </div>
    	</div>
    </div>
    {!! Form::close() !!}
@endsection
@section('scripts')
        @if($errors)
            @foreach($errors->all() as $error)
                Materialize.toast('{{ $error }}', 4000);
            @endforeach
        @endif
        $("li").click(function(e){
            $("#metodo").val(e.target.id);
        });
        $("#formulario").submit(function(){
            if($("#metodo").val()==null||$("#metodo").val()==""){
                Materialize.toast("Debes elegir una forma de pago.",4000);
                return false;
            }
        });
        $("#continuar").click(function(){
            if($("#metodo").val()==""){
                Materialize.toast("Debes elegir una forma de pago.",4000);
                return false;
            }
            else if($("#metodo").val()=="Tarjeta"){
                $("#nombre").attr("required","required");
                $("#numero").attr("required","required");
                $("#mes").attr("required","required");
                $("#ano").attr("required","required");
                $("#cvc").attr("required","required");
                $("#confirmar").openModal();
            }
            else{
                $("#nombre").removeAttr("required");
                $("#numero").removeAttr("required");
                $("#mes").removeAttr("required");
                $("#ano").removeAttr("required");
                $("#cvc").removeAttr("required");
                $("#forma_pago").html($("#metodo").val());
                $("#confirmar").openModal();
            }

        });
@endsection
@section('functions')
    
@endsection