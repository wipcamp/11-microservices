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
    private function getAnswers(){
        $answerCtrl = new AnswerController();
        return $answerCtrl->getAnswers();
    }
    public function getQuesAndAns(){
        return response()->json(['question'=>QuestionController::getQuestions(),'answer'=>QuestionController::getAnswersByWipId()]);
    }
}
