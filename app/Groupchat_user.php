<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupchat_user extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function groupchat(){
    	return $this->belongsTo('App\Groupchat');
    }

    
}
