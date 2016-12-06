@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-log-in">
                <div class="panel-heading"><h3>Inicia sesi&oacute;n</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-mail</label>

                            <div class="col-md-6">
                                <div class="input-group">   
                                    <span class="input-group-addon"><i class="fa fa-at fa-log-in"></i></span><input type="email" name="email" class="form-control input-login" value="{{old('email')}}" placeholder="E-mail"  required autofocus>
                                </div>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contrase&ntilde;a</label>

                            <div class="col-md-6">
                                <div class="input-group">  
                                    <span class="input-group-addon"><i class="fa fa-lock fa-log-in">    </i></span><input type="password" name="password" class="form-control input-login" placeholder="Contrase&ntilde;a" required >
                                </div>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn-log-in-page">
                                    Iniciar sesi&oacute;n
                                </button>
                                <a  class="btn btn-link" href="{{ url('/password/reset') }}">
                                   <small>¿Olvidaste tu contrase&ntilde;a?</small>
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recu&eacute;rdame
                                    </label>
                                </div>

                                
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="col-md-12 text-center">
                        <p>Tambi&eacute;n puedes ingresar a nuestro sistema haciendo uso de tu cuenta Facebook</p>
                    </div>
                    <div class="col-md-4 col-md-offset-4">

                        <img src="images/btn_facebook.png" class="img-responsive" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
