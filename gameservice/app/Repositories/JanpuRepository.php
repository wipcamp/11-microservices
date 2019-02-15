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
}
