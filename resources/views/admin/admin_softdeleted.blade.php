@extends('admin.admin_app')

@section('admin-content')
    <div class="container">
        <h2>SoftDeleted</h2>
        <h3>Topics</h3>
        @foreach($topics as $topic)
            <div class="alert alert-dark">
                <a href="{{route('admin-treds', $topic->id)}}">{{ $topic->topic_item }}</a>
                <a href="{{route('restore-topic', [$topic->id])}}" class="text-primary float-right">Restore</a>
            </div>
        @endforeach
        <h3>Treds</h3>
        @foreach($treds as $tred)
            <div class="alert alert-success">
                <a href="{{ route('admin-board', [$tred->id]) }}">{{ $tred->tred_item }}</a>
                <a href="{{route('restore-tred', [$tred->id])}}" class="text-primary float-right">Restore</a>
            </div>
        @endforeach
        <h3>Boards</h3>
        @foreach($boards as $board)
            <div class="alert alert-warning">
                <a href="{{route('restore-board', [$board->treds->id, $board->id])}}" class="text-primary float-right">Restore</a>
                <div class='float-rigth'>{{ $board->created_at }}</div>
                <a href="{{ route('user-page', [$board->user->id]) }}">
                    <img src="{{ asset('/storage/images/'.$board->user->avatar)}}" alt="avatar" width='100' height="100" board='50%'>
                </a>
                <p class="text-secondary"><em>{{ $board->board_quote }}</em></p>
                <h6>{{ $board->board_item }}</h6>
                <p class="text-danger text-rigth">{{ $board->user->name }}</p>
            </div>
        @endforeach
    </div>
@endsection
