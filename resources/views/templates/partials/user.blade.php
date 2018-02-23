<div class="media">
  <div class="media-left" >
    <a href="{{ route('profile.user', ['username' => $user->username]) }}">
      <img src="{{ $user->getGravatarImg(55) }}" class="media-object">
    </a>
  </div>
  <div class="media-body">
    <a href="{{ route('profile.user', ['username' => $user->username]) }}">
      <h5 class="media-heading">{{ $user->getNameOrUsername() }}</h5>
    </a>
    <p>{{ $user->location ?: 'Location not known' }}</p>
  </div>
</div>
