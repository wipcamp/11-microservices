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
            'fistname_th' => 'required|string',
            'lastname_th' => 'required|string',
            'fistname_en'=>'required|string',
            'lastname_en'=>'required|string',
            'telno'=>'required|string|max:10',
            'nickname'=>'required|string|max:10',
            'gender'=>'required|string|max:6',
            'school_id'=>'required|string|max:3',
            'school_name'=>'required|string',
            'school_level'=>'required|string',
            'gpax'=>'required',
            'religion'=>'required|string|max:20',
            'allergic_food'=>'required',
            'email'=>'required|email',
            'dob'=>'required|date',
            'citizen_no'=>'required|max:13',
            'guardian_relative'=>'required',
            'guardian_telno'=>'required',
            'guardian_telno'=>'required:max10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid feild !'
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
