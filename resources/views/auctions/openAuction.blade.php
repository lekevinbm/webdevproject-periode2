@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>{{$auction->title}}</h2>
        <a class="btn btn-primary" href="/watchlist/add/{{$auction->auction_id}}" >Add to my watchlist</a>
        <div class="row">
            
        </div>
    </div>
</div>
@endsection