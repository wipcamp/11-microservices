<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionRepositoryInterface;

class QuestionController extends Controller
{
    protected $question ;
    public function __construct(QuestionRepositoryInterface $questionRepo)
    {
        $this->question = $questionRepo;
    }

    public function getQuestions()
    {
        return response()->json($this->question->findAllQuesions());
    }

    public function getQuestionById($question_id){
        return response()->json($this->question->findQuestionById($question_id));
    }

}
