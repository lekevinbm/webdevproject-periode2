<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\Bid;
use Validator;
use Auth;
use Redirect;

class BidController extends Controller
{
     /**
     * Opens the mybids page.
     */
    public function showMybids(){
        return view('bids.mybids',[
            'mybids' => Auth::user()->bids()->get(),
        ]);
    }

    /**
     * Adds the user's bid on an auction.
     */
    public function addBid(Request $data, $auction_id){
        if ($this->isAuctionForSale($auction_id)){
            $highestBid = $this->giveHighestBid($auction_id);
            $validator = Validator::make($data->all(), [
                'bid' => 'required|numeric|min:0'
            ]);
            if ($validator->passes()) {
                if($highestBid){
                    if($data->bid > $highestBid->bidPrice){
                        $bid = new Bid;
                        $bid->user_id = Auth::id();
                        $bid->auction_id = $auction_id;
                        $bid->bidPrice = $data->bid;
                        $bid->save();
                        return Redirect::back()->with('bidStatus', ['success','Your bid of '.$data->bid.' euro has been succesfully placed.']);
                    }else{
                        return Redirect::back()->with('bidStatus', ['failed','You have to bid higher than '.$highestBid->bidPrice.' euro (the highest bidder).']);
                    }
                }

                $bid = new Bid;
                $bid->user_id = Auth::id();
                $bid->auction_id = $auction_id;
                $bid->bidPrice = $data->bid;
                $bid->save();
                return Redirect::back()->with('bidStatus', ['success','Your bid of '.$data->bid.' euro has been succesfully placed.']);
            }
            return Redirect::back()->withErrors($validator);
        }
        return redirect('/');
    }

    public function giveHighestBid($auction_id){
        return Auction::find($auction_id)->bids()->orderBy('bidPrice', 'desc')->take(1)->first();
    }

    public function isAuctionForSale($auction_id){
        $auction = Auction::find($auction_id)->first();
        if($auction->status == "active")
        {
            return True;
        }
        return FALSE;
    }
}
