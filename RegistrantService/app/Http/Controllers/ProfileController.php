<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use App\Repositories\ProfileRepository;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\ProfileRequests;

class ProfileController extends Controller
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    public function getProfile(Request $req)
    {
        $wipId = $req->all();
        $profile = $this->profileRepository->getProfile($wipId['wip_id']);
        return response()->json($profile);
    }

    public function createProfile(Request $req)
    {
        $wipId = $req->all();
        $getWipId = $this->profileRepository->getProfile($wipId['wip_id']);
        if ($wipId = $getWipId['wip_id']) {
            return response()->json(["Error aleady wipid"]);
        }

        $profile = $this->profileRepository->createProfile([]);
        return response()->json($profile);
    }

    public function updateProfile(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'wip_id' => 'required',
            'prefix_name' => 'required|max:6',
            'fistname_th' => 'required',
            'lastname_th' => 'required',
            'fistname_en'=>'required',
            'lastname_en'=>'required',
            'telno'=>'required',
            'nickname'=>'required',
            'gender'=>'required',
            'school_id'=>'required',
            'school_name'=>'required',
            'school_level'=>'required',
            'gpax'=>'required',
            'religion'=>'required',
            'allergic_food'=>'required',
            'email'=>'required',
            'dob'=>'required',
            'citizen_no'=>'required',
            'guardian_relative'=>'required',
            'guardian_telno'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid test.'
            ]);
        }
        $profile = $req->all();
        $update = $this->profileRepository->updateProfile($profile['wip_id'], $profile);
        return response()->json($update);
    }

    public function getAnswers(Request $req)
    {   $profile = $req->all();
        return response()->json(['answer' => $this->profileRepository->findAnswersByWipId($profile['wip_id'])]);
    }
}
