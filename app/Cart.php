<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function package() {
        return $this->belongsTo('App\Package');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function province() {
        return $this->belongsTo('App\Province');
    }

    public function regency() {
        return $this->belongsTo('App\Regency');
    }

    public function district() {
        return $this->belongsTo('App\District');
    }

    public function cancel() {
        return $this->belongsTo('App\User', 'cancel_id');
    }

    public function transaction() {
        return $this->belongsTo('App\Transaction');
    }
}
