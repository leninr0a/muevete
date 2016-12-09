@extends('layout.layout')

@section('content')
<section class="container-publica">
	
	<div class="container container-publish">
		<div class="row ">
			<div class="col-xs-8 col-xs-offset-2 container-form-publica">
			
			@include('partials/errors')
			
			<form action="{{url('publicar/viaje')}}" method="POST">
			{{csrf_field()}}
				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane active" id="first" role="tabpanel">
					<div class="row">
						<div class="col-xs-6 text-center">
							<p><strong>Parte uno de dos</strong></p>
							<div class="bar bar-active"></div>
						</div>
						<div class="col-xs-6 text-center">
							<p>Parte dos de dos</p>
							<div class="bar bar"></div>
						</div>
						<br>
					</div>
					
				  	<div class="row">
				  	
				<div class="col-xs-12"><hr><h3><div class="number"><p class="number-content">1</p></div><strong>Ruta</strong></h3></div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<h4>Lugar de salida <i class="glyphicon glyphicon-map-marker "></i></h4>
					<input type="text" id="form_salida" class="form-control" name="salida" value="{{old('salida')}}" placeholder="Ej: Caracas, Chacao">
					<input type="hidden" id="salidaLat" name="salidaLat">
					<input type="hidden" id="salidaLng" name="salidaLng">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<h4>Lugar de llegada <i class="glyphicon glyphicon-map-marker "></i> </h4>
					<input type="text" id="form_llegada" class="form-control" value="{{old('llegada')}}" name="llegada" placeholder="Ej: Merida, Plaza Bolivar">
					<input type="hidden" id="llegadaLat" name="llegadaLat">
					<input type="hidden" id="llegadaLng" name="llegadaLng">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12"><hr><h3><div class="number"><p class="number-content">2</p></div><strong>Hora y fecha</strong></h3></div>
			</div>
			<div class="row">
				<div class="col-xs-12">	
					<div id="sandbox-container">

						<div id="datepicker" data-date-format="yyyy-mm-dd">
							
						</div>
					</div>
					<input type="hidden" name="fecha" id="my_hidden_input" style="visibility: none">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h4>Hora de salida</h4>
					<div class="input-group bootstrap-timepicker timepicker">
		            	<input name="hora" id="timepicker1" value="{{old('hora')}}" type="text" class="form-control input-small">
		            	<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		        	</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 text-right">
					<a class="btn btn-continue" data-toggle="tab" href="#second">Continuar <i class="fa fa-angle-right"></i></a>
				</div>
			</div>





		</div>
		<!-- FIn de la primera parte del formulario -->

		<!-- Inicio de la segunda parte -->
		<div class="tab-pane" id="second" role="tabpanel">
				  	<div class="row">
						<div class="col-xs-6 text-center">
							<p>Parte uno de dos</p>
							<div class="bar bar"></div>
						</div>
						<div class="col-xs-6 text-center">
							<p><strong>Parte dos de dos</strong></p>
							<div class="bar bar-active"></div>
						</div>
						<br>
					</div>
					<div class="row">
				
				<div class="col-xs-12"><hr><h3><div class="number"><p class="number-content">3</p></div><strong>Pago</strong></h3></div>
			</div>
			<div class="row">

				<div class="col-xs-6">
					<input type="number" value="{{old('precio')}}" name="precio" class="form-control" placeholder="0,00">
				</div>
				<div class="col-xs-6 text-left">
					<h4><strong>Bs.</strong></h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h5><strong>¿C&oacute;mo deseas recibir el pago?</strong></h5>				
					<label class="checkbox-inline">
					  <input type="checkbox" id="inlineCheckbox1" name="efectivo" value="true" checked> Efectivo <i class="fa fa-money"></i>
					</label>
					<label class="checkbox-inline">
					  <input type="checkbox" id="inlineCheckbox2" name="pago_online" value="true" checked> Pago online <i class="fa fa-credit-card"></i>
					</label>
					
					
				</div>
			</div>
			<div class="row">
				
				<div class="col-xs-12">
					<hr>
					<h3><div class="number"><p class="number-content">4</p></div><strong>N&uacute;mero de asientos disponibles</strong></h3>
					
				</div>
				<div class="col-xs-6 ">
					<input type="number" name="asientos" value="{{old('asientos')}}" class="form-control" min=1 max=5>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<hr>
					<h3><div class="number"><p class="number-content">5</p></div><strong>Informaci&oacute;n adicional</strong></h3>
				</div>
				<div class="col-xs-12">
					<textarea class="form-control" value="{{old('informacion')}}" name="informacion" rows="5" id="comment"></textarea>
				</div>
			</div>
			<div class="row row-publicar-buttons">
				<div class="col-xs-6 text-left">
					<a class="btn btn-continue" data-toggle="tab" href="#first"><i class="fa fa-angle-left"></i> Volver</a>
				</div>
				<div class="col-xs-6 text-right">
					<button class="btn btn-publicar" type="submit">Publicar viaje <i class="fa fa-angle-right"></i></button>
				</div>
			</div>
		</div>
		<!-- FIn de la segunda aprte del formulario -->				
	</div>
	<!-- Fin del tab content -->
</form>
		</div>
	</div>
</div>
	

	
</section>
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
            document.getElementById('salidaLat').value = place.geometry.location.lat();
            document.getElementById('salidaLng').value = place.geometry.location.lng();
        	});
		   google.maps.event.addListener(autocomplete_2, 'place_changed', function () {
            var place = autocomplete_2.getPlace();
            document.getElementById('llegadaLat').value = place.geometry.location.lat();
            document.getElementById('llegadaLng').value = place.geometry.location.lng();
        	});
		}
	</script>

	<script>
		$('#datepicker').datepicker({
		    startDate: "today",
		    language: "es"
		});
		$('#datepicker').on("changeDate", function() {
		    $('#my_hidden_input').val(
		        $('#datepicker').datepicker('getFormattedDate')
		    );
		});
	</script>

	<script>
        $('#timepicker1').timepicker();
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDV8O_HBXu0qinR_zAaUEzgWqbFtd3N2os&signed_in=true&libraries=places&callback=initAutocomplete&region=VE"
    async defer></script>
@endsection