@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>My Auctions</h2>
        <a class="btn btn-primary" href="/auctions/new" >ADD NEW AUCTION</a>
        <div class="row">
            @foreach ($myauctions as $key => $auction)
                <div>
                    {{ $auction->title }}
                    <img src="{{ $auction->photos()->where('type', 'Artwork Image')->first()['path'] }}">
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection