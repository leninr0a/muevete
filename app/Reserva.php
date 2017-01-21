<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function viaje(){
    	return $this->belongsTo(Viaje::class);
    }
    
}
