@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>admin panel</h1>
        <img src="{{ asset('/storage/images/'.Auth::user()->avatar)}}" alt="avatar" width='50' height="50">
        <a href="{{route('soft-deleted')}}" class="float-right">SoftDeleted things</a>
        <br>
        <br>
        <br>
    </div>
    @yield('admin-content')
@endsection
