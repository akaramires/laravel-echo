<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'users', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->string( 'email' )->unique();
            $table->string( 'password' );
            $table->rememberToken();
            $table->timestamps();
        } );

        ( new \App\User )->insert( [
            [
                'name'       => 'Elmar Abdurayimov',
                'email'      => 'e.abdurayimov@gmail.com',
                'password'   => Hash::make( 'password' ),
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => date( 'Y-m-d H:i:s' ),
            ],
            [
                'name'       => 'John Doe',
                'email'      => 'johndoe@gmail.com',
                'password'   => Hash::make( 'password' ),
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => date( 'Y-m-d H:i:s' ),
            ],
        ] );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'users' );
    }
}
