@extends('admin.admin_app')

@section('admin-content')
    <div class="container">
        <h1>Topics</h1>
        @foreach($topics as $topic)
            <div class="alert alert-dark">
                <a href="{{route('admin-treds', $topic->id)}}">{{ $topic->topic_item }}</a>
                <a href="{{route('delete-topic-admin', [$topic->id])}}" class="text-primary float-right">r SoftDelete</a>
                <a href="{{route('force-delete-topic', [$topic->id])}}" class="text-danger float-right">ForceDelete o</a>
            </div>
        @endforeach
    </div>
@endsection
