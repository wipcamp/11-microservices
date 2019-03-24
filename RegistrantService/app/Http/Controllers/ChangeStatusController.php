<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Repositories\ChangeStatusRepositoryInterface;
use GuzzleHttp\Client;

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
  public function changmedicApprove(Request $req)
  {
    $data = $req->all();
    $wipId = $req->all()['wip_id'];
    $token = $req->header('Authorization');
    $URL = env('AUTH_URL') . '/permissions';
    $headers = ['Authorization' => $token];
    $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
    $response = $client->request('GET',$URL,['query' => ['wip_id' => $wipId]]);
    $response = json_decode($response->getBody(),true);
    $arr_res = Arr::dot($response['permission']);
    $arr_res = Arr::flatten($arr_res);
    if(in_array(3,$arr_res)||in_array(9,$arr_res)){
   $this->statusRepo->changMedic($data['wip_checker']);
   return response()->json(["changstatus" => "status update sucess !"]);
    }else{
      return response()->json(['error' => "role or permission invalid !!"],405);
    }
    

  }

  public function updateNoteByWipId(Request $req)
  {
    $wipId = $req->all();
    $itim_wip_id = $this->statusRepo->updateNoteByWipId($wipId['itim_wip_id'],$wipId);
    return response()->json(["changstatus" => "note update sucess !"]);
  }
}