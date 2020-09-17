@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Treds</h3>
    @foreach($treds as $tred)
    <div class="alert alert-success">
        <a href="{{ route('commun', [$topicId, $tred->id]) }}">{{ $tred->tred_item }}</a>
    </div>
    @endforeach
    @if (Route::has('login'))
      @auth
        <a href="{{ route('new-tred', $topicId) }}">New tred</a>
      @endauth
    @endif
@endsection