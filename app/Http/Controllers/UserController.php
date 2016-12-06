<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    		'password'	=>	['required','confirmed','min:7']	
    	]);
    	
    	$data = request()->all();
    	
    	//Crea una isntancia del modelo User
    	$user = new User;

    	//Ingresa los datos en la instancia
    	$user->cedula		=	$data['cedula'];
    	$user->nombre		=	$data['nombre'];
    	$user->apellido		=	$data['apellido'];
    	$user->email		=	$data['email'];
    	$user->password		=	bcrypt($data['password']);
    	$user->telefono		=	$data['telefono'];
    	$user->genero		=	$data['genero'];
    	$user->nacionalidad	=	$data['nacionalidad'];
    	
    	//Ingresa la instancia en la base de datos
    	$user->save();

		return redirect()->to('/');
    }
}
