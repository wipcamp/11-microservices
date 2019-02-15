<?php

namespace App\Repositories;

use App\Models\Player;
use App\Repositories\PlayersRepositoryInterface;

class  PlayersRepository implements PlayersRepositoryInterface
{
 public function getPlayers($wipId)
 {
     $wipId = Player::where('wip_id',$wipId)->get();
    return $wipId;
 }
}
