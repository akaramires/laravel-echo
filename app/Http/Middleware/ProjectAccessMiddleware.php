<?php

namespace App\Http\Middleware;

use Closure;

class ProjectAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        $project = $request->route( 'project' );

        if ( !$project->participants->contains( auth()->user() ) ) {
            return redirect( '/' );
        }

        return $next( $request );
    }
}
