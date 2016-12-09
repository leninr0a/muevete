@extends('layout.layout')

@section('title','Informaci&oacute;n del viaje')

@section('content')
	<div class="container container-viaje-info">
		<div class="row first-row-travel-info">
			<div class="col-xs-6">
				<h3><span id="salida">{{$viaje->salida}}</span> <i class="fa fa-arrows-h"></i> <span id="llegada">{{$viaje->llegada}}</span></h3>
				<input type="hidden" id="salidaLat" value={{$viaje->salidaLat}}>
				<input type="hidden" id="salidaLng" value={{$viaje->salidaLng}}>
				<input type="hidden" id="llegadaLat" value={{$viaje->llegadaLat}}>
				<input type="hidden" id="llegadaLng" value={{$viaje->llegadaLng}}>
				<h4><i class="fa fa-calendar-o"></i> {{$viaje->fecha}}</h4>
				<h4><i class="fa fa-clock-o"></i> {{$viaje->hora}}</h4>
				<h4>{{$viaje->precio}} Bs</h4>
					<h3 class="">Datos del conductor</h3>
				<img src="{{URL::asset('images/linus.jpe') }}" class="avatar-conductor" alt="">
				<p>{{$viaje->user->nombre}} {{$viaje->user->apellido}}
				<br>
				<small>
				@if($viaje->user->genero == 'M')
					Hombre
				@else
					Mujer
				@endif
				<br>{{$viaje->user->edad}} 24 a&nacute;os <br>
				</small>
				</p>
			
			</div>
			<div class="col-xs-6 text-center">
				 <div id="map"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				   
			</div>
		</div>

		<div class="row second-row-travel-info text-center">
				<div class="col-xs-6">
					<h4>Asientos disponibles</h4>
					@if($viaje->asientos > 0)
						@for($i=0;$i<$viaje->asientos;$i++)
							<i class="fa fa-user-o fa-2x asientos-reservados"></i>
						@endfor
						<button class="btn-reservar">Reservar asiento</button>
					@else
						No hay asientos disponibles
					@endif
				</div>
				<div class="col-xs-6">

					<h4>Asientos reservados</h4>
					@if($viaje->asientos_reservados == 0)
						@for($i=0;$i<$viaje->asientos;$i++)
							<img src="{{URL::asset('images/evan.jpe') }}" class="avatar-asientos" alt="">
						@endfor
					@else
						<p>Ning&uacute;n asiento reservado</p>
					@endif
				</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-center">
				@if(Auth::check() && Auth::user()->id == $viaje->user->id)
					<h3>Preguntas que te han hecho</h3>
				@else
					<h3>¿Tienes alguna pregunta?</h3>
				@endif
				
			</div>
			<div class="col-xs-12">
				
				@foreach($viaje->preguntas as $pregunta)
					<div class="row question">
						<div class="col-xs-1">
							<img src="{{URL::asset('images/mark.jpe') }}" class="avatar-questions" alt="">
						</div>
						<div class="col-xs-11">
							<div class="row">
								<div class="col-xs-8">
									<p><strong>{{$pregunta->user->nombre}} {{$pregunta->user->apellido}}</strong> </p>
								</div>
								<div class="col-xs-4 text-right">
									 <p><small>{{$pregunta->created_at->diffForHumans()}}</small> </p>
								</div>
							</div>
							<p>{{$pregunta->pregunta}}</p>
							 
							@if($pregunta->respuesta != null)
								<div class="alert alert-info respuesta">
								   <div class="row">
								   		<div class="col-xs-1">
											<img src="{{URL::asset('images/linus.jpe') }}" class="avatar-questions" alt="">			   			
								   		</div>
								   		<div class="col-xs-11">
								   			<div class="row">
								   				<div class="col-xs-8">
								   					<p><strong>{{$pregunta->respuesta->user->nombre}} {{$pregunta->respuesta->user->apellido}} </strong><small>(Conductor)</small> </p>
								   				</div>
								   				<div class="col-xs-4 text-right">
								   					<p><small>{{$pregunta->respuesta->created_at->diffForHumans()}}</small></p>
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
						<button class="btn-question">Enviar pregunta</button>

					</form>
				</div>
			</div>
		@endif
	</div>
	
	


@endsection


@section('additionalScript')
	 <script>
	 	function openReplyForm(idPregunta){
	 		$("#reply-form-"+idPregunta).toggle(300);
	 	}
	 </script>
     <script>
     function initMap(){
     	 var pinImage = new google.maps.MarkerImage("images/map_marker.png");
 		 var salida=document.getElementById("salida").innerHTML;
 		 var llegada=document.getElementById("llegada").innerHTML;
 		 var salidaPos = new google.maps.LatLng(parseFloat(document.getElementById("salidaLat").value),parseFloat(document.getElementById("salidaLng").value));
 		 var llegadaPos = new google.maps.LatLng(parseFloat(document.getElementById("llegadaLat").value),parseFloat(document.getElementById("llegadaLng").value));
		  var directionsService = new google.maps.DirectionsService;
		  var directionsDisplay = new google.maps.DirectionsRenderer({polylineOptions: {strokeColor:"#2e9afe"}});

		  directionsDisplay.setOptions({suppressMarkers:true});

		  var map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 7,
		    center: {lat: 41.85, lng: -87.65}
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
			  console.log("bien");
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