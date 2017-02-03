<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cedula'    =>  ['required','unique:users,cedula','numeric','min:6'],
            'nombre'    =>  ['required','string','min:3'],
            'apellido'  =>  ['required','string','min:2'],
            'email'     =>  ['required','unique:users,email','email'],
            'telefono'  =>  ['required','numeric'],
            'password'  =>  ['required','confirmed','min:7']    
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'cedula'       =>   $data['cedula'],
            'nombre'       =>   $data['nombre'],
            'apellido'     =>   $data['apellido'],
            'email'        =>   $data['email'],
            'password'     =>   bcrypt($data['password']),
            'telefono'     =>   $data['telefono'],
            'genero'       =>   $data['genero'],
            'nacionalidad' =>   $data['nacionalidad'],
        ]);
    }

     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try{
            $socialUser = Socialite::driver('facebook')->user();

        }catch(\Exception $e){
            return redirect('/');
        }

        $user = User::where('email',$socialUser->email)->get()->first();

        if(!$user){
            $user = new User;
            $user->nombre = $socialUser->user["first_name"];
            $user->apellido = $socialUser->user["last_name"];
            $user->email = $socialUser->user["email"];
            $user->genero = $socialUser->user["gender"] == "female" ? "F" : "M";
            $anio = date("Y") - $socialUser->age_range["min"];
            $user->fecha_nacimiento = $anio."-01-01";
            $user->facebook_id = $socialUser->id;
            $arrContextOptions=array(
            "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            ),
            );  
            $url="http://graph.facebook.com/".$socialUser->id."/picture?type=large";
            $data=file_get_contents($url, false, stream_context_create($arrContextOptions));
            $fileName = $socialUser->id.'.jpg';
            $file = fopen('images/profiles/'.$fileName, 'w+');
            fputs($file, $data);
            fclose($file);

            $user->picture = $fileName;

            $user->save();
        }else if($user->facebook_id == null){
            User::where('id',$user->id)->update(['facebook_id'=>$socialUser->id]);
        }

        auth()->login($user);

        return redirect()->to('/');
        
    }
}
