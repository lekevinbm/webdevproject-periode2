@extends('layouts.app')
@section('pagetitle')
    <title>Watchlist | Landoretti Art</title>
@endsection
@section('content')
<div class="">
    <div id="header2">
        <img src="{{ asset('storage/header2.jpg') }}" alt="Picture by Landoretti">    
    </div>
    <div id= "watchlist" class="row">
        <h2>Watchlist</h2>
        @if($watchItems->count() == 0)
            <p>You don't have auctions in the watchlist yet.</p>
        @else
            <input type="submit" form="activeWatchlistForm" class="btn btn-primary" href="/watchlist/clear" value="Delete Selected">
            <a class="btn btn-primary" href="/watchlist/clear" >Clear watchlist</a>
            <div class="row">
                <form id="activeWatchlistForm" class="form-horizontal" method="POST" action="/watchlist/remove">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Auction details</th>
                                <th>Estimated price</th>
                                <th>End date</th>
                                <th>Remaining time</th>
                            </tr>
                        </thead>
                        <tbody>        
                            @foreach ($watchItems as $key => $watchItem)
                                @if( $watchItem->auction->status == "active")                        
                                        {{ csrf_field() }}
                                        <tr>
                                            <td class="checkbox">
                                                <input type="checkbox" name="auctionsToDelete[]" value="{{$watchItem->auction->auction_id}}">
                                            </td>                            
                                            <td>
                                                <a href="/auctions/open/{{ $watchItem->auction->auction_id }}"><img src="{{ $watchItem->auction->photos()->where('type', 'Artwork Image')->first()['path'] }}" alt="{{ $watchItem->auction->photos()->where('type', 'Artwork Image')->first()['title'] }}"></a>
                                            </td>
                                            <td >
                                                <p>{{ $watchItem->auction->title }}</p><p>{{ $watchItem->auction->year }}, {{ $watchItem->auction->artist }}</p>
                                            </td>
                                            <td>
                                                <p>&euro; {{ $watchItem->auction->minEstimatePrice }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $watchItem->auction->endDateTime }}</p>
                                            </td>
                                            <td>{{ date('j\d G\u i\m',strtotime($watchItem->auction->endDateTime) - strtotime(Carbon::now())) }}</td>
                                        </tr>                                       
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </form> 
            </div>
        @endif
    </div>
</div>
@endsection