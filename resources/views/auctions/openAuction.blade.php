@extends('layouts.app')
@section('pagetitle')
    <title>{{$auction->title}} | Landoretti Art</title>
@endsection
@section('content')
<div class="">
    <div id="header2">
        <img src="{{ asset('storage/header2.jpg') }}" alt="Picture by Landoretti">    
    </div>
    <div id="openauction" class="row">
        <h2>{{$auction->title}}</h2>
        <div class="row">
            <div class="col-md-8">
                <img style="width:80%" src="{{ $auction->photos->where('type', 'Artwork Image')->first()->path }}" alt="{{ $auction->photos()->where('type', 'Artwork Image')->first()['title'] }}">
                <div class="row" style="margin-top:1%">
                    <div class="col-md-3">
                        <img style="height:120px; width:100%; object-fit: cover;" src="{{ $auction->photos->where('type', 'Signature Image')->first()->path }}" alt="{{ $auction->photos()->where('type', 'Signature Image')->first()['title'] }}">
                    </div>
                    <div class="col-md-3">
                        @if($auction->photos->where('type', 'Optional Image')->first())
                            <img style="height:120px; width:100%; object-fit: cover;" src="{{ $auction->photos->where('type', 'Optional Image')->first()->path }}" alt="{{ $auction->photos()->where('type', 'Optional Image')->first()['title'] }}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h3>{{$auction->title}}</h3>
                <p>{{$auction->year}}, {{$auction->artist}}</p>
                <p>{{ date('j\d G\u i\m',strtotime($auction->endDateTime) - strtotime(Carbon::now())) }} left</p>
                <p>{{$auction->endDateTime}}</p>
                <p>Estimated price: {{$auction->minEstimatePrice}} - {{$auction->maxEstimatePrice}}</p>
                <a href="/auctions/buy/{{ $auction->auction_id }}">Buy now for {{ $auction->buyOutPrice }} euro</a>
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
        <div class="row">
            <div class="col-md-8">
                <h4>Description</h4>
                <p>{{$auction->title}}</p>
                <h4>Condition</h4>
                <p>{{$auction->condition}}</p>
            </div>
            <div class="col-md-4">
                <h4>Dimension</h4>
                <p>{{$auction->width}} x {{$auction->height}} @if ($auction->depth) x {{$auction->depth}} @endif cm</p>

            </div>
        </div>        
    </div>    
</div>
@endsection