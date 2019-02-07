<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ChangeStatusRepositoryInterface;

class ChangeStatusController  extends Controller
{
    protected $statusRepo;
    public function __construct(ChangeStatusRepositoryInterface $statusRepoInterface){
      $this->statusRepo = $statusRepoInterface;
  }

  public function changeStatusByWipId(Request $req)
  {
    $itim_wip_id = $req->all();
    $itim_wip_id = $this->statusRepo->changeStatusByWipId($itim_wip_id['itim_wip_id'],$itim_wip_id);
    return response()->json(["changstatus" => "status update sucess !"]);
  }

  public function updateNoteByWipId(Request $req)
  {
    $wipId = $req->all();
    $itim_wip_id = $this->statusRepo->updateNoteByWipId($wipId['itim_wip_id'],$wipId);
    return response()->json(["changstatus" => "note update sucess !"]);
  }
}