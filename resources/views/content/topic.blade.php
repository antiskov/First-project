@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Adding Topic</h3>
    @if (Route::has('login'))
    	@auth
    	<form action="{{ route('add-topic') }}" type='post'>
    		@csrf
    		<div class="form-group">
    		<input class="form-control" type="text" placeholder="What you intersting?">
  		</div>
    		<button type='submit' class="btn btn-success">Add topic</button>
    	</form>    	
      @endauth
    @endif
</div>
@endsection