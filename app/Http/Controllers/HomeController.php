<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function perfil()
    {
        return view('profile');
    }

    public function publicarViaje(){
        return view('publicar');
    }

    public function viajesPublicados(){
        $viajes = DB::table('viajes')->where('user_id',Auth::user()->id)->paginate(3);
        
        return view('viajes-publicados')->with(compact('viajes'));
    }

    public function viajesPasajero(){
        return view('viajes-pasajero');
    }



    public function createViaje(){

        //Validacion de los datos recibidos via POST
        $this->validate(request(), [
            'salida'        =>  ['required','string'],
            'llegada'       =>  ['required','string'],
            'fecha'         =>  ['required','string'],
            'hora'          =>  ['required','string'],
            'precio'        =>  ['required','numeric'],
            'efectivo'      =>  ['required_unless:pago_online,true'],
            'pago_online'   =>  ['required_unless:efectivo,true'],
            'asientos'      =>  ['required','integer'],
            'informacion'   =>  ['string']    
        ]);
        
        $data = request()->all();
       
        $data["efectivo"] = isset($data["efectivo"]) ? : false;
        $data["pago_online"] = isset($data["pago_online"]) ? : false;


        $viaje = new \App\Viaje;

        $viaje->salida = $data["salida"];
        $viaje->user_id = Auth::user()->id;
        $viaje->llegada = $data["llegada"];
        $viaje->fecha = $data["fecha"];
        $viaje->hora = $data["hora"];
        $viaje->precio = $data["precio"];
        $viaje->efectivo = $data["efectivo"];
        $viaje->pago_online = $data["pago_online"];
        $viaje->asientos = $data["asientos"];
        $viaje->informacion = $data["informacion"];



        $viaje->save();

        request()->session()->flash('viaje_publicado', 'Tu viaje ha sido publicado con éxito');
        request()->session()->flash('viaje', $viaje);

        return redirect('home');
        
        
    }
}
