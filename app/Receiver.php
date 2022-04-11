<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    protected $table = 'users';
    
    public function message(){
    	return $this->hasMany('App\Message');
    }

    public function replycomment(){
    	return $this->hasMany('App\ReplyComment');
    }

    public function reportpost(){
    	return $this->hasMany('App\Reportpost');
    }

    public function rekapkonseling(){
    	return $this->hasMany('App\Rekapkonseling');
    }
}
