<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use Validator;
use Redirect;
use Carbon;
use DateInterval;

class FilterController extends Controller
{
    /**
     * Sorts the auctions by the options given.
     */
    public function sortAuctionBy(Request $request, $sortOption){
        $continueSortBy = false;

        if( $sortOption == "ending-soonest"){
            $request->session()->put('sortby','endingsoonest');
            $continueSortBy = true;
        }
        if($sortOption == "ending-latest"){
            $request->session()->put('sortby','endinglatest');
            $continueSortBy = true;
        }
        if($sortOption == "newest"){
            $request->session()->put('sortby','newest');
            $continueSortBy = true;
        }
        if($sortOption == "popularity"){
            $request->session()->put('sortby','popularity');
            $continueSortBy = true;
        }
        
        if($continueSortBy){
            return redirect('/auctions/filter/sorted');
        }
        return redirect('/auctions');        
    }

     /**
     * Sorts the auctions by the options given.
     */
    public function filterAuctions(Request $request, $filterOption){
        $continueFilter = false;
        $filterOption = explode("-",$filterOption);
        $index = 0;
        if(session('sortby') == 'endingsoonest'){
            $auctions = Auction::where('status','active')->orderBy('endDateTime', 'asc');
            $continueFilter  = true;
        }elseif(session('sortby') == 'endinglatest'){
            $auctions = Auction::where('status','active')->orderBy('endDateTime', 'desc');
            $continueFilter  = true;
        }elseif(session('sortby') == 'newest'){
            $auctions = Auction::where('status','active')->latest();
            $continueFilter  = true;
        }elseif(session('sortby') == 'popularity'){
            $auctions = Auction::leftJoin('bids', 'bids.auction_id', '=', 'auctions.auction_id')
                ->orderBy('bids_count','desc')
                ->selectRaw('auctions.*, count(bids.bid_id) as bids_count')
                ->groupBy('auctions.auction_id')
                ->having('auctions.status','active');
            $continueFilter  = true;
            $index++;
        }else{
            $auctions = new Auction;
            $auctions = $auctions->newQuery();
            $auctions->where('status','active');
            $continueFilter  = true;
        }

        if ($filterOption[0] == 'price'){            
            if ( $filterOption[1] == 'between' && is_numeric($filterOption[2]) && is_numeric($filterOption[4])){
                $request->session()->put('filter.price.between.'.$filterOption[2].'-'.$filterOption[4],true);
                if($index == 0){
                    $auctions->whereBetween('minEstimatePrice', [$filterOption[2], $filterOption[4]]);
                    $index++;
                }else{
                    $auctions->orWhereBetween('minEstimatePrice', [$filterOption[2], $filterOption[4]]);
                }
                $continueFilter  = true;                    
            }
        }

        if (session('filter.price.between')){                    
            foreach (session('filter.price.between') as $key => $sessionValue){
                $betweenValue = explode("-",$key);
                if($index == 0){
                    $auctions->whereBetween('minEstimatePrice', [$betweenValue[0], $betweenValue[1]]);
                    $index++;
                } else{
                    $auctions->orWhereBetween('minEstimatePrice', [$betweenValue[0], $betweenValue[1]]);
                }                        
                $continueFilter  = true;                                        
            }                    
        }   

        if( session('filter.price.above') || ($filterOption[0] == 'price' && $filterOption[1] == 'above')){
            $request->session()->put('filter.price.above',true);
            if($index == 0){
                $auctions->where('minEstimatePrice','>', 100000);
                $index++;
            }else{
                $auctions->orWhere('minEstimatePrice','>', 100000);
            }                
            $continueFilter  = true;
        }        

        if ( session('filter.ending.thisweek') || $filterOption[0] == 'ending' && $filterOption[1] == 'thisweek'){
            $request->session()->put('filter.ending.thisweek',true);
            if($index == 0){
                $auctions->whereBetween('endDateTime',[Carbon::now(),Carbon::now()->add(new DateInterval('P7D'))]);
                $index++;
            }else{
                $auctions->orWhereBetween('endDateTime',[Carbon::now(),Carbon::now()->add(new DateInterval('P7D'))]);
            }                
            $continueFilter  = true;
        }

        if ( session('filter.ending.purchasenow') || $filterOption[0] == 'ending' && $filterOption[1] == 'purchasenow'){
            $request->session()->put('filter.ending.purchasenow',true);
            if($index == 0){
                $auctions->whereNotNull('buyOutPrice');
                $index++;
            }else{
                $auctions->orWhereNotNull('buyOutPrice');
            }                
            $continueFilter  = true;
        }

        if ( session('filter.prewar') || $filterOption[0] == 'prewar'){
            $request->session()->put('filter.prewar',true);
            if($index == 0){
                $auctions->where('year','<',1940);
                $index++;
            }else{
                $auctions->orWhere('year','<',1940);
            }                
            $continueFilter  = true;
        }

        if ( $filterOption[0] == 'yearbetween' && is_numeric($filterOption[1]) && is_numeric($filterOption[2])){
            $request->session()->put('filter.yearbetween.'.$filterOption[1].'-'.$filterOption[2],true);
            if($index == 0){
                $auctions->whereBetween('year', [$filterOption[1], $filterOption[2]]);
                $index++;
            }else{
                $auctions->orWhereBetween('year', [$filterOption[1], $filterOption[2]]);
            }
            $continueFilter  = true;
        }
        if (session('filter.yearbetween')){                    
            foreach (session('filter.yearbetween') as $key => $sessionValue){
                $betweenValue = explode("-",$key);
                if($index == 0){
                    $auctions->whereBetween('year', [$betweenValue[0], $betweenValue[1]]);
                    $index++;
                } else{
                    $auctions->orWhereBetween('year', [$betweenValue[0], $betweenValue[1]]);
                }                                                                
            }
            $continueFilter  = true;                    
        }

        if ( session('filter.yearabove') || $filterOption[0] == 'yearabove'){
            $request->session()->put('filter.yearabove',true);
            if($index == 0){
                $auctions->where('year','>',1990);
                $index++;
            }else{
                $auctions->orWhere('year','>',1990);
            }                
            $continueFilter  = true;
        }

        if ( $filterOption[0] == 'style'){
            $request->session()->put('filter.style.'.$filterOption[1],true);
            $searchableStyle = str_replace('_',' ', $filterOption[1]);
            if($index == 0){
                $auctions->where('style', $searchableStyle);
                $index++;
            }else{
                $auctions->orwhere('style', $searchableStyle);
            }
            $continueFilter  = true;
        }

        if ( session('filter.style')){
            foreach (session('filter.style') as $key => $sessionValue){
                $searchableStyle = str_replace('_',' ', $key);
                if($index == 0){
                    $auctions->where('style', $searchableStyle);
                    $index++;
                } else{
                    $auctions->orwhere('style', $searchableStyle);
                }                                      
            }
            $continueFilter  = true; 
        }

        if ( $filterOption[0] == 'media'){
            $request->session()->put('filter.media.'.$filterOption[1],true);
            $searchableMedia = str_replace('_',' ', $filterOption[1]);
            if($index == 0){
                $auctions->where('media', $searchableMedia);
                $index++;
            }else{
                $auctions->orwhere('media', $searchableMedia);
            }
            $continueFilter  = true;
        }

        if ( session('filter.media')){
            foreach (session('filter.media') as $key => $sessionValue){
                $searchableMedia = str_replace('_',' ', $key);
                if($index == 0){
                    $auctions->where('media', $searchableMedia);
                    $index++;
                } else{
                    $auctions->orwhere('media', $searchableMedia);
                }                                      
            }
            $continueFilter  = true; 
        }

        if($continueFilter ){
            return view('auctions.overview',[
                'auctions' => $auctions->simplePaginate(15),
            ]);
        }
        return redirect('/auctions');         
        
    }

