@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Topics</h3>
    @foreach($data as $element)
    <div class="alert alert-dark">
        <a href="{{route('treds', $element->id)}}">{{ $element->topic_item }}</a>
    </div>
    @endforeach
    @if (Route::has('login'))
      @auth
        <a href="{{ route('topic') }}">Add topic</a>
      @endauth
    @endif
</div>
@endsection
