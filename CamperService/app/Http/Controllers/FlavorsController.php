<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FlavorsController;
use App\Repositories\FlavorsRepository;
use App\Repositories\FlavorsRepositoryInterface;
use Illuminate\Http\Request;

class FlavorsController extends Controller
{
  protected $flavor;

  public function __construct(FlavorsRepository $flavorRepo)
  {
    $this->flavor = $flavorRepo;
  }

  public function getFlavors()
  {
    $flavors = $this->flavor->getFlavors();
    return response()->json($flavors, 200);
  }
}
