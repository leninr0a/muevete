<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Viaje;
use App\Vehiculo;


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
        //$viajes = DB::table('viajes')->where('user_id',Auth::user()->id)->paginate(3);
        $viajes = Viaje::where('user_id',Auth::user()->id)->paginate(3);
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
            'informacion'   =>  ['string'],
            'marca'         =>  ['required_if:vehiculo,add','string'],
            'modelo'        =>  ['required_if:vehiculo,add','string'],
            'placa'         =>  ['required_if:vehiculo,add','string','min:6','max:7'],
            'anio'          =>  ['required_if:vehiculo,add','string'],
        ]);

         $data = request()->all();

        if($data["vehiculo"] == "add"){
            $vehiculo = Vehiculo::create(['placa' => $data["placa"],'marca'=>$data["marca"],'modelo'=>$data["modelo"],'anio'=>$data["anio"],'user_id' => Auth::user()->id]);
            $vehiculo_id = $vehiculo->id;
        }else{
            $vehiculo_id = $data["vehiculo"]; 
        }

       
        $data["efectivo"] = isset($data["efectivo"]) ? : false;
        $data["pago_online"] = isset($data["pago_online"]) ? : false;
        $data["aire"] = isset($data["aire"]) ? : false;
        $data["mascotas"] = isset($data["mascotas"]) ? : false;
        $data["comer"] = isset($data["comer"]) ? : false;
        $data["musica"] = isset($data["musica"]) ? : false;
        $data["ninios"] = isset($data["ninios"]) ? : false;
        $data["fumar"] = isset($data["fumar"]) ? : false;

        $viaje = new \App\Viaje;

        $viaje->salida = $data["salida"];
        $viaje->salidaLat = $data["salidaLat"];
        $viaje->salidaLng = $data["salidaLng"];
        $viaje->user_id = Auth::user()->id;
        $viaje->llegada = $data["llegada"];
        $viaje->llegadaLat = $data["llegadaLat"];
        $viaje->llegadaLng = $data["llegadaLng"];
        $viaje->fecha = $data["fecha"];
        $viaje->hora = $data["hora"];
        $viaje->precio = $data["precio"];
        $viaje->efectivo = $data["efectivo"];
        $viaje->pago_online = $data["pago_online"];
        $viaje->asientos = $data["asientos"];
        $viaje->informacion = $data["informacion"];
        $viaje->vehiculo_id = $vehiculo_id;
        $viaje->aire = $data["aire"];
        $viaje->mascotas = $data["mascotas"];
        $viaje->fumar = $data["fumar"];
        $viaje->comer = $data["comer"];
        $viaje->musica = $data["musica"];
        $viaje->ninios = $data["ninios"];




        $viaje->save();

        request()->session()->flash('viaje_publicado', 'Tu viaje ha sido publicado con éxito');
        request()->session()->flash('viaje', $viaje);

        return redirect('home');
        
        
    }

    public function deleteViaje(){
        $data = request()->all();

        $viaje = Viaje::where('id',$data["viaje_id"])
                            ->where('user_id',Auth::user()->id);
        
        $viaje->first()->delete();

        return redirect('mi-cuenta/mis-viajes-publicados');
    }
}
