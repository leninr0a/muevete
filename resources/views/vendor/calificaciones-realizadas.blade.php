@include('layout.layout')

@section('content')
<section class="profile-section">
	<div class="container container-profile well">
		<div class="row">
			<div class="col-xs-4 profile-col-left ">
				@include('partials.profile-col')
			</div>
			<div class="col-xs-8 profile-col-right  ">
			
				<!-- AQUI VA EL CONTENIDO -->

			</div>
		</div>
	</div>
</section>


@endsection
