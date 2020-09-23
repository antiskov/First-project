@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Treds</h3>
    @foreach($treds as $tred)
        @if($tred->id !== 1)
            <div class="alert alert-success">
                <a href="{{ route('commun', [$tred->id]) }}">{{ $tred->tred_item }}</a>
            @auth
                @if(auth()->user()->id === $tred->user->id)
                    <a href="{{route('delete-tred', [$tred->id])}}" class="text-danger float-right">delete</a>
                @endif
            @endauth
            </div>
        @endif
    @endforeach
    @if (Route::has('login'))
      @auth
        <a href="{{ route('new-tred', $topicId) }}">New tred</a>
      @endauth
    @endif
@endsection
