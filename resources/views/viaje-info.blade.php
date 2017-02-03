@extends('layout.layout')

@section('title','Informaci&oacute;n del viaje')

@section('content')

<?php use Carbon\Carbon;
	Carbon::setLocale('es');
 ?>

<div class="content-viaje-info">
		<div class="container container-viaje-info">
		<div class="row first-row-travel-info">
			<div class="col-xs-6">
				<h3 class="text-center">Detalles del viaje</h3>
				<p class="city-h3"><i class="glyphicon glyphicon-map-marker green"></i> <span id="salida">{{$viaje->salida}}</span></p>
				<p class="city-h3"><i class="glyphicon glyphicon-map-marker red"></i> <span id="llegada">{{$viaje->llegada}}</span></p>
				<input type="hidden" id="salidaLat" value={{$viaje->salidaLat}}>
				<input type="hidden" id="salidaLng" value={{$viaje->salidaLng}}>
				<input type="hidden" id="llegadaLat" value={{$viaje->llegadaLat}}>
				<input type="hidden" id="llegadaLng" value={{$viaje->llegadaLng}}>
				<p><i class="fa fa-calendar-o"></i> {{$fecha = (new Carbon($viaje->fecha))->format('l jS \\of F Y')}}</p>
				<p><i class="fa fa-clock-o"></i> Hora de salida: {{$viaje->hora}}</p>
				<p><i class="fa fa-road"></i> Distancia: <span id="distancia-span"></span></p>
				<p><i class="fa fa-hourglass-2"></i> Duraci&oacute;n estimada: <span id="duracion-span"></span></p>
				<p><i class="fa fa-automobile"></i> Veh&iacute;culo: {{$viaje->vehiculo->marca}} {{$viaje->vehiculo->modelo}}, {{$viaje->vehiculo->anio}}</p>
				<p><i class="fa fa-quote-left"></i> Informaci&oacute;n adicional:</p>
				@if($viaje->informacion == "")
				<p><em>El conductor no agreg&oacute; informaci&oacute;n adicional</em></p>
				@else
				<p>{{$viaje->informacion}}</p>
				@endif

				<h3 class="text-center price oswald">{{$viaje->precio}} <small>Bs</small></h3>
				
				

			
			</div>
			<div class="col-xs-6 text-center">
				 <div id="map"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-6">
				<div class="row">
						<div class="col-xs-4 text-center">
						<span class="fa-stack fa-2x">
							  <i class="fa fa-snowflake-o aire-icon fa-stack-1x"></i>
							  @if(!$viaje->aire)
							  <i class="fa fa-ban air-ban fa-stack-2x  text-danger"></i>
							  @endif									
						</span>
							@if($viaje->aire)
								<p>Llevo aire acondicionado</p>
							@else
								<p>No llevo aire acondicionado</p>
							@endif
						</div>
						<div class="col-xs-4 text-center">
							<span class="fa-stack fa-2x">
								  <i class="vs vs-smoking-alt fumar-icon  fa-stack-1x"></i>
								  @if(!$viaje->fumar)
								  <i class="fa fa-ban smoke-ban fa-stack-2x  text-danger"></i>
								  @endif
							</span>	
								@if($viaje->fumar)
								<p>Se puede fumar en el auto</p>
								@else
								<p>No se puede fumar en el auto</p>
								@endif					
						</div>
						<div class="col-xs-4 text-center">
							<span class="fa-stack fa-2x">
								  <i class="vs vs-drumstick comida-icon fa-stack-1x"></i>
								  @if(!$viaje->comer)
								  <i class="fa fa-ban food-ban fa-stack-2x  text-danger"></i>
								  @endif
							</span>	
								@if($viaje->comer)
								<p>Se puede comer en el auto</p>
								@else
								<p>No se puede comer en el auto</p>
								@endif					
						</div>
						<div class="col-xs-4 text-center">
							<span class="fa-stack fa-2x">
								  <i class="fa fa-music musica-icon fa-stack-1x"></i>
								  @if(!$viaje->musica)
								  <i class="fa fa-ban ban-music fa-stack-2x  text-danger"></i>
								  @endif
							</span>	
								@if($viaje->musica)
								<p>Viajo con m&uacute;sica</p>
								@else
								<p>Viaje sin m&uacute;sica</p>
								@endif					
						</div>
						<div class="col-xs-4 text-center">
							<span class="fa-stack fa-2x">
								  <i class="fa fa-paw mascotas-icon fa-stack-1x"></i>
								  @if(!$viaje->mascotas)
								  <i class="fa fa-ban  fa-stack-2x  text-danger"></i>
								  @endif
							</span>	
								@if($viaje->mascotas)
								<p>Se permiten mascotas</p>
								@else
								<p>No se permiten mascotas</p>
								@endif					
						</div>
						<div class="col-xs-4 text-center">
								<span class="fa-stack fa-2x">
								  <i class="vs vs-baby ninios-icon fa-stack-1x"></i>
								  @if(!$viaje->ninios)
								  <i class="fa fa-ban baby-ban fa-stack-2x  text-danger"></i>
								  @endif
								</span>	
								@if($viaje->ninios)
								<p>Se permiten niños</p>
								@else
								<p>No se permiten niños</p>
								@endif					
						</div>
				</div>

			</div>

			<div class="col-xs-6">
				<div class="row">
				<div class="col-xs-6 text-right">
					<img  src="{{URL::asset('images/profiles/'.$viaje->user->picture) }}" class="avatar-conductor" style="float:right" alt="">

				</div>
				<div class="col-xs-4 ">
					<p class="text-center"><span id="nombre-conductor">{{$viaje->user->nombre}} {{$viaje->user->apellido}}</span>
					<br>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-o"></i>
						<br>
					<small>

					@if($viaje->user->genero == 'M')
						Hombre
					@else
						Mujer
					@endif
					<br>{{$edad = (new Carbon($viaje->user->fecha_nacimiento))->age}} años <br>

					</small>
					</p>
				</div>
				</div>
			</div>
		
		</div>




		<div class="row">
			<div class="col-xs-6">
				   
			</div>
		</div>

		<div class="row second-row-travel-info text-center">
				<div class="col-xs-6">
					<div class="panel panel-default panel-fixed-height">
						<div class="panel-heading">Asientos disponibles ({{$viaje->asientos - $viaje->asientos_reservados}})</div>
						<div class="panel-body">
						@if($viaje->asientos - $viaje->asientos_reservados  > 0)
							@for($i=0;$i<$viaje->asientos-$viaje->asientos_reservados;$i++)
								<div class="asientos-reservados">
									<img src="https://www.appointbetterboards.co.nz/Custom/Appoint/img/avatar-large.png" class="avatar-asientos" alt="">
								</div>
							@endfor
							@if(Auth::check() && Auth::user()->id == $viaje->user->id)
								<p> </p>
							@elseif(Auth::check())
								<?php $reserva_already_sent=false;?>
								@foreach($viaje->reservas as $reserva)
									@if(Auth::user()->id == $reserva->user_id)
										<?php $reserva_already_sent = true; ?>
										<p>Solicitud de reserva enviada</p>
										<p>Estado: <strong>{{$reserva->estado}}</strong></p>
									@endif
								@endforeach

								@if($reserva_already_sent == false)
								<span class="reservar-form">
									{{csrf_field()}}
									<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
									<input type="hidden" name="viaje_id" value="{{$viaje->id}}">
									<button class="btn-reservar">Reservar asiento</button>
								</span>
								@endif
							@else
								<button class="btn-reservar">Inicia sesi&oacute;n para reservar</button>
							@endif
							
						@else
							No hay asientos disponibles
						@endif	
						</div>
					</div>

				</div>
				<div class="col-xs-6">
					<div class="panel panel-default panel-fixed-height">
						<div class="panel-heading">Asientos reservados ({{$viaje->asientos_reservados}})</div>
						<div class="panel-body">
						@if($viaje->asientos_reservados > 0)
							@foreach($viaje->reservas as $reserva)
								@if($reserva->estado == "aceptada")
									<div class="asientos-reservados">
										<img src="{{URL::asset('images/profiles/'.$reserva->user->picture) }}" class="avatar-asientos" alt="">
										<p>{{$reserva->user->nombre}} {{$reserva->user->apellido}} <br><small>{{$edad = (new Carbon($reserva->user->fecha_nacimiento))->age}} años</small></p>
									</div>
								@endif
							@endforeach
						@else
							<p>Ning&uacute;n asiento reservado</p>
						@endif
						</div>
					</div>
					
				</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-center">
				@if(Auth::check() && Auth::user()->id == $viaje->user->id)
					<h3 class="preguntas-title">Preguntas que te han hecho <i class="fa fa-comments-o"></i></h3>
					@if($viaje->preguntas->count() == 0)
						<div class="alert alert-info">
							<p>	A&uacute;n no te han realizado preguntas <i class="fa fa-comments-o"></i></p>
						</div>
					@endif
				@else
					<h3 class="preguntas-title">¿Tienes alguna pregunta?
					<i class="fa fa-comments-o"></i></h3>
				@endif
				
			</div>
			<div class="col-xs-12">
			
				@foreach($viaje->preguntas as $pregunta)
					<div class="row question">
						<div class="col-xs-1">
							<img src="{{URL::asset('images/profiles/'.$pregunta->user->picture) }}" class="avatar-questions" alt="">
						</div>
						<div class="col-xs-11">
							<div class="row">
								<div class="col-xs-8">
									<p><strong>{{$pregunta->user->nombre}} {{$pregunta->user->apellido}}</strong> </p>
								</div>
								<div class="col-xs-4 text-right">
									 <p><small>publicado {{$pregunta->created_at->diffForHumans()}}</small> </p>
								</div>
							</div>
							<p>{{$pregunta->pregunta}}</p>
							 
							@if($pregunta->respuesta != null)
								<div class="alert alert-info respuesta">
								   <div class="row">
								   		<div class="col-xs-1">
											<img src="{{URL::asset('images/profiles/'.$pregunta->respuesta->user->picture) }}" class="avatar-questions" alt="">			   			
								   		</div>
								   		<div class="col-xs-11">
								   			<div class="row">
								   				<div class="col-xs-8">
								   					<p><strong>{{$pregunta->respuesta->user->nombre}} {{$pregunta->respuesta->user->apellido}} </strong><small>(Conductor)</small> </p>
								   				</div>
								   				<div class="col-xs-4 text-right">
								   					<p><small>publicado {{$pregunta->respuesta->created_at->diffForHumans()}}</small></p>
								   				</div>
								   			</div>
								   			<p>{{$pregunta->respuesta->respuesta}}</p>
								   			@if(Auth::check() && Auth::user()->id == $viaje->user->id)
								   				<form action="{{$viaje->id}}/respuestas/delete" method="post">
								   					{{csrf_field()}}
													<input type="hidden" name="respuesta_id" value="{{$pregunta->respuesta->id}}">
													<input type="hidden" name="viaje_id" value="{{$viaje->id}}">
													<button class="eliminar-pregunta"><small><i class="fa fa-trash-o"></i> Eliminar respuesta</small></button>
												</form>
								   			@endif 		   			
								   		</div>
								   </div>
								</div>
							@endif
							@if(Auth::check() && Auth::user()->id == $pregunta->user->id)
								<form action="{{$viaje->id}}/preguntas/delete" method="post">
									{{csrf_field()}}
									<input type="hidden" name="pregunta_id" value="{{$pregunta->id}}">
									<input type="hidden" name="viaje_id" value="{{$viaje->id}}">
									<button class="eliminar-pregunta"><small><i class="fa fa-trash-o"></i> Eliminar pregunta</small></button>
								</form>
				   			@endif
						</div>
					
						@if(Auth::check() && Auth::user()->id == $viaje->user->id)
							@if($pregunta->respuesta == null)
							<div class="col-xs-11 col-xs-offset-1 ">
								 <span class="reply-text" onclick="openReplyForm({{$pregunta->id}})"><small><i class="fa fa-reply"></i> Responder</small></span> 
							</div>
							<div class="col-xs-11 col-xs-offset-1 reply-form" id="reply-form-{{$pregunta->id}}" style="display: none;">
								<form action="{{$viaje->id}}/respuestas/create" method="post">
									{{csrf_field()}}
									<input type="hidden" name="viaje_id" value="{{$viaje->id}}">
									<input type="hidden" name="user_id" value="{{$viaje->user->id}}">
									<input type="hidden" name="pregunta_id" value="{{$pregunta->id}}">
									<textarea class="form-control" name="respuesta" id="" cols="30" rows="3" placeholder="Escribe aqu&iacute; tu respuesta"></textarea>
									<button class="btn-question">Enviar</button>
									<button class="btn-cancelar" type="button" onclick="openReplyForm({{$pregunta->id}})">Cancelar</button>
								</form>
							</div>
							@endif	
						@endif
					</div>
				@endforeach
				
			
			</div>

		</div>
		
		@if(Auth::check() && Auth::user()->id !== $viaje->user->id)
			<div class="row make-question-row">
				<div class="col-xs-12">
					<form action="{{$viaje->id}}/preguntas/create" method="POST">
						<textarea class="form-control" name="pregunta" id=""  rows="5" placeholder="Escribe aqu&iacute; tu pregunta" required></textarea>
						{{csrf_field()}}
						<input type="hidden" name="viaje_id" value="{{$viaje->id}}">
						@if(Auth::check())
							<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
						@else
							<input type="hidden" name="user_id" value="">
						@endif
						<button class="btn-question" id="btn-send-question">Enviar pregunta</button>

					</form>
				</div>
			</div>
		@endif
	</div>
