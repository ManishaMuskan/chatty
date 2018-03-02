@extends('templates.default')

@section('title')
  chatty : a social app
@endsection

@section('content')
  <div class="container my-2">
    @if(!$profile_user->friends()->count())
        <h6>{{ ($profile_user->getName() == Auth::User()->getName() ? 'You have' : $profile_user->getName().' has' ) }} no friends!!</h6>
    @else
      <div class="row my-3">
        @foreach ($profile_user->friends() as $user)
          <div class="col-md-6">

            <div class="float-left">
              @include('templates.partials.user')
            </div>

            <div class="float-right">
              {{-- --------------------------------- Respective Buttons (Add Friend, Accept friend or Unfriend) --------------------------------- --}}
                @if ($user->id != Auth::User()->id)
                    @if (Auth::User()->ifsentRequestPending($user))
                      <p class="text-warning text-muted font-weight-light"><small>your request not accepted yet!</small></p>

                    @elseif(Auth::User()->ifReceivedRequestPending($user))
                      <a class="btn btn-sm btn-primary d-inline" href="{{ route('friend.accept', ['username' => $user -> username]) }}">Accept as Friend</a>
                      <a class="btn btn-sm btn-primary d-inline" href="{{ route('friend.ignore', ['username' => $user -> username]) }}">Ignore Request</a>

                    @elseif(Auth::User()->ifIsFriendWith($user))
                      <div class="dropdown d-inline">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Friend
                        </button>
                        <div class="dropdown-menu py-0 px-1" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="{{ route('friend.delete', ['username' => $user -> username]) }}">Unfriend</a>
                        </div>
                      </div>

                    @else
                      <a class="btn btn-sm btn-primary d-inline" href="{{ route('friend.add', ['username' => $user -> username]) }}">Add friend</a>
                    @endif
                  @endif

            </div>
          </div>
        @endforeach

      </div>
    @endif
  </div>
@endsection
