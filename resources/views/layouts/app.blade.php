@extends('layouts.base')

@section('base_content')
    <div class="row">
        <div class="col-3">
            <h5>Chats</h5>

            <div class="list-group">
                @forelse($chats as $chat)
                    <a href="{{ url('chats/' . $chat->id) }}"
                       class="list-group-item list-group-item-action">{{ $chat->title }}</a>
                @empty
                    <a href="#" class="list-group-item list-group-item-action disabled">No chats found</a>
                @endforelse
            </div>
        </div>

        <div class="col-9">
            @yield('content')
        </div>
    </div>
@stop