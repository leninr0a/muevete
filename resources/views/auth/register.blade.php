@extends('layout.layout')

@section('title','Reg&iacute;strate en Mu&eacute;vete')

@section('content')
    
<div class="register-page">     
    <div class="bg-black">
    <div class="container container-register">
    <div class="row">
        <div class="col-xs-4 col-yellow"></div>
        <div class="col-xs-4 col-blue"></div>
        <div class="col-xs-4 col-red"></div>
    </div>
        <div class="row">
            <div class="col-xs-12 text-left">
                <h2 class="header-register">Reg&iacute;strate</h2>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                @include('partials/errors')
            </div>
        </div>
        <form action="{{url('/register/user')}}" method="POST">
            <div class="row row-register-form">
                <div class="col-xs-2">
                    <p>C&eacute;dula</p>
                    <select name="nacionalidad" class="form-control">
                        <option value="V">V</option>
                        <option value="E">E</option>
                    </select>
                </div>
                <div class="col-xs-4 cedula-field-col">
                    <p>&nbsp;</p>
                    <input type="text"  pattern="[0-9]{6,}" name="cedula" class="form-control" value="{{ old('cedula') }}" placeholder="Ej: 1234567"required>
                </div>
                <div class="col-xs-6">
                    <p>G&eacute;nero</p>
                    <select name="genero" class="form-control">
                        <option value="M">M&aacute;sculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                
            </div>
            <div class="row row-register-form">

                <div class="col-xs-6 ">
                    <p>Nombre</p>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
                </div>
                <div class="col-xs-6">
                    <p>Apellido</p>
                    <input type="text" name="apellido" value="{{ old('apellido') }}" class="form-control" required>
                </div>
            </div>
            <div class="row row-register-form">
                <div class="col-xs-6 ">
                    <p>Email</p>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="ejemplo@correo.com" required>
                </div>
                <div class="col-xs-6 ">
                    <p>Tel&eacute;fono (fijo o m&oacute;vil)</p>
                    <input type="tel" pattern="[0-9].{10,11}" name="telefono" value="{{ old('telefono') }}" class="form-control" placeholder="Ej: 04121626213 o 02742529362" required>
                </div>
            </div>
            <div class="row row-register-form">
                <div class="col-xs-6 ">
                    <p>Contrase&ntilde;a</p>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-xs-6">
                    <p>Repetir contrase&ntilde;a</p>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                
            </div>
            <div class="row row-register-form">
                <div class="col-xs-6">
                    <p>Fecha de nacimiento</p>
                    <div id="sandbox-container" class="input-group date">
                      <input type="text" id="fecha-nacimiento" name="fecha" class="form-control" value="{{old('fecha')}}" data-date-format="yyyy-mm-dd"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>      
                </div>
            </div>
            <div class="row row-register-form">
                <div class="col-xs-6 ">
                    
                    <p><small>Al registrarme, declaro que soy mayor de edad y acepto las <a href="">Pol&iacute;ticas de privacidad</a> y los <a href="">T&eacute;rminos y condiciones de uso</a></small></p>
                </div>
                <div class="col-xs-3 btn-col">
                    <button class="btn btn-registrarme" type="submit">Registrarme</button>
                </div>
                <div class="col-xs-6 col-xs-offset-3">
                        <hr class="">
                </div>
            </div>
            {{ csrf_field() }}
        </form>

        <div class="row">

            <div class="col-xs-12 text-center">
                <h3>o inicia sesi&oacute;n con un click usando tu Facebook</h3>
                <a href="" class="btn-facebook-login"><img src="images/btn_facebook.png" class="img-responsive" alt=""></a>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection

@section('additionalScript')
    <script>
        $('#fecha-nacimiento').datepicker({
            endDate: "-18y",
            orientation: "bottom auto",
        });
    </script>
@endsection