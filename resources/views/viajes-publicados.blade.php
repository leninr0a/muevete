<?php use Carbon\Carbon; ?>
@extends('layout.layout')

@section('content')
{{csrf_field()}}
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
					<a href="mis-viajes-pasajero" class="a-menu-profile">
						<div class="col-xs-12 text-left menu-profile-option ">
							<p><i class="fa fa-car"></i> Viajes como pasajero</p>
						</div>
					</a>
					<a class="a-menu-profile" href="/mi-cuenta/mis-viajes-publicados">
						<div class="col-xs-12 text-left menu-profile-option menu-profile-option-active">
							<p><i class="fa fa-car"></i> Viajes publicados</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xs-8 profile-col-right  ">
			@if(Auth::user()->viajes->count() == 0)
				<div class="alert alert-info">
				   No has publicado ning&uacute;n viaje.
				</div>
			@else
				@foreach ($viajes as $viaje)
						<?php 
						$reservas_aceptadas_count = 0;
						$reservas_pendientes_count = 0;
						?>
						<div class="panel panel-default">
						  <div class="panel-heading">
							<div class="row">
								<div class="col-xs-8">
									<h5><i class="fa fa-circle-o green"></i> {{$viaje->salida}} <i class="fa fa-long-arrow-right"></i> <i class="fa fa-circle-o red"></i> {{$viaje->llegada}} </h5>
								</div>
								<div class="col-xs-4 text-right">
									<h5><strong><i class="fa fa-calendar-check-o"></i> {{$fecha = (new Carbon($viaje->fecha))->toFormattedDateString()}}</strong> <strong><i class="fa fa-clock-o"></i> {{$viaje->hora}}</strong></h5>
								</div>
							</div>

						  </div>
						  <div class="panel-body">
							<div class="row">
								<div class="col-xs-12">
									
									<p> Precio: {{$viaje->precio}} Bs/<small>pasajero</small></p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<p> Asientos disponibles:
									@for ($i = 0; $i < $viaje->asientos; $i++)
									    <i class="fa fa-user-o"></i>
									@endfor

									 </p>
								</div>
								<div class="col-xs-12">
								Asientos reservados:
									<div class="perfil-reservado">
										<div class="row">
											<div class="col-xs-12 warning-holder-aceptadas-{{$viaje->id}}">
												 @if($viaje->reservas)
														@foreach($viaje->reservas as $reserva)
														@if($reserva->estado == 'aceptada')
														<?php $reservas_aceptadas_count++; ?>
														<div class="alert alert-warning alert-warning-mis-viajes" id="alert-reserva-{{$reserva->id}}">
														<div class="row">
															<div class="col-xs-3 text-center">
															<img src="{{URL::asset('images/profiles/'.$reserva->user->picture) }}" class="avatar-questions" alt="">
															</div>
															<div class="col-xs-4">
															<p>Nombre: {{$reserva->user->nombre}} {{$reserva->user->apellido}}</p>
															<p>Edad: {{$edad = (new Carbon($reserva->user->fecha_nacimiento))->age}} años</p>
															<p>Tel&eacute;fono: {{$reserva->user->telefono}}</p>

															</div>
															<div class="col-xs-5 text-center">
																
																	<button class="btn-reject-request btn-reject-{{$reserva->id}}" onclick="rejectRequest({{$reserva->id}},{{$viaje->id}})">Rechazar <i class="fa fa-close"></i>
																	</button>
															</div>
														</div>
														<div class="row">
															<div class="col-xs-12 text-right">
																<p><small>{{$reserva->created_at->diffForHumans()}}</small></p>
															</div>
														</div>
														</div>
														@endif
														@endforeach
														@if($reservas_aceptadas_count == 0)
															<div class="alert alert-warning alert-warning-no-passangers-{{$viaje->id}}">
															<div class="row">
																<div class="col-xs-12">
																	<p>No hay pasajeros para este viaje</p>
																</div>
															</div>
															</div>
														@endif
													@endif
											</div>	
										</div>
									</div>

								</div>
								<div class="col-xs-12">
									Solicitudes de reserva:
									<div class="perfil-reservado">
										<div class="row">
											<div class="col-xs-12 warning-holder-{{$viaje->id}}">
												
												   @if($viaje->reservas)
														@foreach($viaje->reservas as $reserva)
														@if($reserva->estado == 'pendiente')
														<?php $reservas_pendientes_count++;?>
														<div class="alert alert-warning alert-warning-mis-viajes" id="alert-reserva-{{$reserva->id}}">
														<div class="row">
															<div class="col-xs-3 text-center">
															<img src="{{URL::asset('images/profiles/'.$reserva->user->picture) }}" class="avatar-questions" alt="">
															</div>
															<div class="col-xs-4">
															<p>Nombre: {{$reserva->user->nombre}} {{$reserva->user->apellido}}</p>
															<p>Edad: {{$edad = (new Carbon($reserva->user->fecha_nacimiento))->age}} años</p>
															<p>Tel&eacute;fono: {{$reserva->user->telefono}}</p>

															</div>
															<div class="col-xs-5 text-center">
																
																	<button class="btn-accept-request btn-accept-{{$reserva->id}}" onclick="acceptRequest({{$reserva->id}},{{$viaje->id}})">Aceptar <i class="fa fa-check"></i>
																	</button>
																	<button class="btn-reject-request btn-reject-{{$reserva->id}}" onclick="rejectRequest({{$reserva->id}},{{$viaje->id}})">Rechazar <i class="fa fa-close"></i>
																	</button>
																

															</div>
														</div>
														<div class="row">
															<div class="col-xs-12 text-right">
																<p><small>{{$reserva->created_at->diffForHumans()}}</small></p>
															</div>
														</div>
														</div>
														@endif
														@endforeach
														@if($reservas_pendientes_count == 0)
														<div class="alert alert-warning alert-warning-mis-viajes-none" id="no-reservas-warning">
														<div class="row">
															<div class="col-xs-12">
																<p>No tienes solicitudes de reserva para este viaje</p>
															</div>
														</div>
														</div>
														@endif
												   @endif
												
											</div>	
										</div>
									</div>

								</div>
								<div class="col-xs-12">
									<p>Informacion adicional:</p>
									@if($viaje->informacion)
										{{$viaje->informacion}}
									@else
										<p><small><em>no agregaste informaci&oacute;n adicional</em></small></p>
									@endif
								</div>
						  </div>
						 
						</div>


						 <div class="panel-footer text-center">
						  	<a href="{{url('viajes/id/'.$viaje->id)}}"><button class="btn-question">Ver publicaci&oacute;n</button></a> <button class="btn-cancelar" data-toggle="modal" data-target="#myModal" onclick="prepareDeleteId({{$viaje->id}},{{$viaje->asientos_reservados}})">Cancelar viaje <i class="fa fa-trash-o"></i></button>
						  </div>
					</div>	
				@endforeach 
			@endif	
				<div class="row">
					<div class="col-xs-12 text-center">
						{{ $viajes->links() }}
					</div>
				</div>
		</div>


				
	</div>
