@extends('main')
@section('title','Pedidos | Forma de Pago')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.pedidos.store', 'method'=>'POST']) !!}
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
            <div class="row">
                <div id="paypal_p" class="col l2 offset-l2 br-2 center-align">
                    <a href="#!" onclick="paypal()">
                        <img src="{{asset('images/paypal.png')}}" class="responsive-img mt-5">
                    </a>
                    <h6>Paypal</h6>
                </div>
                <div id="oxxo_p" class="col l2 br-2 center-align">
                    <a href="#!" onclick="oxxo()">
                        <img src="{{asset('images/oxxo.png')}}" class="responsive-img mt-30">
                    </a>
                    <h6>Paypal</h6>
                </div>
                <div id="banco_p" class="col l2 br-2 center-align">
                    <a href="#!" onclick="banco()">
                        <img src="{{asset('images/banco.png')}}" alt="" class="responsive-img">
                    </a>
                </div>
                <div id="efectivo_p" class="col l2 br-2 center-align">
                    <a href="#!" onclick="efectivo()">
                        <img src="{{asset('images/cash.png')}}" alt="" class="responsive-img">
                    </a>
                </div>
            </div>
            <div class="row" id="oxxo">
                <div class="col l5">
                    
                </div>
                <div class="col l5">
                    
                </div>
            </div>
            <div class="row" id="banco">
                <div class="col l5">
                    
                </div>
                <div class="col l5">
                    
                </div>
            </div>
            <div class="row" id="efectivo">
                <div class="col l5">
                    
                </div>
                <div class="col l5">
                    
                </div>
            </div>
            <div id="continuar" class="row">
                <div class="col l12 center-align">
                    <input type="hidden" name="metodo">
                    {!! Form::submit('Continuar',['class'=>'btn waves-effect waves-light']) !!}
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
        $("#continuar").hide();
        $("#oxxo").hide();
        $("#banco").hide();
        $("#efectivo").hide();
@endsection
@section('functions')
    function back(){
        window.history.back();
    }
    function oxxo(){
        $("#paypal_p").css("background-color","");
        $("#oxxo_p").css("background-color","#a5d6a7");
        $("#banco_p").css("background-color","");
        $("#efectivo_p").css("background-color","");
    }
    function paypal(){
        $("#paypal_p").css("background-color","#a5d6a7");
        $("#oxxo_p").css("background-color","");
        $("#banco_p").css("background-color","");
        $("#efectivo_p").css("background-color","");
        $("#metodo").val(1);
        $("#continuar").show("slow");
    }
    function banco(){
        $("#paypal_p").css("background-color","");
        $("#oxxo_p").css("background-color","");
        $("#banco_p").css("background-color","#a5d6a7");
        $("#efectivo_p").css("background-color","");
    }
    function efectivo(){
        $("#paypal_p").css("background-color","");
        $("#oxxo_p").css("background-color","");
        $("#banco_p").css("background-color","");
        $("#efectivo_p").css("background-color","#a5d6a7");
    }
@endsection