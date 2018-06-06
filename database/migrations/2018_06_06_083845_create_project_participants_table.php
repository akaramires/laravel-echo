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
        Schema::create( 'project_participants', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->unsignedInteger( 'user_id' );
            $table->unsignedInteger( 'project_id' );
            $table->timestamps();
        } );

        $user1 = \App\User::whereEmail( 'e.abdurayimov@gmail.com' )->first();
        $user2 = \App\User::whereEmail( 'johndoe@gmail.com' )->first();

        $project1 = \App\Project::whereName( 'project1' )->first();
        $project2 = \App\Project::whereName( 'project2' )->first();

        $project1->participants()->attach( $user1 );
        $project2->participants()->attach( $user2 );

        \App\Task::create( [ 'project_id' => $project1->id, 'body' => 'Elmar\'s task.' ] );
        \App\Task::create( [ 'project_id' => $project2->id, 'body' => 'John\'s task.' ] );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'project_participants' );
    }
}
