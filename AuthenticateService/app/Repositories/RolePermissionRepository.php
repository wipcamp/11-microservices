<?php
namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\Authentication;
use App\Repositories\RolePermissionRepositoryInterface;

class RolePermissionRepository implements RolePermissionRepositoryInterface
{
  
  public function getPermissionByRole($role_id){
    $permission = RolePermission::select('permission_id')->where('role_id',$role_id)->get();
    return $permission;
  }
 
  public function updateRoleWip($data){
    Authentication::select('permission_id')->where('wip_id',$data['wip_req'])->update(array('role' => $data['role_id']));
    return 'UpdateSucces';
  }
 
  
  public function getPermissionByWipId($wip_id)
  {
    $permission = RolePermission::join('credential','credential.role','=','role_permissions.role_id')
    ->select('permission_id')
    ->where('wip_id',$wip_id)
    ->get();
    return $permission;
  }

  public function getRoleForRegistrants($role_id)
  {
    $wip_id = RolePermission::join('credential','credential.role','=','role_permissions.role_id')
    ->select('wip_id')
    ->where('role',$role_id)->get();
    return $wip_id;
  }
  public function getallRoles()
  {
    return Role::select('*')->get();
    
  }
  public function getforPermissionAll()
  {
    $users = RolePermission::join('credential','credential.role','=','role_permissions.role_id')
    ->where('role',3)->get();
    return $users;
  }
}
