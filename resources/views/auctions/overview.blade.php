@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <p>
            Sort by:
            <a href="/auctions/sortby/ending-soonest">ending soonest</a> | 
            <a href="/auctions/sortby/ending-latest">ending latest</a> | 
            <a href="/auctions/sortby/newest">new auctions</a> | 
            <a href="/auctions/sortby/popularity">popular auctions</a>
        </p>
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
                <p>{{ $auction->minEstimatePrice }}</p>
                <p> {{ date('j\d G\u i\m',strtotime($auction->endDateTime) - strtotime(Carbon::now())) }} </p>
                <a class="btn btn-primary" href="/auctions/open/{{$auction->auction_id}}" >Visit Auction</a>
            </div>
        </div>
    @endforeach
</div>
@endsection