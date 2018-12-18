<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepository;

class AnswerController extends Controller
{
    public function _construct()
    {
        $this->answer = new AnswerRepository;
    }

    public function createAnswers(){

    }
    public function getAnswers(){
        $answer = new AnswerRepository;
        //get wip_id from credentials;
        $wip_id = 110001;
        return response()->json($answer->findAllAnswersById($wip_id));
    }
}