</div>
	
	<!-- Modal -->
        <div id="reservaModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                @if(Auth::check())
                	<h4 class="modal-title"><strong>{{Auth::user()->nombre}}</strong>, tu solicitud de reserva ha sido enviada con &eacute;xito</h4>
                @endif
              </div>
              <div class="modal-body">
                <p>Tu solicitud ha sido enviada con &eacute;xito. Te avisaremos via e-mail cuando el conductor del viaje ({{$viaje->user->nombre}} {{$viaje->user->apellido}}) responda a tu solicitud.</p>
               
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>

          </div>
        </div>


@endsection


@section('additionalScript')
	 <script>
	 	function openReplyForm(idPregunta){
	 		$("#reply-form-"+idPregunta).toggle(300);
	 	}

	 	$(".btn-reservar").click(function(){
		 	$.ajax({
		 		type: "POST",
	            url: $("input[name=viaje_id]").val()+'/reservas/create',
	            data : {'viaje_id':$("input[name=viaje_id]").val(),'user_id':$("input[name=user_id]").val(), '_token': $('.reservar-form input[name=_token]').val()},
	            success: function (data) {
	            	console.log(data);
	                $("#reservaModal").modal();

	            },
	            error: function (data) {
	                console.log(data);
	            }
	        });
	         $('.btn-reservar').prop('disabled', true);
	         $('.btn-reservar').html("Solicitud enviada");
	 	});
	 </script>

     <script>
     function initMap(){
     	 var pinImage = new google.maps.MarkerImage("{{asset('images/map_marker2.png')}}");
 		 var salida=document.getElementById("salida").innerHTML;
 		 var llegada=document.getElementById("llegada").innerHTML;
 		 var salidaPos = new google.maps.LatLng(parseFloat(document.getElementById("salidaLat").value),parseFloat(document.getElementById("salidaLng").value));
 		 var llegadaPos = new google.maps.LatLng(parseFloat(document.getElementById("llegadaLat").value),parseFloat(document.getElementById("llegadaLng").value));
		  var directionsService = new google.maps.DirectionsService;
		  var directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions: {strokeColor:"#2e9afe"}});

		  directionsDisplay.setOptions({suppressMarkers:true});

		  var map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 7,
		    center: {lat: 10.5, lng: -66.91}
		  });

		 	var startMarker = new google.maps.Marker({
			   	position: salidaPos,
				map: map,
				icon: pinImage
			});

		 	var stopMarker = new google.maps.Marker({
			   	position: llegadaPos,
				map: map,
				icon: pinImage
			});


		  directionsDisplay.setMap(map);
		  directionsService.route({
			origin: salidaPos,
			destination: llegadaPos,
			travelMode: google.maps.TravelMode.DRIVING
			}, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
			  $('#distancia-span').html(response.routes[0].legs[0].distance.text);
			  $('#duracion-span').html(response.routes[0].legs[0].duration.text);
			  directionsDisplay.setDirections(response);
			} else {
			  window.alert('Directions request failed due to ' + status);
			}
			});

		 
		  var styles=[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#ffffff"},{"visibility":"on"}]}];

		  map.setOptions({styles: styles,scrollwheel: false,zoomControl:false,streetViewControl: false,mapTypeControl:false });
		  

	}

	
	 </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDV8O_HBXu0qinR_zAaUEzgWqbFtd3N2os&callback=initMap"
        async defer></script>
@endsection