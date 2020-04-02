<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class userMiddleware
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
        if(Auth::user()->user_type == 'user'){
            return $next($request);
        }else {
            return abort(404, 'Unauthorized action.');
            //return redirect('/');
        }
    }
}
