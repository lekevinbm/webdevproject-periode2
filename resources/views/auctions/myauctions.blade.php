@extends('layouts.app')
@section('pagetitle')
    <title>My Auctions | Landoretti Art</title>
@endsection
@section('content')
<div  class="">
    <div id="header2">
        <img src="{{ asset('storage/header2.jpg') }}" alt="Picture by Landoretti">    
    </div>
    <div id="myauctions" class="row">
        <h2>@lang('My Auctions')</h2>
        <a class="btn btn-primary" href="/auctions/new" >@lang('ADD NEW AUCTION')</a>
        <div class="row">
            <h3>@lang('Active auctions')</h3>
            @if($myauctions->where('status', 'active')->count() == 0)
                <p>You don't have any active auctions.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Auction details</th>
                            <th>Estimated price</th>
                            <th>End date</th>
                            <th>Remaining time</th>
                        </tr>
                    </thead>
                    <tbody>                
                        @foreach ($myauctions as $key => $auction)
                            @if( $auction->status == "active")                 
                                <tr>
                                    <td><a href="/auctions/open/{{ $auction->auction_id }}"><img src="{{ $auction->photos()->where('type', 'Artwork Image')->first()['path'] }}"></a></td>
                                    <td><p>{{ $auction->title }}</p><p>{{ $auction->year }}, {{ $auction->artist }}</p></td>
                                    <td>&euro; {{ $auction->minEstimatePrice }}</td>
                                    <td>{{ $auction->endDateTime }}</td>
                                    <td>{{ date('j\d G\u i\m',strtotime($auction->endDateTime) - strtotime(Carbon::now())) }}</td>                                
                                </tr>   
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="row">
            <h3>@lang('Expired auctions')</h3>
            @if($myauctions->where('status', 'expired')->count() == 0)
                <p>You don't have any expired auctions.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Auction details</th>
                            <th>Estimated price</th>
                            <th>End date</th>
                            <th>Remaining time</th>
                        </tr>
                    </thead>
                    <tbody>        
                        @foreach ($myauctions as $key => $auction)
                            @if( $auction->status == "expired")
                                <tr>
                                    <td><a href="/auctions/open/{{ $auction->auction_id }}"><img src="{{ $auction->photos()->where('type', 'Artwork Image')->first()['path'] }}" alt="{{ $auction->photos()->where('type', 'Artwork Image')->first()['title'] }}"></a></td>
                                    <td><p>{{ $auction->title }}</p><p>{{ $auction->year }}, {{ $auction->artist }}</p></td>
                                    <td>&euro; {{ $auction->minEstimatePrice }}</td>
                                    <td>{{ $auction->endDateTime }}</td>
                                    <td>x</td>                                
                                </tr> 
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="row">
            
            <h3>@lang('Sold auctions')</h3>
                @if($myauctions->where('status', 'sold')->count() == 0)
                    <p>You don't have any sold auctions.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Auction details</th>
                                <th>Estimated price</th>
                                <th>End date</th>
                                <th>Remaining time</th>
                            </tr>
                        </thead>
                        <tbody>       
                            @foreach ($myauctions as $key => $auction)
                                @if( $auction->status == "sold")
                                    <tr>
                                        <td><a href="/auctions/open/{{ $auction->auction_id }}"><img src="{{ $auction->photos()->where('type', 'Artwork Image')->first()['path'] }}"></a></td>
                                        <td><p>{{ $auction->title }}</p><p>{{ $auction->year }}, {{ $auction->artist }}</p></td>
                                        <td>&euro; {{ $auction->minEstimatePrice }}</td>
                                        <td>{{ $auction->endDateTime }}</td>
                                        <td>sold</td>                                
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
        </div>
    </div>
</div>
@endsection