<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RespondWithJson
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
        // force api to return all massages in json format (including validators' errors)
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
