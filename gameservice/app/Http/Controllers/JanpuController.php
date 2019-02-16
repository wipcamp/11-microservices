<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use App\Repositories\JanpuRepositoryInterface;

class JanpuController extends Controller
{
    protected $janpu;

    public function __construct(JanpuRepositoryInterface $controljanpu)
    {
        $this->janpu = $controljanpu;
    }
    public function getScore()
    {
        $score = $this->janpu->getScore();
        return response()->json($score);
    }
    public function getScores()
    {
    $scoreTemp = $this->janpu->getScores();
    $score=array('a','b','c');
     for ($i=0; $i !=3; $i++) { 
      $score[$i]= $scoreTemp[$i];
    }
    return response()->json($score);
    }
    public function setScore(Request $request)
    {
     $user = $request->all();
     $this->janpu->setScore($user);
     return response()->json("create complete");
     
    }
}
