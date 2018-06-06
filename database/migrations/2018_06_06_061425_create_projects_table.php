<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'projects', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->timestamps();
        } );

        ( new \App\Project() )->insert( [
            [
                'name'       => 'Project 1',
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => date( 'Y-m-d H:i:s' ),
            ],
            [
                'name'       => 'Project 2',
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
        Schema::dropIfExists( 'projects' );
    }
}
