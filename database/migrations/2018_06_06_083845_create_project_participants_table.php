<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'chat_participants', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->unsignedInteger( 'user_id' );
            $table->unsignedInteger( 'chat_id' );
            $table->timestamps();
        } );

        $user1 = \App\User::whereEmail( 'e.abdurayimov@gmail.com' )->first();
        $user2 = \App\User::whereEmail( 'johndoe@gmail.com' )->first();

        $chat1 = \App\Chat::whereName( 'chat1' )->first();
        $chat2 = \App\Chat::whereName( 'chat2' )->first();

        $chat1->participants()->attach( $user1 );
        $chat1->participants()->attach( $user2 );
        $chat2->participants()->attach( $user2 );

        \App\Message::create( [ 'chat_id' => $chat1->id, 'body' => 'Elmar\'s message.' ] );
        \App\Message::create( [ 'chat_id' => $chat2->id, 'body' => 'John\'s message.' ] );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'chat_participants' );
    }
}
