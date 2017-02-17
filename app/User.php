<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula','nombre','apellido','email','password','telefono','nacionalidad','genero','fecha_nacimiento','picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function viajes(){
        return $this->hasMany(Viaje::class);
    }

    public function preguntas(){
        return $this->hasMany(Pregunta::class);
    }

    public function respuestas(){
        return $this->hasMany(Respuesta::class);
    }

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

    public function vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }

    public function sent_califications(){
        return $this->hasMany(Calification::class,'sender_id');
    }

    public function califications(){
        return $this->hasMany(Calification::class,'receiver_id');
    }

}
