@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Adding Tred</h3>
    @if (Route::has('login'))
    	@auth
    	<form action="{{ route('add-tred') }}" method="post">
    		@csrf
            <select name="topic">
            @foreach ($topics as $value)
                <option value="{{ $value->id }}">{{ $value->topic }}</option>
            @endforeach
            </select>
    		<div class="form-group">
    		    <input class="form-control" type="text" required placeholder="What you intersting?" name="tred_item">
  		    </div>
    		<button type='submit' class="btn btn-success">Add tred</button>
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