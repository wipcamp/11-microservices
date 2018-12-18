<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\AuthenticationRepository;
use App\Repositories\AuthenticationRepositoryInterface;
use App\Repositories\UserRepository;

use JWTAuth;
use JWTFactory;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function login()
    {   
        $credentials = request(['provider_id', 'provider_name','accessToken']);
        $auth = new AuthProvider;
        $auth = $auth->Authentication($credentials);
    
        if(gettype($auth) == 'object') {
            return $auth;
        }

        $userNew = new AuthenticationRepository;
        $user = $userNew->getByProviderId($credentials['provider_id']);

        if(is_null($user)){
            $createUser = $userNew->createUser($credentials);
            $token = auth()->login($user);
            return $this->respondWithToken($token);
        }

        $token = auth()->login($user);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }


    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function getAuthenticatedUser() {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'expires' => auth()->factory()->getTTL() * 60
        ]);
    }
}
