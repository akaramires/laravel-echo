<?php

namespace App\Http\Controllers;

use App\Models\Chat;

class ChatController extends Controller
{
    public function view( Chat $chat )
    {
        $chat->load( 'messages' );

        return view( 'chats.single', compact( 'chat' ) );
    }
}
