@extends('layouts.app')

@section('content')
    <div class="list-group">
        @forelse($projects as $project)
            <a href="{{ url('projects/' . $project->id) }}"
               class="list-group-item list-group-item-action">{{ $project->title }}</a>
        @empty
            <a href="#" class="list-group-item list-group-item-action disabled">No project found</a>
        @endforelse
    </div>
@stop