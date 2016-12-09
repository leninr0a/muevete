<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function viaje(){
    	return $this->belongsTo(Viaje::class);
    }

    public function respuesta(){
    	return $this->hasOne(Respuesta::class);
    }

     protected static function boot() {
        parent::boot();

        static::deleting(function($pregunta) { // before delete() method call this
             $pregunta->respuesta()->delete();
             // do the rest of the cleanup...
        });
    }
}
