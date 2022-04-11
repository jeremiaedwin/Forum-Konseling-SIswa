<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caterepo extends Model
{
    public function report(){
        return $this->hasMany('App\Report');
    }
}
