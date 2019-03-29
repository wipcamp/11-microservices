<?php

namespace App\Http\Controllers;

use App\Repositories\ScoreEvaluationsRepositoryInterface;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class ScoreEvaluationsController extends Controller
{
    protected $scoreEvaluation;
    public function __construct(ScoreEvaluationsRepositoryInterface $temp)
    {
        $this->scoreEvaluation = $temp;
    }
    public function testQuery(Request $req)
    {

        $res=$this->scoreEvaluation->testQuerys();
        return  response()->json($res, 200);
    }
    public function getCatScores(Request $req){
        $data = $this->scoreEvaluation->getCatScores();
        $profiles = $data[0];
        for ($i=0; $i != 100; $i++) { 
            $token = $req->header('Authorization');
            $URL = env('AUTH_URL') . '/role/'.$profiles[''.$i.'']['wip_id'];
            $headers = ['Authorization' => $token];
            $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
            $response = $client->request('GET');
            $response = json_decode($response->getBody(),true);
            $arr_res = Arr::flatten($response);
            $data[0][''.$i.'']['role'] = $arr_res[0];
            
        }
        return  response()->json($data, 200);
    }
}
