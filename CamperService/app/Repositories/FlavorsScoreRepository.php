<?php

namespace App\Repositories;

use App\Repositories\FlavorsScoreRepositoryInterface;
use App\Models\FlavorsScore;

class FlavorsScoreRepository implements FlavorsScoreRepositoryInterface
{
 public function insertScore($data)
 {
    for ($i=0; $i != sizeof($data); $i++) { 
       FlavorsScore::insert(['score'=>$data[$i]['score'],'flavor_id'=>$i+1]);
    }
 } 
 public function viewScores()
 {
    return  FlavorsScore::Select('flavor_id')->selectRaw('sum(score) as total_score')->orderBy('flavor_id','desc')->groupBy('flavor_id')->get();
 }
}
