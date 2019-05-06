<?php

namespace App\Http\Controllers;


use App\Http\Controllers\CampersController;
use App\Repositories\FlavorsScoreRepository;
use App\Repositories\FlavorsScoreRepositoryInterface;
use Aws\StorageGateway\StorageGatewayClient;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Storage;


class FlavorsScoreController extends Controller
{
  
    protected $scores;
    public function __construct(FlavorsScoreRepositoryInterface $fri)
    {
        $this->scores = $fri;
    }
   public function insertScore(Request $req)
   {
     $data = $req->all();
    $this->scores->insertScore($data);
    return response()->json('ok', 200);
   }
   public function viewScores(Request $req)
   {
    $data = $req->all();
    $res =  $this->scores->viewScores($data);
    return response()->json( $res, 200);
   }
}

