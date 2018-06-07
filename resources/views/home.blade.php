@extends('layouts.app')

@section('content')
    <div class="list-group">
        @forelse($chats as $chat)
            <a href="{{ url('chats/' . $chat->id) }}"
               class="list-group-item list-group-item-action">{{ $chat->title }}</a>
        @empty
            <a href="#" class="list-group-item list-group-item-action disabled">No chats found</a>
        @endforelse
    </div>
@stop