@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>My Auctions</h2>
        <a class="btn btn-primary" href="/auctions/new" >ADD NEW AUCTION</a>
        <div class="row">
            <h3>Active auctions</h3>
            @foreach ($myauctions as $key => $auction)
                @if( $auction->status == "active")
                    <div class="row">
                        <div class="col-md-5">
                            <a href="/auctions/open/{{ $auction->auction_id }}"><img src="{{ $auction->photos()->where('type', 'Artwork Image')->first()['path'] }}"></a>
                            
                        </div>
                        <div class="col-md-5">
                        {{ $auction->title }}
                        </div>
                    </div>                    
                @endif
            @endforeach
        </div>
        <div class="row">
            <h3>Expired auctions</h3>
            @foreach ($myauctions as $key => $auction)
                @if( $auction->status == "expired")
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ $auction->photos()->where('type', 'Artwork Image')->first()['path'] }}">
                        </div>
                        <div class="col-md-5">
                            {{ $auction->title }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            <h3>Sold auctions</h3>
            @foreach ($myauctions as $key => $auction)
                @if( $auction->status == "sold")
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ $auction->photos()->where('type', 'Artwork Image')->first()['path'] }}">
                        </div>
                        <div class="col-md-5">                        
                            {{ $auction->title }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection