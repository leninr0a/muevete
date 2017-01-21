@extends('layout.layout')

@section('content')
<?php use Carbon\Carbon; ?>
<section class="profile-section">
	<div class="container container-profile well">
		<div class="row">
			<div class="col-xs-4 profile-col-left ">
				<div class="row">
					<div class="col-xs-12">
						<img src="{{URL::asset('images/profiles/'.Auth::user()->picture)}}" class="profile-img" alt="">
					</div>
				</div>
				<div class="row">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h3><strong>{{Auth::user()->nombre}} {{Auth::user()->apellido}}</strong></h3>
							
						</div>
					</div>
					<a href="perfil" class="a-menu-profile">
						<div class="col-xs-12 text-left menu-profile-option">
							<p><i class="fa fa-address-card-o"></i> Informaci&oacute;n personal</p>
						</div>
					</a>
					<div class="col-xs-12 text-left menu-profile-option menu-profile-option-active">
						<p><i class="fa fa-car"></i> Viajes como pasajero</p>
					</div>
					<a class="a-menu-profile" href="mis-viajes-publicados">
						<div class="col-xs-12 text-left menu-profile-option">
							<p><i class="fa fa-car"></i> Viajes publicados</p>
						</div>
					</a>
				</div>
			</div>
			@if(Auth::user()->reservas->count() == 0)
			<div class="col-xs-8 profile-col-right  ">
				<div class="alert alert-info">
				   No has enviado ninguna solicitud de reserva de asiento.
				</div>
			</div>
			@else
				<div class="col-xs-8 profile-col-right">
					@foreach(Auth::user()->reservas as $reserva)
					<?php $reservas_aceptadas = 0;?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-8">
									<h5><i class="fa fa-circle-o green"></i> {{$reserva->viaje->salida}} <i class="fa fa-long-arrow-right"></i> <i class="fa fa-circle-o red"></i> {{$reserva->viaje->llegada}} </h5>
								</div>
								<div class="col-xs-4 text-right">
									<h5><strong><i class="fa fa-calendar-check-o"></i> {{$fecha = (new Carbon($reserva->viaje->fecha))->toFormattedDateString()}}</strong> <strong><i class="fa fa-clock-o"></i> {{$reserva->viaje->hora}}</strong></h5>
								</div>
							</div>
						</div>
						<div class="panel-body">
							Conductor:
							<div class="alert alert-warning alert-warning-mis-viajes" id="alert-reserva-{{$reserva->id}}">
								<div class="row">
									<div class="col-xs-3 text-center">
									<img src="{{URL::asset('images/profiles/'.$reserva->viaje->user->picture) }}" class="avatar-questions" alt="">
									</div>
									<div class="col-xs-4">
										<p>Nombre: {{$reserva->viaje->user->nombre}} {{$reserva->viaje->user->apellido}}</p>
										<p>Edad: {{$edad = (new Carbon($reserva->viaje->user->fecha_nacimiento))->age}} años</p>
										<p>Tel&eacute;fono: {{$reserva->viaje->user->telefono}}</p>
									</div>
									<div class="col-xs-5 text-center">
										<p>Reputaci&oacute;n</p>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o"></i>
									</div>
									
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									Precio: {{$reserva->viaje->precio}} Bs: 
								</div>
							</div>
							Pasajeros:
							<div class="text-center">
								<div class="row">
									<div class="col-xs-12">										
										@foreach($reserva->viaje->reservas as $reservas_pasajeros)
											@if($reservas_pasajeros->estado == 'aceptada')
											<?php $reservas_aceptadas++; ?>
											<div class="asientos-reservados text-center">
												<img src="{{URL::asset('images/profiles/'.$reservas_pasajeros->user->picture)}}" class="avatar-questions" alt="">
												<p><small>{{$reservas_pasajeros->user->nombre}} {{$reservas_pasajeros->user->apellido}}</small></p>
											</div>
											@endif
										@endforeach
										@for($i=0;$i<($reserva->viaje->asientos-$reserva->viaje->asientos_reservados);$i++)
											<div class="asientos-reservados text-center">
												<img src="https://www.appointbetterboards.co.nz/Custom/Appoint/img/avatar-large.png" class="avatar-questions" alt="">
												<p><small>Asiento disponible</small></p>
											</div>
										@endfor
									</div>
									<div class="col-xs-12">
									<p>Estado de tu reserva: @if($reserva->estado == 'aceptada')<span class="green"><strong>{{$reserva->estado}}</strong></span>@elseif($reserva->estado == 'pendiente')<span class="warning"><strong>{{$reserva->estado}}</strong></span>@else<span class="red"><strong>{{$reserva->estado}}</strong></span> @endif</p>
								</div>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-xs-4 text-center">
									@if($reserva->estado =='aceptada' && $reserva->viaje->pago_online == 1)
										<a href="{{url('viajes/id/'.$reserva->viaje->id)}}"><button class="btn-question" >Pagar online</button></a>
									@endif
								</div>
								<div class="col-xs-4 text-center">
									<a href="{{url('viajes/id/'.$reserva->viaje->id)}}"><button class="btn-question">Ver publicaci&oacute;n</button></a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="{{url('viajes/id/'.$reserva->viaje->id)}}"><button class="btn-question">Eliminar reserva</button></a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			@endif
		</div>
	</div>
</section>
@endsection