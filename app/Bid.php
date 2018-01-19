<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bids';
    protected $primaryKey = 'bid_id';

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function auction(){
        return $this->belongsTo('App\Auction','auction_id');
    }
}
