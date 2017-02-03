@extends('layout.layout')

@section('content')

<?php 
use Carbon\Carbon; $edad = (new Carbon(Auth::user()->fecha_nacimiento))->age;
?>

<section class="profile-section">
	<div class="container container-profile well">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				@if(verifyFacebookNewAccount(Auth::user()) == STATUS_NEW_ACCOUNT[0])
				<div class="alert alert-warning">
					<p>Lamentamos notificar que no hemos podido recuperar todos tus datos desde Facebook. Te sugerimos actualizar tus datos faltantes en esta p&aacute;gina</p>
				</div>
				@endif
				@include('partials.errors')
				@if (session('status'))
			    <div class="alert alert-success">
			        {{ session('status') }}
			    </div>
				@endif
			</div>
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
							<h5 class="text-center">
							<form action="/profile/update/picture" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
							<small><input type="file" name="image" id="file" class="inputfile" /><label for="file"><span class="text-file">Sube tu foto</span> <i class="fa fa-upload"></i></label></small> <br>	
							<button type="submit" class="save-picture"><i class="fa fa-save" ></i></button>
							<button type="reset" class="save-picture reset-picture"><i class="fa fa-close"></i></button>
							</form>
							</h5>
							
						</div>
					</div>
					<div class="col-xs-12 text-left menu-profile-option menu-profile-option-active">
						<p><i class="fa fa-address-card-o"></i> Informaci&oacute;n personal</p>
					</div>
					<a href="mis-viajes-pasajero" class="a-menu-profile">
						<div class="col-xs-12 text-left menu-profile-option">
							<p><i class="fa fa-car"></i> Viajes como pasajero</p>
						</div>
					</a>
					<a class="a-menu-profile" href="mis-viajes-publicados">
						<div class="col-xs-12 text-left menu-profile-option">
							<p><i class="fa fa-car"></i> Viajes publicados</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xs-8 profile-col-right  ">
				<h3>Informaci&oacute;n personal</h3>
				<p><span class="black">Nombre:</span> {{Auth::user()->nombre}} {{Auth::user()->apellido}}</p>
				<p><span class="black">C&eacute;dula:
				@if(Auth::user()->cedula == null)
				<small><a data-toggle="modal" class="change-button" data-target="#addCedulaModal">Agregar</a></small>
				@else
				</span> {{Auth::user()->nacionalidad}} - {{Auth::user()->cedula}}</p>
				@endif
				<p><span class="black">Edad:</span> {{$edad}} años</p> 
				<p><span class="black">Sexo:</span> 
				@if(Auth::user()->genero == 'M')
					{{'Masculino'}}
				@else
					{{'Femenino'}}
				@endif
				</p>
				<p><span class="black">Tel&eacute;fono:</span> 
				@if(Auth::user()->telefono == null)
					<small><a data-toggle="modal" class="change-button" data-target="#editPhoneModal">Agregar</a></small>
				@else
				{{Auth::user()->telefono}}
				|  <small><a data-toggle="modal" class="change-button" data-target="#editPhoneModal">cambiar</a></small>
				@endif
				</p>
				<p><span class="black">Email:</span> {{Auth::user()->email}} |  <small><a data-toggle="modal"  class="change-button"data-target="#editEmailModal">cambiar</a></small></p>

				<p><span class="black">
				@if(Auth::user()->password == null)
				Contrase&ntilde;a: <small><a data-toggle="modal" class="change-button" data-target="#createPasswordModal">Agregar</a></small>
				@else
				Contrase&ntilde;a:</span> ******** |  <small><a data-toggle="modal" class="change-button" data-target="#editPasswordModal">cambiar</a></small>
				@endif
				</p>
				<p><span class="black">Reputaci&oacute;n:</span> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 0/5 - 0 calificaciones</p>
				<div class="row">
					<div class="col-xs-12">
						<h3>Tus veh&iacute;culos </h3>
					</div>
					<div class="col-xs-12">
					 <table class="table table-hover">
					    <thead>
					      <tr>
					        <th class="text-center">Marca</th>
					        <th class="text-center">Modelo</th>
					        <th class="text-center">Placa</th>
					        <th class="text-center">Año</th>
					        <th></th>
					      </tr>
					    </thead>
					    <tbody>
					    @if(Auth::user()->vehiculos->count() == 0)
							<tr class="text-center">
								<td colspan="5">Aun no has agregado ning&uacute;n veh&iacute;culo</td>
							</tr>
							
						@else
					    @foreach(Auth::user()->vehiculos as $vehiculo)
							<tr id="vehicleRowId-{{$vehiculo->id}}" class="text-center">
								<td>{{$vehiculo->marca}}</td>
								<td>{{$vehiculo->modelo}}</td>
								<td>{{$vehiculo->placa}}</td>
								<td>{{$vehiculo->anio}}
								<td><i class="fa delete-vehicle-button fa-trash" data-toggle="modal" onclick="prepareDeleteVehicle({{$vehiculo->id}})" data-target="#confirmDeleteVehicle"></i></td>
							</tr>
						 @endforeach
						 @endif
						 <tr class="text-center">	
								<td colspan="5"><small><a class="change-button" data-toggle="modal" data-target="#addVehicleModal">agregar nuevo veh&iacute;culo</a></small></td>
							</tr>
					  </table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Modal para el cambio de telefono -->
