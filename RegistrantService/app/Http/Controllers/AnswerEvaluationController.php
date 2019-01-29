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
      
      $evaluations = $req->all();
      $wip_id = $evaluations['wip_id'];
      $evaluations = array_except($evaluations, ['wip_id']);
      data_fill($evaluations,'*.wip_id',$wip_id);

      for($i=0;$i<count($evaluations);$i++){
        $this->answerEvaluations->answerEvaluations($evaluations[$i]);

      }
      
      return response()->json(["messege" => 'post Evaluations success ! '],201);
  }
}
