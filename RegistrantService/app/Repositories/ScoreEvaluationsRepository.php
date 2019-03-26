<?php

namespace App\Repositories;

use App\Repositories\ScoreEvaluationsRepositoryInterface;
use Illuminate\Http\Request;

use App\Models\ScoreEvaluation;
use App\Models\AnswerEvaluation;
use App\Models\Answer;
use App\Models\Profile;
use App\Models\Question;

use Illuminate\Support\Arr;

class ScoreEvaluationsRepository implements ScoreEvaluationsRepositoryInterface
{
    //warning!! this method use only once do not run again!!
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
      $mean_cats[0]=0;
      $mean_cats[1]=0;
      $mean_cats[2]=0;
      $sum_cats= array();
      $sum_cats[0]=0;
      $sum_cats[1]=0;
      $sum_cats[2]=0;
      $sum_cats[3]=0;
      $sum_cats[4]=0;
      $sum_mean=0;
      for ($i=0; $i < sizeof($wip_ids); $i++) { 
       $wip_se = ScoreEvaluation::select('*')->where('wip_id',$wip_ids[$i]);
       $wip_se= json_decode($wip_se->get(),true);
       if (!$wip_se) {
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
           for ($m=0; $m <3 ; $m++) { 
               for ($n=0; $n < 5; $n++) { 
                   $scoreCats =  AnswerEvaluation::join('answers','answer_evaluations.answer_id','answers.ans_id')
                   ->select('answer_evaluations.score')
                   ->where('answer_evaluations.score_category',$cats_storage[$m])
                   ->where('wip_id',$wip_ids[$i])->where('answers.question_id',$n+1);
                   $scoreCats = Arr::flatten(json_decode($scoreCats->get(),true));
                   for ($o=0; $o < sizeof($scoreCats); $o++) { 
                        $sum_mean +=$scoreCats[$o];
                    }
                    $sum_mean/=sizeof($scoreCats);
                    $sum_mean*=$weight[$n][$cats_storage[$m]];
                    $mean_cats[$m]+=$sum_mean;
                    $sum_mean = 0;
               }
            }
            for ($p=0; $p < sizeof($sum_cats); $p++) { 
                $sum_mean +=$sum_cats[$p];
            }
            $sum_mean/=5;
            ScoreEvaluation::create([
                'wip_id' => $wip_ids[$i],
                'mean_cat_int' => $mean_cats[0],
                'mean_cat_com' => $mean_cats[1],
                'mean_cat_crt' => $mean_cats[2],
                'mean_score_question_1' => $sum_cats[0],
                'mean_score_question_2' => $sum_cats[1],
                'mean_score_question_3' => $sum_cats[2],
                'mean_score_question_4' => $sum_cats[3],
                'mean_score_question_5' => $sum_cats[4],
                'sum_mean_score' => $sum_mean
            ]);
            $mean_cats[0]=0;
            $mean_cats[1]=0;
            $mean_cats[2]=0;
            $sum_cats[0]=0;
            $sum_cats[1]=0;
            $sum_cats[2]=0;
            $sum_cats[3]=0;
            $sum_cats[4]=0;
            $sum_mean=0;
          
       
       
        }
    }
        return 'ok';
    }

    public function getCatScores()
    {
        $mean_cats = array();
        $mean_cats[0]=0;
        $mean_cats[1]=0;
        $mean_cats[2]=0;
        $cats_storage =array();
        $cats_storage[0]='mean_cat_int';
        $cats_storage[1]='mean_cat_com';
        $cats_storage[2]='mean_cat_crt';
        $xBar = array();
        $xBar[0]=720.53;
        $xBar[1]=890.84;
        $xBar[2]=1268.11;

   
        $res = ScoreEvaluation::join('profiles','score_evaluations.wip_id','profiles.wip_id')->select('profiles.wip_id','profiles.citizen_no','profiles.firstname_th','profiles.lastname_th','profiles.nickname','profiles.gender','profiles.school_name','profiles.school_level','profiles.school_major','profiles.gpax','profiles.allergic_food','profiles.allergic_drug','profiles.cangenital_disease','score_evaluations.mean_cat_int','score_evaluations.mean_cat_com','score_evaluations.mean_cat_crt','score_evaluations.mean_score_question_1','score_evaluations.mean_score_question_2','score_evaluations.mean_score_question_3','score_evaluations.mean_score_question_4','score_evaluations.mean_score_question_5','score_evaluations.sum_mean_score')->orderBy('sum_mean_score','DESC');
        $res =  json_decode($res->get(),true);

        for ($i=0; $i != sizeof($res); $i++) { 
            for ($j=0; $j <3 ; $j++) { 
                $mean_cats[$j] += (($res[$i][$cats_storage[$j]] - $xBar[$j])) * ($res[$i][$cats_storage[$j]] - $xBar[$j]) ;
            }
            
        }
        for ($k=0; $k < sizeof($mean_cats); $k++) { 
            $mean_cats[$k]/=sizeof($res);
            $mean_cats[$k]=sqrt($mean_cats[$k]);
        }
        
         return response()->json([
             $res,"sd_cat_int"=>$mean_cats[0],"sd_cat_com"=>$mean_cats[1],"sd_cat_crt"=>$mean_cats[2]
         ]);
    }
}
