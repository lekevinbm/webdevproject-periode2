@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>{{$auction->title}}</h2>
    </div>
    <div class="row">
        <div class="col-md-8">
            <img style="height:50%" src="{{ $auction->photos->where('type', 'Artwork Image')->first()->path }}">
        </div>
        <div class="col-md-4">
            <a href="/auctions/buy/{{ $auction->auction_id }}">Buy now for !! euro</a>
            <p>bids: {{ $auction->bids->count() }}           
            </p>
            @if (session('bidStatus'))
                @if (session('bidStatus')[0] == 'success')
                <div class="alert alert-success">
                    {{ session('bidStatus')[1] }}
                </div>
                @else
                    <div class="alert alert-danger">
                        {{ session('bidStatus')[1] }}
                    </div>
                @endif
            @endif
            <div id="bidForm">
                <form class="form-horizontal" method="POST"action="/bids/add/{{$auction->auction_id}}">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <input id="bid" type="number" step="0.01" min="0" class="form-control" name="bid" placeholder="Enter a bid price" value="{{ old('bid') }}" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        BID NOW
                    </button>
                </form>
            </div>
            @if( $auction->watchItems()->where('user_id', Auth::id())->first() )
                <a class="btn btn-danger" href="/watchlist/remove/{{$auction->auction_id}}" >Remove from my watchlist</a>
            @else
                <a class="btn btn-primary" href="/watchlist/add/{{$auction->auction_id}}" >Add to my watchlist</a>
            @endif
            
        </div>
        
        
    </div>
</div>
@endsection