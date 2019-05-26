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

  public function updateCamperByWipId($wipId,$check,$wifi)
  {
    $data = Campers::where('wip_id',$wipId)->update(['check_in' => $check,'wifi_pass' => $wifi]);
    return $data;
  }
}