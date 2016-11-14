<!DOCTYPE html>
<html lang="es">
<head>
	<title>MegaSalud | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('css/materialize.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
	<link href="https://file.myfontastic.com/p33ryNdn2ug99gf3MgkiUK/icons.css" rel="stylesheet">
	<style type="text/css">
		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			height: 100vh;
		}
		form {
			padding: 30px!important;
		}
	</style>
</head>
<body>
	<main>
		<section>
			@include('flash::message')
			<div class="container">

					<div class="row">
						{!! Form::open(['method' => 'POST', 'class' => 'col s12 z-depth-2']) !!}
							<div class="row">
								<div class="input-field col s12">
         					{!! Form::email('email', null, ['class'=>'validate','required']) !!}
									{!! Form::label('email','Email') !!}
								</div>
							</div>
						{!! Form::close()!!}
						
					</div>

			</div>
		</section>
	</main>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="{{asset('js/materialize.js')}}"></script>
</body>
</html>