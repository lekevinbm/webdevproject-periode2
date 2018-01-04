@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Watchlist</h2>
        <a class="btn btn-primary" href="/watchlist/clear" >Clear watchlist</a>
        <div class="row">
            @foreach ($watchItems as $key => $watchItem)
                @if( $watchItem->auction->first()->status == "active")
                    <div class="row">
                        <div class="col-md-3">
                            <a href="/auctions/{{ $watchItem->auction->first()->auction_id }}"><img style="width:100px" src="{{ $watchItem->auction->first()->photos()->where('type', 'Artwork Image')->first()['path'] }}"></a>
                            
                        </div>
                        <div class="col-md-3">
                        {{ $watchItem->auction->first()->title }}
                        </div>
                    </div>                    
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection