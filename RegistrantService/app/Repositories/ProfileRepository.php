<?php
namespace App\Repositories;
use Illuminate\Support\Arr;

use App\Models\Profile;
class ProfileRepository implements ProfileRepositoryInterface
{
    public function getProfile($wipId)
    {
        $profile = Profile::where('wip_id',$wipId)->get()->first();
        return $profile;
    }
    public function getProfiles($data)
    {
        $profiles = array();
        $doc_id = array_pluck($data,'doc_id');
        for ($i=0; $i != count($data); $i++) { 
            $wip_id = substr($doc_id[$i],7);
            $profile = Profile::select('wip_id','firstname_th','lastname_th','nickname','gender','gpax','religion','telno','school_name','school_major')->where('wip_id',$wip_id)->get();
            $profile[0]->doc_id=$data[$i]['doc_id'];
            $profile[0]->status=$data[$i]['status'];
            $profile[0]->reason=$data[$i]['reason'];
            $profile[0]->transcript=$data[$i]['transcript'];
            $profile[0]->confrim=$data[$i]['confrim'];
            $profile[0]->receipt=$data[$i]['receipt'];
            $profile[0]->size=$data[$i]['size'];
            $profile[0]->pick_location=$data[$i]['pick_location'];
            array_push($profiles,$profile);
        }
        
        
        return $profiles;
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
        $profiles = Profile::where('wip_id',$wipId)->get()->first();
        $updateProfile = $profiles->update($profile);
        return response()->json($updateProfile);
    }
    
    public function findAnswersByWipId($wip_id)
    {
        $answers = Profile::find($wip_id)->answers()->get();
        return $answers;
    }
    
    public function getProfilesByWipIdForCamper($campers){
        // dd(count($campers));
        $profiles = array();
        for ($i=0; $i < count($campers); $i++) { 
            $wipId = $campers[$i]['wip_id'];
            $profile = Profile::select('wip_id','firstname_th','lastname_th','nickname','gender','religion','telno','school_name')->where('wip_id',$wipId)->get();
            $profile[0]->camper_id=$campers[$i]['camper_id'];
            $profile[0]->bed_room=$campers[$i]['bed_room'];
            $profile[0]->class_room=$campers[$i]['class_room'];
            $profile[0]->wifi_pass=$campers[$i]['wifi_pass'];
            $profile[0]->flavor_id=$campers[$i]['flavor_id'];
            $profile[0]->doc_id=$campers[$i]['doc_id'];
            array_push($profiles,$profile);
        }
        // dd($profiles);
        return $profiles;
    }

}
