<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use Mail;
use Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function mail(){
        
        $auctions = Auction::all()->where('status','active');
        foreach($auctions as $auction){
            if ($auction->endDateTime < Carbon::now()){
                $bids = $auction->bids()->orderBy('bidPrice', 'desc')->get()->groupBy('user_id'); //We use groupBy so that people who hat multiple bids receive 1 mail

                foreach($bids as $key => $bidGroup){  
                    $highestBid = $bidGroup->first();
                    $user = $highestBid->user()->first();

                    if($key == 1){
                        //This will send the message to the highest bidder that they won
                        $content = "Congratulations, the bidding on the auction '".$auction->title."' has ended and we're delighted to inform you, that your bid of &euro;".$highestBid->bidPrice." was the highest.
                        You will get an email as soon as your item has been delivered at our office.";
                        $subject = "You are the highest bidder of the auction: ".$auction->title;
                    }else{
                        //This will send to all the others that they didn't get the item
                        $content = "The bidding on the auction '".$auction->title."' has ended and unfornutaly your bid of &euro;".$highestBid->bidPrice." was not enough.";
                        $subject = "Your bid on '".$auction->title."' was not enough.";
                    }

                    Mail::send('emails.send', ['name' => $user->name, 'content' => $content], function ($message) use($auction, $user, $subject)
                        {
                            $message->from('customerservice@landorettiart.com', 'Kevin Bavuidi - Head Of Customer Service');
                            $message->to($user->email);
                            $message->subject($subject);

                        });
                        
                }

                if(empty($bids->first())){
                    $auction->status = 'expired';
                }else{
                    $auction->status = 'sold';
                }
                $auction->save();
            }
        }
        
        
        
    }
}
