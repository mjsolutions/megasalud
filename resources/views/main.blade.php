<!DOCTYPE html>
<html lang="es">
<head>
	<title>MegaSalud | @yield('title','Inicio')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('css/materialize.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
</head>
<body>
	<header>
		@yield('nav')
	</header>
	<main>
		<section>
			@include('flash::message')
			@yield('content')
		</section>
	</main>
	<footer class="page-footer blue darken-1">
	  <div class="container">
	    <div class="row">
	      <div class="col l6 s12">
	        <h5 class="white-text">MegaSalud Internacional</h5>
	        <p class="grey-text text-lighten-4">Todos los derechos reservados.</p>
	      </div>
	    </div>
	  </div>
	  <div class="footer-copyright">
	    <div class="container">
	    © 2016 Copyright Text
	    </div>
	  </div>
	</footer>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
	<script>
		$(document).ready(function(){
			$(".button-collapse").sideNav();
			if($('#flash-overlay-modal')[0]){
			    $('#flash-overlay-modal').openModal();   
			}
			@yield('scripts')
		});
	</script>
</body>
</html>