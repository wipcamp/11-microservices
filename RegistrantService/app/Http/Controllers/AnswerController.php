<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected $answer;

    public function __construct(AnswerRepositoryInterface $answerRepo)
    {
        $this->answer = $answerRepo;
    }

    public function getAnswersByWipId(Request $request)
    {
        $wip_id = $request->all()->json_decode($request)->wip_id;
        return response()->json($this->answer->findAllAnswersById($wip_id));
    }
    public function create()
    {
        return $this->answer->createAnswer();
    }

    public function edit(Request $request_form)
    {
        return response()->json($this->answer->updateAnswer($request_form));
    }
}
