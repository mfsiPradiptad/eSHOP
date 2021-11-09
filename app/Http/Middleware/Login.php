<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login
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
        if (Auth::check()) {
            if (Auth::user() && Auth::user()->role == '7') {
                return redirect('/home');
              }

            if (Auth::user() && Auth::user()->role == '1') {
                return redirect('/productList');
            }
        }

        return $next($request);
    }
}
