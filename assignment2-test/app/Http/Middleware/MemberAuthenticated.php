<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAuthenticated
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
        // if user is a member, proceed with next request
        if ( Auth::user()->role == 'member' ) {
            return $next($request);
        }
        
        // if user is not a member, redirect to homepage
        else {
            return redirect('/');
        }
    }
}