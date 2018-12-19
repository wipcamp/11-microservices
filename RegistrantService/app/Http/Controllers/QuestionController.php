<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    public function _construct()
    {
        $this->question = new QuestionRepository;
    }

    public function getQuestions()
    {
        $question = new QuestionRepository;
        return $question->findAllQuesions();
    }
    public function getQuesAndAns(){
        return response()->json(['questions'=>QuestionController::getQuestions(),'answers'=>QuestionController::getAnswersByWipId()]);
    }

    public function getQuestionById($question_id){
        $question = new QuestionRepository;
        return response()->json($question->findQuestionById($question_id));
    }
}
