@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Topics</h3>
    <div class="alert alert-info">
      pussy
    </div>
    @if (Route::has('login'))
      @auth
        <a href="{{ route('topic') }}">Add topic</a>
      @endauth
    @endif
</div>
@endsection
  