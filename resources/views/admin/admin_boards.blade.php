@extends('admin.admin_app')

@section('admin-content')
    <div class="container">
        <h3>Communication</h3>
        @foreach($boards as $board)
            <div class="alert alert-warning">
                <a href="{{route('delete-board', [$board->thread->id, $board->id])}}" class="text-primary float-right">r SoftDelete</a>
                    <a href="{{route('forcedelete-board', [$board->thread->id, $board->id])}}" class="text-danger float-right">ForceDelete o</a>
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
