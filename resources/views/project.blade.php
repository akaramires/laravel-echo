@extends('layouts.app')

@section('content')
    <task-list :data-project="{{ $project }}"></task-list>
@stop