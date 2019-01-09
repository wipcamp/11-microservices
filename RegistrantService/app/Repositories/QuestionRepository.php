<?php
namespace App\Repositories;

use App\Models\Question;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories;
use DB;


class QuestionRepository implements QuestionRepositoryInterface{

    public function findAllQuesions(){
        return Question::get();
    }
    public function findQuestionById($question_id){
        $question = Question::where('id',$question_id)->first();
       return $question;
    }
}

