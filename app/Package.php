<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    

    public function carts(){
        return $this->hasMany('App\Cart');
    }
}
