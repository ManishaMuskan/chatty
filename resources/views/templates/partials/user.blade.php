<div class="media">
  <div class="media-left">
    <img src="{{ $user->gravatar }}" class="media-object">
  </div>
  <div class="media-body">
    <h5 class="media-heading">{{ $user->getNameOrUsername() }}</h5>
    <p>{{ $user->location ?: 'Location not known' }}</p>
  </div>
</div>
