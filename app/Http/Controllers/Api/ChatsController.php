<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use App\Events\MessageCreatedEvent;
use App\Http\Controllers\Controller;

class ChatsController extends Controller
{
    public function show( Chat $chat )
    {
        return $chat->messages->pluck( 'body' );
    }

    public function messages( Chat $chat )
    {
        $message = $chat->messages()->create( request( [ 'body' ] ) );

        event( new MessageCreatedEvent( $message ) );

        return $message;
    }
}
