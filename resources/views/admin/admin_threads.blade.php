@extends('admin.admin_app')

@section('admin-content')
    <div class="container">
        <h1>Treds</h1>
        @foreach($threads as $thread)
            <div class="alert alert-success">
                <a href="{{ route('admin-board', [$thread->id]) }}">{{ $thread->thread_item }}</a>
                <a href="{{route('delete-thread-admin', [$topicId, $thread->id])}}" class="text-primary float-right">r SoftDelete</a>
                <a href="{{route('force-delete-thread', [$topicId, $thread->id])}}" class="text-danger float-right">ForceDelete o</a>
            </div>
    @endforeach
@endsection
