<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','username', 'email', 'password', 'role', 'tahun_masuk', 'tahun_keluar', 'status_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
    	return $this->hasOne('App\Profile');
    }

    public function pengumuman(){
    	return $this->hasMany('App\Pengumuman');
    }

    public function article(){
    	return $this->hasMany('App\Article');
    }

    public function post(){
    	return $this->hasMany('App\Post');
    }

    public function comment(){
    	return $this->hasMany('App\Comment');
    }

    public function replycomment(){
    	return $this->hasMany('App\ReplyComment');
    }

    public function like(){
    	return $this->hasMany('App\Like');
    }

    public function commentlike(){
    	return $this->hasMany('App\CommentLike');
    }

    public function groupchat(){
    	return $this->hasMany('App\Groupchat');
    }

    public function groupchat_user(){
    	return $this->hasMany('App\Groupchat_user');
    }

    public function chatgroup(){
    	return $this->hasMany('App\Chatgroup');
    }

    public function rekapkonseling(){
    	return $this->hasMany('App\Rekapkonseling');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function report(){
    	return $this->hasMany('App\Report');
    }

}
