<?php

namespace App\Http\Controllers;

use App\Repositories\ScoreEvaluationsRepositoryInterface;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class ScoreEvaluationsController extends Controller
{
    protected $scoreEvaluation;
    public function __construct(ScoreEvaluationsRepositoryInterface $temp)
    {
        $this->scoreEvaluation = $temp;
    }
    public function testQuery(Request $req)
    {

        $this->scoreEvaluation->testQuerys();
    }
}
