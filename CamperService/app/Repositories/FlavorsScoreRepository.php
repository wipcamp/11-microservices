<?php

namespace App\Repositories;

use App\Repositories\FlavorsScoreRepositoryInterface;
use App\Models\FlavorsScore;

class FlavorsScoreRepository implements FlavorsScoreRepositoryInterface
{
 public function insertScore($data)
 {
  FlavorsScore::insert(['score'=>$data['score'],'flavor_id'=>$data['flavor_id']]);
 } 
 public function viewScores()
 {
    return  FlavorsScore::Select('flavor_id')->selectRaw('sum(score) as total_score')->orderBy('total_score','desc')->groupBy('flavor_id')->get();
 }
}
