@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Answer</h3>
        @if (Route::has('login'))
            @auth
                <form action="{{ route('set-answer', [$threadId, $boardId]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="answer_item"></textarea>
                    </div>
                    <button type='submit' class="btn btn-success">Add qoute</button>
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
