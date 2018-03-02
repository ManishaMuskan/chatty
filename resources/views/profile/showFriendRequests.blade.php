@extends('templates.default')

@section('title')
  chatty : a social app
@endsection

@section('content')
  <div class="container my-2">
    <h4>Your friend Requests</h4>
    <hr>
    @if(!$requests->count())
        <h6>You have no friend requests...</h6>
    @else
      <div class="row my-3">
        @foreach ($requests as $user)
          <div class="col-md-6">
            <div class="float-left">
              @include('templates.partials.user')
            </div>
            <div class="float-right">
              <a class="btn btn-sm btn-primary d-inline" href="{{ route('friend.accept', ['username' => $user -> username]) }}">Accept</a>
              <a class="btn btn-sm btn-outline-primary d-inline" href="{{ route('friend.ignore', ['username' => $user -> username]) }}">Ignore</a>
          </div>
            <div class="float-none"></div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
