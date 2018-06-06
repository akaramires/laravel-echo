@extends('layouts.app')

@section('content')
{{--    <h3>{{ $project->title }}</h3>--}}
    <task-list :data-project="{{ $project }}"></task-list>
@stop