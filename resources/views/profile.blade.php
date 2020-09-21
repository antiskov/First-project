@extends('layouts.app')

@section('content')
<div class="container">

	<img src="{{ asset('/storage/images/'.Auth::user()->avatar)}}" alt="avatar" width='180' height="180">

    <h1>Hello, {{ Auth::user()->name }}, mothafucker !</h1>

    <form action="{{ route('profile-image') }}" method="post" enctype='multipart/form-data'>
    	@csrf
    	<input type="file" required name="image">
    	<input type="submit" name="Upload">
    </form>
    @if(Auth::user()->topic->count() > 0)
        <h3>topics</h3>
        @foreach(Auth::user()->topic as $topic)
            <div class="alert alert-dark">
                <p>{{ $topic->topic }}</p>
            </div>
        @endforeach
    @else
        <div class="alert alert-success">
            <h4>dont have own topics</h4>
        </div>
    @endif
    @if(Auth::user()->tred->count() > 0)
        <h3>treds</h3>
        @foreach(Auth::user()->tred as $tred)
            <div class="alert alert-success">
                <p>{{ $tred->tred_item }}</p>
            </div>
        @endforeach
    @else
        <div class="alert alert-success">
            <h4>dont have own treds</h4>
        </div>
    @endif
</div>



@endsection
