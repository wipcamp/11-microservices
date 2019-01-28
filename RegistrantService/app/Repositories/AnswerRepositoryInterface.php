<?php

namespace App\Repositories;
use Illuminate\Http\Request;


interface AnswerRepositoryInterface{

    public function findAllAnswersById($wip_id);
    public function findAnswersById($wip_id,$question_id);
    public function createAnswer($answers);
    public function updateAnswer($data,$i,$wip_id);
    public function updateAnswerline($data);
    public function getAnswersByQuestionsId($question_id);
    public function getAnswersByQuestionbywipId($question_id,$wip_id);
    }

