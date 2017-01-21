@extends('layout.layout')

@section('content')

<?php 
use Carbon\Carbon; $edad = (new Carbon(Auth::user()->fecha_nacimiento))->age;
?>

<section class="profile-section">
	<div class="container container-profile well">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
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
				<p><span class="black">C&eacute;dula:</span> {{Auth::user()->nacionalidad}}-{{Auth::user()->cedula}}</p>
				<p><span class="black">Edad:</span> {{$edad}} años</p> 
				<p><span class="black">Sexo:</span> 
				@if(Auth::user()->genero == 'M')
					{{'Masculino'}}
				@else
					{{'Femenino'}}
				@endif
				</p>
				<p><span class="black">Tel&eacute;fono:</span> {{Auth::user()->telefono}} |  <small><a data-toggle="modal" data-target="#editPhoneModal">cambiar</a></small></p>
				<p><span class="black">Email:</span> {{Auth::user()->email}} |  <small><a data-toggle="modal" data-target="#editEmailModal">cambiar</a></small></p>

				<p><span class="black">Contrase&ntilde;a:</span> ******** |  <small><a data-toggle="modal" data-target="#editPasswordModal">cambiar</a></small></p>
				<p><span class="black">Reputaci&oacute;n:</span> <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> 0/5 - 0 calificaciones</p>
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
@endsection



@section('additionalScript')
<script>
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