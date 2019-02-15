<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PlayersRepositoryInterface;

class PlayersController extends Controller
{
    protected $players;

    public function __construct(PlayersRepositoryInterface $playerInterface)
    {
        $this->players = $playerInterface;
    }
    public function getPlayers(Request $req)
    {
        $playerja = $req->all();
        $wip_id = 11001;
        $playerja = $this->players->getPlayers($wip_id);
         return response()->json($playerja);
    }

}
