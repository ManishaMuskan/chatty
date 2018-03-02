@extends('templates.default')

@section('title')
  chatty : {{ Auth::User()->getName() }}'s Profile
@endsection

@section('content')
<div class="container-fluid">
  <div class="row my-1">
    <div class="col-md-9">
      {{-- -------------------------------- User's profile whose profile authenticated user wants to visit --------------------------------------- --}}
      @include('templates.partials.profile')
    </div>
    <div class="col-md-3 d-none d-md-block">
      {{-- -------------------------------- Authenticated user's friends list --------------------------------------- --}}
      <h4>Your Friends</h4>
      <hr>
      @if(!$user->friends()->count())
          <h6>You have no friends yet!!</h6>
      @else
        @foreach ($user->friends() as $user)
          @include('templates.partials.user')
        @endforeach
      @endif
    </div>
  </div>
</div>
@endsection
