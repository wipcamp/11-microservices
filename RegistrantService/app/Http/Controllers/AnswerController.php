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
        $wip_id = $request->all()['wip_id'];
        return response()->json($this->answer->findAllAnswersById($wip_id));
    }
    public function create(Request $request)
    {   
        $data = $request->all();
        $wip_id = $data['wip_id'];
        $answers = array_except($data, ['wip_id']);
        data_fill($answers, '*.wip_id',$wip_id);
        $this->answer->createAnswer($answers);
        return  response()->json($answers);
    }

    public function edit(Request $request_form)
    {
        return response()->json($this->answer->updateAnswer($request_form));
    }
}
