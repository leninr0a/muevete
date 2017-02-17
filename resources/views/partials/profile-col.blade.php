<?php 
$uri = request()->path();
 ?>

<div class="row">
	<div class="col-xs-12">
		<img src="{{URL::asset('images/profiles/'.Auth::user()->picture)}}" class="profile-img" alt="">


	</div>
</div>
<div class="row">
	<div class="row">
		<div class="col-xs-12 text-center">
			<h3><strong>{{Auth::user()->nombre}} {{Auth::user()->apellido}}  </strong></h3>

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
	<a class="a-menu-profile" href="perfil">
		<div class="col-xs-12 text-left menu-profile-option {{$uri == 'mi-cuenta/perfil' ? 'menu-profile-option-active' : ''}}">
			<p><i class="fa fa-address-card-o"></i> Informaci&oacute;n personal</p>
		</div>
	</a>
	<a class="a-menu-profile" href="notificaciones">
		<div class="col-xs-12 text-left menu-profile-option {{$uri == 'mi-cuenta/notificaciones' ? 'menu-profile-option-active' : ''}}">
			<p><i class="fa fa-bell-o"></i> Notificaciones <span class="badge">{{Auth::user()->notifications->count()}}</span></p>
		</div>
	</a>
	<a href="mis-viajes-pasajero" class="a-menu-profile">
		<div class="col-xs-12 text-left menu-profile-option {{$uri == 'mi-cuenta/mis-viajes-pasajero' ? 'menu-profile-option-active' : ''}}">
			<p><i class="fa fa-car"></i> Viajes como pasajero <span class="badge">{{Auth::user()->reservas->count()}}</span></p>
		</div>
	</a>
	<a class="a-menu-profile" href="mis-viajes-publicados">
		<div class="col-xs-12 text-left menu-profile-option {{$uri == 'mi-cuenta/mis-viajes-publicados' ? 'menu-profile-option-active' : ''}}">
			<p><i class="fa fa-car"></i> Viajes publicados <span class="badge">{{Auth::user()->viajes->count()}}</span></p>
		</div>
	</a>
	<a class="a-menu-profile" href="calificaciones-recibidas">
		<div class="col-xs-12 text-left menu-profile-option {{$uri == 'mi-cuenta/calificaciones-recibidas' ? 'menu-profile-option-active' : ''}}">
			<p><i class="fa fa-star black"></i> Calificaciones recibidas <span class="badge">{{Auth::user()->califications->count()}}</span></p>
		</div>
	</a>
	<a class="a-menu-profile" href="calificaciones-enviadas">
		<div class="col-xs-12 text-left menu-profile-option {{$uri == 'mi-cuenta/calificaciones-enviadas' ? 'menu-profile-option-active' : ''}}">
			<p><i class="fa fa-star-o black"></i> Calificaciones realizadas <span class="badge">	{{Auth::user()->sent_califications->count()}}</span></p>
		</div>
	</a>
</div>