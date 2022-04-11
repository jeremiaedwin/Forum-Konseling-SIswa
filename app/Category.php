<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function post(){
    	return $this->hasMany('App\Post');
    }

    public function rekapkonseling(){
    	return $this->hasMany('App\Rekapkonseling');
    }

    public function article(){
        return $this->hasMany('App\Article');
    }
}
