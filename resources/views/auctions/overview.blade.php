@extends('layouts.app')

@section('content')
<div class="container">
    <div id="sortBy" class="container">
        <p>
            Sort by:            
            <a href="/auctions/sortby/ending-soonest">
                @if (session('sortby') == 'endingsoonest')
                    <b>ending soonest</b>
                @else
                    ending soonest
                @endif
            </a> | 
            <a href="/auctions/sortby/ending-latest">
                @if (session('sortby') == 'endinglatest')
                    <b>ending latest</b>
                @else
                    ending latest
                @endif
            </a> | 
            <a href="/auctions/sortby/newest">
                @if (session('sortby') == 'newest')
                    <b>new auctions</b>
                @else
                    new auctions
                @endif
            </a> <!--| 
            <a href="/auctions/sortby/popularity">popular auctions</a>-->
        </p>
    </div>
    <div id="filter" class="container">
        <div class="col-md-3">
            <div id="priceFilter">
                <p>Price</p>
                <p>
                    <a href="/auctions/filter/price-between-0-and-5000">Up to 5.000</a>
                    @if (session('filter.price.between.0-5000'))
                        <a href="/auctions/deleteFilter/price-between-0-and-5000">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/price-between-5000-and-10000">5.000-10.000</a>
                    @if (session('filter.price.between.5000-10000'))
                        <a href="/auctions/deleteFilter/price-between-5000-and-10000">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/price-between-10000-and-25000">10.000-25.000</a>
                    @if (session('filter.price.between.10000-25000'))
                        <a href="/auctions/deleteFilter/price-between-10000-and-25000">delete filter</a>
                    @endif</p>
                <p><a href="/auctions/filter/price-between-25000-and-50000">25.000-50.000</a>
                    @if (session('filter.price.between.25000-50000'))
                        <a href="/auctions/deleteFilter/price-between-25000-and-50000">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/price-between-50000-and-100000">50.000-100.000</a>
                    @if (session('filter.price.between.50000-100000'))
                        <a href="/auctions/deleteFilter/price-between-50000-and-100000">delete filter</a>
                    @endif
                </p
                <p><a href="/auctions/filter/price-above">Above</a>
                    @if (session('filter.price.above'))
                        <a href="/auctions/deleteFilter/price-above">delete filter</a>
                    @endif
                </p>
            </div>
            <div id="endingFilter">
                <p>Ending</p>
                <p><a href="/auctions/filter/ending-thisweek">Ending this week</a>
                    @if (session('filter.ending.thisweek'))
                        <a href="/auctions/deleteFilter/ending-thisweek">delete filter</a>
                    @endif</p>
                <p><a href="/auctions/filter/ending-purchasenow">Purchase now</a>
                    @if (session('filter.ending.purchasenow'))
                        <a href="/auctions/deleteFilter/ending-purchasenow">delete filter</a>
                    @endif</p>
            </div>            
        </div>
        <div class="col-md-3">
            <div id="eraFilter">
                <p>Era</p>
                <p>
                    <a href="/auctions/filter/prewar">Pre-War</a>
                    @if (session('filter.prewar'))
                        <a href="/auctions/deleteFilter/prewar">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/yearbetween-1940-1960">1940s-1950s</a>
                    @if (session('filter.yearbetween.1940-1960'))
                        <a href="/auctions/deleteFilter/yearbetween-1940-1960">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/yearbetween-1960-1990">1960s-1980s</a>
                    @if (session('filter.yearbetween.1960-1990'))
                        <a href="/auctions/deleteFilter/yearbetween-1960-1990">delete filter</a>
                    @endif</p>
                <p><a href="/auctions/filter/yearabove">1990s-present</a>
                    @if (session('filter.yearabove'))
                        <a href="/auctions/deleteFilter/yearabove">delete filter</a>
                    @endif
                </p>
            </div>
                    
        </div>
        <div class="col-md-3">
            <div id="styleFilter">
                <p>Style</p>
                <p>
                    <a href="/auctions/filter/style-Abstract">Abstract</a>
                    @if (session('filter.style.Abstract'))
                        <a href="/auctions/deleteFilter/style-Abstract">delete filter</a>                    
                    @endif
                </p>
                <p><a href="/auctions/filter/style-African_American">African American</a>
                    @if (session('filter.style.African_American'))
                        <a href="/auctions/deleteFilter/style-African_American">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Asian_Contemporary">Asian Contemporary</a>
                    @if (session('filter.style.Asian_Contemporary'))
                        <a href="/auctions/deleteFilter/style-Asian_Contemporary">delete filter</a>
                    @endif</p>
                <p><a href="/auctions/filter/style-Conceptual">Conceptual</a>
                    @if (session('filter.style.Conceptual'))
                        <a href="/auctions/deleteFilter/style-Conceptual">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Contemporary">Contemporary</a>
                    @if (session('filter.style.Contemporary'))
                        <a href="/auctions/deleteFilter/style-Contemporary">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Emerging_Artists">Emerging Artists</a>
                    @if (session('filter.style.Emerging_Artists'))
                        <a href="/auctions/deleteFilter/style-Emerging_Artists">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Figurative">Figurative</a>
                    @if (session('filter.style.Figurative'))
                        <a href="/auctions/deleteFilter/style-Figurative">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Middle_Eastern_Contemporary">Middle Easter Contemporary</a>
                    @if (session('filter.style.Middle_Eastern_Contemporary'))
                        <a href="/auctions/deleteFilter/style-Middle_Eastern_Contemporary">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Minimalism">Minimalism</a>
                    @if (session('filter.style.Minimalism'))
                        <a href="/auctions/deleteFilter/style-Minimalism">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Modern">Modern</a>
                    @if (session('filter.style.Modern'))
                        <a href="/auctions/deleteFilter/style-Modern">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Pop">Pop</a>
                    @if (session('filter.style.Pop'))
                        <a href="/auctions/deleteFilter/style-Pop">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Urban">Urban</a>
                    @if (session('filter.style.Urban'))
                        <a href="/auctions/deleteFilter/style-Urban">delete filter</a>
                    @endif
                </p>
                <p><a href="/auctions/filter/style-Vintage_Photographs">Vintage Photographs</a>
                    @if (session('filter.style.Vintage_Photographs'))
                        <a href="/auctions/deleteFilter/style-Vintage_Photographs">delete filter</a>
                    @endif
                </p>
            </div>
                    
        </div>
        <div class="col-md-3">
            @if(session('filter'))
                <a class="btn btn-primary" href="/auctions/deleteAllFilters" >Remove all filters</a>
            @endif
        </div>
                
    </div>
    @foreach ($auctions as $key => $auction)                   
        {{ csrf_field() }}
        <div class="col-md-3">                           
            <div class="row">
                <a href="/auctions/open/{{ $auction->auction_id }}"><img style="width:100px" src="{{ $auction->photos()->where('type', 'Artwork Image')->first()['path'] }}"></a>
            </div>
            <div class="row">
                <p>{{ $auction->year }}, {{ $auction->artist }}</p>
                <p>{{ $auction->title }}</p>
                <p>&euro; {{ $auction->minEstimatePrice }}</p>
                <p> {{ date('j\d G\u i\m',strtotime($auction->endDateTime) - strtotime(Carbon::now())) }} </p>
                <a class="btn btn-primary" href="/auctions/open/{{$auction->auction_id}}" >Visit Auction</a>
            </div>
        </div>
    @endforeach
</div>
@endsection