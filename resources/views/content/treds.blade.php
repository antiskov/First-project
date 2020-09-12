@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Treds</h3>
    @foreach($treds as $tred)
    <div class="alert alert-dark">
        <a href="{{ route('commun') }}">{{ $tred->tred_item }}</a>
    </div>
    @endforeach
    @if (Route::has('login'))
      @auth
        <a href="{{ route('tred.create') }}">Add tred</a>
      @endauth
    @endif
@endsection