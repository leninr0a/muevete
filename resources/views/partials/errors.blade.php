@if($errors->count())
	<div class="alert alert-danger">
	    <p><strong>Oops!</strong> Por favor corrija los siguientes campos:</p>
	    <ul>
	        @foreach($errors->all() as $error)
	        <li>{{$error}}</li>
	        @endforeach
	    </ul>
	</div>
@endif