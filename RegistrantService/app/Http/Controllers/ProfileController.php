<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use App\Repositories\ProfileRepository;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
<<<<<<< HEAD
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    public function getProfile()
    {
        $profile = $this->profileRepository->getProfile();
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
=======
  protected $profileRepository;


  public function __construct(ProfileRepositoryInterface $profileRepo){
      $this->profileRepository = $profileRepo;
  }

  public function getProfile(){
      // $profile = $this->profileRepository->getProfile();
      return response()->json([]);
  }

  public function createProfile(Request $req){
    $profile = $this->profileRepository->createProfile([]);
    return response()->json($profile);
  }

  public function updateProfile(Request $req)
  {
    $profile = $req->all();
    $update = $this->profileRepository->updateProfile($profile['wip_id'], $profile);
   return response()->json($update);
  }
>>>>>>> 20b7ccca48a9f29cda8dc9231822fe83b18d0ae5
}
