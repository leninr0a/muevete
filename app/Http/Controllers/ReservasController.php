<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\Viaje;
use Illuminate\Http\Request;



class ReservasController extends Controller
{
    public function create(){
    	if(request()->ajax()){
			$data = request()->all();
    		//Crea el objeto reserva y lo almacena en la base de datos
			$reserva = new Reserva;
			$reserva->viaje_id = $data["viaje_id"];
			$reserva->user_id = $data["user_id"];
			$reserva->save();
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
    		return response()->json(['reservas_pendientes'=>$count_pending,'reservas_aceptadas'=>$count_accepted]);
    	}
    }

    public function rechazar(){
    	if(request()->ajax()){
    		$data = request()->all();
    		$reserva = Reserva::where('id',$data["reserva_id"]);
    		$reserva->delete();
    		$count_pending = Reserva::where(['estado'=>'pendiente','viaje_id'=>$data["viaje_id"]])->count();
    		$count_accepted = Reserva::where(['estado'=>'aceptada','viaje_id'=>$data["viaje_id"]])->count();
            Viaje::where("id",$data["viaje_id"])->update(['asientos_reservados'=>$count_accepted]);
    		return response()->json(['reservas_pendientes'=>$count_pending,'reservas_aceptadas'=>$count_accepted]);

    	}
    }
}
