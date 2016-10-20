@extends('main')
@section('title','Pedidos | Forma de Pago')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.pedidos.store', 'method'=>'POST', 'id'=>'formulario']) !!}
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
            {{-- <div class="row">
                <div class="col l4 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2">Nombre</span>
                </div>
                <div class="col l8" id="nombre">
                    {{$paciente->nombre." ".$paciente->apellido_p." ".$paciente->apellido_m}}
                </div>
            </div>
            <div class="row">
                <div class="col l4 right-align">
                    <span class="teal lighten-2 c-white p-8 br-2">Telefonos</span>
                </div>
                <div class="col l8" id="telefonos">
                    {{ "(".substr($paciente->telefono_a, 0, 3).") ".substr($paciente->telefono_a, 3, 3)."-".substr($paciente->telefono_a,6)." "."(".substr($paciente->telefono_b, 0, 3).") ".substr($paciente->telefono_b, 3, 3)."-".substr($paciente->telefono_b,6)}}
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
            <div class="input-field center-align">
                {!! Form::submit('Crear',['class'=>'btn waves-effect waves-light']) !!}
            </div> --}}
            <div class="container">
                <ul class="collapsible" data-collapsible="accordion">
                    <li >
                        <div class="collapsible-header" id="tarjeta">
                            <i class="icon-credit-card"></i>Tarjeta de credito o debito
                        </div>
                      <div class="collapsible-body">
                          <div class="container">
                              <div class="row">
                                  <div class="col l6"></div>
                                  <div class="col l6"></div>
                              </div>
                              <div class="row">
                                  <div class="col l6"></div>
                                  <div class="col l6"></div>
                              </div>
                              <div class="row">
                                  <div class="col l6"></div>
                                  <div class="col l6"></div>
                              </div>
                          </div>
                      </div>
                    </li>
                    <li>
                      <div class="collapsible-header" id="oxxo">
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
                      <div class="collapsible-header" id="deposito"><i class="icon-university"></i>Deposito Bancario</div>
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
                      <div class="collapsible-header" id="efectivo"><i class="icon-money"></i>Efectivo</div>
                      <div class="collapsible-body">
                            <p>Haz elegido seleccionado efectivo</p>
                      </div>
                    </li>
                </ul>
                <div class="row">
                    <div class="col l12 center-align">
                        <input type="hidden" name="metodo" id="metodo">
                        {!! Form::submit('Continuar',['class'=>'btn waves-effect waves-light']) !!}
                    </div>
                </div>
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
            }
            return false;
        });
@endsection
@section('functions')
    
@endsection