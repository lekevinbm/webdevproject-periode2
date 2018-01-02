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
}
