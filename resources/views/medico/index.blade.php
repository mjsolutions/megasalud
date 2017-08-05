@extends('main')
@section('title','Médico')
@section('nav')
@include('medico.nav')
@endsection
@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
	  <div class="panel-heading clearfix">
	    <h2 class="panel-title pull-left">Información Personal</h2>
	      <a class="btn btn-primary pull-right" href="#">
	        <i class="fa fa-pencil"></i>
	        Editar
	      </a>
	    </div>
	    <div class="list-group">
	      <div class="list-group-item panel-body">
	      	<img src="{{ asset('images/users/medicos/no-img.png') }}" alt="..." class="foto-users img-rounded img-responsive pull-left">
	        <p class="list-group-item-text">Nombre</p>
	        <h4 class="list-group-item-heading">Dr. Jaime Rodriguez Solis</h4>
	        <p class="list-group-item-text">Especialidad</p>
	        <h4 class="list-group-item-heading">Inmunología</h4>
	        <p class="list-group-item-text">Correo</p>
	        <h4 class="list-group-item-heading"><em>jsolis@megasalud.com.mx</em></h4>
	        <p class="list-group-item-text">Sucursal</p>
	        <h4 class="list-group-item-heading">Morelia Centro</h4>
	        <p class="list-group-item-text">Cedula</p>
	        <h4 class="list-group-item-heading">----</h4>
	      </div>
	    </div>
	  <div class="panel-footer">
	    <small></small>
	  </div>
	</div>
  </div>
  <div class="col-md-6">
	<div class="panel panel-default">
	  <div class="panel-heading clearfix">
	    <form>
	        <div class="row">
	          <div class="col-xs-9">
	            <div class="form-group">
	              <input type="text" class="form-control" placeholder="Juanito Perez">
	              <i class="fa fa-search"></i>
	            </div>
	          </div>
	          <div class="col-xs-3">
	            <a class="btn btn-primary btn-block" href="#">
	              <i class="fa fa-plus"></i>
	              Búscar
	            </a>
	          </div>
	        </div>
	      </form>
	  </div>
	  <div class="panel-body">
		<div class="bootcards-list">
		  <div class="panel panel-default">
		    <div class="list-group">
		      <a class="list-group-item" href="#">
		        <img src="/images/Sofia Acey.jpg" class="img-rounded pull-left"/>
		        <h4 class="list-group-item-heading">Martín Gonzalez</h4>
		        <p class="list-group-item-text">63 Años</p>
		      </a>
		      <a class="list-group-item" href="#">
		        <img src="/images/Joseph Barish.jpg" class="img-rounded pull-left"/>
		        <h4 class="list-group-item-heading">María Josefina</h4>
		        <p class="list-group-item-text">40 años</p>
		      </a>
		      <a class="list-group-item" href="#">
		        <img src="/images/Sarah Benson.jpg" class="img-rounded pull-left"/>
		        <h4 class="list-group-item-heading">Ignacio Mota</h4>
		        <p class="list-group-item-text">43 años</p>
		      </a>
		    </div>
		  </div>
		</div>
	  </div>
	  <div class="panel-footer">
	  </div>
	</div>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
		
	</div>
</div>

@endsection
