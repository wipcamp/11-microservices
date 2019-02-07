<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\ChangeStatusRepositoryInterface;

class ChangeStatusRepository implements ChangeStatusRepositoryInterface
{
  public function changeStatusByWipId($wip_id,$status)
  {
    $wipId = $status['itim_wip_id'];
    $isCall = $status['is_call'];
    $dataUpdate = Profile::where('wip_id',$wip_id)->update(array('is_call' => $isCall));
    return $dataUpdate;
  }

  public function updateNoteByWipId($wipId,$note){
    $wipId = $note['itim_wip_id'];
    $note = $note['note'];
    $dataUpdate = Profile::where('wip_id',$wipId)->update(array('note' => $note));
    return $dataUpdate;
  }
  
}
