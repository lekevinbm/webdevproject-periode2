<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function photo(){
        return $this->belongsTo('App\Auction','auction_id');
    }
}
