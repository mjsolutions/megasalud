<!DOCTYPE html>
<html lang="es">
<head>
	<title>MegaSalud | @yield('title','Inicio')</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link href="https://file.myfontastic.com/p33ryNdn2ug99gf3MgkiUK/icons.css" rel="stylesheet">
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
	<footer>
		<div>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						Todos los derechos reservados.	    			
					</div>
					<div class="col-md-6 right-align">
						© {!! date('Y') !!}
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script>
		$(document).ready(function(){
			@yield('scripts')
		});
		@yield('functions')
	</script>
		@yield('scripts-2')
</body>
</html>