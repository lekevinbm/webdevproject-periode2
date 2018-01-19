<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchItem extends Model
{
    protected $table = 'watchItems';
    protected $primaryKey = 'watchItem_id';

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function auction(){
        return $this->belongsTo('App\Auction','auction_id');
    }
}
