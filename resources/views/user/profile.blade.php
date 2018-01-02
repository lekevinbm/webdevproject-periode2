@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <p>{{ Auth::user()->name }}</p> <a href="/user/edit">edit</a>
       <p>{{ Auth::user()->email }}</p>
       <p>{{ Auth::user()->phoneNumber }}</p>
       <p>{{ Auth::user()->streetAndNumber }}</p>
       <p>{{ Auth::user()->zipcode }}, {{ Auth::user()->city }}</p>
       <p>VAT-number: {{ Auth::user()->VAT_number }}</p>
       <p>Account number: {{ Auth::user()->accountNumber }}</p>
    </div>
</div>
@endsection