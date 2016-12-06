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
					<a href="perfil" class="a-menu-profile">
						<div class="col-xs-12 text-left menu-profile-option">
							<p><i class="fa fa-address-card-o"></i> Informaci&oacute;n personal</p>
						</div>
					</a>
					<div class="col-xs-12 text-left menu-profile-option menu-profile-option-active">
						<p><i class="fa fa-car"></i> Viajes como pasajero</p>
					</div>
					<a class="a-menu-profile" href="mis-viajes-publicados">
						<div class="col-xs-12 text-left menu-profile-option">
							<p><i class="fa fa-car"></i> Viajes publicados</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xs-8 profile-col-right  ">
				<div class="alert alert-info">
				   No has enviado ninguna solicitud de reserva de asiento.
				</div>

			</div>
		</div>
	</div>
</section>
@endsection