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

use App\Events\TaskCreatedEvent;
use App\Project;

Route::group( [ 'middleware' => 'auth' ], function () {
    Route::get( '/projects/{project}', function ( Project $project ) {
        $project->load( 'tasks' );

        return view( 'welcome', compact( 'project' ) );
    } );

    // API

    Route::get( '/api/projects/{project}', function ( Project $project ) {
        return $project->tasks->pluck( 'body' );
    } );

    Route::post( '/api/projects/{project}/tasks', function ( Project $project ) {
        $task = $project->tasks()->create( request( [ 'body' ] ) );

        event( new TaskCreatedEvent( $task ) );

        return $task;
    } );

    //    Route::get( '/tasks', function () {
    //        return \App\Task::latest()->pluck( 'body' );
    //    } );

    //    Route::post( '/tasks', function () {
    //        $task = \App\Task::forceCreate( request( [ 'body' ] ) );
    //
    //        event( new \App\Events\TaskCreated( $task ) );
    //    } );
} );

Auth::routes();
