@extends('admin.admin_app')

@section('admin-content')
    <div class="container">
        <h1>Treds</h1>
        @foreach($treds as $tred)
            <div class="alert alert-success">
                <a href="{{ route('admin-board', [$tred->id]) }}">{{ $tred->tred_item }}</a>
                    <a href="{{route('delete-tred', [$topicId, $tred->id])}}" class="text-primary float-right">r SoftDelete</a>
                    <a href="{{route('forcedelete-tred', [$topicId, $tred->id])}}" class="text-danger float-right">ForceDelete o</a>
            </div>
        @endforeach
@endsection
