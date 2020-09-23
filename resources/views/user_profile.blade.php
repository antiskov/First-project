@extends('layouts.app')

@section('content')
    <div class="container">
        <img src="{{ asset('/storage/images/'.$user->avatar)}}" alt="avatar" width='100' height="100">
        <br>
        <h1>{{ $user->name }}</h1>
        @if($user->treds->count() > 0)
        <h3>treds</h3>
            @foreach($user->treds as $tred)
                <div class="alert alert-success">
                    <p>{{ $tred->tred_item }}</p>
                </div>
            @endforeach
        @else
            <div class="alert alert-success">
                <h4>dont have own treds</h4>
            </div>
        @endif
        <h3>messeges</h3>
        @foreach($user->communs as $commun)
            @if($commun)
            <div class="alert alert-warning">
                <p>{{ $commun->commun_item }}</p>
            </div>
            @endif
        @endforeach
    </div>
@endsection
