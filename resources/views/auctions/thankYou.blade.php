@extends('layouts.app')
@section('pagetitle')
    <title>Thank You for buying | Landoretti Art</title>
@endsection
@section('content')
<div class="">
    <div id="header2">
        <img src="{{ asset('storage/header2.jpg') }}" alt="Picture by Landoretti">    
    </div>
    <div class="row profile">
        <h2>Thank You for buying</h2>
        <h4>Your order:</h4>            
        <div class="col-md-4">
            <img src="{{ $auction->photos->where('type', 'Artwork Image')->first()->path }}" alt="{{ $auction->photos()->where('type', 'Artwork Image')->first()['title'] }}">
        </div>
        <div class="col-md-3">
            <p>{{ $auction->title }}</p>
        </div>
        <div class="col-md-3">
            <p>&euro; {{ $auction->buyOutPrice }}</p>
        </div>        
    </div>
</div>
@endsection