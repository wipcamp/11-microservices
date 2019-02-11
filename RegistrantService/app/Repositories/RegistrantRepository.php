<?php
namespace App\Repositories;

use App\Models\Registrant;
use App\Repositories\RegistrantRepositoryInterface;

class RegistrantRepository implements RegistrantRepositoryInterface
{
  public function getRegistrants($wip_id)
  {
    $wip_id = array_pluck($wip_id,'wip_id');
    $registrants_arr = array();
    for ($i=0; $i < \count($wip_id); $i++) { 
      $registrants = Registrant::where('confirm_register',null)->whereNotNull('firstname_th')
      ->whereNotNull('lastname_th')->whereNotNull('telno')->where('wip_id',$wip_id[$i])->get()->toArray();
      array_push($registrants_arr,$registrants);
    }
    $registrants = array_collapse($registrants_arr);
  return $registrants;
  }
}