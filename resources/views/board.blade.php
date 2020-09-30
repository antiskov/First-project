@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Communication</h3>
        @foreach($boards as $board)
            <div class="alert alert-warning">
                @auth
                    @if(auth()->user()->id === $board->user->id)
                        <a href="{{route('delete-board', [$board->thread->id, $board->id])}}" class="text-danger float-right">delete</a>
                    @endif
                @endauth
                <div class='float-rigth'>{{ $board->created_at }}</div>
                <a href="{{ route('user-page', [$board->user->id]) }}">
                    <img src="{{ asset('/storage/images/'.$board->user->avatar)}}" alt="avatar" width='100' height="100" board='50%'>
                </a>
                    <br><br>
                <h6>{{ $board->board_item }}</h6>
                <p class="text-danger text-rigth">{{ $board->user->name }}</p>
                @guest
                        <a href="{{ route('register')}}">Give an answer</a>
                @endguest
                @auth
                    <a href="{{ route('answer', [$thread->id, $board->id]) }}">Give an answer</a>
                @endauth
                @foreach($board->answers as $answer)
                    <div class="alert alert-info">
                        <p class="text-danger">{{$answer->user->name}}</p>
                        <p class="text-info">{{$answer->answer_on_answer}}</p>
                        <p>{{$answer->answer_item}}</p>
                        @auth
                            <a href="{{ route('answer-on', [$thread->id, $board->id, $answer->id]) }}">Answer on answer</a>
                        @endauth
                    </div>

                @endforeach
            </div>
        @endforeach
        @if (Route::has('login'))
            @auth
                <form action="{{ route('add-board', ['topic' => $thread->content_id, 'thread' => $thread->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="text" required placeholder="What you intersting?" name="board_item">
                    </div>
                    <button type='submit' class="btn btn-success">Add message</button>
                </form>
            @endauth
        @endif
        @guest
            <form action="{{ route('register') }}" method="get">
                @csrf
                <div class="form-group">
                    <input class="form-control" type="text" required placeholder="What you intersting?" name="board_item">
                </div>
                <button type='submit' class="btn btn-success">Add commutication</button>
            </form>
        @endguest
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
