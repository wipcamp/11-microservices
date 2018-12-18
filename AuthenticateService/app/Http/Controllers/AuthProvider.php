<?php
namespace App\Http\Controllers;
use Validator;
class AuthProvider
{
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
        $client = new \GuzzleHttp\Client;
        $res = null;
        try {
            $res = $client->get($URL);
            $res = (string) $res->getBody();
            $res = json_decode($res, true);
        } catch (\Exception $e) { }
        if ($res == null || $credentials['provider_id'] !== $res['id']) {   
            return response()->json(['error' => 'Invalid Facebook Account']);
        }
        return true;
    }
}