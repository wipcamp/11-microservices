<?php
namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use App\Repositories\RolePermissionRepositoryInterface;

class RolePermissionRepository implements RolePermissionRepositoryInterface
{
  
  public function getPermissionByRole($role_id){
    $permission = RolePermission::select('permission_id')->where('role_id',$role_id)->get();
    return $permission;
  }

  public function getPermissionByWipId($wip_id)
  {
    $permission = RolePermission::join('credential','credential.role','=','role_permissions.role_id')
    ->select('permission_id')
    ->where('wip_id',$wip_id)
    ->get();
    return $permission;
  }
}
