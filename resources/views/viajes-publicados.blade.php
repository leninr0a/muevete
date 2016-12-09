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
					<a href="mis-viajes-pasajero" class="a-menu-profile">
						<div class="col-xs-12 text-left menu-profile-option ">
							<p><i class="fa fa-car"></i> Viajes como pasajero</p>
						</div>
					</a>
					<a class="a-menu-profile" href="/mi-cuenta/mis-viajes-publicados">
						<div class="col-xs-12 text-left menu-profile-option menu-profile-option-active">
							<p><i class="fa fa-car"></i> Viajes publicados</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xs-8 profile-col-right  ">
				@foreach ($viajes as $viaje)
						<div class="panel panel-default">
						  <div class="panel-heading">
							<div class="row">
								<div class="col-xs-8">
									<h4><strong><i class="fa fa-circle-o green"></i> {{$viaje->salida}} <i class="fa fa-long-arrow-right"></i> <i class="fa fa-circle-o red"></i> {{$viaje->llegada}}</strong> </h4>
								</div>
								<div class="col-xs-4 text-right">
									<h5><strong><i class="fa fa-clock-o"></i> {{$viaje->hora}}</strong> / <strong><i class="fa fa-calendar-check-o"></i> {{$viaje->fecha}} </strong></h5>
								</div>
							</div>

						  </div>
						  <div class="panel-body">
							<div class="row">
								<div class="col-xs-12">
									
									<p> Precio: {{$viaje->precio}} Bs/<small>pasajero</small></p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<p> Asientos disponibles:
									@for ($i = 0; $i < $viaje->asientos; $i++)
									    <i class="fa fa-user-o"></i>
									@endfor

									 </p>
								</div>
								<div class="col-xs-12">
								Asientos reservados:
									<div class="perfil-reservado">
										<div class="row">
											<div class="col-xs-12">
												<div class="alert alert-warning alert-warning-mis-viajes">
												   Aun no tienes pasajeros en tu viaje.
												</div>
											</div>	
										</div>
									</div>

								</div>
								<div class="col-xs-12">
									Solicitudes de reserva:
									<div class="perfil-reservado">
										<div class="row">
											<div class="col-xs-12">
												<div class="alert alert-warning alert-warning-mis-viajes">
												   Aun no tienes solicitudes de reserva de acientos.
												</div>
											</div>	
										</div>
									</div>

								</div>
								<div class="col-xs-12">
									<p>Informacion adicional:</p>
									@if($viaje->informacion)
										{{$viaje->informacion}}
									@else
										<p><small><em>no agregaste informaci&oacute;n adicional</em></small></p>
									@endif
								</div>
						  </div>
						 
						</div>


						 <div class="panel-footer text-center">
						  	<a href="{{url('viajes/id/'.$viaje->id)}}"><button class="btn-question">Ver publicaci&oacute;n</button></a> <button class="btn-cancelar" data-toggle="modal" data-target="#myModal" onclick="prepareDeleteId({{$viaje->id}})">Cancelar viaje <i class="fa fa-trash-o"></i></button>
						  </div>
					</div>	
				@endforeach 
				<div class="row">
					<div class="col-xs-12 text-center">
						{{ $viajes->links() }}
					</div>
				</div>
		</div>


				
	</div>
</section>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">¿Est&aacute;s seguro de querer eliminar este viaje?</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer text-center" style="text-align: center">
      	<form action="{{ url('eliminar/viaje') }}" method="post">
      		{{csrf_field()}}
      		<input type="hidden" id="viaje_id" name="viaje_id">
      		<button type="submit" class="btn-question">Eliminar</button>
      	</form>
        <button type="button" class="btn-cancelar" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('additionalScript')
	<script>
		function prepareDeleteId(viaje_id){
			$('#viaje_id').val(viaje_id);
		}
	</script>
@endsection