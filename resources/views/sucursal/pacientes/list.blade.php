@extends('main')
@section('title','Pacientes')
@section('nav')
	@include('sucursal.nav')
@endsection
@section('content')
    <div class="container">
    	<div class="card-panel">
            <div class="row">
                <div class="col push-s1 s10 center-align">
                    <h4>Pacientes</h4>
                </div>
                <div class="col pull-s1 s1">
                    <a class="btn-floating btn-large waves-effect waves-light green modal-trigger tooltipped" href="{!! route('sucursal.pacientes.create') !!}" data-position="right" data-delay="50" data-tooltip="Nuevo Paciente" ><i class="material-icons">add</i></a>
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
                    <th data-field="city">Ciudad</th>
                    <th data-field="telefono">Telefono</th>
                    <th data-field="option">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->id }}</td>
                            <td>{{ $paciente->nombre.' '.$paciente->apellido_p.' '.$paciente->apellido_m }}</td>
                            <td>{{$paciente->municipio}}</td>
                            <td>{{ "(".substr($paciente->telefono_a, 0, 3).") ".substr($paciente->telefono_a, 3, 3)."-".substr($paciente->telefono_a,6)." y "."(".substr($paciente->telefono_b, 0, 3).") ".substr($paciente->telefono_b, 3, 3)."-".substr($paciente->telefono_b,6) }}</td>
                            <td><a class="tooltipped btn-floating btn-small waves-effect waves-light mr-10" data-position="right" data-delay="50" data-tooltip="Detalles" onclick="detalle({{ $paciente->id }})"><i class="material-icons">receipt</i></a><a href="{!! route('sucursal.pacientes.edit', $paciente->id) !!}" data-position="right" data-delay="50" data-tooltip="Editar" class="tooltipped btn-floating btn-small waves-effect waves-light amber accent-3 mr-10"><i class="material-icons">edit</i></a><a href="{!! route('sucursal.pacientes.destroy', $paciente->id) !!}" data-position="right" data-delay="50" data-tooltip="Eliminar" class="tooltipped btn-floating btn-small waves-effect waves-light  red darken-1"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! Form::open(['route'=>['admin.pacientes.detalles',':USER_ID'], 'method'=>'GET','id'=>'form']) !!}
            {!! Form::close() !!}
            {{-- Inicio Modal de detalles  --}}
            <div id="detalles" class="modal">
                <div class="modal-footer">
                    <div class="plr-5" id="contenido">
                        <!-- ENcabezado -->
                        <div class="col s12 m8 offset-m2 l6 offset-l3">
                            <div class="card-panel grey lighten-5 z-depth-0">
                              <div class="row valign-wrapper">
                                <div class="col s4">
                                  <img src="{{ asset('images/user.jpg') }}" alt="" id="foto" class="circle responsive-img"> 
                                </div>
                                <div class="col s10">
                                  <span class="black-text" id="datos">
                                    
                                  </span>
                                </div>
                              </div>
                            </div>
                        </div>
                        <!-- Fin encabezado-->
                        <!-- Información de Contacto-->
                        <div class="col s12 m8 offset-m2 l6 offset-l3">
                            <div class="card-panel grey lighten-5 z-depth-2">
                              <div class="row valign-wrapper">
                                <div class="col l12 center-align">
                                  <legend><h5 class="c-blue-grey">Información de contacto</h5></legend>
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
                                        <span class="teal lighten-2 c-white p-8 br-2">Dirección</span>
                                    </div>
                                    <div class="col l8" id="direccion">
                                    
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
                                  <legend><h5 class="c-blue-grey">Datos generales</h5></legend>
                                </div>
                              </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Clave Bancaria</span>
                                    </div>
                                    <div class="col l8" id="clave">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">CURP</span>
                                    </div>
                                    <div class="col l8" id="curp">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">RFC</span>
                                    </div>
                                    <div class="col l8" id="rfc">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Fecha de Nacimiento</span>
                                    </div>
                                    <div class="col l8" id="fecha">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Sexo</span>
                                    </div>
                                    <div class="col l8" id="sexo">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Religión</span>
                                    </div>
                                    <div class="col l8" id="religion">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col l4 right-align">
                                        <span class="teal lighten-2 c-white p-8 br-2">Ocupación</span>
                                    </div>
                                    <div class="col l8" id="ocupacion">
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- Fin datos generales -->
                    </div>
                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
                </div>
            </div>
            {{-- Fin modal de detalles --}}
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
        var foto_default='{{asset('images/user.jpg')}}';
        $.get(url).done(function(data){
            var datos=JSON.parse(data);
            $("#datos").html(
                "<h4>"+datos.nombre+" "+datos.apellido_p+" "+datos.apellido_m+"</h4>"+
                "<h6>"+datos.email+"</h6>"
            );
            $("#nombre").html(
                "<span>"+datos.nombre+" "+datos.apellido_p+" "+datos.apellido_m+"</span>"
            );
            $("#telefonos").html(
                "<span>"+datos.telefono_a+" / "+datos.telefono_b+"</span>"
            );
            $("#direccion").html(
                "<span>"+datos.direccion+", "+datos.colonia+","+datos.municipio+" "+datos.estado+" "+datos.pais+". "+datos.cp+"</span>"
            );
            $("#cp").html(
                "<span>"+datos.cp+"</span>"
            );
            $("#sexo").html(
                "<span>"+datos.sexo+"</span>"
            );
            $("#curp").html(
                "<span>"+datos.curp+"</span>"
            );
            $("#rfc").html(
                "<span>"+datos.rfc+"</span>"
            );
            $("#mail").html(
                "<span>"+datos.email+"</span>"
            );
            $("#fecha").html(
                "<span>"+datos.fecha_nacimiento+"</span>"
            );
            $("#religion").html(
                "<span>"+datos.religion+"</span>"
            );
            $("#ocupacion").html(
                "<span>"+datos.ocupacion+"</span>"
            );
            $("#clave").html(
                "<span>"+datos.clave_bancaria+"</span>"
            );
            if(datos.foto!=""&&datos.foto!=null)
                $("#foto").attr("src",datos.ruta+"/"+datos.foto);
            else{
                $("#foto").attr("src",foto_default);
            }
            $("#detalles").openModal();
            
        });
    }
@endsection