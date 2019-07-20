<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function carts() {
        return $this->hasMany('App\Cart');
    }

    public function bank() {
        return $this->belongsTo('App\Bank');
    }
    
    public function bank1() {
        return $this->belongsTo('App\Bank', 'bank_id1');
    }
    
}
