<?php

namespace App\Http\Middleware;

use Closure;
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;

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
        $token = $request->header('Authorization');
        $tokenBearer = substr($token,0,7);
        $jwt = substr($token,7);
        $check = $this->checkToken($tokenBearer,$token);
        if($check){
            try {
                $decoded = JWT::decode($jwt, $jwt_secret, array('HS256'));
                $wipId = $decoded->sub;
                $request['wip_id'] = $wipId;
                return $next($request);
            }
             catch (ExpiredException $exp) {
                return response()->json([
                    'error' => 'Expire token.'],401
                );
            } 
            catch (\Exception $ex)  {
                return response()->json(['error' => 'Invalid token.'],401);
            }
        }else{
            return response()->json([
                'error' => 'Invalid User.'
            ]);
        }
    }

    public function checkToken($tokenBearer,$token)
    {
        if(!is_null($token)){
            if(!is_null($tokenBearer)){
                if($tokenBearer =='Bearer '){
                    return true;
                }else {
                    return false;
                }
            }
        }else {
            return response()->json([
                'error' => 'Token is null.'
            ]);
        }
    }
}
