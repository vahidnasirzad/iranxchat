<?php

namespace App\Http\Middleware;

use Closure;use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()){
            $user = Auth::user();
            if ($user->status == 1) {
                Auth::logout();
                return Redirect::to('login');
            }
            if ($user->role == 'user'){
                return Redirect::to('/');
            }
        } else {
           return Redirect::to('login');
        }
        return $next($request);
    }
}
