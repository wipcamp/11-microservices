<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RegistrantController;
use App\Repositories\RegistrantRepository;
use App\Repositories\RegistrantRepositoryInterface;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class RegistrantController extends Controller
{
  protected $registrantRepository;

  public function __construct(RegistrantRepositoryInterface $registrantRepo)
  {
      $this->registrantRepository = $registrantRepo;
  }

  public function checkPermissionByWipId($req)
  {
      $token = $req->header('Authorization');
      $wip_id = $req['wip_id'];
      $jwt = substr($token,7);
      $URL = env('AUTH_URL') . '/permissions';
      $headers = ['Authorization' => 'Bearer '.$jwt];
      $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
      $response = $client->request('GET',$URL,['query' => ['wip_id' => $wip_id]]);
      $response = json_decode($response->getBody(),true);
      $arr_res = Arr::dot($response['permission']);
      $arr_res = Arr::flatten($arr_res);
      if(in_array(2,$arr_res)){
        return true;
      }else{
        return false;
      }
  }

  public function getRegistrants(Request $req)
  {
    $permission = $this->checkPermissionByWipId($req);
    if($permission){
      $role_id = 1;
      $token = $req->header('Authorization');
      $jwt = substr($token,7);
      $URL = env('AUTH_URL') . '/role';
      $headers = ['Authorization' => 'Bearer '.$jwt];
      $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
      $response = $client->request('GET',$URL,['query' => ['role_id' => $role_id]]);
      $response = json_decode($response->getBody());
      $data = $this->registrantRepository->getRegistrants($response);
      $registrants = $data;
      return response()->json(['registrants' => $registrants]);
    }else {
      return response()->json(['error' => "role or permission invalid !!"],405);
    }
  }
}
