@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>My Bids</h2>
        <div class="row">
                @foreach ($mybids as $key => $bid)                   
                    {{ csrf_field() }}
                    <div class="row">                           
                        <div class="col-md-3">
                            <a href="/auctions/{{ $bid->auction->auction_id }}"><img style="width:100px" src="{{ $bid->auction->photos()->where('type', 'Artwork Image')->first()['path'] }}"></a>
                        </div>
                        <div class="col-md-3">
                            {{ $bid->auction->title }}
                        </div>                                
                        <div class="col-md-3">
                            {{ $bid->bidPrice }}
                        </div>
                    </div>
                @endforeach
            </form> 
        </div>
    </div>
</div>
@endsection