<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepositoryInterface;
use App\Models\Answer;

class AnswerRepository implements AnswerRepositoryInterface{

    public function findAllAnswersById(int $id){
        $answers = Answer::select('ans_id','ans_content')->where('wip_id',$id)->get();
        return $answers;
    }


    public function createAnswerTest(int $wip_id,int $question_id,String $content){
       // $this->count = var_dump(count($question_id));

            $answer=Answer::create([
                'question_id' => $question_id,
                'wip_id' =>$wip_id,
                'ans_content'=> $content

            ]);
        return 'insert answers success';
    }
    public function index()
    {
    $todos = Todo::all();
    return view('todos.index')->with(['todos' => $todos]);
    }




    public function createAnswer(Request $request){
        for ($i=1; $i < 6; $i++) {
            $answer=Answer::create([
                'question_id' => $i,
                'wip_id' =>$request->all()->json_decode($request)->answers->wip_id,
                'ans_content'=>''
            ]);
        }
    }
    public function updateAnswers(Request $request_form){
        $answer_data = $request_form->all();
        $profile = new ProfileController;

        $answer->where([
            'question_id ' => $answer_data->questionId,
            'wip_id' => json_decode($answer_data)->answers->wip_id
        ])
        ->update
        (['ans_content' => json_decode($answer_data)->answers->ans_content]);

    return $answer;
    }
}
