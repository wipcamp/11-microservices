<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Validator;
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

    public function getAnswersByQuestionsId($question_id)
    {
        return response()->json($this->answer->getAnswersByQuestionsId($question_id));
    }

    public function getAnswersByQuestionbywipId(Request $request ,$question_id)
    {
        $wip_id = $request->all()['wip_id'];
        return response()->json($this->answer->getAnswersByQuestionbywipId($question_id,$wip_id));
    }

    public function manageAnswer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wip_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid Answer'
            ]);
        }

        $data = $request->all();
        $wip_id = $data['wip_id'];
        $check = $this->answer->findAllAnswersById($wip_id);

        if ($check->isEmpty()) {
            $wip_id = $data['wip_id'];
            $answers = array_except($data, ['wip_id']);
            data_fill($answers, '*.wip_id', $wip_id);
            $this->answer->createAnswer($answers);
            return response()->json($answers);
        } else {
            for ($i=0; $i < 5; $i++) {
                $this->answer->updateAnswer($data,$i,$wip_id);
           }
           return response()->json(['message' => 'update success']);
        }
    }

}
