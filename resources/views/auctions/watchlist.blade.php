@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Watchlist</h2>
        <input type="submit" form="activeWatchlistForm" class="btn btn-primary" href="/watchlist/clear" value="Delete Selected">
        <a class="btn btn-primary" href="/watchlist/clear" >Clear watchlist</a>
        <div class="row">
            <form id="activeWatchlistForm" class="form-horizontal" method="POST" action="/watchlist/remove">
                @foreach ($watchItems as $key => $watchItem)
                    @if( $watchItem->auction->status == "active")                        
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-1">
                                    <input type="checkbox" name="auctionsToDelete[]" value="{{$watchItem->auction->auction_id}}">
                                </div>                            
                                <div class="col-md-3">
                                    <a href="/auctions/{{ $watchItem->auction->auction_id }}"><img style="width:100px" src="{{ $watchItem->auction->photos()->where('type', 'Artwork Image')->first()['path'] }}"></a>
                                </div>
                                <div class="col-md-3">
                                    {{ $watchItem->auction->title }}
                                </div>
                            </div>                                        
                    @endif
                @endforeach
            </form> 
        </div>
    </div>
</div>
@endsection