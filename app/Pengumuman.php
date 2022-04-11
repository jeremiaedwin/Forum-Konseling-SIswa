<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function catepegus(){
        return $this->belongsTo('App\Catepegu');
    }
    public function status(){
        return $this->belongsTo('App\Status');
    }
}
