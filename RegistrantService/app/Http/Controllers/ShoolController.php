<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SchoolController;
use App\Repositories\SchoolRepository;
use App\Repositories\SchoolRepositoryInterface;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
  protected $schoolRepository;


  public function __construct(SchoolRepositoryInterface $school){
      $this->schoolRepository = $school;
  }

  public function getSchool(){
      $school = $this->schoolRepository->getSchool();
      return response()->json($school);
  }
}