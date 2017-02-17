@extends('layout.layout')

@section('content')
<section class="profile-section">
	<div class="container container-profile well">
		<div class="row">
			<div class="col-xs-4 profile-col-left ">
				@include('partials.profile-col')
			</div>

			<div class="col-xs-8 ">
				<h1 class="text-center">Notificaciones</h1>
			</div>
			<p>{{Auth::user()->unread_notifications}}</p>
			<div class="col-xs-8 profile-col-right  ">
				@if(Auth::user()->notifications->count() == 0)
					<div class="alert alert-info">
						No tienes ninguna notificaci&oacute;n
					</div>
				@else
					@foreach($notificaciones as $notification)
						<div class="col-xs-12 notification-row">
                    		<div class="row">
                    			<div class="col-xs-3 ">
                    				<img src="{{URL::asset('images/profiles/'.$notification->data['sender']['picture']) }}" class="avatar-questions"  alt="">
                    			</div>
                    			<div class="col-xs-7 text-left">
                    				<small>{{$notification->data['message']}}</small>
                    			</div>
                    			<div class="col-xs-2">
                    				<small>{{$notification->created_at->diffForHumans()}}</small>
                    			</div>
                    		</div>
				         </div>
					@endforeach
				@endif
				<div class="row">
					<div class="col-xs-12 text-center">
						{{ $notificaciones->links() }}
					</div>
				</div>

			</div>
		</div>
	</div>
</section>



@endsection

@section('additionalScript')
	<script>
		
	</script>
@endsection