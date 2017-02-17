<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\Viaje;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SolicitudRecibida;
use App\Notifications\SolicitudRespondida;
use App\Notifications\SolicitudCancelada;
use Redirect;


class ReservasController extends Controller
{
    public function create(){
    	if(request()->ajax()){
			$data = request()->all();
    		//Crea el objeto reserva y lo almacena en la base de datos
			$reserva = new Reserva;
			$reserva->viaje_id = $data["viaje_id"];
			$reserva->user_id = Auth::user()->id;
			$reserva->save();

            //Enviar notificacion al usuario que creo el viaje
            $this->enviarNotificacionConductor($data["viaje_id"],Auth::user());
    		die;
    	}
    }

    public function aceptar(){
    	if(request()->ajax()){
    		$data = request()->all();
    		Reserva::where("id",$data["reserva_id"])->update(['estado'=>'aceptada']);
    		$count_pending = Reserva::where(['estado'=>'pendiente','viaje_id'=>$data["viaje_id"]])->count();
    		$count_accepted = Reserva::where(['estado'=>'aceptada','viaje_id'=>$data["viaje_id"]])->count();
            Viaje::where("id",$data["viaje_id"])->update(['asientos_reservados'=>$count_accepted]);

            $this->enviarNotificacionPasajero(Reserva::find($data["reserva_id"])->user,true,Viaje::find($data["viaje_id"]));

    		return response()->json(['reservas_pendientes'=>$count_pending,'reservas_aceptadas'=>$count_accepted]);
    	}
    }

    public function rechazar(){
    	if(request()->ajax()){
    		$data = request()->all();
    		$reserva = Reserva::find($data["reserva_id"]);
    		$user = $reserva->user;
            $reserva->delete();
    		$count_pending = Reserva::where(['estado'=>'pendiente','viaje_id'=>$data["viaje_id"]])->count();
    		$count_accepted = Reserva::where(['estado'=>'aceptada','viaje_id'=>$data["viaje_id"]])->count();
            Viaje::where("id",$data["viaje_id"])->update(['asientos_reservados'=>$count_accepted]);

            
            $viaje = Viaje::find($data["viaje_id"]);

            $this->enviarNotificacionPasajero($user,false,$viaje);

    		return response()->json(['reservas_pendientes'=>$count_pending,'reservas_aceptadas'=>$count_accepted]);

    	}
    }


    //Envia la notificacion al usuario que publico el viaje
    public function enviarNotificacionConductor($viaje_id,$sender){
        $user = Viaje::find($viaje_id)->user;
        $user->notify(new SolicitudRecibida($sender));
    }

    //Envia la notificacion al usuario que envio la solicitud de reserva de asiento
    public function enviarNotificacionPasajero($user,$respuesta,$viaje){
       $user->notify(new SolicitudRespondida($viaje,$respuesta));
    }


    public function cancelar(){
        $data = request()->all();
        $reserva = Reserva::find($data['reserva_id']);
        if($reserva->user->id == Auth::user()->id){
            if($reserva->estado == 'aceptada'){
                //Se notifica al usuario que publico el viaje que el pasajero ha cancelado su reserva aceptada
                $reserva->viaje->user->notify(new SolicitudCancelada($reserva));
            }
            Viaje::where('id',$reserva->viaje->id)->update(['asientos_reservados'=>$reserva->viaje->asientos_reservados-1]);
            $reserva->delete();
        }
        return Redirect::back();
    }
}
