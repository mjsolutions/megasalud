<!DOCTYPE html>
<html lang="es">
<head>
	<title>MegaSalud | @yield('title','Inicio')</title>
	<meta charset="UTF-8">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('css/materialize.min.css')}}">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script>
		$(document).ready(function(){
			$(".button-collapse").sideNav();
		});
	</script>
</head>
<body>
  	@include('admin.template.partials.nav')
	<section>
		@yield('content')
	</section>
</body>
</html>