<?php

namespace App\Repositories;

use App\Models\Janpu;
use App\Repositories\JanpuRepositoryInterface;

class  JanpuRepository implements JanpuRepositoryInterface
{
 public function getScore()
 {
     $score = Janpu::get();
    return $score;
 }
 public function setScore($user)
 {
     
     Janpu::create([
         'player_name'=>$user['player_name'],
         'score'=>$user['score']
     ]);
    return $user;
     
 }
}
