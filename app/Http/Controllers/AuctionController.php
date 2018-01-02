<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
