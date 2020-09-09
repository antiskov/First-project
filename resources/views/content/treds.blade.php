@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Treds</h3>
    @if (Route::has('login'))
      @auth
        <a href="{{ route('tred.create') }}">Add tred</a>
      @endauth
    @endif
@endsection