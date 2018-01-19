@extends('layouts.app')
@section('pagetitle')
    <title>My Profile | Landoretti Art</title>
@endsection
@section('content')
<div class="">
    <div id="header2">
        <img src="{{ asset('storage/header2.jpg') }}" alt="Picture by Landoretti">    
    </div>
    <div class="row profile">
        <h2>My Profile</h2>
       <h4>{{ Auth::user()->name }}</h4> <a href="/user/edit">edit</a>
       <p>{{ Auth::user()->email }}</p>
       <p>{{ Auth::user()->phoneNumber }}</p>
       <p>{{ Auth::user()->streetAndNumber }}</p>
       <p>{{ Auth::user()->zipcode }}, {{ Auth::user()->city }}</p>
       <p>VAT-number: {{ Auth::user()->VAT_number }}</p>
       <p>Account number: {{ Auth::user()->accountNumber }}</p>
    </div>
</div>
@endsection