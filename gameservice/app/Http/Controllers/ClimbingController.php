<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use App\Repositories\ClimbingRepositoryInterface;

class ClimbingController extends Controller
{
    protected $climbing;

    public function __construct(ClimbingRepositoryInterface $controljanpu)
    {
        $this->climbing = $controljanpu;
    }
    public function getScore()
    {
        $score = $this->climbing->getScore();
        return response()->json($score);
    }
    public function getScores()
    {
    $scoreTemp = $this->climbing->getScores();
    $score=array('a','b','c');
     for ($i=0; $i !=3; $i++) { 
      $score[$i]= $scoreTemp[$i];
    }
    return response()->json($score);
    }
    public function setScore(Request $request)
    {
     $user = $request->all();
     $this->climbing->setScore($user);
     return response()->json("create complete");
     
    }
}
