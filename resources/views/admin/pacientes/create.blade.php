@extends('main')
@section('title','Pacientes | Nuevo')
@section('nav')
	@include('admin.nav')
@endsection
@section('content')
    {!! Form::open(['route'=>'admin.pacientes.store', 'method'=>'POST','files'=>true]) !!}
    <div class="container">
    	<div class="card-panel">
            <div class="center-align">
                <h3>Nuevo Paciente</h3>
            </div>
            <div class="row">
                <div class="col s8 col-center divider"></div>
            </div>
            <div class="row left-align">
                <div class="col l12">
                  <h5>Datos Generales</h5>
                </div>
            </div>
            <div class="row">
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    {!! Form::label('nombre','Nombre') !!}
                    {!! Form::text('nombre', null, ['class'=>'validate','required']) !!}
                </div>  
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    {!! Form::label('apellido_p','Apellido Paterno') !!}
                    {!! Form::text('apellido_p', null, ['class'=>'validate','required']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    {!! Form::label('apellido_m','Apellido Materno') !!}
                    {!! Form::text('apellido_m', null, ['class'=>'validate','required']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">perm_contact_calendar</i>
                    {!! Form::label('fecha','Fecha de Nacimiento') !!}
                    {!! Form::date('fecha', null, ['class'=>'datepicker','required']) !!}
                </div> 
              </div>
              <div class="col l4">
                <div class="input-field">     
                    {!! Form::radio('sexo','Masculino',false,['id'=>'sexo1','class'=>'with-gap']) !!}
                    {!! Form::label('sexo1','Masculino') !!}
                    {!! Form::radio('sexo','Femenino',false,['id'=>'sexo2','class'=>'with-gap']) !!}
                    {!! Form::label('sexo2','Femenino') !!}
                </div>
              </div>
              <div class="col l4">
                  <div class="input-field">
                      <i class="material-icons prefix">textsms</i>
                      {!! Form::label('email','Email') !!}
                      {!! Form::email('email',null,['class'=>'validate']) !!}
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col l6">
                <div class="input-field">
                    <i class="material-icons prefix">phone</i>
                    {!! Form::label('telefono_a','Telefono 1') !!}
                    {!! Form::number('telefono_a',null,['class'=>'validate']) !!}
                </div>
              </div>
              <div class="col l6">
                <div class="input-field">
                    <i class="material-icons prefix">phone</i>
                    {!! Form::label('telefono_b','Telefono 2') !!}
                    {!! Form::number('telefono_b',null,['class'=>'validate']) !!}
                </div>                
              </div>
            </div>
            <div class="row left-align">
                <div class="col l12">
                  <h5>Contacto</h5>
                </div>
            </div>
            <div class="row">
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">textsms</i>
                    {!! Form::label('pais_o','País de Origen') !!}
                    {!! Form::text('pais_o',null,['class'=>'autocomplete','id'=>'pais_o']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">textsms</i>
                    {!! Form::label('estado_o','Estado de Origen') !!}
                    {!! Form::text('estado_o',null,['class'=>'autocomplete','id'=>'estado_o']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">textsms</i>
                    {!! Form::label('municipio_o','Municipio de Origen') !!}
                    {!! Form::text('municipio_o',null,['class'=>'autocomplete','id'=>'municipio_o']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">textsms</i>
                    {!! Form::label('pais','País') !!}
                    {!! Form::text('pais',null,['class'=>'autocomplete','id'=>'pais']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">textsms</i>
                    {!! Form::label('estado','Estado') !!}
                    {!! Form::text('estado',null,['class'=>'autocomplete','id'=>'estado']) !!}
                </div>                
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">textsms</i>
                    {!! Form::label('municipio','Municipio') !!}
                    {!! Form::text('municipio',null,['class'=>'autocomplete','id'=>'municipio']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">my_location</i>
                    {!! Form::label('direccion','Dirección') !!}
                    {!! Form::text('direccion',null,['class'=>'validate']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">my_location</i>
                    {!! Form::label('colonia','Colonia') !!}
                    {!! Form::text('colonia',null,['class'=>'validate']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">my_location</i>
                    {!! Form::label('cp','Código Postal') !!}
                    {!! Form::text('cp',null,['class'=>'validate']) !!}
                </div>
              </div>
            </div>
            <div class="row left-align">
                <div class="col l12">
                  <h5>Información adicional</h5>
                </div>
            </div>
            <div class="row">
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">perm_identity</i>
                    {!! Form::label('curp','CURP') !!}
                    {!! Form::text('curp',null,['class'=>'validate']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">perm_identity</i>
                    {!! Form::label('rfc','RFC') !!}
                    {!! Form::text('rfc',null,['class'=>'validate']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    {!! Form::label('religion','Religión') !!}
                    {!! Form::text('religion',null,['class'=>'validate']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">group_work</i>
                    {!! Form::label('ocupacion','Ocupación') !!}
                    {!! Form::text('ocupacion',null,['class'=>'validate']) !!}
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">perm_identity</i>
                    {!! Form::select('sucursal',$sucursales,null,['id'=>'sucursal','placeholder'=>'Elige una sucursal']) !!}
                    <input type="hidden" id="medico_id" value="">
                </div>
              </div>
              <div class="col l4">
                <div class="input-field">
                    <i class="material-icons prefix">perm_identity</i>
                    {!! Form::select('medico',[],null,['id'=>'medico','placeholder'=>'Elige un médico']) !!}
                    <input type="hidden" id="medico_id" value="">
                </div>
              </div>
            </div>
            <div class="input-field file-field">
                <div class="btn">
                    <span>
                        Fotografía        
                    </span>
                    {!! Form::file('foto') !!}
                </div>
                <div class="file-path-wrapper">
                    {!! Form::text('foto_1',null,['class'=>'file-path validate','placeholder'=>'Selecciona un fotografía']) !!}
                </div>
            </div>
            
            <div class="input-field center-align">
                {!! Form::submit('Crear',['class'=>'btn waves-effect waves-light']) !!}
            </div>
    	</div>
    </div>
    {!! Form::close() !!}
    {!! Form::open(['route'=>['admin.pacientes.medico',':USER_ID'], 'method'=>'GET','id'=>'form']) !!}
    {!! Form::close() !!}
@endsection
@section('scripts')
  @if($errors)
      @foreach($errors->all() as $error)
          Materialize.toast('{{ $error }}', 4000);
      @endforeach
  @endif
  $.get('{!! route('admin.pacientes.pais') !!}').done(function(datos){
      $('#pais_o.autocomplete').autocomplete({
      data:JSON.parse(datos)
      });
  });
  $.get('{!! route('admin.pacientes.estado') !!}').done(function(datos){
      $('#estado_o.autocomplete').autocomplete({
      data:JSON.parse(datos)
      });
  });
  $.get('{!! route('admin.pacientes.ciudad') !!}').done(function(datos){
      $('#municipio_o.autocomplete').autocomplete({
      data:JSON.parse(datos)
      });
  });
  $.get('{!! route('admin.pacientes.pais') !!}').done(function(datos){
      $('#pais.autocomplete').autocomplete({
      data:JSON.parse(datos)
      });
  });
  $.get('{!! route('admin.pacientes.estado') !!}').done(function(datos){
      $('#estado.autocomplete').autocomplete({
      data:JSON.parse(datos)
      });
  });
  $.get('{!! route('admin.pacientes.ciudad') !!}').done(function(datos){
      $('#municipio.autocomplete').autocomplete({
      data:JSON.parse(datos)
      });
  });
  $("#sucursal").change(function(){
      var form=$("#form");
      var url=form.attr('action').replace(':USER_ID',$("#sucursal").val());
      $('#medico').material_select('destroy');
      $('#medico').html("<option value='0'>Selecciona un médico</option>");
      $.get(url).done(function(data){
        $.each(data,function(ind,elem){
          $("#medico").append(
              "<option value='"+ind+"'>"+elem+"</option>"
          );
        });
        $('#medico').material_select('update');
      });
  });
@endsection
@section('scripts-2')
  <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
  <script type="text/javascript">
    var date = new Date();
    initDatepicker({
        selectYears: 100,
        min: [date.getFullYear() - 100, date.getMonth(), date.getDate()],
        max: [date.getFullYear(), date.getMonth(), date.getDate()],
        hiddenName: 'fecha',
        hiddenSuffix: '_nacimiento'
            });
    
  </script>
@endsection