<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Instructor
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
        if(auth()->user()->is_instructor != 1){
            $notify[]=['error','Unauthorized access'];
            return redirect(route('user.home'))->withNotify($notify);
        }
        return $next($request);
    }
}
