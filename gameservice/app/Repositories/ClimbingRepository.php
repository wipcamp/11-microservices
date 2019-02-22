<?php

namespace App\Repositories;

use App\Models\Climbing;
use App\Repositories\ClimbingRepositoryInterface;

class  ClimbingRepository implements ClimbingRepositoryInterface
{
 public function getScore()
 {
     $score = Climbing::orderBy('score','desc')->get()->first();
    return $score;
 }
 public function getScores()
 {
    $score = Climbing::orderBy('score','desc')->get();
    return $score;
 }
 public function setScore($user)
 {
     
    Climbing::create([
         'player_name'=>$user['player_name'],
         'score'=>$user['score']
     ]);
    return $user;
     
 }
}
