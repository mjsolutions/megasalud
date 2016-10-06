@extends('main')
@section('title','Pedidos | Nuevo')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.productos.store', 'method'=>'POST']) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Nuevo Pedido</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
	    	<div class="row">
                <div class="left-align col l6">
                    <h4>Paciente</h4>
                </div>
                <div class="col l6 input-field">
                    <i class="material-icons prefix">search</i>
                    {!! Form::text('busqueda_paciente', null, ['class'=>'validate','id'=>'busqueda_paciente']) !!}
                    <label for="icon_prefix2">Buscar paciente</label>
                </div>      
            </div>
            <div class="row">
                <div class="col l12">
                    <table class="responsive-table centered">
                        <thead>
                          <tr>
                              <th data-field="id">#</th>
                              <th data-field="name">Nombre</th>
                              <th data-field="sucursal">Sucursal</th>
                              <th data-field="phone">Telefono</th>
                              <th data-field="option">Opción</th>
                          </tr>
                        </thead>
                        <tbody id="pacientes">
                            
                        </tbody>
                    </table>
                </div>
            </div>
    	</div>
    </div>
    {!! Form::close() !!}
    {!! Form::open(['route'=>['admin.pedidos.busqueda_pacientes',':DATA'], 'method'=>'GET','id'=>'form']) !!}
    {!! Form::close() !!}
@endsection
@section('scripts')
        @if($errors)
            @foreach($errors->all() as $error)
                Materialize.toast('{{ $error }}', 4000);
            @endforeach
        @endif
        $("#busqueda_paciente").keyup(function(e){
            var form=$("#form");
            var url=form.attr('action').replace(':DATA',$("#busqueda_paciente").val());
            var data=$("#busqueda_paciente").val();
            if($("#busqueda_paciente").val().length>3)
                if(data!=null&&data!="")
                    $.get(url).done(function(data){
                    var datos=JSON.parse(data);
                    console.log(datos);
                    $("#pacientes").html("");
                        for(var i=0;i<datos.length;i++){
                            $("#pacientes").append(
                                "<tr>"+
                                    "<td>"+datos[i].id+"</td>"+
                                    "<td>"+datos[i].nombre+" "+datos[i].apellido_p+" "+datos[i].apellido_m+"</td>"+
                                    "<td>"+datos[i].users[0].sucursales[0].razon_social+"</td>"+
                                    "<td>"+datos[i].telefono_a+"</td>"+
                                    "<td><a class=\"waves-effect waves-light btn tooltipped\" data-position=\"right\" data-delay=\"50\" data-tooltip=\"Selecciona un paciente\">Seleccionar</a></td>"
                                +"</tr>"
                            );
                        }
                    });     
        });
@endsection