<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function receiver(){
    	return $this->belongsTo('App\Receiver');
    }

    public function sender(){
    	return $this->belongsTo('App\Sender');
    }
}
