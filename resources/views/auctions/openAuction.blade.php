@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>{{$auction->title}}</h2>
        @if( $auction->watchItems()->where('user_id', Auth::id())->first() )  
            {{ $auction->watchItems()->where('user_id', Auth::id())->first() }}
            <a class="btn btn-danger" href="/watchlist/remove/{{$auction->auction_id}}" >Remove from my watchlist</a>
        @else
            <a class="btn btn-primary" href="/watchlist/add/{{$auction->auction_id}}" >Add to my watchlist</a>
        @endif
        <div class="row">
            
        </div>
    </div>
</div>
@endsection