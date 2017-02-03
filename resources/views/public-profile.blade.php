@extends('layout.layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<img src="{{URL::asset('images/profiles/'.$user->picture) }}" alt="" class="profile-img">
			</div>
			<div class="col-xs-12 text-center">
				{{$user->nombre}} {{$user->apellido}} <p>{{$user->cedula}}</p>
				<p>Viajes p&uacute;blicados: {{$user->viajes->count()}}</p>
			</div>
		</div>
	</div>


@endsection


@section('additionalScript')

@endsection