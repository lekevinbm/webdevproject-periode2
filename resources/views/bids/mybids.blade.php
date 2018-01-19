@extends('layouts.app')
@section('pagetitle')
    <title>My bids | Landoretti Art</title>
@endsection
@section('content')
<div class="">
    <div id="header2">
        <img src="{{ asset('storage/header2.jpg') }}" alt="Picture by Landoretti">    
    </div>
    <div id="mybids" class="row">
        <h2>My Bids</h2>
        @if($mybids->count() == 0)
        <p>You didnt make any bids yet.</p>
        @else
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Auction details</th>
                            <th>Bid price</th>
                        </tr>
                    </thead>
                    <tbody>        
                        @foreach ($mybids as $key => $bid)
                            <tr>
                                <td><a href="/auctions/open/{{ $bid->auction->auction_id }}"><img src="{{ $bid->auction->photos()->where('type', 'Artwork Image')->first()['path'] }}" alt="{{ $bid->auction->photos()->where('type', 'Artwork Image')->first()['title'] }}"></a></td>
                                <td><p>{{ $bid->auction->title }}</p><p>{{ $bid->auction->year }}, {{ $bid->auction->artist }}</p></td>
                                <td>&euro; {{ $bid->bidPrice }}</td>       
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection