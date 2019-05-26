<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use App\Repositories\ProfileRepository;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\ProfileRequests;
use Illuminate\Support\Arr;

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
    public function getProfilebyCitizen(Request $req)
    {
        $citizen = $req->all()['citizen'];
        $res = $this->profileRepository->getProfilebyCitizen($citizen);
        $res =json_decode($res,true);
        $token = $req->header('Authorization');
        
        $URL = env('CAMPER_URL') . '/campers/camper';
        $headers = ['Authorization' => $token];
        $client = new \GuzzleHttp\Client(['base_uri' => $URL,'headers' => $headers]);
        $response = $client->request('POST',$URL,['json' => ['wip_id_camper' => $res['wip_id']]]);
        $response = json_decode($response->getBody());
        $response = Arr::flatten($response);

        return response()->json(['profile'=>$res,'camper'=>$response[0]], 200 );
    }

    public function getPassProfile(Request $req)
    {
        $res = $req->input('res');
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

    public function getProfilesByWipIdForCamper(Request $req)
    {
        $campers =  $req->input('campers');
        $campers = $this->profileRepository->getProfilesByWipIdForCamper($campers);
        return response()->json($campers, 200);
    }

    public function editProfileByCitizen(Request $req)
    {
        $data = $this->profileRepository->getProfilebyCitizen($req['citizen']);
        $update = $this->profileRepository->updateProfileByCitizen($data['citizen_no'],$req['nameTh'],$req['nameEn'],$req['lastname_th'],$req['lastname_en']);
        dd($update);
    }
}
