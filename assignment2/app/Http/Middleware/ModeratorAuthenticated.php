<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeratorAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if user is a moderator, proceed with next request
        if ( Auth::user()->role == 'moderator' ) {
            return $next($request);
        }
        
        // if user is not a moderator, redirect to homepage
        else {
            return redirect('/');
        }
    }
}