<div id="editPhoneModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cambio de n&uacute;mero telef&oacute;nico</h4>
      </div>
      <div class="modal-body">
      	<form action="/profile/update/phone" method="post">
        <p>Introduce tu nuevo n&uacute;mero de tel&eacute;fono</p>
        {{csrf_field()}}
        <input type="tel" class="form-control" name="telefono" placeholder="04121626213">
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-default">Guardar</button>
      	</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para el cambio de correo -->
<div id="editEmailModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cambio de correo</h4>
      </div>
      <div class="modal-body">
      	<form action="/profile/update/email" method="post">
      	{{csrf_field()}}
        <p>Introduce tu nueva direcci&oacute;n de correo</p>
        <input type="text" class="form-control" name="email" placeholder="micorreo@ejemplo.com">
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-default" >Guardar</button>
      	</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para agregar una cedula -->
<div id="addCedulaModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar c&eacute;dula de identidad</h4>
      </div>
      <div class="modal-body">
      	<form action="/profile/create/cedula" method="post">
      	{{csrf_field()}}
        <p>Introduce tu n&uacute;mero de c&eacute;dula</p>
        <div class="row">
        <div class="col-xs-2">
            <select name="nacionalidad" class="form-control">
                <option value="V">V</option>
                <option value="E">E</option>
            </select>
        </div>
        <div class="col-xs-10">
        	<input type="text"  pattern="[0-9]{6,}" name="cedula" class="form-control" value="{{ old('cedula') }}" placeholder="Ej: 1234567"required>
        </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-default" >Agregar</button>
      	</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para el cambio de password -->
<div id="editPasswordModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cambio de contraseña</h4>
      </div>
      <div class="modal-body">
      	<form action="/profile/update/password" method="post">
      	{{csrf_field()}}
      	<p>Introduce tu contraseña actual</p>
      	<input type="password" class="form-control" name="old_password">
        <p>Introduce tu nueva contraseña</p>
        <input type="password" class="form-control" name="password">
        <p>Confirma tu contraseña</p>
        <input type="password" class="form-control" name="password_confirmation">
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-default" >Guardar</button>
      	</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para crear un password -->
<div id="createPasswordModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Creaci&oacute;n de contraseña</h4>
      </div>
      <div class="modal-body">
      	<form action="/profile/create/password" method="post">
      	{{csrf_field()}}
      	<input type="hidden" class="form-control" name="old_password">
        <p>Introduce tu nueva contraseña</p>
        <input type="password" class="form-control" name="password">
        <p>Confirma tu contraseña</p>
        <input type="password" class="form-control" name="password_confirmation">
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-default" >Crear</button>
      	</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para agregar un vehiculo -->
<div id="addVehicleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar veh&iacute;culo</h4>
      </div>
      <div class="modal-body">
      	<form action="/profile/vehicle/create" method="post">
      	{{csrf_field()}}
      	<div class="row">	
			<div class="col-xs-6">	
				<h5>Marca</h5>
      			<input type="text" name="marca" class="form-control" >
			</div>
			<div class="col-xs-6">	
				<h5>Modelo</h5>
      			<input type="text" name="modelo" class="form-control" >
			</div>
      	</div>
      	<div class="row">	
			<div class="col-xs-6">	
				<h5>Placa <small>no ser&aacute; mostrada publicamente</small></h5>
      			<input type="text" name="placa" class="form-control" >
			</div>
			<div class="col-xs-6">	
				<h5>Año</h5>
      			<select name="anio" class="form-control">
				@for($i=1985;$i<date('Y');$i++)
					<option value="{{$i}}">{{$i}}</option>
				@endfor
				</select>
			</div>
      	</div>

      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-default" >Agregar</button>
      	</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div id="confirmDeleteVehicle" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">¿Est&aacute;s seguro de querer eliminar este veh&iacute;culo?</h4>
      </div>
      
      <div class="modal-footer text-center" style="text-align: center">
 
      		{{csrf_field()}}
      		<input type="hidden" id="viaje_id" name="viaje_id">
      		 	<button type="submit" class="btn btn-default" onclick="deleteVehicle()" data-dismiss="modal">Eliminar</button>

       <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      	
      </div>
    </div>

  </div>
</div>

<div id="cantDeleteVehicle" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">No puedes eliminar un veh&iacute;culo que ser&aacute; proximamente usado en un viaje. Deber&aacute;s cancelar el viaje para poder eliminar este veh&iacute;culo</h4>
      </div>
      
      <div class="modal-footer text-center" style="text-align: center">

       <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      	
      </div>
    </div>

  </div>
</div>
@endsection



@section('additionalScript')
<script>
	var idVehicle=null;

	function prepareDeleteVehicle(id){
		idVehicle = id;
	}

	function deleteVehicle(){
		$.ajax({
		 		type: "POST",
	            url: '/profile/vehicle/delete',
	            data : {'vehiculo_id':idVehicle,'_token': $('input[name=_token]').val()},
	            success: function (data) {
	            	if(data == "true"){
	            		$('#cantDeleteVehicle').modal('show');
	            	}else{
	            		$('#vehicleRowId-'+idVehicle).hide();
	            	}
	            },
	            error: function (data) {
	                console.log(data);
	            }
	        });
	}



	var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				label.querySelector( 'span' ).innerHTML = fileName;
			else
				label.innerHTML = labelVal;

			$('.save-picture').css('display','inline-block');
		});
	});
	$('.reset-picture').click(function(){
		$('.save-picture').css('display','none');
		$('.text-file').text("Sube tu foto");
	});
</script>

@endsection