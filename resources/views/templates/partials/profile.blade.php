{{-- ----------------------------------------- Profile pic and cover photo ------------------------------------------ --}}

<div class="fb-profile">
  <img align="left" class="fb-image-lg" src="/chatty/public/Images/user_cover.jpg" alt="Cover image"/>
  <img align="left" class="fb-image-profile thumbnail" src="{{ $profile_user->getGravatarImg(200) }}" alt="{{ strtoupper(substr($profile_user->first_name, 0, 1)) }}"/>
  <div class="float-left">
      <h2>{{ $profile_user->getNameOrUsername() }}</h2>
      <p>{{ $profile_user->location ?:'location not known' }}</p>
  </div>
</div>


{{-- ---------------------------------------------------- if user is not seeing his own profile ------------------------------------------------ --}}
@if ($profile_user != Auth::User())
  <div class="float-right">

      <a href="{{ route('user.friends', ['username' => $profile_user->username]) }}" class="btn btn-sm btn-outline-primary d-inline"> {{ $profile_user->getFirstNameOrUsername() }}'s Friends</a>

      {{-- -------------------------------------- Respective Buttons (Add Friend, Accept friend or Unfriend) -------------------------------------- --}}

      @if (Auth::User()->ifsentRequestPending($profile_user))
        <p class="text-muted font-weight-light"><small>your request not accepted yet!</small></p>

      @elseif(Auth::User()->ifReceivedRequestPending($profile_user))
        <a class="btn btn-sm btn-primary d-inline" href="{{ route('friend.accept', ['username' => $profile_user -> username]) }}">Accept as Friend</a>
        <a class="btn btn-sm btn-primary d-inline" href="{{ route('friend.ignore', ['username' => $profile_user -> username]) }}">Ignore Request</a>

      @elseif(Auth::User()->ifIsFriendWith($profile_user))
        <div class="dropdown d-inline">
          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Friend
          </button>
          <div class="dropdown-menu py-0 px-1" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('friend.delete', ['username' => $profile_user -> username]) }}">Unfriend</a>
          </div>
        </div>

      @else
        <a class="btn btn-sm btn-primary d-inline" href="{{ route('friend.add', ['username' => $profile_user -> username]) }}">Add friend</a>
      @endif

 </div>
@endif
<div class="clear"></div>
<p>hello</p>
