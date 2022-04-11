<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catepegu extends Model
{
    public function pengumuman(){
    	return $this->hasMany('App\Pengumuman');
    }
}
