<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Chatty</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#chatty-navigation" aria-controls="chatty-navigation" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="chatty-navigation">
      @if (Auth::check())
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Timeline</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Friends</a>
        </li>
      </ul>
      <form class="form-inline mr-auto my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      @endif

      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('auth.signin') }}">{{Auth::user()->getFirstNameOrUsername()}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('auth.signin') }}">Update Profile </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('auth.signout') }}">Sign out </a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('auth.signin') }}">SignIn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('auth.signup') }}">SignUp</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>