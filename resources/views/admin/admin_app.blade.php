@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>You are {{ Auth::user()->name }}</h1>
        <img src="{{ asset('/storage/images/'.Auth::user()->avatar)}}" alt="avatar" width='180' height="180">
    </div>
    @yield('admin-content')
@endsection
