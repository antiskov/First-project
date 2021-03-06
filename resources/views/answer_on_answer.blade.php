@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Answer on answer</h3>
        @if (Route::has('login'))
            @auth
                <form action="{{ route('answer-on-answer', [$threadId, $boardId, $answerId]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="answer_item"></textarea>
                    </div>
                    <button type='submit' class="btn btn-success">Answer on answer</button>
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
