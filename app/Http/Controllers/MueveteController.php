<?php

namespace App\Http\Controllers;
use App\Viaje;
use App\User;
use App\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MueveteController extends Controller
{
    public function index(){
    	return view('home');
    }

    public function register(){
    	return view('register');
    }


    public function comoFunciona(){
    	return view('como-funciona');
    }

    public function queEs(){
    	return view('que-es');
    }

    public function buscarViaje(){
        $no_viajes = false;
        $no_viajes_at_all = false;
        $data = request()->all();

        $viajes = Viaje::where('salida','LIKE','%'.$data["salida"].'%')
                        ->where('llegada','LIKE','%'.$data["llegada"].'%')
                        ->where('fecha',$data["fecha"])->orderBy('fecha')->paginate(8);


       
        if(count($viajes) == 0){
            $no_viajes=true;
            $viajes = Viaje::where('salida','LIKE','%'.$data["salida"].'%')
                        ->where('llegada','LIKE','%'.$data["llegada"].'%')->paginate(8);
            if(count($viajes) == 0){
                $no_viajes_at_alt=true;
            }
        }

        
        $viajes->setPath('busqueda?salida='.$data["salida"].'&llegada='.$data["llegada"].'&fecha='.$data["fecha"].'');
        request()->session()->flash('salida', $data["salida"]);
        request()->session()->flash('llegada', $data["llegada"]);
        request()->session()->flash('no_viajes', $no_viajes);
        request()->session()->flash('no_viajes_at_all',$no_viajes_at_all);


        return view('busqueda-viajes')->with(compact('viajes'));
    }

    public function verViaje($idViaje = null){
        $viaje = Viaje::where('id',$idViaje)->get();
        $preguntas = Pregunta::where('viaje_id',$idViaje)->get();
      
        return view('viaje-info',['viaje'=>$viaje[0]]);
    }



}
