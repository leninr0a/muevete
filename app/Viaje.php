<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
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

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

     protected static function boot() {
        parent::boot();

        static::deleting(function($viaje) { // before delete() method call this
             $viaje->preguntas()->delete();
             $viaje->respuestas()->delete();
             // do the rest of the cleanup...
        });
    }
}
