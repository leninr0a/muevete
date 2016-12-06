@extends('layout.layout')

@section('content')

<section class="profile-section">
	<div class="container container-profile well">
		<div class="row">
			<div class="col-xs-4 profile-col-left ">
				<div class="row">
					<div class="col-xs-12">
						<img src="http://www.msmlinked.com/images/NO%20IMAGE.png" class="profile-img" alt="">

					</div>
				</div>
				<div class="row">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h3><strong>{{Auth::user()->nombre}} {{Auth::user()->apellido}}</strong></h3>
							<h5 class="text-center"><small><a href="">cambiar imagen de perfil</a></small></h5>
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
				<p><span class="black">Edad:</span>  24 a&ntilde;os</p> 
				<p><span class="black">Sexo:</span> 
				@if(Auth::user()->genero == 'M')
					{{'Masculino'}}
				@else
					{{'Femenino'}}
				@endif
				</p>
				<p><span class="black">Tel&eacute;fono:</span> {{Auth::user()->telefono}} |  <small><a href="">cambiar</a></small></p>
				<p><span class="black">Email:</span> {{Auth::user()->email}} |  <small><a href="">cambiar</a></small></p>
				<p><span class="black">Contrase&ntilde;a:</span> ******** |  <small><a href="">cambiar</a></small></p>
				<p><span class="black">Reputaci&oacute;n:</span> <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> 0/5 - 0 calificaciones</p>
			</div>
		</div>
	</div>
</section>
@endsection