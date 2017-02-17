@extends('layout.layout')

@section('content')
<?php use Carbon\Carbon;
	Carbon::setLocale('es');
	$edad = (new Carbon($user->fecha_nacimiento))->age;
?>

<section class="profile-section">
	<div class="container container-public-profile well">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h3>Perfil p&uacute;blico de {{$user->nombre}} {{$user->apellido}}</h3>
				<br>
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 text-center">
				<img src="{{URL::asset('images/profiles/'.$user->picture) }}" alt="" class="profile-img">
				<h4><strong>{{ $user->nombre }} {{ $user->apellido }}</strong></h4> 
				<br>
			</div>
			<div class="col-xs-6">
				<p>Usuario desde: {{$user->created_at->diffForHumans()}}</p>
				<p>Edad: {{$edad}} años</p>
				<p>Sexo: {{$user->genero == "M" ? "Hombre" : "Mujer"}}</p>
				<p>Viajes p&uacute;blicados: {{$user->viajes->count()}}</p>
				<p>Viajes como pasajero: {{$user->reservas->count()}}</p>
				<p>Facebook: {{$user->facebook_Id}}</p>
			</div>

		</div>
		<div class="row">
			<div class="col-xs-6 text-center">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Reputaci&oacute;n como conductor</h4>
					</div>
				  <div class="panel-body">
				  	<h1>5</h1>
				  	<p>Viajes realizados como conductor</p>
				  	<h3><i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</h3>
					<p>5/5 - 37 calificaciones</p>
				  </div>		
			</div>
			</div>
			<div class="col-xs-6 text-center">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Reputaci&oacute;n como pasajero</h4>
					</div>
					<div class="panel-body">
						<h1>0</h1>
				  		<p>Viajes realizados como pasajero</p>
						<h3><i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						</h3>
						<p>0/5 - 0 calificaciones</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>&Uacute;ltimos viajes p&uacute;blicados</h4>
					</div>
					<div class="panel-body">
						
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>&Uacute;ltimas calificaciones recibidas</h4>
					</div>
					<div class="panel-body">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection


@section('additionalScript')

@endsection