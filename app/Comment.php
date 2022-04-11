<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function post(){
    	return $this->belongsTo('App\Post');
    }

    public function replycomment(){
    	return $this->hasMany('App\ReplyComment');
    }

    public function commentlike(){
    	return $this->hasMany('App\CommentLike');
    }
}
