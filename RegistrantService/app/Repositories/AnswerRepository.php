<?php

namespace App\Repositories;
use App\Repositories\AnswerRepositoryInterface;
use App\Models\Answer;

class AnswerRepository implements AnswerRepositoryInterface{

    public function findAllAnswersById(int $id){
        $answers = Answer::select('ans_id','ans_content')->where('wip_id',$id)->get();
        return $answers;
    }

}
