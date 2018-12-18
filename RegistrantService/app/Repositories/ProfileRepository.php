<?php
namespace App\Repositories;

use DB;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileRepository implements ProfileRepositoryInterface
{
  public function getProfile(){
    return Profile::all();
  }

  public function createProfile($profile){
    return Profile::create($profile);
  }

  public function getByWipId($wipId){
    $wip_id = Profile::where('wip_id',$wipId)->get()->first();
    return $wip_id;
  }

  public function updateProfile($wipId)
  {
    return 'test';
  }
}
