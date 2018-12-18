<?php
namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use App\Models\Authentication;
// use App\Repositories\AuthenticationRepositoryInterface;

class AuthenticationRepository  implements AuthenticationRepositoryInterface
{

 public function createUser($data) {
    
    $provider_id = $data['provider_id'];
    $provider_name = 'facebook';

    $user = Authentication::create([
      'provider_id'=>$provider_id,
      'provider_name' => $provider_name,
      'role' => 'itim_applicant',
      'wip_id' => null
    ]);
    return $user;
  }


  public function getByProviderId($provider_id) {
    return Authentication::where('provider_id', $provider_id)->first();
  }

  public function getByUserName($provider_name) {
    return Authentication::where('provider_name', $provider_name)->first();
  }
  
  public function updateByProviderId($provider_id, $wip_id) {
    return Authentication::where('provider_id', $provider_id)->update(['wip_id' => $wip_id]);
  }
}
