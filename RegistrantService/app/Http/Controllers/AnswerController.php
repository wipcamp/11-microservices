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
        $wip_id = $request->all()->json_decode($request)->wip_id;
        return response()->json($answer->findAllAnswersById($wip_id));
    }
    public function create()
    {
        return $this->answer->createAnswer();
    }

    public function edit(Request $request_form)
    {
        $answer = new AnswerRepository;
        return response()->json($this->answer->updateAnswer($request_form));
    }
}
