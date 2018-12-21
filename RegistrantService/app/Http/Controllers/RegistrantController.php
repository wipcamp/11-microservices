<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RegistrantController;
use App\Repositories\RegistrantRepository;
use App\Repositories\RegistrantRepositoryInterface;
use Illuminate\Http\Request;

class RegistrantController extends Controller
{
  protected $registrantRepository;

  public function __construct(RegistrantRepositoryInterface $registrantRepo)
  {
      $this->registrantRepository = $registrantRepo;
  }

  public function getRegistrant()
  {
    $wip = $this->registrantRepository->getRegistrant();
    return response()->json($wip);
  }
}
