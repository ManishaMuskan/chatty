@extends('templates.default')

@section('content')
<div class="container">
  @if (!$users->count())
    <h4>No results found for "{{ Request::input('query') }}"</h4>
  @else
    <h4>your search results for "{{ Request::input('query') }}" ...</h4>
    @foreach ($users as $user)
      @include('templates.partials.user')
    @endforeach
  @endif
</div>
@endsection
