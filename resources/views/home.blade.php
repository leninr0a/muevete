@extends('layout.layout')

@section('content')
    <section class="hero">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center header-subtitle">La <strong>nueva</strong> forma de viajar en <strong>Venezuela</strong></h1>
                </div>
            
                <div class="col-xs-12">
                    <h1 class="text-center header-subtitle">Viaja <strong>c&oacute;modo</strong>, viaja <strong>seguro</strong>, viaja <strong>f&aacute;cil</strong></h1>
                </div>
            </div>
            <div class="row">   
                <div class="col-xs-12 col-form">
                    <form action="{{url('viajes/busqueda')}}" method="GET">
                   
                    <div class="form-container">
                        <div class="input-container">   
                        <h4 class="text-center"><i class="glyphicon glyphicon-map-marker "></i> Ciudad origen</h4>
                        <input type="text" id="form_salida" name="salida" class=" input-text" placeholder="Ciudad origen">
                        </div>
                        
                        <div class="input-container">   
                        <h4 class="text-center"><i class="glyphicon glyphicon-map-marker "></i> Ciudad destino</h4>
                        <input type="text" id="form_llegada" name="llegada" class="input-text" placeholder="Ciudad destino"></div>

                        <div class="input-container">   
                        <h4 class="text-center "><i class="glyphicon glyphicon-calendar "></i> Fecha</h4>
                            <div id="sandbox-container" >
                                <input type="text" name="fecha" class="input-text"  data-date-format="yyyy-mm-dd">      
                            </div> 
                        </div>
                        <button class="btn-search"><i class="fa fa-search"></i> &nbsp; B&uacute;squeda</button>
                    </div>
                    </form>
                </div>
                </div>
        </div>
    </section>
    <section class="steps">
        <div class="container">
            <div class="row steps-row">
                <div class="col-xs-12 text-center">
                    <h1>Viaja por Venezuela en cinco sencillos pasos</h1>
                    <br><br>
                </div>
                <div class="col-xs-2 text-center col-xs-offset-1">
                    <div class="icon-step icon-step-step-one">
                        <i class="fa fa-laptop fa-4x">
                    </i>
                    </div>
                    <h3><strong>1.</strong></h3>
                    <p><a class="link" href="">Registrate</a> en Muevete.com desde tu computadora, celular o tablet  si no lo has hecho</p>
                </div>  
                <div class="col-xs-2 text-center">
                    <div class="icon-step icon-step-step-two">
                        <i class="fa fa-map fa-4x ">
                    </i>
                    </div>
                    <h3><strong>2.</strong></h3>
                    <p>Busca o <a href="" class="link">p&uacute;blica</a> un viaje hacia el lugar, fecha y hora de tu preferencia</p>
                </div>  
                <div class="col-xs-2 text-center">
                    <div class="icon-step icon-step-step-three">
                        <i class="fa fa-user-plus fa-4x ">
                    </i>
                    </div>
                    <h3><strong>3.</strong></h3>
                    <p>Reserva tu puesto enviando una solicitud al conductor del viaje. Si eres el conductor gestiona tus solicitudes de reserva de asientos.</p>
                </div>  
                <div class="col-xs-2 text-center">
                    <div class="icon-step icon-step-step-four">
                        <i class="fa fa-credit-card fa-4x">
                    </i>
                    </div>
                    <h3><strong>4.</strong></h3>
                    <p>Paga al conductor sin complicaciones a trav&eacute;s de nuestro sitio web o en efectivo.</p>
                </div>
                <div class="col-xs-2 text-center">
                    <div class="icon-step icon-step-step-five">
                        <i class="fa fa-calendar-check-o fa-4x">
                    </i>
                    </div>
                    <h3><strong>5.</strong></h3>
                    <p>Espera a que te recojan el dia y la hora acordada y disfruta el recorrido hacia tu destino.</p>
                </div>      
            </div>
        </div>
    </section>

    <section class="device-section">
        <div class="container">
            <div class="row">
            <div class="col-xs-5">
                <img src="https://image.freepik.com/foto-gratis/chica-jugando-con-una-tablet_1149-281.jpg" class="img-responsive" alt="">
            </div>
            <div class="col-xs-7 text-center col-anywhere">
                <h1>¿Por qu&eacute; hacer <em>Carpooling</em>?</h1>
                <br><br>  
                    <div class="row">   
                        <div class="col-xs-4">  
                            <div class="reason">
                                <i class="fa fa-check-square fa-3x ico-reason"></i>
                                <h4>F&aacute;cil</h4>
                                <p>     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem minima totam dolores.</p>
                            </div>
                        </div>
                        <div class="col-xs-4">  
                            <div class="reason">
                                <i class="fa fa-child fa-3x ico-reason"></i>
                                <h4>C&oacute;modo</h4>
                                <p>     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem minima totam dolores.</p>
                            </div>
                        </div>
                        <div class="col-xs-4">  
                            <div class="reason">
                                <i class="fa fa-shield fa-3x ico-reason"></i>
                                <h4>Seguro</h4>
                                <p>     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem minima totam dolores.</p>
                            </div>
                        </div>
                        <div class="col-xs-4">  
                            <div class="reason">
                                <i class="fa fa-leaf fa-3x ico-reason"></i>
                                <h4>Ecol&oacute;gico</h4>
                                <p>     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem minima totam dolores.</p>
                            </div>
                        </div>
                        <div class="col-xs-4">  
                            <div class="reason">
                                <i class="fa fa-users fa-3x ico-reason"></i>
                                <h4>Social</h4>
                                <p>     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem minima totam dolores.</p>
                            </div>
                        </div>
                        <div class="col-xs-4">  
                            <div class="reason">
                                <i class="fa fa-money fa-3x ico-reason"></i>
                                <h4>Econ&oacute;mico</h4>
                                <p>     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem minima totam dolores.</p>
                            </div>
                        </div>
                    </div>
                <small></small>
                <!-- Trigger the modal with a button -->

                
            </div>
        </div>
        </div>
    </section>

    
   

