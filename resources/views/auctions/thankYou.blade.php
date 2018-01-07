@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Thank You for buying</h2>
    </div>
    <div class="row">
            <h4>Your order:</h4>            
            <div class="col-md-4">
                <img style="height:50%" src="{{ $auction->photos->where('type', 'Artwork Image')->first()->path }}">
            </div>
            <div class="col-md-8">
                <p>{{ $auction->title }}</p>
            </div>        
    </div>
</div>
@endsection