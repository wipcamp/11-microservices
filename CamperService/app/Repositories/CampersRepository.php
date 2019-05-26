<?php
namespace App\Repositories;
use App\Models\Campers;
use App\Repositories\CampersRepositoryInterface;

class CampersRepository implements CampersRepositoryInterface
{
  public function getCampers()
  {
    $registrants = Campers::all();
    return $registrants;
  }

  public function updateCamperByWipId($wipId,$check,$wifi)
  {
    $data = Campers::where('wip_id',$wipId)->update(['check_in' => $check,'wifi_pass' => $wifi]);
    return $data;
  }
}