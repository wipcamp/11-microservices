<?php
namespace App\Repositories;

use App\Models\Profile;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function getProfile($wipId)
    {
        $profile = Profile::where('wip_id',$wipId)->get()->first();
        return $profile;
    }

    public function createProfile($profile)
    {
        return Profile::create($profile);
    }

    public function getByWipId($wipId)
    {
        $wip_id = Profile::where('wip_id', $wipId)->get()->first();
        return $wip_id;
    }

    public function updateProfile($wipId, $profile)
    {   
        $updateProfile = Profile::where('wip_id', $wipId)->update($profile);
        return response()->json($updateProfile);
    }

    public function findAnswersByWipId($wip_id)
    {
        $answers = Profile::find($wip_id)->answers()->get();
        return $answers;
    }

}
