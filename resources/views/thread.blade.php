@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Threads</h3>
        @foreach($threads as $thread)
            <div class="alert alert-success">
                <a href="{{ route('board', [$thread->id]) }}">{{ $thread->thread_item }}</a>
                @auth
                    @if(auth()->user()->id === $thread->user->id)
                        <a href="{{route('delete-thread', [$topicId, $thread->id])}}" class="text-danger float-right">delete</a>
                    @endif
                @endauth
            </div>
        @endforeach
        @if (Route::has('login'))
            @auth
                <a href="{{ route('new-thread', $topicId) }}">New tred</a>
    @endauth
    @endif
@endsection