@endsection

@if (Session::has('viaje_publicado'))
  <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>{{Auth::user()->nombre}}</strong>, tu viaje ha sido publicado con &eacute;xito</h4>
              </div>
              <div class="modal-body">
                <p>Te enviaremos v&iacute;a e-mail todas las solicitudes de reserva de asiento las cuales podr&aacute;s gestionar desde nuestro sitio web en la secci&oacute;n <strong>mis viajes</strong>.</p>
                <div class="alert alert-info">
                    @if(Session::has('viaje'))
                        <h5><strong>Resumen del viaje</strong></h5>
                        <p><i class="fa fa-circle-o green"></i> {{Session::get('viaje')->salida}}</p>
                        <p><i class="fa fa-circle-o red"></i> {{Session::get('viaje')->llegada}}</p>
                        <p><i class="fa fa-calendar-check-o"></i> {{Session::get('viaje')->fecha}}</p>
                        <p><i class="fa fa-clock-o"></i> {{Session::get('viaje')->hora}}</p>
                        <p><i class="fa fa-users"></i> {{Session::get('viaje')->asientos}} asientos disponibles - {{Session::get('viaje')->precio}} Bs/pasajero. </p>
                    @endif
                </div>
                <p>Comparte tu viaje y aumenta las probabilidades de conseguir pasajeros</p>
                <div class="row row-social-buttons">
                    <div class="col-xs-6 text-center text-right">
                        <div class="button-social-facebook"><i class="fa fa-facebook"></i> Compartir en Facebook</div>
                    </div>
                    <div class="col-xs-6 text-center text-left">
                        <div class="button-social-twitter"><i class="fa fa-twitter"></i> Compartir en Twitter</div>
                    </div>
                </div>
                <div class="alert alert-warning">
                    <p><small> <strong>Recuerda:</strong> solo puedes eliminar tu viaje solo hasta <strong>72 horas</strong> antes del mismo. Si eliminas tu viaje luego de ese momento ser&aacute;s penalizado en nuestra aplicaci&oacute;n de forma autom&aacute;tica</small></p>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>

          </div>
        </div>
        @section('additionalScript')
                <script>
                    $('#myModal').modal({ show: false});
                    $('#myModal').modal('show');
                </script>



        @endsection
@endif

@section('additionalScript')

    <script>
        var autocomplete, autocomplete_2;
        function initAutocomplete() {
          // Create the autocomplete object, restricting the search to geographical
          // location types.
          var options = {
            types:['(cities)'],
            componentRestrictions:{country:'ve'}
          }
          autocomplete_2 = new google.maps.places.Autocomplete(document.getElementById('form_llegada'),options);
          autocomplete = new google.maps.places.Autocomplete(document.getElementById('form_salida'),options);
          // When the user selects an address from the dropdown, populate the address
          // fields in the form.
        }
    </script>

    <script>
        $('#sandbox-container input').datepicker({
            startDate: "today",
            orientation: "bottom auto"
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDV8O_HBXu0qinR_zAaUEzgWqbFtd3N2os&signed_in=true&libraries=places&callback=initAutocomplete&region=VE"
        async defer></script>
@endsection