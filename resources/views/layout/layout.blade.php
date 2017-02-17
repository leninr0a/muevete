<?php use Carbon\Carbon;
	Carbon::setLocale('es');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }} ">
	<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }} "> 
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-timepicker.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/checkboxes.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/vesper-icons.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald|Roboto" rel="stylesheet">
	
</head>
<header class="header">
		<div class="container">
			<div class="row menu-row">
				<div class="col-xs-2 col-logo">
					<img src="{{ URL::asset('images/logo-2.png') }}" class="img-responsive" alt="">
				</div>
				<div class="col-xs-10 text-right">
					<ul class="menu navbar navbar-right">
						<a href="{{url('/')}}"><li>Inicio</em></li></a>
						<a href="{{url('publicar')}}"><li>Publicar viaje <i class="fa fa-automobile"></i></li></a>
						
						 <!-- Authentication Links -->
                        @if (Auth::guest())
                            <a href="{{url('register')}}"><li>Registrarse</li></a>
                            <li class="dropdown">
		                        <a  class="dropdown-toggle menu-link" data-toggle="dropdown">Ingresar <span class="caret"></span></a>
		                        <ul class="dropdown-menu dropdown-lr animated flipInX" role="menu">
		                          	<li class="row">
		                          		<form action="{{ url('/login') }}" method="POST">
		                          			{{ csrf_field() }}
			                          		<div class="col-xs-12">
			                          			<div class="input-group">	
													<span class="input-group-addon"><i class="fa fa-at fa-log-in"></i></span><input type="email" name="email" class="form-control input-login" placeholder="E-mail"  required>
			                          			</div>
			                          		</div>
			                          		<div class="col-xs-12">
			                          			<div class="input-group">	
													<span class="input-group-addon"><i class="fa fa-lock fa-log-in">	</i></span><input type="password" name="password" class="form-control input-login" placeholder="Contrase&ntilde;a" required >
			                          			</div>
			                          		</div>

			                          		<div class="col-xs-12 text-center">	
			                          				<button class="btn-log-in" type="submit">Iniciar sesi&oacute;n</button>
			                          		</div>
		                          		</form>
		                          		<p class="text-center"><a href=""><small>¿Olvidaste tu contrase&ntilde;a?</small></a></p>
		                          		<div class="col-xs-12 ">
		                          				<hr>	
		                          			<a href="{{ url('/auth/facebook')}}"><img src="{{URL::asset('images/btn_facebook.png')}}" class="img-responsive" alt=""></a>
		                          		</div>
		                          		
		                          	</li>
		                        </ul>
	                    	</li>
                        @else
                        	<a href="{{url('/mi-cuenta/perfil')}}"><li>{{Auth::user()->nombre}} <i class="fa fa-user-o"></i></li></a>
                        	<a href="{{url('/logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        	<li>Salir <i class="fa fa-close"></i>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}</form></li></a>
                            <li class="dropdown">
							<a  class="dropdown-toggle menu-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> ({{Auth::user()->notifications->count()}})</a>
							<div class="dropdown-menu dropdown-not animated flipInX" role="menu">
		                    	<div class="row">
			                    	<div class="col-xs-12 text-center">
			                    		<p>Notificaciones</p>
			                    	</div>
			                    	@if(Auth::user()->unreadNotifications->count() == 0)
										<div class="col-xs-12 notification-row">
											<div class="row">
												<div class="col-xs-8 col-xs-offset-2 text-center">
													<p>No tienes ninguna notificaci&oacute;n</p>
												</div>
											</div>
										</div>
									@else
				                    	@for($i = 0; $i< 3;$i++)
				                    		@if($i < Auth::user()->notifications->count())
										<div class="col-xs-12 notification-row">
				                    		<div class="row">
				                    			<div class="col-xs-3 ">
				                    				<img src="{{URL::asset('images/profiles/'.Auth::user()->notifications[$i]->data['sender']['picture']) }}" class="avatar-questions"  alt="">
				                    			</div>
				                    			<div class="col-xs-7 text-left">
				                    				<small>{{Auth::user()->notifications[$i]->data["message"]}}</small>
				                    			</div>
				                    			<div class="col-xs-2">
				                    				<small>{{Auth::user()->notifications[$i]->created_at->diffForHumans()}}</small>
				                    			</div>
				                    		</div>
				                    	</div>
				                    		@endif
				                    	@endfor
				                    @endif	
			                    	<div class="col-xs-12 text-center notification-see-all">
			                    		<p><small><a class="change-button" href="{{url('mi-cuenta/notificaciones')}}">ver todas</a></small></p>
			                    	</div>
			                    <div>
		                    	
		                    </div>
		                    </li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</header>

<body>
	
	<section class="contenido">
		@yield('content')


		<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p><small>&copy; 2016 Mu&eacute;vete. Todos los derechos reservados.</small></p>
				</div>
			</div>
		</div>
	</footer>
	</section>
	



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ URL::asset('js/bootstrap-timepicker.min.js') }}"></script>
  
  
  @yield('additionalScript')
</body>
</html>