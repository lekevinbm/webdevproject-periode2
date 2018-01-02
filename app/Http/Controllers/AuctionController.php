<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Redirect;

class AuctionController extends Controller
{
    /**
     * Open My auction the page.
     */
    public function openMyAuctionsPage(){
        return view('auctions.myauctions');
    }

     /**
     * Open new auction form.
     */
    public function newAuction(){
        return view('auctions.newAuction');
    }

     /**
     * Add a new auction.
     */
    public function addAuction(Request $data){

        $validator = Validator::make($data->all(), [
            'title' => 'required|string|max:255',
            'year' => 'string|max:255',
            'artist' => 'required|string|max:255',
            'style' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'condition' => 'required|string|max:500',
            'origin' => 'required|string|max:500',
            'width' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'depth' => 'numeric|min:0',
            'startDateTime' => 'required|date',
            'endDateTime' => 'required|date',
        ]);
        Redirect::back()->withErrors($validator);
    }
}
