<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $tipo): Response
    {
        if($request->user() && in_array($request->user()->privilegios, $tipo))
        {
            return $next($request);
        }
        /* abort(403,'Prohibido'); */
       // return $next($request);

       return response()->view('',[],403);
    }
}
