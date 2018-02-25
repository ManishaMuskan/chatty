@extends('templates.default')

@section('content')
<div class="container my-5">
  <form role="form" method="post" action="{{ route('profile.edit', ['username' => Auth::User()->username]) }}">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="first_name">First Name</label>
        <input type="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" name='first_name' id="first_name" placeholder="Your first name" value="{{ Request::old('first_name') ?: Auth::User()->first_name }}">
        <div class="invalid-feedback">
          {{ $errors -> first('first_name')}}
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="last_name">Last Name</label>
        <input type="last_name" class="form-control" name='last_name' id="last_name" placeholder="Your last Name" value="{{ Request::old('last_name') ?: Auth::User()->last_name }}">
        <div class="invalid-feedback">
          {{ $errors -> first('last_name')}}
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="username">Username</label>
        <input type="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name='username' id="username" placeholder="Your Username" value="{{ Request::old('username') ?: Auth::User()->username }}">
        <div class="invalid-feedback">
          {{ $errors -> first('username')}}
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="location">Location</label>
        <input type="location" class="form-control" name='location' id="location" placeholder="Your Location" value="{{ Request::old('location') ?: Auth::User()->location }}">
        <div class="invalid-feedback">
          {{ $errors -> first('location')}}
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {{-- <input type="hidden" name="_token" value="{{ Session::Token() }}"> --}}
  </form>
</div>
@endsection
