@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Topics</h3>
    @foreach($data as $element)
    <div class="alert alert-info">
        <p>{{ $element->topic }}</p>
    </div>
    @endforeach
    @if (Route::has('login'))
      @auth
        <a href="{{ route('topic') }}">Add topic</a>
      @endauth
    @endif
</div>
@endsection
  