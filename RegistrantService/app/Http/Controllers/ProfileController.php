<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use App\Repositories\ProfileRepository;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\Request;

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
        $profile = $this->profileRepository->createProfile([]);
        return response()->json($profile);
    }

    public function updateProfile(Request $req)
    {
        $profile = $req->all();
        $update = $this->profileRepository->updateProfile($profile['wip_id'], $profile);
        return response()->json($update);
    }

    public function getAnswers(Request $req)
    {   $profile = $req->all();
        return response()->json(['answer' => $this->profileRepository->findAnswers($profile['wip_id'])]);
    }
}
