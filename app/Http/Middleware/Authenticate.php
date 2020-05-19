<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }

        if (Auth::check()){
            $user = Auth::user();
            if ($user->status == 1){
                Auth::logout();
                return Redirect::to('login')->with('suserror','you have to connect to support!');
            }else {
                    return Redirect::to('home');
                }
        }
    }
}
