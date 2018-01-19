@extends('layouts.app')
@section('pagetitle')
    <title>Edit my Profile | Landoretti Art</title>
@endsection
@section('content')
<div class="">
    <div id="header2">
        <img src="{{ asset('storage/header2.jpg') }}" alt="Picture by Landoretti">    
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profile</div>

                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="/user/edit">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('streetAndNumber') ? ' has-error' : '' }}">
                            <label for="streetAndNumber" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="streetAndNumber" type="text" class="form-control" name="streetAndNumber" value="{{ Auth::user()->streetAndNumber }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                            <label for="zipcode" class="col-md-4 control-label">Zip Code</label>

                            <div class="col-md-6">
                                <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ Auth::user()->zipcode }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ Auth::user()->city }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country" value="{{ Auth::user()->country }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phoneNumber') ? ' has-error' : '' }}">
                            <label for="phoneNumber" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" value="{{ Auth::user()->phoneNumber }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('VAT_number') ? ' has-error' : '' }}">
                            <label for="VAT_number" class="col-md-4 control-label">VAT-number</label>

                            <div class="col-md-6">
                                <input id="VAT_number" type="text" class="form-control" name="VAT_number" value="{{ Auth::user()->VAT_number }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('accountNumber') ? ' has-error' : '' }}">
                            <label for="accountNumber" class="col-md-4 control-label">Account number</label>

                            <div class="col-md-6">
                                <input id="accountNumber" type="text" class="form-control" name="accountNumber" value="{{ Auth::user()->accountNumber }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a class="btn btn-danger" href="/user/delete">Delete account</a>
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
