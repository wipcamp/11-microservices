<?php
namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use App\Models\Authentication;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{

 public function createUser($data) {
  $user = Authentication::create($data);
  return $user;
  }

  public function getByProviderId($provider_id) {
    return Authentication::where('provider_id', $provider_id)->first();
  }
  
  public function updateByProviderId($provider_id, $wip_id) {
    return Authentication::where('provider_id', $provider_id)->update(['wip_id' => $wip_id]);
  }

  public function getRoleByWipId($wip_id)
  {
    $role = Authentication::select('role')->where('wip_id',$wip_id)->get()->first();
    return $role;
  }

  public function getPermissionByWipId($wip_id)
  {
    $permission = Authentication::join('role_permissions','credential.role','=','role_permissions.role_id')
    ->select('role','permission_id')
    ->where('wip_id',$wip_id)
    ->get();
    return response()->json($permission);
  }
}
