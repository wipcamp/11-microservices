<?php

namespace App\Repositories;

use App\Models\AnswerEvaluation;
use App\Repositories\AnswerEvaluationRepositoryInterface;

class  AnswerEvaluationRepository implements AnswerEvaluationRepositoryInterface
{
  public function answerEvaluations($evaluation)
  {
      $checkanswer_id = $evaluation['answer_id'];
      $check = AnswerEvaluation::where('answer_id',$checkanswer_id)->count();
        return AnswerEvaluation::create([
        'answer_id' => $evaluation['answer_id'],
        'checker_wip_id' => $evaluation['wip_id'],
        'question_id' => $evaluation['question_id'],
        'score' => $evaluation['score'],
        'score_category' => $evaluation['score_category']
      ]); 
  }
}
