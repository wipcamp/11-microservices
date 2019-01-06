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
      $evaluations = $this->answerEvaluations->answerEvaluations($evaluations);
      return response()->json(["messege" => 'post Evaluations success ! '],201);
  }
}
