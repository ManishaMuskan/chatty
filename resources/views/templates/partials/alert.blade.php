@if (Session::has('info'))
<div class="container mt-2">
  <div class="alert alert-info" role="alert">
    {{ Session::get('info') }}
  </div>
</div>
@endif @if (Session::has('error'))
<div class="container mt-2">
  <div class="alert alert-danger" role="alert">
    {{ Session::get('error') }}
  </div>
</div>
@endif @if (Session::has('warn'))
<div class="container mt-2">
  <div class="alert alert-warning" role="alert">
    {{ Session::get('warn') }}
  </div>
</div>
@endif