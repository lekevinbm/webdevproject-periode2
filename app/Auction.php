<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = 'auctions';
    protected $primaryKey = 'auction_id';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function photos(){
        return $this->hasMany('App\Photo', 'auction_id');
    }
    
    public function watchItems(){
        return $this->hasMany('App\WatchItem', 'auction_id');
    }

    public function bids(){
        return $this->hasMany('App\Bid', 'auction_id')->orderBy('bidPrice','desc');
    }
}
