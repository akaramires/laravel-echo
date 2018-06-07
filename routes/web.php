<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Events\MessageCreatedEvent;
use App\Chat;

Auth::routes();

Route::group( [ 'middleware' => [ 'auth' ] ], function () {
    Route::group( [ 'middleware' => [ 'chat_access' ] ], function () {
        Route::get( '/chats/{chat}', function ( Chat $chat ) {
            $chat->load( 'messages' );

            return view( 'chat', compact( 'chat' ) );
        } );

        // API
        Route::get( '/api/chats/{chat}', function ( Chat $chat ) {
            return $chat->messages->pluck( 'body' );
        } );

        Route::post( '/api/chats/{chat}/messages', function ( Chat $chat ) {
            $message = $chat->messages()->create( request( [ 'body' ] ) );

            event( new MessageCreatedEvent( $message ) );

            return $message;
        } );
    } );

    Route::get( '/', 'HomeController@index' );
} );