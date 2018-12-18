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
                'error' => $credentials
            ]);
        }
          
        $send = "me?access_token=${credentials['accessToken']}";
        $URL = env('FACEBOOK_URL') . $send;
         
        $res = $this->checkProviderCredentials($URL);
        if ($res == null || $credentials['provider_id'] !== $res['id']) {   
            return response()->json(['error' => 'Invalid Facebook Account']);
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
        $URL = env('FACEBOOK_URL') . $send;

        $res = $this->checkProviderCredentials($URL);
        if ($res == null || $credentials['provider_fb'] !== $res['id']) {   
            return response()->json(['error' => 'Invalid Facebook Account']);
        }

        $user = $this->authentication->getByProviderId($providerId);

        if(is_null($user)){
            return response()->json(['error' => 'Invalid Facebook Account']);
        }

        $URL = env('LINE_URL') . '/profile';
        $headers = ['Authorization' => 'Bearer ' . $credentials['accessTokenLine']];
        $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
        $response = $client->request('GET');
        $res = (string) $response->getBody();
        $lineId = json_decode($res)->userId;

        if ($res == null || $credentials['provider_line'] !== $lineId) {   
            return response()->json(['error' => 'Invalid Line Account']);
        }

        $user = $this->authentication->getByProviderId($providerId);

        if(is_null($user)){
            return response()->json(['error' => 'Invalid Line Account']);
        }
        return true;
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