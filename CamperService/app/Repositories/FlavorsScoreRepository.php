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
   return  FlavorsScore::join('flavors','flavors.flavor_id','=','flavorsScore.flavor_id')->Select('flavors.flavor_id','name')->selectRaw('sum(score) as total_score')->orderBy('flavors.flavor_id','asc')->groupBy('flavors.flavor_id','flavors.name')->get();
}
}
