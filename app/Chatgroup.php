<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatgroup extends Model
{
    public function sender(){
    	return $this->belongsTo('App\Sender');
    }

    public function groupchat(){
    	return $this->belongsTo('App\Groupchat');
    }

    public function membergroup(){
    	return $this->belongsToMany('App\Membergroup');
    }
}
