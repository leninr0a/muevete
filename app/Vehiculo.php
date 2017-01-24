<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
	 protected $fillable = [
        'placa','marca','modelo','anio','user_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function viaje(){
    	return $this->belongsToMany(Viaje::class);
    }
}
