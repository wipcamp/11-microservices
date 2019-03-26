<?php

namespace App\Repositories;

use App\Repositories\ScoreEvaluationsRepositoryInterface;
use Illuminate\Http\Request;

use App\Models\ScoreEvaluations;
use App\Models\AnswerEvaluation;
use App\Models\Answer;
use App\Models\Profile;
use App\Models\Question;

use Illuminate\Support\Arr;

class ScoreEvaluationsRepository implements ScoreEvaluationsRepositoryInterface
{
    public function testQuerys()
    {
      $wip_ids =  AnswerEvaluation::join('answers','answer_evaluations.answer_id','answers.ans_id')->select('answers.wip_id')->groupBy('answers.wip_id');
      $wip_ids =json_decode($wip_ids->get(),true);
      $wip_ids = Arr::flatten($wip_ids);
      $weight = Question::select('*');
      $weight = json_decode($weight->get(),true);
      $cats_storage =array();
      $cats_storage[0]='intelligent_weight';
      $cats_storage[1]='communication_weight';
      $cats_storage[2]='creative_weight';
      $mean_cats = array();
      $sum_cats= array();
      $sum_cats[0]=0;
      $sum_cats[1]=0;
      $sum_cats[2]=0;
      $sum_cats[3]=0;
      $sum_cats[4]=0;
      $sum_mean=0;
      for ($i=0; $i < sizeof($wip_ids); $i++) { 
          //หา mean questions 5 อัน
        for ($j=0; $j < 5; $j++) { 
            for ($k=0; $k <3 ; $k++) { 
                $score =  AnswerEvaluation::join('answers','answer_evaluations.answer_id','answers.ans_id')
                ->select('answer_evaluations.score')
                ->where('answer_evaluations.score_category',$cats_storage[$k])
                ->where('wip_id',$wip_ids[$i])->where('answers.question_id',$j+1);

                $score = Arr::flatten(json_decode($score->get(),true));
                for ($l=0; $l < sizeof($score); $l++) { 
                    $sum_mean +=$score[$l];
                }
                    $sum_mean/=sizeof($score);
                $sum_mean*=$weight[$j][$cats_storage[$k]];
                $sum_cats[$j]+=$sum_mean;
                $sum_mean = 0;
            }
            $sum_cats[$j]/=100;
        }
          //หา mean cat 3 อัน
        


      }
    }
}
