@extends('layout.layout')

@section('content')
	<div class="container">
		<div class="row row-viajes-form">
			 <form action="{{url('viajes/busqueda')}}" method="GET">
       
			<div class="col-xs-3 col-xs-offset-1 text-center">
				<h4>Lugar de salida <i class="glyphicon glyphicon-map-marker "></i></h4>
					<input type="text" id="form_salida" class="form-control" name="salida" value="{{old('salida')}}" placeholder="Ej: Caracas, Distrito Capital">
			</div>
			<div class="col-xs-3 text-center">
				<h4>Lugar de llegada<i class="glyphicon glyphicon-map-marker "></i></h4>
					<input type="text" id="form_llegada" class="form-control" value="{{old('llegada')}}" name="llegada" placeholder="Ej: M&eacute;rida">
			</div>
			<div class="col-xs-2 text-center">
				<h4>Fecha <i class="glyphicon glyphicon-calendar"></i></h4>
					<div id="sandbox-container" >
                         <input type="text" name="fecha" class="form-control"  data-date-format="yyyy-mm-dd">      
                    </div> 
			</div>
			<div class="col-xs-2 text-center">
				<h4>&nbsp;</h4>
				<button class="btn-search-viajes">Buscar <i class="fa fa-search"></i></button>
			</div>
			</form>
		</div>
		<div class="row">
			<div class="col-xs-3">
				
			</div>
			<div class="col-xs-8 ">
				@if (Session::get('no_viajes'))
					<div class="row">
						<div class="col-xs-12">	
							<div class="alert alert-warning">
			 					<strong>Lo sentimos.</strong> No hemos encontrado un viaje en la fecha seleccionada. Aun as&iacute; te mostramos viajes entre <strong>{{Session::get('salida')}}</strong> y <strong>	{{Session::get('llegada')}}</strong> en otras fechas. 
							</div>
						</div>
					</div>
				@endif
				@foreach($viajes as $viaje)
				<a href="{{ url('viajes/id/'.$viaje->id) }}" class="link-viaje-container">
				<div class="row viaje-container">
					<div class="col-xs-3 text-center col-viaje-profile">
						<img src="http://www.msmlinked.com/images/NO%20IMAGE.png" class="profile-img-viaje" alt=""">
						<p><strong>{{$viaje->user->nombre}} {{$viaje->user->apellido}}</strong> <br> <small>
							@if($viaje->user->genero == 'M')
								Hombre
							@else
								Mujer
							@endif
						</small> <br> <small>24 a&ntilde;os</small> <br> <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></p>
					
					</div>
					<div class="col-xs-5 col-viaje-info">
						<p><i class="glyphicon glyphicon-map-marker green"></i> {{$viaje->salida}}</p>
						<p><i class="glyphicon glyphicon-map-marker red"></i> {{$viaje->llegada}}</p>
						<p><i class="glyphicon glyphicon-time"></i> {{$viaje->hora}}  {{$viaje->fecha}} </p>
						<h3><strong>{{$viaje->precio}}</strong> Bs/<small>pasajero</small></h3>
						<p>
						@if($viaje->efectivo)
						<i class="fa fa-money fa-2x money-color"></i> <i class="fa fa-check"></i> 
						@endif

						@if($viaje->pago_online)
						<i class="fa fa-credit-card fa-2x credit-card-color"></i> <i class="fa fa-check"></i>
						@endif
						</p>
					</div>
					<div class="col-xs-4 col-viaje-info-2">
						<h5 class="h3-listado-viajes">Asientos disponibles:</h5>
						<h1 class="h3-listado-viajes">
							@for($i=0;$i<$viaje->asientos;$i++)
							<i class="fa fa-user-o user-color"></i>
							@endfor
						</h1>
					</div>

				</div>
				</a>
				@endforeach
				<div class="row">
					<div class="col-xs-12 text-center">
						{{ $viajes->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection

@section('additionalScript')

      <script>
	 	var autocomplete, autocomplete_2;
		function initAutocomplete() {
		  // Create the autocomplete object, restricting the search to geographical
		  // location types.
		  var options = {
		  	types:['(cities)'],
		  	componentRestrictions:{country:'ve'}
		  }
		  autocomplete_2 = new google.maps.places.Autocomplete(document.getElementById('form_llegada'),options);
		  autocomplete = new google.maps.places.Autocomplete(document.getElementById('form_salida'),options);
		  // When the user selects an address from the dropdown, populate the address
		  // fields in the form.
		 google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            //document.getElementById('city2').value = place.name;
            //document.getElementById('cityLat').value = place.geometry.location.lat();
            //document.getElementById('cityLng').value = place.geometry.location.lng();
            alert("This function is working!");
            alert(place.name);
            alert(place.geometry.location.lat());

        	});
		}
	</script>

    <script>
        $('#sandbox-container input').datepicker({
            startDate: "today",
            orientation: "bottom auto"
        });
    </script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDV8O_HBXu0qinR_zAaUEzgWqbFtd3N2os&signed_in=true&libraries=places&callback=initAutocomplete&region=VE"
    async defer></script>

@endsection