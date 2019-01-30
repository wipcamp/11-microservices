<?php
namespace App\Http\Controllers;

use App\Repositories\AuthenticationRepositoryInterface;
use Validator;


class AuthProvider
{
    protected $authentication;

    public function __construct(AuthenticationRepositoryInterface $authentication){
        $this->authentication = $authentication;
    }

    public function Authentication($credentials) {
        $schema = [
            'provider_id' => 'required',
            'provider_name' => 'required',
            'accessToken' => 'required'
        ];
        $validator = Validator::make($credentials, $schema);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid check your feild.'
            ]);
        }
          if($credentials['provider_name']==='line'){
            return true;
          }
        $send = "me?access_token=${credentials['accessToken']}";
        $URL = config('services.wip_config.facebook').$send;
         
        $res = $this->checkProviderCredentials($URL);
        if ($res == null || $credentials['provider_id'] !== $res['id']) {   
            return response()->json(['error' => 'Invalid  Account'],401);
        }
        return true;
    }

    public function checkAttributes($credentials) {
        $schema = [
            'provider_fb' => 'required',
            'accessTokenFB' => 'required',
            'provider_line' => 'required',
            'accessTokenLine' => 'required'
        ];
        $validator = Validator::make($credentials, $schema);
        if ($validator->fails()) {
            return response()->json([
                'error' => $credentials
            ]);
        }


        $send = "me?access_token=${credentials['accessTokenFB']}";
        $URL = config('services.wip_config.facebook'). $send;

        $res = $this->checkProviderCredentials($URL);
        if ($res == null || $credentials['provider_fb'] !== $res['id']) {   
            return response()->json(['error' => 'Invalid Facebook Account'],401);
        }

        $user = $this->authentication->getByProviderId($credentials['provider_fb']);
        if(is_null($user)){
            return response()->json(['error' => 'Please Register By Facebook Account Before Connect With Line'],403);
        }

        $URL = env('LINE_URL') . '/profile';
        $headers = ['Authorization' => 'Bearer ' . $credentials['accessTokenLine']];
        $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
        $response = $client->request('GET');
        $res = (string) $response->getBody();
        $lineId = json_decode($res)->userId;
        
        if ($res == null || $credentials['provider_line'] !== $lineId) {   
            return response()->json(['error' => 'Invalid Line Account'],403);
        }
        $wipId = $user['wip_id'];
        $user = $this->authentication->getByProviderId($credentials['provider_line']);
        
        if(is_null($user)){
            $user = [
                "provider_id" => $credentials['provider_line'],
                "provider_name" => "line",
                "role" => 1,
                "wip_id" => $wipId
            ];
          $x = $this->authentication->createUser($user);
            return response()->json(['status' => true],200);
        }
        
        return response()->json(['status' => true],200);
    }

    public function checkProviderCredentials($url){
        $client = new \GuzzleHttp\Client;
        $res = null;
        try {
            $res = $client->get($url);
            $res = (string) $res->getBody();
            $res = json_decode($res, true);
        } catch (\Exception $e) { }
        return $res;
    }
}