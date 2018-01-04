<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\WatchItem;
use Validator;
use Auth;
use Redirect;

class WatchlistController extends Controller
{
     /**
     * Opens the watchlistPage.
     */
    public function showWatchlist(){
        return view('auctions.watchlist',[
            'watchItems' => Auth::user()->watchItems()->get(),
        ]);
    }

    /**
     * Adds the auction on the watchlist.
     */
    public function addToWatchlist($auction_id){
        if(!$this->isWatchItemInWatchList($auction_id)){
            $watchItem = new WatchItem;
            $watchItem->user_id = Auth::id();
            $watchItem->auction_id = $auction_id;
            $watchItem->save();

            return Redirect::back();
        }
        return redirect('/');
    }

    /**
     * Removes the auction from the watchlist.
     */
    public function removeFromWatchlist($auction_id){
        if($this->isWatchItemInWatchList($auction_id)){
            $watchItem = WatchItem::where('auction_id',$auction_id)->where('user_id',Auth::id());
            $watchItem->delete();

            return Redirect::back();
        }
        return redirect('/');

        
    }

    /**
     * Checks if the the auction is alreadt in WatchList, to prevent double watchitems.
     */
    public function isWatchItemInWatchList($auction_id){
        $watchItem = WatchItem::where('auction_id',$auction_id)->where('user_id',Auth::id())->first();
        if ($watchItem){
            return True;
        }
        return False;
    }

    /**
     * Clears a user's watchlist.
     */
    public function clearWatchList(){
        Auth::user()->watchItems()->delete();
        return Redirect::back();
    }

    /**
     * Remove selected auctions from watchlist.
     */
    public function removeSelectedFromWatchlist(Request $data){
        $validator = Validator::make($data->all(), [
            'auctionsToDelete.*' => 'required|numeric'
        ]);
        if ($validator->passes()) {
            foreach($data->auctionsToDelete as $key => $auction_id){
                if($this->isWatchItemInWatchList($auction_id)){
                    $watchItem = WatchItem::where('auction_id',$auction_id)->where('user_id',Auth::id());
                    $watchItem->delete();  
                }                
            }
        }
        return Redirect::back();
    }
}
