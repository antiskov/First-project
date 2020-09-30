@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Topics</h3>
    @foreach($data as $element)
            <div class="alert alert-dark">
                <a href="{{route('threads', $element->id)}}">{{ $element->topic_item }}</a>
            @auth
                @if(auth()->user()->id === $element->user->id)
                    <a href="{{route('delete-topic', [$element->id])}}" class="text-danger float-right">delete</a>
                @endif
            @endauth
            </div>
    @endforeach
    @if (Route::has('login'))
      @auth
        <a href="{{ route('topic') }}">Add topic</a>
      @endauth
    @endif
</div>
@endsection
