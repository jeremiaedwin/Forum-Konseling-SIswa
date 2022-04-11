<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporankonseling extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function post(){
    	return $this->belongsTo('App\Post');
    }

    public function reportposts(){
        return $this->belongsTo('App\Reportpost');
    }
}
