<?php

namespace App\Http\Middleware;

use Closure;

class ChatAccessMiddleware
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
        $chat = $request->route( 'chat' );

        if ( !$chat->participants->contains( auth()->user() ) ) {
            return redirect( '/' );
        }

        return $next( $request );
    }
}
