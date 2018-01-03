<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Auction;
use App\Photo;
use Validator;
use Auth;
use Redirect;

class AuctionController extends Controller
{
    /**
     * Open My auction the page.
     */
    public function openMyAuctionsPage(){
        
        return view('auctions.myauctions',[
            'myauctions' => Auth::user()->auctions()->get(),
        ]);
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
            'depth' => 'nullable|numeric|min:0',
            'endDateTime' => 'required|date',
            'minEstimatePrice' => 'required|numeric|min:0',
            'maxEstimatePrice' => 'required|numeric|min:0',
            'artworkImage' => 'required|image',
            'signatureImage' => 'required|image',
            'optionalImage' => 'nullable|image',
        ]);

        if ($validator->passes()) { 
            $auction = new Auction;
            $auction->title = $data['title'];            
            $auction->year = $data['year'];
            $auction->artist = $data['artist'];
            $auction->style = $data['style'];
            $auction->description = $data['description'];
            $auction->condition = $data['condition'];
            $auction->origin = $data['origin'];
            $auction->width = $data['width'];
            $auction->height = $data['height'];
            $auction->depth = $data['depth'];
            $auction->endDateTime = $data['endDateTime'];
            $auction->minEstimatePrice = $data['minEstimatePrice'];
            $auction->maxEstimatePrice = $data['maxEstimatePrice'];
            $auction->status = 'active';
            $auction->owner_id = Auth::id();
            $auction->save();

            $auction_id = $auction->auction_id;

            //Artwork Image
            $artworkImage = $data->artworkImage;
            $type = 'Artwork Image';
            $this->saveAuctionImage($artworkImage, $auction_id, $type, $data);

            //Signature Image
            $signatureImage = $data->signatureImage;
            $type = 'Signature Image';
            $this->saveAuctionImage($signatureImage, $auction_id, $type, $data);

            $optionalImage = $data->optionalImage;            
            if($optionalImage){
                $type = 'Optional Image';
                $this->saveAuctionImage($optionalImage, $auction_id, $type, $data);
            }
            return redirect('/auctions/myauctions');
        }
        return Redirect::back()->withErrors($validator);
    }

    public function saveAuctionImage($image,$auction_id, $type, $data){
        $photo = new Photo;
        $img = Image::make($image);
        $img = $img->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $extension = pathinfo(storage_path().$image->getClientOriginalName(), PATHINFO_EXTENSION);
        $img = $img->stream();               
        $filename = 'public/auctions/' . $auction_id . '/'.str_replace(' ', '', $type).'.'.$extension;
        Storage::disk('local')->put($filename, $img);
        $photo->path = Storage::url($filename);
        $photo->type = $type;
        if($type == 'Signature Image'){
            $photo->title = $type.' of '.$data['title'].' from '.$data['artist'];
        }else{
            $photo->title = 'Image of '.$data['title'].' from '.$data['artist'];
        }
            
        $photo->auction_id = $auction_id;
        $photo->save();
    }

     /**
     * Add a new auction.
     */
    public function openAuction($auction_id){
        return view('auctions.openAuction', [ 'auction' => Auction::find($auction_id) ]);

    }
}
