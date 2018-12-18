<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function _construct()
    {
        $this->answer = new AnswerRepository;
    }

    public function getAnswersByWipId(Request $request)
    {
        $answer = new AnswerRepository;
        //get wip_id ;
        //$wip_id = 110001;
        $wip_id = $request->all()->json_decode($answer_data)->answers->wip_id;
        return response()->json($answer->findAllAnswersById($wip_id));
    }
    public function create()
    {
        return $this->answer->createAnswer();
    }

    public function createTest()
    {
        $answer = new AnswerRepository;
        return $answer->createAnswerTest(110000,2,'Hello');
    }
    public function edit(Request $request_form)
    {
        return response()->json($this->answer->updateAnswers($request_form));
    }
}
