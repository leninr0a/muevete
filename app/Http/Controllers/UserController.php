<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;

include(app_path().'/Includes/validators.php');

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
    		'telefono'	=>	['required','numeric','digits:11'],
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

    public function updatePhone(){
        $this->validate(request(), 
            ['telefono'  =>  ['required','numeric','digits:11'],
        ]);
        $data=request()->all();
        User::where('id',Auth::user()->id)->update(['telefono'=>$data["telefono"]]);
        return redirect('mi-cuenta/perfil')->with('status', 'Tu número de teléfono ha sido actualizado con éxito.');
        
    }

    public function updateEmail(){
        $this->validate(request(), 
            ['email'  =>  ['required','unique:users,email','email'],
        ]);
        $data=request()->all();
        User::where('id',Auth::user()->id)->update(['email'=>$data["email"]]);
        return redirect('mi-cuenta/perfil')->with('status', 'Tu dirección de correo ha sido actualizado con éxito. La próxima vez que inicies sesión debes hacerlo usando tu nueva dirección.');
       
    }

    public function updatePassword(){

        $rules = [
            'old_password'  => 'required|old_password:' . Auth::user()->password,
            'password'      =>  ['required','confirmed','min:7']
        ];
        $messages = [
            'old_password.required' => 'El campo contraseña actual no puede estar vacio ',
            'old_password.old_password' => 'La contraseña actual no es correcta',
            'password.required' => 'El campo contraseña no puede estar vacio',
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden',
            'password.min' => 'La contraseña debe ser mayor a 7 caracteres'
        ];
        
        $validator = Validator::make(request()->all(), $rules, $messages);

      
         if ($validator->fails()){
            return redirect('mi-cuenta/perfil')->withErrors($validator);
        }else{
            return redirect('mi-cuenta/perfil')->with('status', 'Tu contraseña ha sido actualizada con éxito. La próxima vez que inicies sesión debes hacer usando tu nueva contraseña.');
        }
    }
}
