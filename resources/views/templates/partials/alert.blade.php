@if (Session::has('info'))
<div class="container mt-2">
  <div class="alert alert-info" role="alert">
    {{ Session::get('info') }}
  </div>
</div>
@endif