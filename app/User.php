<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Province;
use App\District;
use App\Regency;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'role', 'password',
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

    
    public function province() {
        return $this->belongsTo('App\Province');
    }

    public function regency() {
        return $this->belongsTo('App\Regency');
    }

    public function district() {
        return $this->belongsTo('App\District');
    }

    public function bank() {
        return $this->belongsTo('App\Bank');
    }

    public function packages() {
        return $this->hasMany('App\Package')->where('hidden', FALSE)->orderBy('created_at', 'desc');
    }

    public function orgpendcarts() {
        return $this->hasManyThrough('App\Cart', 'App\Package', 'user_id', 'package_id')
                    ->where('status', 'Pending')
                    ->where('hidden', FALSE)
                    ->orderBy('updated_at', 'desc');
    }

    public function orgdonecarts() {
        return $this->hasManyThrough('App\Cart', 'App\Package', 'user_id', 'package_id')
                    ->where('status', 'Event Selesai')
                    ->orderBy('updated_at', 'desc');
    }

    public function orgupcarts() {
        return $this->hasManyThrough('App\Cart', 'App\Package', 'user_id', 'package_id')
                    ->where('status', 'Deal')
                    ->orderBy('updated_at', 'desc');
    }

    public function orgpendcarts_lim() {
        return $this->hasManyThrough('App\Cart', 'App\Package', 'user_id', 'package_id')
                    ->where('status', 'Pending')
                    ->orderBy('updated_at', 'desc')
                    ->limit(4);
    }

    public function upcarts() {
        return $this->hasMany('App\Cart')
                    ->where('status', 'Deal')
                    ->orderBy('updated_at', 'desc');
    }

    public function pendcarts() {
        return $this->hasMany('App\Cart')
                    ->where('status', 'Pending')
                    ->orderBy('updated_at', 'desc');
    }


    public function paytransactions_lim() {
        return $this->hasMany('App\Transaction')
                    ->where('status', 'Menunggu Pembayaran')
                    ->orderBy('created_at', 'desc')
                    ->limit(4);
    }

    public function allpackages() {
        return $this->hasMany('App\Package')->orderBy('created_at', 'desc');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction')->orderBy('created_at', 'desc');
    }

    public function paytransactions() {
        return $this->hasMany('App\Transaction')
                    ->where('status', 'Menunggu Pembayaran')
                    ->orderBy('created_at', 'desc');
    }
}
