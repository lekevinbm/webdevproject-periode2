<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'streetAndNumber', 'zipcode', 'city', 'country', 'phoneNumber', 'VAT_number', 'accountNumber',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function auctions(){
        return $this->hasMany('App\Auction', 'owner_id');
    }

    public function watchItems(){
        return $this->hasMany('App\WatchItem', 'user_id');
    }

    public function bids(){
        return $this->hasMany('App\Bid', 'user_id');
    }
}
