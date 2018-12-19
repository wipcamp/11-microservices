<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class ParseToken
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
        // $user = JWTAuth::decode();
        dd($user);
        // return $next($request);
    }
}
