<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\AnswerEvaluationRepositoryInterface;
use Illuminate\Http\Request;

class AnswerEvaluationController extends Controller
{
  
  protected $answerEvaluations;

  public function __construct(AnswerEvaluationRepositoryInterface $answerEvaluationsRepo) {
    $this->answerEvaluations = $answerEvaluationsRepo;
  }

  public function answerEvaluations(Request $req)
  {

    $data = $req->all();
    $wipId = $req->all()['wip_id'];
    $token = $req->header('Authorization');
    $URL = env('AUTH_URL') . '/permissions';
    $headers = ['Authorization' => $token];
    $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
    $response = $client->request('GET',$URL,['query' => ['wip_id' => $wipId]]);
    $response = json_decode($response->getBody(),true);
    $arr_res = Arr::dot($response['permission']);
    $arr_res = Arr::flatten($arr_res);
    
    if(in_array(4,$arr_res)||in_array(10,$arr_res)){
      $evaluations = $req->all();
      $wip_id = $evaluations['wip_id'];
      $evaluations = array_except($evaluations, ['wip_id']);
      data_fill($evaluations,'*.wip_id',$wip_id);

      for($i=0;$i<count($evaluations);$i++){
        $this->answerEvaluations->answerEvaluations($evaluations[$i]);
      }
      return response()->json(["messege" => 'post Evaluations success ! '],201);

    }else{
      return response()->json(['error' => "role or permission invalid !!"],405);
    }

      
      
  }
}