    public function deleteAFilter(Request $request, $filterToDelete){
        $filterOption = explode("-",$filterToDelete);
        if ($filterOption[0] == 'price'){            
            if ( $filterOption[1] == 'between' && is_numeric($filterOption[2]) && is_numeric($filterOption[4])){
                $request->session()->forget('filter.price.between.'.$filterOption[2].'-'.$filterOption[4]);                   
            }
        }

        if( $filterOption[0] == 'price' && $filterOption[1] == 'above'){
            $request->session()->forget('filter.price.above');
        }

        if ( $filterOption[0] == 'ending' && $filterOption[1] == 'thisweek'){
            $request->session()->forget('filter.ending.thisweek');
        }

        if ($filterOption[0] == 'ending' && $filterOption[1] == 'purchasenow'){
            $request->session()->forget('filter.ending.purchasenow');
        }

        if ( $filterOption[0] == 'prewar'){
            $request->session()->forget('filter.prewar');
        }

        if ( $filterOption[0] == 'yearbetween' && is_numeric($filterOption[1]) && is_numeric($filterOption[2])){
            $request->session()->forget('filter.yearbetween.'.$filterOption[1].'-'.$filterOption[2]);
        }

        if ( $filterOption[0] == 'yearabove'){
            $request->session()->forget('filter.yearabove');
        }

        if ( $filterOption[0] == 'style'){
            $request->session()->forget('filter.style.'.$filterOption[1]);
        }

        if ( $filterOption[0] == 'media'){
            $request->session()->forget('filter.media.'.$filterOption[1]);
        }
        
        if(!session('filter.price.between')){
            $request->session()->forget('filter.price.between');
        }
        if(!session('filter.price')){
            $request->session()->forget('filter.price');
        }

        if(!session('filter.ending')){
                $request->session()->forget('filter.ending');
        }

        if(!session('filter.yearbetween')){
            $request->session()->forget('filter.yearbetween');
        }

        if(!session('filter.style')){
            $request->session()->forget('filter.style');
        }

        if(!session('filter.media')){
            $request->session()->forget('filter.media');
        }

        if(!session('filter')){
            $request->session()->forget('filter');
        }

        return redirect('/auctions/filter/sorted');

    }

    public function deleteAllFilters(Request $request){
        $request->session()->forget('filter');
        return redirect('/auctions/filter/sorted');
    }
}
