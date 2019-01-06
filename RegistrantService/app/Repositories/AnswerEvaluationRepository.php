<?php

namespace App\Repositories;

use App\Models\AnswerEvaluation;
use App\Repositories\AnswerEvaluationRepositoryInterface;

class  AnswerEvaluationRepository implements AnswerEvaluationRepositoryInterface
{
  public function getAnswerEvaluations($evaluation)
  {
      return AnswerEvaluation::create([
        'answer_id' => $evaluation['answer_id'],
        'checker_wip_id' => $evaluation['checker_wip_id'],
        'question_id' => $evaluation['question_id'],
        'score' => $evaluation['score'],
        'score_category' => $evaluation['score_category']
      ]);
  }
}
