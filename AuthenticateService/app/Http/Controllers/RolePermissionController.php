<?php

namespace App\Http\Controllers;

use App\Repositories\RolePermissionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RolePermissionController extends Controller
{
  protected $rolepermission;

  public function __construct(RolePermissionRepositoryInterface $rolepermission)
  {
    $this->rolepermission = $rolepermission;
  }

  public function getPermissionByWipId(Request $req)
  {
    $role = $req->all();
    $role_id = $role['wip_id'];
    $permission = $this->rolepermission->getPermissionByWipId($role_id);
    return response()->json(['permission'=>$permission]);
  }
  

  public function getRoleForRegistrants(Request $req)
  {
      $role = $req->input('role_id');
      $wip_id = $this->rolepermission->getRoleForRegistrants($role);
      return response()->json($wip_id);
  }
  public function getAllrolependings()
  {
      $users = $this->rolepermission->getforPermissionAll();
      return response()->json($users);
  }
  public function getallRoles()
  {
    return response()->json($this->rolepermission->getallRoles());
  }
  public function UpdateRoles(Request $req)
  {
    $wipId = $req->all()['wip_id'];
    $response =  $this->rolepermission->getPermissionByWipId($wipId);
    $response = json_decode($response,true);
    $response = Arr::flatten($response);


    if(in_array(9,$response)){
      $data = $req->all();
      $res = $this->rolepermission->updateRoleWip($data);
     return response()->json(["changstatus" => "status update sucess !"]);

    }else{
      return response()->json(['error' => "role or permission invalid !!"],405);
    }
    
  

  }
}
