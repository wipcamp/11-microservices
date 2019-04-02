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

    public function getPassProfile(Request $req)
    {
        $res = $req->input('res');
        $res = array_pluck($res,'doc_id');
        $data = $this->profileRepository->getProfiles($res);
        return $data;
    }

    public function testGetprogile()
    {
        return  response()->json(['wow this is test login mockup!',"status"=>1], 200);
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
            'firstname_th' => 'required|string',
            'lastname_th' => 'required|string',
            'firstname_en'=>'required|string',
            'lastname_en'=>'required|string',
            'telno'=>'required|string|max:10',
            'nickname'=>'required|string|max:10',
            'gender'=>'required|string|max:6',
            'school_name'=>'required|string',
            'school_level'=>'required|string',
            'gpax'=>'required',
            'religion'=>'required|string|max:20',
            'allergic_food'=>'required',
            'email'=>'required|email',
            'dob'=>'required',
            'citizen_no'=>'required|string|max:13',
            'guardian_relative'=>'required',
            'guardian_telno'=>'required',
            'guardian_telno'=>'required:max10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid feild !'
            ],401);
        }
        $profile = $req->all();
        $update = $this->profileRepository->updateProfile($profile['wip_id'], $profile);
        return response()->json(["success update your profile !"],200);
    }

    public function getAnswers(Request $req)
    {   $profile = $req->all();
        return response()->json(['answer' => $this->profileRepository->findAnswersByWipId($profile['wip_id'])]);
    }
}
