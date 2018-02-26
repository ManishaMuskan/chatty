@extends('templates.default')

@section('title')
  chatty : a social app
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center">Not Found</h1>
    <hr>
    <h3 class="text-center text-warning">{{ $exception->getMessage() }}</h3>
  </div>
@endsection
