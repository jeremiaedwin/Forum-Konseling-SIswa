<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function post(){
    	return $this->hasMany('App\Post');
    }
    public function article(){
    	return $this->hasMany('App\Article');
    }
    public function pengumuman(){
    	return $this->hasMany('App\Pengumuman');
    }
}
