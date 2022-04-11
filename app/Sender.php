<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    protected $table = 'users';
    
    public function message(){
    	return $this->hasMany('App\Message');
    }

    public function chatgroup(){
    	return $this->hasMany('App\Chatgroup');
    }

    public function profile(){
    	return $this->hasMany('App\Profile');
    }
}
