<?php

namespace App\Repositories;
use Illuminate\Http\Request;


interface AnswerEvaluationRepositoryInterface{
    public function answerEvaluations($evaluation);
}