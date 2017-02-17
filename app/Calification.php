<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calification extends Model
{
	public function from(){
		return $this->belongsTo(User::class,'sender_id');
	}

    public function to(){
    	return $this->belongsTo(User::class,'receiver_id');
    }
}
