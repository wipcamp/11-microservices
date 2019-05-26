<?php
namespace App\Repositories;
use App\Models\Campers;
use App\Models\Flavors;
use App\Repositories\CampersRepositoryInterface;

class CampersRepository implements CampersRepositoryInterface
{
  public function getCampers()
  {
    $registrants = Campers::all();
    return $registrants;
  }
  public function getCamperByWipId($id)
  {
   return $registrants = Campers::join('flavors','campers.flavor_id','=','flavors.flavor_id')->where('wip_id',$id)->get();
  }
}