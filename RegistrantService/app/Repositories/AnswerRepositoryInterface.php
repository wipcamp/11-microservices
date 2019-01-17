<?php

namespace App\Repositories;
use Illuminate\Http\Request;


interface AnswerRepositoryInterface{

    public function findAllAnswersById($wip_id);
    public function createAnswer($answers);
    public function updateAnswer($data,$i,$wip_id);
    public function getAnswersByQuestionId($question_id);
    }

