@extends('templates.default') @section('title') chatty : Sign In @endsection @section('content')

<form method="post" action="{{ route('auth.signin') }}" class="col-sm-12 col-lg-7 mx-auto my-5">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">
    <div class="invalid-feedback">
      {{ $errors -> first('email')}}
    </div>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
    <div class="invalid-feedback">
      {{ $errors -> first('password')}}
    </div>
  </div>

  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="remember" name="remember">
    <label class="form-check-label" for="remember">Remember me!</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <input type="hidden" name="_token" value="{{Session::token()}}">
</form>
@endsection