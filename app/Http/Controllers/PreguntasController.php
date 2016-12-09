<?php

namespace App\Http\Controllers;
use App\Pregunta;
use App\Viaje;
use App\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PreguntasController extends Controller
{

    public function create(){
    	//Valida que el campo pregunta tenga un valor valido
    	$this->validate(request(), [
    		'pregunta'	=>	['required','string'],
    	]);
    	$data = request()->all();
    
    	//Crea el objeto pregunta y lo almacena en la base de datos
    	$pregunta = new Pregunta;
    	$pregunta->pregunta = $data["pregunta"];
    	$pregunta->viaje_id = $data["viaje_id"];
    	$pregunta->user_id = $data["user_id"];
    	$pregunta->save();

    	//Enviar la notificacion al conductor del viaje
    	$this->enviarNotificacionConductor($data["viaje_id"]);
    	
    	//Redirige a la vista del viaje
    	return redirect('viajes/id/'.$data["viaje_id"]); 

    }

    public function reply(){
    	//Valida que el campo respuesta tenga un valor valido
    	$this->validate(request(),[
    		'respuesta' => ['required','string'],
    	]);

    	$data = request()->all();

    	$respuesta = new Respuesta;
    	$respuesta->respuesta = $data["respuesta"];
    	$respuesta->viaje_id = $data["viaje_id"];
    	$respuesta->user_id = $data["user_id"];
    	$respuesta->pregunta_id = $data["pregunta_id"];
    	$respuesta->save();

    	$this->enviarNotificacionUsuario($data["pregunta_id"]);

    	return redirect('viajes/id/'.$data["viaje_id"]);
    }

    public function deletePregunta(){
    	$data = request()->all();
		$pregunta = Pregunta::where('id',$data["pregunta_id"])->where('user_id',Auth::user()->id)->get();
    	$pregunta->first()->delete();
 		return back();
    }

    public function deleteRespuesta(){
    	$data = request()->all();
    	$respuesta = Respuesta::where('id',$data["respuesta_id"])->where('user_id',Auth::user()->id);
    	$respuesta->delete();
    	return back();
    }


    public function enviarNotificacionUsuario($pregunta_id){
    	$pregunta = Pregunta::where('id',$pregunta_id)->get();
    	//echo "enviar notificacion a el usuario que pregunto ".$pregunta[0]->user_id;
    }

    public function enviarNotificacionConductor($viaje_id){
    	$viaje = Viaje::where('id',$viaje_id)->get();
    	//echo "enviar notificacion a el conductor".$viaje[0]->user_id;
    }
    
}
