@extends('layout.layout')

@section('content')
<?php use Carbon\Carbon; ?>
<section class="profile-section">
	<div class="container container-profile well">
		<div class="row">
			<div class="col-xs-4 profile-col-left ">
			@include('partials.profile-col')
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
									<a><button class="btn-question" data-toggle="modal" data-target="#cancelModal" onclick="prepareDeleteId('{{$reserva->estado}}',{{$reserva->id}})">Eliminar reserva</button></a>
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


<div id="cancelModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">¿Est&aacute;s seguro de querer eliminar tu reserva en este viaje?</h4>
      </div>
      <div class="modal-body">
        <div class="alert modal-warning"><span id="mensaje_estado"></span></div>
      </div>
      <div class="modal-footer text-center" style="text-align: center">
      	<form action="{{ url('mi-cuenta/reservas/cancelar') }}" method="post">
      		{{csrf_field()}}
      		<input type="hidden" id="reserva_id" name="reserva_id">
      		<button type="submit" class="btn-question">Eliminar</button>
      		<button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
      	</form>
        
      </div>
    </div>

  </div>
</div>



@endsection


@section('additionalScript')
<script>
	function prepareDeleteId(estado,reserva_id){
		if(estado == "aceptada"){
			$('.modal-warning').removeClass("alert-info").addClass('alert-danger');
			var mensaje = "Tu reserva ya fue aceptada, el conductor del viaje cuenta con tu presencia. Si cancelas el viaje, autom&aacute;ticamente recibiras una  calificaciones de cero estrellas y tu reputaci&oacute;n se ver&aacute; afectada negativamente";
		}else{
			$('.modal-warning').removeClass("alert-danger").addClass('alert-info');
			var mensaje = "Tu solicitud de reserva aun no ha sido aprobada o rechaza por el conductor del viaje. ¿Realmente deseas cancelar tu solicitud?.";
		}
		$('#mensaje_estado').html(mensaje);
		$('#reserva_id').val(reserva_id);
	}
	

</script>


@endsection