</section>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">¿Est&aacute;s seguro de querer eliminar este viaje?</h4>
      </div>
      <div class="modal-body">
        <div class="alert modal-warning"><span id="asientos_reservados"></span></div>
      </div>
      <div class="modal-footer text-center" style="text-align: center">
      	<form action="{{ url('eliminar/viaje') }}" method="post">
      		{{csrf_field()}}
      		<input type="hidden" id="viaje_id" name="viaje_id">
      		<button type="submit" class="btn-question">Eliminar</button>
      	</form>
        <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('additionalScript')
	<script>
		function prepareDeleteId(viaje_id,asientos_reservados){
			if(asientos_reservados > 0){
				$('.modal-warning').removeClass( "alert-success").addClass('alert-danger');
				var mensaje = "Tienes <strong>"+asientos_reservados+"</strong> reservas para este viaje. Si cancelas el viaje, autom&aacute;ticamente recibiras <strong>"+asientos_reservados+"</strong> calificaciones de cero estrellas y tu reputaci&oacute;n se ver&aacute; afectada negativamente";
			}else{
				$('.modal-warning').removeClass( "alert-danger").addClass('alert-success');
				var mensaje = "Tienes 0 reservas de asiento en este viaje. Puedes cancelar el viaje y no recibir ning&uacute;n tipo de penalizaci&oacute;n.";
			}
			$('#asientos_reservados').html(mensaje);
			$('#viaje_id').val(viaje_id);
		}

		function acceptRequest(reserva_id,viaje_id){
			$.ajax({
		 		type: "POST",
	            url: 'reservas/aceptar',
	            data : {'reserva_id':reserva_id,'viaje_id':viaje_id,'_token':$('input[name=_token]').val()},
	            success: function (data) {
	            	$('.alert-warning-no-passangers-'+viaje_id).hide();
	            	$('.warning-holder-aceptadas-'+viaje_id).prepend($('#alert-reserva-'+reserva_id));
	            	$(".btn-accept-"+reserva_id).hide();
	            	if(data.reservas_pendientes == 0){
	            	$(".warning-holder-"+viaje_id).prepend("<div class='alert alert-warning alert-warning-mis-viajes-none'><div class='row'><div class='col-xs-12'><p>No tienes solicitudes de reserva para  este viaje</p></div></div></div>");
	            	}
	            	
	            	
	            	
	            	
	            	
	            }
	        });
		}

		function rejectRequest(reserva_id,viaje_id){
			$.ajax({
		 		type: "POST",
	            url: 'reservas/rechazar',
	            data : {'reserva_id':reserva_id,'viaje_id':viaje_id,'_token':$('input[name=_token]').val()},
	            success: function (data) {
	            console.log(data);

	            $('#alert-reserva-'+reserva_id).toggle(300,function(){
	            	var warning = $('.warning-holder-'+viaje_id+' '+'.alert-warning-mis-viajes-none');
	            	var warning_accepted = $('.alert-warning-no-passangers-' + viaje_id);
	            	console.log(warning);
	            	if(data.reservas_pendientes == 0 && warning.length == 0){
	            	$('.warning-holder-'+viaje_id).prepend("<div class='alert alert-warning alert-warning-mis-viajes-none'><div class='row'><div class='col-xs-12'><p>No tienes solicitudes de reserva para  este viaje</p></div></div></div>");
	            	}
	            	if(data.reservas_aceptadas == 0 && warning_accepted.length == 0){
	            	$(".warning-holder-aceptadas-"+viaje_id).prepend("<div class='alert alert-warning alert-warning-no-passangers-'"+viaje_id+"><div class='row'><div class='col-xs-12'><p>No hay pasajeros para este viaje</p></div></div></div>");
	            	}else{
	            		warning_accepted.show();
	            	}
	            	
	            });
	           
	            }
	        });
		}

	</script>
@endsection