<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membergroup extends Model
{
    public function chatgroup(){
    	return $this->belongsToMany('App\Chatgroup');
    }
}
