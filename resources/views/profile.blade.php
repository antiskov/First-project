@extends('layouts.app')

@section('content')
<div class="container">
	<img src="{{ asset('/storage/images/'.Auth::user()->avatar)}}" alt="avatar" width='180' height="180" >
    <h1>Hello, {{ Auth::user()->name }}, mothafucker !</h1>
    <form action="{{ route('profile-image') }}" method="post" enctype='multipart/form-data'>
    	@csrf
    	<input type="file" required name="image" accept="image/x-png,image/gif,image/jpeg" >
    	<input type="submit" name="Upload">
    </form>
    <br>
    <br>
    @if(Auth::user()->topics->count() > 0)
        <h3>topics</h3>
        @foreach(Auth::user()->topics as $topic)
            <div class="alert alert-dark">
                <p>{{ $topic->topic_item }}</p>
            </div>
        @endforeach
    @else
        <div class="alert alert-dark">
            <h4>dont have own topics</h4>
        </div>
    @endif
    @if(Auth::user()->threads->count() > 0)
        <h3>treds</h3>
        @foreach(Auth::user()->threads as $thread)
            <div class="alert alert-success">
                <p>{{ $thread->thread_item }}</p>
            </div>
        @endforeach
    @else
        <div class="alert alert-success">
            <h4>dont have own treds</h4>
        </div>
    @endif
    @if(Auth::user()->boards->count() > 0)
        <h3>boards</h3>
        @foreach(Auth::user()->boards as $board)
            <div class="alert alert-warning">
                <div class='float-rigth'>{{ $board->created_at }}</div>
                <a href="{{ route('user-page', [$board->user->id]) }}">
                    <img src="{{ asset('/storage/images/'.$board->user->avatar)}}" alt="avatar" width='100' height="100" board='50%'>
                </a>
                <p class="text-secondary"><em>{{ $board->board_quote }}</em></p>
                <h6>{{ $board->board_item }}</h6>
                <p class="text-danger text-rigth">{{ $board->user->name }}</p>
            </div>
        @endforeach
    @else
        <div class="alert alert-warning">
            <h4>dont have own boards</h4>
        </div>
    @endif
</div>
@endsection
