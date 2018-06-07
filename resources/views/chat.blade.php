@extends('layouts.app')

@section('content')
    <message-list :data-chat="{{ $chat }}"></message-list>
@stop