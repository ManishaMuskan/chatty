@extends('templates.default') @section('title') Chatty : Sign UP @endsection @section('content')
<form method="post" action="{{ route('auth.signup') }}" class="col-sm-12 col-lg-7 mx-auto my-5">

  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">
    <div class="invalid-feedback">
      {{ $errors -> first('email')}}
    </div>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="username">User Name</label>
    <input type="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : ''}}" name="username" id="username" placeholder="Enter username" value="{{ old('username') }}">
    <div class="invalid-feedback">
      {{ $errors -> first('username')}}
    </div>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
    <div class="invalid-feedback">
      {{ $errors -> first('password')}}
    </div>
  </div>
  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : ''}}" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}">
    <div class="invalid-feedback">
      {{ $errors -> first('first_name')}}
    </div>
  </div>
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : ''}}" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
    <div class="invalid-feedback">
      {{ $errors -> first('last_name')}}
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  <input type="hidden" name="_token" value="{{Session::token()}}">
</form>
@endsection