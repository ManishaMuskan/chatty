<div class="media">
  <div class="media-left" >
    <a href="{{ route('profile.user', ['username' => $user->username]) }}">
      <img src="{{ $user->getGravatarImg(55) }}" class="media-object">
    </a>
  </div>
  <div class="media-body mx-1">
    <a href="{{ route('profile.user', ['username' => $user->username]) }}">
      <h5 class="media-heading">{{ ($user->getFirstNameOrUsername() === Auth::User()->getFirstNameOrUsername()) ? 'You' : $user->getFirstNameOrUsername() }}</h5>
    </a>
    <p>{{ $user->location ?: 'Location not known' }}</p>
  </div>
</div>
