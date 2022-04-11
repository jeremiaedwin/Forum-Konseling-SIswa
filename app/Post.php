<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function comment(){
    	return $this->hasMany('App\Comment');
    }

    public function like(){
    	return $this->hasMany('App\Like');
    }

    public function report(){
    	return $this->hasMany('App\Report');
    }

    public function reportpost(){
    	return $this->hasMany('App\Reportpost');
    }

    public function laporankonseling(){
    	return $this->hasMany('App\Laporankonseling');
    }
}
