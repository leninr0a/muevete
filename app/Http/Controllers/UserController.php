<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;


class UserController extends Controller
{
	//Funcion para crear un usuario en la base de datos
    public function create(){

    	//Validacion de los datos recibidos via POST
    	$this->validate(request(), [
    		'cedula'	=>	['required','unique:users,cedula','numeric','min:6'],
    		'nombre'	=>	['required','string','min:3'],
    		'apellido'	=>	['required','string','min:2'],
    		'email'		=>	['required','unique:users,email','email'],
    		'telefono'	=>	['required','numeric'],
    		'password'	=>	['required','confirmed','min:7'],
            'fecha'     =>  ['required','date']
    	]);
    	
    	$data = request()->all();
    	
    	//Crea una instancia del modelo User
    	$user = new User;

        //Ingresa los datos en la instancia
        $user->cedula       =   $data['cedula'];
        $user->nombre       =   $data['nombre'];
        $user->apellido     =   $data['apellido'];
        $user->email        =   $data['email'];
        $user->password     =   bcrypt($data['password']);
        $user->telefono     =   $data['telefono'];
        $user->genero       =   $data['genero'];
        $user->nacionalidad =   $data['nacionalidad'];
        $user->fecha_nacimiento   =   $data['fecha'];
        //Asigna una imagen de perfil determinada dependiendo de si el usuario es hombre o mujer
        if($data['genero'] == 'M'){
            $user->picture  =   'man.png';
        }else{
            $user->picture  =   'woman.png';
        }
        
        //Ingresa la instancia en la base de datos
        $user->save();

        return redirect()->to('/');
    }

    public function profilePicture(){
        $rules = ['image' => 'required|image|max:1024*1024*1'];
        $messages = [
            'image.required' => 'La imagen es requerida',
            'image.image' => 'Formato no permitido',
            'image.max' => 'El máximo tamaño permitido de la imagen es 1 MB',
        ];
        $validator = Validator::make(request()->all(), $rules, $messages);
        
        if ($validator->fails()){
            return redirect('mi-cuenta/perfil')->withErrors($validator);
        }else{
            $name = str_random(30) . '-' . request()->file('image')->getClientOriginalName();
            request()->file('image')->move('images/profiles', $name);
            $user = new User;
            $user->where('id',Auth::user()->id)->update(['picture'=>$name]);
            return redirect('mi-cuenta/perfil')->with('status', 'Su imagen de perfil ha sido cambiada con éxito');
        }
    }
}
