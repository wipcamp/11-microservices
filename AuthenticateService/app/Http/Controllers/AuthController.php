<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\AuthenticationRepositoryInterface;
use App\Repositories\UserRepository;

use JWTAuth;
use JWTFactory;

class AuthController extends Controller
{

    protected $authentication;
    protected $authProvider;

    public function __construct(AuthenticationRepositoryInterface $authentication){
        $this->middleware('auth:api', ['except' => ['login', 'connect']]);
        $this->authentication = $authentication;
        $this->authProvider = new AuthProvider($authentication);
    }


    public function login()
    {   
        $credentials = request(['provider_id', 'provider_name','accessToken']);
        $auth = $this->authProvider->Authentication($credentials);
    
        if(gettype($auth) == 'object') {
            return $auth;
        }

        $providerId = $credentials['provider_id'];
        $user = $this->authentication->getByProviderId($providerId);
        if(is_null($user)){
            $user = $this->authentication->createUser($credentials);
        }

        $wipId = $user->wip_id;
        $token = auth()->login($user);

        if (is_null($wipId)) {
            $URL = env('RIGISTANT_URL') . '/profile';
            $headers = ['Authorization' => 'Bearer ' . $token];
            $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
            $response = $client->request('POST');
            $body = (string) $response->getBody();
            // dd(json_decode($body)->wip_id);
            $wipId = json_decode($body)->wip_id;
            $this->authentication->updateByProviderId($providerId, $wipId);
            $user['wip_id'] = $wipId;
        }
        $user['id'] = $wipId;
        $token = JWTAuth::fromUser($user, ['sub' => $wipId, 'aud' => $providerId]);
        // $payload = JWTFactory::sub($wipId)->wip_id($wipId)->make();
        // $payload = JWTFactory::make($customClaims);
        // $token = JWTAuth::encode($payload);

        
        return $this->respondWithToken($token, $user['wip_id']);
    }

    public function connect(){
        $credentials = request(['provider_fb', 'accessTokenFB','provider_line','accessTokenLine']);
        $auth = $this->authProvider->checkAttributes($credentials);

        if(gettype($auth) == 'object') {
            return $auth;
        }
        

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


    protected function respondWithToken($token, $wip_id)
    {
        return response()->json([
            'token' => $token,
            'expires' => auth()->factory()->getTTL() * 60,
            'wip_id' => $wip_id
        ],200);
    }
}
