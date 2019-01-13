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
  
}
