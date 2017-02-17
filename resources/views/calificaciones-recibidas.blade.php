@extends('layout.layout')

@section('content')
<section class="profile-section">
	<div class="container container-profile well">
		<div class="row">
			<div class="col-xs-4 profile-col-left ">
				@include('partials.profile-col')
			</div>
			<div class="col-xs-8 profile-col-right  ">
				@if(Auth::user()->sent_califications->count() == 0)
					<div class="alert alert-info">
						Aun no has recibido ninguna calificaci&oacute;n.
					</div>
				@else
					
				@endif
			</div>
		</div>
	</div>
</section>
@endsection