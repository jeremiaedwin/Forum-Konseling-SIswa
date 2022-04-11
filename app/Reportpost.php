<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportpost extends Model
{
    public function receiver(){
    	return $this->belongsTo('App\Receiver');
    }

    public function post(){
    	return $this->belongsTo('App\Post');
    }

    public function laporankonseling(){
        return $this->hasMany('App\Laporankonseling');
    }
}
