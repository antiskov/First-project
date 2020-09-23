@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Communication</h3>
    @foreach($communs as $commun)
        <div class="alert alert-warning">
            @auth
                @if(auth()->user()->id === $commun->user->id)
                    <a href="{{route('delete-commun', [$commun->treds->id, $commun->id])}}" class="text-danger float-right">delete</a>
                @endif
            @endauth
            <div class='float-rigth'>{{ $commun->created_at }}</div>
                <a href="{{ route('user-page', [$commun->user->id]) }}">
                    <img src="{{ asset('/storage/images/'.$commun->user->avatar)}}" alt="avatar" width='100' height="100" board='50%'>
                </a>
            <p class="text-secondary"><em>{{ $commun->commun_quote }}</em></p>
            <h6>{{ $commun->commun_item }}</h6>
            <p class="text-danger text-rigth">{{ $commun->user->name }}</p>
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('new-quote', ['tred' => $tred->id, $commun->id]) }}">Give an answer</a>
                @endauth
            @endif
        </div>
    @endforeach
    @if (Route::has('login'))
    	@auth
    	    <form action="{{ route('add-commun', ['topic' => $tred->content_id, 'tred' => $tred->id]) }}" method="post">
    		    @csrf
    		    <div class="form-group">
    		        <input class="form-control" type="text" required placeholder="What you intersting?" name="commun_item">
  		        </div>
    		    <button type='submit' class="btn btn-success">Add commutication</button>
    	    </form>
        @endauth
    @endif
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
