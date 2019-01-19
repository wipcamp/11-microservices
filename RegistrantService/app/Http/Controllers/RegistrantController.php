<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RegistrantController;
use App\Repositories\RegistrantRepository;
use App\Repositories\RegistrantRepositoryInterface;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RegistrantController extends Controller
{
  protected $registrantRepository;

  public function __construct(RegistrantRepositoryInterface $registrantRepo)
  {
      $this->registrantRepository = $registrantRepo;
  }

  public function getRegistrants(Request $req)
  {
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
  }
}
