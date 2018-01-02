@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Auction</div>

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
                    <form class="form-horizontal" method="POST" action="/auctions/add">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('style') ? ' has-error' : '' }}">
                            <label for="style" class="col-md-4 control-label">Style</label>

                            <div class="col-md-6">
                                <select id="style" class="form-control" name="style" required autofocus>
                                    <option>Choose a style</option>
                                    <option value="Abstract">Abstract</option>
                                    <option value="African American">African American</option>
                                    <option value="Asian Contemporary">Asian Contemporary</option>
                                    <option value="Conceptual">Conceptual</option>
                                    <option value="Conteporary">Conteporary</option>
                                    <option value="Emerging Artist">Emerging Artist</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Auction Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" placeholder="Auction title" value="{{ old('title') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('artist') ? ' has-error' : '' }}">
                            <label for="artist" class="col-md-4 control-label">Artist</label>

                            <div class="col-md-6">
                                <input id="artist" type="text" class="form-control" name="artist" value="{{ old('artist') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('width') ? ' has-error' : '' }}">
                            <label for="width" class="col-md-4 control-label">Width</label>

                            <div class="col-md-6">
                                <input id="width" type="number" sterp="0.01" min="0" class="form-control" name="width" value="{{ old('width') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                            <label for="height" class="col-md-4 control-label">Height</label>

                            <div class="col-md-6">
                                <input id="height" type="number" step="0.01" min="0" class="form-control" name="height" value="{{ old('height') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('depth') ? ' has-error' : '' }}">
                            <label for="depth" class="col-md-4 control-label">Depth (optional)</label>

                            <div class="col-md-6">
                                <input id="depth" type="number" step="0.01" min="0" class="form-control" name="depth" value="{{ old('depth') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                            <label for="year" class="col-md-4 control-label">Year</label>

                            <div class="col-md-6">
                                <input id="year" type="text" class="form-control" name="year" value="{{ old('year') }}" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" placeholder="Describe your auction as through as possible."  value="{{ old('description') }}" required autofocus></textarea>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('condition') ? ' has-error' : '' }}">
                            <label for="condition" class="col-md-4 control-label">Condition</label>

                            <div class="col-md-6">
                                <textarea id="condition" type="text" class="form-control" name="condition" placeholder="What is the condition of the artwork?"  value="{{ old('condition') }}" required autofocus></textarea>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('origin') ? ' has-error' : '' }}">
                            <label for="origin" class="col-md-4 control-label">Origin</label>

                            <div class="col-md-6">
                                <textarea id="origin" type="text" class="form-control" name="origin" placeholder="What is the origin of the artwork?"  value="{{ old('origin') }}" required autofocus></textarea>
                            </div>
                        </div>
              
                        <div class="form-group{{ $errors->has('artworkImage') ? ' has-error' : '' }}">
                            <label for="artworkImage" class="col-md-4 control-label">Artwork image</label>

                            <div class="col-md-6">
                                <input id="artworkImage" type="file" class="form-control" name="artworkImage" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('signatureImage') ? ' has-error' : '' }}">
                            <label for="signatureImage" class="col-md-4 control-label">Signature image</label>

                            <div class="col-md-6">
                                <input id="signatureImage" type="file" class="form-control" name="signatureImage" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('optionalImage') ? ' has-error' : '' }}">
                            <label for="optionalImage" class="col-md-4 control-label">Optional image</label>

                            <div class="col-md-6">
                                <input id="optionalImage" type="file" class="form-control" name="optionalImage" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('endDateTime') ? ' has-error' : '' }}">
                            <label for="endDateTime" class="col-md-4 control-label">End of bidding</label>

                            <div class="col-md-6">
                                <input id="endDateTime" type="datetime-local" class="form-control" name="endDateTime" value="{{ old('endDateTime') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('minEstimatePrice') ? ' has-error' : '' }}">
                            <label for="minEstimatePrice" class="col-md-4 control-label">Minimum estimateprice </label>

                            <div class="col-md-6">
                                <input id="minEstimatePrice" type="number" step="0.01" min="0" class="form-control" name="minEstimatePrice" value="{{ old('minEstimatePrice') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('maxEstimatePrice') ? ' has-error' : '' }}">
                            <label for="maxEstimatePrice" class="col-md-4 control-label">Maximum estimateprice</label>

                            <div class="col-md-6">
                                <input id="maxEstimatePrice" type="number" step="0.01" min="0" class="form-control" name="maxEstimatePrice" value="{{ old('maxEstimatePrice') }}" required autofocus>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
