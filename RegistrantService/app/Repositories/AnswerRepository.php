<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Repositories\AnswerRepositoryInterface;
use App\Models\AnswerEvaluation;
use App\Repositories\AnswerEvaluationRepositoryInterface;

class AnswerRepository implements AnswerRepositoryInterface
{

    public function findAllAnswersById($wip_id)
    {
        $answers = Answer::select('ans_id', 'question_id', 'ans_content')->where('wip_id', $wip_id)->get();
        return $answers;
    }
    public function findAnswersById($wip_id,$question_id)
    {
        return Answer::select('ans_id','ans_content','question_id')->where('wip_id', $wip_id)->where('question_id', $question_id)->get();
    }
    public function createAnswer($answers)
    {
        return Answer::insert($answers);
    }
    public function getAnswersByQuestionsId($question_id,$wip_id)
    {   
        return Answer::select('*')->join('profiles','answers.wip_id','profiles.wip_id')
        ->where('profiles.confirm_register',1)
        ->where('answers.question_id',$question_id)
        ->whereNotIn('answers.ans_id',
         Answer::pluck('answers.ans_id'))->select('answers.ans_id')->join('answer_evaluations','answer.ans_id','answer_evaluations.answer_id')
        ->where('answer_evaluations.checker_wip_id',$wip_id)
        ->get();
    }

//     SELECT * FROM answers a join profiles p 
// 	on a.wip_id = p.wip_id
// 	where p.confirm_register =1 
// 		and a.question_id =1
// 		AND a.ans_id NOT in

// (
// SELECT a.ans_id FROM answers a join answer_evaluations ae
//     on a.ans_id = ae.answer_id 
//     WHERE ae.checker_wip_id = 110684
//     GROUP by a.ans_id
// )

    public function getAnswersByQuestionbywipId($question_id,$wip_id)
    {
        return Answer::select('ans_id','ans_content')->where('wip_id', $wip_id)->where('question_id', $question_id)->get();
    }
    public function updateAnswerline($data)
    {
        Answer::where('wip_id', $data['wip_id'])->where('question_id', $data['question_id'])->update(['ans_content' => $data['ans_content']]);
    }

    public function updateAnswer($data,$i,$wip_id)
    {
        $answer_content=$data[$i]['ans_content'];
            $ans_contentDB = Answer::select('ans_content')->where('wip_id', $wip_id, 'question_id', $data[$i]['question_id']);
            if ($answer_content != $ans_contentDB && $ans_contentDB!=null) {
                $answer = Answer::where([
                    'question_id' => $data[$i]['question_id'],
                    'wip_id' => $wip_id,
                ])
                    ->update
                    (['ans_content' => $answer_content
                    ]);
            }
    }
   



}