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
        return response()->json([
            'questions' => $question->findAllQuesions(),
             'status'=> 200
        ]);

    }
}
