<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\AnswerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
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
        $question = $data[0]['question_id'];
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
