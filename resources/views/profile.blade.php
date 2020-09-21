@extends('layouts.app')

@section('content')
<div class="container">
	@auth
	<img src="{{ asset('/storage/images/'.Auth::user()->avatar)}}" alt="avatar" width='180' height="180">

    <h1>Hello, {{ Auth::user()->name }}, mothafucker !</h1>

    <form action="{{ route('profile-image') }}" method="post" enctype='multipart/form-data'>
    	@csrf
    	<input type="file" required name="image">
    	<input type="submit" name="Upload">
    </form>
    @endauth


@endsection
