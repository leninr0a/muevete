@extends('layout.layout')

@section('title','Muevete - ¿C&oacute;mo funciona el Carpooling?')

@section('content')
		<div class="container container-como-funciona">	
				<div class="row">	
						<div class="col-xs-12">
							<h2>¿C&oacute;mo funciona el <em>Carpooling</em> en <strong>Muevete</strong>?</h2>		
						<p>		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi dolores doloremque saepe rerum quas perspiciatis omnis ipsam nihil vitae impedit cum ea laboriosam dolorum, quasi enim totam minima placeat iste!</p>		
						</div>		
				</div>
				<div class="row">	
						<div class="col-xs-5 text-center">
							<h3>¿Eres conductor? ¡No viajes solo!</h3>
						</div>
						<div class="col-xs-2">	
							<h3></h3>
						</div>
						<div class="col-xs-5 text-center">
							<h3>¿Eres pasajero? </h3>
						</div>
				</div>

				<!-- 	First Step -->
				<div class="row row-step">	
						<div class="col-xs-5 col-step-text">	
								<p>	Entra a <strong>Muevete.com</strong> desde tu computadora, celular o tablet y registrate si no lo has hecho.</p>
						</div>
						<div class="col-xs-2">	
							<div class="icon-step icon-step-step-one">
								<i class="fa fa-laptop fa-4x"></i>
							</div>
						</div>
						<div class="col-xs-5 col-step-text">	
								<p>Entra a <strong>Muevete.com</strong> desde tu computadora, celular o tablet y registrate si no lo has hecho.</p>
						</div>
				</div>

				<!-- 	Second Step -->
				<div class="row row-step">	
						<div class="col-xs-5 col-step-text">	
							<p>Busca un viaje hacia el lugar, fecha y hora de tu preferencia.</p>
						</div>
						<div class="col-xs-2">	
							<div class="icon-step icon-step-step-two">
								<i class="fa fa-map fa-4x "></i>
							</div>
						</div>
						<div class="col-xs-5 col-step-text">	
							<p>Publica tu itinerario junto con todos los datos requeridos en el formulario.</p>
						</div>
				</div>

				<!-- 	Third Step -->
				<div class="row row-step">	
						<div class="col-xs-5 col-step-text">	
								<p>Reserva tu puesto enviando una solicitud al conductor del viaje. Recibiras por email una notificación cuando el conductor responda a tu solicitud.</p>
						</div>
						<div class="col-xs-2">	
							<div class="icon-step icon-step-step-three">
								<i class="fa fa-user-plus fa-4x"></i>
							</div>
						</div>
						<div class="col-xs-5 col-step-text">	
								<p>Revisa las solicitudes de los usuarios. Puedes ingresar a su perfil para ver sus datos y entonces decide si aceptas o no llevarlos como pasajeros.</p>
						</div>
				</div>

				<!-- 	Fourth Step -->
				<div class="row row-step">	
						<div class="col-xs-5 col-step-text">	
								<p>Paga al conductor de forma segura a trav&eacute;s de plataforma de pago. O hazlo tambi&eacute;n en efectivo. Tu eliges.</p>
						</div>
						<div class="col-xs-2">	
							<div class="icon-step icon-step-step-four">
								<i class="fa fa-credit-card fa-4x"></i>
							</div>
						</div>
						<div class="col-xs-5 col-step-text">	
								<p>Recibe el pago de tu viaje a trav&eacute;s de nuestra plataforma.</p>
						</div>
				</div>

				<!-- 	Fifth Step -->
				<div class="row row-step">	
						<div class="col-xs-5 col-step-text">	
								<p>Espera puntualmente en el lugar acordado por el conductor y disfruta el viaje a tu destino.</p>
						</div>
						<div class="col-xs-2">	
							<div class="icon-step icon-step-step-five">
								<i class="fa fa-calendar-check-o fa-4x"></i>
							</div>
						</div>
						<div class="col-xs-5 col-step-text">	
								<p>Recoje a los pasajeros puntualmente el dia del viaje y viaja hacia tu destino.</p>
						</div>
				</div>
		</div>
		<section class="safety">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h1 class="text-center">Queremos que tengas una buena experiencia</h1>
						<hr class="mini-hr mini-hr-white">
					
						
					</div>
					<div class="row">
						<div class="col-xs-6">
						<h3>La reputaci&oacute;n en nuestra comunidad <strong>importa</strong></h3>
						<h5>Gracias a nuestro sistema de <strong>reputaci&oacute;n</strong> y <strong>comentarios</strong> puedes asegurarte de que tu viaje ser&aacute; agradable. Puedes observar la calificaci&oacute;n de un determinado conductor asi como tambi&eacute;n puedes puntuar a los conductores con los que viajas, haciendole saber al resto de la comunidad si tuviste una buena o mala experiencia.</h5>
						</div>
						<div class="col-xs-6">
							<img src="images/reputation.jpg" class="img-responsive" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection