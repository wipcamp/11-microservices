<?php

namespace App\Http\Controllers;


use App\Http\Controllers\CampersController;
use App\Repositories\CampersRepository;
use App\Repositories\CampersRepositoryInterface;
use Aws\StorageGateway\StorageGatewayClient;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Storage;


class CampersController extends Controller
{
  
    protected $campers;
    public function __construct(CampersRepositoryInterface $camp)
    {
        $this->campers = $camp;
    }
    public function getCamperByWipId(Request $req)
    {
     $data = $req->all()['wip_id_camper'];
     $res = $this->campers->getCamperByWipId($data);
     return response()->json($res, 200);
    }

  public function getCampers(Request $req)
  {
    $camps = $this->campers->getCampers();
    $res = json_decode($camps, true);
    $token = $req->header('Authorization');
    $URL = env('RIGISTANT_URL') . '/registrants/profiles/campers';
    $headers = ['Authorization' => $token];
    $client = new \GuzzleHttp\Client(['base_uri' => $URL, 'headers' => $headers]);
    $response = $client->request('PUT', $URL, ['json' => ['campers' => $res]]);
    $response = json_decode($response->getBody());
    $response = Arr::flatten($response);
    return response()->json(['campers' => $response], 200);
  }

  public function getFile()
  {

    $url = Storage::cloud()->temporaryUrl('profile/WIPID110014/110014_confrim', \Carbon\Carbon::now()->addDays(7));
    return  response()->json($presignedUrl, 200);
  }


  public function checkInCamper(Request $req)
  {
    $token = $req->header('Authorization');
    $citizen= $req['citizen'];
    $URL = env('RIGISTANT_URL') . '/profile/citizen';
    $headers = ['Authorization' => $token];
    $client = new \GuzzleHttp\Client(['base_uri' => $URL, 'headers' => $headers]);
    $response = $client->request('PUT', $URL, ['json' => ['citizen' => $citizen]]);
    $response = json_decode($response->getBody());
    $camper = $this->campers->updateCamperByWipId($response->profile->wip_id,$req['checked'],$req['wifi']);
    return response()->json($camper, 200);
  }
}
