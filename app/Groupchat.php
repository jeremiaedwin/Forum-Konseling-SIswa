<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupchat extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function groupchat_user(){
    	return $this->hasMany('App\Groupchat_user');
    }

    public function chatgroup(){
    	return $this->hasMany('App\Chatgroup');
    }
}
