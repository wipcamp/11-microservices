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
        $profiles = json_encode($data[0]);
        $token = $req->header('Authorization');
        $URL = env('AUTH_URL') . '/roles';
        $headers = ['Authorization' => $token];
        $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
        $response = $client->request('PUT',$URL,['json' => ['profiles' => $profiles]]);
        $response = json_decode($response->getBody());
        for ($i=0; $i != 557; $i++) { 
            $arr_res = array($response);
            $data[0][''.$i.'']['role'] = $response[$i];
        }
        return  response()->json($data, 200);
    }
}
