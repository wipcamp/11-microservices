<?php
namespace App\Repositories;

use App\Models\Question;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories;


class QuestionRepository implements QuestionRepositoryInterface{

    public function findAllQuesions(){
        $questions = Question::get();
        return $questions;
    }
    public function findQuestionById(int $question_id){
        $question = Question::where('id',$question_id)->first();
       return $question;
    }
}
