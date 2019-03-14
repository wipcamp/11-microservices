<?php

namespace App\Http\Controllers;

use App\Repositories\RolePermissionRepositoryInterface;
use Illuminate\Http\Request;
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
  public function getPermissionAll()
  {
      $users = $this->rolepermission->getforPermissionAll();
      return response()->json($users);
  }
}
