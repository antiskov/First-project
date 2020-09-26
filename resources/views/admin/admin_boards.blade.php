@extends('admin.admin_app')

@section('admin-content')
    <div class="container">
        <h3>Communication</h3>
        @foreach($boards as $board)
            <div class="alert alert-warning">
                @auth
                    @if(auth()->user()->id === $board->user->id)
                        <a href="{{route('delete-board', [$board->treds->id, $board->id])}}" class="text-danger float-right">delete</a>
                    @endif
                @endauth
                <div class='float-rigth'>{{ $board->created_at }}</div>
                <a href="{{ route('user-page', [$board->user->id]) }}">
                    <img src="{{ asset('/storage/images/'.$board->user->avatar)}}" alt="avatar" width='100' height="100" board='50%'>
                </a>
                <p class="text-secondary"><em>{{ $board->board_quote }}</em></p>
                <h6>{{ $board->board_item }}</h6>
                <p class="text-danger text-rigth">{{ $board->user->name }}</p>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('new-quote', ['tred' => $tred->id, $board->id]) }}">Give an answer</a>
                    @endauth
                @endif
            </div>
        @endforeach
    </div>

@endsection
