@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Communication</h3>
    @foreach($communs as $commun)
    <div class="alert alert-warning">
        <p><em>{{ $commun->commun_quote }}</em></p>
        <h6>{{ $commun->commun_item }}</h6>

        @if (Route::has('login'))
        @auth
        <a href="{{ route('new-quote', [$topicId, $tredId, $commun->id]) }}">Give an answer</a>
        @endauth
        @endif
    </div>
    @endforeach
    @if (Route::has('login'))
    	@auth
    	<form action="{{ route('add-commun', [$topicId, $tredId]) }}" method="post">
    		@csrf
    		<div class="form-group">
    		    <input class="form-control" type="text" required placeholder="What you intersting?" name="commun_item">
  		    </div>
    		<button type='submit' class="btn btn-success">Add commutication</button>
    	</form>    	
      @endauth
    @endif
    </div>
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
  