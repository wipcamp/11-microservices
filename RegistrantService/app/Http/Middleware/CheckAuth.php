<?php

namespace App\Http\Middleware;

use Closure;
use \Firebase\JWT\JWT;

class CheckAuth
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
        $jwt_secret = env('JWT_SECRET');
        $token = $request->header('authorization');
        $jwt = substr($token, 7);
        $decoded = JWT::decode($jwt, $jwt_secret, array('HS256'));
        $wipId = $decoded->sub;
        $request['wip_id'] = $wipId;
        return $next($request);
    }
}
