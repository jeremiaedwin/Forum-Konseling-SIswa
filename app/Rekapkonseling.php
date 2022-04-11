<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekapkonseling extends Model
{
    protected $table = "rekap_konseling";

    public function receiver(){
    	return $this->belongsTo('App\Receiver');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
