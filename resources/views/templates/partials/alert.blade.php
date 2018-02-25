@if (Session::has('info'))
<div class="container mt-2">
  <div class="alert alert-info alert-dismissible fade in show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {{ Session::get('info') }}
  </div>
</div>
@endif

@if (Session::has('error'))
<div class="container mt-2">
  <div class="alert alert-danger alert-dismissible fade in show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {{ Session::get('error') }}
  </div>
</div>
@endif

@if (Session::has('warn'))
<div class="container mt-2">
  <div class="alert alert-warning alert-dismissible fade in show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ Session::get('warn') }}
  </div>
</div>
@endif
